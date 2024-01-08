<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Category;
use App\Admin\Repositories\Site;
use App\Models\AdminUser;
use Dcat\Admin\Admin;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class CategoryController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Category(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('name');
            $grid->column('slug');
            $grid->column('status')->using([0 => '禁用', 1 => '启用'])->label([
                0 => 'danger',
                1 => 'success',
            ]);
            $grid->column('site.name','站点');
            $grid->column('post_count');
            $grid->filter(function (Grid\Filter $filter) {
                $filter->panel();
                $filter->like('name');
                $filter->equal('status')->select([0 => '禁用', 1 => '启用']);
                $filter->equal('site_id')->select('/sites/options');
            });
            if(!Admin::user()->isAdministrator()) {
                $siteIds = array_map(function($option){
                    return $option['id'];
                },  Site::make()->options(Admin::user()->id));
                $siteIds = AdminUser::find(Admin::user()->id)->sites()->pluck('id')->toArray();
                $grid->model()->whereIn('site_id', $siteIds);
                $grid->disableCreateButton();
                $grid->actions(function (Grid\Displayers\Actions $actions) {
                    $actions->disableEdit();
                    $actions->disableDelete();
                    $actions->disableQuickEdit();
                });
                $grid->disableBatchDelete();
                $grid->disableRowSelector();
            }
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new Category(), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('slug');
            $show->field('description');
            $show->field('post_count');
            $show->field('order');
            $show->field('status')->using([0 => '禁用', 1 => '启用']);
            $show->field('site.name','站点');
            $show->field('created_at');
            $show->field('updated_at');
            if(!Admin::user()->isAdministrator()) {
                $show->panel()->tools(function (Show\Tools $tools) {
                    $tools->disableEdit();
                    $tools->disableDelete();
                });
                $siteIds = AdminUser::find(Admin::user()->id)->sites()->pluck('id')->toArray();
                if(!in_array($show->model()->site_id, $siteIds)) {
                    abort(403, '无权限');
                }
            }
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Category(), function (Form $form) {
            $form->display('id');
            if($form->isCreating()) {
                $form->select('site_id')->required()->options('/sites/options');
            }else{
                $form->display('site.name','站点');
            }
            $form->text('name')->required();
            $form->text('slug')->required();
            $form->radio('status')->options([1 => '启用', 0 => '禁用'])->default(1);
            
            if($form->isEditing()) {
                $form->text('post_count');
            }
            $form->number('order')->default(10);
            $form->textarea('description');
            $form->display('created_at');
            $form->display('updated_at');
            $form->saving(function (Form $form) {
                if(!Admin::user()->isAdministrator()) {
                    $form->response()->error('无权限');
                }
            });
            $form->deleting(function (Form $form) {
                if(!Admin::user()->isAdministrator()) {
                    $form->response()->error('无权限');
                }
            });
            $form->saved(function (Form $form) {
                if($form->isCreating()) {
                   ( new Site())->addCategoryCount($form->site_id);
                }
            });
            $form->deleted(function (Form $form) {
                (new Site())->subCategoryCount($form->model()->site_id);
            });
        });
    }
    public function options()
    {
        $siteId = request()->get('q');
        return response()->json(Category::make()->options($siteId));
    }
}

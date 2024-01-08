<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Site;
use Dcat\Admin\Admin;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class SiteController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Site(), function (Grid $grid) {
            $grid->column('id');
            $grid->column('name')->display(function () {
                return "<a href='//{$this->domain}' target='_blank'>{$this->name}</a>";
            });
            $grid->column('post_count');
            $grid->column('category_count');
            if (Admin::user()->isAdministrator()) {
                $grid->column('admin_user.username', '管理员');
            }
            $grid->column('status')->using([0 => '禁用', 1 => '启用'])->label([
                0 => 'danger',
                1 => 'success',
            ]);
            $grid->model()->orderBy('updated_at', 'desc');
            $grid->filter(function (Grid\Filter $filter) {
                $filter->panel();
                $filter->like('name');
                $filter->equal('status')->select([0 => '禁用', 1 => '启用']);
                if (Admin::user()->isAdministrator()) {
                    $filter->equal('admin_user_id')->select(\App\Models\AdminUser::all()->pluck('username', 'id'));
                }
            });
            if (!Admin::user()->isAdministrator()) {
                $grid->model()->where('admin_user_id', Admin::user()->id);
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
        return Show::make($id, new Site(), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('domain');
            $show->field('logo')->image(config('dogecloud.url'));
            $show->field('favicon')->image(config('dogecloud.url'));
            $show->field('seo_title');
            $show->field('seo_keyword');
            $show->field('seo_description');
            $show->field('icp');
            $show->field('email');
            $show->field('status')->using([0 => '禁用', 1 => '启用']);
            $show->field('theme')->using(['default' => '默认']);
            $show->field('created_at');
            $show->field('updated_at');
            $show->field('admin_user.username','管理员');
            $show->field('post_count');
            $show->field('category_count');
            if (!Admin::user()->isAdministrator()) {
                $show->panel()->tools(function (Show\Tools $tools) {
                    $tools->disableEdit();
                    $tools->disableDelete();
                });
                if ($show->model()->admin_user_id != Admin::user()->id) {
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
        return Form::make(new Site(), function (Form $form) {
            $form->display('id');
            $form->text('name')->required();
            $form->text('domain');
            $form->image('logo')->disk('doge')->dir('site/logo')->uniqueName();
            $form->image('favicon')->disk('doge')->dir('site/favicon')->uniqueName();
            $form->text('seo_title');
            $form->text('seo_keyword');
            $form->textarea('seo_description');
            $form->text('icp');
            $form->text('email');
            $form->radio('status')->options([0 => '禁用', 1 => '启用'])->default(1)->required();
            $form->select('theme')->options(['default' => '默认'])->default('default');
            $form->select('admin_user_id')->options(\App\Models\AdminUser::all()->pluck('username', 'id'))->required();
            $form->display('created_at');
            $form->display('updated_at');
            $form->saving(function (Form $form) {
                if (!Admin::user()->isAdministrator()) {
                    return $form->response()->error('无权限');
                }
            });
            $form->deleting(function (Form $form) {
                // 判断是否为管理员
                if (!Admin::user()->isAdministrator()) {
                    return $form->response()->error('无权限');
                }
                if ($form->model()->post_count > 0) {
                    return $form->response()->error('该站点下有文章，无法删除' . $form->model()->post_count);
                }
                if ($form->model()->category_count > 0) {
                    return $form->response()->error('该站点下有分类，无法删除' . $form->model()->category_count);
                }
            });
        });

    }
    public function options()
    {
        $adminUserId = null;
        if(!Admin::user()->isAdministrator()) {  
            $adminUserId = Admin::user()->id;
        }
        return response()->json(Site::make()->options($adminUserId));
    }
}

<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Category;
use App\Admin\Repositories\Post;
use App\Admin\Repositories\Site;
use Dcat\Admin\Admin;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class PostController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Post(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('title');
            $grid->column('site.name', '站点');
            $grid->column('category.name', '分类');
            $grid->column('view_count');
            $grid->column('status')->using([0 => '禁用', 1 => '启用'])->label([
                0 => 'danger',
                1 => 'success',
            ]);
            $grid->column('published_at');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();
            $grid->model()->orderBy('updated_at', 'desc');
            $grid->filter(function (Grid\Filter $filter) {
                $filter->panel();
                $filter->like('title');
                $filter->equal('status')->select([0 => '禁用', 1 => '启用']);
                $filter->equal('site_id')->select()->load('category_id', '/categories/options');
                $filter->equal('category_id')->select();
            });
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
        return Show::make($id, new Post(), function (Show $show) {
            $show->field('id');
            $show->field('title');
            $show->field('slug');
            $show->field('description');
            $show->field('content');
            $show->field('view_count');
            $show->field('order');
            $show->field('status');
            $show->field('category_id');
            $show->field('site_id');
            $show->field('published_at');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Post(), function (Form $form) {
            $form->display('id');
            $form->select('site_id')->options('/sites/options')->load('category_id', '/categories/options')->required();
            $form->select('category_id')->required();
            $form->text('title')->required();
            $form->text('author');
            $form->text('source');
            $form->text('slug');
            if ($form->isCreating()) {

                $form->hidden('admin_user_id')->default(Admin::user()->id);
            }
            $form->text('seo_title');
            $form->text('seo_keyword');
            $form->textarea('seo_description');
            $form->textarea('description');
            $form->image('thumb')->disk('doge')->dir('posts/thumb')->uniqueName();
            $form->image('cover')->disk('doge')->dir('posts/cover')->uniqueName();
            $form->markdown('content')->disk('doge')->imageDirectory('posts/images');
            $form->number('order');
            $form->radio('status')->options([1 => '启用', 0 => '禁用'])->default(1);
            $form->creating(function (Form $form) {
                $form->admin_user_id = Admin::user()->id;
            });
            $form->editing(function (Form $form) {
                // 如果不是管理员，只能编辑自己的文章
                if (!Admin::user()->isAdministrator()) {
                    $siteIds = Site::make()->options(Admin::user()->id);
                    if (!in_array($form->site_id, $siteIds)) {
                        return $form->response()->error('无权限');
                    }
                }
            });
            $form->saved(function (Form $form) {
                if ($form->isCreating()) {
                    Site::make()->addPostCount($form->site_id);
                    Category::make()->addPostCount($form->category_id);
                }
            });
            $form->deleting(function (Form $form) {
                if (!Admin::user()->isAdministrator()) {
                    $siteIds = Site::make()->options(Admin::user()->id);
                    if (!in_array($form->model()->site_id, $siteIds)) {
                        return $form->response()->error('无权限');
                    }
                }
            });
            $form->deleted(function (Form $form) {
                Site::make()->subPostCount($form->model()->site_id);
                Category::make()->subPostCount($form->model()->category_id);
            });
            $form->datetime('published_at')->default(date('Y-m-d H:i:s'));
            if ($form->isEditing()) {
                $form->display('view_count');
            }
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}

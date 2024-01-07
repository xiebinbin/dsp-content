<?php

namespace App\Admin\Repositories;

use App\Models\Site as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Site extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
    public function addCategoryCount($site_id, $count = 1)
    {
        $this->model()->where('id', $site_id)->increment('category_count', $count);
    }

    public function subCategoryCount($site_id, $count = 1)
    {
        $this->model()->where('id', $site_id)->decrement('category_count', $count);
    }
    public function addPostCount($site_id, $count = 1)
    {
        $this->model()->where('id', $site_id)->increment('post_count', $count);
    }
    public function subPostCount($site_id, $count = 1)
    {
        $this->model()->where('id', $site_id)->decrement('post_count', $count);
    }
    public function options($adminUserId = null)
    {
        $query = $this->model();
        if ($adminUserId) {
            $query = $query->where('admin_user_id', $adminUserId);
        }
        return $query->get(['id', 'name'])->map(function ($item) {
            return [
                'id' => $item->id,
                'text' => $item->name,
            ];
        })->toArray();
    }
}

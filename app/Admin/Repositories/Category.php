<?php

namespace App\Admin\Repositories;

use App\Models\Category as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Category extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;

    public function addPostCount($category_id, $count = 1)
    {
        $this->model()->where('id', $category_id)->increment('post_count', $count);
    }
    public function subPostCount($category_id, $count = 1)
    {
        $this->model()->where('id', $category_id)->decrement('post_count', $count);
    }
    public function options($siteId)
    {
        $query = $this->model()->where('site_id', $siteId);
        return $query->get(['id', 'name'])->map(function ($item) {
            return [
                'id' => $item->id,
                'text' => $item->name,
            ];
        })->toArray();
    }
}

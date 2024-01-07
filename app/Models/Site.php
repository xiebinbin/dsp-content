<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Site extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
    protected $with = ['admin_user'];
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
    public function admin_user()
    {
        return $this->belongsTo(AdminUser::class);
    }
}

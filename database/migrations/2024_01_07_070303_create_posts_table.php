<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('标题');
            $table->string('author')->nullable()->comment('作者');
            $table->string('source')->nullable()->comment('来源');
            $table->string('seo_title')->nullable()->comment('seo标题');
            $table->string('seo_keyword')->nullable()->comment('seo关键字');
            $table->string('seo_description')->nullable()->comment('seo描述');
            $table->unsignedBigInteger('admin_user_id')->comment('创建管理员')->index('admin_user');
            $table->string('thumb')->nullable()->comment('列表图');
            $table->string('cover')->nullable()->comment('封面图');
            $table->string('slug')->nullable()->comment('别名');
            $table->string('description')->nullable()->comment('描述');
            $table->longText('content')->nullable()->comment('内容');
            $table->unsignedInteger('view_count')->default(0)->comment('浏览量');
            $table->unsignedInteger('order')->default(0)->comment('排序');
            $table->unsignedTinyInteger('status')->default(1)->comment('状态：0-禁用，1-启用');
            $table->unsignedBigInteger('category_id')->comment('所属分类')->index('category');
            $table->unsignedBigInteger('site_id')->comment('所属站点')->index('site');
            $table->timestamp('published_at')->nullable()->comment('上线时间');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};

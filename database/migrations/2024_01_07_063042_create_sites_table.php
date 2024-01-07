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
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('站点名称');
            $table->string('domain')->nullable()->comment('站点域名');
            $table->string('logo')->nullable()->comment('站点logo');
            $table->string('favicon')->nullable()->comment('站点favicon');
            $table->string('seo_title')->nullable()->comment('站点seo标题');
            $table->string('seo_keyword')->nullable()->comment('站点seo关键字');
            $table->string('seo_description')->nullable()->comment('站点seo描述');
            $table->string('icp')->nullable()->comment('站点备案号');
            $table->string('email')->nullable()->comment('站点联系邮箱');
            $table->unsignedTinyInteger('status')->default(1)->comment('状态：0-禁用，1-启用');
            $table->string('theme')->default('default')->comment('主题名字');
            $table->unsignedBigInteger('post_count')->default(0)->comment('文章总数');
            $table->unsignedBigInteger('category_count')->default(0)->comment('分类总数');
            $table->unsignedBigInteger('admin_user_id')->comment('所属管理员')->index('admin_user');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sites');
    }
};

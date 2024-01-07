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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('分类名称');
            $table->string('slug')->comment('分类别名');
            $table->string('description')->nullable()->comment('分类描述');
            $table->unsignedInteger('post_count')->default(0)->comment('内容数量');
            $table->unsignedInteger('order')->default(0)->comment('排序');
            $table->unsignedTinyInteger('status')->default(1)->comment('状态：0-禁用，1-启用');
            $table->unsignedBigInteger('site_id')->comment('所属站点')->index('site');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};

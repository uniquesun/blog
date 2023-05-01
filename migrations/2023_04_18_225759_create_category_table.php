<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('分类名');
            $table->string('image')->nullable()->comment('图片');
            $table->unsignedBigInteger('parent_id')->default(0)->comment('父分类');
            $table->unsignedTinyInteger('is_directory')->default(0)->comment('是否拥有子类目');
            $table->unsignedTinyInteger('level')->default(0)->comment('当前类目层级');
            $table->string('path')->comment('该类目所有父类目 id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
}

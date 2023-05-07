<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class AddIsPublishedToArticle extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('article', function (Blueprint $table) {
            $table->boolean('is_published')->default(false)->comment('发布状态：1-发布 0-草稿');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('article', function (Blueprint $table) {
            $table->dropColumn('is_published');
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->string('layout', 100)->default('default');
            $table->string('type')->nullable()->comment('landing, home');
            $table->string('title')->comment('Page title');
            $table->unsignedInteger('footer_id')->nullable();
            $table->string('footer_title')->nullable();
            $table->string('color')->default('Pink, gradient');
            $table->string('seo_title')->comment('Page title - SEO');
            $table->string('meta_keywords')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('slug')->nullable()->index();
            $table->unsignedInteger('view_count')->default(0);
            $table->unsignedInteger('internal_link_count')->default(0);
            $table->unsignedInteger('external_link_count')->default(0);
            $table->dateTime('news_updated_at')->nullable();
            $table->dateTime('review_updated_at')->nullable();
            $table->dateTime('published_at')->nullable()->index();
            $table->timestamps();
            $table->softDeletes()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}

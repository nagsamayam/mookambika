<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->string('reviewer_name');
            $table->string('reviewer_avatar')->nullable();
            $table->string('reviewer_designation')->nullable();
            $table->string('reviewer_organization')->nullable();
            $table->string('reviewer_location')->nullable();
            $table->text('content');
            $table->float('rating', 2, 1);
            $table->timestamp('published_at')->nullable();
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
        Schema::dropIfExists('reviews');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_section', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('page_id')->index();
            $table->unsignedMediumInteger('section_id')->index();
            $table->string('section_title')->nullable();
            $table->text('content');
            $table->unsignedMediumInteger('sequence')->default(1);
            $table->boolean('mobile_enabled')
                ->default(true)
                ->index()
                ->comment('Show in mobile or not');
            $table->timestamps();

            $table->foreign('page_id')
                ->references('id')->on('pages')
                ->onDelete('cascade');

            $table->foreign('section_id')
                ->references('id')->on('sections')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_section');
    }
}

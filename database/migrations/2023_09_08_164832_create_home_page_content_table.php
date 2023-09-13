<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_page_content', function (Blueprint $table) {
            $table->id();
            $table->string('banner_time')->nullable();
            $table->string('winner_image')->nullable();
            $table->string('peekapoo_title')->nullable();
            $table->text('peekapoo_text')->nullable();
            $table->string('peekapoo_image')->nullable();
            $table->string('story_title')->nullable();
            $table->text('story_text')->nullable();
            $table->string('story_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('home_page_content');
    }
};

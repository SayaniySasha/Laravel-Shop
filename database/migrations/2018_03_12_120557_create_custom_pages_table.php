<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug', 255)->unique();
            $table->string('title');
            $table->text('content');
            $table->char('key', 30);
            $table->char('page', 50);
            $table->text('description')->nullable();
            $table->text('tags')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['page','key'], 'unique_page_key');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom_pages');
    }
}

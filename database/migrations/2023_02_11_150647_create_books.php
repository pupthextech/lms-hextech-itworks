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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('book_name');
            $table->string('book_isbn');
            $table->integer('author_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('book_copy');
            $table->string('status')->default('Enable');
            $table->timestamps();
 
            $table->foreign('author_id')->references('id')->on('book_authors')
                ->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('book_categories')
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
        Schema::dropIfExists('books');
    }
};

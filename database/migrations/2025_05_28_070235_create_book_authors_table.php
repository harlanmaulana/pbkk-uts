<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookAuthorsTable extends Migration
{
    public function up()
    {
        Schema::create('book_authors', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('book_id');
            $table->string('author_id');
            $table->timestamps();

            $table->foreign('book_id')
                ->references('book_id')
                ->on('books')
                ->onDelete('cascade');

            $table->foreign('author_id')
                ->references('author_id')
                ->on('authors')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('book_authors');
    }
}

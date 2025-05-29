<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsers1Table extends Migration
{
    public function up()
    {
        Schema::create('users1', function (Blueprint $table) {
            $table->string('user_id')->primary();
            $table->string('name', 50);
            $table->string('email', 50)->unique();
            $table->char('password', 50);
            $table->date('membership_date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users1');
    }
}

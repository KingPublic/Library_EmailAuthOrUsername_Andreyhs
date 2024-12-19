<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestsTable extends Migration
{
    public function up()
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->string('id_card');
            $table->string('name');
            $table->string('username')->unique();
            $table->string('password');
           
            $table->timestamp('valid_until');
            $table->timestamps();
        });
    }
    

    public function down()
    {
        Schema::dropIfExists('guests');
    }
}

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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('item');
            $table->foreignId('user_id');
            $table->foreignId('category_id');
            $table->string('place_found');
            $table->date('date_found');
            $table->string('description');
            $table->string('color');
            $table->string('serial_num')->nullable();
            $table->integer('status')->default(1);
            $table->integer('flag')->default(1);
            $table->timestamps();
            
            $table->foreign('category_id')->references('id')->on('l_categories');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
};

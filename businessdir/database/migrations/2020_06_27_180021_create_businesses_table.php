<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('business_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('views')->nullable();
            $table->integer('rating')->nullable();
            $table->string('image')->nullable();
            $table->string('url')->nullable();
            $table->text('contact_email')->nullable();
            $table->text('phone_number')->nullable();
            $table->text('address')->nullable();
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
        Schema::dropIfExists('businesses');
    }
}

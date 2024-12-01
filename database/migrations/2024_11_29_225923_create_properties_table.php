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
        Schema::create('properties', function (Blueprint $table) {
            // $table->id();
            // $table->timestamps();

            $table->id();
            $table->enum('type', ['House', 'Apartment']);
            $table->string('address');
            $table->integer('size'); // Size in sqft or m2
            $table->integer('bedrooms');
            // $table->decimal('latitude', 10, 7); // Store geolocation with precision
            // $table->decimal('longitude', 10, 7); // Store geolocation with precision
            $table->decimal('latitude', 10, 7)->change();
            $table->decimal('longitude', 10, 7)->change();
            $table->decimal('price', 10, 2); // Price of the property
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
        Schema::dropIfExists('properties');
    }
};

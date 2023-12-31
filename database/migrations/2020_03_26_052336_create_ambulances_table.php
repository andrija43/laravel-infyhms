<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ambulances', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vehicle_number', 160);
            $table->string('vehicle_model');
            $table->string('year_made');
            $table->string('driver_name');
            $table->string('driver_license');
            $table->string('driver_contact');
            $table->string('note')->nullable();
            $table->boolean('is_available')->default(1);
            $table->integer('vehicle_type')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('ambulances');
    }
};

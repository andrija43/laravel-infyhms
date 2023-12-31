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
        Schema::create('package_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('package_id');
            $table->unsignedInteger('service_id');
            $table->double('quantity');
            $table->double('rate');
            $table->double('amount');
            $table->timestamps();

            $table->foreign('package_id')->references('id')->on('packages')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_services');
    }
};

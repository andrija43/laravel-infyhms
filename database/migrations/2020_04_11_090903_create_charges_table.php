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
        Schema::create('charges', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('charge_type');
            $table->unsignedInteger('charge_category_id');
            $table->string('code', 160);
            $table->string('standard_charge');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('charge_category_id')->references('id')
                ->on('charge_categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('charges');
    }
};

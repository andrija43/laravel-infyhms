<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('blood_donors', function (Blueprint $table) {
            $table->index(['created_at', 'last_donate_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blood_donors', function (Blueprint $table) {
            $table->dropIndex('blood_donors_created_at_last_donate_date_index');
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Drop unique index on npsn to allow duplicates
        if (Schema::hasTable('data_lembaga')) {
            Schema::table('data_lembaga', function (Blueprint $table) {
                // Guard: only drop if index exists
                try {
                    $table->dropUnique('data_lembaga_npsn_unique');
                } catch (Throwable $e) {
                    // Ignore if already dropped
                }
            });
        }
    }

    public function down(): void
    {
        // Restore unique constraint if rolling back
        if (Schema::hasTable('data_lembaga')) {
            Schema::table('data_lembaga', function (Blueprint $table) {
                $table->unique('npsn');
            });
        }
    }
};

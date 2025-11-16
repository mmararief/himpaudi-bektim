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
        if (Schema::hasTable('data_lembaga')) {
            Schema::table('data_lembaga', function (Blueprint $table) {
                if (!Schema::hasColumn('data_lembaga', 'lembaga_master_id')) {
                    $table->foreignId('lembaga_master_id')->nullable()->after('npsn')->constrained('lembaga_masters')->nullOnDelete();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('data_lembaga')) {
            Schema::table('data_lembaga', function (Blueprint $table) {
                if (Schema::hasColumn('data_lembaga', 'lembaga_master_id')) {
                    $table->dropForeign(['lembaga_master_id']);
                    $table->dropColumn('lembaga_master_id');
                }
            });
        }
    }
};

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
        Schema::table('data_lembaga', function (Blueprint $table) {
            if (!Schema::hasColumn('data_lembaga', 'jabatan')) {
                $table->string('jabatan')->nullable()->after('nama_lembaga');
            }
            if (!Schema::hasColumn('data_lembaga', 'kelurahan')) {
                $table->enum('kelurahan', [
                    'Aren Jaya',
                    'Bekasi Jaya',
                    'Duren Jaya',
                    'Margahayu'
                ])->nullable()->after('jabatan');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_lembaga', function (Blueprint $table) {
            if (Schema::hasColumn('data_lembaga', 'jabatan')) {
                $table->dropColumn('jabatan');
            }
            if (Schema::hasColumn('data_lembaga', 'kelurahan')) {
                $table->dropColumn('kelurahan');
            }
        });
    }
};

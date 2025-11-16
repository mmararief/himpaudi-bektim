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
        // Check which columns exist before attempting to drop them
        Schema::table('data_lembaga', function (Blueprint $table) {
            if (Schema::hasColumn('data_lembaga', 'alamat_lembaga')) {
                $table->dropColumn('alamat_lembaga');
            }
            if (Schema::hasColumn('data_lembaga', 'kelurahan')) {
                $table->dropColumn('kelurahan');
            }
            if (Schema::hasColumn('data_lembaga', 'kecamatan')) {
                $table->dropColumn('kecamatan');
            }
            if (Schema::hasColumn('data_lembaga', 'kota')) {
                $table->dropColumn('kota');
            }
            if (Schema::hasColumn('data_lembaga', 'no_telp_lembaga')) {
                $table->dropColumn('no_telp_lembaga');
            }
            if (Schema::hasColumn('data_lembaga', 'email_lembaga')) {
                $table->dropColumn('email_lembaga');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_lembaga', function (Blueprint $table) {
            $table->text('alamat_lembaga')->nullable()->after('nama_lembaga');
            $table->enum('kelurahan', [
                'Aren Jaya',
                'Bekasi Jaya',
                'Duren Jaya',
                'Margahayu'
            ])->nullable()->after('alamat_lembaga');
            $table->string('kecamatan')->default('Bekasi Timur')->after('kelurahan');
            $table->string('kota')->nullable()->after('kecamatan');
            $table->string('no_telp_lembaga')->nullable()->after('kota');
            $table->string('email_lembaga')->nullable()->after('no_telp_lembaga');
        });
    }
};

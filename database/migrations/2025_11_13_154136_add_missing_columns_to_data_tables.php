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
        // Add missing columns to data_pribadi
        Schema::table('data_pribadi', function (Blueprint $table) {
            $table->string('no_kta_lama', 50)->nullable()->after('niptk_nuptk');
        });

        // Add missing columns to data_lembaga
        Schema::table('data_lembaga', function (Blueprint $table) {
            $table->string('kota')->default('Bekasi')->after('kecamatan');
            $table->string('no_telp_lembaga', 15)->nullable()->after('kota');
            $table->string('email_lembaga')->nullable()->after('no_telp_lembaga');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_pribadi', function (Blueprint $table) {
            $table->dropColumn('no_kta_lama');
        });

        Schema::table('data_lembaga', function (Blueprint $table) {
            $table->dropColumn(['kota', 'no_telp_lembaga', 'email_lembaga']);
        });
    }
};

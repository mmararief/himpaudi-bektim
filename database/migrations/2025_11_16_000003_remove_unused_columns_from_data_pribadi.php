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
        Schema::table('data_pribadi', function (Blueprint $table) {
            $table->dropColumn(['gaji', 'jurusan']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_pribadi', function (Blueprint $table) {
            $table->string('jurusan')->nullable()->after('pendidikan_terakhir');
            $table->decimal('gaji', 15, 2)->nullable()->after('jurusan');
        });
    }
};

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
        Schema::create('data_lembaga', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('npsn', 8)->unique()->comment('Nomor Pokok Sekolah Nasional');
            $table->string('nama_lembaga');
            $table->text('alamat_lembaga');
            $table->enum('kelurahan', [
                'Aren Jaya',
                'Bekasi Jaya',
                'Duren Jaya',
                'Margahayu'
            ]);
            $table->string('kecamatan')->default('Bekasi Timur');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_lembaga');
    }
};

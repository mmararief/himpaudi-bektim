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
        Schema::create('data_pribadi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('niptk_nuptk', 20)->nullable()->unique();
            $table->string('no_ktp', 16)->unique();
            $table->string('nama_lengkap');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('pendidikan_terakhir');
            $table->string('jurusan')->nullable();
            $table->decimal('gaji', 15, 2)->nullable();
            $table->date('tmt_kerja')->comment('Tanggal Mulai Tugas Kerja');
            $table->json('riwayat_diklat')->nullable()->comment('Training/Education History');
            $table->text('alamat_domisili');
            $table->string('no_hp', 15);
            $table->string('foto_profil')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_pribadi');
    }
};

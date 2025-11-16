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
        Schema::create('lembaga_masters', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sekolah');
            $table->string('npsn', 16)->nullable()->index();
            $table->text('alamat')->nullable();
            $table->string('nama_kepala_sekolah')->nullable();
            $table->unsignedInteger('jumlah_guru')->nullable()->default(0);
            $table->unsignedInteger('jumlah_siswa')->nullable()->default(0);
            $table->string('akreditasi', 2)->nullable(); // A/B/C/-
            $table->unsignedSmallInteger('tahun_akreditasi')->nullable();
            $table->string('foto_sekolah')->nullable(); // path file pada storage
            // PIC & status management (optional)
            $table->string('email_pic')->nullable();
            $table->string('no_hp_pic', 20)->nullable();
            $table->string('nama_pic')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('approved');
            $table->text('rejection_reason')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lembaga_masters');
    }
};

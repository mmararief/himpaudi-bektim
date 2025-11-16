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
        Schema::table('lembaga_masters', function (Blueprint $table) {
            if (Schema::hasColumn('lembaga_masters', 'nama_pic')) {
                $table->dropColumn('nama_pic');
            }
            if (Schema::hasColumn('lembaga_masters', 'email_pic')) {
                $table->dropColumn('email_pic');
            }
            if (Schema::hasColumn('lembaga_masters', 'no_hp_pic')) {
                $table->dropColumn('no_hp_pic');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lembaga_masters', function (Blueprint $table) {
            $table->string('nama_pic')->nullable();
            $table->string('email_pic')->nullable();
            $table->string('no_hp_pic', 20)->nullable();
        });
    }
};

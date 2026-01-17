<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Fix NPSN yang terlalu panjang (>8 karakter)
        DB::table('lembaga_masters')
            ->whereRaw('LENGTH(npsn) > 8')
            ->update(['npsn' => DB::raw('LEFT(npsn, 8)')]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Cannot reverse this migration
    }
};

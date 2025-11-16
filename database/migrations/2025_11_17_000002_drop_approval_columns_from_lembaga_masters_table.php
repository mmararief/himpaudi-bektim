<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('lembaga_masters')) {
            return; // Table not found, nothing to do
        }

        Schema::table('lembaga_masters', function (Blueprint $table) {
            // Drop only if columns exist
            if (Schema::hasColumn('lembaga_masters', 'approved_at')) {
                $table->dropColumn('approved_at');
            }
            if (Schema::hasColumn('lembaga_masters', 'rejection_reason')) {
                $table->dropColumn('rejection_reason');
            }
            if (Schema::hasColumn('lembaga_masters', 'approved_by')) {
                $table->dropColumn('approved_by');
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('lembaga_masters')) {
            return;
        }

        Schema::table('lembaga_masters', function (Blueprint $table) {
            if (!Schema::hasColumn('lembaga_masters', 'approved_at')) {
                $table->timestamp('approved_at')->nullable();
            }
            if (!Schema::hasColumn('lembaga_masters', 'rejection_reason')) {
                $table->text('rejection_reason')->nullable();
            }
            if (!Schema::hasColumn('lembaga_masters', 'approved_by')) {
                $table->unsignedBigInteger('approved_by')->nullable();
            }
        });
    }
};

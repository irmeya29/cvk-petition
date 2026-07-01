<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('signatures')
            ->select('petition_id', 'ip_address')
            ->whereNotNull('ip_address')
            ->groupBy('petition_id', 'ip_address')
            ->havingRaw('COUNT(*) > 1')
            ->get()
            ->each(function (object $duplicate): void {
                $ids = DB::table('signatures')
                    ->where('petition_id', $duplicate->petition_id)
                    ->where('ip_address', $duplicate->ip_address)
                    ->orderBy('id')
                    ->pluck('id');

                DB::table('signatures')
                    ->whereIn('id', $ids->skip(1)->all())
                    ->update(['ip_address' => null]);
            });

        Schema::table('signatures', function (Blueprint $table) {
            $table->unique(['petition_id', 'ip_address']);
        });
    }

    public function down(): void
    {
        Schema::table('signatures', function (Blueprint $table) {
            $table->dropUnique(['petition_id', 'ip_address']);
        });
    }
};

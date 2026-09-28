<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('histories', function (Blueprint $table) {
            $table->timestamp('end_time')->nullable()->change();
            $table->text('access_code')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('histories', function (Blueprint $table) {
            // Keep end_time nullable to preserve ongoing sessions and match the base migration.
            $table->dropColumn('access_code');
        });
    }
};

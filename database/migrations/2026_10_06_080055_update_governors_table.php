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
        Schema::table('governors', function (Blueprint $table) {
            $table->boolean('is_present')->default(false)->after('from');
            $table->date('to')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('governors', function (Blueprint $table) {
            $table->dropColumn('is_present');
            $table->date('to')->nullable(false)->change();
        });
    }
};

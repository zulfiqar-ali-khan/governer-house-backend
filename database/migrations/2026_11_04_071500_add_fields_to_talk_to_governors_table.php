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
        Schema::table('talk_to_governors', function (Blueprint $table) {
            $table->string('reference_number')->nullable()->unique()->after('id');
            $table->string('mobile_number')->nullable()->after('email');
            $table->string('cnic')->nullable()->after('mobile_number');
            $table->string('district')->nullable()->after('cnic');
            $table->string('category')->nullable()->after('district');
            $table->string('subject')->nullable()->after('category');
            $table->string('document')->nullable()->after('message');
            $table->text('images')->nullable()->after('document');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('talk_to_governors', function (Blueprint $table) {
            $table->dropColumn([
                'reference_number',
                'mobile_number',
                'cnic',
                'district',
                'category',
                'subject',
                'document',
                'images',
            ]);
        });
    }
};


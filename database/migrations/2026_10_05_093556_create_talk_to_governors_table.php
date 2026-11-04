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
        Schema::create('talk_to_governors', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number')->nullable()->unique();
            $table->string('name');
            $table->string('email');
            $table->string('mobile_number')->nullable();
            $table->string('cnic')->nullable();
            $table->string('district')->nullable();
            $table->string('category')->nullable();
            $table->string('subject')->nullable();
            $table->text('message');
            $table->string('document')->nullable();
            $table->text('images')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('talk_to_governors');
    }
};

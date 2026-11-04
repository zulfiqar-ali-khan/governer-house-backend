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
        Schema::create('governor_messages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('name');
            $table->string('designation');
            $table->date('from')->nullable();
            $table->date('to')->nullable();
            $table->text('short_description');
            $table->text('description');
            $table->longText('political_career')->nullable();
            $table->longText('public_leadership')->nullable();
            $table->text('education_description')->nullable();
            $table->string('education_degree')->nullable();
            $table->text('family_background')->nullable();
            $table->json('ancestry_tree')->nullable();
            $table->json('roles_of_governor')->nullable();
            $table->string('born')->nullable();
            $table->string('education')->nullable();
            $table->string('previous_office')->nullable();
            $table->string('also_serves_as')->nullable();
            $table->string('image');
            $table->boolean('active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('governor_messages');
    }
};

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
        Schema::table('governor_messages', function (Blueprint $table) {
            $table->longText('political_career')->nullable()->after('description');
            $table->longText('public_leadership')->nullable()->after('political_career');
            $table->text('education_description')->nullable()->after('public_leadership');
            $table->string('education_degree')->nullable()->after('education_description');
            $table->text('family_background')->nullable()->after('education_degree');
            $table->json('ancestry_tree')->nullable()->after('family_background');
            $table->json('roles_of_governor')->nullable()->after('ancestry_tree');
            $table->string('born')->nullable()->after('roles_of_governor');
            $table->string('education')->nullable()->after('born');
            $table->string('previous_office')->nullable()->after('education');
            $table->string('also_serves_as')->nullable()->after('previous_office');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('governor_messages', function (Blueprint $table) {
            $table->dropColumn([
                'political_career',
                'public_leadership',
                'education_description',
                'education_degree',
                'family_background',
                'ancestry_tree',
                'roles_of_governor',
                'born',
                'education',
                'previous_office',
                'also_serves_as',
            ]);
        });
    }
};


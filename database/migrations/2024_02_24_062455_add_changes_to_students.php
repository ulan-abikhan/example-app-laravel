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
        Schema::table('students', function (Blueprint $table) {
            $table->renameColumn('birth_date', 'b_date');
            $table->string('photo')
            ->nullable()
            ->default(null)
            ->after('birth_date');
            $table->unique(['name', 'surname'], 'unique_full_name');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->renameColumn('b_date', 'birth_day');
            $table->dropColumn('photo');
            $table->dropUnique('unique_full_name');
        });
    }
};

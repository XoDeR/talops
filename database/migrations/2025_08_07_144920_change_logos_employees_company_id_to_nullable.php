<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('logos', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->dropColumn('company_id');
        });

        Schema::table('logos', function (Blueprint $table) {
            $table->foreignId('company_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');
        });

        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->dropColumn('company_id');
        });

        Schema::table('employees', function (Blueprint $table) {
            $table->foreignId('company_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('logos', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->dropColumn('company_id');
        });

        Schema::table('logos', function (Blueprint $table) {
            $table->foreignId('company_id')
                ->constrained()
                ->onDelete('cascade');
        });

        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->dropColumn('company_id');
        });

        Schema::table('employees', function (Blueprint $table) {
            $table->foreignId('company_id')
                ->constrained()
                ->onDelete('cascade');
        });
    }

};

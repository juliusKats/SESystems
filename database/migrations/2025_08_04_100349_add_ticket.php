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
        //
        Schema::table('user_files', function (Blueprint $table) {
            $table->string('ticket')->after('id')->unique();
        });
        Schema::table('job_documents', function (Blueprint $table) {
            $table->string('ticket')->after('id')->unique();
        });
        Schema::table('rapex_documents', function (Blueprint $table) {
            $table->string('ticket')->after('id')->unique();
        });
        Schema::table('service_schemes', function (Blueprint $table) {
            $table->string('ticket')->after('id')->unique();
        });
        Schema::table('service_Uganda_centers', function (Blueprint $table) {
            $table->string('ticket')->after('id')->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

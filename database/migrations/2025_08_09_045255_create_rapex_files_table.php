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
        Schema::create('rapex_files', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('uploadedby')->unsigned()->nullable();
            $table->longText('files')->nullable(); //'Rapex Images');
            $table->bigInteger('rapex_id')->unsigned()->nullable();
            $table->foreign('rapex_id')->references('id')->on('rapex_documents')->onDelete('cascade');
            $table->foreign('uploadedby')->references('id')->on('users')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rapex_files');
    }
};

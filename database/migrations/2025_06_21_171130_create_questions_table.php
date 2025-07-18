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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('mobile', 15);
            $table->string('question',100);
            $table->string('details',)->nullable();
            $table->string('reply', 200)->nullable();
            $table->boolean('is_replied')->default(false);
            $table->dateTime('repliedOn')->nullable();
            $table->boolean('active')->default(false);
            $table->bigInteger('repliedBy')->nullable()->unsigned();
            $table->foreign('repliedBy')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};


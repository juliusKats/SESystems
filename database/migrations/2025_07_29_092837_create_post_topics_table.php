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
        Schema::create('post_topics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->nullable()->references('id')->on('blog_posts')->cascadeOnDelete();
            $table->foreignId('topic_id')->nullable()->references('id')->on('blog_topics')->cascadeOnDelete();
            $table->unique(['post_id','topic_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_topics');
    }
};

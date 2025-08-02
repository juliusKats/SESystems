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
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('repliedBy')->unsigned()->nullable();
            // $table->string('dialingCode');
            $table->string('fullname');
            $table->string('telephone');
            $table->string('email')->nullable();
            $table->string('inquiry');
            $table->string('reply')->nullable();
            $table->boolean('replied')->default(false);
            $table->foreign('repliedBy')->references('id')->on('users')->nullable()->cascadeOnDelete();
            $table->datetime('repliedOn')->nullable();
            $table->enum('status',['Read','UnRead','Deleted'])->default('UnRead');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};

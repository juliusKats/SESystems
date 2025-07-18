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
        Schema::create('carders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ministry')->unsigned()->nullable();
            $table->string('cardname',50)->nullable();
            $table->foreign('ministry')->references('id')->on('card_ministries')->onDelete('cascade');
            $table->unique(['ministry','cardname']);
            $table->boolean("status")->unsigned()->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carders');
    }
};

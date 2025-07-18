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
        Schema::create('institutions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('entity')->unsigned()->nullable();
            $table->string('lineMinistry');
            $table->string('institution',150);
            $table->boolean('status')->default(false);
            $table->unique(['entity','institution'],'entity_institues')->comment('Instittue Ministry');
            $table->foreign('entity')->references('id')->on('gov_entities')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('institutions');
    }
};

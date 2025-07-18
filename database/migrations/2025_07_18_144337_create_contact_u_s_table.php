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
        Schema::create('contact_u_s', function (Blueprint $table) {
            $table->id();
            $table->string('fullname',100);
 $table->string('telephone',25);
             $table->string('email',50)->nullable();
             $table->string('subject',50);
             $table->longText('message');
             $table->longText('screenshot')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->boolean('read')->default(false);
            $table->boolean('status')->default(false);
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_u_s');
    }
};

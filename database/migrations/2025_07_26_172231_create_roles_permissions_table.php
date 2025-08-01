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
        Schema::create('roles_permissions', function (Blueprint $table) {
            // $table->id();
            $table->bigInteger('role_id')->unsigned()->nullable();
         $table->bigInteger('permission_id')->unsigned()->nullable();

         //FOREIGN KEY
         $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
         $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');

         //PRIMARY KEYS
         $table->primary(['role_id','permission_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles_permissions');
    }
};

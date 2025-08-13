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
        Schema::create('s_u_images', function (Blueprint $table) {
$table->id();
             $table->bigInteger('uploadedby')->unsigned()->nullable();
             $table->dateTime('UploadedOn')->useCurrent(); //'Upload date');
            $table->bigInteger('rapex_id')->unsigned()->nullable();
            $table->longText('imagefiles')->nullable(); //'Rapex Images');
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->longText('Description');
            $table->foreign('rapex_id')->references('id')->on('rapex_documents')->onDelete('cascade');
            $table->foreign('uploadedby')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('image_categories')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('s_u_images');
    }
};

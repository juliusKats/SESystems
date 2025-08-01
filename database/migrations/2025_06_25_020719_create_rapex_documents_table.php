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
        Schema::create('rapex_documents', function (Blueprint $table) {
            $table->id();
            $table->longText('entity')->comment('Goverment Ministry Names');
            $table->longText('institution')->comment('Institution Name');
            $table->longText('file')->comment('Only Excel,PDF and Images');
            $table->longText('comment')->nullable()->comment('User Comment');
            $table->longText('zoomlink')->nullable()->comment('Virtual Meeting');
            $table->boolean('Draft')->default(false);
            $table->timestamps();
            $table->softDeletes();
            $table->string('DeletedBy',90)->nullable();
            $table->string('RestoredBy',90)->nullable();


            $table->dateTime('UploadedOn')->useCurrent()->comment('Upload date');
            $table->bigInteger('UploadedBy')->unsigned();

            $table->string('ApprovedBy', 40)->nullable();
            $table->string('UpdatedBy', 40)->nullable();
            $table->bigInteger('approved_by')->nullable()->unsigned();
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('cascade');

            $table->bigInteger("status")->unsigned()->default(2);
            $table->foreign("status")->references("id")->on("doc_statuses")->onDelete("cascade");
            $table->dateTime("DateOn")->nullable();

            $table->string("RejectedBy",50)->nullable();
            $table->longText("Reason")->nullable();
            $table->foreign("UploadedBy")->references("id")->on("users")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rapex_documents');
    }
};

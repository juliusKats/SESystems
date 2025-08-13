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
        Schema::create('service_schemes', function (Blueprint $table) {
            $table->id();
            $table->string('ticket')->unique();
            $table->bigInteger('carderId')->unsigned();
            $table->bigInteger('versionId')->unsigned()->nullable();
            $table->boolean('Draft')->default(false);
            $table->string('CarderName', 200); //'Name Of Carder');
            $table->longText('WordFile'); //'Word documment .doc,.docx');
            $table->enum('ext', ['pdf', 'docx', 'doc']); //'File extension');
            $table->longText('PDFFile'); //'PS Approved PDF File .pdf');
            $table->boolean('sfresponse')->default(false);
             $table->longText('supportfile')->nullable();
            $table->date('ApprovedOn'); //'Date when PS Approved PDF File');
            $table->longText('comment')->nullable(); //"User's comment on uploadedfile");
            $table->timestamps();
            $table->softDeletes();
            $table->string('DeletedBy', 90)->nullable();
            $table->string('RestoredBy', 90)->nullable();

            $table->dateTime('UploadedOn')->useCurrent(); //'Upload date');
            $table->bigInteger('UploadedBy')->unsigned();
            $table->foreign('carderId')->references('id')->on('carders')->nullable()->cascadeOnDelete();
            $table->foreign('versionId')->references('id')->on('versions')->nullable()->cascadeOnDelete();

            $table->string('ApprovedBy', 40)->nullable();
            $table->string('UpdatedBy', 40)->nullable();
            $table->bigInteger('approved_by')->nullable()->unsigned();
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger("status")->unsigned()->default(2);
            $table->foreign("status")->references("id")->on("doc_statuses")->onDelete("cascade");
            $table->dateTime("DateOn")->nullable();
            $table->bigInteger("RejectedBy")->unsigned()->nullable();
            $table->longText("Reason")->nullable();
            $table->foreign("RejectedBy")->references("id")->on("users")->onDelete("cascade");
            $table->unique(['carderId', 'versionId']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_schemes');
    }
};

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
            $table->string('CarderName', 200)->comment('Name Of Carder');
            $table->longText('WordFile')->comment('Word documment .doc,.docx');
            $table->enum('ext', ['pdf', 'docx', 'doc'])->comment('File extension');
            $table->longText('PDFFile')->comment('PS Approved PDF File .pdf');
            $table->date('ApprovedOn')->comment('Date when PS Approved PDF File');
            $table->longText('comment')->nullable()->comment("User's comment on uploadedfile");
            $table->timestamps();
            $table->softDeletes();
            $table->string('DeletedBy',90)->nullable();
             $table->string('RestoredBy',90)->nullable();

            $table->dateTime('UploadedOn')->useCurrent()->comment('Upload date');
            $table->bigInteger('UploadedBy')->unsigned();
            $table->bigInteger('carder_id')->nullable()->unsigned();
            $table->foreign('carder_id')->references('id')->on('card_ministries')->onDelete('cascade');

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

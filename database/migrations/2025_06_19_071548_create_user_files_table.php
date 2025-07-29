<?php

use Carbon\Carbon;
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
        Schema::create('user_files', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('VoteCode')->unsigned();
             $table->string('VoteName',50);
            $table->longText('comment')->nullable();
            $table->boolean('Approve')->default(false);
            //  Vote Excel
           $table->longText('excelfile')->nullable();
            $table->longText('pdffile')->nullable();
            $table->date('ApprovedOn')->nullable();
            $table->date('UploadedOn')->useCurrent()->comment('Upload date');

            $table->bigInteger('UploadedBy')->unsigned();
            $table->string('ApprovedBy',40)->nullable();
            $table->bigInteger('approved_by')->nullable()->unsigned();

            $table->bigInteger("status")->unsigned()->default(2);
             $table->foreign("status")->references("id")->on("doc_statuses")->onDelete("cascade");
            $table->dateTime("DateOn")->nullable();
            $table->bigInteger("versionId")->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
              $table->string('DeletedBy',90)->nullable();
             $table->string('RestoredBy',90)->nullable();


            $table->string('UpdatedBy',40)->nullable();
            $table->foreign('VoteCode')->references('id')->on('vote_details')->onDelete('cascade');
            $table->foreign('UploadedBy')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('cascade');

            $table->bigInteger("RejectedBy")->unsigned()->nullable();
            $table->longText("Reason")->nullable();
            $table->foreign("RejectedBy")->references("id")->on("users")->onDelete("cascade");
            $table->foreign("versionname")->references("id")->on("versions")->onDelete("cascade");
            $table->unique(['versionname','VoteCode']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_files');
    }
};



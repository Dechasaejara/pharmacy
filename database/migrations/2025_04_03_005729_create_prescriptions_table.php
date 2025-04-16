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
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('profile_id'); // Foreign key to profiles
            $table->string('unique_name')->unique(); // JSON array of prescription images
            $table->string('image')->nullable(); // JSON array of prescription images
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('medical_notes')->nullable(); // Additional medical notes or instructions
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescriptions');
    }
};

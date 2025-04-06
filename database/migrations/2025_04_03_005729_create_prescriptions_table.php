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
            $table->unsignedBigInteger('profile_id')->default(1); // Foreign key to profiles
            $table->string('image')->nullable(); // JSON array of prescription images
            $table->string('status')->default('pending'); // Status of the prescription (e.g., pending, approved, rejected)
            $table->text('medical_notes')->nullable(); // Additional medical notes or instructions
            $table->date('issued_date')->nullable(); // Date the prescription was issued
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

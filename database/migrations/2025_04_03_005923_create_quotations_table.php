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
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prescription_id')->default(1);
            $table->unsignedBigInteger('profile_id')->default(1);
            $table->unsignedBigInteger('pharmacy_id')->default(1);
            $table->decimal('total_amount', 10, 2)->default(0.1);
            $table->string('status')->default('pending');
            $table->date('valid_until')->nullable(); // Expiry date of the quotation
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('prescription_id')->references('id')->on('prescriptions')->onDelete('cascade');
            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
            $table->foreign('pharmacy_id')->references('id')->on('pharmacies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotations');
    }
};

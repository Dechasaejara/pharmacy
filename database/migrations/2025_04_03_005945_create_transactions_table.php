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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->decimal('total_amount', 10, 2)->default(0.1);
            $table->enum('status', ['pending', 'approved', 'rejected', 'accepted'])->default('pending');
            $table->dateTime('completed_at')->nullable();
            $table->timestamps();

            $table->foreignId('quotation_id')->default(1)->unique()->constrained('quotations')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('profile_id')->default(1)->constrained('profiles')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('pharmacy_id')->default(1)->constrained('pharmacies')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

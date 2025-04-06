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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pharmacy_id')->default(1); // Foreign key to pharmacies
            $table->unsignedBigInteger('product_id')->default(1); // Foreign key to products
            $table->string('batch_number')->nullable(); // Batch number for tracking
            $table->string('manufacturer')->nullable(); // Manufacturer name
            $table->date('expiry_date')->nullable(); // Expiration date of the product
            $table->integer('quantity')->unsigned()->default(1); // Quantity in stock
            $table->decimal('unit_price', 10, 2)->default(1.0); // Unit price of the product
            $table->string('storage_location')->nullable(); // Storage location within the pharmacy
            $table->string('tax')->nullable();
            $table->boolean('is_active')->default(true); // Whether the inventory is active
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('pharmacy_id')->references('id')->on('pharmacies')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
             // Unique constraint for pharmacy_id and product_id
             $table->unique(['pharmacy_id', 'product_id'], 'unique_pharmacy_product');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};

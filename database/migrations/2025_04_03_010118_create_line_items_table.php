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
        Schema::create('line_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_id')->default(1);
            $table->unsignedBigInteger('inventory_id')->default(1);
            $table->integer('quantity')->unsigned()->default(1);
            $table->decimal('unit_price', 10, 2)->default(0.1);
            $table->decimal('subtotal', 10, 2)->default(0.2);
            $table->text('instructions')->nullable(); // Optional instructions for the item
            $table->timestamps();

            $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('cascade');
            $table->foreign('inventory_id')->references('id')->on('inventories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('line_item_');
    }
};

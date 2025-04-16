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
        Schema::create('pharmacies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('Test'); // Pharmacy name
            $table->string('license_number')->unique()->nullable(); // License number
            $table->string('address')->nullable(); // General location description
            $table->string('picture')->nullable(); // Pharmacy picture URL
            $table->string('phone')->nullable(); // Contact phone number
            $table->string('email')->nullable(); // Contact email
            $table->decimal('latitude', 10, 7)->nullable(); // Geolocation latitude
            $table->decimal('longitude', 10, 7)->nullable(); // Geolocation longitude
            $table->string('country')->nullable(); // Country
            $table->string('state')->nullable(); // State or region
            $table->string('city')->nullable(); // City
            $table->timestamps();
            // $table->foreignId('profile_id')->default(1)->constrained('profiles')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pharmacies');
    }
};

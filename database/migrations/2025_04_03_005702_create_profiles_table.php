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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->text('fullname')->nullable(); //
            $table->text('bio')->nullable(); // Short biography
            $table->string('picture')->nullable(); // Profile picture URL
            $table->enum('role', ['User', 'Admin', 'Pharmacist', 'Manager'])->default('User'); // User role
            $table->string('phone')->nullable(); // Phone number
            $table->string('address')->nullable(); // Address
            $table->date('date_of_birth')->nullable(); // Date of birth
            $table->string('gender')->nullable(); // Gender (e.g., Male, Female, Other)
            $table->decimal('latitude', 10, 7)->nullable(); // Geolocation latitude
            $table->decimal('longitude', 10, 7)->nullable(); // Geolocation longitude
            $table->string('country')->nullable(); // Country
            $table->string('state')->nullable(); // State or region
            $table->string('city')->nullable(); // City
            $table->string('social_links')->nullable(); // Social media links (JSON or comma-separated)
            $table->timestamps();

            $table->foreignId('user_id')->default(1)->unique()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('pharmacy_id')->nullable()->constrained('pharmacies')->onUpdate('cascade')->onDelete('cascade');
            // $table->foreignId('pharmacy_id')->default(1)->nullable()->constrained('pharmacies')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};

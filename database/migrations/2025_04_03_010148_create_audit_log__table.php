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
        Schema::create('audit_log_', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('profile_id')->default(1);
            $table->string('action');
            $table->string('table_name');
            $table->string('record_id');
            $table->timestamp('timestamp')->useCurrent();

            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_log_');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
        CREATE OR REPLACE VIEW prescription_vw AS
        SELECT
            prescriptions.id,
            prescriptions.profile_id AS profile_id,
            profiles.fullname AS profile_name,
            prescriptions.unique_name,
            prescriptions.image,
            prescriptions.status,
            prescriptions.medical_notes,
            prescriptions.created_at,
            prescriptions.updated_at
        FROM
            prescriptions
        JOIN
            profiles ON prescriptions.profile_id = profiles.id;
    ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescription_vw_view');
    }
};

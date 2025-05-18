<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
        CREATE OR REPLACE VIEW quotation_vw AS
SELECT 
    quotations.id AS quotation_id,
    quotations.prescription_id,
    quotations.unique_name AS name,
    prescriptions.unique_name AS prescription_unique_name,
    quotations.profile_id,
    profiles.fullname AS profile_name,
    quotations.pharmacy_id,
    pharmacies.name AS pharmacy_name,
    pharmacies.latitude As latitude,
    pharmacies.longitude As longitude,
    quotations.total_amount,
    quotations.status,
    quotations.valid_until,
    quotations.notes,
    quotations.created_at,
    quotations.updated_at
FROM 
    quotations
JOIN 
    prescriptions ON quotations.prescription_id = prescriptions.id
JOIN 
    profiles ON quotations.profile_id = profiles.id
JOIN 
    pharmacies ON quotations.pharmacy_id = pharmacies.id;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotation_vw_view');
    }
};

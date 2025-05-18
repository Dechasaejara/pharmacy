<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
        CREATE OR REPLACE VIEW transaction_vw AS
        SELECT 
            transactions.id AS transaction_id,
            transactions.quotation_id,
            quotations.prescription_id,
            quotations.unique_name AS quotation_unique_name,
            prescriptions.unique_name AS prescription_unique_name,
            transactions.profile_id,
            profiles.fullname AS profile_name,
            transactions.pharmacy_id,
            pharmacies.name AS pharmacy_name,
            transactions.total_amount,
            transactions.status,
            transactions.completed_at,
            transactions.created_at,
            transactions.updated_at
        FROM 
            transactions
        JOIN 
            quotations ON transactions.quotation_id = quotations.id
        JOIN 
            prescriptions ON quotations.prescription_id = prescriptions.id
        JOIN 
            profiles ON transactions.profile_id = profiles.id
        JOIN 
            pharmacies ON transactions.pharmacy_id = pharmacies.id;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS transaction_vw");
    }
};
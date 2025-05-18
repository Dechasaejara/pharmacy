<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescriptionVw extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'prescription_vw'; // Explicitly set the table name to the view name

    /**
     * Indicates if the model should be timestamped.
     *
     * If your view doesn't have created_at and updated_at columns managed by Eloquent,
     * or if you don't want Eloquent to try to update them (views are generally not directly updatable
     * in the same way as tables), set this to false.
     * However, since your view SELECTS created_at and updated_at from the prescriptions table,
     * you might keep this true if you only intend to read from the view.
     * For read-only views, it's often safer to set it to false.
     *
     * @var bool
     */
    public $timestamps = false; // Or true, depending on your use case

    /**
     * The primary key associated with the table.
     *
     * Views often don't have a single, auto-incrementing primary key in the same way tables do.
     * If your view has a unique column you can treat as a primary key for reading purposes,
     * you can specify it. Otherwise, you might set $primaryKey to null or a relevant unique ID.
     * If you don't set it, Eloquent will assume 'id'. Your view has 'prescription_id'.
     *
     * @var string
     */
    protected $primaryKey = 'id'; // Example if prescription_id is unique and acts as a key

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * Typically false for views.
     *
     * @var bool
     */
    public $incrementing = false; // Views don't usually have auto-incrementing keys

    // You can define relationships here as well, if applicable,
    // treating the view like a regular table for read operations.
}

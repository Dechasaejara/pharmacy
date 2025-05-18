<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationVw extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'quotation_vw'; // Explicitly set the table name to the view name

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false; // Views are typically read-only, so timestamps are not updated

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'quotation_id'; // Set the primary key to the unique column in the view

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false; // Views don't usually have auto-incrementing keys
}
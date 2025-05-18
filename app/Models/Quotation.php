<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Quotation extends Model
{
    /** @use HasFactory<\Database\Factories\QuotationFactory> */
    use HasFactory;
    protected $fillable = [
        'prescription_id',
        // 'profile_id',
        // 'pharmacy_id',
        'total_amount',
        'status',
        'valid_until',
        'notes',
    ];
    protected static function boot()
    {
        parent::boot();

        // Generate unique_name before creating the record
        static::creating(function ($quotation) {
            $profile = Auth::user()->profile;
            $fullname = str_replace(' ', '_', $profile->fullname); // Replace spaces with underscores
            $timestamp = now()->format('YmdHis'); // e.g., "20231025143045"
            $quotation->unique_name = "q_{$fullname}_{$timestamp}";
        });
    }
    public function prescription(): BelongsTo
    {
        return $this->belongsTo(Prescription::class);
    }

    public function pharmacist(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }

    public function pharmacy(): BelongsTo
    {
        return $this->belongsTo(Pharmacy::class);
    }
}

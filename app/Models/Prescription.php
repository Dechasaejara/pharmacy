<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prescription extends Model
{
    /** @use HasFactory<\Database\Factories\PrescriptionFactory> */
    use HasFactory;
    protected $fillable = [
        'profile_id',
        'unique_name',
        'image',
        'status',
        'medical_notes'
    ];

    protected static function boot()
    {
        parent::boot();

        // Generate unique_name before creating the record
        static::creating(function ($prescription) {
            $timestamp = now()->format('YmdHis'); // e.g., "20231025143045"
            $prescription->unique_name = "pre_{$prescription->profile_id}_{$timestamp}";
        });
    }
    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }
}

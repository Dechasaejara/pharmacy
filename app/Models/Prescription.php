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
        'image',
        'status',
        'medical_notes',
        'issued_date',
    ];

    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }
}

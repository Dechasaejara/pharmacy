<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Profile extends Model
{
    /** @use HasFactory<\Database\Factories\ProfileFactory> */
    use HasFactory;
    protected $fillable = [
        'user_id',
        'bio',
        'picture',
        'role',
        'phone',
        'address',
        'date_of_birth',
        'gender',
        'latitude',
        'longitude',
        'country',
        'state',
        'city',
    ];
    public function prescriptions(): HasMany
    {
        return $this->hasMany(Prescription::class);
    }
    public function quotations(): HasMany
    {
        return $this->hasMany(Quotation::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

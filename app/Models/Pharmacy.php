<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pharmacy extends Model
{
    /** @use HasFactory<\Database\Factories\PharmacyFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'license_number',
        'address',
        'picture',
        'phone',
        'email',
        'latitude',
        'longitude',
        'country',
        'state',
        'city',
    ];

    public function inventories(): HasMany
    {
        return $this->hasMany(Inventory::class);
    }

    public function quotations(): HasMany
    {
        return $this->hasMany(Quotation::class);
    }
    public function pharmacists(): HasMany
    {
        return $this->hasMany(Profile::class);
    }
}

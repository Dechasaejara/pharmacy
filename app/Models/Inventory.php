<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inventory extends Model
{
    /** @use HasFactory<\Database\Factories\InventoryFactory> */
    use HasFactory;
    protected $fillable = [
        'pharmacy_id',
        'product_id',
        'batch_number',
        'manufacturer',
        'expiry_date',
        'quantity',
        'unit_price',
        'tax',
        'storage_location',
        'is_active',
    ];

    public function pharmacy(): BelongsTo
    {
        return $this->belongsTo(Pharmacy::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}

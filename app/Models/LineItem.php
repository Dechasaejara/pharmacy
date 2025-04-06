<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LineItem extends Model
{
    /** @use HasFactory<\Database\Factories\LineItemFactory> */
    use HasFactory;
    protected $fillable = [
        'transaction_id',
        'inventory_id',
        'quantity',
        'unit_price',
        'subtotal',
        'instructions',
    ];

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    public function inventory(): BelongsTo
    {
        return $this->belongsTo(Inventory::class);
    }
}

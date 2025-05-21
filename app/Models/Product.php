<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    protected $fillable = [
        'generic_name',
        'brand_name',
        'description',
        'picture'
    ];
    public function inventories(): HasMany
    {
        return $this->hasMany(Inventory::class);
        // Laravel assumes the foreign key in the 'inventories' table is 'product_id'.
        // If your foreign key is named differently, specify it as the second argument:
        // return $this->hasMany(Inventory::class, 'your_product_foreign_key_name');
    }
}

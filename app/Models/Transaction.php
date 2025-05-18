<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    /** @use HasFactory<\Database\Factories\TransactionFactory> */
    use HasFactory;
    protected $fillable = [
        'quotation_id',
        // 'profile_id',
        // 'pharmacy_id',
        'total_amount',
        'status',
        'completed_at',
    ];
    public function line_items(): HasMany
    {
        return $this->hasMany(LineItem::class);
    }
    public function quotation(): BelongsTo
    {
        return $this->belongsTo(Quotation::class);
    }

    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }

    public function pharmacy(): BelongsTo
    {
        return $this->belongsTo(Pharmacy::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'review',
        'rating',
    ];

    protected static function booted()
    {
        static::creating(function ($product) {
            $product->user_id = Auth::id();
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}

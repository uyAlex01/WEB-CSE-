<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'date', 'location', 
        'price', 'image_url', 'category_id'
    ];

    protected $casts = [
        'date' => 'datetime',
        'price' => 'decimal:2'
    ];

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    // Scopes
    public function scopeUpcoming($query)
    {
        return $query->where('date', '>=', now());
    }

    public function scopeRecommendedFor($query, $userId)
    {
        return $query->with('category')
            ->upcoming()
            ->whereHas('category', function($q) use ($userId) {
                $q->whereIn('id', function($query) use ($userId) {
                    $query->select('category_id')
                        ->from('user_preferences')
                        ->where('user_id', $userId);
                });
            })
            ->orderBy('date')
            ->limit(4);
    }

    // Helper method to check if event is available for booking
    public function isAvailable()
    {
        return $this->date > now();
    }
}
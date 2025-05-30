<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    protected $fillable = ['user_id', 'event_id', 'quantity'];

    /**
     * Relationship to User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship to Event
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Add or update item in cart
     */
    public static function add(Event $event, int $quantity = 1): Cart
    {
        $userId = auth()->id();
        
        return static::updateOrCreate(
            [
                'user_id' => $userId,
                'event_id' => $event->id
            ],
            [
                'quantity' => \DB::raw("quantity + {$quantity}")
            ]
        );
    }

    /**
     * Get cart items for current user
     */
    public static function getCartItems()
    {
        if (auth()->check()) {
            return static::with('event')
                ->where('user_id', auth()->id())
                ->get();
        }
        
        return collect();
    }

    /**
     * Calculate cart subtotal
     */
    public static function getSubtotal()
    {
        return static::getCartItems()->sum(function ($item) {
            return $item->event->price * $item->quantity;
        });
    }

    /**
     * Remove item from cart
     */
    public static function removeItem(int $eventId): bool
    {
        return static::where('user_id', auth()->id())
            ->where('event_id', $eventId)
            ->delete();
    }

    /**
     * Clear user's cart
     */
    public static function clearCart(): int
    {
        return static::where('user_id', auth()->id())->delete();
    }
}
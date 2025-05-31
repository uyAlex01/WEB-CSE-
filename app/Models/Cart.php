<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        return $this->belongsTo(Event::class)->withTrashed();
    }

    /**
     * Add or update item in cart
     *
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     */
    public static function add(Event $event, int $quantity = 1): Cart
    {
        if (!Auth::check()) {
            throw new \RuntimeException('User must be authenticated to add to cart');
        }

        if (!$event->exists) {
            throw new \InvalidArgumentException('Event must be saved before adding to cart');
        }

        if ($event->trashed()) {
            throw new \RuntimeException('Cannot add deleted event to cart');
        }

        if ($quantity < 1) {
            throw new \InvalidArgumentException('Quantity must be at least 1');
        }

        $userId = Auth::id();
        
        return static::updateOrCreate(
            ['user_id' => $userId, 'event_id' => $event->id],
            ['quantity' => DB::raw("quantity + {$quantity}")]
        );
    }

    /**
     * Get cart items for current user with optimized query
     */
    public static function getCartItems()
    {
        if (!Auth::check()) {
            return collect();
        }

        return static::with(['event' => function($query) {
                $query->select('id', 'name', 'price', 'date', 'location', 'image_url');
            }])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Calculate cart subtotal with validation
     */
    public static function getSubtotal(): float
    {
        return static::getCartItems()->sum(function ($item) {
            if (!$item->event) {
                // Auto-remove invalid cart items
                static::removeItem($item->event_id);
                return 0;
            }
            return $item->event->price * $item->quantity;
        });
    }

    /**
     * Remove item from cart
     */
    public static function removeItem(int $eventId): bool
    {
        if (!Auth::check()) {
            return false;
        }

        return (bool) static::where('user_id', Auth::id())
            ->where('event_id', $eventId)
            ->delete();
    }

    /**
     * Clear user's cart
     */
    public static function clearCart(): int
    {
        if (!Auth::check()) {
            return 0;
        }

        return static::where('user_id', Auth::id())->delete();
    }

    /**
     * Update cart item quantity with validation
     */
    public static function updateQuantity(int $eventId, int $newQuantity): bool
    {
        if (!Auth::check()) {
            return false;
        }

        if ($newQuantity < 1) {
            return static::removeItem($eventId);
        }

        return (bool) static::where('user_id', Auth::id())
            ->where('event_id', $eventId)
            ->update(['quantity' => $newQuantity]);
    }

    /**
     * Get cart item count for current user
     */
    public static function getItemCount(): int
    {
        if (!Auth::check()) {
            return 0;
        }

        return static::where('user_id', Auth::id())->count();
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Add an event to the user's cart.
     */
    public function addToCart(Request $request)
{
    $validated = $request->validate([
        'event_id' => 'required|exists:events,id',
        'quantity' => 'required|integer|min:1|max:10'
    ]);

    $event = Event::findOrFail($request->event_id);

    // Check ticket availability
    if ($event->available_tickets < $request->quantity) {
        return back()->with('error', 'Not enough tickets available!');
    }

    // Add to cart (for authenticated users)
    if (Auth::check()) {
        $cartItem = Cart::updateOrCreate(
            ['user_id' => Auth::id(), 'event_id' => $event->id],
            ['quantity' => \DB::raw("quantity + {$request->quantity}")]
        );
    } 
    // For guests (store in session)
    else {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$event->id])) {
            $cart[$event->id]['quantity'] += $request->quantity;
        } else {
            $cart[$event->id] = [
                "event_id" => $event->id,
                "name" => $event->name,
                "price" => $event->price,
                "quantity" => $request->quantity,
                "image" => $event->image
            ];
        }
        
        session()->put('cart', $cart);
    }

    return redirect()->route('cart.view')->with('success', 'Event added to cart!');
}

    /**
     * Show the cart page with all items.
     */
    public function viewCart()
{
    $cartItems = [];
    $subtotal = 0;

    // For authenticated users
    if (Auth::check()) {
        $cartItems = Auth::user()->carts()->with('event')->get();
        $subtotal = $cartItems->sum(function($item) {
            return $item->event->price * $item->quantity;
        });
    } 
    // For guests
    else {
        $cart = session()->get('cart', []);
        foreach ($cart as $id => $details) {
            $event = Event::find($id);
            if ($event) {
                $cartItems[] = (object)[
                    'event' => $event,
                    'quantity' => $details['quantity']
                ];
                $subtotal += $event->price * $details['quantity'];
            }
        }
    }

    $serviceFee = max(100, $subtotal * 0.1); // 10% or min 100
    $total = $subtotal + $serviceFee;

    return view('pages.cart', [
    'total' => '₱' . number_format($total, 2)
]);

}

    /**
     * Remove a single event from the cart.
     */
    public function removeFromCart($eventId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        Auth::user()->carts()->where('event_id', $eventId)->delete();

        return back()->with('success', 'Event removed from cart!');
    }

    /**
     * Clear the user's entire cart.
     */
    public function clearCart()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        Auth::user()->carts()->delete();

        return back()->with('success', 'Cart cleared!');
    }
}
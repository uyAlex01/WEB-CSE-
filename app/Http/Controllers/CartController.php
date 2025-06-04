<?php
// app/Http/Controllers/CartController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function viewcart()
    {
        $cartItems = session()->get('cart', []);
        
        // Calculate totals
        $subtotal = $this->calculateSubtotal($cartItems);
        $serviceFee = $this->calculateServiceFee($subtotal);
        $total = $subtotal + $serviceFee;
        
        return view('pages.cart', [
            'cartItems' => $cartItems,
            'subtotal' => $this->formatPrice($subtotal),
            'serviceFee' => $this->formatPrice($serviceFee),
            'total' => $this->formatPrice($total)
        ]);
    }
    
    public function addToCart(Request $request)
    {
        $eventId = $request->input('event_id');
        $event = $this->getEventData($eventId);
        
        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Event not found',
                'cart_count' => count(session('cart', []))
            ]);
        }
        
        $cart = session()->get('cart', []);
        
        // Check if item already exists in cart
        if (isset($cart[$eventId])) {
            return response()->json([
                'success' => false,
                'message' => 'This event is already in your cart',
                'cart_count' => count($cart)
            ]);
        }
        
        // Add new item to cart
        $cart[$eventId] = [
            'id' => $event['id'],
            'title' => $event['title'],
            'price' => $event['price_php'],
            'image' => $event['image'],
            'dates' => $event['dates'],
            'venue' => $event['venue']
        ];
        
        session()->put('cart', $cart);
        
        return response()->json([
            'success' => true,
            'message' => 'Event added to cart!',
            'cart_count' => count($cart)
        ]);
    }
    
    public function removeFromCart(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        
        return redirect('/cart')->with('success', 'Item removed from cart');
    }
    
    // Helper methods
    private function calculateSubtotal($items)
    {
        $subtotal = 0;
        foreach ($items as $item) {
            $priceStr = $item['price'];
            $price = (float)preg_replace('/[^0-9.]/', '', explode('-', $priceStr)[0]);
            $subtotal += $price;
        }
        return $subtotal;
    }
    
    private function calculateServiceFee($subtotal)
    {
        return $subtotal * 0.1; // 10% service fee
    }
    
    private function formatPrice($amount)
    {
        return '₱' . number_format($amount, 2);
    }
    
    private function getEventData($id)
    {
        $events = [
            // Your events array from browse.blade.php
        ];
        
        return collect($events)->firstWhere('id', $id);
    }
}
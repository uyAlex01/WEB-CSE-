@extends('layouts.app')

@push('styles')
    <style>
        :root {
            --electric-violet: #8F00FF;
            --neon-aqua: #00F6FF;
            --platinum-gray: #E5E5E5;
            --jet-black: #121212;
            --jet-black-light: #1E1E1E;
            --dashboard-bg-dark: #121212;
        }

        .cart-page {
            background: var(--dashboard-bg-dark);
            color: var(--platinum-gray);
            padding: 5rem 0;
            min-height: 100vh;
        }

        .cart-container {
            background: var(--jet-black-light);
            border-radius: 1rem;
            padding: 2rem;
            border: 1px solid #333;
        }

        .cart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            border-bottom: 1px solid #333;
            padding-bottom: 1rem;
        }

        .cart-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--electric-violet);
        }

        .cart-items {
            margin-bottom: 2rem;
        }

        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem 0;
            border-bottom: 1px solid #333;
        }

        .cart-item-info {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .cart-item-image {
            width: 80px;
            height: 80px;
            border-radius: 0.5rem;
            background: var(--jet-black);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .cart-item-details {
            flex-grow: 1;
        }

        .cart-item-title {
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .cart-item-price {
            color: var(--neon-aqua);
            font-weight: bold;
        }

        .cart-item-remove {
            color: var(--sunset-coral);
            cursor: pointer;
            transition: color 0.3s;
        }

        .cart-item-remove:hover {
            color: #ff2d6d;
        }

        .cart-summary {
            background: var(--jet-black);
            padding: 1.5rem;
            border-radius: 0.75rem;
            border: 1px solid #333;
        }

        .cart-summary-title {
            font-size: 1.25rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
            color: var(--electric-violet);
        }

        .cart-summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .cart-total {
            font-size: 1.25rem;
            font-weight: bold;
            color: var(--neon-aqua);
        }

        .checkout-btn {
            width: 100%;
            background: var(--electric-violet);
            color: white;
            padding: 1rem;
            border-radius: 0.5rem;
            font-weight: bold;
            text-align: center;
            transition: background 0.3s;
            margin-top: 1.5rem;
        }

        .checkout-btn:hover {
            background: #7A00D9;
        }

        .empty-cart {
            text-align: center;
            padding: 3rem 0;
        }

        .empty-cart-icon {
            font-size: 3rem;
            color: var(--electric-violet);
            margin-bottom: 1rem;
        }

        .empty-cart-text {
            font-size: 1.25rem;
            margin-bottom: 1.5rem;
        }

        .browse-link {
            color: var(--neon-aqua);
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
        }

        .browse-link:hover {
            color: var(--electric-violet);
            text-decoration: underline;
        }
    </style>
@endpush

@section('content')
    <div class="cart-page">
        <div class="container mx-auto px-4">
            <div class="cart-container">
                <div class="cart-header">
                    <h1 class="cart-title">Your Cart</h1>
                    <span class="text-sm">{{ count($cartItems ?? []) }} item(s)</span>
                </div>

                {{-- ✅ Use safe fallback to avoid error --}}
                @if(!empty($cartItems))
                    <div class="cart-items">
                        @foreach($cartItems as $item)
                            <div class="cart-item" data-item-id="{{ $item['id'] }}">
                                <div class="cart-item-info">
                                    <div class="cart-item-image">
                                        @if(isset($item['image']) && $item['image'])
                                            <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}"
                                                class="w-full h-full object-cover">
                                        @else
                                            <span class="text-gray-500">No Image</span>
                                        @endif
                                    </div>
                                    <div class="cart-item-details">
                                        <h3 class="cart-item-title">{{ $item['title'] }}</h3>
                                        <span class="cart-item-price">{{ $item['price'] }}</span>
                                    </div>
                                </div>
                                <button class="cart-item-remove remove-from-cart" data-item-id="{{ $item['id'] }}">
                                    Remove
                                </button>
                            </div>
                        @endforeach
                    </div>

                    <div class="cart-summary">
                        <h2 class="cart-summary-title">Order Summary</h2>

                        <div class="cart-summary-row">
                            <span>Subtotal</span>
                            <span>{{ $subtotal }}</span>
                        </div>

                        <div class="cart-summary-row">
                            <span>Service Fee</span>
                            <span>{{ $serviceFee }}</span>
                        </div>

                        <div class="cart-summary-row cart-total">
                            <span>Total</span>
                            <span>{{ $total }}</span>
                        </div>

                        <a href="{{ route('checkout') }}" class="checkout-btn">Proceed to Checkout</a>
                    </div>
                @else
                    <div class="empty-cart">
                        <div class="empty-cart-icon">
                            <i class="bi bi-cart-x"></i>
                        </div>
                        <h2 class="empty-cart-text">Your cart is empty</h2>
                        <a href="{{ route('events.browse') }}" class="browse-link">
                            Browse Events
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Remove item from cart
            document.querySelectorAll('.remove-from-cart').forEach(button => {
                button.addEventListener('click', function () {
                    const itemId = this.getAttribute('data-item-id');
                    removeFromCart(itemId);
                });
            });

            function removeFromCart(itemId) {
                // Get current cart from localStorage
                let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];

                // Filter out the item to remove
                const updatedCart = cartItems.filter(item => item.id != itemId);

                // Update localStorage
                localStorage.setItem('cartItems', JSON.stringify(updatedCart));

                // Remove the item from the DOM
                document.querySelector(`.cart-item[data-item-id="${itemId}"]`).remove();

                // Update cart count in navbar
                updateCartCount();

                // Reload the page to update totals
                location.reload();
            }

            function updateCartCount() {
                const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
                const cartBadge = document.querySelector('.cart-badge');
                if (cartBadge) {
                    cartBadge.textContent = cartItems.length;
                }
            }
        });
    </script>
@endpush
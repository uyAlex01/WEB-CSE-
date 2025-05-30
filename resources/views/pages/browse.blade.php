@extends('layouts.app')

@push('styles')
    <style>
        /* Color variables - scoped to this page only */
        :root {
            --electric-violet: #8F00FF;
            --neon-aqua: #00F6FF;
            --platinum-gray: #E5E5E5;
            --jet-black: #121212;
            --jet-black-light: #1E1E1E;
            --sunset-coral: #FF4F81;
            --dashboard-bg-dark: #121212;
        }

        body {
            background: var(--dashboard-bg-dark);
            color: var(--platinum-gray);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        /* Main content container */
        .browse-page {
            background: var(--dashboard-bg-dark);
            color: var(--platinum-gray);
            padding: 5rem 0;
            min-height: 100vh;
        }

        /* Typography */
        .browse-highlight {
            color: var(--electric-violet);
        }

        .browse-subtext {
            color: rgba(229, 229, 229, 0.8);
        }

        /* Stats grid */
        .browse-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .browse-stat-card {
            background: var(--jet-black-light);
            border: 1px solid #333;
            padding: 1rem;
            border-radius: 1rem;
        }

        /* Events grid */
        .browse-events-container {
            background: var(--jet-black-light);
            padding: 1.5rem;
            border-radius: 1rem;
            border: 1px solid #333;
        }

        .browse-events-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }

        .browse-event-card {
            border: 1px solid #333;
            border-radius: 1rem;
            overflow: hidden;
            transition: all 0.3s ease;
            background: var(--jet-black);
        }

        .browse-event-card:hover {
            border-color: var(--neon-aqua);
            transform: translateY(-5px);
        }

        .browse-event-img-container {
            height: 12rem;
            overflow: hidden;
            position: relative;
        }

        .browse-event-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }

        .browse-event-card:hover .browse-event-img {
            transform: scale(1.05);
        }

        .browse-event-tag {
            position: absolute;
            bottom: 0.5rem;
            left: 0.5rem;
            background: var(--electric-violet);
            color: white;
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
        }

        .browse-event-content {
            padding: 1rem;
        }

        .browse-event-title {
            font-weight: bold;
            margin-bottom: 0.5rem;
            transition: color 0.3s;
        }

        .browse-event-card:hover .browse-event-title {
            color: var(--neon-aqua);
        }

        .browse-event-meta {
            color: #999;
            font-size: 0.875rem;
            margin-bottom: 0.75rem;
        }

        .browse-event-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1rem;
        }

        .browse-event-price {
            color: var(--neon-aqua);
            font-weight: bold;
        }

        .browse-event-button {
            background: var(--electric-violet);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
        }

        .browse-event-button:hover {
            background: #7A00D9;
            transform: scale(1.05);
        }

        .browse-event-button.added {
            background: var(--neon-aqua);
            color: black;
        }

        .browse-header {
            text-align: center;
            margin-bottom: 2rem;
            padding: 0 1rem;
        }

        /* Toast notification */
        .toast-notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: var(--electric-violet);
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            z-index: 1000;
            transform: translateY(100px);
            opacity: 0;
            transition: all 0.3s ease;
        }

        .toast-notification.show {
            transform: translateY(0);
            opacity: 1;
        }
    </style>
@endpush

@section('content')
    <div class="browse-page">
        <div class="container mx-auto px-4">
            <div class="container mx-auto px-4">
                <!-- Centered Header -->
                <header class="browse-header">
                    <h1 class="text-2xl md:text-3xl font-bold">Discover <span class="browse-highlight">Electric
                            Experiences</span></h1>
                    <p class="browse-subtext mt-2">Find the hottest music events in Asia for 2025</p>
                </header>

                <!-- Stats Cards -->
                <div class="browse-stats">
                    <div class="browse-stat-card">
                        <p class="text-sm text-[#999]">Events Found</p>
                        <p class="text-xl font-bold">6</p>
                    </div>
                    <div class="browse-stat-card">
                        <p class="text-sm text-[#999]">Countries Covered</p>
                        <p class="text-xl font-bold">6</p>
                    </div>
                    <div class="browse-stat-card">
                        <p class="text-sm text-[#999]">Price Range</p>
                        <p class="text-xl font-bold">₱1,800 – ₱23,800</p>
                    </div>
                    <div class="browse-stat-card">
                        <p class="text-sm text-[#999]">New This Year</p>
                        <p class="text-xl font-bold">6</p>
                    </div>
                </div>

                <!-- Events Grid -->
                <div class="browse-events-container">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold">Upcoming Music Events in Asia</h2>
                    </div>

                    <div class="browse-events-grid">
                        @php
                            $events = [
                                [
                                    'id' => 1,
                                    'title' => 'One Love Asia 2025',
                                    'dates' => 'October 4-5, 2025',
                                    'venue' => 'The Meadows, Gardens by the Bay, Singapore',
                                    'category' => 'Festival',
                                    'price_php' => '₱8,100 - ₱23,800',
                                    'details' => 'A celebration of Asian culture, unity, and diversity featuring artists like Eric Zhou, Benjamin Kheng, and JJ Lin.',
                                    'image' => asset('images/images.jpg'),
                                ],
                                [
                                    'id' => 2,
                                    'title' => 'Shillong Cherry Blossom Festival',
                                    'dates' => 'November 2025 (Exact dates TBA)',
                                    'venue' => 'Shillong, Meghalaya, India',
                                    'category' => 'Festival',
                                    'price_php' => 'Free / Varies',
                                    'details' => 'Annual cultural event with performances by Akon, R3HAB, and Ne-Yo during cherry blossom season.',
                                    'image' => null,
                                ],
                                [
                                    'id' => 3,
                                    'title' => 'Rolling Loud Thailand 2025',
                                    'dates' => 'November 14-16, 2025',
                                    'venue' => 'TBA, Thailand',
                                    'category' => 'Hip-Hop Festival',
                                    'price_php' => '₱10,000',
                                    'details' => 'Renowned hip-hop festival featuring international and regional artists.',
                                    'image' => null,
                                ],
                                [
                                    'id' => 4,
                                    'title' => 'Round Festival 2025',
                                    'dates' => 'June 21-22, 2025',
                                    'venue' => 'Zepp Kuala Lumpur, Malaysia',
                                    'category' => 'Music Festival',
                                    'price_php' => '₱1,800',
                                    'details' => 'Promoting cultural exchanges between Korea and ASEAN countries through popular music.',
                                    'image' => null,
                                ],
                                [
                                    'id' => 5,
                                    'title' => 'Equation Festival 2025',
                                    'dates' => 'April 4-6, 2025',
                                    'venue' => 'Mo Luong Cave, Mai Chau, Vietnam',
                                    'category' => 'Electronic Music',
                                    'price_php' => 'Free / Varies',
                                    'details' => 'Immersive electronic music experience set in a stunning cave environment.',
                                    'image' => null,
                                ],
                                [
                                    'id' => 6,
                                    'title' => 'Nano-Mugen Festival 2025',
                                    'dates' => 'May 24-25 (Jakarta) & May 31-June 1 (Yokohama)',
                                    'venue' => 'Ecopark Ancol, Jakarta & K-Arena Yokohama, Japan',
                                    'category' => 'Rock Festival',
                                    'price_php' => '₱3,400',
                                    'details' => 'Revival of the iconic festival featuring international and local rock acts.',
                                    'image' => null,
                                ],
                            ];
                        @endphp

                        @foreach($events as $event)
                            <div class="browse-event-card">
                                <div class="browse-event-img-container">
                                    @if ($event['image'])
                                        <img src="{{ $event['image'] }}" alt="{{ $event['title'] }}" class="browse-event-img">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-gray-800 text-gray-500">
                                            <span>No Image Available</span>
                                        </div>
                                    @endif
                                    <span class="browse-event-tag">{{ $event['category'] }}</span>
                                </div>
                                <div class="browse-event-content">
                                    <h3 class="browse-event-title">{{ $event['title'] }}</h3>
                                    <p class="browse-event-meta">{{ $event['dates'] }}</p>
                                    <p class="text-sm mb-3">{{ $event['details'] }}</p>
                                    <p class="text-sm text-gray-400"><strong>Venue:</strong> {{ $event['venue'] }}</p>
                                    <div class="browse-event-footer">
                                        <span class="browse-event-price">{{ $event['price_php'] }}</span>
                                        <button class="browse-event-button add-to-cart" data-event-id="{{ $event['id'] }}"
                                            data-event-title="{{ $event['title'] }}"
                                            data-event-price="{{ $event['price_php'] }}">
                                            Add to Cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div class="toast-notification" id="toastNotification">
        Event added to cart!
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Add to cart functionality
            const addToCartButtons = document.querySelectorAll('.add-to-cart');
            const toastNotification = document.getElementById('toastNotification');

            // Cart items array (in a real app, this would be managed by your backend)
            let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];

            addToCartButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const eventId = this.getAttribute('data-event-id');
                    const eventTitle = this.getAttribute('data-event-title');
                    const eventPrice = this.getAttribute('data-event-price');

                    // Check if item is already in cart
                    const existingItem = cartItems.find(item => item.id === eventId);

                    if (!existingItem) {
                        // Add to cart
                        cartItems.push({
                            id: eventId,
                            title: eventTitle,
                            price: eventPrice,
                            quantity: 1
                        });

                        // Update localStorage
                        localStorage.setItem('cartItems', JSON.stringify(cartItems));

                        // Update button state
                        this.textContent = 'Added to Cart';
                        this.classList.add('added');

                        // Show notification
                        showToast('Event added to cart!');

                        // Update cart count in navbar (if exists)
                        updateCartCount();
                    } else {
                        showToast('This event is already in your cart');
                    }
                });
            });

            // Function to show toast notification
            function showToast(message) {
                toastNotification.textContent = message;
                toastNotification.classList.add('show');

                setTimeout(() => {
                    toastNotification.classList.remove('show');
                }, 3000);
            }

            // Function to update cart count in navbar
            function updateCartCount() {
                const cartBadge = document.querySelector('.cart-badge');
                if (cartBadge) {
                    cartBadge.textContent = cartItems.length;
                }
            }

            // Initialize cart count on page load
            updateCartCount();
        });
    </script>
@endpush
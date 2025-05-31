@extends('layouts.app')

@push('styles')
    <style>
        /* Rhythmx Color Palette */
        :root {
            --electric-violet: #8F00FF;
            /* Primary brand color */
            --jet-black: #121212;
            /* Background and dark elements */
            --neon-aqua: #00F6FF;
            /* Highlights and CTAs */
            --platinum-gray: #E5E5E5;
            /* Body text and light UI */
            --sunset-coral: #FF4F81;
            /* Accent color */
            --jet-black-light: rgba(30, 30, 30, 0.8);
            /* Slightly lighter dark background */
        }

        /* Base Styles */
        body {
            background: var(--jet-black);
            color: var(--platinum-gray);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        .browse-page {
            background: var(--jet-black);
            padding: 5rem 0;
            min-height: 100vh;
        }

        /* Header */
        .browse-header {
            text-align: center;
            margin-bottom: 2rem;
            padding: 0 1rem;
        }

        .browse-highlight {
            color: var(--electric-violet);
        }

        .browse-subtext {
            color: rgba(229, 229, 229, 0.8);
        }

        /* Stats Cards */
        .browse-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .browse-stat-card {
            background: var(--jet-black-light);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 1rem;
            border-radius: 1rem;
            transition: all 0.3s ease;
        }

        .browse-stat-card:hover {
            border-color: var(--electric-violet);
        }

        /* Filter Container */
        .filter-container {
            background: var(--jet-black-light);
            padding: 1.5rem;
            border-radius: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .filter-controls {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .filter-group {
            position: relative;
            min-width: 200px;
        }

        .filter-control {
            background: var(--jet-black-light);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--platinum-gray);
            padding: 0.5rem 2.5rem 0.5rem 1rem;
            border-radius: 0.5rem;
            width: 100%;
            font-size: 0.875rem;
            transition: all 0.3s ease;
            appearance: none;
            cursor: pointer;
        }

        .filter-control:hover {
            border-color: var(--electric-violet);
        }

        .filter-control:focus {
            border-color: var(--electric-violet);
            outline: none;
            box-shadow: 0 0 0 2px rgba(143, 0, 255, 0.3);
        }

        .filter-icon {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            color: var(--platinum-gray);
            opacity: 0.7;
        }

        /* Events Container */
        .browse-events-container {
            background: var(--jet-black-light);
            padding: 1.5rem;
            border-radius: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .browse-events-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }

        /* Event Cards */
        .browse-event-card {
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 1rem;
            overflow: hidden;
            transition: all 0.3s ease;
            background: var(--jet-black);
        }

        .browse-event-card:hover {
            border-color: var(--neon-aqua);
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 246, 255, 0.1);
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
            font-weight: bold;
        }

        .browse-event-content {
            padding: 1rem;
        }

        .browse-event-title {
            font-weight: bold;
            margin-bottom: 0.5rem;
            transition: color 0.3s;
            color: var(--platinum-gray);
        }

        .browse-event-card:hover .browse-event-title {
            color: var(--neon-aqua);
        }

        .browse-event-meta {
            color: rgba(229, 229, 229, 0.7);
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
            font-weight: bold;
        }

        .browse-event-button:hover {
            background: #7A00D9;
            transform: scale(1.05);
            box-shadow: 0 0 15px rgba(143, 0, 255, 0.5);
        }

        .browse-event-button.added {
            background: var(--neon-aqua);
            color: var(--jet-black);
        }

        /* Month Separator */
        .month-separator {
            grid-column: 1 / -1;
            margin: 2rem 0 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--electric-violet);
            font-size: 1.25rem;
            font-weight: bold;
            color: var(--platinum-gray);
            text-shadow: 0 0 10px rgba(143, 0, 255, 0.3);
        }

        /* Toast Notification */
        .toast-notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: var(--electric-violet);
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(143, 0, 255, 0.3);
            z-index: 1000;
            transform: translateY(100px);
            opacity: 0;
            transition: all 0.3s ease;
            font-weight: bold;
        }

        .toast-notification.show {
            transform: translateY(0);
            opacity: 1;
        }

        /* Login Prompt */
        .login-prompt {
            color: var(--neon-aqua);
            font-size: 0.9rem;
            margin-top: 0.5rem;
            text-align: center;
        }

        .login-link {
            color: var(--electric-violet);
            text-decoration: underline;
            font-weight: bold;
            transition: color 0.3s;
        }

        .login-link:hover {
            color: var(--neon-aqua);
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .filter-container {
                flex-direction: column;
                align-items: flex-start;
            }

            .filter-controls {
                width: 100%;
                flex-direction: column;
                gap: 0.75rem;
            }

            .filter-group {
                width: 100%;
            }
        }
    </style>
@endpush

@section('content')
    <div class="browse-page">
        <div class="container mx-auto px-4">
            <!-- Header -->
            <header class="browse-header">
                <h1 class="text-2xl md:text-3xl font-bold">Discover <span class="browse-highlight">Electric
                        Experiences</span></h1>
                <p class="browse-subtext mt-2">Find the hottest music events in Asia for 2025</p>
            </header>

            <!-- Stats Cards -->
            <div class="browse-stats">
                <div class="browse-stat-card">
                    <p class="text-sm text-[#999]">Events Found</p>
                    <p class="text-xl font-bold" id="eventsCount">16</p>
                </div>
                <div class="browse-stat-card">
                    <p class="text-sm text-[#999]">Countries Covered</p>
                    <p class="text-xl font-bold" id="countriesCount">8</p>
                </div>
                <div class="browse-stat-card">
                    <p class="text-sm text-[#999]">Price Range</p>
                    <p class="text-xl font-bold" id="priceRange">Free – ₱23,800</p>
                </div>
                <div class="browse-stat-card">
                    <p class="text-sm text-[#999]">Categories</p>
                    <p class="text-xl font-bold" id="categoriesCount">16</p>
                </div>
            </div>

            <!-- Filter Container (now outside events container) -->
            <div class="filter-container">
                <h2 class="text-xl font-semibold">Upcoming Music Events in Asia</h2>

                <div class="filter-controls">
                    <div class="filter-group">
                        <select id="categoryFilter" class="filter-control">
                            <option value="">All Categories</option>
                            <option value="Concert">Concerts</option>
                            <option value="Music Festival">Music Festivals</option>
                            <option value="Battle of the Bands">Battle of the Bands</option>
                            <option value="Album Release Party">Album Release Parties</option>
                            <option value="DJ Set / Club Night">DJ Sets / Club Nights</option>
                            <option value="Orchestral Performance">Orchestral Performances</option>
                            <option value="Opera Show">Opera Shows</option>
                            <option value="Dance Party / Rave">Dance Parties / Raves</option>
                            <option value="Tribute Show">Tribute Shows</option>
                            <option value="Jazz Club / Jam Session">Jazz Clubs / Jam Sessions</option>
                            <option value="Acoustic Session">Acoustic Sessions</option>
                            <option value="Charity Benefit Concert">Charity Benefit Concerts</option>
                            <option value="Record Store Event">Record Store Events</option>
                            <option value="Music Award Ceremony">Music Award Ceremonies</option>
                        </select>
                        <div class="filter-icon">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </div>
                    </div>

                    <div class="filter-group">
                        <select id="priceFilter" class="filter-control">
                            <option value="">Any Price</option>
                            <option value="free">Free Events</option>
                            <option value="paid">Paid Events</option>
                            <option value="under5000">Under ₱5,000</option>
                            <option value="5000-10000">₱5,000 - ₱10,000</option>
                            <option value="over10000">Over ₱10,000</option>
                        </select>
                        <div class="filter-icon">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Events Container (without filters inside) -->
            <div class="browse-events-container">
                <div class="browse-events-grid" id="eventsGrid">
                    @php
                        $events = collect([
                            [
                                'id' => 1,
                                'title' => 'Equation Festival',
                                'dates' => 'April 4-6, 2025',
                                'venue' => 'Mo Luong Cave, Mai Chau, Vietnam',
                                'category' => 'Music Festival',
                                'price_php' => '₱3,500 - ₱5,200',
                                'details' => 'Immersive electronic music experience set in a stunning cave environment featuring top DJs from Asia and Europe.',
                                'image' => asset('images/equation-festival.jpg'),
                                'month' => 'April'
                            ],
                            [
                                'id' => 2,
                                'title' => 'Tokyo Jazz Festival',
                                'dates' => 'May 24-26, 2025',
                                'venue' => 'Tokyo International Forum, Japan',
                                'category' => 'Jazz Club / Jam Session',
                                'price_php' => '₱4,800 - ₱12,000',
                                'details' => 'Asia\'s premier jazz event featuring international jazz legends and emerging artists.',
                                'image' => asset('images/tokyo-jazz.jpg'),
                                'month' => 'May'
                            ],
                            [
                                'id' => 3,
                                'title' => 'Nano-Mugen Festival',
                                'dates' => 'May 31-June 1, 2025',
                                'venue' => 'K-Arena Yokohama, Japan',
                                'category' => 'Music Festival',
                                'price_php' => '₱3,400 - ₱6,800',
                                'details' => 'Revival of the iconic festival featuring international and local rock acts.',
                                'image' => asset('images/nano-mugen.jpg'),
                                'month' => 'May'
                            ],
                            [
                                'id' => 4,
                                'title' => 'Round Festival',
                                'dates' => 'June 21-22, 2025',
                                'venue' => 'Zepp Kuala Lumpur, Malaysia',
                                'category' => 'Music Festival',
                                'price_php' => '₱1,800 - ₱3,600',
                                'details' => 'Promoting cultural exchanges between Korea and ASEAN countries through popular music.',
                                'image' => asset('images/round-festival.jpg'),
                                'month' => 'June'
                            ],
                            [
                                'id' => 5,
                                'title' => 'Hong Kong Indie Fest',
                                'dates' => 'July 12-13, 2025',
                                'venue' => 'West Kowloon Cultural District, Hong Kong',
                                'category' => 'Battle of the Bands',
                                'price_php' => '₱2,500 - ₱4,500',
                                'details' => 'Showcasing the best independent bands from across Asia with competition elements.',
                                'image' => asset('images/hk-indie.jpg'),
                                'month' => 'July'
                            ],
                            [
                                'id' => 6,
                                'title' => 'Seoul Summer Symphony',
                                'dates' => 'August 8-10, 2025',
                                'venue' => 'Seoul Arts Center, South Korea',
                                'category' => 'Orchestral Performance',
                                'price_php' => '₱5,200 - ₱15,000',
                                'details' => 'Three nights of classical masterpieces performed by the Seoul Philharmonic Orchestra.',
                                'image' => asset('images/seoul-symphony.jpg'),
                                'month' => 'August'
                            ],
                            [
                                'id' => 7,
                                'title' => 'Bangkok Electronic Weekend',
                                'dates' => 'August 23-24, 2025',
                                'venue' => 'RCA, Bangkok, Thailand',
                                'category' => 'DJ Set / Club Night',
                                'price_php' => '₱2,800 - ₱4,200',
                                'details' => 'Non-stop electronic music across multiple venues featuring top regional DJs.',
                                'image' => asset('images/bangkok-electronic.jpg'),
                                'month' => 'August'
                            ],
                            [
                                'id' => 8,
                                'title' => 'One Love Asia',
                                'dates' => 'October 4-5, 2025',
                                'venue' => 'The Meadows, Gardens by the Bay, Singapore',
                                'category' => 'Music Festival',
                                'price_php' => '₱8,100 - ₱23,800',
                                'details' => 'A celebration of Asian culture, unity, and diversity featuring top artists.',
                                'image' => asset('images/one-love-asia.jpg'),
                                'month' => 'October'
                            ],
                            [
                                'id' => 9,
                                'title' => 'Manila Acoustic Nights',
                                'dates' => 'October 15-16, 2025',
                                'venue' => 'The Filinvest Tent, Manila, Philippines',
                                'category' => 'Acoustic Session',
                                'price_php' => '₱1,500 - ₱3,500',
                                'details' => 'Intimate performances by renowned acoustic artists from across the region.',
                                'image' => asset('images/manila-acoustic.jpg'),
                                'month' => 'October'
                            ],
                            [
                                'id' => 10,
                                'title' => 'Rolling Loud Thailand',
                                'dates' => 'November 14-16, 2025',
                                'venue' => 'Show DC, Bangkok, Thailand',
                                'category' => 'Music Festival',
                                'price_php' => '₱10,000 - ₱18,000',
                                'details' => 'Asia edition of the renowned hip-hop festival featuring international headliners.',
                                'image' => asset('images/rolling-loud.jpg'),
                                'month' => 'November'
                            ],
                            [
                                'id' => 11,
                                'title' => 'Shillong Cherry Blossom Festival',
                                'dates' => 'November 22-24, 2025',
                                'venue' => 'Shillong, Meghalaya, India',
                                'category' => 'Music Festival',
                                'price_php' => 'Free - ₱2,500',
                                'details' => 'Annual cultural event with performances during cherry blossom season.',
                                'image' => asset('images/shillong.jpg'),
                                'month' => 'November'
                            ],
                            [
                                'id' => 12,
                                'title' => 'Taipei Opera Gala',
                                'dates' => 'December 5-7, 2025',
                                'venue' => 'National Theater, Taipei, Taiwan',
                                'category' => 'Opera Show',
                                'price_php' => '₱6,500 - ₱12,800',
                                'details' => 'Spectacular performances of classic and contemporary operas.',
                                'image' => asset('images/taipei-opera.jpg'),
                                'month' => 'December'
                            ],
                            [
                                'id' => 13,
                                'title' => 'K-Pop Year-End Concert',
                                'dates' => 'December 20-21, 2025',
                                'venue' => 'Gocheok Sky Dome, Seoul, South Korea',
                                'category' => 'Concert',
                                'price_php' => '₱7,500 - ₱21,000',
                                'details' => 'Annual year-end celebration featuring top K-pop groups.',
                                'image' => asset('images/kpop-concert.jpg'),
                                'month' => 'December'
                            ],
                            [
                                'id' => 14,
                                'title' => 'New Year\'s Eve Rave',
                                'dates' => 'December 31, 2025',
                                'venue' => 'Zouk, Singapore',
                                'category' => 'Dance Party / Rave',
                                'price_php' => '₱4,500 - ₱8,500',
                                'details' => 'Countdown to the new year with non-stop electronic music.',
                                'image' => asset('images/nye-rave.jpg'),
                                'month' => 'December'
                            ],
                            [
                                'id' => 15,
                                'title' => 'The Beatles Tribute Night',
                                'dates' => 'January 10, 2026',
                                'venue' => 'Hard Rock Cafe, Hong Kong',
                                'category' => 'Tribute Show',
                                'price_php' => '₱2,200 - ₱3,800',
                                'details' => 'Celebrating the music of The Beatles with Asia\'s best tribute band.',
                                'image' => asset('images/beatles-tribute.jpg'),
                                'month' => 'January'
                            ],
                            [
                                'id' => 16,
                                'title' => 'Asian Music Awards',
                                'dates' => 'February 15, 2026',
                                'venue' => 'Marina Bay Sands, Singapore',
                                'category' => 'Music Award Ceremony',
                                'price_php' => '₱12,000 - ₱25,000',
                                'details' => 'The most prestigious music awards ceremony in Asia.',
                                'image' => asset('images/asian-awards.jpg'),
                                'month' => 'February'
                            ]
                        ])->sortBy(function ($event) {
                            // Create DateTime object for reliable date comparison
                            // We'll use the first date in the range for sorting
                            $dateString = preg_replace('/-.*,/', ',', $event['dates']);
                            return DateTime::createFromFormat('F j, Y', $dateString)->getTimestamp();
                        })->values()->all();

                        $currentMonth = '';
                        $currentYear = '';
                    @endphp

                    @foreach($events as $event)
                        @php
                            // Parse date using DateTime for accuracy
                            // We'll use the first date in the range for the separator
                            $dateString = preg_replace('/-.*,/', ',', $event['dates']);
                            $eventDate = DateTime::createFromFormat('F j, Y', $dateString);
                            $eventYear = $eventDate->format('Y');
                            $eventMonth = $eventDate->format('F');

                            if ($eventMonth != $currentMonth || $eventYear != $currentYear) {
                                $currentMonth = $eventMonth;
                                $currentYear = $eventYear;
                                $showSeparator = true;
                            } else {
                                $showSeparator = false;
                            }
                        @endphp

                        @if($showSeparator)
                            <div class="month-separator" data-month="{{ $currentMonth }}" data-year="{{ $currentYear }}">
                                {{ $currentMonth }} {{ $currentYear }}
                            </div>
                        @endif

                        <div class="browse-event-card" data-category="{{ $event['category'] }}"
                            data-price="{{ strpos($event['price_php'], 'Free') !== false ? 'free' : 'paid' }}"
                            data-price-range="{{ $event['price_php'] }}" data-month="{{ $currentMonth }}"
                            data-year="{{ $currentYear }}" data-venue="{{ $event['venue'] }}">

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
                                    @auth
                                        <button class="browse-event-button add-to-cart" data-event-id="{{ $event['id'] }}"
                                            data-event-title="{{ $event['title'] }}" data-event-price="{{ $event['price_php'] }}">
                                            Add to Cart
                                        </button>
                                    @else
                                        <div class="login-prompt">
                                            <a href="{{ route('login') }}" class="login-link">Login</a> to purchase tickets
                                        </div>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


    <!-- Toast Notification -->
    <div class="toast-notification" id="toastNotification">
        Event added to cart!
    </div>
    </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Cart functionality
                @auth
                                        const addToCartButtons = document.querySelectorAll('.add-to-cart');
                    const toastNotification = document.getElementById('toastNotification');
                    let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];

                    addToCartButtons.forEach(button => {
                        button.addEventListener('click', function () {
                            const eventId = this.getAttribute('data-event-id');
                            const eventTitle = this.getAttribute('data-event-title');
                            const eventPrice = this.getAttribute('data-event-price');

                            const existingItem = cartItems.find(item => item.id === eventId);

                            if (!existingItem) {
                                cartItems.push({
                                    id: eventId,
                                    title: eventTitle,
                                    price: eventPrice,
                                    quantity: 1
                                });

                                localStorage.setItem('cartItems', JSON.stringify(cartItems));
                                this.textContent = 'Added to Cart';
                                this.classList.add('added');
                                showToast('Event added to cart!');
                                updateCartCount();
                            } else {
                                showToast('This event is already in your cart');
                            }
                        });
                    });

                    function showToast(message) {
                        toastNotification.textContent = message;
                        toastNotification.classList.add('show');
                        setTimeout(() => {
                            toastNotification.classList.remove('show');
                        }, 3000);
                    }

                    function updateCartCount() {
                        const cartBadge = document.querySelector('.cart-badge');
                        if (cartBadge) {
                            cartBadge.textContent = cartItems.length;
                        }
                    }

                    updateCartCount();
                @endauth

                                // Filter functionality with stats update
                                const categoryFilter = document.getElementById('categoryFilter');
                const priceFilter = document.getElementById('priceFilter');
                const eventCards = document.querySelectorAll('.browse-event-card');
                const monthSeparators = document.querySelectorAll('.month-separator');

                // Initial stats calculation
                updateStats();

                function filterEvents() {
                    const categoryValue = categoryFilter.value;
                    const priceValue = priceFilter.value;
                    const visibleMonths = new Set();

                    eventCards.forEach(card => {
                        const cardCategory = card.getAttribute('data-category');
                        const cardPrice = card.getAttribute('data-price');
                        const cardPriceRange = card.getAttribute('data-price-range');
                        const cardMonth = card.getAttribute('data-month');

                        const categoryMatch = !categoryValue || cardCategory === categoryValue;

                        let priceMatch = true;
                        if (priceValue === 'free') {
                            priceMatch = cardPrice === 'free';
                        } else if (priceValue === 'paid') {
                            priceMatch = cardPrice === 'paid';
                        } else if (priceValue === 'under5000') {
                            const priceNum = parseFloat(cardPriceRange.replace(/[^\d.]/g, ''));
                            priceMatch = priceNum < 5000;
                        } else if (priceValue === '5000-10000') {
                            const priceNum = parseFloat(cardPriceRange.replace(/[^\d.]/g, ''));
                            priceMatch = priceNum >= 5000 && priceNum <= 10000;
                        } else if (priceValue === 'over10000') {
                            const priceNum = parseFloat(cardPriceRange.replace(/[^\d.]/g, ''));
                            priceMatch = priceNum > 10000;
                        }

                        if (categoryMatch && priceMatch) {
                            card.style.display = 'block';
                            visibleMonths.add(cardMonth);
                        } else {
                            card.style.display = 'none';
                        }
                    });

                    monthSeparators.forEach(separator => {
                        const month = separator.getAttribute('data-month');
                        if (visibleMonths.has(month)) {
                            separator.style.display = 'block';
                        } else {
                            separator.style.display = 'none';
                        }
                    });

                    // Update stats after filtering
                    updateStats();
                }

                function updateStats() {
                    const visibleEvents = document.querySelectorAll('.browse-event-card:not([style*="display: none"])');
                    const eventsCount = visibleEvents.length;

                    // Update events count
                    document.getElementById('eventsCount').textContent = eventsCount;

                    // Calculate countries
                    const countries = new Set();
                    visibleEvents.forEach(event => {
                        const venue = event.getAttribute('data-venue');
                        const countryMatch = venue.match(/(Vietnam|Japan|Malaysia|Hong Kong|South Korea|Thailand|Singapore|India|Taiwan|Philippines)/);
                        if (countryMatch) countries.add(countryMatch[0]);
                    });
                    document.getElementById('countriesCount').textContent = countries.size;

                    // Calculate price range
                    let minPrice = Infinity;
                    let maxPrice = 0;
                    let hasFree = false;

                    visibleEvents.forEach(event => {
                        const priceText = event.querySelector('.browse-event-price').textContent;

                        if (priceText.includes('Free')) {
                            hasFree = true;
                            minPrice = 0;
                        } else {
                            const prices = priceText.match(/\d+/g);
                            if (prices) {
                                const numericPrices = prices.map(price => parseInt(price.replace(/,/g, '')));
                                const eventMin = Math.min(...numericPrices);
                                const eventMax = Math.max(...numericPrices);

                                minPrice = Math.min(minPrice, eventMin);
                                maxPrice = Math.max(maxPrice, eventMax);
                            }
                        }
                    });

                    let priceRangeText = '';
                    if (hasFree && maxPrice > 0) {
                        priceRangeText = `Free – ₱${maxPrice.toLocaleString()}`;
                    } else if (hasFree) {
                        priceRangeText = 'Free';
                    } else if (minPrice !== Infinity) {
                        priceRangeText = `₱${minPrice.toLocaleString()} – ₱${maxPrice.toLocaleString()}`;
                    } else {
                        priceRangeText = 'N/A';
                    }
                    document.getElementById('priceRange').textContent = priceRangeText;

                    // Calculate categories
                    const categories = new Set();
                    visibleEvents.forEach(event => {
                        categories.add(event.getAttribute('data-category'));
                    });
                    document.getElementById('categoriesCount').textContent = categories.size;
                }

                // Set up event listeners
                categoryFilter.addEventListener('change', filterEvents);
                priceFilter.addEventListener('change', filterEvents);

                // Observe changes in the events grid (for when filters are applied)
                const observer = new MutationObserver(updateStats);
                const eventsGrid = document.getElementById('eventsGrid');
                if (eventsGrid) {
                    observer.observe(eventsGrid, {
                        childList: true,
                        subtree: true,
                        attributes: true,
                        attributeFilter: ['style']
                    });
                }

                // Also update when window is resized (in case of responsive changes)
                window.addEventListener('resize', updateStats);
            });
        </script>
    @endpush
@endsection
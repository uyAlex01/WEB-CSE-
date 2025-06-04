{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Dashboard - Rhythmx')

@push('styles')
    <style>
        :root {
            --electric-violet: #8F00FF;
            --jet-black: #121212;
            --neon-aqua: #00F6FF;
            --platinum-gray: #E5E5E5;
            --sunset-coral: #FF4F81;
            --dashboard-bg-light: #f5f5f5;
            --dashboard-bg-dark: #121212;
            --card-bg-light: #fff;
            --card-bg-dark: rgba(18, 18, 18, 0.92);
            --input-bg-light: #f5f5f5;
            --input-bg-dark: #232323;
            --border-light: #e5e5e5;
            --border-dark: rgba(143, 0, 255, 0.3);
            --text-main-light: #222;
            --text-main-dark: #E5E5E5;
            --text-muted-light: #666;
            --text-muted-dark: #bdbdbd;
        }

        body {
            background: var(--dashboard-bg-dark);
            color: var(--text-main-dark);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            transition: background 0.3s, color 0.3s;
        }

        .dashboard-container {
            background: transparent;
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
            min-height: 100vh;
            transition: background 0.3s;
        }

        /* Light theme override */
        html[data-bs-theme="light"] body {
            background: var(--dashboard-bg-light);
            color: var(--text-main-light);
        }

        html[data-bs-theme="light"] .dashboard-container {
            background: transparent;
        }

        /* Header Styles */
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding: 20px 0;
            border-bottom: 2px solid var(--electric-violet);
            background: transparent;
        }

        .welcome-message {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(45deg, var(--electric-violet), var(--neon-aqua));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .notification-icon:hover {
            background: rgba(143, 0, 255, 0.2);
            transform: scale(1.1);
        }

        .notification-badge {
            position: absolute;
            top: -2px;
            right: -2px;
            background: var(--sunset-coral);
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            font-weight: bold;
        }

        .user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(45deg, var(--electric-violet), var(--neon-aqua));
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.2rem;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .user-avatar:hover {
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(143, 0, 255, 0.5);
        }

        /* Loyalty Section */
        .loyalty-section {
            background: linear-gradient(135deg, rgba(143, 0, 255, 0.08), rgba(0, 246, 255, 0.08));
            border: 2px solid var(--electric-violet);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
            color: inherit;
            transition: background 0.3s, border 0.3s;
        }

        html[data-bs-theme="light"] .loyalty-section {
            background: linear-gradient(135deg, rgba(143, 0, 255, 0.04), rgba(0, 246, 255, 0.04));
            border: 2px solid var(--electric-violet);
        }

        .loyalty-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(0, 246, 255, 0.05), transparent);
            animation: rotate 8s linear infinite;
        }

        @keyframes rotate {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .loyalty-content {
            position: relative;
            z-index: 1;
        }

        .loyalty-title {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: var(--electric-violet);
        }

        .loyalty-points {
            font-size: 3.5rem;
            font-weight: 800;
            background: linear-gradient(45deg, var(--electric-violet), var(--neon-aqua));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 10px;
        }

        .progress-container {
            margin: 20px 0;
        }

        .progress-bar {
            width: 100%;
            height: 10px;
            background: rgba(229, 229, 229, 0.2);
            border-radius: 5px;
            overflow: hidden;
            margin: 10px 0;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--electric-violet), var(--neon-aqua));
            border-radius: 5px;
            animation: glow 2s ease-in-out infinite alternate;
            transition: width 0.8s ease;
        }

        @keyframes glow {
            from {
                box-shadow: 0 0 5px rgba(0, 246, 255, 0.5);
            }

            to {
                box-shadow: 0 0 20px rgba(0, 246, 255, 0.8), 0 0 30px rgba(143, 0, 255, 0.4);
            }
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: rgba(143, 0, 255, 0.08);
            border: 1px solid var(--border-dark);
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            cursor: pointer;
            color: inherit;
        }

        html[data-bs-theme="light"] .stat-card {
            background: rgba(143, 0, 255, 0.04);
            border: 1px solid var(--border-light);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(0, 246, 255, 0.1), transparent);
            transform: rotate(45deg);
            transition: all 0.6s ease;
            opacity: 0;
        }

        .stat-card:hover::before {
            opacity: 1;
            animation: shimmer 1.5s ease-in-out;
        }

        @keyframes shimmer {
            0% {
                transform: translateX(-100%) translateY(-100%) rotate(45deg);
            }

            100% {
                transform: translateX(100%) translateY(100%) rotate(45deg);
            }
        }

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(143, 0, 255, 0.3);
            border-color: var(--neon-aqua);
        }

        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
            display: block;
        }

        .stat-number {
            font-size: 2.8rem;
            font-weight: bold;
            color: var(--neon-aqua);
            margin-bottom: 8px;
            position: relative;
            z-index: 1;
        }

        .stat-label {
            font-size: 1.1rem;
            color: var(--platinum-gray);
            position: relative;
            z-index: 1;
        }

        /* Main Content Grid */
        .main-content {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        .content-card {
            background: var(--card-bg-dark);
            border: 1px solid var(--border-dark);
            border-radius: 15px;
            padding: 25px;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            color: inherit;
        }

        html[data-bs-theme="light"] .content-card {
            background: var(--card-bg-light);
            border: 1px solid var(--border-light);
            color: var(--text-main-light);
        }

        .content-card:hover {
            border-color: var(--neon-aqua);
            box-shadow: 0 5px 25px rgba(0, 246, 255, 0.1);
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 20px;
            color: var(--electric-violet);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Ticket Items */
        .ticket-list {
            max-height: 500px;
            overflow-y: auto;
        }

        .ticket-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 18px;
            margin-bottom: 15px;
            background: rgba(143, 0, 255, 0.05);
            border-radius: 12px;
            border-left: 4px solid var(--neon-aqua);
            transition: all 0.3s ease;
            cursor: pointer;
            color: inherit;
        }

        html[data-bs-theme="light"] .ticket-item {
            background: rgba(143, 0, 255, 0.025);
        }

        .ticket-item:hover {
            background: rgba(143, 0, 255, 0.12);
            transform: translateX(8px);
            border-left-color: var(--electric-violet);
        }

        .ticket-image {
            width: 65px;
            height: 65px;
            border-radius: 10px;
            background: linear-gradient(45deg, var(--electric-violet), var(--sunset-coral));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: white;
            flex-shrink: 0;
        }

        .ticket-info {
            flex-grow: 1;
        }

        .ticket-title {
            color: var(--platinum-gray);
            font-weight: 600;
            margin-bottom: 5px;
            font-size: 1.1rem;
        }

        .ticket-date {
            color: var(--neon-aqua);
            font-size: 0.9rem;
            margin-bottom: 5px;
        }

        .ticket-location {
            color: rgba(229, 229, 229, 0.7);
            font-size: 0.85rem;
        }

        .countdown-badge {
            background: linear-gradient(45deg, var(--electric-violet), var(--neon-aqua));
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            white-space: nowrap;
            box-shadow: 0 4px 15px rgba(143, 0, 255, 0.3);
        }

        /* Quick Actions */
        .quick-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 20px;
        }

        .action-btn {
            background: linear-gradient(45deg, var(--electric-violet), var(--neon-aqua));
            color: white;
            border: none;
            padding: 15px 20px;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 0.95rem;
            box-shadow: 0 2px 8px rgba(0, 246, 255, 0.08);
        }

        .action-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(143, 0, 255, 0.4);
            text-decoration: none;
            color: white;
            background: linear-gradient(45deg, var(--neon-aqua), var(--electric-violet));
        }

        /* Activity Feed */
        .activity-feed {
            max-height: 350px;
            overflow-y: auto;
        }

        .activity-item {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid rgba(143, 0, 255, 0.2);
            transition: all 0.3s ease;
            color: inherit;
        }

        .activity-item:hover {
            background: rgba(143, 0, 255, 0.05);
            margin: 0 -15px;
            padding: 15px;
            border-radius: 8px;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--electric-violet);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .activity-content {
            flex-grow: 1;
        }

        .activity-text {
            color: var(--platinum-gray);
            margin-bottom: 5px;
        }

        .activity-time {
            color: rgba(229, 229, 229, 0.6);
            font-size: 0.85rem;
        }

        /* Recommendations Section */
        .recommendations-section {
            margin-top: 30px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .section-title {
            font-size: 2rem;
            font-weight: 600;
            color: var(--electric-violet);
        }

        .view-all-btn {
            color: var(--neon-aqua);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 8px 16px;
            border: 1px solid var(--neon-aqua);
            border-radius: 20px;
            background: transparent;
        }

        .view-all-btn:hover {
            background: var(--neon-aqua);
            color: var(--jet-black);
            text-decoration: none;
        }

        .recommendations-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 25px;
        }

        .event-card {
            background: var(--card-bg-dark);
            border: 1px solid rgba(0, 246, 255, 0.3);
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            cursor: pointer;
            color: inherit;
        }

        html[data-bs-theme="light"] .event-card {
            background: var(--card-bg-light);
        }

        .event-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 50px rgba(0, 246, 255, 0.2);
            border-color: var(--neon-aqua);
        }

        .event-image {
            height: 180px;
            background: linear-gradient(45deg, var(--electric-violet), var(--sunset-coral));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .event-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transform: translateX(-100%);
            transition: transform 0.6s;
        }

        .event-card:hover .event-image::before {
            transform: translateX(100%);
        }

        .event-details {
            padding: 20px;
        }

        .event-title {
            color: var(--platinum-gray);
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 1.1rem;
        }

        .event-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .event-date {
            color: var(--neon-aqua);
            font-size: 0.9rem;
            font-weight: 500;
        }

        .event-price {
            color: var(--electric-violet);
            font-weight: bold;
            font-size: 1.1rem;
        }

        .event-location {
            color: rgba(229, 229, 229, 0.7);
            font-size: 0.85rem;
            margin-bottom: 15px;
        }

        .btn-secondary {
            background: transparent;
            color: var(--neon-aqua);
            border: 2px solid var(--neon-aqua);
            padding: 10px 20px;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            font-weight: 500;
            width: 100%;
        }

        .btn-secondary:hover {
            background: var(--neon-aqua);
            color: var(--jet-black);
            text-decoration: none;
            transform: translateY(-2px);
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .main-content {
                grid-template-columns: 1fr;
            }

            .welcome-message {
                font-size: 2rem;
            }

            .dashboard-header {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .quick-actions {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            }

            .loyalty-points {
                font-size: 2.5rem;
            }

            .recommendations-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .dashboard-container {
                padding: 15px;
            }

            .loyalty-section {
                padding: 20px;
            }

            .content-card {
                padding: 20px;
            }
        }

        /* Custom Scrollbar */
        .ticket-list::-webkit-scrollbar,
        .activity-feed::-webkit-scrollbar {
            width: 6px;
        }

        .ticket-list::-webkit-scrollbar-track,
        .activity-feed::-webkit-scrollbar-track {
            background: rgba(18, 18, 18, 0.5);
            border-radius: 3px;
        }

        .ticket-list::-webkit-scrollbar-thumb,
        .activity-feed::-webkit-scrollbar-thumb {
            background: var(--electric-violet);
            border-radius: 3px;
        }

        .ticket-list::-webkit-scrollbar-thumb:hover,
        .activity-feed::-webkit-scrollbar-thumb:hover {
            background: var(--neon-aqua);
        }

        /* Add to your main CSS file */
        .empty-state {
            text-align: center;
            padding: 40px;
            color: var(--platinum-gray);
        }

        .empty-state .empty-icon {
            font-size: 3rem;
            display: block;
            margin-bottom: 1rem;
        }

        .notification-badge {
            background-color: var(--sunset-coral);
            color: white;
            border-radius: 50%;
            padding: 0.2rem 0.5rem;
            font-size: 0.8rem;
            margin-left: 0.5rem;
        }

        .activity-item {
            display: flex;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid var(--jet-black-light);
        }

        .activity-icon {
            font-size: 1.25rem;
            margin-right: 1rem;
            color: var(--electric-violet);
        }
    </style>
@endpush

@section('content')
    <div class="dashboard-container" style="padding-top: 90px;">
        {{-- Dashboard Header --}}
        <header class="dashboard-header">
            <h1 class="welcome-message">Welcome, {{ Auth::user()->name }}!</h1>
        </header>

        {{-- Loyalty Section --}}
        <section class="loyalty-section">
            <div class="loyalty-content">
                <h3 class="loyalty-title">🎵 Rhythmx Rewards</h3>
                <div class="loyalty-points">{{ number_format($loyaltyPoints) }}</div>
                <p>points earned</p>
                <div class="progress-container">
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: {{ $loyaltyProgress }}%;"></div>
                    </div>
                    <p>{{ $pointsToNext }} points to VIP status! ⭐</p>
                </div>
            </div>
        </section>

        {{-- Quick Stats --}}
        <section class="stats-grid">
            <div class="stat-card" onclick="window.location.href='{{ route('events.upcoming') }}'">
                <span class="stat-icon">🎫</span>
                <div class="stat-number">{{ $upcomingEvents }}</div>
                <div class="stat-label">Upcoming Events</div>
            </div>
            <div class="stat-card" onclick="window.location.href='{{ route('tickets.index') }}'">
                <span class="stat-icon">🎟️</span>
                <div class="stat-number">{{ $totalTickets }}</div>
                <div class="stat-label">Total Tickets</div>
            </div>
            <div class="stat-card" onclick="window.location.href='{{ route('orders.index') }}'">
                <span class="stat-icon">💰</span>
                <div class="stat-number">${{ number_format($totalSpent) }}</div>
                <div class="stat-label">Total Spent</div>
            </div>
            <div class="stat-card" onclick="window.location.href='{{ route('events.attended') }}'">
                <span class="stat-icon">✅</span>
                <div class="stat-number">{{ $eventsAttended }}</div>
                <div class="stat-label">Events Attended</div>
            </div>
        </section>

        {{-- Main Content --}}
        <div class="main-content">
            {{-- Upcoming Tickets --}}
            <div class="content-card">
                <h2 class="card-title">🎫 My Upcoming Events</h2>
                <div class="ticket-list">
                    @forelse($upcomingTickets as $ticket)
                            <div onclick="window.location.href='{{ route('tickets.show', ['ticket' => $ticket['id']]) }}'>
                                                                                                                                        <div class="
                                ticket-image">
                                {{ $ticket['icon'] }}
                            </div>
                            <div class="ticket-info">
                                <h4 class="ticket-title">{{ $ticket['event'] }}</h4>
                                <div class="ticket-date">{{ \Carbon\Carbon::parse($ticket['date'])->format('l, F j, Y') }}</div>
                                <div class="ticket-location">📍 {{ $ticket['location'] }}</div>
                            </div>
                            <div class="countdown-badge">{{ $ticket['days_left'] }} days left</div>
                        </div>
                    @empty
                    <div class="empty-state">
                        <span class="empty-icon">🎭</span>
                        <h3>No upcoming events</h3>
                        <p>Discover amazing events and book your tickets!</p>
                        <a href="{{ route('events.browse') }}" class="action-btn">
                            🔍 Browse Events
                        </a>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Sidebar --}}
        <div>
            {{-- Quick Actions --}}
            <div class="content-card">
                <h2 class="card-title">⚡ Quick Actions</h2>
                <div class="quick-actions">
                    <a href="{{ route('events.browse') }}" class="action-btn">
                        🔍 Browse Events
                    </a>
                    <a href="{{ route('cart') }}" class="action-btn">
                        🛒 View Cart
                        @if($cartCount > 0)
                            <span class="notification-badge">{{ $cartCount }}</span>
                        @endif
                    </a>
                    <a href="{{ route('tickets.index') }}" class="action-btn">
                        📱 My Tickets
                    </a>
                    <a href="{{ route('wishlist.index') }}" class="action-btn">
                        ⭐ Wishlist
                        @if(isset($wishlistCount) && $wishlistCount > 0)
                            {{ $wishlistCount }}
                        @endif

                    </a>
                </div>
            </div>

            {{-- Recent Activity --}}
            <div class="content-card">
                <h2 class="card-title">📊 Recent Activity</h2>
                <div class="activity-feed">
                    @forelse($recentActivity as $activity)
                        <div class="activity-item">
                            <div class="activity-icon">{{ $activity['icon'] }}</div>
                            <div class="activity-content">
                                <div class="activity-text">{{ $activity['text'] }}</div>
                                <div class="activity-time">{{ $activity['time'] }}</div>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <span class="empty-icon">📊</span>
                            <p>No recent activity</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>


    {{-- Recommendations --}}
    <section class="recommendations-section">
        <div class="section-header">
            <h2 class="section-title">🔥 Recommended for You</h2>
            <a href="{{ route('events.browse') }}" class="view-all-btn">View All Events</a>
        </div>

        <div class="recommendations-grid">
            @forelse($recommendedEvents as $event)
                <div onclick="window.location.href='{{ route('events.show', ['event' => $event['id']]) }}'">
                    <div class="event-image">{{ $event['icon'] }}</div>
                    <div class="event-details">
                        <h3 class="event-title">{{ $event['title'] }}</h3>
                        <div class="event-meta">
                            <span class="event-date">{{ \Carbon\Carbon::parse($event['date'])->format('F j, Y') }}</span>
                            <span class="event-price">${{ $event['price'] }}</span>
                        </div>
                        <div class="event-location">📍 {{ $event['location'] }}</div>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <span class="empty-icon">🎉</span>
                    <h3>No recommendations yet</h3>
                    <p>Check back later for personalized event recommendations!</p>
                </div>
            @endforelse
        </div>
    </section>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Refresh stats every 30 seconds
            setInterval(fetchDashboardStats, 30000);

            function fetchDashboardStats() {
                fetch('/api/dashboard-stats')
                    .then(response => response.json())
                    .then(data => {
                        // Update stats
                        document.querySelectorAll('.stat-number')[0].textContent = data.upcomingEvents;
                        document.querySelectorAll('.stat-number')[1].textContent = data.totalTickets;
                        document.querySelectorAll('.stat-number')[2].textContent = '$' + data.totalSpent;
                        document.querySelectorAll('.stat-number')[3].textContent = data.eventsAttended;

                        // Update loyalty points
                        document.querySelector('.loyalty-points').textContent = data.loyaltyPoints;
                        document.querySelector('.progress-fill').style.width = data.loyaltyProgress + '%';
                        document.querySelector('.progress-container p').textContent =
                            data.pointsToNext + ' points to VIP status! ⭐';
                    });
            }
        });
    </script>
@endsection
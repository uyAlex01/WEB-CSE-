<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Event;
use App\Models\Order;
use App\Models\Ticket;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        return view('pages.dashboard', [
            // Loyalty Data
            'loyaltyPoints' => $user->loyalty_points,
            'loyaltyProgress' => $this->calculateLoyaltyProgress($user),
            'pointsToNext' => $this->calculatePointsToNext($user),
            
            // Stats Cards
            'upcomingEvents' => Event::upcoming()->count(),
            'totalTickets' => $user->tickets()->count(),
            'totalSpent' => Order::where('user_id', $user->id)->sum('total_amount'),
            'eventsAttended' => $user->tickets()->where('attended', true)->count(),
            
            // Upcoming Tickets
            'upcomingTickets' => $user->tickets()
                ->with(['event' => function($query) {
                    $query->upcoming();
                }])
                ->get()
                ->filter(fn($ticket) => $ticket->event) // Filter out null events
                ->map(function ($ticket) {
                    return [
                        'id' => $ticket->id,
                        'event' => $ticket->event->name,
                        'date' => $ticket->event->date,
                        'location' => $ticket->event->location,
                        'icon' => $this->getEventIcon($ticket->event->category),
                        'days_left' => Carbon::parse($ticket->event->date)->diffInDays(now())
                    ];
                }),
            
            // Recent Activity
            'recentActivity' => $user->activities()
                ->latest()
                ->limit(5)
                ->get()
                ->map(function ($activity) {
                    return [
                        'type' => $activity->type,
                        'text' => $activity->description,
                        'time' => $activity->created_at->diffForHumans(),
                        'icon' => $this->getActivityIcon($activity->type)
                    ];
                }),
            
            // Recommendations
            'recommendedEvents' => Event::recommendedFor($user->id)
                ->limit(4)
                ->get()
                ->map(function ($event) {
                    return [
                        'id' => $event->id,
                        'title' => $event->name,
                        'date' => $event->date,
                        'price' => $event->price,
                        'location' => $event->location,
                        'icon' => $this->getEventIcon($event->category)
                    ];
                }),
            
            // Cart/Wishlist Counts
            'cartCount' => $user->cartItems()->count(),
            
        ]);
    }

    private function calculateLoyaltyProgress($user)
    {
        $points = $user->loyalty_points;
        $vipThreshold = 3000; // Points needed for VIP status
        return min(($points / $vipThreshold) * 100, 100);
    }

    private function calculatePointsToNext($user)
    {
        $vipThreshold = 3000;
        return max($vipThreshold - $user->loyalty_points, 0);
    }

    private function getEventIcon($category)
    {
        $icons = [
            'concert' => '🎤',
            'festival' => '🎪',
            'club' => '🍾',
            'electronic' => '🎧',
            'rave' => '⚡'
        ];
        
        return $icons[strtolower($category)] ?? '🎵';
    }

    private function getActivityIcon($type)
    {
        $icons = [
            'purchase' => '🎫',
            'wishlist' => '⭐',
            'points' => '🏆',
            'review' => '⭐',
            'share' => '📤'
        ];
        
        return $icons[$type] ?? '📊';
    }
}
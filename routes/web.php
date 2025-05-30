<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WishlistController;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->name('logout');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'showRegistrationForm')->name('register');
    Route::post('/register', 'create_user');
});

/*
|--------------------------------------------------------------------------
| Public Page Routes
|--------------------------------------------------------------------------
*/
Route::controller(PageController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/about', 'about')->name('about');
    Route::get('/organize', 'organize')->name('organize');
    Route::get('/pricing', 'pricing')->name('pricing');
});

/*
|--------------------------------------------------------------------------
| Public Event Routes
|--------------------------------------------------------------------------
*/
Route::controller(EventController::class)->group(function () {
    Route::get('/browse', 'browse')->name('events.browse');
    Route::get('/events/{event}', 'show')->name('events.show');
    Route::get('/search', 'search')->name('events.search');
});

/*
|--------------------------------------------------------------------------
| Public Category Routes
|--------------------------------------------------------------------------
*/
Route::controller(CategoryController::class)->group(function () {
    Route::get('/categories', 'index')->name('categories.index');
    Route::get('/category/{category:slug}', 'show')->name('category.show');
});

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Event Routes
    Route::controller(EventController::class)->group(function () {
        Route::get('/events/upcoming', 'upcoming')->name('events.upcoming');
        Route::get('/events/attended', 'attended')->name('events.attended');
    });
    
    // Cart Routes
    Route::prefix('cart')->controller(CartController::class)->group(function () {
        Route::get('/', 'viewCart')->name('cart.view');
        Route::post('/add', 'addToCart')->name('cart.add');
        Route::post('/remove/{id}', 'removeFromCart')->name('cart.remove');
        Route::post('/update/{id}', 'updateCart')->name('cart.update');
        Route::post('/clear', 'clearCart')->name('cart.clear');
    });
    
    // Checkout Routes
    Route::prefix('checkout')->controller(CheckoutController::class)->group(function () {
        Route::get('/', 'index')->name('checkout');
        Route::post('/process', 'process')->name('checkout.process');
        Route::get('/success', 'success')->name('checkout.success');
    });
    
    // Ticket Routes
    Route::prefix('tickets')->controller(TicketController::class)->group(function () {
        Route::get('/', 'index')->name('tickets.index');
        Route::get('/{ticket}', 'show')->name('tickets.show');
    });
    
    // Order Routes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    
    // Wishlist Routes
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    
    // API Routes
    Route::prefix('api')->group(function () {
        Route::get('/dashboard-stats', [DashboardController::class, 'getStats'])->name('api.dashboard.stats');
    });
});

/*
|--------------------------------------------------------------------------
| Public API Routes
|--------------------------------------------------------------------------
*/
Route::get('/cart/count', function() {
    return response()->json([
        'count' => Auth::check() ? Auth::user()->cartItems()->count() : 0
    ]);
});

// Temporary debug route (add to routes/web.php)
Route::get('/debug-cart', function() {
    dd([
        'Session Cart' => session()->get('cart'),
        'DB Cart (Auth)' => Auth::check() ? Auth::user()->carts : null,
        'Event Data' => Event::first() // Verify event exists
    ]);
});

Route::patch('/cart/update/{eventId}', [CartController::class, 'updateQuantity']);

// Show cart page
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');

// Add to cart (POST)
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');

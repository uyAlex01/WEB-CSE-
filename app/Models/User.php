<?php

// app/Models/User.php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        // Add your custom fields here
        // 'username',
        // 'phone_number'
    ];

    public function getAuthPassword()
{
    return $this->password; // Ensure this matches your password column name
}

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

      // app/Models/User.php
public function carts()
{
    return $this->hasMany(Cart::class);
}

public function tickets()
{
    return $this->hasMany(Ticket::class);
}

public function orders()
{
    return $this->hasMany(Order::class);
}

public function cartItems()
{
    return $this->hasMany(Cart::class);
}

public function wishlist()
{
    return $this->belongsToMany(Event::class, 'wishlists');
}

public function activities()
{
    return $this->hasMany(UserActivity::class)->latest();
}

// If you need both relationships, rename one of them, for example:
public function wishlistItems()
{
    return $this->hasMany(Wishlist::class);
}

}
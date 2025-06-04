<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    public function up()
{
  

}
public function user()
{
    return $this->belongsTo(User::class);
}

public function showDashboard()
{
    $wishlistCount = Wishlist::where('user_id', auth()->id())->count(); // Example logic

    return view('pages.dashboard', compact('wishlistCount'));
}

}

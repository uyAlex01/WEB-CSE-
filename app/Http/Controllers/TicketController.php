<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Wishlist;

class TicketController extends Controller
{
   public function index()
{
    // Example: get all wishlist items for the current user or all items
    $wishlists = Wishlist::all();  // or your query to get wishlist items

    return view('wishlist.index', compact('wishlists'));
}



    public function show($id)
    {
        // Example: retrieve single ticket by id
        $ticket = null; // Replace with Ticket::findOrFail($id);

        return view('tickets.show', compact('ticket'));
    }

    public function destroy($id)
{
    // Example logic
    Wishlist::destroy($id);

    return redirect()->route('wishlist.index')->with('success', 'Item removed.');
}

}


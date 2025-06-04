@extends('layouts.app')

@section('content')
    <div class="container py-5" style="background-color: #121212; min-height: 100vh;">
        <h2 class="mb-4" style="color: #8F00FF;">My Wishlist</h2>

        @if($wishlists->isEmpty())
            <div class="text-center text-muted" style="color: #E5E5E5;">
                <p>Your wishlist is empty.</p>
            </div>
        @else
            <div class="row">
                @foreach($wishlists as $item)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow" style="background-color: #1e1e1e; border: 1px solid #8F00FF; color: #E5E5E5;">
                            <div class="card-body">
                                <h5 class="card-title" style="color: #8F00FF;">{{ $item->event->title }}</h5>
                                <p class="card-text">{{ Str::limit($item->event->description, 100) }}</p>

                                <form action="{{ route('wishlist.remove', $item->event->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn" style="background-color: #FF4F81; color: white; border: none;">
                                        Remove
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
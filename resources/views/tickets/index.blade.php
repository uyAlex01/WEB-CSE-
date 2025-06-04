@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-[#121212] text-[#E5E5E5] py-8">
        <div class="container mx-auto px-4">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1
                    class="text-3xl md:text-4xl font-bold mb-4 text-transparent bg-clip-text bg-gradient-to-r from-[#8F00FF] to-[#00F6FF]">
                    All Categories
                </h1>
                <p class="text-[#E5E5E5]/80">
                    Browse our curated music experiences
                </p>
            </div>

            <!-- Categories Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach([['id' => 1, 'name' => 'Concerts', 'icon' => 'bi-mic', 'desc' => 'Live performances'], ['id' => 2, 'name' => 'Music Festivals', 'icon' => 'bi-boombox', 'desc' => 'Multi-day experiences'], ['id' => 3, 'name' => 'Battle of the Bands', 'icon' => 'bi-trophy', 'desc' => 'Talent competitions'], ['id' => 4, 'name' => 'Album Release Parties', 'icon' => 'bi-vinyl', 'desc' => 'New music celebrations'], ['id' => 5, 'name' => 'DJ Sets / Club Nights', 'icon' => 'bi-disc', 'desc' => 'Electronic dance events'], ['id' => 6, 'name' => 'Orchestral Performances', 'icon' => 'bi-music-note-list', 'desc' => 'Classical concerts'], ['id' => 7, 'name' => 'Opera Shows', 'icon' => 'bi-mask', 'desc' => 'Dramatic vocal arts'], ['id' => 8, 'name' => 'Tribute Shows', 'icon' => 'bi-stars', 'desc' => 'Legend homages'], ['id' => 9, 'name' => 'Record Store Events', 'icon' => 'bi-shop', 'desc' => 'Vinyl culture'], ['id' => 10, 'name' => 'Music Award Ceremonies', 'icon' => 'bi-award', 'desc' => 'Industry celebrations']] as $category)
                    <a href="{{ route('tickets.show', $category['id']) }}"
                        class="group bg-[#1E1E1E] rounded-xl p-6 border border-[#333] hover:border-[#00F6FF] transition-all duration-300 hover:shadow-lg hover:shadow-[#8F00FF]/10">
                        <div class="flex items-center gap-4">
                            <div
                                class="bg-[#8F00FF]/10 p-3 rounded-lg border border-[#8F00FF]/20 group-hover:bg-[#8F00FF]/20 transition-colors">
                                <i class="bi {{ $category['icon'] }} text-[#00F6FF] text-2xl"></i>
                            </div>
                            <h3 class="text-xl font-bold group-hover:text-[#00F6FF] transition-colors">{{ $category['name'] }}
                            </h3>
                        </div>
                        <p class="mt-4 text-[#E5E5E5]/70">{{ $category['desc'] }}</p>
                        <div class="mt-4 flex justify-end">
                            <span class="inline-flex items-center text-[#00F6FF] group-hover:text-white">
                                Explore
                                <i class="bi bi-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
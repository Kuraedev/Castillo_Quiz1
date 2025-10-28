@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h1 class="text-4xl font-bold text-gray-800">All Movie Reviews</h1>
    <p class="text-gray-600 mt-2">Browse and manage your movie collection</p>
</div>

@if($movies->isEmpty())
    <div class="bg-white rounded-lg shadow-md p-12 text-center">
        <div class="text-6xl mb-4">🎬</div>
        <h2 class="text-2xl font-semibold text-gray-700 mb-2">No Reviews Yet</h2>
        <p class="text-gray-500 mb-6">Start by adding your first movie review!</p>
        <a href="{{ route('movies.create') }}" 
           class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition inline-block">
            Add Your First Review
        </a>
    </div>
@else

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($movies as $movie)
            <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow overflow-hidden">

                <!-- Poster on Top -->
                @if($movie->poster_url)
                    <img src="{{ $movie->poster_url }}" 
                         alt="{{ $movie->title }} poster" 
                         class="w-full h-80 object-cover">
                @endif

                <div class="p-6">
                    <!-- Title -->
                    <h2 class="text-xl font-bold text-gray-800 mb-3">{{ $movie->title }}</h2>
                    
                    <!-- Star Rating -->
                    <div class="flex items-center mb-3">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $movie->rating)
                                <span class="text-yellow-400 text-2xl">★</span>
                            @else
                                <span class="text-gray-300 text-2xl">★</span>
                            @endif
                        @endfor
                        <span class="ml-2 text-gray-600 font-semibold">{{ $movie->rating }}/5</span>
                    </div>

                    <!-- Review Snippet -->
                    <p class="text-gray-600 mb-4 line-clamp-3">
                        {{ Str::limit($movie->review, 100) }}
                    </p>

                    <!-- Date -->
                    <p class="text-sm text-gray-400 mb-4">
                        Added: {{ $movie->created_at->format('M d, Y') }}
                    </p>

                    <!-- Action Buttons -->
                    <a href="{{ route('movies.show', $movie) }}" 
                       class="block w-full text-center bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition">
                        View Full Review
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection

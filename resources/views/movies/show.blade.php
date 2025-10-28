@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('movies.index') }}" 
           class="text-indigo-600 hover:text-indigo-800 font-semibold">
            ← Back to All Reviews
        </a>
    </div>

    <!-- Movie Review Card -->
    <div class="bg-white rounded-lg shadow-lg p-8">
        <!-- Title -->
        <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $movie->title }}</h1>

        <!-- Poster (if available) -->
        @if($movie->poster_url)
            <div class="mb-6 flex justify-center">
                <img src="{{ $movie->poster_url }}" 
                     alt="{{ $movie->title }} Poster"
                     class="rounded-lg shadow-md max-h-96 object-contain">
            </div>
        @endif

        <!-- Star Rating -->
        <div class="flex items-center mb-6">
            @for($i = 1; $i <= 5; $i++)
                @if($i <= $movie->rating)
                    <span class="text-yellow-400 text-3xl">★</span>
                @else
                    <span class="text-gray-300 text-3xl">★</span>
                @endif
            @endfor
            <span class="ml-3 text-2xl text-gray-700 font-semibold">{{ $movie->rating }}/5</span>
        </div>

        <!-- Review Content -->
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-3">Review</h2>
            <p class="text-gray-600 leading-relaxed whitespace-pre-line">{{ $movie->review }}</p>
        </div>

        <!-- Metadata -->
        <div class="border-t pt-4 mb-6">
            <p class="text-sm text-gray-500">
                <span class="font-semibold">Added:</span> {{ $movie->created_at->format('F d, Y \a\t h:i A') }}
            </p>
            @if($movie->updated_at != $movie->created_at)
                <p class="text-sm text-gray-500">
                    <span class="font-semibold">Last Updated:</span> {{ $movie->updated_at->format('F d, Y \a\t h:i A') }}
                </p>
            @endif
        </div>

        <!-- Action Buttons -->
        <div class="flex gap-4">
            <a href="{{ route('movies.edit', $movie) }}" 
               class="flex-1 bg-yellow-500 text-white py-3 rounded-lg hover:bg-yellow-600 transition font-semibold text-center">
                ✏️ Edit Review
            </a>
            <form action="{{ route('movies.destroy', $movie) }}" 
                  method="POST" 
                  class="flex-1"
                  onsubmit="return confirm('Are you sure you want to delete this review? This action cannot be undone.');">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="w-full bg-red-600 text-white py-3 rounded-lg hover:bg-red-700 transition font-semibold">
                    🗑️ Delete Review
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

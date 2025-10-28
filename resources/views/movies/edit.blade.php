@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <h1 class="text-4xl font-bold text-gray-800">Edit Movie Review</h1>
        <p class="text-gray-600 mt-2">Update your review for "{{ $movie->title }}"</p>
    </div>

    <div class="bg-white rounded-lg shadow-md p-8">
        <form action="{{ route('movies.update', $movie) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Movie Title -->
            <div class="mb-6">
                <label for="title" class="block text-gray-700 font-semibold mb-2">
                    Movie Title <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       name="title" 
                       id="title" 
                       value="{{ old('title', $movie->title) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('title') border-red-500 @enderror"
                       placeholder="Enter movie title">
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Star Rating -->
            <div class="mb-6">
                <label for="rating" class="block text-gray-700 font-semibold mb-2">
                    Star Rating <span class="text-red-500">*</span>
                </label>
                <select name="rating" 
                        id="rating" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('rating') border-red-500 @enderror">
                    <option value="">Select rating</option>
                    @for($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ old('rating', $movie->rating) == $i ? 'selected' : '' }}>
                            {{ $i }} Star{{ $i > 1 ? 's' : '' }} {{ str_repeat('★', $i) }}
                        </option>
                    @endfor
                </select>
                @error('rating')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Review Content -->
            <div class="mb-6">
                <label for="review" class="block text-gray-700 font-semibold mb-2">
                    Your Review <span class="text-red-500">*</span>
                </label>
                <textarea name="review" 
                          id="review" 
                          rows="6" 
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('review') border-red-500 @enderror"
                          placeholder="Write your detailed review here...">{{ old('review', $movie->review) }}</textarea>
                @error('review')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex gap-4">
                <button type="submit" 
                        class="flex-1 bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 transition font-semibold">
                    Update Review
                </button>
                <a href="{{ route('movies.show', $movie) }}" 
                   class="flex-1 bg-gray-300 text-gray-700 py-3 rounded-lg hover:bg-gray-400 transition font-semibold text-center">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
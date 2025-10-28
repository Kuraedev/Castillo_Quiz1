<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    // Display all movies
    public function index()
    {
        $movies = Movie::latest()->get();
        return view('movies.index', compact('movies'));
    }

    // Show create form
    public function create()
    {
        return view('movies.create');
    }

    // Store new movie
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required',
            'poster_url' => 'nullable|url',
        ]);

        Movie::create($validated);

        return redirect()->route('movies.index')
            ->with('success', 'Movie review added successfully!');
    }

    // Show single movie
    public function show(Movie $movie)
    {
        return view('movies.show', compact('movie'));
    }

    // Show edit form
    public function edit(Movie $movie)
    {
        return view('movies.edit', compact('movie'));
    }

    // Update movie
    public function update(Request $request, Movie $movie)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required'
        ]);

        $movie->update($validated);

        return redirect()->route('movies.index')
            ->with('success', 'Movie review updated successfully!');
    }

    // Delete movie
    public function destroy(Movie $movie)
    {
        $movie->delete();

        return redirect()->route('movies.index')
            ->with('success', 'Movie review deleted successfully!');
    }
}
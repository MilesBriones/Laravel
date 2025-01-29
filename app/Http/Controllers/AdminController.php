<?php

namespace App\Http\Controllers;

use App\Models\Movies;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Exception;

class AdminController extends Controller
{
    // Display the admin index page
    public function index()
    {
        return view('admin.index');
    }

    // Display the dashboard with all movies
    public function dashboard()
    {
        try {
            $movies = Movies::all(); // Retrieve all movies
            return view('admin.dashboard', compact('movies'));
        } catch (Exception $e) {
            return redirect()->route('admin.index')->with('error', 'Error fetching movies: ' . $e->getMessage());
        }
    }

    // Show the form to create a new movie
    public function create()
    {
        return view('admin.create'); // Return create movie form
    }

    // Store a new movie
    public function store(Request $request)
    {
        try {
            // Validate the input
            $request->validate([
                'title' => 'required|string|max:255',
                'genre' => 'required|string|max:255',
                'release_date' => 'required|date',
                'rating' => 'required|numeric|max:5',
                'duration' => 'required|numeric|max:1000',
                'country' => 'required|string|max:255',
                'description' => 'required|max:65535',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate image upload
            ]);

            $imagePath = null;

            // Handle image upload
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads'), $filename);
                $imagePath = 'uploads/' . $filename; // Save relative path
            }

            // Create a new movie record
            Movies::create([
                'title' => $request->input('title'),
                'genre' => $request->input('genre'),
                'release_date' => $request->input('release_date'),
                'rating' => $request->input('rating'),
                'duration' => $request->input('duration'),
                'country' => $request->input('country'),
                'description' => $request->input('description'),
                'image' => $imagePath,
            ]);

            // Redirect to the dashboard with a success message
            return redirect()->route('admin.dashboard')->with('success', 'Movie created successfully');
        } catch (Exception $e) {
            return back()->with('error', 'Error creating movie: ' . $e->getMessage());
        }
    }

    // Show the form to edit an existing movie
    public function edit($id)
    {
        try {
            $movie = Movies::findOrFail($id); // Fetch the movie by its ID
            return view('admin.edit', compact('movie'));
        } catch (Exception $e) {
            return redirect()->route('admin.dashboard')->with('error', 'Error fetching movie: ' . $e->getMessage());
        }
    }

    // Update an existing movie
    public function update(Request $request, $id)
{
    try {
        // Find the movie by id
        $movie = Movies::findOrFail($id);

        // Validate the input
        $request->validate([
            'title' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'release_date' => 'required|date',
            'rating' => 'required|numeric|min:1|max:5',
            'duration' => 'required|numeric|min:1',
            'country' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle image upload (if new image is uploaded)
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($movie->image && file_exists(public_path($movie->image))) {
                unlink(public_path($movie->image)); // Delete the old image
            }

            // Store the new image
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $movie->image = 'uploads/' . $filename; // Update image path
        }

        // Update the movie fields (retain old values if not updated)
        $movie->update([
            'title' => $request->input('title'),
            'genre' => $request->input('genre'),
            'release_date' => $request->has('release_date') ? $request->input('release_date') : $movie->release_date, // Check if release_date is provided, otherwise keep the old value
            'rating' => $request->input('rating'),
            'duration' => $request->input('duration'),
            'country' => $request->input('country'),
            'description' => $request->input('description'),
            'image' => $movie->image, // Retain existing image if not updated
        ]);

        // Redirect back to the dashboard with a success message
        return redirect()->route('admin.dashboard')->with('success', 'Movie updated successfully');
    } catch (Exception $e) {
        return back()->with('error', 'Error updating movie: ' . $e->getMessage());
    }
}


    // Delete a movie
    public function delete($id)
    {
        try {
            $movie = Movies::findOrFail($id); // Find the movie by ID

            // Delete the image from storage if it exists
            if ($movie->image) {
                Storage::delete($movie->image);
            }

            // Delete the movie from the database
            $movie->delete();

            // Redirect to the dashboard with a success message
            return redirect()->route('admin.dashboard')->with('success', 'Movie deleted successfully');
        } catch (Exception $e) {
            return redirect()->route('admin.dashboard')->with('error', 'Error deleting movie: ' . $e->getMessage());
        }
    }
}
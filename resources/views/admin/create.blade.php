<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<div class="container d-flex justify-content-center">
    <div class="card shadow-lg border-0 p-4" style="max-width: 500px; width: 100%; border-radius: 20px;">
        <h2 class="text-center mb-4 text-primary">Add New Movie List</h2>
        <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Displaying errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="Enter the movie title" value="{{ old('title') }}" required>
            </div>

            <div class="mb-3">
                <label for="genre" class="form-label">Genre</label>
                <select name="genre" class="form-select" id="genre">
                    <option value="Action" {{ old('genre') == 'Action' ? 'selected' : '' }}>Action</option>
                    <option value="Comedy" {{ old('genre') == 'Comedy' ? 'selected' : '' }}>Comedy</option>
                    <option value="Drama" {{ old('genre') == 'Drama' ? 'selected' : '' }}>Drama</option>
                    <option value="Horror" {{ old('genre') == 'Horror' ? 'selected' : '' }}>Horror</option>
                    <option value="Thriller" {{ old('genre') == 'Thriller' ? 'selected' : '' }}>Thriller</option>
                    <option value="Sci-Fi" {{ old('genre') == 'Sci-Fi' ? 'selected' : '' }}>Sci-Fi</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="release_date" class="form-label">Release Date</label>
                <input type="date" name="release_date" class="form-control" id="release_date" value="{{ old('release_date') }}" required>
            </div>

            <div class="mb-3">
                <label for="rating" class="form-label">Rating</label>
                <input type="number" name="rating" class="form-control" id="rating" placeholder="Enter the rating (1-5)" min="1" max="5" value="{{ old('rating') }}" step="0.1" required>
            </div>

            <div class="mb-3">
                <label for="duration" class="form-label">Duration <span class="text-danger">*per minutes</span></label>
                <input type="number" name="duration" class="form-control" id="duration" placeholder="Enter the duration in minutes" value="{{ old('duration') }}" required>
            </div>

            <div class="mb-3">
                <label for="country" class="form-label">Country</label>
                <input type="text" name="country" class="form-control" id="country" placeholder="Enter the country of origin" value="{{ old('country') }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control rounded-3" id="description" rows="4" placeholder="Enter a brief description of the movie" required>{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" class="form-control" id="image" accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary w-100 py-2">Save Movie</button>
        </form>

        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary w-100 mt-3 py-2">Back</a>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg border-0 p-4" style="max-width: 800px; width: 100%; border-radius: 20px;">
    <form action="{{ route('admin.update', $movie->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Use PUT method for updating -->
            
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $movie->title) }}">
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 form-group">
                    <label for="genre">Genre</label>
                    <select name="genre" class="form-control @error('genre') is-invalid @enderror">
                        <option value="Action" {{ old('genre', $movie->genre) == 'Action' ? 'selected' : '' }}>Action</option>
                        <option value="Comedy" {{ old('genre', $movie->genre) == 'Comedy' ? 'selected' : '' }}>Comedy</option>
                        <option value="Drama" {{ old('genre', $movie->genre) == 'Drama' ? 'selected' : '' }}>Drama</option>
                        <option value="Horror" {{ old('genre', $movie->genre) == 'Horror' ? 'selected' : '' }}>Horror</option>
                        <option value="Thriller" {{ old('genre', $movie->genre) == 'Thriller' ? 'selected' : '' }}>Thriller</option>
                        <option value="Sci-Fi" {{ old('genre', $movie->genre) == 'Sci-Fi' ? 'selected' : '' }}>Sci-Fi</option>
                    </select>
                    @error('genre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="release_date">Release Date</label>
                    <input type="date" name="release_date" class="form-control @error('release_date') is-invalid @enderror" 
                    value="{{ old('release_date', $movie->release_date ? $movie->release_date->toDateString() : '') }}">
                    @error('release_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 form-group">
                    <label for="rating">Rating</label>
                    <input type="number" name="rating" class="form-control @error('rating') is-invalid @enderror" value="{{ old('rating', $movie->rating) }}">
                    @error('rating') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="duration">Duration <span class="text-danger">*per hour example 120mins</span></label>
                    <input type="number" name="duration" class="form-control @error('duration') is-invalid @enderror" value="{{ old('duration', $movie->duration) }}">
                    @error('duration') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 form-group">
                    <label for="country">Country</label>
                    <input type="text" name="country" class="form-control @error('country') is-invalid @enderror" value="{{ old('country', $movie->country) }}">
                    @error('country') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description', $movie->description) }}</textarea>
                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                @if ($movie->image)
                    <div class="mt-3">
                        <label>Current Image:</label>
                        <img src="{{ asset($movie->image) }}" alt="Movie Image" class="img-thumbnail" style="max-width: 300px;">
                    </div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Update Movie</button>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">Back</a>
        </form>
    </div>
</div>

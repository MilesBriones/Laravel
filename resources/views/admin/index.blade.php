<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movies by Genre</title>
    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
       /* Global Body Styles */
body {
    background-color: #121212; /* Darker background for better contrast */
    color: #fff;
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

/* Movie Card Styling */
.movie-card {
    cursor: pointer;
    text-align: center;
    margin: 15px;
    border-radius: 12px;
    background-color: #1e1e1e;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
}

.movie-card:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 30px rgba(0, 0, 0, 0.5);
}

.movie-card img {
    width: 100%;
    height: auto;
    border-bottom: 1px solid #333;
    object-fit: cover;
}

/* Movie Title Styling */
.movie-titl {
    color: #e50914;
    padding: 10px;
    font-size: 18px;
    font-weight: bold;
    word-wrap: break-word;
}

/* Modal Styles */
.modal-content {
    background-color: #181818;
    color: #fff;
    border-radius: 12px;
    overflow: hidden;
}

.modal-header {
    background-color: #1e1e1e;
    padding: 15px;
    border-bottom: 1px solid #333;
}

.modal-header .btn-close {
    background-color: #444;
    color: #fff;
    border-radius: 50%;
}

.modal-body {
    max-height: 70vh;
    overflow-y: auto;
    padding: 20px;
}

.modal-body p {
    word-wrap: break-word;
    overflow-wrap: break-word;
    line-height: 1.5;
}

/* Modal Image Styling */
#movieImage {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
}

/* Modal Overlay */
.modal-backdrop {
    background-color: rgba(0, 0, 0, 0.85) !important;
}

/* Filter and Search Container */
.filter-container {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 15px;
    margin-bottom: 20px;
}

.search-container {
    display: flex;
    gap: 10px;
    justify-content: center;
    align-items: center;
}

.search-container input {
    width: 100%;
    padding: 12px;
    font-size: 16px;
    border-radius: 12px;
    border: 1px solid #444;
    background-color: #333;
    color: #fff;
    transition: border 0.3s ease;
}

.search-container input:focus {
    border-color: #e50914;
    outline: none;
}

.search-container button {
    background-color: #e50914;
    color: #fff;
    border: none;
    padding: 12px 24px;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.search-container button:hover {
    background-color: #b20710;
    transform: scale(1.05);
}

.search-container button:active {
    background-color: #790000;
    transform: scale(0.95);
}

/* Styled Button for Other Actions */
.styled-button {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 8px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.styled-button:hover {
    background-color: #0056b3;
    transform: scale(1.05);
}

.styled-button:active {
    background-color: #003d82;
    transform: scale(0.95);
}

/* Card Hover Effect */
.movie-card:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 40px rgba(0, 0, 0, 0.7);
}

/* Button Container */
.button-container {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    margin: 20px;
}

/* Adjusted Layout for Flexbox */
.container {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 20px;
    flex-wrap: wrap;
}

/* Overall Layout Adjustments */
.card {
    background-color: #222;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.5);
}

.card h2 {
    text-align: center;
    font-size: 24px;
    color: #e50914;
}

.card p {
    color: #b3b3b3;
    font-size: 16px;
    text-align: center;
}

/* Responsive Design for Smaller Screens */
@media (max-width: 768px) {
    .movie-card {
        margin: 10px;
        width: 100%;
        max-width: 300px;
    }

    .container {
        flex-direction: column;
    }

    .search-container {
        flex-direction: column;
        gap: 15px;
    }

    .styled-button {
        width: 100%;
    }
}

    </style>
</head>
<body>
   <!-- Genre Filter Dropdown -->
   <div class="filter-container">
    <div class="search-container d-flex align-items-center justify-content-between">
        <input type="text" id="searchInput" placeholder="Search for movies..." onkeyup="searchMovies()" />
        <button class="styled-button ms-3" onclick="window.location.href='{{ route('admin.dashboard') }}'">
            Back to Dashboard
        </button>
    </div>

    <select id="genreFilter" onchange="filterMoviesByGenre()">
        <option value="all">All Genres</option>
        @foreach ($movie as $genre => $movies)
            <option value="{{ $genre }}">{{ $genre }}</option>
        @endforeach
    </select>
</div>


    <h2>Movie List</h2>
    <h4>Filter by Genre</h4>

    <div id="moviesContainer">
        @foreach ($movie as $genre => $movies)
            <div class="genre-row" data-genre="{{ $genre }}">
                <h3>{{ $genre }}</h3>
                <div class="movie-container">
                    @foreach ($movies as $movie)
                        <div class="movie-card" onclick="openModal('{{ $movie->title }}', '{{ $movie->genre }}', '{{ $movie->release_date }}', '{{ $movie->rating }}', '{{ $movie->duration }}', '{{ $movie->country }}', '{{ asset($movie->image) }}', '{{ $movie->description }}')" data-title="{{ $movie->title }}" data-description="{{ $movie->description }}">
                            <img src="{{ asset($movie->image) }}" alt="{{ $movie->title }}" class="img-fluid">
                            <p class="movie-titl text-white">{{ $movie->title }}</p> <!-- Title below the image -->
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    <!-- Modal -->
    <div class="modal fade" id="movieModal" tabindex="-1" aria-labelledby="movieModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="movieModalLabel">Movie Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeModal()"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 col-12 mb-3">
                            <img id="movieImage" src="" alt="Movie Image" class="img-fluid rounded w-100">
                        </div>
                        <div class="col-md-4 col-12">
                            <p><strong>Title:</strong> <span id="movieTitle"></span></p>
                            <p><strong>Genre:</strong> <span id="movieGenre"></span></p>
                            <p><strong>Release Date:</strong> <span id="movieReleaseDate"></span></p>
                            <p><strong>Description:</strong> <span id="movieDescription"></span></p>
                            <p><strong>Rating:</strong> <span id="movieRating"></span></p>
                            <p><strong>Duration:</strong> <span id="movieDuration"></span></p>
                            <p><strong>Country:</strong> <span id="movieCountry"></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Convert rating to stars (Full and Half stars representation)
        function ratingToStars(rating) {
            let fullStars = Math.floor(rating);
            let halfStar = (rating % 1) >= 0.5 ? 1 : 0;
            let emptyStars = 5 - fullStars - halfStar;

            let stars = '';
            for (let i = 0; i < fullStars; i++) {
                stars += '★'; // Full Star
            }
            if (halfStar) {
                stars += '☆'; // Half Star
            }
            for (let i = 0; i < emptyStars; i++) {
                stars += '☆'; // Empty Star
            }

            return stars;
        }

        // Open the modal with movie details
        function openModal(title, genre, release_date, rating, duration, country, image, description) {
            console.log({ title, genre, release_date, rating, duration, country, image, description });

            const formattedReleaseDate = new Date(release_date).toLocaleDateString();
            
            document.getElementById('movieTitle').textContent = title;
            document.getElementById('movieGenre').textContent = "Genre: " + genre;
            document.getElementById('movieReleaseDate').textContent = "Release Date: " + formattedReleaseDate;
            document.getElementById('movieRating').textContent = "Rating: " + ratingToStars(rating);
            document.getElementById('movieDuration').textContent = "Duration: " + duration + " mins";
            document.getElementById('movieCountry').textContent = "Country: " + country;
            document.getElementById('movieImage').src = image;
            document.getElementById('movieDescription').textContent = description;

            // Show the modal using Bootstrap's modal functionality
            const modalElement = document.getElementById('movieModal');
            const modal = bootstrap.Modal.getOrCreateInstance(modalElement);
            modal.show();
        }

        // Close the modal
        function closeModal() {
            const modal = new bootstrap.Modal(document.getElementById('movieModal'));
            modal.hide();
        }

        // Filter movies by selected genre
        function filterMoviesByGenre() {
            const selectedGenre = document.getElementById('genreFilter').value;
            const allGenres = document.querySelectorAll('.genre-row');

            allGenres.forEach(genreRow => {
                if (selectedGenre === 'all' || genreRow.getAttribute('data-genre') === selectedGenre) {
                    genreRow.style.display = 'block';
                } else {
                    genreRow.style.display = 'none';
                }
            });
        }

        // Search functionality to filter movies by title or description
        function searchMovies() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const movieCards = document.querySelectorAll('.movie-card');

            movieCards.forEach(card => {
                const title = card.getAttribute('data-title').toLowerCase();
                const description = card.getAttribute('data-description').toLowerCase();

                if (title.includes(searchTerm) || description.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Watch Miu</title>
    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
       /* Global styles */
body {
    background-color: #0d0d0d;
    color: #e0e0e0;
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

/* Movie card styling */
.movie-card {
    cursor: pointer;
    text-align: center;
    margin: 15px;
    border-radius: 12px;
    overflow: hidden;
    background: linear-gradient(145deg, #1a1a1a, #292929);
    box-shadow: 0 8px 20px rgba(0, 255, 183, 0.2);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    width: 300px;
}

.movie-card:hover {
    transform: scale(1.08);
    box-shadow: 0 10px 30px rgba(0, 255, 183, 0.4);
}

.movie-card img {
    width: 100%;
    height: auto;
    border-bottom: 3px solid #00ffcc;
}

.movie-title {
    color: #00ffcc;
    padding: 14px;
    font-size: 20px;
    font-weight: bold;
}

/* Modal styling */
.modal-content {
    background-color: #121212;
    color: #ffffff;
    border-radius: 14px;
    padding: 25px;
    box-shadow: 0 12px 40px rgba(0, 255, 183, 0.3);
    transition: all 0.3s ease;
}

.modal-header {
    background-color: #181818;
    border-bottom: 2px solid #00ffcc;
    border-radius: 14px 14px 0 0;
    padding: 18px;
}

.modal-header .btn-close {
    background-color: #00ffcc;
    border-radius: 50%;
    padding: 8px;
    transition: background-color 0.3s ease;
}

.modal-header .btn-close:hover {
    background-color: #00b3a1;
}

.modal-backdrop {
    background-color: rgba(0, 0, 0, 0.9) !important;
}

/* Search and filter styling */
.filter-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
    padding: 12px;
}

.search-container {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 12px;
    width: 100%;
}

.search-container input {
    flex-grow: 1;
    padding: 14px;
    font-size: 18px;
    border-radius: 10px;
    border: 2px solid #00ffcc;
    background-color: #191919;
    color: #ffffff;
    transition: all 0.3s ease;
    margin: 0;
}

.search-container input:focus {
    border-color: #00ffcc;
    outline: none;
    box-shadow: 0 0 12px rgba(0, 255, 183, 0.6);
}

/* Button styling */
.button-container {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    margin: 25px;
}

.styled-button {
    background: linear-gradient(45deg, #00ffcc, #00b3a1);
    color: #0d0d0d;
    border: none;
    padding: 14px 28px;
    border-radius: 10px;
    font-size: 18px;
    font-weight: bold;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.2s ease;
    box-shadow: 0 6px 12px rgba(0, 255, 183, 0.5);
}

.styled-button:hover {
    background: linear-gradient(45deg, #00b3a1, #007a75);
    transform: scale(1.05);
}

.styled-button:active {
    background: #00524e;
    transform: scale(0.95);
}

/* Smooth fade-in effect */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.movie-card, .modal-content, .styled-button {
    animation: fadeIn 0.5s ease-in-out;
}

.genre-row h3{
    color: linear-gradient(45deg, #00ffcc, #00b3a1);
}


    </style>
</head>
<body>
   <!-- Genre Filter Dropdown -->
   <div class="filter-container">
    <div class="search-container d-flex align-items-center justify-content-between w-100">
        <input type="text" id="searchInput" placeholder="Search for movies..." onkeyup="searchMovies()" />
        <button class="styled-button ms-3" onclick="window.location.href='{{ route('admin.dashboard') }}'">
            Admin side
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
    <h4>Genre Fliter</h4>

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
            document.getElementById('movieTitle').textContent = title;
            document.getElementById('movieGenre').textContent = "Genre: " + genre;
            document.getElementById('movieReleaseDate').textContent = "Release Date: " + release_date;
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

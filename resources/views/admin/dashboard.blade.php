<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
     body {
    background-color: #f4f4f4;
    font-family: 'Arial', sans-serif;
}

.dashboard-header {
    color: 000;
    padding: 20px;
    font-weight: bold;

}

.dashboard-header h1 {
    font-size: 3rem;
}

.dashboard-header p {
    font-size: 1.2rem;
    color: #333; /* Darker text color for better readability */
}

.dashboard-header .btn {
    margin-top: 20px;
}

.btn-light {
    background-color: #00ffcc; /* Updated button color */
    color: white;
}

.btn-light:hover {
    background-color: #00e6b3; /* Hover color updated */
}

.table {
    background-color: #222;
    color: white;
    border-radius: 50px;
}

.table th {
    background-color: #141414;
    color: white;
    text-align: center;
}

.table td {
    vertical-align: middle;
    word-wrap: break-word;
    overflow-wrap: break-word;
    text-align: center;
}

.img-thumbnail {
    max-height: 100px;
    object-fit: cover;
}

.modal-content {
    background-color: #141414;
    color: white;
}

.modal-header {
    border-bottom: 1px solid #444;
    background-color: #fff !important;
}
.modal-title{
    color: #000;
}

.modal-footer {
    background-color: #141414;
    border-top: 1px solid #444;
}

.modal-body p {
    word-wrap: break-word;
    overflow-wrap: break-word;
}

.rating i {
    color: #ffcd00;
}

.btn-primary {
    background-color: #000;
    border: none !important;
}

.btn-info{
    color: #fff;
    font-weight: bold;
}



    </style>
</head>

<body>
    <div class="container mt-5">
            <div class="buttons d-flex justify-content-end w-100 gap-2 mb-4">       
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                     @csrf
                     <button type="submit" class="btn bg-black text-white">Logout</button>
                 </form>
                 <a href="{{ route('home.index')}}" class="btn btn-outline-dark bg-black text-white">Index View</a>
             </div>
        <div class="dashboard-header">
            <h1>Admin Dashboard</h1>
            <p>Welcome back! Manage your movies efficiently.</p>
           
        </div>
        <hr>
        

        <div class="mt-4 d-flex justify-content-between">
            <h2>Movie List</h2>
            <a href="{{ route('admin.create') }}" class="btn btn-primary">Add New Movie</a>
        </div>

        <table class="table table-striped table-hover mt-3">
            <thead class="table-dark">
                <tr>
                    <th>Title</th>
                    <th>Genre</th>
                    <th>Release Date</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($movies as $movie)
                    <tr>
                        <td>{{ $movie->title }}</td>
                        <td>{{ $movie->genre }}</td>
                        <td>{{ $movie->release_date->format('Y-m-d') }}</td>
                        <td>
                            @if ($movie->image)
                                <img src="{{ asset($movie->image) }}" alt="Movie Image" class="img-thumbnail">
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewModal-{{ $movie->id }}">
                                <i class="fas fa-eye"></i> <!-- View Icon -->
                            </button>
                            <a href="{{ route('admin.edit', $movie->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> <!-- Edit Icon -->
                            </a>
                            <form action="{{ route('admin.delete', $movie->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i> <!-- Delete Icon -->
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal for viewing movie details -->
                    <div class="modal fade" id="viewModal-{{ $movie->id }}" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="viewModalLabel">Movie Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="color: #fff;"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            @if ($movie->image)
                                                <img src="{{ asset($movie->image) }}" alt="Movie Image" class="img-fluid rounded">
                                            @endif
                                        </div>
                                        <div class="col-md-4">
                                            <p><strong>Title:</strong> {{ $movie->title }}</p>
                                            <p><strong>Genre:</strong> {{ $movie->genre }}</p>
                                            <p><strong>Release Date:</strong> {{ $movie->release_date->format('Y-m-d') }}</p>
                                            <p><strong>Description:</strong> {{ $movie->description }}</p>
                                            <p><strong>Rating:</strong>
                                                <span class="rating">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($movie->rating >= $i)
                                                            <i class="fas fa-star"></i> <!-- Full star -->
                                                        @elseif ($movie->rating >= $i - 0.5)
                                                            <i class="fas fa-star-half-alt"></i> <!-- Half star -->
                                                        @else
                                                            <i class="far fa-star"></i> <!-- Empty star -->
                                                        @endif
                                                    @endfor
                                                </span>
                                            </p>
                                            <p><strong>Duration:</strong> {{ $movie->duration }} mins</p>
                                            <p><strong>Country:</strong> {{ $movie->country }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>

        <!-- Success and Error messages -->
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
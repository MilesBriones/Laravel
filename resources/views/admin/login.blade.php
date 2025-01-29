<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login</title>
    <style>
      body {
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background: linear-gradient(to bottom, #00ffcc, #00b3b3); /* Updated gradient */
    color: #333; /* Change to a darker text color for better contrast */
    font-family: 'Arial', sans-serif;
}

.login-container {
    width: 100%;
    max-width: 400px;
    padding: 40px 30px;
    background-color: rgba(0, 0, 0, 0.75); /* Semi-transparent black remains */
    color: #fff;
    border-radius: 20px;
}

.login-container h2 {
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 25px;
}

.form-control {
    background-color: #fff;
    border: none;
    border-radius: 0;
    color: #fff;
    padding: 12px 15px;
    border-radius: 10px;
}

.form-control:focus {
    box-shadow: none;
    border: 1px solid #00ffcc; /* Updated border color */
}

.btn-primary {
    background-color: #00ffcc; 
    border: none;
    padding: 12px 15px;
    font-size: 16px;
    font-weight: bold;
    width: 100%;
    border-radius: 2px;
    transition: background-color 0.3s;
    border-radius: 20px;
}

.btn-primary:hover {
    background-color: #00e6b3; /* Lighter shade for hover */
}

.form-check-label {
    font-size: 14px;
}

.forgot-link {
    color: #b3b3b3;
    font-size: 14px;
    text-decoration: none;
}

.forgot-link:hover {
    text-decoration: underline;
}

.signup-link {
    color: #fff;
    font-size: 16px;
}

.signup-link span {
    color: #00ffcc;
    font-weight: bold;
}

.signup-link:hover span {
    text-decoration: underline;
}

.text-muted {
    color: #b3b3b3 !important;
}

    </style>
</head>
<body>
    <div class="login-container">
        <h2>Sign In</h2>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                {{ $errors->first('email') }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <input type="email" name="email" id="email" class="form-control" placeholder="Email or phone number" required>
            </div>

            <div class="form-group mb-3">
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
            </div>

            <button type="submit" class="btn btn-primary">Sign In</button>

           
        </form>

        <div class="mt-4 text-center">
            <a href="{{route('register')}}" class="signup-link">Sign up now</a>
        </div>

   
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

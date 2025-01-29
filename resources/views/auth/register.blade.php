<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Register</title>
    <style>
       body {
    background: linear-gradient(to bottom, #00ffcc, #009999); /* Updated gradient background */
    color: #333; /* Darker text for better readability */
    font-family: Arial, sans-serif;
    margin: 0;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.register-container {
    width: 100%;
    max-width: 360px;
    padding: 30px;
    background-color: rgba(0, 0, 0, 0.85);
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
}

.register-container h2 {
    font-size: 24px;
    margin-bottom: 20px;
    text-align: center;
    font-weight: bold;
    color: #fff;
}

.form-control {
    background-color: #fff; 
    color: #fff;
    border: 1px solid #555; 
    border-radius: 5px;
}

.form-control:focus {
    border-color: #00ffcc; 
    box-shadow: none;
}

.btn-primary {
    background-color: #00ffcc;
    border: none;
    width: 100%;
    padding: 12px;
    font-size: 16px;
    font-weight: bold;
    border-radius: 5px;
}

.btn-primary:hover {
    background-color: #00e6b3; /* Lighter shade for hover */
}

.alert {
    font-size: 14px;
}

.footer-text {
    margin-top: 15px;
    font-size: 14px;
    text-align: center;
    color: #fff;
}

.footer-text a {
    color: #00ffcc; /* Updated footer link color */
    text-decoration: none;
}

.footer-text a:hover {
    text-decoration: underline;
}

    </style>
</head>
<body>
    <div class="register-container">
        <h2>Create an Account</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <input type="text" name="name" class="form-control" placeholder="Full Name" required>
            </div>
            <div class="form-group mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="form-group mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="form-group mb-3">
                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
        <div class="footer-text">
            Already have an account? <a href="{{ route('login') }}">Sign in now</a>.
        </div>
    </div>
</body>
</html>

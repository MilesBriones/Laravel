<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/shop.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/item.css')}}">
    <title>Document</title>
</head>
<body>
    <header class="position-relative">
        <h4 class="ps-3 position-absolute top-50 start-0 translate-middle-y">
            <a href="{{ route('admin.index') }}">Admin</a>
        </h4>
        <h1 class="position-absolute top-50 start-50 translate-middle">Puds:Diner</h1>
        <h1 class="pe-3 position-absolute top-50 end-0 translate-middle-y">
            <a href="{{ route('cart.index') }}">
                <i class="fa-solid fa-cart-shopping"></i>
            </a>
        </h1>
    </header>
    

    <div class="sidebar" id="sidebar">
        <h3 class="text-primary">Menus</h3>
        <div class="menu-item">
            <a href="#" class="active">Main course</a>
        </div>
        <div class="menu-item">
            <a href="#" class="active">Side dish</a>
        </div>
        <div class="menu-item">
            <a href="#" class="active">Drinks</a>
        </div>
        <div class="menu-item">
            <a href="#" class="active">Desserts</a>
        </div>
        <div class="menu-item">
            <a href="#" class="active">Hot Deals</a>
        </div>
        
    </div>

    <div class="dashboard-content">
        <!-- Main Content -->
        <div class="content" id="content">

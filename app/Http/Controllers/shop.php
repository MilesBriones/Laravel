<?php

namespace App\Http\Controllers;

use App\Models\products;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class shop extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = products::all();
        return view('shop.index', compact('products'));
    }

}

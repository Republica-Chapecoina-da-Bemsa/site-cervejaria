<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Product;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index()
    {
        $events = Event::latest()->get();
        $products = Product::with('style')->latest()->get();

        return view('welcome', compact('events', 'products'));
    }
}

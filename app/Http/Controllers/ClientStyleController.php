<?php

namespace App\Http\Controllers;

use App\Models\Style;
use Illuminate\Http\Request;

class ClientStyleController extends Controller
{
    public function index()
    {
        $styles = Style::withCount('products')->get();
        return view('client.styles.index', compact('styles'));
    }

    public function show(Style $style)
    {
        $style->load('products');
        return view('client.styles.show', compact('style'));
    }
}

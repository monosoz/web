<?php

namespace App\Http\Controllers;

use App\Product;

use App\Filter;

use App\Tag;

class PagesController extends Controller
{
    public function index()
    {
        return view('main', ['products' => Product::all(), 'filters' => Filter::all(), 'tags' => Tag::all(),]);
    }
}

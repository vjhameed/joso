<?php

namespace App\Http\Controllers;

use App\Hotel;
use Illuminate\Http\Request;

class homeController extends Controller
{
    public function index()
    {
        $hotels = Hotel::take(9)->get();
        return view('home', compact('hotels'));
    }

    public function fetchListings(Request $request)
    {
        $limit = $request->limit;
        $listings = Hotel::skip($limit)->take(9)->get();
        return $listings;
    }
}

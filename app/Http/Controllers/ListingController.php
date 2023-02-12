<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    // === GET AND SHOW ALL LISTINGS
    public function index()
    {
        return view('index', [
            'listings' => Listing::all(),
        ]);
    }

    // === SHOW SINGLE LISTING
    public function show(Listing $listing)
    {
        return view('listing', [
            'listing' => $listing,
        ]);
    }
}

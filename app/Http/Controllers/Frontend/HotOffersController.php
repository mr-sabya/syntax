<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HotOffersController extends Controller
{
    // Display the flash deals page
    public function index()
    {
        return view('frontend.hot-offers.index');
    }
}

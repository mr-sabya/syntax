<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //track order page
    public function trackOrder()
    {
        return view('frontend.order.track');
    }
}

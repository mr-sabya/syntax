<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    //
    public function index()
    {
        return view('frontend.checkout.index');
    }

    public function thankYou(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);
        return view('frontend.checkout.thank-you', ['order' => $order]);
    }
}

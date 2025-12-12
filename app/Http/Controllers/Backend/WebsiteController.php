<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    // banner page
    public function banners()
    {
        return view('backend.website.banner.index');
    }

    // clients page
    public function clients()
    {
        return view('backend.website.client.index');
    }

    // partners page
    public function partners()
    {
        return view('backend.website.partner.index');
    }
}

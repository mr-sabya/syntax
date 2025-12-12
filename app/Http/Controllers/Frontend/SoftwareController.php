<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Software;
use Illuminate\Http\Request;

class SoftwareController extends Controller
{
    //
    public function index()
    {
        return view('frontend.software.index');
    }

    public function show($slug)
    {
        $software = Software::where('slug', $slug)->firstOrFail();
        return view('frontend.software.show', compact('software'));
    }
}

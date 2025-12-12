<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Software;
use Illuminate\Http\Request;

class SoftwareController extends Controller
{
    // category
    public function categoryIndex()
    {
        return view('backend.software.category.index');
    }

    // index
    public function index()
    {
        return view('backend.software.software.index');
    }

    // create
    public function create()
    {
        return view('backend.software.software.create');
    }

    // edit
    public function edit($id)
    {
        $softwareId = Software::findOrFail($id)->id;
        return view('backend.software.software.edit', compact('softwareId'));
    }
}

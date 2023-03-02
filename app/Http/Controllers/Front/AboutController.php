<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;

class AboutController extends Controller
{
    public function index(Request $request)
    {
        $about=About::first();

        return view('Front.about',compact('about'));
    }
}

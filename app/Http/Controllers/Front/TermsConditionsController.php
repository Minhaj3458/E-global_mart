<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TermsConditions;
use Auth;

class TermsConditionsController extends Controller
{
    public function index(Request $request)
    {
        $termsconditions=TermsConditions::first();
        
        return view('Front.terms-conditions',compact('termsconditions'));
    }
}

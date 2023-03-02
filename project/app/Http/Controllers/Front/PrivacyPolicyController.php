<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PrivacyPolicy;

class PrivacyPolicyController extends Controller
{
    public function index(Request $request)
    {
        $privacypolicy=PrivacyPolicy::first();

        return view('Front.privacy-policy',compact('privacypolicy'));
    }
}

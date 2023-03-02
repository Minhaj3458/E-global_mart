<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use Auth;

class NotificationController extends Controller
{
    public function notifications(Request $request)
    {
        $user_id  = @Auth::user()->id;

        $notifications=Notification::where('user_id',$user_id)
        ->orderBy('id', 'DESC')
        ->paginate(10);

        return view('Front.notifications',compact('notifications'));
    }
}

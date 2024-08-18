<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\RoomType;
class BookingController extends Controller
{
    public function booking(){
        $header = Banner::where('type','header')->where('status',1)->get()->toArray();

        $roomType = RoomType::get()->toArray();

        return view('Frontend.booking.booking')->with(compact('header','roomType'));
    }
}

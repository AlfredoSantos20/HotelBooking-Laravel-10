<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\RoomType;
class ReservationController extends Controller
{
    public function reservation(){
        $header = Banner::where('type','header')->where('status',1)->get()->toArray();

        $roomType = RoomType::get()->toArray();

        return view('Frontend.reservation.reservation')->with(compact('header','roomType'));
    }
}

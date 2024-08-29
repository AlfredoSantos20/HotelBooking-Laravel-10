<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function booking(){
        Session::put('page','booking');

        $booking = Booking::get()->toArray();

       // dd($booking);
        return view('Backend.Booking.booking')->with(compact('booking'));
    }

}

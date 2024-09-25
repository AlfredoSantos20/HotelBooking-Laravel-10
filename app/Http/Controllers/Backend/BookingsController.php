<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\Booking;
class BookingsController extends Controller
{
     public function viewbooks(){
        Session::put('page','booking');

        $booking = Booking::with('customer')->get()->toArray();

        //dd($booking);
        return view('Backend.Booking.booking')->with(compact('booking'));
    }
}

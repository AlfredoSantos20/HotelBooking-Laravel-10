<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\Booking;
use Auth;

class BookingController extends Controller
{
    public function booking(){
        $header = Banner::where('type','header')->where('status',1)->get()->toArray();

        $room = Room::with('roomType')->get()->toArray();

        //dd($room);
        return view('Frontend.booking.booking')->with(compact('header','room'));
    }

    public function saveBooking(Request $request)
{
    $data = $request->all();

    //Check if user is log in or not
    if (!Auth::check()) {
        $message = "Login first to start Booking!";
        return response()->json([
            'message' => $message,
        ], 201);
    }

    //Auth user ID
    $userIds = Auth::user()->id;

   // Retrieve the room type with its maximum capacity
   $checkPersonCapacity = RoomType::find($data['room_type_id']);

   if (!$checkPersonCapacity) {
       return response()->json([
           'message' => 'Selected room type does not exist.',
           'status' => 'error_checkPersonCapacity',
       ], 201);
   }

   // Check capacity
   if ($data['total_adults'] > $checkPersonCapacity->adults || $data['total_children'] > $checkPersonCapacity->children) {
       return response()->json([
           'message' => 'Cannot accommodate the number of adults and children as it exceeds the maximum capacity. Only ' . $checkPersonCapacity->children . ' children and ' . $checkPersonCapacity->adults . ' adults can be accommodated.',
           'status' => 'capacity_exceeded',
           'max_children' => $checkPersonCapacity->children,
           'max_adults' => $checkPersonCapacity->adults,
       ], 201);
   }

    // Find all rooms of the selected room type
    $availableRoom = Room::where('room_type', $data['room_type_id'])
        ->whereDoesntHave('bookings', function($query) use ($data) {
            $query->whereBetween('checkin_date', [$data['checkin_date'], $data['checkout_date']])
                  ->orWhereBetween('checkout_date', [$data['checkin_date'], $data['checkout_date']])
                  ->orWhere(function($query) use ($data) {
                      $query->where('checkin_date', '<=', $data['checkin_date'])
                            ->where('checkout_date', '>=', $data['checkout_date']);
                  });
        })
        ->first();

    //Check if room & date available
    if (!$availableRoom) {
        return response()->json([
            'message' => 'All rooms of this type are occupied for the selected dates.',
            'status' => 'occupied',
        ], 201);
    }

    // Room is available, proceed with booking
    $saveBooking = new Booking;
    $saveBooking->customer_id = $userIds;
    $saveBooking->room_id = $availableRoom->id; // Use the available room's ID
    $saveBooking->checkin_date = $data['checkin_date'];
    $saveBooking->checkout_date = $data['checkout_date'];
    $saveBooking->total_adults = $data['total_adults'];
    $saveBooking->total_children = $data['total_children'];
    $saveBooking->note = $data['note'];

    // Save the booking to the database
    $saveBooking->save();

    return response()->json([
        'message' => 'Booking saved successfully!',
        'status' => 'not_occupied',
        'booking' => $saveBooking,
        'room_id' => $availableRoom->id
    ], 201);
}



}

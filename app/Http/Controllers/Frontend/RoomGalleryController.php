<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
class RoomGalleryController extends Controller
{
    public function roomGallery(){

        $header = Banner::where('type','header')->where('status',1)->get()->toArray();

        //For checkavailability booking
        $room = Room::with('RoomType')->get()->toArray();

        $roomTypes = RoomType::where('status', 1)->with(['rooms' => function ($query) {
            $query->where('status', 1);
        }])->get();

        $DiscountedRooms = RoomType::with(['rooms' => function ($query) {
            $query->where('status', 1);
        }])
        ->where('status', 1)
        ->where('discount', '>', 0) // Only get discounted room types
        ->get();


        //Getting the most booked rooms
        $mostBookedRooms = Room::mostBooked();

        $bookingCount = 0;
        if (auth()->check()) {
            $customerId = auth()->user()->id;
            $today = now()->toDateString(); // Get the current date in 'Y-m-d' format

            // Log the date for debugging purposes
            Log::info('Today\'s Date: ' . $today);

            // Count bookings where the checkout date is in the future or today
            $bookingCount = Booking::where('customer_id', $customerId)
                                   ->whereDate('checkout_date', '>=', $today)
                                   ->count();

            // Log the query and result for debugging
            Log::info('Booking Count Query: ' . Booking::where('customer_id', $customerId)
                                          ->whereDate('checkout_date', '>=', $today)
                                          ->toSql());
            Log::info('Booking Count Result: ' . $bookingCount);
        }


        return view('Frontend.Rooms.room_gallery')->with(compact('bookingCount','DiscountedRooms','roomTypes','header','room','mostBookedRooms'));
    }

    public function checkAvailableRoom(Request $request)
    {
        // Validate the form data
        $data = $request->validate([
            'room_type_id' => 'required|exists:room_types,id',
            'checkin_date' => 'required|date|after_or_equal:today',
            'checkout_date' => 'required|date|after:checkin_date',
        ]);

        // Get the current date
        $now = Carbon::now();

        $checkinDate = Carbon::parse($data['checkin_date']);
        $checkoutDate = Carbon::parse($data['checkout_date']);

        // Check if the check-in or check-out date is in the past
        if ($checkoutDate->lte($checkinDate)) {
            return response()->json([
                'message' => 'Check-out date must be at least one day after the check-in date.',
                'status' => 'invalid_checkout',
            ], 400);
        }




        // Check if the check-in date is within 2 months from now
        $twoMonthsFromNow = $now->copy()->addMonths(2);
        if ($checkinDate->gt($twoMonthsFromNow) || $checkoutDate->gt($twoMonthsFromNow)) {
            return response()->json([
                'message' => 'Bookings can only be made within the next 2 months.',
                'status' => 'invalid_booking_period',
            ]);
        }

        // Find an available room of the selected type
        $availableRoom = Room::where('room_type', $data['room_type_id'])
            ->whereDoesntHave('bookings', function ($query) use ($checkinDate, $checkoutDate) {
                $query->whereBetween('checkin_date', [$checkinDate, $checkoutDate])
                      ->orWhereBetween('checkout_date', [$checkinDate, $checkoutDate])
                      ->orWhere(function ($query) use ($checkinDate, $checkoutDate) {
                          $query->where('checkin_date', '<=', $checkinDate)
                                ->where('checkout_date', '>=', $checkoutDate);
                      });
            })
            ->first();

        if ($availableRoom) {
            return response()->json([
                'message' => 'Room available!',
                'room_id' => $availableRoom->id,
                'status' => 'available',
            ]);
        } else {
            return response()->json([
                'message' => 'No rooms available for the selected dates.',
                'status' => 'unavailable',
            ]);
        }
    }
}

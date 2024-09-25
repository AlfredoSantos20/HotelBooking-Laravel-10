<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\Booking;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    public function booking(){
        $header = Banner::where('type','header')->where('status',1)->get()->toArray();

        $room = Room::with('roomType')->get()->toArray();


        $bookingCount = 0; // Default booking count if user is not authenticated
        if (auth()->check()) {
            $customerId = auth()->user()->id; // Retrieve the authenticated user's ID
            $bookingCount = Booking::where('customer_id', $customerId)->count(); // Count bookings
        }

        return view('Frontend.booking.booking')->with(compact('header','room','bookingCount'));
    }


    public function saveBooking(Request $request)
    {
        $data = $request->all();

        // Check if user is logged in
        if (!Auth::check()) {
            return response()->json([
                'message' => 'Login first to start Booking!',
            ], 401);
        }

        // Get the current date
        $now = Carbon::now();

        // Parse check-in and check-out dates
        $checkinDate = Carbon::parse($data['checkin_date']);
        $checkoutDate = Carbon::parse($data['checkout_date']);

        // Check if the check-in date or check-out date is in the past
        if ($checkinDate->lt($now) || $checkoutDate->lt($now)) {
            return response()->json([
                'message' => 'Check-in and Check-out dates cannot be in the past or current day.',
                'status' => 'invalid_dates',
            ], 400);
        }

        // Check if the check-in date is within 2 months from now
        $twoMonthsFromNow = $now->copy()->addMonths(2);
        if ($checkinDate->gt($twoMonthsFromNow) || $checkoutDate->gt($twoMonthsFromNow)) {
            return response()->json([
                'message' => 'Bookings can only be made within the next 2 months.',
                'status' => 'invalid_booking_period',
            ], 400);
        }

        // Check if the booking is for more than 1 week
        $oneWeekLater = $checkinDate->copy()->addWeek();
        if ($checkoutDate->gt($oneWeekLater)) {
            return response()->json([
                'message' => 'You can only book for a maximum of 1 week.',
                'status' => 'invalid_booking_duration',
            ], 400);
        }

        // Validate that check-out is after check-in
        if ($checkoutDate->lte($checkinDate)) {
            return response()->json([
                'message' => 'Check-out date must be after check-in date.',
                'status' => 'invalid_checkout_date',
            ], 400);
        }

        // Auth user ID
        $userId = Auth::user()->id;

        // Retrieve the room type with its maximum capacity
        $roomType = RoomType::find($data['room_type_id']);
        if (!$roomType) {
            return response()->json([
                'message' => 'Selected room type does not exist.',
                'status' => 'error_checkPersonCapacity',
            ], 400);
        }

        // Check capacity
        if ($data['total_adults'] > $roomType->adults || $data['total_children'] > $roomType->children) {
            return response()->json([
                'message' => 'Cannot accommodate the number of adults and children as it exceeds the maximum capacity.',
                'status' => 'capacity_exceeded',
                'max_children' => $roomType->children,
                'max_adults' => $roomType->adults,
            ], 400);
        }

        // Find available rooms
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

        // Check if room is available
        if (!$availableRoom) {
            return response()->json([
                'message' => 'All rooms of this type are occupied for the selected dates.',
                'status' => 'occupied',
            ], 400);
        }

        // Room is available, proceed with booking
        $booking = new Booking;
        $booking->customer_id = $userId;
        $booking->room_id = $availableRoom->id;
        $booking->checkin_date = $checkinDate;
        $booking->checkout_date = $checkoutDate;
        $booking->total_adults = $data['total_adults'];
        $booking->total_children = $data['total_children'];
        $booking->note = $data['note'];

        // Save the booking to the database
        $booking->save();

        return response()->json([
            'message' => 'Booking saved successfully!',
            'status' => 'success',
            'booking' => $booking,
            'room_id' => $availableRoom->id,
        ], 201);
    }

}

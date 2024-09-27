<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\RoomType;
use App\Models\Food;
use App\Models\Room;
use App\Models\Booking;
use App\Models\User;
use Carbon\Carbon;
class IndexController extends Controller
{

    public function index(){
        //Calling Banners Data
        $sliderBanners = Banner::where('type','Slider')->where('status',1)->get()->toArray();
        $header = Banner::where('type','header')->where('status',1)->get()->toArray();
        $fix1Banner = Banner::where('type','Fix1')->where('status',1)->get()->toArray();
        $circle = Banner::where('type','Circle')->where('status',1)->get()->toArray();

        //Calling Room Type Details & Prices Data
        $singleRoom = RoomType::where('title','Single Room')->where('status',1)->first();
        $famRoom = RoomType::where('title','Family Room')->where('status',1)->first();
        $presRoom = RoomType::where('title','Presidential Room')->where('status',1)->first();

        // Format the Prices for RoomType
        $formattedSingleRoomPrice = $singleRoom ? '₱ ' . number_format($singleRoom->price, 0, '.', ',') : null;
        $formattedFamRoomPrice = $famRoom ? '₱ ' . number_format($famRoom->price, 0, '.', ',') : null;
        $formattedPresRoomPrice = $presRoom ? '₱ ' . number_format($presRoom->price, 0, '.', ',') : null;

        //Calling Rooms Image Based on RoomType
        $singleRoomImg = Room::with('roomType')->whereHas('roomType', function ($query) {
            $query->where('title', 'Single Room')->where('status',1);
        })->get()->toArray();

        $famRoomImg = Room::with('roomType')->whereHas('roomType', function ($query) {
            $query->where('title', 'Family Room')->where('status',1);
        })->get()->toArray();

        $presRoomImg = Room::with('roomType')->whereHas('roomType', function ($query) {
            $query->where('title', 'Presidential Room')->where('status',1);
        })->get()->toArray();
        // dd($singleRoomImg);

        // Fetching Foods
        $MainFood = Food::where('food_type','main')->where('status',1)->paginate(10);
        $DessertFood = Food::where('food_type','dessert')->where('status',1)->paginate(10);
        $DrinkFood = Food::where('food_type','drink')->where('status',1)->paginate(10);


        // Format the prices for foods
        $formattedMainFood = $MainFood->map(function ($MainFood) {
            return [
                'name' => $MainFood->name,
                'price' => '₱' . number_format($MainFood->price, 2),
                'description' => $MainFood->description ?? ''
            ];
        });

        $formattedDesFood = $DessertFood->map(function ($DessertFood) {
            return [
                'name' => $DessertFood->name,
                'price' => '₱' . number_format($DessertFood->price, 2),
                'description' => $DessertFood->description ?? ''
            ];
        });

        $formattedDriFood = $DrinkFood->map(function ($DrinkFood) {
            return [
                'name' => $DrinkFood->name,
                'price' => '₱' . number_format($DrinkFood->price, 2),
                'description' => $DrinkFood->description ?? ''
            ];
        });


        $bookingCount = 0; // Default booking count if user is not authenticated
        if (auth()->check()) {
            $customerId = auth()->user()->id; // Retrieve the authenticated user's ID
            $bookingCount = Booking::where('customer_id', $customerId)->count(); // Count bookings
        }

       // Show Count of Adults Per Room Type



        //For checkavailability booking
        $room = Room::with('RoomType')->get()->toArray();


        return view('Frontend.index')->with(compact('formattedDriFood','formattedDesFood','formattedMainFood','DrinkFood','MainFood','DessertFood','formattedSingleRoomPrice', 'formattedFamRoomPrice', 'formattedPresRoomPrice','sliderBanners','fix1Banner','header','circle','singleRoom','famRoom','presRoom','singleRoomImg','famRoomImg','presRoomImg','bookingCount','room'));

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

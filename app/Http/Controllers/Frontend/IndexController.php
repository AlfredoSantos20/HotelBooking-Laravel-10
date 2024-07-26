<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\RoomType;
use App\Models\Room;
class IndexController extends Controller
{

    public function index(){
        //Calling Banners Data
        $sliderBanners = Banner::where('type','Slider')->where('status',1)->get()->toArray();
        $header = Banner::where('type','header')->where('status',1)->get()->toArray();
        $fix1Banner = Banner::where('type','Fix1')->where('status',1)->get()->toArray();
        $circle = Banner::where('type','Circle')->where('status',1)->get()->toArray();

        //Calling Room Type Prices Data
        $singleRoom = RoomType::where('title','Single Room')->where('status',1)->first();
        $famRoom = RoomType::where('title','Family Room')->where('status',1)->first();
        $presRoom = RoomType::where('title','Presidential Room')->where('status',1)->first();

        // Format the prices
        $formattedSingleRoomPrice = $singleRoom ? '₱ ' . number_format($singleRoom->price, 0, '.', ',') : null;
        $formattedFamRoomPrice = $famRoom ? '₱ ' . number_format($famRoom->price, 0, '.', ',') : null;
        $formattedPresRoomPrice = $presRoom ? '₱ ' . number_format($presRoom->price, 0, '.', ',') : null;

        //Calling Rooms Image Based on RoomType
        $singleRoomImg = Room::with('roomType')->whereHas('roomType', function ($query) {
            $query->where('title', 'Single Room');
        })->get()->toArray();

        $famRoomImg = Room::with('roomType')->whereHas('roomType', function ($query) {
            $query->where('title', 'Family Room');
        })->get()->toArray();

        $presRoomImg = Room::with('roomType')->whereHas('roomType', function ($query) {
            $query->where('title', 'Presidential Room');
        })->get()->toArray();
        // dd($singleRoomImg);
        return view('Frontend.index')->with(compact('formattedSingleRoomPrice', 'formattedFamRoomPrice', 'formattedPresRoomPrice','sliderBanners','fix1Banner','header','circle','singleRoom','famRoom','presRoom','singleRoomImg','famRoomImg','presRoomImg'));


    }
}

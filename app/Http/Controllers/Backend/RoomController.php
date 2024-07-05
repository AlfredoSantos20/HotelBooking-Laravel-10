<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\Room;
use App\Models\RoomType;
use Image;
class RoomController extends Controller
{
    public function rooms(){
        Session::put('page','rooms');

        $rooms = Room::with('roomType')->get()->toArray();

       // dd($rooms);
        return view('Backend.Rooms.rooms')->with(compact('rooms'));
    }

    public function AddEditRoom(Request $request, $id = null)
    {
        Session::put('page', 'rooms');

        $roomType = RoomType::get()->toArray();

        if ($id == "") {
            // Add room
            $room = new room;
            $message = "Room Added successfully!";
            $title = "Add Room";
        } else {
            // Update room
            $room = room::find($id);
            $message = "Room Updated successfully!";
            $title = "Edit Room";
        }

        if ($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                'image' => 'image|mimes:jpeg,png,jpg|max:2048',
                'room_type' => 'required',


            ];
            $customMessages = [

                'room_type.required' => 'Room Type is Required',
                'image.image' => 'The file should be an image',
                'image.mimes' => 'Only jpeg, png, and jpg images are allowed',
                'image.max' => 'Image size should not be greater than 2MB',
            ];

            $this->validate($request, $rules, $customMessages);

            $room->room_type = $data['room_type'];
            $room->status = 1;

            $width = 350;
            $height = 350;


                $width = [$data['room_type']];
                $height = [$data['room_type']];

            // Upload room Photo
            if ($request->hasFile('image')) {
                $image_tmp = $request->file('image');
                if ($image_tmp->isValid()) {
                    // Get Image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    // Generate New Image Name
                    $imageName = rand(111, 99999) . '.' . $extension;
                    $imagePath = 'Frontend/images/rooms/' . $imageName;
                    // Upload the Image
                    Image::make($image_tmp)->resize($width, $height)->save($imagePath);
                    $room->image = $imageName;
                }
            }

            $room->save();
            return response()->json(['success' => true, 'message' => $message]);
        }
        return view('Backend.rooms.add_edit_rooms')->with(compact('title','room','roomType'));
    }

}

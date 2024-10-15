<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Validation\Rule;
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
            $room = new Room;
            $message = "Room Added successfully!";
            $title = "Add Room";
        } else {
            // Update room
            $room = Room::find($id);
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
            $room->occupancy = "Available";
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
        return view('Backend.Rooms.add_edit_rooms')->with(compact('title','room','roomType'));
    }

      //Update Room status
      public function updateRoomStatus(Request $request){

        if($request->ajax()){
            $data = $request->all();
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
           Room::where('id',$data['room_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'room_id'=>$data['room_id']]);
        }
    }

       //Delete Room
       public function deleteRoom($id)
       {
           // Get Room Image
           $room = Room::findOrFail($id);

           // Get Room Image Path
           $room_image_path = public_path('Frontend/images/rooms/');

           // Check if the Room image exists
           if (!empty($room->image) && file_exists($room_image_path . $room->image)) {
               // Delete Room Image
               unlink($room_image_path . $room->image);
           }

           // Delete banner from database
           $room->delete();

           $message = "Room deleted successfully!";
           return redirect('rooms-management/rooms')->with('success_message', $message);
       }

//--- START Room Type
    public function roomtype(){
        Session::put('page','room-type');

        $roomType = RoomType::all();


       // dd($rooms);
        return view('Backend.Rooms.room_type')->with(compact('roomType'));
    }

      //Update Room status
      public function updateRoomtypeStatus(Request $request){

        if($request->ajax()){
            $data = $request->all();
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            RoomType::where('id',$data['roomtype_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'roomtype_id'=>$data['roomtype_id']]);
        }
    }


      //Delete RoomType
      public function deleteRoomType($id)
      {
          // Get Room Image
          $roomtype = RoomType::findOrFail($id);

          // Get Room Image Path
          $roomtype_image_path = public_path('Frontend/images/rooms/');

          // Check if the Room image exists
          if (!empty($room->image) && file_exists($roomtype_image_path . $roomtype->image)) {
              // Delete Room Image
              unlink($roomtype_image_path . $roomtype->image);
          }

          // Delete banner from database
          $roomtype->delete();

          $message = "RoomType deleted successfully!";
          return redirect('rooms-management/roomtype')->with('success_message', $message);
      }


// public function AddEditRoomtype(Request $request, $id = null)
//     {
//         Session::put('page', 'room-type');

//         if ($id == "") {
//             // Add room
//             $roomType = new RoomType;
//             $message = "Room Type Added successfully!";
//             $title = "Add Room Type";
//         } else {
//             // Update room
//             $roomType = RoomType::find($id);
//             $message = "Room Type Updated successfully!";
//             $title = "Edit Room";
//         }

//         if ($request->isMethod('post')) {
//             $data = $request->all();

//             $rules = [
//                 'price' => 'required',
//                 'title' => [
//                     'required',
//                     Rule::unique('room_types')->ignore($id)
//                 ],
//                 'description' => 'required',


//             ];
//             $customMessages = [

//                 'title.required' => 'RoomType is Required',
//                 'title.unique' => 'RoomType title has already been taken',
//                 'price.required' => 'Price is Required',
//                 'description.required' => 'Description is Required',

//             ];

//             $this->validate($request, $rules, $customMessages);

//             $roomType->title = $data['title'];
//             $roomType->price = $data['price'];
//             $roomType->children = $data['total_children'];
//             $roomType->adults = $data['total_adults'];
//             $roomType->description = $data['description'];
//             $roomType->status = 1;


//             $roomType->save();
//             return response()->json(['success' => true, 'message' => $message]);
//         }
//         return view('Backend.Rooms.add_edit_roomtype')->with(compact('title','roomType'));
// }

public function AddEditRoomtype(Request $request, $id = null)
{
    Session::put('page', 'room-type');

    if ($id == "") {
        // Add room type
        $roomType = new RoomType;
        $message = "Room Type Added successfully!";
        $title = "Add Room Type";
    } else {
        // Update room type
        $roomType = RoomType::find($id);
        $message = "Room Type Updated successfully!";
        $title = "Edit Room";
    }



    if ($request->isMethod('post')) {
        $data = $request->all();

        // Validation rules
        $rules = [
            'price' => 'required|numeric',
            'title' => [
                'required',
                Rule::unique('room_types')->ignore($id),
            ],
            'discount' => 'nullable|numeric|min:0|max:100', // Add this rule
            'description' => 'required',
        ];

        $customMessages = [
            'title.required' => 'RoomType is Required',
            'title.unique' => 'RoomType title has already been taken',
            'price.required' => 'Price is Required',
            'discount.max' => 'Discount cannot be more than 100%',
            'discount.min' => 'Discount cannot be less than 0%',
            'description.required' => 'Description is Required',
        ];

        $this->validate($request, $rules, $customMessages);

        // Assign data to the room type
        $roomType->title = $data['title'];
        $roomType->price = $data['price'];
        $roomType->children = $data['total_children'];
        $roomType->adults = $data['total_adults'];
        $roomType->description = $data['description'];
        $roomType->discount = $data['discount'] ?? 0;
        $roomType->status = 1;

        // Save to the database
        $roomType->save();

        // Return success message
        return response()->json(['success' => true, 'message' => $message]);
    }

    // Pass room types to the view
    return view('Backend.Rooms.add_edit_roomtype')->with(compact('title', 'roomType'));
}



}

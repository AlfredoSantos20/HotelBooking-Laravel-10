<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Image;
use App\Models\Banner;

class BannersController extends Controller
{
    public function banners(){
        Session::put('page','banners');

        $banners = Banner::get()->toArray();
        //dd($banners);
        return view('Backend.Banners.banners')->with(compact('banners'));
    }


    public function AddEditBanner(Request $request, $id = null)
    {
        Session::put('page', 'banners');
        if ($id == "") {
            // Add Banner
            $banner = new Banner;
            $message = "Banner Added successfully!";
            $title = "Add Banner";
        } else {
            // Update Banner
            $banner = Banner::find($id);
            $message = "Banner Updated successfully!";
            $title = "Edit Banner";
        }

        if ($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                'image' => 'image',
                'title' => 'required',
                'link' => 'required',
                'alt' => 'required',
            ];
            $customMessages = [
                'title.required' => 'Banner Title is Required',
                'link.required' => 'Banner Link is Required',
                'alt.required' => 'Banner Alternate Text is Required',
                'image.image' => 'The file should be an image',
            ];

            $this->validate($request, $rules, $customMessages);

            $banner->type = $data['type'];
            $banner->link = $data['link'];
            $banner->title = $data['title'];
            $banner->alt = $data['alt'];
            $banner->status = 1;

            // Image dimensions based on type
            $dimensions = [
                'Slider' => [1123, 700],
                'header' => [1920, 1267],
                'Fix1' => [800, 500],
                'Circle' => [250, 250]
            ];

            if (array_key_exists($data['type'], $dimensions)) {
                $width = $dimensions[$data['type']][0];
                $height = $dimensions[$data['type']][1];
            }

            // Upload Banner Photo
            if ($request->hasFile('image')) {
                $image_tmp = $request->file('image');
                if ($image_tmp->isValid()) {
                    // Get Image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    // Generate New Image Name
                    $imageName = rand(111, 99999) . '.' . $extension;
                    $imagePath = 'Frontend/images/banners/' . $imageName;
                    // Upload the Image
                    Image::make($image_tmp)->resize($width, $height)->save($imagePath);
                    $banner->image = $imageName;
                }
            }

            $banner->save();
            return response()->json(['success' => true, 'message' => $message]);
        }
        return view('Backend.Banners.add_edit_banners')->with(compact('title','banner'));
    }


     //Update banner status
     public function updateBannerStatus(Request $request){

        if($request->ajax()){
            $data = $request->all();
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
           Banner::where('id',$data['banner_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'banner_id'=>$data['banner_id']]);
        }
    }


     //Delete banner
     public function deleteBanners($id)
     {
         // Get Banner Image
         $banner = Banner::findOrFail($id);

         // Get Banner Image Path
         $banner_image_path = public_path('Backend/img/banners/');

         // Check if the banner image exists
         if (!empty($banner->image) && file_exists($banner_image_path . $banner->image)) {
             // Delete Banner Image
             unlink($banner_image_path . $banner->image);
         }

         // Delete banner from database
         $banner->delete();

         $message = "Banner deleted successfully!";
         return redirect('banners-management/banners')->with('success_message', $message);
     }

}

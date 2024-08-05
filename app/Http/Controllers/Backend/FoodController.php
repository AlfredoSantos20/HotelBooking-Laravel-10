<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Food;
use Session;
use Illuminate\Validation\Rule;

class FoodController extends Controller
{
    public function foods(){
        Session::put('page','foods');

        $foods = Food::get()->toArray();

        //dd($foods);
        return view('Backend.Foods.foods')->with(compact('foods'));
    }


    // -- START ADD-EDIT Foods FOR FOOD
    public function AddEditFood(Request $request, $id = null)
    {
        Session::put('page', 'foods');


        // $foods = Food::get()->toArray();

        if ($id == "") {
            // Add Foods
            $foods = new Food;
            $message = "Foods Added successfully!";
            $title = "Add Food";
        } else {
            // Update Foods
            $foods = Food::find($id);
            $message = "Foods Updated successfully!";
            $title = "Edit Food";
        }

        if ($request->isMethod('post')) {
            $data = $request->all();

            $rules = [

                'price' => 'required|numeric|between:50,2000',
                'name' => [
                    'required',
                    Rule::unique('foods')->ignore($id)
                ],
                'description' => 'required',



            ];
            $customMessages = [

             'price.between' => 'Price must only be between ₱50 to ₱1000',

            ];

            $this->validate($request, $rules, $customMessages);

            $foods->food_type = $data['food_type'];
            $foods->price = $data['price'];
            $foods->name = $data['name'];
            $foods->description = $data['description'];
            $foods->status = 1;


            $foods->save();
            return response()->json(['success' => true, 'message' => $message]);
        }
        return view('Backend.Foods.add_edit_food')->with(compact('title','foods'));
    }

    // -- END ADD-EDIT Foods FOR FOOD

    // -- START UPDATE FOOD STATUS

     public function updateFoodStatus(Request $request){

        if($request->ajax()){
            $data = $request->all();
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
           Food::where('id',$data['food_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'food_id'=>$data['food_id']]);
        }
    }

    //  -- END UPDATE FOOD STATUS

    // -- START DELETE FOOD

       //Delete Food
       public function deleteFood($id)
       {
            //Finding the id to delete
            $foods = Food::findOrFail($id);

           // Delete Food from database
           $foods->delete();

           $message = "Food deleted successfully!";
           return redirect('foods-management/foods')->with('success_message', $message);
       }

    // -- END DELETE FOOD
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
class IndexController extends Controller
{

    public function index(){
        $sliderBanners = Banner::where('type','Slider')->where('status',1)->get()->toArray();
        $header = Banner::where('type','header')->where('status',1)->get()->toArray();
        $fix1Banner = Banner::where('type','Fix1')->where('status',1)->get()->toArray();
        $circle = Banner::where('type','Circle')->where('status',1)->get()->toArray();
        return view('Frontend.index')->with(compact('sliderBanners','fix1Banner','header','circle'));


    }
}

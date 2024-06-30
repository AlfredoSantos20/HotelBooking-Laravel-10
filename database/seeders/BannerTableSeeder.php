<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Banner;

class BannerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bannerRecords = [

            ['id'=>1,'image'=>'banner1.png','type'=>'','link'=>'2023 New Collection','title'=>'New Collection','alt'=>'New Collection','status'=>1],

          ];
          Banner::insert($bannerRecords);
    }
}

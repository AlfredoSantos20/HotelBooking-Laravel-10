<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Accounts;
use Hash;

class AccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('admin12345');
        $AccountsRecord = [
            ['id'=>1,'Fname'=>'Tazki','Lname'=>'Santos','acc_type'=>'superadmin','address'=>'sta maria','mobile'=>'09958847884','sex'=>'Male',
            'email'=>'admin@admin.com','password'=>$password,'image'=>'','status'=>1,'created_at' => now(), 'updated_at' => now()],

        ];
        Accounts::insert($AccountsRecord);
    }
}

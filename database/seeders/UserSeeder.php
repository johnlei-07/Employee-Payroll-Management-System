<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user = User::create([
            'email' => 'test1@yahoo.com',
            'password' => Hash::make('password123'),
            'usertype'=> 'admin'
           
        ]);

        // $user->employees()->create([
        //     'Name' => 'Test2222',
        //     'Phone' => '0909123123',
        //     'Address' => 'Purok test',
        //     'WorkingStatus' => 'FullTime',
        //     'Department' => 'IT',
        //     'BasicSalary' => 1111,
        //     'NumDays'=> 12,
        //     'OverTime' => 222,
        //     'Bonus' => 3333,
        //     'Total'=> 4444
        // ]);
    }
}

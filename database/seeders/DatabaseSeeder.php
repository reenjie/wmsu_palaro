<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Carousel;
use App\Models\Videolink;
use App\Models\Batch;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder

{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


        User::create([
            'name' => 'SuperAdmin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'address' => 'fakeaddress',
            'contactno' => '00000',
            'user_type' => 'superadmin',
            'CollegeId' => 0,
            'fl' => 1,
            'sports_id' => 0,
            'date_register' => now(),
            'image' => '',
        ]);

        Carousel::create([
            'images' => '1663158093.jpg',
            'priority' => 1,
            'sports_id' => null,
            'isactive' => null,
            'date_added' => now(),
        ]);
        Carousel::create([
            'images' => '1663158130.jpg',
            'priority' => 1,
            'sports_id' => null,
            'isactive' => null,
            'date_added' => now(),
        ]);
        Carousel::create([
            'images' => '1663158141.jpg',
            'priority' => 1,
            'sports_id' => null,
            'isactive' => null,
            'date_added' => now(),
        ]);

        Videolink::create([
            'video' => 'https://www.youtube.com/watch?v=tPbeMrVLzpM',
            'videotype' => 'youtube',
            'priority' => 1,
            'event' => 0,
            'CollegeId' => 0,
            'date_added' => now(),
        ]);

        Batch::create([
            'title' => 'WMSU PALARO ' . date('Y'),
            'status' => 1
        ]);
    }
}

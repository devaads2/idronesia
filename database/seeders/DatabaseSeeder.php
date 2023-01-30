<?php

namespace Database\Seeders;

use App\Models\Batteries;
use App\Models\Drone;
use App\Models\Equipments;
use App\Models\Kits;
use App\Models\Project;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        Drone::create([
            'drone_name' => 'KF101',
            'max_flying_alt' => '120M',
            'adjustable_angel_camera' => '90',
            'eis' => 'X',
            'control_distance' => '600M',
            'wifi_transmission' => '600M',
            'video_res' => '1920^729',
            'photo_res' => '1920^729',
            'product_weight' => '500GR',
            'image' => 'drone.jpeg'
        ]);

        Drone::create([
            'drone_name' => 'KF102',
            'max_flying_alt' => '130M',
            'adjustable_angel_camera' => '110',
            'eis' => 'X',
            'control_distance' => '300M',
            'wifi_transmission' => '400M',
            'video_res' => '1920^729',
            'photo_res' => '1920^729',
            'product_weight' => '400GR',
            'image' => 'kits.jpeg'
        ]);

        Batteries::create([
            'batteries_name' => 'CBR99',
            'type' => 'L900 PRO Series',
            'long_life' => '25 Min',
            'capacity' => '2200MAH',
            'voltage' => '7.4V',
            'image' => 'batteries.jpg'
        ]);

        Batteries::create([
            'batteries_name' => 'CBR11',
            'type' => 'L900 PRO',
            'long_life' => '10 Min',
            'capacity' => '2200MAH',
            'voltage' => '1V',
            'image' => 'batteries.jpg'
        ]);

        Equipments::create([
            'equipments_name' => 'Hardoose Bag',
            'type' => 'DJI Mavio Air 2s',
            'description' => '-',
            'image' => 'equipments.jpg'
        ]);

        Equipments::create([
            'equipments_name' => 'Softix Bag',
            'type' => 'Full KGP 2s',
            'description' => 'Lorem ipsum',
            'image' => 'equipments.jpg'
        ]);

        Kits::create([
            'kits_name' => 'Tool Kit Set',
            'type' => '-',
            'description' => '-',
            'image' => 'kits.jpg'
        ]);

        Kits::create([
            'kits_name' => 'Tool Kit Set New',
            'type' => '-',
            'description' => '-',
            'image' => 'kits.jpg'
        ]);

        

    }
}

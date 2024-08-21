<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Country;
use App\Models\State;
use App\Models\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $state = State::where('name', 'Tamil Nadu')->first();

        // dd($state);

        $cities = [
            [$state->id, 'Chennai'],
            [$state->id, 'Coimbatore'],
            [$state->id, 'Madurai'],
            [$state->id, 'Tiruchirappalli'],
            [$state->id, 'Salem'],
            [$state->id, 'Tirunelveli'],
            [$state->id, 'Erode'],
            [$state->id, 'Tiruppur'],
            [$state->id, 'Vellore'],
            [$state->id, 'Thoothukudi'],
            [$state->id, 'Dindigul'],
            [$state->id, 'Thanjavur'],
            [$state->id, 'Ranipet'],
            [$state->id, 'Nagercoil'],
            [$state->id, 'Cuddalore'],
            [$state->id, 'Kanchipuram'],
            [$state->id, 'Kumarapalayam'],
            [$state->id, 'Karaikudi'],
            [$state->id, 'Hosur'],
            [$state->id, 'Kumbakonam'],
            [$state->id, 'Tiruvannamalai'],
            [$state->id, 'Ambur'],
            [$state->id, 'Karur'],
            [$state->id, 'Nagapattinam'],
            [$state->id, 'Udhagamandalam (Ooty)'],
            [$state->id, 'Pollachi'],
            [$state->id, 'Rajapalayam'],
            [$state->id, 'Gudiyatham'],
            [$state->id, 'Sivakasi'],
            [$state->id, 'Pudukkottai'],
            [$state->id, 'Namakkal'],
            [$state->id, 'Vaniyambadi'],
            [$state->id, 'Theni Allinagaram'],
            [$state->id, 'Tiruchengode'],
            [$state->id, 'Viluppuram'],
            [$state->id, 'Thiruvallur'],
            [$state->id, 'Arakkonam'],
            [$state->id, 'Manapparai'],
            [$state->id, 'Pattukkottai'],
            [$state->id, 'Ramanathapuram'],
            [$state->id, 'Palani'],
            [$state->id, 'Coonoor'],
            [$state->id, 'Perambalur'],
            [$state->id, 'Pernampattu'],
            [$state->id, 'Vedaranyam'],
            [$state->id, 'Uthiramerur'],
            [$state->id, 'Thuraiyur'],
            [$state->id, 'Sirkali'],
            [$state->id, 'Arani'],
            [$state->id, 'Jayankondam'],
            [$state->id, 'P.N.Patti'],
            [$state->id, 'Devakottai'],
            [$state->id, 'Kottagudem'],
            [$state->id, 'Palladam'],
            [$state->id, 'Gobichettipalayam'],
            [$state->id, 'Sankarankoil'],
            [$state->id, 'Panruti'],
            [$state->id, 'Tindivanam'],
            [$state->id, 'Periyakulam'],
            [$state->id, 'Pattiveeranpatti'],
            [$state->id, 'Sirumugai'],
            [$state->id, 'Oddanchatram'],
            [$state->id, 'Pallapatti'],
            [$state->id, 'Pudupatti'],
            [$state->id, 'Peranampattu'],
            [$state->id, 'Thirukkattupalli'],
            [$state->id, 'Pudupalaiyam Aghraharam'],
            [$state->id, 'Rasipuram'],
            [$state->id, 'Othakadai'],
            [$state->id, 'Puliangudi'],
            [$state->id, 'Pennagaram'],
            [$state->id, 'Pappireddipatti'],
        ];

        foreach ($cities as $row) 
        {
            City::create([
                'state_id' => $row[0],
                'name' => $row[1],
                // 'code' => $row[2],
            ]);
        }

    }
}
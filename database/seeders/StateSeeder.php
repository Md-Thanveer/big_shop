<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\State;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $country = Country::where('name', 'india')->first();

        $states = [
            [$country->id, "Andaman and Nicobar Islands", "AN"],
            [$country->id, "Andhra Pradesh", "AP"],
            [$country->id, "Arunachal Pradesh", "AR"],
            [$country->id, "Assam", "AS"],
            [$country->id, "Bihar", "BR"],
            [$country->id, "Chandigarh", "CH"],
            [$country->id, "Chhattisgarh", "CT"],
            [$country->id, "Dadra and Nagar Haveli and Daman and Diu", "DN"],
            [$country->id, "Delhi", "DL"],
            [$country->id, "Goa", "GA"],
            [$country->id, "Gujarat", "GJ"],
            [$country->id, "Haryana", "HR"],
            [$country->id, "Himachal Pradesh", "HP"],
            [$country->id, "Jharkhand", "JH"],
            [$country->id, "Karnataka", "KA"],
            [$country->id, "Kerala", "KL"],
            [$country->id, "Ladakh", "LA"],
            [$country->id, "Lakshadweep", "LD"],
            [$country->id, "Madhya Pradesh", "MP"],
            [$country->id, "Maharashtra", "MH"],
            [$country->id, "Manipur", "MN"],
            [$country->id, "Meghalaya", "ML"],
            [$country->id, "Mizoram", "MZ"],
            [$country->id, "Nagaland", "NL"],
            [$country->id, "Odisha", "OR"],
            [$country->id, "Puducherry", "PY"],
            [$country->id, "Punjab", "PB"],
            [$country->id, "Rajasthan", "RJ"],
            [$country->id, "Sikkim", "SK"],
            [$country->id, "Tamil Nadu", "TN"],
            [$country->id, "Telangana", "TG"],
            [$country->id, "Tripura", "TR"],
            [$country->id, "Uttar Pradesh", "UP"],
            [$country->id, "Uttarakhand", "UT"],
            [$country->id, "West Bengal", "WB"],
            [$country->id, "Jammu and Kashmir", "JK"],
        ];

        foreach ($states as $row) {
            State::create([
                'country_id' => $row[0],
                'name' => $row[1],
                'code' => $row[2],
            ]);
        }
    }
}
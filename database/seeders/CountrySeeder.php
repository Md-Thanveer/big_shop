<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries=[
            [
                'name' => 'Unites States of America',
                'code' => 'USA'
            ],

            [
                'name' => 'Canada',
                'code' => 'CAN'
            ],

            [
                'name' => 'United Kingdom',
                'code' => 'UK'
            ],

            [
                'name' => 'India',
                'code' => 'IND'
            ],
        ];

        // DB::table('countries')->insert($countries);

        // or

        foreach ($countries as $row)
        {
            Country::create($row);
        }
    }
}
<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySateCitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $country = Country::create(['name' => 'United State']);

        $state = State::create(['country_id' => $country->id, 'name' => 'Florida']);

        City::create(['state_id' => $state->id, 'name' => 'Miami']);
        City::create(['state_id' => $state->id, 'name' => 'Tampa']);

        $country = Country::create(['name' => 'Bangladesh']);

        $state = State::create(['country_id' => $country->id, 'name' => 'Dhaka']);

        City::create(['state_id' => $state->id, 'name' => 'Mohamadpur']);
        City::create(['state_id' => $state->id, 'name' => 'Abdullapur']);
    }
}

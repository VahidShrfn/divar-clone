<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
require_once app_path('/helpers.php');

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = getProvinces();
        foreach ($states as $state)
        {
            $newState = Address::query()
                ->create([
                    'name' => $state['name'],
                ]);
            $cities = getCities($state['id']);
            foreach ($cities as $city)
            {
                Address::query()
                    ->create([
                        'name' => $city['name'],
                        'parent_id' => $newState['id']
                    ]);
            }
        }
    }
}

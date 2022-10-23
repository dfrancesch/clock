<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # admin@example.com

        Country::upsert(
            [
                [ 'code' => 'ar', 'name' => 'Argentina' ],

            ],
            ['code'],
            ['name']

        );
    }

}

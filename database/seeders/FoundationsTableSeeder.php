<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


class FoundationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            \DB::table('foundations')->insert(
                [
                    'name' => 'Foundation '.$i
                ]
            );
        }
    }
}

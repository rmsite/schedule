<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


class SchedulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('schedules')->insert(
            [
                'foundation_id' => 1,
                'title'          => 'Aula de Futvôlei',
                'content'   => 'Aliquam in finibus neque. Vestibulum nec sollicitudin arcu. Vestibulum tortor arcu, rutrum hendrerit orci sed, laoreet convallis quam. Aenean vitae dictum est.',
                'start'         => '2020-11-16 08:00',
                'end'           => '2020-11-16 09:00',
                'recurrence'    => 5
            ]
        );
        \DB::table('schedules')->insert(
            [
                'foundation_id' => 1,
                'title'          => 'Aula de Futvôlei',
                'content'   => 'Aliquam in finibus neque. Vestibulum nec sollicitudin arcu. Vestibulum tortor arcu, rutrum hendrerit orci sed, laoreet convallis quam. Aenean vitae dictum est.',
                'start'         => '2020-11-17 08:00',
                'end'           => '2020-11-17 09:00',
                'recurrence'    => 5
            ]
        );
        \DB::table('schedules')->insert(
            [
                'foundation_id' => 1,
                'title'          => 'Aula de Futvôlei',
                'content'   => 'Aliquam in finibus neque. Vestibulum nec sollicitudin arcu. Vestibulum tortor arcu, rutrum hendrerit orci sed, laoreet convallis quam. Aenean vitae dictum est.',
                'start'         => '2020-11-18 08:00',
                'end'           => '2020-11-18 09:00',
                'recurrence'    => 5
            ]
        );
        \DB::table('schedules')->insert(
            [
                'foundation_id' => 1,
                'title'          => 'Aula de Futvôlei',
                'content'   => 'Aliquam in finibus neque. Vestibulum nec sollicitudin arcu. Vestibulum tortor arcu, rutrum hendrerit orci sed, laoreet convallis quam. Aenean vitae dictum est.',
                'start'         => '2020-11-19 08:00',
                'end'           => '2020-11-19 09:00',
                'recurrence'    => 5
            ]
        );
        \DB::table('schedules')->insert(
            [
                'foundation_id' => 1,
                'title'          => 'Aula de Futvôlei',
                'content'   => 'Aliquam in finibus neque. Vestibulum nec sollicitudin arcu. Vestibulum tortor arcu, rutrum hendrerit orci sed, laoreet convallis quam. Aenean vitae dictum est.',
                'start'         => '2020-11-20 08:00',
                'end'           => '2020-11-20 09:00',
                'recurrence'    => 5
            ]
        );
        \DB::table('schedules')->insert(
            [
                'foundation_id' => 1,
                'title'          => 'Aula de Futvôlei',
                'content'   => 'Aliquam in finibus neque. Vestibulum nec sollicitudin arcu. Vestibulum tortor arcu, rutrum hendrerit orci sed, laoreet convallis quam. Aenean vitae dictum est.',
                'start'         => '2020-11-21 08:00',
                'end'           => '2020-11-21 09:00',
                'recurrence'    => 5
            ]
        );
        \DB::table('schedules')->insert(
            [
                'foundation_id' => 1,
                'title'          => 'Aula de Judô',
                'content'   => 'Aliquam in finibus neque. Vestibulum nec sollicitudin arcu. Vestibulum tortor arcu, rutrum hendrerit orci sed, laoreet convallis quam. Aenean vitae dictum est.',
                'start'         => '2020-11-20 09:00',
                'end'           => '2020-11-20 10:00',
                'recurrence'    => 0
            ]
        );
        \DB::table('schedules')->insert(
            [
                'foundation_id' => 1,
                'title'          => 'Aula de Judô',
                'content'   => 'Aliquam in finibus neque. Vestibulum nec sollicitudin arcu. Vestibulum tortor arcu, rutrum hendrerit orci sed, laoreet convallis quam. Aenean vitae dictum est.',
                'start'         => '2020-11-22 09:00',
                'end'           => '2020-11-22 10:00',
                'recurrence'    => 0
            ]
        );
    }
}

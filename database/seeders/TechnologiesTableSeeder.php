<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $technologies = [
            [
                'name' => 'HTML5',
                'color' => '#540099'
            ],
            [
                'name' => 'Javascript',
                'color' => '#007fff'
            ],
            [
                'name' => 'CSS3',
                'color' => '#b25d72'
            ],
            [
                'name' => 'Vue 3',
                'color' => '#b25d72'
            ],
            [
                'name' => 'PHP',
                'color' => '#b25d72'
            ],
            [
                'name' => 'Laravel 9',
                'color' => '#b25d72'
            ],
            [
                'name' => 'Bootstrap 5',
                'color' => '#b25d72'
            ],
            [
                'name' => 'Vite',
                'color' => '#b25d72'
            ]
        ];

        foreach ($technologies as $technology) {
            $newTechnology = new Technology();
            $newTechnology->name = $technology['name'];
            $newTechnology->color = $technology['color'];
            $newTechnology->save();
        }
    }
}

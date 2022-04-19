<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RobotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('robots')->insert([
            'amarillo' => 10,
            'rojo' => 0,
            'rosa' => 0,
            'naranja' => 0
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;
use Carbon\Carbon;

class ShoeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        for ($i = 1; $i <= 4; $i++) {
            DB::table('shoes')->insert([
                'type' => 'SP00' . $i,
                'excerpt' => 'Adidas type SP00' . $i,
                'description' => 'Adidas type SP00' . $i . '. ' . $faker->paragraph(rand(2, 4)),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}

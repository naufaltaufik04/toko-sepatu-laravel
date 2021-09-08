<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ShoeDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shoeColor = [
            ['Vivid Red', 'Light Purple', 'Clear Mint'],
            ['Chalk White', 'Halo Silver'],
            ['Core Black', 'Chalk White'],
            ['Cloud White', 'Collegiate Royal', 'Core Black']
        ];

        $id = 1;
        foreach ($shoeColor as $colors) {
            foreach ($colors as $color) {
                $totalSize = rand(2, 5);
                $price = 1500000;
                for ($i = 1; $i < $totalSize; $i++) {
                    DB::table('shoe_details')->insert([
                        'shoe_id'   => $id,
                        'color'     => $color,
                        'size'      => 38 + $i,
                        'stock'     => rand(0, 10),
                        'weight'    => 200,
                        'price'     => $price += 50000,
                        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                    ]);
                }
            }
            $id++;
        }
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Hotel;
use Faker\Factory as Faker;

class hotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i=0; $i < 100; $i++) {
            Hotel::create([
                'name'=>$faker->name,
                'description'=>$faker->paragraph,
                'link'=>'/detail',
                'image'=>'IMG_3092-1-1200x800.jpg'
            ]);
        }
    }
}

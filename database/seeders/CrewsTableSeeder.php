<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

use DB;
use Str;

class CrewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $educationLevels = ['High school', 'Bachelor', 'Master', 'PhD'];
        foreach(range(1,100) as $value){
            $randomIndex = array_rand($educationLevels);
            DB::table('crews')->insert([
                "crewid" => Str::random(7),
                "firstname" => $faker->firstname,
                "lastname" => $faker->lastname,
                "middlename" => $faker->lastname,
                "email" => $faker->email,
                "address" => $faker->address,
                "education" => $educationLevels[$randomIndex],
                "contactnumber" => $faker->phoneNumber,
            ]);
        }
    }
}

<?php

use Illuminate\Database\Seeder;

class FakerClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $section = ['transport', 'logistic', 'finances'];

        for ($i = 0; $i<=30; $i++) {
            $client = [
                'full_name' => $faker->name,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'priority' => rand(1, 10),
                'section' => array_random($section),
                'budget' => rand(1000, 100000),
                'location' => $faker->country,
                'zip' => $faker->postcode,
                'city' => $faker->city,
                'country' => $faker->country,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ];

             DB::table('clients')->insert($client);
        }
    }
}
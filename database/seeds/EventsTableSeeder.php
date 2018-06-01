<?php

use Illuminate\Database\Seeder;
use App\Event;
use Faker\Factory;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

		// Event::truncate();

		foreach(range(1, 80) as $i)
		{
			// $start = $faker->time('H:i:s');

			Event::create([
				'name' => $faker->sentence(6),
				'description' => $faker->text(100),
				'place' => $faker->address,
				// 'date' => $faker->date,
				'time' => $faker->time('H:i'),
				'date' => date_format($faker->dateTimeBetween('-2 months', '+6 months'), 'Y-m-d'),
				'state' => $faker->randomElement(['active', 'inactive']),
				'user_id' => mt_rand(1,50)
			]);
		}
    }
}

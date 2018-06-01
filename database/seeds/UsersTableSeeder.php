<?php

use Illuminate\Database\Seeder;
use App\User;
use App\UserInfo;
use App\CustomerInfo;
use Faker\Factory;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

		// User::truncate();

		User::create([
			'email' 	=> 'admin@admin.com',
			'password' 	=> Hash::make('admin'),
			'type' 		=> 'admin',
			'state' 	=> 'active'
		]);

		foreach(range(1, 50) as $i)
		{
			$type = $faker->randomElement(['user', 'customer']);

			User::create([
				'email' 	=> $faker->unique()->safeEmail,
				'password' 	=> Hash::make('12345'),
				'type' 		=> $type,
				'state' 	=> $faker->randomElement(['active', 'inactive'])
			]);

			if($type == 'user')
			{
				UserInfo::create([
					'first_name'	=> $faker->firstname,
					'last_name'		=> $faker->lastname,
					'dni'			=> $faker->randomNumber(8),
					'address'		=> $faker->address,
					'phone'			=> $faker->numerify('0########'),
					'cell_phone'	=> $faker->numerify('9########'),
					'user_id'		=> $i
				]);
			} else
			{
				CustomerInfo::create([
					'business_name'	=> $faker->company,
					'ruc'				=> $faker->numerify('10#########'),
					'address'			=> $faker->address,
					'phone'				=> $faker->numerify('0########'),
					'cell_phone'		=> $faker->numerify('9########'),
					'user_id'			=> $i
				]);
			}
		}
    }
}

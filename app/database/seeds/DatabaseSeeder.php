<?php

class DatabaseSeeder extends Seeder 
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
		$this->call('TestUserTableSeeder');
		$this->call('ArtistTableSeeder');
	}
}

class UserTableSeeder extends Seeder
{
	public function run()
	{
		if(($fp = fopen(base_path() . '/data/users.csv', 'r')) !== false){
            fgetcsv($fp); //ignore first line
			while(($arr = fgetcsv($fp)) !== false){
				User::create([
					'f_name' => $arr[1],
					'l_name' => $arr[2],
					'b_day' => $arr[3],
                    'gender' => $arr[0],
					'email' => $arr[4],
					'password' => Hash::make($arr[5]),
					'address' => $arr[6],
					'city' => $arr[7],
					'state' => $arr[8],
					'zip' => $arr[9],
					'phone' => $arr[10],
				]);
			}
		}
		else{
			echo "Problem opening file";
		}
	}
}

class TestUserTableSeeder extends Seeder
{
	public function run()
	{
		$admin = User::create([
			'f_name' => 'Tomasz',
			'l_name' => 'Imielinski',
			'b_day' => '1950-01-01',
            'gender' => 'M',
			'email' => 'tomaszi@gmail.com',
			'password' => Hash::make('CS336Project'),
			'address' => '123 Rutgers St',
			'city' => 'New Brunswick',
			'state' => 'NJ',
			'zip' => '07134',
			'phone' => '123-456-7890',
		]);
		$admin->admin = true;
		$admin->save();

		$user = User::create([
			'f_name' => 'Data',
			'l_name' => 'Student',
			'b_day' => '1990-01-01',
            'gender' => 'M',
			'email' => 'student@gmail.com',
			'password' => Hash::make('CS336Project'),
			'address' => '456 Rutgers St',
			'city' => 'New Brunswick',
			'state' => 'NJ',
			'zip' => '07134',
			'phone' => '123-456-7890',
			'admin' => false
		]);
	}
}

class ArtistTableSeeder extends Seeder
{
	public function run()
	{
        //read in json format
        $input = file_get_contents(base_path() . '/data/artists.json');
        $json = json_decode($input);

        foreach($json as $json_obj){
            if (! $json_obj->genre) {
                continue;
            }

            Artist::create([
                'name' => $json_obj->name,
                'genre_id' => Genre::firstOrCreate(['name' => $json_obj->genre])->id,
                'artistlink_id' => $json_obj->id,
            ]);
        }
	}
}


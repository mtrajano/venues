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
		// $this->call('TestUserTableSeeder');
		// $this->call('GenreTableSeeder');
		// $this->call('ArtistTableSeeder');
		// $this->call('VenueTableSeeder');
		// $this->call('ShowTableSeeder');
		$this->call('LikeTableSeeder');
	}
}

class UserTableSeeder extends Seeder
{
	public function run()
	{
		if(($fp = fopen(base_path() . '/data/users.csv', 'r')) !== false){
            fgetcsv($fp); //ignore first line
			while(($arr = fgetcsv($fp)) !== false){
				try {
					User::create([
						'f_name' => $arr[0],
						'l_name' => $arr[1],
						'b_day' => $arr[2],
	                    'gender' => $arr[3],
						'email' => $arr[4],
						'password' => Hash::make($arr[5]),
						'address' => $arr[6],
						'city' => $arr[7],
						'state' => $arr[8],
						'zip' => $arr[9],
						'phone' => $arr[10],
					]);
				}
				catch(Exception $e){
					//in case any of the generated emails were not unique
					continue;
				}
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

class GenreTableSeeder extends Seeder
{
	public function run()
	{
		Genre::create(['name' => 'No Genre']);
	}
}

class ArtistTableSeeder extends Seeder
{
	public function run()
	{
		//read in json format
		$input = file_get_contents(base_path() . '/data/artists.json');
		$json = json_decode($input);

		foreach($json as $json_obj) {
			Artist::create([
				'name' => $json_obj->name,
				'jambase_id' => $json_obj->jambase_id,
				'number_likes' => (str_replace( ',', '', $json_obj->number_fans) > 20000) ? ($json_obj->number_fans / 10) : $json_obj->number_fans //only 20000 users
			]);
		}

		$input = file_get_contents(base_path() . '/data/genres.json');
		$json = json_decode($input);

		foreach($json as $name=>$genre) {
			if(!$genre){
				continue;
			}

			Artist::where('name', $name)->update(['genre_id' => Genre::firstOrCreate(['name' => $genre])->id]);
		}
	}
}

class VenueTableSeeder extends Seeder
{
	public function run()
	{
		$input = file_get_contents(base_path() . '/data/venues.json');
		$json = json_decode($input);

		foreach($json as $json_obj){
			Venue::create([
				'name' => $json_obj->name,
				'address' => $json_obj->street,
				'city' => $json_obj->city,
				'state' => $json_obj->state,
				'zip' => $json_obj->zipcode,
				'jambase_id' => $json_obj->jambase_id
			]);
		}

		//malformatted data
		Venue::where('name', 'The Monterey Club')->update(['city' => 'Fort Lauderdale', 'state' => 'FL', 'zip' => '33316']);
    }
}

class ShowTableSeeder extends Seeder
{
	public function run()
	{
        //read in json format
        $input = file_get_contents(base_path() . '/data/shows.json');
        $json = json_decode($input);

        foreach($json as $json_obj){
            Show::create([
                'when' => $json_obj->date,
                'artist_id' => Artist::firstOrCreate(['name' => $json_obj->artist])->id,
                'venue_id' => Venue::firstOrCreate(['name' => $json_obj->venue])
            ]);
        }
	}
}

class LikeTableSeeder extends Seeder
{
	public function run()
	{
		$artists = Artist::all();
        $users = User::all()->toArray();

		foreach($artists as $artist){
			if($artist->number_likes == 0){
				continue;
			}

			$rand_users = array_rand($users, $artist->number_likes);

			if($artist->number_likes == 1){
				User::find($users[$rand_users]['id'])->likes()->attach($artist->id);
				continue;
			}

			foreach($rand_users as $index){
				User::find($users[$index]['id'])->likes()->attach($artist->id);
			}
		}
	}
}


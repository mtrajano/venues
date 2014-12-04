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
		// $this->call('GenreTableSeeder');
		$this->call('ArtistTableSeeder');
		// $this->call('VenueTableSeeder');
		// $this->call('ShowTableSeeder');
		// $this->call('TicketTableSeeder');
		// $this->call('LikeTableSeeder');
		// $this->call('AttendTableSeeder');
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
						'b_day' => date("Y-m-d", strtotime($arr[2])),
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
		}
		else{
			echo "Problem opening file";
		}
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
				'number_likes' => (str_replace( ',', '', $json_obj->number_fans))
			]);
		}

		//only 20,000 users in the db, reduce the ones with likes > 20,000
		Artist::where('name', 'The String Cheese Incident')->update(['number_likes' => rand(4000,5000)]);
		Artist::where('name', 'Keller Williams')->update(['number_likes' => rand(4000,5000)]);
		Artist::where('name', 'Dark Star Orchestra')->update(['number_likes' => rand(4000,5000)]);
		Artist::where('name', 'Railroad Earth')->update(['number_likes' => rand(4000,5000)]);

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
                'when' => date("Y-m-d", strtotime($json_obj->date)),
                'artist_id' => Artist::firstOrCreate(['name' => $json_obj->artist])->id,
                'venue_id' => Venue::firstOrcreate(['name' => $json_obj->venue])->id
            ]);
        }
	}
}

class TicketTableSeeder extends Seeder
{
	public function get_num_sales($num_likes, $price)
	{
		return (0.3 * ( 5*$num_likes + 1000) + 0.75 * (4455 - 30*$price) ) + (rand(0,40) - 20); //random noise
	}

	public function run()
	{
		$shows = Show::all();

		foreach($shows as $show){
			$num_seats = rand(1,3); //random number of seats (1-3 seats)

			for($i=0; $i<$num_seats; $i++){
				$price = rand(4,15) * 10; //prices for seats range from $40-$150

				Ticket::create([
					'show_id' => $show->id,
					'price' => $price,
					'num_sales' => $this->get_num_sales($show->artist->number_likes, $price)
				]);
			}
		}
	}
}

class LikeTableSeeder extends Seeder
{
	public function run()
	{
        $users = User::all()->toArray();

        Artist::chunk(200, function($artists) use ($users)
        {
            foreach($artists as $artist) {
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
        });
	}
}

class AttendTableSeeder extends Seeder
{
	public function run()
	{
		$num_attends = DB::select(DB::raw('SELECT show_id, SUM(num_sales) as num_attends FROM tickets GROUP BY show_id'));
		$users = User::all()->toArray();

		foreach($num_attends as $show_attended){
			$rand_users = array_rand($users, $show_attended->num_attends);

			foreach($rand_users as $index){
				User::find($users[$index]['id'])->attends()->attach($show_attended->show_id);
			}
		}
	}
}


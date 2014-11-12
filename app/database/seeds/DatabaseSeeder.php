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

		$this->call('UserTableSeeder');
		$this->call('TopicTableSeeder');
		$this->call('CategoryTableSeeder');
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
				User::create([
					'f_name' => $arr[1],
					'l_name' => $arr[2],
					'b_day' => $arr[3],
                    'gender' => $arr[0],
					'email' => $arr[4],
					'password' => $arr[5],
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

class TopicTableSeeder extends Seeder
{
	public function run()
	{
		if(($fp = fopen(base_path() . '/data/topics.csv', 'r')) !== false){
            fgetcsv($fp); //ignore first line
			while(($arr = fgetcsv($fp)) !== false){
				Topic::create([
					'name' => $arr[0],
					'category_id' => $arr[1],
				]);
			}
		}
	}
}

class AttendTableSeeder extends Seeder
{
	public function run()
	{
		if(($fp = fopen(base_path() . '/data/attends.csv', 'r')) !== false){
            fgetcsv($fp); //ignore first line
			while(($arr = fgetcsv($fp)) !== false){
				Attend::create([
					'user_id' => $arr[0],
					'event_id' => $arr[1]
				]);
			}
		}
	}
}

class OrganizerTableSeeder extends Seeder
{
	public function run()
	{
		if(($fp = fopen(base_path() . '/data/organizers.csv', 'r')) !== false){
            fgetcsv($fp); //ignore first line
			while(($arr = fgetcsv($fp)) !== false){
				Organizer::create([
					'name' => $arr[0],
					'email' => $arr[1]
				]);
			}
		}
	}
}

class VenueTableSeeder extends Seeder
{
	public function run()
	{
		if(($fp = fopen(base_path() . '/data/venues.csv', 'r')) !== false){
            fgetcsv($fp); //ignore first line
			while(($arr = fgetcsv($fp)) !== false){
				Venue::create([
					'name' => $arr[0],
					'address' => $arr[1],
					'zip' => $arr[2]
				]);
			}
		}
	}
}

class EventTableSeeder extends Seeder
{
	public function run()
	{
		if(($fp = fopen(base_path() . '/data/events.csv', 'r')) !== false){
            fgetcsv($fp); //ignore first line
			while(($arr = fgetcsv($fp)) !== false){
				Event::create([
					'when' => $arr[0],
					'name' => $arr[1],
					'topic_id' => $arr[2],
					'venue_id' => $arr[3]
				]);
			}
		}
	}
}

class CategoryTableSeeder extends Seeder
{
	public function run()
	{
		if(($fp = fopen(base_path() . '/data/categories.csv', 'r')) !== false){
            fgetcsv($fp); //ignore first line
			while(($arr = fgetcsv($fp)) !== false){
				Category::create([
					'name' => $arr[0]
				]);
			}
		}
	}
}

class LikeTableSeeder extends Seeder
{
	public function run()
	{
		if(($fp = fopen(base_path() . '/data/likes.csv', 'r')) !== false){
            fgetcsv($fp); //ignore first line
			while(($arr = fgetcsv($fp)) !== false){
				DB::table('likes')->insert(['user_id' => $arr[0], 'topic_id' => $arr[1]]);
			}
		}
	}
}

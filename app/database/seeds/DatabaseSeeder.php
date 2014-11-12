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

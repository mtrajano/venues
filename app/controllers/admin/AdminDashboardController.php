<?php

class AdminDashboardController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$new_users = DB::select(DB::raw('SELECT * FROM users WHERE created_at > NOW() - INTERVAL 1 WEEK'));
		$new_events = DB::select(DB::raw('SELECT * FROM shows WHERE created_at > NOW() - INTERVAL 1 WEEK'));
		$new_artists = DB::select(DB::raw('SELECT * FROM artists WHERE created_at > NOW() - INTERVAL 1 WEEK'));
		$data=[
			'new_users' => $new_users,
			'new_events' => $new_events,
			'new_artists' => $new_artists
		];
		return View::make('admin.dashboard')->with('data', $data);	
	}
}
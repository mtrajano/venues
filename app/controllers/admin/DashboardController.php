<?php

class DashboardController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$new_users = DB::select(DB::raw('SELECT * FROM users WHERE created_at > NOW() - INTERVAL 1 WEEK'));
		$new_events = DB::select(DB::raw('SELECT * FROM events WHERE created_at > NOW() - INTERVAL 1 WEEK'));
		return View::make('admin.dashboard')->with('new_users', $new_users)->with('new_events', $new_events);	
	}
}
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
		$new_events = DB::select(DB::raw('SELECT * FROM shows WHERE created_at > NOW() - INTERVAL 1 WEEK'));
		$new_artists = DB::select(DB::raw('SELECT * FROM artists WHERE created_at > NOW() - INTERVAL 1 WEEK'));
		
		Paginator::setPageName('show_page');
		$shows = Show::paginate(5);
		
		Paginator::setPageName('user_page');
		$users = User::paginate(5);
		
		Paginator::setPageName('artist_page');
		$artists = Artist::paginate(5);

		$data=[
			'new_users' => $new_users,
			'new_events' => $new_events,
			'new_artists' => $new_artists,
			'shows' => $shows,
			'users' => $users,
			'artists' => $artists
		];
		return View::make('admin.dashboard')->with('data', $data);	
	}
}
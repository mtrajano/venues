<?php

use Carbon\Carbon;

class ShowController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$upcomingShows = Show::whereHas('hostedAt', function($query){
			$query->where('city', '<>', 'NULL')->where('state', '<>', 'NULL');
		})->where('when', '>=', Carbon::now())->orderBy('when')->paginate(10);

		return View::make('shows.index')->with('shows', $upcomingShows);
	}

	public function filterState()
	{
		$state = Input::get('state');
		$upcomingShows = Show::whereHas('hostedAt', function($query) use ($state){
			$query->where('city', '<>', 'NULL')->where('state', $state);
		})->where('when', '>=', Carbon::now())->orderBy('when')->paginate(10);

		return View::make('shows.filter')->with('shows', $upcomingShows);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}

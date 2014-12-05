<?php

class DataController extends \BaseController {

	public function getJsonResponse($model, $id=0) {
		$constraints = Input::all();
		if(!$id){
			return Response::json(DB::table($model)->where($constraints)->get());
		}
		return Response::json(DB::table($model)->find($id));
	}

	public function getXMLResponse($model, $id=0) {
		$constraints = Input::all();
		if(!$id){
			return Response::xml(DB::table($model)->where($constraints)->get());
		}
		return Response::xml(DB::table($model)->find($id));
	}

}
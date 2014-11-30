<?php

class DataController extends \BaseController {

	public function getJsonResponse($model, $id=0) {
		if(!$id){
			return Response::json(DB::table($model)->get());
		}
		return Response::json(DB::table($model)->find($id));
	}

	public function getXMLResponse($model, $id=0) {
		if(!$id){
			return Response::xml(DB::table($model)->get());
		}
		return Response::xml(DB::table($model)->find($id));
	}

}
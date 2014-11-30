<?php

class Artist extends Eloquent
{
	protected $table = 'artists';

	protected $fillable = array('name', 'genre_id', 'description');

	public function genre()
	{
		return $this->belongsTo('Genre');
	}

	public function likedBy() //might not be necessary
	{
		return $this->belongsToMany('User', 'likes');
	}
}

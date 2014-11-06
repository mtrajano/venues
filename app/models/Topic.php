<?php

class Topic extends Eloquent
{
	protected $table = 'topics';

	protected $fillable = array('name', 'category_id', 'description');

	public function classifiedAs()
	{
		return $this->hasOne('Category');
	}

	public function likedBy() //might not be necessary
	{
		return $this->belongsToMany('User', 'likes');
	}
}
<?php

class Genre extends Eloquent
{
	protected $table = 'genres';

	protected $fillable = array('name', 'description');

	public function artists()
	{
		return $this->hasMany('Artist');
	}
}

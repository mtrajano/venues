<?php

class Venue extends Eloquent
{
	protected $table = 'venues';

	protected $fillable = array('name', 'address', 'city', 'state', 'zip', 'phone');

	public function hosted()
	{
		return $this->hasMany('Show');
	}
}
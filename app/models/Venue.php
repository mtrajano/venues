<?php

class Venue extends Eloquent
{
	protected $table = 'venues';

	protected $fillable = array('name', 'address', 'zip', 'phone','city','state');

	public function hosted()
	{
		return $this->hasMany('Show');
	}
}
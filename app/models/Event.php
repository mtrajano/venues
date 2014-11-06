<?php

class Event extends Eloquent
{
	protected $table = 'events';

	protected $fillable = array('when', 'name', 'category_id', 'venue_id', 'organizer_id', 'description');

	public function hostedAt()
	{
		return $this->hasOne('Venue');
	}

	public function organizedBy()
	{
		return $this->hasOne('Organizer');
	}

	public function contains()
	{
		return $this->hasMany('Topic');
	}

	public function attendedBy()
	{
		return $this->belongsToMany('User', 'attends');
	}
}
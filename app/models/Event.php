<?php

class Event extends Eloquent
{
	protected $table = 'events';

	protected $fillable = array('when', 'name', 'artist_id', 'venue_id', 'organizer_id', 'description');

	public function hostedAt()
	{
		return $this->belongsTo('Venue');
	}

	public function contains()
	{
		return $this->belongsTo('Artist');
	}

	public function attendedBy()
	{
		return $this->belongsToMany('User', 'attends');
	}
}

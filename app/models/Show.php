<?php

class Show extends Eloquent
{
	protected $table = 'shows';

	protected $fillable = array('when', 'name', 'artist_id', 'venue_id', 'organizer_id', 'description');

	public function hostedAt()
	{
		return $this->belongsTo('Venue');
	}

	public function artist()
	{
		return $this->belongsTo('Artist');
	}

	public function attendedBy()
	{
		return $this->belongsToMany('User', 'attends');
	}
}

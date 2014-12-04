<?php

class Show extends Eloquent
{
	protected $table = 'shows';

	protected $fillable = array('when', 'name', 'artist_id', 'venue_id', 'organizer_id', 'description');

	public function hostedAt()
	{
		return $this->belongsTo('Venue','venue_id');
	}

	public function artist()
	{
		return $this->belongsTo('Artist','artist_id');
	}

	public function attendedBy()
	{
		return $this->belongsToMany('User', 'attends');
	}

	public function tickets()
	{
		return $this->hasMany('Ticket');
	}
}

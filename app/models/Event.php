<?php

class Event extends Eloquent
{
	protected $table = 'events';

	protected $fillable = array('when', 'name', 'category_id', 'venue_id', 'organizer_id', 'description');
}
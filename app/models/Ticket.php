<?php

class Ticket extends Eloquent
{
	protected $table = 'tickets';

	protected $fillable = array('name', 'genre_id', 'description');
}

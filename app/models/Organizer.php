<?php

class Organizer extends Eloquent
{
	protected $table = 'organizers';

	protected $fillable = array('name', 'email', 'phone');
}
<?php

class Venue extends Eloquent
{
	protected $table = 'venues';

	protected $fillable = array('name', 'address', 'zip', 'phone');
}
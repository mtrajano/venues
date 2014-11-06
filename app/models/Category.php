<?php

class Category extends Eloquent
{
	protected $table = 'categories';

	protected $fillable = array('name', 'description');

	public function topics()
	{
		return $this->belongsTo('Topic');
	}
}
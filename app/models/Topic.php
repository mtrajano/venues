<?php

class Topic extends Eloquent
{
	protected $table = 'topics';

	protected $fillable = array('name', 'category_id', 'description');
}
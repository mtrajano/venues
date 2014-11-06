<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface
{
	use UserTrait, RemindableTrait;

	protected $table = 'users';

	// protected $hidden = array('password', 'remember_token');

	protected $fillable = array('f_name', 'l_name', 'b_day', 'email', 'password', 'address', 'city', 'state', 'zip', 'phone');

	/*
	 * Relationships
	 */
	public function likes()
	{
		return $this->belongsToMany('Topic', 'likes');
	}

	public function attends()
	{
		return $this->belongsToMany('Event', 'attends');
	}

	/*
	 * Accessors and Mutators
	 */

	public function setPhoneAttribute($val)
	{
		$this->attributes['phone'] = preg_replace('/\D+/', '', $val); 
	}
}

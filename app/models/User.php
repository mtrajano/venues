<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface
{
	use UserTrait, RemindableTrait;

	protected $table = 'users';

	protected $hidden = array('created_at', 'updated_at', 'password', 'remember_token');

	protected $fillable = array('f_name', 'l_name', 'b_day', 'email', 'address', 'city', 'state', 'zip', 'phone');

	/*
	 * Relationships
	 */
	public function likes()
	{
		return $this->belongsToMany('Artist', 'likes');
	}

	public function attends()
	{
		return $this->belongsToMany('Show', 'attends');
	}

	/*
	 * Accessors and Mutators
	 */

	public function setPhoneAttribute($val)
	{
		$this->attributes['phone'] = preg_replace('/\D+/', '', $val); 
	}

	public function getPhoneAttribute($phone)
	{
		return preg_replace('~.*(\d{3})[^\d]{,7}(\d{3})[^\d]{,7}(\d{4}).*~', '($1) $2-$3', $phone);
	}
}

<?php

class Ticket extends Eloquent
{
	protected $table = 'tickets';

	protected $fillable = array('show_id', 'price', 'num_sales');
}

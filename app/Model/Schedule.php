<?php
class Schedule extends AppModel{
	public $hasOne = 'Site';
	public $hasMany = 'Event';
}

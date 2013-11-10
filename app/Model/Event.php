<?php
class Event extends AppModel{
	public $belongsTo = array(
		'Camp',
		'Site',
		'Schedule',
	);
}

<?php
App:uses('AppModel', 'Model');
class Camper extends AppModel
{
	/*Associations*/
	public $hasOne = 'User';
	public $hasOne = 'InsuranceCard';
	public $hasAndBelongsToMany = 'Camp';
	public $belongsTo = array
	(
		'CampAssignment' => array
		(
			'className' => 'Camp'
		)
	);
	public $hasOne = array
	(
		'SiteAssignment' => array
		(
			'className' => 'Site'
		)
	);
	public $hasOne = array
	(
		'CampChoice1' => array
		(
			'className' => 'Camp'
		)
	);
	public $hasOne = array
	(
		'CampChoice2' => array
		(
			'className' => 'Camp'
		)
	);

	/*Validations*/
	public $validate = array(
		'age' => 'naturalNumber',
		'birthDate' => array(
			'rule' => array('date', 'mdy'),
			'message' => 'MM/DD/YYYY'
		),
		'over18' => 'boolean',
		'backgroundCheck' => 'boolean',
		'shirtSize' => array(
			'rule' => array('custom', '^S$|^M$|^L$|^XL$|^[2-4]XL$'),
			'message' => 'S, M, L, XL, 2XL, 3XL, or 4XL'
		),
		'paid' => 'boolean',
		'applicationComplete' => 'boolean',
		'accepted' => 'boolean',
		'state' => array(
			'rule' => array('custom', '^[A-Z]{2}$'),
			'message' => 'Postal abbreviation, e.g. SC'
		),
		'zip' => array(
			'rule' => array('postal', null, 'us')
		),
		'email' => 'email',
		'phone' => array(
			'rule' => array('custom', '^[0-9]{10}$'),
			'message' => 'Of the format 8645551234'
		)
		'cell-phone' => array(
			'rule' => array('custom', '^[0-9]{10}$'),
			'message' => 'Of the format 8645551234'
		)
	)
}

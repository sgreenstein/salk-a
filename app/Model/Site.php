<?php
App::uses('AppModel', 'Model');
class Site extends AppModel {
	//Associations
	public $belongsTo = 'Camp';
	public $hasOne = array(
		'Schedule' => array(
			'className' => 'Schedule'
		),
		'Director' => array(
			'className' => 'User'
		)
	);
	public $hasMany = array(
		'Camper' => array(
			'className' => 'Camper',
			'foreignKey' => 'site_assignment'
		),
		'Event'
	);
	//Validations
	public $validate = array(
		'name' => array(
			'rule' => 'alphaNumeric',
			'required' => true,
			'allowEmpty' => false,
			'message' => 'Letters and numbers only'
		)
	);
}

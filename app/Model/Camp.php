<?php
App::uses('AppModel', 'Model');
class Camp extends AppModel {
	//Associations
	public $hasOne = array(
		'Director' => array(
			'className' => 'User'
		)
	);
	public $hasMany = array(
		'Site',
		'Event'
	);
	public $hasAndBelongsToMany = 'Camper';
	//Validations
	public $validate = array(
		'name' => array(
			'rule' => 'alphaNumeric',
			'required' => true,
			'allowEmpty' => false,
			'message' => 'Letters and numbers only'
		),
		'yearActive' => array(
			'rule' => array('date', 'y'),
			'required' => true,
			'allowEmpty' => false
		)
	);
}

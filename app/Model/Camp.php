<?php
App::uses('AppModel', 'Model');
class Camp extends AppModel {
	//Associations
	public $hasOne = array(
		'CampDirector' => array(
			'className' => 'User'
		)
	);
	public $hasMany = array(
		'Site' => array('dependent' => true),
		'Event' => array('dependent' => true)
	);
	public $hasAndBelongsToMany = 'Camper';
	//Validations
	public $validate = array(
		'name' => array(
			'rule' => 'notEmpty'
		),
		'year' => array(
			'rule' => array('date', 'y'),
			'required' => true,
			'allowEmpty' => false,
			'message' => 'Must be a valid year, e.g. 2013'
		)
	);
}

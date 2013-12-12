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
	public $hasAndBelongsToMany = array(
		'Camper' => array(
			'className' => 'Camper',
			'joinTable' => 'campers_camps',
			'foreignKey' => 'camp_id',
			'associationForeignKey' => 'camper_id'
		)
	);
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
		),
		'parent_password' => array(
			'rule' => 'notEmpty'
		)
	);
	//Methods

	//Returns true if user is a camper that is in the camp
	public function isUserInCamp($userId, $campId) {
		$camp = $this->findById($campId);
		foreach ($camp['Camper'] as $camper) {
			if ($camper['user_id'] == $userId) {
				return true;
			}
		}
		unset($camper);
		return false;
	}
}

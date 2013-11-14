<?php
App::uses('AppModel', 'Model');
class InsuranceCard extends AppModel {
	//Associations
	public $hasOne = 'Camper';
	//Validations
	public $validate = array(
		'url' => 'url',
		'required' => true,
		'allowEmpty' => false,
		'message' => 'Must be a valid url'
	);
}

<?php
App::uses('AppModel', 'Model');
class InsuranceCard extends AppModel {
	/*Associations*/
	public $hasOne = 'Camper';
	/*Validations*/
	public $validate = array(
		'location' => 'url'
	);
}

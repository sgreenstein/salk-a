<?php
App::uses('AppModel', 'Model');
class Camper extends AppModel
{
	//Associations
	public $belongsTo = array(
		'User',
//		'InsuranceCard' => array(
//			'dependent' => true
//		),	
		'SiteAssignment' => array(
			'className' => 'Site',
			'foreignKey' => 'site_assignment'
		),
		'CampAssignment' => array(
			'className' => 'Camp',
			'foreignKey' => 'camp_assignment'
		),
		'CampChoice1' => array(
			'className' => 'Camp',
			'foreignKey' => 'camp_choice_1'
		),
		'CampChoice2' => array(
			'className' => 'Camp',
			'foreignKey' => 'camp_choice_2'
		)
	);

	public $hasAndBelongsToMany = array(
		'Camp' => array(
			'className' => 'Camp',
			'joinTable' => 'campers_camps',
			'foreignKey' => 'camper_id',
			'associationForeignKey' => 'camp_id'
		)
 	);
	//Virtual fields
	public $virtualFields = array(
		'age' => "YEAR(NOW())-YEAR(Camper.birth_date)",
		'over_18' => "YEAR(NOW())-YEAR(Camper.birth_date) >= 18"
	);
	
	//Validations
	public $validate = array(
//		'age' => 'naturalNumber',
//		'birthDate' => array(
//			'rule' => 'notEmpty',
//			'rule' => array('date', 'mdy'),
//			'message' => 'MM/DD/YYYY',
//			'allowEmpty' => false,
//			'required' => true
//		),
//		'over18' => 'boolean',
		'backgroundCheck' => 'boolean',
		'camp_choice_1' => array(
			'rule' => array('differentFieldValues', 'camp_choice_2'),
			'message' => 'Camp choices must be different.'
		),
		'shirt_size' => array(
			'rule' => array('custom', '/^S$|^M$|^L$|^XL$|^[2-4]XL$/'),
			'message' => 'S, M, L, XL, 2XL, 3XL, or 4XL',
			'required' => true,
			'allowEmpty' => false
		),
		'paid' => 'boolean',
		'applicationComplete' => 'boolean',
		'accepted' => 'boolean',
		'assigned' => 'boolean',
		'state' => array(
			'rule' => array('custom', '/^[A-Z]{2}$/'),
			'message' => 'Postal abbreviation, e.g. SC',
			'required' => true,
			'allowEmpty' => false
		),
		'zip' => array(
			'rule' => array('postal', null, 'us'),
			'message' => 'Must be a valid zip code',
			'required' => true,
			'allowEmpty' => false
		),
		'email' => array(
			'rule' => 'email',
			'message' => 'Must be a valid email address',
			'required' => true,
			'allowEmpty' => false
		),
		'phone' => array(
			'rule' => array('custom', '/^[0-9]{10}$/'),
			'message' => 'Of the format 8645551234',
			'required' => true,
			'allowEmpty' => false
		),
		'cell-phone' => array(
			'rule' => array('custom', '/^[0-9]{10}$/'),

			'message' => 'Of the format 8645551234'
		),
		'church' => array(
			'rule' => 'notEmpty',
			'required' => true,
			'allowEmpty' => false
		),
		'address_1' => array(
			'rule' => 'notEmpty',
			'required' => true,
			'allowEmpty' => false
		),
		'district' => array(
			'rule' => 'notEmpty',
			'required' => true,
			'allowEmpty' => false
		),
		'city' => array(
			'rule' => 'notEmpty',
			'required' => true,
			'allowEmpty' => false
		)
	);
	
	function differentFieldValues($field=array(), $compare_field=null)
	{
		foreach($field as $key => $value) {
			$v1 = $value;
			$v2 = $this->data[$this->name][$compare_field];
			if($v1 === $v2) {
				return false;
			}
			else {
				continue;
			}
		}
		return true;
	}
}

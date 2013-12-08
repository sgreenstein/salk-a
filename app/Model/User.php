<?php
// app/Model/User.php
App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel {
    // associations
    public $hasOne = array(
	    'Camper' => array('dependent' => true)
    );
    
    public $hasMany = array(
        'Blog' => array('dependent' => true),
        'Photo' => array('dependent' => true)
    );
    
    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A username is required.'
            ),
			'unique' => array(
				'rule' => 'isUnique',
				'required' => 'create',
				'message' => 'Username already taken.'
			),
			'alphanumeric' => array(
				'rule'    => 'alphaNumeric',
				'message' => 'Usernames must only contain letters and numbers.'
			)
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A password is required.'
            ),
			'length' => array(
				'rule' => array('minLength', 8),
				'message' => 'Passwords must be at least 8 characters long.'
			)
	),
	'confirm_password' => array(
		'equaltofield' => array(
			'rule' => array('equaltofield','password'),
			'message' => 'Confirm password must match password.',
			'allowEmpty' => false,
			'required' => true,
			'on' => 'create', // Limit validation to 'create' or 'update' operations
		 )
	)
    );
	
/*
    public $virtualFields = array(
	    'name' => 'CONCAT(Users.first_name, " ", Users.last_name)'
    );
 */

    public function __construct($id = false, $table = null, $ds = null) {
	        parent::__construct($id, $table, $ds);
		    $this->virtualFields['name'] = sprintf('CONCAT(%s.first_name, " ", %s.last_name)', $this->alias, $this->alias);
    }

    function equaltofield($check,$otherfield) {
	//get name of field
	 $fname = '';
	 foreach ($check as $key => $value){
	 	$fname = $key;
		break;
	 }
	 return $this->data[$this->name][$otherfield] === $this->data[$this->name][$fname];
    }

	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}
		return true;
	}
}
?>

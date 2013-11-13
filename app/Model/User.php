<?php
// app/Model/User.php
App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel {
    // associations
    public $hasOne = array(
	    'Form' => array('dependent' => true),
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
        )
    );
	
	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}
		return true;
	}
}
?>

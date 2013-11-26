<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

	App::uses('Controller', 'Controller');
	public $theme = "Cakestrap"; /* For Views */

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $helpers = array('Html', 'Form');

	public $components = array(
		'DebugKit.Toolbar',
		'Session',
		'Auth' => array(
			'loginRedirect' => array('controller' => 'users', 'action' => 'login'),
			'logoutRedirect' => array('controller' => 'pages', 'action' => 'index'),
			'authorize' => array('Controller')
		)
	);
	
	public function beforeFilter() {
		$this->Auth->allow('login', 'logout');
	}
	
	public function isAuthorized($user) {
		// Admin can access every function
		if (isset($user['level']) && $user['level'] == 100) {
			return true;
		}
		
		return false;
	}

}
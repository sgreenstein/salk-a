<?php
App::uses('AppController', 'Controller');
class CampsController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
	}
	//views all camps
	public function index() {
		$this->set('camps', $this->Camp->find('all'));
	}
	//views one camp
	public function view($id = null) {
		if(!$id) {
			throw new NotFoundException(__('Invalid camp'));
		}

		$camp = $this->Camp->findById($id);
		if(!$camp) {
			throw new NotFoundException(__('Invalid camp'));
		}
		$this->set('camp', $camp);
	}

	//views a camp using the parent password
	public function parentView($id = null) {
		if(!$id) {
			throw new NotFoundException(__('Invalid camp'));
		}

		$camp = $this->Camp->findById($id);
		if(!$camp) {
			throw new NotFoundException(__('Invalid camp'));
		}
		$this->set('camp', $camp);
		$parentId = $this->Session->read('parent_password');
		if(!$parentId || $parentId != $camp['Camp']['parent_password']) {
			$this->redirect(array('action' => 'parentLogin', $id));
		}
	}

	//logs in a parent
	public function parentLogin($id = null) {
		if(!$id) {
			throw new NotFoundException(__('Invalid camp'));
		}

		$camp = $this->Camp->findById($id);
		if(!$camp) {
			throw new NotFoundException(__('Invalid camp'));
		}
		$this->set('camp', $camp);
		if($this->request->is(array('post', 'put'))) {
			$this->Session->write('parent_password', $this->request->data['Camp']['parent_password']);
			$this->redirect(array('action' => 'parentView', $id));
		}
	}


	//creates a new camp
	public function add() {
		if ($this->request->is('post')) {
			$this->Camp->create();
			$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
			$pass = array(); //remember to declare $pass as an array
			$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
			for ($i = 0; $i < 8; $i++) {
				$n = rand(0, $alphaLength);
				$pass[] = $alphabet[$n];
			}
			$this->request->data['Camp']['parent_password'] = implode($pass); //turn the array into a string
			if ($this->Camp->save($this->request->data)) {
				$this->Session->setFlash(__('Camp successfully created.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Camp could not be created.'));
		}
	}
	//edits an existing camp
	public function edit($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid camp'));
		}
		$camp = $this->Camp->findById($id);
		if (!$camp) {
			throw new NotFoundException(__('Invalid camp'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$this->Camp->id = $id;
			if ($this->Camp->save($this->request->data)) {
				$this->Session->setFlash(__('The camp has been updated.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('The camp could not be updated. Please try again.'));
		}
		if (!$this->request->data) {
			$this->request->data = $camp;
		}
	}

	public function chooseDirector($id = null) {
		//for displaying a list of possible camp directors to choose from.
		//The choose_director view should then call setDirector(this camp's id, chosen user's id)
		//to actually set the director to the chosen user
		$this->set('possibleDirectors', $this->Camp->CampDirector->find('all'));
		if(!$id) {
			throw new NotFoundException(__('Invalid camp'));
		}

		$camp = $this->Camp->findById($id);
		if(!$camp) {
			throw new NotFoundException(__('Invalid camp'));
		}
		$this->set('camp', $camp);
	}

	public function setDirector($id = null, $userId = null) {
		//sets user with id $userId as the camp director for the camp with id $id
		if ($this->request->is('post')) {
			if(!$id) {
				throw new NotFoundException(__('Invalid camp'));
			}
			$camp = $this->Camp->findById($id);
			if(!$camp) {
				throw new NotFoundException(__('Invalid camp'));
			}
			if(!$userId) {
				throw new NotFoundException(__('Invalid user'));
			}
			$user = $this->Camp->CampDirector->findById($userId);
			if(!$user) {
				throw new NotFoundException(__('Invalid user'));
			}
			if ($this->request->is(array('post', 'put'))) {
				$camp['CampDirector'] = $user;
				$camp['CampDirector']['camp_id'] = $id;
				$camp['Camp']['user_id'] = $userId;
				//debug($camp);
				if($this->Camp->saveAssociated($camp)) {
					$this->Session->setFlash(__('Camp director set.'));
					return $this->redirect(array('action' => 'view', $id));
				}
			}
			else {
				$this->Session->setFlash(__('Camp director could not be set.'));
			}
		}
	}

	//deletes a camp
	public function delete($id = null) {
		if(!$id) {
			throw new NotFoundException(__('Invalid camp'));
		}
		$camp = $this->Camp->findById($id);
		if(!$camp) {
			throw new NotFoundException(__('Invalid camp'));
		}		
		if ($this->request->is('post') || $this->request->is('put')) {
			if($this->Camp->delete($id, true)) {
				$this->Session->setFlash(__('Camp deleted'));
				return $this->redirect(array('action' => 'index'));
			}
		}
		$this->Session->setFlash(__('Could not delete the camp'));
	}
	//adds a site to this camp
	public function addSite($id = null) {
		if ($this->request->is('post')) {
			if(!$id) {
				throw new NotFoundException(__('Invalid camp'));
			}
			$camp = $this->Camp->findById($id);
			if(!$camp) {
				throw new NotFoundException(__('Invalid camp'));
			}
			if ($this->request->is(array('post', 'put'))) {
				$this->Camp->Site->create();
				$this->request->data['Site']['camp_id'] = $id;
				if($this->Camp->Site->save($this->request->data)) {
					$this->Session->setFlash(__('Site added'));
					return $this->redirect(array('action' => 'view', $id));
				}
			}
			else {
				$this->Session->setFlash(__('Site could not be added.'));
			}
		}
	}
	public function isAuthorized($user) {
		if (!isset($user)) return false;
		switch($this->action) {
			// camp director can access own camp
			case 'edit':
			case 'addSite':
				if($user['camp_id'] == $this->request->params['pass']['0'])
					return true;
				break;
			case 'deleteSite':
				$camp = $this->Camp->findById($this->request->params['pass']['0']);
				if($user['camp_id'] == $camp['Camp']['id'])
					return true;
			// campers, parents can view their camp
			case 'view':
				if($this->Camp->isUserInCamp($user['id'], $this->request->params['pass']['0']))			
					return true;
		}
		return parent::isAuthorized($user);
	}
}

<?php
App::uses('AppController', 'Controller');
class CampersController extends AppController {
	//views all campers
	public function index() {
		$this->set('campers', $this->Camper->find('all'));
	}
	//views one camper
	public function view($id = null) {
		if(!$id) {
			throw new NotFoundException(__('Invalid camper'));
		}

		$camper = $this->Camper->findById($id);
		if(!$camper) {
			throw new NotFoundException(__('Invalid camper'));
		}
		$this->set('camper', $camper);
	}
	//creates a camper for this user
	//corresponds to filling out the application form
	public function add() {
		$this->set('campChoices', $this->Camper->Camp->find('list'));
		if ($this->request->is('post')) {
			//tie the camper to the current user
			$this->request->data['Camper']['user_id'] = $this->Auth->user('id');
			$this->Camper->create();
//			debug($this->request->data);
			if ($this->Camper->save($this->request->data)) {
				$this->Session->setFlash(__('Camper successfully created.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Camper could not be created.'));
		}
	}
	//edits an existing camper
	public function edit($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid camper'));
		}
		$camper = $this->Camper->findById($id);
		if (!$camper) {
			throw new NotFoundException(__('Invalid camper'));
		}
		$this->set('camper', $camper);
		if ($this->request->is(array('post', 'put'))) {
			$this->Camper->id = $id;
			if ($this->Camper->save($this->request->data)) {
				$this->Session->setFlash(__('The camper has been updated.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('The camper could not be updated. Please try again.'));
		}
		if (!$this->request->data) {
			$this->request->data = $camper;
		}
	}

	public function addInsuranceCard($id = null) {
		if(!$id) {
			throw new NotFoundException(__('Invalid camper'));
		}
		$camper = $this->Camper->findById($id);
		if(!$camper) {
			throw new NotFoundException(__('Invalid camper'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$this->Camper->InsuranceCard->create();
			$this->request->data['InsuranceCard']['camper_id'] = $id;
			//TODO add InsuranceCard's id to camper
			if($this->Camper->InsuranceCard->save($this->request->data)) {
				$this->Session->setFlash(__('Card added'));
				return $this->redirect(array('action' => 'view', $id));
			}
		}
		else {
			$this->Session->setFlash(__('Card could not be added.'));
		}
	}

	//assigns a camper to a camp, puts the camp in their list of past camps
	public function assignCamp($id = null) {
		$this->set('camps', $this->Camper->Camp->find('list'));
		if(!$id) {
			throw new NotFoundException(__('Invalid camper'));
		}
		$camper = $this->Camper->findById($id);
		if(!$camper) {
			throw new NotFoundException(__('Invalid camper'));
		}
		$this->set('choice1', $camper['Camper']['camp_choice_1']);
		$this->set('choice2', $camper['Camper']['camp_choice_2']);
		if ($this->request->is(array('post', 'put'))) {
			$this->Camper->id = $id;
			if($this->Camper->saveAll($this->request->data)) {
				$this->Session->setFlash(__('Assigned to camp'));
				return true;
			}
			$this->Session->setFlash(__('Could not be assigned. Please try again.'));
		}
		if (!$this->request->data) {
			$this->request->data = $camper;
		}
	}	
	//deletes a camper
	public function delete($id = null) {
		if(!$id) {
			throw new NotFoundException(__('Invalid camper'));
		}
		$camper = $this->Camper->findById($id);
		if(!$camper) {
			throw new NotFoundException(__('Invalid camper'));
		}		
		if ($this->request->is('post') || $this->request->is('put')) {
			if($this->Camper->delete($id)) {
				$this->Session->setFlash(__('Camper deleted'));
			return $this->redirect(array('action' => 'index'));
			}
		}
		$this->Session->setFlash(__('Could not delete the camper'));
	}
	//returns true if user is authorized to peform the action
	public function isAuthorized($user) {
		if (!isset($user)) return false;
		switch($this->action) {
			// camper can edit and view himself
			case 'edit':
			case 'addInsuranceCard':
				$camper = $this->Camper->findById($this->request->params['pass']['0']);
				if($user['id'] == $camper['User']['id'])
					return true;
				break;
			// camper can see himself, site directors and camp directors can see him
			case 'view':
				$camper = $this->Camper->findById($this->request->params['pass']['0']);
					if($user['id'] == $camper['User']['id'] || $user['site_id'] == $camper['SiteAssignment']['id'] || $user['camp_id'] == $camper['Camper']['camp_assignment'])
						return true;
				break;
			// user can only create their camper if the user has not already created a camper
			// admins cannot become campers
			case 'add':
				if(!$user['camper_id'] && $user['level'] < 100)
					return true;
				else
					return false;
				break;
		}
		// call parent
		return parent::isAuthorized($user);
	}
}

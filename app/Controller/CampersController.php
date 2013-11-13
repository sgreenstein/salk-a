<?php
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
	//creates a new camper
	public function add() {
		if ($this->request->is('post')) {
			$this->Camper->create();
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
				$camper = $this->Camper->findById($this->request->params['pass']['0']);
//				debug($camper);
//				return true;
				if($user['id'] == $camper['User']['id'])
					return true;
				break;
			// camper can see himself, site directors and camp directors can see him
			case 'view':
				$camper = $this->Camper->findById($this->request->params['pass']['0']);
					if($user['id'] == $camper['User']['id'] || $user['site_id'] == $camper['SiteAssignment']['id'] || $user['camp_id'] == $camper['Camper']['camp_assignment'])
					return true;
		}
		// call parent
		return parent::isAuthorized($user);
	}
}

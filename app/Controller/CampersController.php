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
		$this->set('camper', $site);
	}
	//creates a new camper
	public function add() {
		if ($this->request->is('post')) {
			$this->Camper->create();
			if ($this->Camper->save($this->request->data)) {
				$this->Session->setFlash(__('Camper successfully created.'));
				//TODO: create a new schedule tied to this camper
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
				$this->Session->setFlash(__('Camper %s deleted'));
			return $this->redirect(array('action' => 'index'));
			}
		}
		$this->Session->setFlash(__('Could not delete the camper'));
	}
}

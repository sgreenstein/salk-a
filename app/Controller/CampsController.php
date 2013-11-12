<?php
class CampsController extends AppController {
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
	//creates a new camp
	public function add() {
		if ($this->request->is('post')) {
			$this->Camp->create();
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
			if($this->Camp->delete($id)) {
				$this->Session->setFlash(__('Camp deleted'));
				return $this->redirect(array('action' => 'index'));
			}
		}
		$this->Session->setFlash(__('Could not delete the camp'));
	}
	//adds a site to this camp
	public function addSite($id = null) {
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

<?php
App::uses('AppController', 'Controller');
class InsuranceCardsController extends AppController {
	//views one insuranceCard
	public function view($id = null) {
		if(!$id) {
			throw new NotFoundException(__('Invalid insuranceCard'));
		}

		$insuranceCard = $this->InsuranceCard->findById($id);
		if(!$insuranceCard) {
			throw new NotFoundException(__('Invalid insuranceCard'));
		}
		$this->set('insuranceCard', $insuranceCard);
	}
	//creates a new insuranceCard
	public function add() {
		if ($this->request->is('post')) {
			$this->InsuranceCard->create();
			if ($this->InsuranceCard->save($this->request->data)) {
				$this->Session->setFlash(__('InsuranceCard successfully created.'));	
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('InsuranceCard could not be created.'));
		}
	}
	//edits an existing insuranceCard
	public function edit($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid insurance card'));
		}
		$insuranceCard = $this->InsuranceCard->findById($id);
		if (!$insuranceCard) {
			throw new NotFoundException(__('Invalid insurance card'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$this->InsuranceCard->id = $id;
			if ($this->InsuranceCard->save($this->request->data)) {
				$this->Session->setFlash(__('The insurance card has been updated.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('The insurance card could not be updated. Please try again.'));
		}
		if (!$this->request->data) {
			$this->request->data = $insuranceCard;
		}
	}

	public function isAuthorized($user) {
		if (!isset($user)) return false;
		switch($this->action) {
			// camp director can access if own camp
			// site director can access if own site
			// camper can access if own
			case 'view':
				$insuranceCard = $this->InsuranceCard->findById($this->request->params['pass']['0']);
				return true;
				if($user['camp_id'] == $insuranceCard['Camp']['id'])
					return true;
				if($user['site_id'] == $insuranceCard['Site']['id'])
					return true;
				break;
			case 'edit':
			case 'add':
				if($user['id'] == $this->InsuranceCard->Camper)
					return true;
		}
		// call parent
		return parent::isAuthorized($user);
	}
}

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
		$this->set('campChoices', $this->Camper->Camp->find('list',
			array('conditions' => array('Camp.year' => date('Y')))
		));
		if ($this->request->is('post')) {
			//tie the camper to the current user
			$this->request->data['Camper']['user_id'] = $this->Auth->user('id');
			$this->Camper->create();
			if ($this->Camper->save($this->request->data)) {
				$this->Session->setFlash(__('Application saved.'));
				return $this->redirect(array('action' => 'view'));
			}
			$this->Session->setFlash(__('Application form could not be saved.'));
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
		$this->set('campChoices', $this->Camper->Camp->find('list'));
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
		$this->set('currentCard', $camper['Camper']['insurance_card']);
		if(!$camper) {
			throw new NotFoundException(__('Invalid camper'));
		}
		if ($this->request->is(array('post', 'put'))) {
			// upload the file to the server
			$fileOK = $this->uploadFiles('img/insurance_cards', $this->request->data['Camper']);
			// if file was uploaded ok
			 if(array_key_exists('urls', $fileOK)) {
				//delete the old file
				if(is_readable($camper['Camper']['insurance_card'])) {
					unlink($camper['Camper']['insurance_card']);
				}
			 	// save the url in the form data
				$this->request->data['Camper']['insurance_card'] = $fileOK['urls'][0];
			 }
			 else {
				 $this->Session->setFlash(__('Upload failed'));
				 return;
			 }
			$this->Camper->id = $id;
			if($this->Camper->save($this->request->data, array(
				'validate' => false, 'fieldList' => array(
					'insurance_card')))) {
				$this->Session->setFlash(__('Card added'));
				return $this->redirect(array('action' => 'edit', $id));
			}
			else {
				$this->Session->setFlash(__('Card could not be added.'));
			}
		}
	}
    
    public function addFormPdf($id = null) {
		if(!$id) {
			throw new NotFoundException(__('Invalid camper'));
		}
		$camper = $this->Camper->findById($id);
		if(!$camper) {
			throw new NotFoundException(__('Invalid camper'));
		}
		$this->set('currentForm', $camper['Camper']['form_pdf']);
		if ($this->request->is(array('post', 'put'))) {
			// upload the file to the server
			$fileOK = $this->uploadFiles('img/form_pdf', $this->request->data['Camper']);
			// if file was uploaded ok
			if(array_key_exists('urls', $fileOK)) {
				//delete the old file
				if(is_readable($camper['Camper']['form_pdf'])) {
					unlink($camper['Camper']['form_pdf']);
				}
				// save the url in the form data
				 $fileName = $fileOK['urls'][0];
				 $fileName = preg_replace("/(\.jpg$)/", ".pdf", $fileName);
				$this->request->data['Camper']['form_pdf'] = $fileName;
			 }
			 else {
				 $this->Session->setFlash(__('Upload failed'));
			 }
			$this->Camper->id = $id;
			if($this->Camper->save($this->request->data, array(
				'validate' => false, 'fieldList' => array(
					'form_pdf')))) {
				$this->Session->setFlash(__('Form uploaded'));
				return $this->redirect(array('action' => 'view', $id));
			}
			else {
				$this->Session->setFlash(__('Form could not be uploaded.'));
			}
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
	
	public function applicationComplete($id = null) {
		//marks a camper's application as complete if:
		//form is uploaded, insurance card is uploaded,
		//and camp choices are valid
		if(!$id) {
			throw new NotFoundException(__('Invalid camper'));
		}
		$camper = $this->Camper->findById($id);
		if(!$camper) {
			throw new NotFoundException(__('Invalid camper'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			$completer = array('Camper' => array('id' => $id, 'application_complete' => true));
			if ($camper['Camper']['insurance_card'] != null)
				$this->Session->setFlash(__('Insurance card photo must be uploaded to complete application.'));
			elseif ($camper['Camper']['form_pdf'] != null)
				$this->Session->setFlash(__('PDF form must be uploaded to complete application.'));
			elseif (($camper['Camper']['camp_choice_1'] == null) || ($camper['Camper']['camp_choice_2'] == null))
				$this->Session->setFlash(__('Camp choices must be filled in to complete application.'));
			elseif ($this->Camper->save($completer, array('validate' => false)))
				$this->Session->setFlash(__('Application complete.'));
			else
				$this->Session->setFlash(__('Application could not be marked complete.'));
		}
		return $this->redirect(array('action' => 'view', $id));
	}
	
	public function yearlyReset() {
		//resets camp choices, background check,
		//application complete, accepted
		//called by admin
		if ($this->request->is('post') || $this->request->is('put')) {
			if($this->Camper->updateAll(
				array(
					'id' => $id,
					'accepted' => false,
					'camp_choice_1' => null,
					'camp_choice_2' => null,
					'background_check' => false,
					'application_complete' => false
				)
			)) {
				$this->Session->setFlash(__('All campers reset'));
				return $this->redirect(array('action' => 'index'));
			}
		}
		$this->Session->setFlash(__('Could not reset all campers.'));
		return $this->redirect(array('action' => 'index'));
	}

	public function togglePaid($id = null) {
		//if camper has not paid, then marks them as having paid.
		//If they have already been marked as paid,
		//it marks them as not having paid
		//called by admin
		if(!$id) {
			throw new NotFoundException(__('Invalid camper'));
		}
		$camper = $this->Camper->findById($id);
		if(!$camper) {
			throw new NotFoundException(__('Invalid camper'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			$payer = array('Camper' => array('id' => $id, 'paid' => !$camper['Camper']['paid']));
			if($this->Camper->save($payer, array('validate' => false))) {
				if($camper['Camper']['paid'])
					$this->Session->setFlash(__("Camper marked as not having paid."));
				else
					$this->Session->setFlash(__('Camper marked as having paid.'));
				return $this->redirect(array('action' => 'view', $id));
			}
		}
		$this->Session->setFlash(__("Could not toggle the camper's paid status."));
		return $this->redirect(array('action' => 'view', $id));
	}

	public function toggleAcceptance($id = null) {
		//if camper is not accepted, then marks them as accepted into
		//the salkehatchie program.
		//If they have already been accepted, it unaccepts them.
		//called by admin
		if(!$id) {
			throw new NotFoundException(__('Invalid camper'));
		}
		$camper = $this->Camper->findById($id);
		if(!$camper) {
			throw new NotFoundException(__('Invalid camper'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			$acceptee = array('Camper' => array('id' => $id, 'accepted' => !$camper['Camper']['accepted']));
			if($this->Camper->save($acceptee, array('validate' => false))) {
				if($camper['Camper']['accepted'])
					$this->Session->setFlash(__("Camper's acceptance revoked"));
				else
					$this->Session->setFlash(__('Camper accepted'));
				return $this->redirect(array('action' => 'view', $id));
			}
		}
		$this->Session->setFlash(__("Could not toggle the camper's acceptance status."));
		return $this->redirect(array('action' => 'view', $id));
	}


	public function toggleBackgroundCheck($id = null) {
		//if camper has not passed, then marks them as passed
		//If they have already been marked as passed, it marks them as not passed
		//called by admin
		if(!$id) {
			throw new NotFoundException(__('Invalid camper'));
		}
		$camper = $this->Camper->findById($id);
		if(!$camper) {
			throw new NotFoundException(__('Invalid camper'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			$passer = array('Camper' => array('id' => $id, 'background_check' => !$camper['Camper']['background_check']));
			if($this->Camper->save($passer, array('validate' => false))) {
				if($camper['Camper']['background_check'])
					$this->Session->setFlash(__('Background check marked as incomplete.'));
				else
					$this->Session->setFlash(__('Background check marked as complete.'));
				return $this->redirect(array('action' => 'view', $id));
			}
		}
		$this->Session->setFlash(__('Could not mark background check as passed.'));
		return $this->redirect(array('action' => 'view', $id));
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
			case 'application_complete':
			case 'addInsuranceCard':
            		case 'addFormPDF':
				$camper = $this->Camper->findById($this->request->params['pass']['0']);
				if(!$camper)
					break;
				if($user['id'] == $camper['User']['id'])
					return true;
				break;
			// camper can see himself, site directors and camp directors can see him
			case 'view':
				$camper = $this->Camper->findById($this->request->params['pass']['0']);
				if(!$camper)
					return true;
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

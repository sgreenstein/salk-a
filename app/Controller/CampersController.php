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
		//populate dropdown boxes and other data
		$this->set('camper', $camper);
		$this->set('camps', $this->Camper->Camp->find('list'));
		//if assigned to a camp, set that as default choice
		//populate site choices with that camp's sites
		if ($camper['CampAssignment']['id']) {
			$defaultCampChoice = $camper['CampAssignment']['id'];
			$this->set('sites', $this->Camper->Camp->Site->find('list', array(
				'conditions' => array('camp_id' => $camper['CampAssignment']['id'])
			)));
		}
		else {
			$defaultCampChoice = $camper['Camper']['camp_choice_1'];
		}
		$this->set('defaultCampChoice', $defaultCampChoice);
		//if we're getting post or put request, user is trying to set the camp or site
		if ($this->request->is(array('post', 'put'))) {
			//set either the camp or site, as appropriate
			if(array_key_exists('Camp', $this->request->data))
				$this->assignToCamp($id, $this->request->data['Camp']['Camp'][0]);
			else if (array_key_exists('Camper', $this->request->data))
				$this->assignToSite($id, $this->request->data['Camper']['Site']);
		}
	}
	//creates a camper for this user
	//corresponds to filling out the application form
	public function add() {
		//populate dropdown boxes
		$this->set('shirtSizes', array('S'=>'S', 'M'=>'M', 'L'=>'L', 'XL'=>'XL', '2XL'=>'2XL', '3XL'=>'3XL', '4XL'=>'4XL')); 
		$this->set('campChoice1s', $this->Camper->Camp->find('list',
			array('conditions' => array('Camp.year' => date('Y')))
		));
		$this->set('campChoice2s', $this->Camper->Camp->find('list',
			array('conditions' => array('Camp.year' => date('Y')))
		));
		if ($this->request->is('post')) {
			//tie the camper to the current user
			$this->request->data['Camper']['user_id'] = $this->Auth->user('id');
			$this->Camper->create();
			if ($this->Camper->save($this->request->data)) {
				$this->Session->setFlash(__('Application saved.'));
				$id = $this->Auth->user('id');
				return $this->redirect(array('controller' => 'users', 'action' => 'view', $id));
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
		//populate dropdown boxes
		$this->set('camper', $camper);
		$this->set('shirtSizes', array('S'=>'S', 'M'=>'M', 'L'=>'L', 'XL'=>'XL', '2XL'=>'2XL', '3XL'=>'3XL', '4XL'=>'4XL')); 
		$this->set('campChoice1s', $this->Camper->Camp->find('list',
			array('conditions' => array('Camp.year' => date('Y')))
		));
		$this->set('campChoice2s', $this->Camper->Camp->find('list',
			array('conditions' => array('Camp.year' => date('Y')))
		));
		if ($this->request->is(array('post', 'put'))) {
			$this->Camper->id = $id;
			if ($this->Camper->save($this->request->data)) {
				$this->Session->setFlash(__('The camper has been updated.'));
				return $this->redirect(array('action' => 'view', $id));
			}
			$this->Session->setFlash(__('The camper could not be updated. Please try again.'));
		}
		if (!$this->request->data) {
			$this->request->data = $camper;
		}
	}

	public function assignToCamp($id = null, $campId = null) {
		//Assigns camper with id $id to the camp of id $campId
		//make sure camper and camp are valid
		if (!$id)
			throw new NotFoundException(__('Invalid camper'));
		if (!$campId)
			throw new NotFoundException(__('Invalid camp'));
		$camper = $this->Camper->findById($id);
		if (!$camper)
			throw new NotFoundException(__('Invalid camp'));
		if($this->request->is(array('post','put'))) {
			//assigning to camp
			if ($camper['Camper']['accepted'] == 1) {
				//must have been accepted to Salkehatchie already
				//remove from site, change camp assignment and assignment boolean
				$data = array('Camp' => array('id' => $campId),
					'Camper' => array('id' => $id, 'assigned' => 1, 'site_assignment' => null, 'camp_assignment' => $campId));
				if ($this->Camper->saveAll($data, array('validate' => false))) {
					$this->Session->setFlash(__('Assigned the camper to the camp.'));
					$this->redirect(array('action' => 'view', $id));
				}
				else {
					$this->Session->setFlash(__('Could not assign the camper to the camp.'));
				}
			}
			else {
				$this->Session->setFlash(__("You must accept the camper before assigning to a camp"));
			}
		}
	}

	public function assignToSite($id = null, $siteId = null) {
		//assigns camper with id $id to site with id $siteId
		//make sure site and camper are valid
		if (!$id)
			throw new NotFoundException(__('Invalid camper'));
		if (!$siteId)
			throw new NotFoundException(__('Invalid site'));
		$camper = $this->Camper->findById($id);
		if (!$camper)
			throw new NotFoundException(__('Invalid site'));
		if($this->request->is(array('post','put'))) {
			//assigning to site
			if ($camper['Camper']['accepted'] == 1) {
				$data = array('Site' => array('id' => $siteId),
					'Camper' => array('id' => $id, 'site_assignment' => $siteId));
				if ($this->Camper->saveAll($data, array('validate' => false))) {
					$this->Session->setFlash(__('Assigned the camper to the site.'));
					$this->redirect(array('action' => 'view', $id));
				}
				else {
					$this->Session->setFlash(__('Could not assign the camper to the site.'));
				}
			}
			else {
				$this->Session->setFlash(__("You must accept the camper before assigning to a site"));
			}
		}
	}

	public function addInsuranceCard($id = null) {
		//uploads a picture of the camper's insurance card
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
		//uploads a pdf form
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
		//resets camp and site assignments,
		//camp choices, background check,
		//application complete, accepted, paid
		//called by admin
		if ($this->request->is('post') || $this->request->is('put')) {
			if($this->Camper->updateAll(
				array(
					'Camper.accepted' => 0,
					'Camper.assigned' => 0,
					'Camper.camp_assignment' => null,
					'Camper.site_assignment' => null,
					'Camper.camp_choice_1' => null,
					'Camper.camp_choice_2' => null,
					'Camper.paid' => 0,
					'Camper.background_check' => 0,
					'Camper.application_complete' => 0
				),
				array('Camper.id >' => 0)
			)) {
				$this->Session->setFlash(__('All campers reset'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Could not reset all campers.'));
			return $this->redirect(array('action' => 'index'));
		}
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
					break; //camper doesn't exist
				if($user['id'] == $camper['User']['id'])
					return true; //this is the camper
				if($user['site_id'] && $user['site_id'] == $camper['SiteAssignment']['id'])
					return true; //site director of camper's current site
				if($user['camp_id'] && $user['camp_id'] == $camper['Camper']['camp_assignment'])
					return true; //camp director of camper's current camp
				break;
			//camp director can assign camper to site
			case 'assignToSite':
				if($user['camp_id'] && $user['camp_id'] == $camper['Camper']['camp_assignment'])
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

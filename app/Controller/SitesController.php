<?php
App::uses('AppController', 'Controller');
class SitesController extends AppController {
	//views all sites
	public function index() {
		$this->set('sites', $this->Site->find('all'));
	}
	//views one site
	public function view($id = null) {
		if(!$id) {
			throw new NotFoundException(__('Invalid site'));
		}

		$site = $this->Site->findById($id);
		if(!$site) {
			throw new NotFoundException(__('Invalid site'));
		}
		$this->set('site', $site);
	}
	//creates a new site
	public function add() {
		if ($this->request->is('post')) {
			$this->Site->create();
			if ($this->Site->save($this->request->data)) {
				$this->Session->setFlash(__('Site successfully created.'));
				//TODO: create a new schedule tied to this site
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Site could not be created.'));
		}
	}
	//edits an existing site
	public function edit($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid site'));
		}
		$site = $this->Site->findById($id);
		if (!$site) {
			throw new NotFoundException(__('Invalid site'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$this->Site->id = $id;
			if ($this->Site->save($this->request->data)) {
				$this->Session->setFlash(__('The site has been updated.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('The site could not be updated. Please try again.'));
		}
		if (!$this->request->data) {
			$this->request->data = $site;
		}
	}
	//deletes a site
	public function delete($id = null) {
		if(!$id) {
			throw new NotFoundException(__('Invalid site'));
		}
		$site = $this->Site->findById($id);
		if(!$site) {
			throw new NotFoundException(__('Invalid site'));
		}		
		if ($this->request->is('post') || $this->request->is('put')) {
			if($this->Site->delete($id)) {
				$this->Session->setFlash(__('Site deleted'));
			return $this->redirect(array('controller' => 'camps', 'action' => 'view', $site['Camp']['id']));
			}
		}
		$this->Session->setFlash(__('Could not delete the site'));
	}

	public function isAuthorized($user) {
		if (!isset($user)) return false;
		switch($this->action) {
			// camp director can access if own camp
			// site director can access if own site
			case 'edit':
			case 'view':
				$site = $this->Site->findById($this->request->params['pass']['0']);
				if($user['camp_id'] == $site['Camp']['id'])
					return true;
				if($user['site_id'] == $site['Site']['id'])
					return true;
				break;
			// camp director can delete site if own camp
			case 'delete':
				$site = $this->Site->findById($this->request->params['pass']['0']);
				if($user['camp_id'] == $site['Camp']['id'])
					return true;	
		}
		// call parent
		return parent::isAuthorized($user);
	}
}

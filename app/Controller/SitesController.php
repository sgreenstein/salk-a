<?php
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
				$this->Session->setFlash(__('Site %s deleted'));
			return $this->redirect(array('action' => 'index'));
			}
		}
		$this->Session->setFlash(__('Could not delete the site'));
	}
}

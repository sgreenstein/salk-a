<?php
class SitesController extends AppController {
	public function index() {
		$this->set('sites', $this->Site->find('all'));
	}

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
	public function add() {
		if ($this->request->is('site')) {
			$this->Site->create();
			if ($this->Site->save($this->request->data)) {
				$this->Session->setFlash(__('Site successfully created.'));
			return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Site could not be created.'));
		}
	}
}

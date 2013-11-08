<?php
class SiteController extends AppController {
	public function index() {
		$this->set('sites', $this->Site->find('all'));
	}
}

<?php
class CampsController extends AppController {
	public function index() {
		$this->set('camps', $this->Camp->find('all'));
	}
}

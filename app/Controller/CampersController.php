<?php
class CampersController extends AppController {
	public function index() {
		$this->set('campers', $this->Camper->find('all'));
	}
}

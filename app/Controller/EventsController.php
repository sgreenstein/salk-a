<?php
App::uses('AppController', 'Controller');
/**
 * Events Controller
 *
 * @property Event $Event
 * @property PaginatorComponent $Paginator
 */
class EventsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		//if admin, show all events
		if($this->Auth->user('level') >= 100) {
			$this->set('events', $this->Event->find('all'));
		}
		//show only events user is part of
		else {
			//check for directors
			$campId = $this->Session->read('Auth.User.camp_id');
			$siteId = $this->Session->read('Auth.User.site_id');
			if($campId)
			{
				//camp director. Show all events in camp
				$options['conditions'] = array('Event.camp_id' => $campId);
			}
			else
			{
				if($siteId)
				{
					//site director. Set his $campId
					$site = $this->Event->Site->findById($siteId);
					$campId = $site['Site']['camp_id'];
				}
				else
				{
					//camper. Set his $campId and $siteId
					$campId = $this->Session->read('Auth.User.Camper.camp_assignment');
					$siteId = $this->Session->read('Auth.User.Camper.site_assignment');
				}
				$options['conditions'] = array(
					'Event.camp_id' => $campId,
					'OR' => array(
						array('Event.site_id' => null),
						array('Event.site_id' => $siteId),
					)
				);
			}
			$this->set('events', $this->Event->find('all', $options));
		}
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Event->exists($id)) {
			throw new NotFoundException(__('Invalid event'));
		}
		$options = array('conditions' => array('Event.' . $this->Event->primaryKey => $id));
		$this->set('event', $this->Event->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Event->create();
			if ($this->Event->save($this->request->data)) {
				$this->Session->setFlash(__('The event has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The event could not be saved. Please, try again.'), 'flash/error');
			}
		}
		//allow for campwide events
		if($this->Session->read('Auth.User.level') >= 100)
		{
			$camps = $this->Event->Camp->find('list');
			$sites = $this->Event->Site->find('list');
		}
		else
		{
			$campId = $this->Session->read('Auth.User.camp_id');
			if($campId)
			{
				//camp director. Populate sites from that camp
				$camps = $this->Event->Camp->find('list', array('conditions' => array(
					'Camp.id' => $campId
				)));
				$sites = $this->Event->Site->find('list', array('conditions' => array(
					'Site.camp_id' => $campId
				)));
			}
			else
			{
				//site director. Populate with his site and the camp it's part of
				$sites = $this->Event->Site->find('list', array('conditions' => array(
					'Site.id' => $this->Session->read('Auth.User.site_id')
				)));
				$site = $this->Event->Site->findById($this->Session->read('Auth.User.site_id'));
				$camps = $this->Event->Camp->find('list', array('conditions' => array(
					'Camp.id' => $site['Camp']['id']
				)));
			}
		}
		$this->set(compact('camps', 'sites'));
		$this->set(compact('camps', 'sites'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
        $this->Event->id = $id;
		if (!$this->Event->exists($id)) {
			throw new NotFoundException(__('Invalid event'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Event->save($this->request->data)) {
				$this->Session->setFlash(__('The event has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The event could not be saved. Please, try again.'), 'flash/error');
			}
		} else {
			$options = array('conditions' => array('Event.' . $this->Event->primaryKey => $id));
			$this->request->data = $this->Event->find('first', $options);
		}
		//allow for campwide events
		if($this->Session->read('Auth.User.level') >= 100)
		{
			$camps = $this->Event->Camp->find('list');
			$sites = $this->Event->Site->find('list');
		}
		else
		{
			$campId = $this->Session->read('Auth.User.camp_id');
			if($campId)
			{
				//camp director. Populate sites from that camp
				$camps = $this->Event->Camp->find('list', array('conditions' => array(
					'Camp.id' => $campId
				)));
				$sites = $this->Event->Site->find('list', array('conditions' => array(
					'Site.camp_id' => $campId
				)));
			}
			else
			{
				//site director. Populate with his site and the camp it's part of
				$sites = $this->Event->Site->find('list', array('conditions' => array(
					'Site.id' => $this->Session->read('Auth.User.site_id')
				)));
				$site = $this->Event->Site->findById($this->Session->read('Auth.User.site_id'));
				$camps = $this->Event->Camp->find('list', array('conditions' => array(
					'Camp.id' => $site['Camp']['id']
				)));
			}
		}
		$this->set(compact('camps', 'sites'));
		$this->set(compact('camps', 'sites'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Event->id = $id;
		if (!$this->Event->exists()) {
			throw new NotFoundException(__('Invalid event'));
		}
		if ($this->Event->delete()) {
			$this->Session->setFlash(__('Event deleted'), 'flash/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Event was not deleted'), 'flash/error');
		$this->redirect(array('action' => 'index'));
	}

	public function isAuthorized($user) {
		if (!isset($user)) return false;
		switch($this->action) {
			// camp directors, site directors can edit, delete own events
			case 'edit':
			case 'delete':
				$event = $this->Event->findById($this->request->params['pass']['0']);
				if($this->Session->read('Auth.User.camp_id') == $event['Event']['camp_id'])
					return true;
				if($event['Event']['site_id'] &&
						$this->Session->read('Auth.User.site_id') == $event['Event']['site_id'])
					return true;
				break;
			// camp directors, site directors can add events
			case 'add':
				if($user['level'] >= 50)
					return true;
				break;
			// camp directors, site directors, campers can view their current camp's events
			case 'view':
				$event = $this->Event->findById($this->request->params['pass']['0']);
				if($this->Session->read('Auth.User.camp_id') == $event['Event']['camp_id'])
					return true;
				if($event['Event']['site_id'])
				{
					//site-wide event
					if($this->Session->read('Auth.User.Camper.site_assignment') == $event['Event']['site_id'])
						return true;
					if($this->Session->read('Auth.User.site_id') == $event['Event']['site_id'])
						return true;
				}
				else
				{
					//camp-wide event
					if($this->Session->read('Auth.User.Camper.camp_assignment') == $event['Event']['camp_id'])
						return true;
				}
				break;
			// anyone logged in can see a list of their events
			case 'index':
				return true;
		}
		return parent::isAuthorized($user);
	}
}

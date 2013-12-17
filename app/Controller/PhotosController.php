<?php
App::uses('AppController', 'Controller');
/**
 * Photos Controller
 *
 * @property Photo $Photo
 * @property PaginatorComponent $Paginator
 */
class PhotosController extends AppController {

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
//		$this->Photo->recursive = 0;
//		$this->set('photos', $this->Paginator->paginate());
		$user = $this->Photo->User->findById($this->Auth->user('id'));
//		debug($this->Camp->Camper->findCamps($camper['Camper']['id']));
		$options['joins']=array(
			array('table'=>'campers_camps',
				'type'=>'INNER',
				'conditions'=>array(
					'Camp.id=campers_camps.camp_id',
				)
			)
		);
		$options['conditions'] = array(
			'campers_camps.camper_id' => $user['Camper']['id'],
		);
//		debug($this->Photo->Camp->find('all', $options));
		$camps = $this->Photo->Camp->find('all', $options);
		$photos = array();
		foreach($camps as $camp)
		{
			foreach($camp['Photo'] as $photo)
			{
				array_push($photos, $photo);
			}
		}
//		debug($photos);
		$this->set(compact('photos'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Photo->exists($id)) {
			throw new NotFoundException(__('Invalid photo'));
		}
		$options = array('conditions' => array('Photo.' . $this->Photo->primaryKey => $id));
		$this->set('photo', $this->Photo->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Photo->create();
            // upload photo to server
            $fileOK = $this->uploadFiles('img/photos', $this->request->data['Photo']);
            // if file was uploaded successfully
            if (array_key_exists('urls', $fileOK)) {
                // save url in form data
                $this->request->data['Photo']['url'] = $fileOK['urls'][0];
            }
            else {
                $this->Session->setFlash(__('Upload failed'));
            }
            echo "about to redirect";
            echo "<meta http-equiv=\"refresh\" content=\"0;URL='/photos/'\" />";
			if ($this->Photo->save($this->request->data)) {
                $userID = $this->Auth->user('id');
                $user2 = $this->Photo->User->findById($this->Auth->user('id'));
                $campID = $user2['Camper']['camp_assignment'];
                $this->Photo->set('user_id', $userID);
                $this->Photo->set('camp_id', $campID);
                $this->Photo->save();
				$this->Session->setFlash(__('The photo has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The photo could not be saved. Please, try again.'));
                return $this->redirect(array('action' => 'index'));
			}
            return $this->redirect(array('action' => 'index'));
		}
		$users = $this->Photo->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Photo->exists($id)) {
			throw new NotFoundException(__('Invalid photo'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Photo->save($this->request->data)) {
				$this->Session->setFlash(__('The photo has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The photo could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Photo.' . $this->Photo->primaryKey => $id));
			$this->request->data = $this->Photo->find('first', $options);
		}
		$users = $this->Photo->User->find('list');
		$this->set(compact('users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Photo->id = $id;
		if (!$this->Photo->exists()) {
			throw new NotFoundException(__('Invalid photo'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Photo->delete()) {
			$this->Session->setFlash(__('The photo has been deleted.'));
		} else {
			$this->Session->setFlash(__('The photo could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	function canView($userId, $photoId)
	{
		$user = $this->Photo->User->findById($userId);
		$photo = $this->Photo->findById($photoId);
//		debug($this->Camp->Camper->findCamps($camper['Camper']['id']));
		$options['joins']=array(
			array('table'=>'campers_camps',
				'type'=>'INNER',
				'conditions'=>array(
					'Camp.id=campers_camps.camp_id',
				)
			)
		);
		$options['conditions'] = array(
			'campers_camps.camper_id' => $user['Camper']['id'],
		);
		foreach($this->Photo->Camp->find('all', $options) as $camp)
		{
			if($camp['Camp']['id'] == $photo['Photo']['camp_id'])
				return true;
		}
		return false;
	}

	public function isAuthorized($user) {
		// Admin can access every function
		if (!isset($user)) return false;
		
		if (isset($user['level']) && $user['level'] >= 100) {
			return true;
		}
		
		switch($this->action) {
            case 'index':
		    if (isset($user['level']) && $user['level'] >= 10)
			    return true;
		    break;
            case 'view':
                if (isset($user['level']) && $user['level'] >= 10)
                    return $this->canView($this->Auth->user('id'), $this->params['pass'][0]);
                break;
            case 'add':
                $user2 = $this->Photo->User->findById($this->Auth->user('id'));
                if ($user2['Camper']['camp_assignment'] && isset($user['level']) && $user['level'] >= 20)
                    return true;
                break;
            case 'edit':
            case 'delete':
                $editID = $this->params['pass'][0];
                $photo = $this->Photo->findById($editID);
				if ($photo['user_id'] == $user['id'])
					return true;
                break;
		}
		
		return false;
	}
}

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
		$this->Photo->recursive = 0;
		$this->set('photos', $this->Paginator->paginate());
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

	public function isAuthorized($user) {
		// Admin can access every function
		if (!isset($user)) return false;
		
		if (isset($user['level']) && $user['level'] >= 100) {
			return true;
		}
		
		switch($this->action) {
            case 'index':
            case 'view':
                if (isset($user['level']) && $user['level'] >= 10)
                    return true;
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
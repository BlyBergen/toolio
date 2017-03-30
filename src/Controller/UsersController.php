<?php
namespace App\Controller;

use App\Controller\AppController;
use cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
     public function beforeFilter(Event $event, $id = null)
     {
       $this->Auth->allow('add');
       // $list_id = $this->Listing->get($id);
     }

    public function index()
    {
      if($this->typeAuth()){
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
      }
      else{
        $this->Flash->error(__('Permission denied.'));
        return $this->redirect(['controller' => 'listings', 'action' => 'index']);
      }
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */


    public function view($id = null)
    {
      if($this->userAuth($id)){
        $user = $this->Users->get($id, [
            'contain' => ['Listings', 'Ratings']
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
      }
      else{
        $this->Flash->error(__('Permission denied.'));
        return $this->redirect(['controller' => 'listings', 'action' => 'index']);
      }
    }
    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            $user['type'] = 'user';
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $listings = $this->Users->Listings->find('list', ['limit' => 200]);
        $this->set(compact('user', 'listings'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
      if($this->userAuth($id)){
        $user = $this->Users->get($id, [
            'contain' => ['Listings']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $listings = $this->Users->Listings->find('list', ['limit' => 200]);
        $this->set(compact('user', 'listings'));
        $this->set('_serialize', ['user']);
      }
      else{
        $this->Flash->error(__('Permission denied.'));
        return $this->redirect(['controller' => 'listings', 'action' => 'index']);
      }
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function login()
    {
      if ($this->request->is('post')){
        $user = $this->Auth->identify();
        if($user){
          $this->Auth->setUser($user);
          return $this->redirect($this->Auth->redirectUrl());
        }
        $this->Flash->error('Username or password is incorrect');
      }
    }

    public function logout()
    {
      $this->Flash->success('You are now logged out');
      return $this->redirect($this->Auth->logout());
    }

    public function listings()
    {
      $this->loadModel('Listings');
      $user = $this->Auth->user('id');
      // $listings = $this->Listings->find()->where([
      //   'user_id' => $user
      // ]);
      $query = $this->Listings->find()->where(['user_id' => $user]);
      $listings = $this->paginate($query);



      $this->set([
        'listings' => $listings,
        'user' => $user
      ]);
    }
}

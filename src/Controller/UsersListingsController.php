<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UsersListings Controller
 *
 * @property \App\Model\Table\UsersListingsTable $UsersListings
 */
class UsersListingsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['UsersListings', 'Users', 'Listings']
        ];
        $usersListings = $this->paginate($this->UsersListings);

        $this->set(compact('usersListings'));
        $this->set('_serialize', ['usersListings']);
    }

    /**
     * View method
     *
     * @param string|null $id Users Listing id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $usersListing = $this->UsersListings->get($id, [
            'contain' => ['UsersListings', 'Users', 'Listings']
        ]);

        $this->set('usersListing', $usersListing);
        $this->set('_serialize', ['usersListing']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $usersListing = $this->UsersListings->newEntity();
        if ($this->request->is('post')) {
            $usersListing = $this->UsersListings->patchEntity($usersListing, $this->request->data);
            if ($this->UsersListings->save($usersListing)) {
                $this->Flash->success(__('The users listing has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The users listing could not be saved. Please, try again.'));
        }
        $usersListings = $this->UsersListings->UsersListings->find('list', ['limit' => 200]);
        $users = $this->UsersListings->Users->find('list', ['limit' => 200]);
        $listings = $this->UsersListings->Listings->find('list', ['limit' => 200]);
        $this->set(compact('usersListing', 'usersListings', 'users', 'listings'));
        $this->set('_serialize', ['usersListing']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Users Listing id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $usersListing = $this->UsersListings->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $usersListing = $this->UsersListings->patchEntity($usersListing, $this->request->data);
            if ($this->UsersListings->save($usersListing)) {
                $this->Flash->success(__('The users listing has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The users listing could not be saved. Please, try again.'));
        }
        $usersListings = $this->UsersListings->UsersListings->find('list', ['limit' => 200]);
        $users = $this->UsersListings->Users->find('list', ['limit' => 200]);
        $listings = $this->UsersListings->Listings->find('list', ['limit' => 200]);
        $this->set(compact('usersListing', 'usersListings', 'users', 'listings'));
        $this->set('_serialize', ['usersListing']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Users Listing id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $usersListing = $this->UsersListings->get($id);
        if ($this->UsersListings->delete($usersListing)) {
            $this->Flash->success(__('The users listing has been deleted.'));
        } else {
            $this->Flash->error(__('The users listing could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

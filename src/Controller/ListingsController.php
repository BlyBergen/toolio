<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Controller\AppController\Component\AuthComponent;

/**
 * Listings Controller
 *
 * @property \App\Model\Table\ListingsTable $Listings
 */
class ListingsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */

     public function initialize()
     {
        parent::initialize();
        $this->loadComponent('Search.Prg', [
            // This is default config. You can modify "actions" as needed to make
            // the PRG component work only for specified methods.
            'actions' => ['index']
        ]);
    }

    public function beforeFilter(Event $event, $id = null)
    {
      $this->Auth->allow('index', 'view');
      // $list_id = $this->Listing->get($id);
    }

    public function index()
    {
        $query = $this->Listings
        ->find('search', ['search' => $this->request->query])
        ->where(['title IS NOT' => null]);
        $listings = $this->paginate($query);

        $this->set(compact('listings'));
        $this->set('_serialize', ['listings']);
    }

    /**
     * View method
     *
     * @param string|null $id Listing id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $listing = $this->Listings->get($id, [
            'contain' => ['Users', 'Ratings']
        ]);

        $this->set('listing', $listing);
        $this->set('_serialize', ['listing']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $listing = $this->Listings->newEntity();
        if ($this->request->is('post')) {
            $listing = $this->Listings->patchEntity($listing, $this->request->data);
            $id = $this->Auth->user('id');
            $listing['user_id'] = $id;
            if ($this->Listings->save($listing)) {
                $this->Flash->success(__('The listing has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The listing could not be saved. Please, try again.'));
        }
        $users = $this->Listings->Users->find('list', ['limit' => 200]);
        $this->set(compact('listing', 'users'));
        $this->set('_serialize', ['listing']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Listing id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
      if($this->userListAuth($id)){
        $listing = $this->Listings->get($id, [
            'contain' => ['Users']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $listing = $this->Listings->patchEntity($listing, $this->request->data);
            if ($this->Listings->save($listing)) {
                $this->Flash->success(__('The listing has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The listing could not be saved. Please, try again.'));
        }
        $users = $this->Listings->Users->find('list', ['limit' => 200]);
        $this->set(compact('listing', 'users'));
        $this->set('_serialize', ['listing']);
      }
      else{
        $this->Flash->error(__('You are not able to edit this listing. Permission denied.'));
        return $this->redirect(['action' => 'index']);
      }
    }


    /**
     * Delete method
     *
     * @param string|null $id Listing id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
      $chk = $this->userListAuth($id);
      // if($chk){
      //   echo('true');
      // }
      // else{
      //   echo('false');
      // }
      // die();
      if($chk){
        $this->request->allowMethod(['post', 'delete']);
        $listing = $this->Listings->get($id);
        if ($this->Listings->delete($listing)) {
            $this->Flash->success(__('The listing has been deleted.'));
        } else {
            $this->Flash->error(__('The listing could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
      }
      else{
        $this->Flash->error(__('The listing could not be deleted. Permission denied.'));
        return $this->redirect(['action' => 'index']);
      }
    }



    // public function categories()
    // {
    //   $categories = $this->request->params['pass'];
    //   $listings = $this->Listings->find('category', ['categories' => $categories]);
    //   $this->set([
    //     'listings' => $listings,
    //     'categories' => $categories
    //   ]);
    // }
    //
    // public function user()
    // {
    //   $users = $this->request->params['pass'];
    //   $listings = $this->Listings->find('user', ['users' => $users]);
    //   $this->set([
    //     'listings'=> $listings,
    //     'users' => $users
    //   ]);
    // }
}

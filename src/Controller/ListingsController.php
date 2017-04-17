<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Controller\AppController\Component\AuthComponent;
use Cake\ORM\TableRegistry;

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

    public function beforeRender(Event $event)
    {
      $categories = ['' => '-select-',
        'Mechanics' => 'Mechanics',
        'Arts/crafts' => 'Arts & Crafts',
        'House Keeping' => 'Housekeeping',
        'Carpentry' => 'Carpentry',
        'Recreation' => 'Recreation',
        'Electronics' => 'Electronics',
        'Cookware' => 'Cookware'];

        $states = ['' => '-select-',
        'AL' => 'Alabama',
        'AK' => 'Alaska',
        'AZ' => 'Arizona',
        'AR' => 'Arkansas',
        'CA' => 'California',
        'CO' => 'Colorado',
        'CT' => 'Connecticut',
        'DE' => 'Deleware',
        'DC' => 'Dist. of Columbia',
        'FL' => 'Florida',
        'GA' => 'Georgia',
        'HI' => 'Hawaii',
        'ID' => 'Idaho',
        'IL' => 'Illinois',
        'IN' => 'Indiana',
        'IA' => 'Iowa',
        'KS' => 'Kansas',
        'KY' => 'Kentucky',
        'LA' => 'Louisiana',
        'ME' => 'Maine',
        'MD' => 'Maryland',
        'MA' => 'Massacusetts',
        'MI' => 'Michigan',
        'MN' => 'Minnesota',
        'MS' => 'Mississippi',
        'MO' => 'Missouri',
        'MT' => 'Montana',
        'NE' => 'Nebraska',
        'NV' => 'Nevada',
        'NH' => 'New Hampshire',
        'NJ' => 'New Jersey',
        'NM' => 'New Mexico',
        'NY' => 'New York',
        'NC' => 'North Carolina',
        'ND' => 'North Dakota',
        'OH' => 'Ohio',
        'OK' => 'Oklahoma',
        'OR' => 'Oregon',
        'PA' => 'Pennsylvania',
        'RI' => 'Rhode Island',
        'SC' => 'South Carolina',
        'SD' => 'South Dakota',
        'TN' => 'Tennessee',
        'TE' => 'Texas',
        'UT' => 'Utah',
        'VT' => 'Vermont',
        'VA' => 'Virginia',
        'WA' => 'Washington',
        'WV' => 'West Virginia',
        'WI' => 'Wisconson',
        'WY' => 'Wyoming'];

        $this->set(compact('categories', 'states'));
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

    public function favorite($id = null)
    {
      $list_id = $id;
      $data = [
        'user_id' => $this->Auth->user('id'),
        'listing_id' => $list_id
      ];
      $this->loadModel('UsersListings');
      $fav = $this->UsersListings->newEntity();
      $fav = $this->UsersListings->patchEntity($fav, $data);
      $user_id = $this->Auth->user('id');
      $listing_id = $list_id;
      if($this->UsersListings->save($fav)){
          $this->Flash->success(__('The listing has been saved.'));

          return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('The listing could not be saved. Please, try again.'));

      return $this->redirect(['action' => 'index']);

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

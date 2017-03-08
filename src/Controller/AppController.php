<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
          'authenticate' => [
            'Form' => [
              'fields' => [
                'username' => 'email',
                'password' => 'password'
              ]
            ]
          ],
          'loginAction' => [
            'controller' => 'Users',
            'action' => 'login'
          ]
        ]);

        /*
         * Enable the following components for recommended CakePHP security settings.
         * see http://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }

    public function userListAuth($id = null){
      $auth_ok = false;
      $type = $this->Auth->user('type');
      $user_id = $this->Auth->user('id');
      $list = $this->Listings->get($id);
      $list_id = $list['user_id'];
      if($type == 'admin'){
        $auth_ok = true;
      }
      else{
        if ($user_id != $list_id){
          $auth_ok = false;
        }
        else{
          $auth_ok = true;
        }
      }
      return $auth_ok;
      // if($auth_ok){
      //   echo('true');
      //   echo('type:');
      //   echo $type;
      //   echo('user id:');
      //   echo $user_id;
      //   echo('page id:');
      //   echo $list_id;
      // }
      // else{
      //   echo('false');
      //   echo('type:');
      //   echo $type;
      //   echo('user id:');
      //   echo $user_id;
      //   echo('page id:');
      //   echo $list_id;
      // }
      // die();
    }

    public function userAuth($id = null){
      $auth_ok = false;
      $type = $this->Auth->user('type');
      $user_id = $this->Auth->user('id');
      $list = $this->Users->get($id);
      $list_id = $list['id'];
      if($type == 'admin'){
        $auth_ok = true;
      }
      else{
        if ($user_id != $list_id){
          $auth_ok = false;
        }
        else{
          $auth_ok = true;
        }
      }
      return $auth_ok;
    }

    public function typeAuth($id = null){
      $auth_ok = false;
      $type = $this->Auth->user('type');
      if($type == 'admin'){
        $auth_ok = true;
      }
      return $auth_ok;
    }

}

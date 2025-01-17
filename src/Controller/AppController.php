<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
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
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
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
        
        $this->loadComponent('Flash');
        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);

        $this->loadComponent('Auth', [
            'authorize' => ['Controller'],
            'loginRedirect' => [
                'controller' => 'Users',
                'action' => 'index'
            ],
            'logoutRedirect' => [
                'controller' => 'Pages',
                'action' => 'display',
                'home'
            ]
        ]);
    }

    public function beforeRender(Event $event)
    {
        if (isset($this->request->params['prefix']) && $this->request->params['prefix'] == 'admin') {
            $this->viewBuilder()->setlayout('admin');
        } else if($this->request->params['action'] == 'login' || $this->request->params['action'] == 'add' ){
            $this->viewBuilder()->setlayout('login');
        }else{
            $this->viewBuilder()->setlayout('default');
        }

    }
    
       public function beforeFilter(Event $event)
    {
        if ($this->Auth->user() !== null) {
            $this->set('currentUser', $this->Auth->user());
            $this->currentUser = $this->Auth->user();
        } else {

            $this->currentUser = null;
        }
    }

    public function getCurrentUser()
    {
        return $this->currentUser;
    }
}

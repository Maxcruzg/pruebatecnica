<?php

namespace App\Controller;

use Cake\Event\Event;
use Cake\Auth\DefaultPasswordHasher;
use PHPMailer\PHPMailer\Exception;

use App\Controller\AppController;



class UsersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Users');
        $this->loadModel('Roles');
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['login', 'loguot', 'index']);
    }


    public function login()
    {
        $this->request->allowMethod(['get', 'post']);
        $email = $this->request->getData('email');
        $password = $this->request->getData('password');

        $user = $this->Users->findByEmail($email)->first();

        if ($this->request->is('post')) {
            if ($user && (new DefaultPasswordHasher())->check($password, $user->password)) {
                $this->Auth->setUser($user);
                if ($user->roles_id == 1) {
                    return $this->redirect(['prefix' => 'admin', 'controller' => 'Users', 'action' => 'index']);
                } else {
                    return $this->redirect(['controller' => 'UserCourses', 'action' => 'index']);
                }
            } else {
                $this->Flash->error(__('Usuario o contraseña incorrectos'));
            }
        }
    }

    public function logout()
    {
        $this->Flash->success('Has cerrado sesión correctamente.');
        $this->Auth->logout();
        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
    }

    public function isAuthorized($user)
    {
        $user = $this->currentUser;
        $action = $this->request->getParam('action');
        if (in_array($action, ['index', 'login', 'logout']) && ($user['role'] == 2)) {
            return false;
        } else {
            return true;
        }
    }

    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        $this->set('user', $user);
    }



    // public function edit($id = null)
    // {
    //     $roles = $this->Roles->find('list');

    //     $user = $this->Users->get($id, [
    //         'contain' => [],
    //     ]);

    //     if ($this->request->is(['patch', 'post', 'put'])) {
    //         $data = $this->request->getData();
    //         $user = $this->Users->patchEntity($user, $data);
    //         if ($data['password'] == $data['password2']) {

    //             if ($this->Users->save($user)) {
    //                 $this->Flash->success(__('EL usuario ha sido modificado.'));

    //                 return $this->redirect(['action' => 'index']);
    //             }
    //             $this->Flash->error(__('El usuario no ha podido ser modificado. Intentelo nuevamente.'));
    //         } else {
    //             $this->Flash->error(__('Las contraseñas no coinciden'));
    //         }
    //     }
    //     $this->set(compact('user', 'roles'));
    // }

}

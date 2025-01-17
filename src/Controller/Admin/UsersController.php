<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;

class UsersController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Users');
        $this->loadModel('Roles');
    }


    public function index()
    {
        $nameKey = $this->request->getQuery('name');
        $rutKey = $this->request->getQuery('rut');
        $roles = $this->Roles->find('list');

        $query = $this->Users->find('all')->contain(['Roles']);

        if ($nameKey) {
            $query->where([
                'OR' => [
                    'Users.name LIKE' => '%' . $nameKey . '%',
                    'Users.lastname LIKE' => '%' . $nameKey . '%'
                ]
            ]);
        }
        if ($rutKey) {
            $query->where(['Users.rut LIKE' => '%' . $rutKey . '%']);
        }

        $users = $this->paginate($query);

        $this->set(compact('users', 'roles'));
    }



    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
    }
    
    public function isAuthorized()
    {
        $user = $this->currentUser;
        $action = $this->request->getParam('action');
        if (in_array($action, ['index', 'view', 'edit', 'logout', 'delete', 'add', 'login', 'activate']) && ($user['roles_id'] == '1')) {
            return true;
        } else {
            return   $this->Flash->error(__('El usuario no ha podido ingresar. Intentelo nuevamente.'));
        }
    }
    public function add()
    {
        $roles = $this->Roles->find('list');
        $user = $this->Users->newEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();

            if (isset($data['email'])) {
                $data['email'] = strtolower($data['email']);
            }

            if (isset($data['name'])) {
                $data['name'] = strtolower($data['name']);
            }

            // Eliminar puntos y guion del RUT
            $rut = str_replace(['.', '-'], '', $data['rut']);
            $data['rut'] = $rut; 

            $existingUserByRut = $this->Users->find('all', [
                'conditions' => ['Users.rut' => $rut]
            ])->first();

            if ($existingUserByRut) {
                $this->Flash->error(__('El RUT ya está registrado.'));
                return;
            }

            $existingUserByEmail = $this->Users->find('all', [
                'conditions' => ['Users.email' => $data['email']]
            ])->first();

            if ($existingUserByEmail) {
                $this->Flash->error(__('El correo electrónico ya está registrado.'));
                return;
            }

            $user = $this->Users->patchEntity($user, $data);

            if ($data['password'] == $data['password2']) {
                // Guardar el nuevo usuario
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('El usuario ha sido registrado.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('El usuario no ha podido ser registrado. Intentelo nuevamente.'));
            } else {
                $this->Flash->error(__('Las contraseñas no coinciden.'));
            }
        }

        $this->set(compact('user', 'roles'));
    }


    public function edit($id = null)
    {
        $roles = $this->Roles->find('list');

        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $user = $this->Users->patchEntity($user, $data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('EL usuario ha sido modificado.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El usuario no ha podido ser modificado. Intentelo nuevamente.'));
        }
        $this->set(compact('user', 'roles'));
    }

    public function delete($id)
    {
        $this->request->allowMethod(['post', 'delete']);

        if ($this->Users->inactive($id)) {
            $this->Flash->success(__('El usuario ha sido desactivado.'));
        } else {
            $this->Flash->error(__('No se pudo desactivar el usuario.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    public function activate($id)
    {
        $this->request->allowMethod(['post', 'put']);

        if ($this->Users->activate($id)) {
            $this->Flash->success(__('El usuario ha sido activado.'));
        } else {
            $this->Flash->error(__('No se pudo activar el usuario.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    public function logout()
    {
        $this->Auth->logout();
        return $this->redirect(['controller' => 'Users', 'action' => 'login', 'prefix' => false]);
    }
}

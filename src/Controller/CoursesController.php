<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Courses Controller
 *
 *
 * @method \App\Model\Entity\Course[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CoursesController extends AppController
{

    public function index()
    {
        $courses = $this->paginate($this->Courses);

        $this->set(compact('courses'));
    }

    public function view($id = null)
    {
        $course = $this->Courses->get($id, [
            'contain' => [],
        ]);

        $this->set('course', $course);
    }
    public function isAuthorized()
    {
        $user = $this->currentUser;
        $action = $this->request->getParam('action');
        if (in_array($action, ['index', 'view', 'edit', 'delete', 'add', 'addUserToCourse', 'removeUserFromCourse', 'login', 'logout']) && ($user['roles_id'] == '1')) {
            return true;
        } else {
            return   $this->Flash->error(__('El usuario no ha podido ingresar. Intentelo nuevamente.'));
        }
    }
}

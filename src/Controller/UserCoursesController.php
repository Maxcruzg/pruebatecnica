<?php
namespace App\Controller;
use Cake\Event\Event;


use App\Controller\AppController;

/**
 * UserCourses Controller
 *
 * @property \App\Model\Table\UserCoursesTable $UserCourses
 *
 * @method \App\Model\Entity\UserCourse[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UserCoursesController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Users');
        $this->loadModel('Courses');
    }


    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['login', 'loguot', 'index']);
    }

    public function isAuthorized($user)
    {
        $user = $this->currentUser;
        $action = $this->request->getParam('action');
        if (in_array($action, ['index']) && ($user['role'] == 2)) {
            return false;
        } else {
            return true;
        }
    }

    public function index()
    {
        $courses = $this->Courses->find('all');
        $courses = $this->paginate($courses);
        $this->set(compact('courses'));
    }

    public function view($id = null)
    {
        $course = $this->Courses->get($id, [
            'contain' => ['Users', 'UserCourses'],
        ]);
    
        $this->set('course', $course);
    }
    

    public function add()
    {
        $userCourse = $this->UserCourses->newEntity();
        if ($this->request->is('post')) {
            $userCourse = $this->UserCourses->patchEntity($userCourse, $this->request->getData());
            if ($this->UserCourses->save($userCourse)) {
                $this->Flash->success(__('The user course has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user course could not be saved. Please, try again.'));
        }
        $users = $this->UserCourses->Users->find('list', ['limit' => 200]);
        $courses = $this->UserCourses->Courses->find('list', ['limit' => 200]);
        $this->set(compact('userCourse', 'users', 'courses'));
    }

    public function edit($id = null)
    {
        $userCourse = $this->UserCourses->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userCourse = $this->UserCourses->patchEntity($userCourse, $this->request->getData());
            if ($this->UserCourses->save($userCourse)) {
                $this->Flash->success(__('The user course has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user course could not be saved. Please, try again.'));
        }
        $users = $this->UserCourses->Users->find('list', ['limit' => 200]);
        $courses = $this->UserCourses->Courses->find('list', ['limit' => 200]);
        $this->set(compact('userCourse', 'users', 'courses'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userCourse = $this->UserCourses->get($id);
        if ($this->UserCourses->delete($userCourse)) {
            $this->Flash->success(__('The user course has been deleted.'));
        } else {
            $this->Flash->error(__('The user course could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}

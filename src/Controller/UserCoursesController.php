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
        if (in_array($action, ['index']) && ($user['roles_id'] == 2)) {
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
}

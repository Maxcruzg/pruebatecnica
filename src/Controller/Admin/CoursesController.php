<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;

class CoursesController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Users');
        $this->loadModel('courses');
        $this->loadModel('UserCourses');
    }

    public function index()
    {
        $key = $this->request->getQuery('key');
        $query = $this->Courses->find('all');
        if ($key) {
            $query->where(['Courses.name LIKE' => '%' . $key . '%']);
        }
        $courses = $this->paginate($query);
        $this->set(compact('courses', 'key'));
    }


    public function add()
    {
        $course = $this->Courses->newEntity();

        if ($this->request->is('ajax')) {
            try {
                $data = $this->request->getData();

                // Convierte las fechas al formato adecuado
                if (!empty($data['start_date'])) {
                    $data['start_date'] = date('Y-m-d', strtotime($data['start_date']));
                }

                if (!empty($data['end_date'])) {
                    $data['end_date'] = date('Y-m-d', strtotime($data['end_date']));
                }

                $course = $this->Courses->patchEntity($course, $data);

                if ($this->Courses->save($course)) {
                    $response = ['status' => 'success', 'message' => 'Curso agregado correctamente.'];
                } else {
                    $response = ['status' => 'error', 'message' => 'Hubo un problema al agregar el curso.'];
                }

                // Establecer la respuesta como JSON
                $this->set(compact('response'));
                $this->set('_serialize', 'response'); // Esto asegura que la respuesta será devuelta como JSON
            } catch (Exception $e) {
                // Maneja las excepciones
                $response = ['status' => 'error', 'message' => 'Ocurrió un error: ' . $e->getMessage()];
                $this->set(compact('response'));
                $this->set('_serialize', 'response');
            }
        }
    }

    public function edit($id = null)
    {
        $course = $this->Courses->get($id);

        // Si la solicitud es AJAX, obtener y devolver los datos del curso
        if ($this->request->is('ajax')) {
            // Si es una solicitud GET (cuando se hace clic en "editar"), devolver los datos del curso
            if ($this->request->is('get')) {
                $this->set([
                    'status' => 'success',
                    'course' => $course,
                    '_serialize' => ['status', 'course']
                ]);
                return;
            }

            if ($this->request->is(['patch', 'post', 'put'])) {
                $data = $this->request->getData();

                // Convertir las fechas al formato 'Y-m-d'
                if (!empty($data['start_date'])) {
                    $data['start_date'] = date('Y-m-d', strtotime($data['start_date']));
                }
                if (!empty($data['end_date'])) {
                    $data['end_date'] = date('Y-m-d', strtotime($data['end_date']));
                }

                $course = $this->Courses->patchEntity($course, $data);

                if ($this->Courses->save($course)) {
                    $this->set([
                        'status' => 'success',
                        'message' => 'El curso ha sido actualizado.',
                        'course' => $course,
                        '_serialize' => ['status', 'message', 'course']
                    ]);
                } else {
                    $this->set([
                        'status' => 'error',
                        'message' => 'No se pudo actualizar el curso.',
                        '_serialize' => ['status', 'message']
                    ]);
                }
                return;
            }
        }

        return $this->redirect(['action' => 'index']);
    }


    public function view($id)
    {
        $search = $this->request->getQuery('search');

        $course = $this->Courses->get($id, [
            'contain' => ['Users'],
        ]);

        if (!empty($search)) {
            $course->users = array_filter($course->users, function ($user) use ($search) {
                return stripos($user->rut, $search) !== false ||
                    stripos($user->name, $search) !== false ||
                    stripos($user->lastname, $search) !== false ||
                    stripos($user->email, $search) !== false;
            });
        }

        $excludedUserIds = $this->UserCourses->find()
            ->select(['user_id'])
            ->where(['course_id' => $id])
            ->extract('user_id')
            ->toArray();

        $usersQuery = $this->Users->find('list', [
            'keyField' => 'id',
            'valueField' => function ($user) {
                return 'RUT: ' . $user->rut . ', NOMBRE: ' . $user->name . ' ' . $user->lastname . ', CORREO: ' . $user->email;
            }
        ])
            ->where(['is_active' => 1]); // Solo incluir usuarios activos

        if (!empty($excludedUserIds)) {
            $usersQuery->where(['Users.id NOT IN' => $excludedUserIds]);
        }

        $usersList = $usersQuery->toArray();

        $this->set(compact('course', 'usersList', 'search'));
    }




    public function addUserToCourse($courseId)
    {
        if ($this->request->is('post')) {
            $userId = $this->request->getData('user_id');

            if ($userId) {
                $user = $this->Users->find()->where(['id' => $userId])->first();
                $course = $this->Courses->find()->where(['id' => $courseId])->first();

                if ($user && $course) {
                    $userCourse = $this->UserCourses->newEntity();
                    $userCourse->user_id = $userId;
                    $userCourse->course_id = $courseId;

                    if ($this->UserCourses->save($userCourse)) {
                        $this->Flash->success(__('El usuario ha sido agregado al curso.'));
                    } else {
                        $this->Flash->error(__('No se pudo agregar el usuario al curso.'));
                    }
                } else {
                    $this->Flash->error(__('Usuario o curso no encontrado.'));
                }
            } else {
                $this->Flash->error(__('Por favor, seleccione un usuario.'));
            }
        }

        return $this->redirect(['action' => 'view', $courseId]);
    }

    public function removeUserFromCourse($courseId, $userId)
    {
        $course = $this->Courses->get($courseId, [
            'contain' => ['Users'],
        ]);
        $user = $this->Users->get($userId);

        $userCourse = $this->UserCourses->find()
            ->where(['user_id' => $userId, 'course_id' => $courseId])
            ->first();

        if ($userCourse) {
            // Eliminar la relación
            if ($this->UserCourses->delete($userCourse)) {
                $this->Flash->success(__('El usuario ha sido removido del curso.'));
            } else {
                $this->Flash->error(__('No se pudo remover el usuario del curso.'));
            }
        } else {
            $this->Flash->error(__('El usuario no está asociado con este curso.'));
        }

        return $this->redirect(['action' => 'view', $courseId]);
    }


    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        $userCoursesCount = $this->Courses->UserCourses
            ->find()
            ->where(['course_id' => $id])
            ->count();

        if ($userCoursesCount > 0) {
            $this->Flash->error(__('El curso no puede ser eliminado porque tiene usuarios asociados.'));
            return $this->redirect(['action' => 'index']);
        }

        // Si no hay usuarios asociados, proceder con la eliminación
        $course = $this->Courses->get($id);
        if ($this->Courses->delete($course)) {
            $this->Flash->success(__('El curso ha sido eliminado.'));
        } else {
            $this->Flash->error(__('El curso no ha podido ser eliminado.'));
        }

        return $this->redirect(['action' => 'index']);
    }




    public function isAuthorized()
    {
        $user = $this->currentUser;
        $action = $this->request->getParam('action');
        if (in_array($action, ['index', 'view', 'edit', 'delete', 'add', 'addUserToCourse', 'removeUserFromCourse', 'logout']) && ($user['roles_id'] == '1')) {
            return true;
        } else {
            return   $this->Flash->error(__('El usuario no ha podido ingresar. Intentelo nuevamente :D.'));
        }
    }
}

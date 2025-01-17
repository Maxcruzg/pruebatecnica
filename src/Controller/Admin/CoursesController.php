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
                // Obtén los datos del formulario
                $data = $this->request->getData();

                // Convierte las fechas al formato adecuado
                if (!empty($data['start_date'])) {
                    $data['start_date'] = date('Y-m-d', strtotime($data['start_date']));
                }

                if (!empty($data['end_date'])) {
                    $data['end_date'] = date('Y-m-d', strtotime($data['end_date']));
                }

                // Pega los datos en la entidad
                $course = $this->Courses->patchEntity($course, $data);

                // Guarda los datos
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
        // Obtener el curso con el ID proporcionado
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

            // Si la solicitud es POST, PUT o PATCH (cuando se envían los datos para actualizar)
            if ($this->request->is(['patch', 'post', 'put'])) {
                $data = $this->request->getData();

                // Convertir las fechas al formato 'Y-m-d' si es necesario
                if (!empty($data['start_date'])) {
                    $data['start_date'] = date('Y-m-d', strtotime($data['start_date']));
                }
                if (!empty($data['end_date'])) {
                    $data['end_date'] = date('Y-m-d', strtotime($data['end_date']));
                }

                // Asociar los datos al objeto Course
                $course = $this->Courses->patchEntity($course, $data);

                // Intentar guardar los cambios
                if ($this->Courses->save($course)) {
                    $this->set([
                        'status' => 'success',
                        'message' => 'El curso ha sido actualizado.',
                        'course' => $course, // Devolver el curso actualizado
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

        // Si no es una solicitud AJAX, redirigir o manejar de forma estándar.
        return $this->redirect(['action' => 'index']);
    }

    public function view($id)
    {
        $course = $this->Courses->get($id, [
            'contain' => ['Users'],
        ]);

        $usersList = $this->Users->find()
            ->where([
                'Users.id NOT IN' => $this->Users->UserCourses->find('')
                    ->select(['user_id'])
                    ->where(['course_id' => $id])
            ])
            ->all();

        $usersList = $usersList->combine('id', function ($user) {
            return $user->rut . ', ' . $user->name . ' ' . $user->lastname . ', ' . $user->email;
        });

        $this->set(compact('course', 'usersList'));
    }

    public function addUserToCourse($courseId)
    {
        if ($this->request->is('post')) {
            // Obtener el user_id desde el formulario
            $userId = $this->request->getData('user_id');

            if ($userId) {
                // Verificar que el usuario y el curso existen
                $user = $this->Users->find()->where(['id' => $userId])->first();
                $course = $this->Courses->find()->where(['id' => $courseId])->first();

                if ($user && $course) {
                    // Crear la nueva relación en la tabla user_courses
                    $userCourse = $this->UserCourses->newEntity();
                    $userCourse->user_id = $userId;
                    $userCourse->course_id = $courseId;

                    // Intentar guardar la relación
                    if ($this->UserCourses->save($userCourse)) {
                        $this->Flash->success(__('El usuario ha sido agregado al curso.'));
                    } else {
                        $this->Flash->error(__('No se pudo agregar el usuario al curso.'));
                    }
                } else {
                    // Mostrar error si el usuario o el curso no existen
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
        // Obtener el curso y el usuario
        $course = $this->Courses->get($courseId, [
            'contain' => ['Users'],
        ]);
        $user = $this->Users->get($userId);

        // Buscar la relación en la tabla user_courses
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
        $course = $this->Courses->get($id);
        if ($this->Courses->delete($course)) {
            $this->Flash->success(__('The course has been deleted.'));
        } else {
            $this->Flash->error(__('The course could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }



    public function isAuthorized()
    {
        $user = $this->currentUser;
        $action = $this->request->getParam('action');
        if (in_array($action, ['index', 'view', 'edit', 'delete', 'add', 'addUserToCourse', 'removeUserFromCourse', 'login', 'logout']) && ($user['roles_id'] == '1')) {
            return true;
        } else {
            return   $this->Flash->error(__('El usuario no ha podido ingresar. Intentelo nuevamente :D.'));
        }
    }
}

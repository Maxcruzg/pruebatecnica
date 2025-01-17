<div class="row">
    <div class="col-md-3 col-md-push-9 special-box">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Navegación</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus icon-special"></i>
                    </button>
                </div>
            </div>
            <br>
            <div class="box-body">
                <div class="row">
                    <!-- Botón para agregar curso -->
                    <div class="col-md-12">
                        <div class="btn-toolbar espacio">
                            <?= $this->Html->link(
                                __('<i class="fa-solid fa-floppy-disk"></i> Agregar Curso'),
                                '#addCourseModal',
                                ['class' => 'btn btn-admin', 'escape' => false, 'data-toggle' => 'modal', 'data-target' => '#addCourseModal']
                            ) ?>
                        </div>
                    </div>
                    <!-- Buscador por nombre -->
                    <div class="col-md-12">
                        <?= $this->Form->create(null, [
                            'type' => 'get',
                            'url' => ['action' => 'index']
                        ]) ?>
                        <div class="">
                            <?= $this->Form->control('key', [
                                'label' => false,
                                'class' => 'form-control',
                                'placeholder' => 'Buscar por nombre',
                                'value' => $this->request->getQuery('key'),
                                'style' => ' width: 95%;margin-left:5px;'
                            ]) ?>
                            <span class="btn">
                                <?= $this->Form->button('BUSCAR', [
                                    'type' => 'submit',
                                    'escape' => true,
                                    'class' => 'btn btn-primary'
                                ]) ?>
                            </span>
                        </div>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-9 col-md-pull-3 special-box">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h1 class="box-title">Cursos</h1>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus icon-special"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>F. Inicio</th>
                                        <th>F. Término</th>
                                        <th>Ácciones</th>
                                    </tr>
                                </thead>
                                <?php foreach ($courses as $course) : ?>
                                    <tbody>
                                        <td><?= $course->name ?></td>
                                        <td><?= $course->description  ?></td>
                                        <td><?= $course->start_date ?></td>
                                        <td><?= $course->end_date ?></td>
                                        <td class="actions">
                                            <?= $this->Html->link('<i class="fa fa-edit icon-color"></i>', '#', [
                                                'escape' => false,
                                                'title' => 'Editar',
                                                'class' => 'btn btn-box-tool',
                                                'data-toggle' => 'modal',
                                                'data-target' => '#editCourseModal',
                                                'data-id' => $course->id  // Aquí agregamos el ID del curso
                                            ]); ?>

                                            <?= $this->Html->link('<i class="fa-sharp fa-solid fa-eye icon-color"></i>', [
                                                'action' => 'view',
                                                $course->id
                                            ], [
                                                'escape' => false,
                                                'title' => 'Ver',
                                                'class' => 'btn btn-box-tool'
                                            ]); ?>
                                            <?= $this->Form->postLink('<i class="fa-sharp fa-solid fa-trash icon-color-trash"></i>   ', [
                                                'action' => 'delete',
                                                $course->id
                                            ], [
                                                'confirm' => '¿Está seguro de que desea desactivar el registro? El Usuario quedará con su cuenta suspendida hasta que decida reactivarla',
                                                'class' => 'btn btn-box-tool',
                                                'title' => 'Eliminar',
                                                'escape' => false
                                            ]); ?>
                                        </td>
                                    </tbody>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->first('<< ' . __('Primero')) ?>
        <?= $this->Paginator->prev('< ' . __('Anterior')) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next(__('Siguiente') . ' >') ?>
        <?= $this->Paginator->last(__('Último') . ' >>') ?>
    </ul>
</div>

<div id="addCourseModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style=" max-width: 500px; margin: auto;">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Curso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= $this->Form->create(null, [
                    'url' => ['action' => 'add'],
                    'type' => 'post',
                    'id' => 'courseForm'
                ]) ?>
                <div class="form-group">
                    <?= $this->Form->control('name', [
                        'label' => 'Nombre del curso',
                        'class' => 'form-control',
                        'placeholder' => 'Nombre del curso'
                    ]) ?>
                </div>
                <div class="form-group">
                    <?= $this->Form->control('description', [
                        'label' => 'Descripción',
                        'class' => 'form-control',
                        'placeholder' => 'Descripción'
                    ]) ?>
                </div>
                <div class="form-group">
                    <label for="start_date">Fecha de inicio</label>
                    <input type="date" class="form-control" id="start_date" name="start_date">
                </div>
                <div class="form-group">
                    <label for="end_date">Fecha de fin</label>
                    <input type="date" class="form-control" id="end_date" name="end_date">
                </div>
                <?= $this->Form->end() ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" id="submitCourse" class="btn btn-success">Guardar</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal de edición -->
<div class="modal fade" id="editCourseModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style=" max-width: 500px; margin: auto;">
            <div class="modal-header">
                <h5 class="modal-title">Editar Curso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario de edición -->
                <form id="editCourseForm" action="/admin/courses/edit" method="POST">
                    <input type="hidden" id="course_id" name="course_id" value="" />
                    <div class="form-group">
                        <label for="name">Nombre del curso</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="description">Descripción</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="start_date">Fecha de inicio</label>
                        <input type="date" class="form-control" id="start_date" name="start_date">
                    </div>
                    <div class="form-group">
                        <label for="end_date">Fecha de fin</label>
                        <input type="date" class="form-control" id="end_date" name="end_date">
                    </div>
                    <button type="button" id="saveChanges">Guardar cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>







<script>
    $(document).ready(function() {
        $('#openModalButton').on('click', function() {
            $('#addCourseModal').modal('show');
        });

        // Enviar el formulario con AJAX
        $('#submitCourse').on('click', function() {
            var form = $('#courseForm');
            var formData = form.serialize();

            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: formData,
                dataType: 'json',
                beforeSend: function() {
                    $('#submitCourse').prop('disabled', true).text('Guardando...');
                },
                success: function(response) {
                    console.log(response);
                    if (response.status === 'success') {

                        // Cierra el modal si es exitoso
                        $('#addCourseModal').modal('hide');
                        form[0].reset(); // Resetea el formulario
                        alert('Curso agregado con éxito');
                        location.reload();
                    } else {
                        alert(response.message);
                    }
                },
                error: function() {
                    alert('Ocurrió un error. Por favor, intenta nuevamente.');
                },
                complete: function() {
                    $('#submitCourse').prop('disabled', false).text('Guardar');
                }
            });
        });
    });
    $(document).ready(function() {
        // Cuando se hace clic en el botón de "editar"
        $('body').on('click', '.btn-box-tool[data-target="#editCourseModal"]', function() {
            var courseId = $(this).data('id'); // Obtener el ID del curso
            $.ajax({
                url: '/admin/courses/edit/' + courseId, // URL para obtener los datos del curso
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        // Rellenamos los campos del modal con los datos del curso
                        $('#editCourseModal #course_id').val(response.course.id);
                        $('#editCourseModal #name').val(response.course.name);
                        $('#editCourseModal #description').val(response.course.description);
                        $('#editCourseModal #start_date').val(response.course.start_date ? response.course.start_date.split('T')[0] : ''); // Asigna solo la parte de la fecha
                        $('#editCourseModal #end_date').val(response.course.end_date ? response.course.end_date.split('T')[0] : ''); // Asigna solo la parte de la fecha

                        // Abrir el modal
                        $('#editCourseModal').modal('show');
                    } else {
                        alert('No se pudo cargar la información del curso.');
                    }
                },
                error: function() {
                    alert('Ocurrió un error al cargar los datos del curso.');
                }
            });
        });

        // Enviar los cambios con AJAX
        $('#saveChanges').on('click', function() {
            var form = $('#editCourseForm');
            var formData = form.serialize(); // Serializa los datos del formulario

            console.log(formData); // Verifica que `course_id` esté incluido

            $.ajax({
                url: '/admin/courses/edit/' + $('#course_id').val(), // URL de la acción de edición, ahora incluye el course_id
                method: 'POST',
                data: formData,
                dataType: 'json',
                beforeSend: function() {
                    $('#saveChanges').prop('disabled', true).text('Guardando...');
                },
                success: function(response) {
                    if (response.status === 'success') {
                        // Si la actualización fue exitosa, cierra el modal y muestra un mensaje
                        $('#editCourseModal').modal('hide');
                        alert('Curso actualizado con éxito');
                        location.reload(); // Recargar la página para ver el curso actualizado
                    } else {
                        alert('No se pudo actualizar el curso. Intenta nuevamente.');
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Información sobre el error
                    alert('Ocurrió un error al intentar actualizar el curso.');
                },
                complete: function() {
                    $('#saveChanges').prop('disabled', false).text('Guardar cambios');
                }
            });
        });
    });

    document.addEventListener('DOMContentLoaded', () => {
        // Formatear el RUT en los elementos con clase 'rut-display'
        const rutElements = document.querySelectorAll('.rut-display');

        // Función para formatear el RUT
        function formatRut(rut) {
            rut = rut.replace(/[^\dKk]/g, ''); // Eliminar caracteres no numéricos o "Kk"
            if (rut.length > 1) {
                let rutFormatted = rut.slice(0, -1); // Tomar todo excepto el último carácter
                let dv = rut.slice(-1); // El último carácter es el dígito verificador
                rutFormatted = rutFormatted.replace(/\B(?=(\d{3})+(?!\d))/g, '.'); // Añadir puntos
                return rutFormatted + '-' + dv; // Añadir el guion antes del dígito verificador
            }
            return rut;
        }

        // Aplicar el formato a todos los elementos con la clase 'rut-display'
        rutElements.forEach((element) => {
            const rut = element.textContent.trim(); // Obtener el valor del RUT
            element.textContent = formatRut(rut); // Formatear y mostrar
        });
    });
</script>
<?php
?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<div class="row">
    <div class="col-md-12 special-box">
        <div class="box box-warning">
            <div class="box-header with-border text-center">
                <div class="back"></div>
                <h3 class="card-title-center text-center bg-principal text-white">
                    <i class="fa fa-file"></i>
                    <?= $course->name ?>
                </h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus icon-special"></i></button>
                </div>
            </div>
            <div class="box-body" style="text-align: center;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-25">
                            <div class="card-header bg-light" style="margin: 10px">
                                <div class="row justify-content-center">
                                    <div class=" col-md-6  invoice-col font-14 p-1 text-center">
                                        <b class="font-13">FECHA INICIO:</b> <?= $course->start_date ?>
                                    </div>
                                    <div class=" col-md-6  invoice-col font-14 p-1 text-center">
                                        <b class="font-13">FECHA TERMINO:</b> <?= $course->end_date ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row invoice-info bg-light">
                                    <div class="col-lg-12 invoice-col font-14 p-1 border-top mt-2 pt-3">
                                        <b class="font-13">DESCRIPCION:</b> <?= !empty($course->description) ? $course->description : '' ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 special-box">
        <div class="box box-warning">
            <div class="box-header with-border text-center">
                <div class="back">
                </div>
                <h1> Estudiantes inscritos </h1>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus icon-special"></i></button>
                </div>

            </div>
            <div class="box-body">
                <div class="col-md-12">
                    <?= $this->Form->create(null, ['url' => ['action' => 'addUserToCourse', $course->id]]) ?>
                    <div class="form-group">
                        <?= $this->Form->control('user_id', [
                            'options' => $usersList,
                            'label' => 'Seleccionar Estudiante Para Agregar al curso',
                            'class' => 'form-control select2',
                            'empty' => 'Seleccione Usuario',
                            'style' => ' width: 100%;'
                        ]); ?>
                    </div>
                    <div class="form-group text-center">
                        <?= $this->Form->button(__('Agregar Estudiante'), ['class' => 'btn btn-primary']) ?>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
                <div class="col-md-12">

                    <div class="search-bar">
                        <?= $this->Form->create(null, ['type' => 'get']) ?>
                        <div class="form-group">
                            <?= $this->Form->control('search', [
                                'label' => false,
                                'placeholder' => 'Buscar por RUT, nombre, o email',
                                'value' => $search ?? '',
                                'class' => 'form-control'
                            ]) ?>
                        </div>
                        <div class="form-group text-center">
                            <?= $this->Form->button(__('Buscar Estudiante'), ['class' => 'btn btn-primary']) ?>
                        </div> <?= $this->Form->end() ?>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-center">
                            <thead>
                                <tr>
                                    <th>Rut</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Fecha Inscripcción</th>
                                    <th>Ácciones</th>
                                </tr>
                            </thead>
                            <?php foreach ($course->users as $user): ?>
                                <tbody>
                                    <td class="rut-display"><?= h($user->rut) ?></td>
                                    <th><?= h($user->name . ' ' . $user->lastname) ?></th>
                                    <th><?= h($user->email) ?></th>
                                    <th><?= h($user->created) ?></th>
                                    <th>
                                        <?= $this->Html->link(
                                            '<i class="fa-sharp fa-solid fa-trash icon-color"></i> ',
                                            ['action' => 'removeUserFromCourse', $course->id, $user->id],
                                            [
                                                'escape' => false,
                                                'title' => 'Quitar Usuario'
                                            ]
                                        ); ?>
                                    </th>
                                </tbody>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.select2').select2(); // Inicializa Select2 en los elementos con la clase CSS 'select2'
    });

    // Agregar el evento de selección de resultado en Select2
    $('#searchInput').on('select2:select', function(event) {
        var result = event.params.data;
        // Realizar acciones adicionales según el resultado seleccionado
        // ...
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
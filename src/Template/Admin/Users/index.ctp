<div class="row">
    <div class="col-md-3 col-md-push-9 special-box">
        <div class="box box-warning p-3">
            <!-- Cabecera de la caja -->
            <div class="box-header with-border mb-3">
                <h3 class="box-title">BUSCADOR</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus icon-special"></i>
                    </button>
                </div>
            </div>
            <!-- Contenido de la caja -->
            <div class="box-body">
                <!-- Contenedor para los buscadores -->
                <div class="search-container">
                    <!-- Buscador por Nombre -->
                    <div class="form-group mb-4">
                        <?= $this->Form->create(null, [
                            'type' => 'get',
                            'url' => ['action' => 'index'],
                            'class' => ''
                        ]) ?>
                        <div class="">
                            <?= $this->Form->control('name', [
                                'label' => false,
                                'class' => 'form-control',
                                'placeholder' => 'Buscar por nombre o apellido',
                                'value' => $this->request->getQuery('name'),
                                'div' => false,
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

                    <!-- Buscador por RUT -->
                    <div class="form-group mb-4">
                        <?= $this->Form->create(null, [
                            'type' => 'get',
                            'url' => ['action' => 'index']
                        ]) ?>
                        <div class="">
                            <?= $this->Form->control('rut', [
                                'label' => false,
                                'class' => 'form-control',
                                'placeholder' => 'Buscar por RUT',
                                'value' => $this->request->getQuery('rut'),
                                'div' => false,
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
                <h1 class="box-title">USUARIOS</h1>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus icon-special"></i></button>
                </div>

            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-4 text-center" style="margin-bottom:10px;">
                            <?= $this->Html->link(
                                __('<i class="fa-solid fa-floppy-disk"></i> Agregar Usuario'),
                                ['action' => 'add'],
                                ['class' => 'btn btn-success w-100', 'escape' => false]
                            ) ?>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>RUT</th>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Rol</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <?php if ($users->isEmpty()) : ?>
                                    <tr>
                                        <td colspan="5" style="text-align: center;">No se han encontrado usuarios con esas características</td>
                                    </tr>
                                <?php else : ?>
                                    <?php foreach ($users as $user) : ?>
                                        <tbody>
                                            <td class="rut-display"><?= h($user->rut) ?></td>
                                            <td><?= $user->name . ' ' . $user->lastname ?></td>
                                            <td><?= $user->email ?></td>
                                            <td><?= $user->role->name ?></td>
                                            <td class="actions">
                                                <?= $this->Html->link('<i class="fa fa-edit icon-color"></i>', [
                                                    'action' => 'edit',
                                                    $user->id
                                                ], [
                                                    'escape' => false,
                                                    'title' => 'Editar',
                                                    'class' => 'btn btn-box-tool'
                                                ]); ?>

                                                <?php if ($user->is_active == 1) : ?>
                                                    <?= $this->Form->postLink('<i class="fa-sharp fa-solid fa-trash icon-color-trash"></i>', [
                                                        'action' => 'delete',
                                                        $user->id
                                                    ], [
                                                        'confirm' => '¿Está seguro de que desea desactivar el registro? El Usuario quedará con su cuenta suspendida hasta que decidas reactivarla',
                                                        'class' => 'btn btn-box-tool',
                                                        'title' => 'Desactivar',
                                                        'escape' => false
                                                    ]); ?>
                                                <?php else : ?>
                                                    <?= $this->Form->postLink('<i class="fa fa-check-circle icon-color" aria-hidden="true"></i>', [
                                                        'action' => 'activate',
                                                        $user->id
                                                    ], [
                                                        'confirm' => '¿Está seguro de que desea activar el registro?',
                                                        'class' => 'btn btn-box-tool',
                                                        'title' => 'Activar',
                                                        'escape' => false
                                                    ]); ?>
                                                <?php endif; ?>
                                            </td>
                                        </tbody>
                                    <?php endforeach; ?>
                                <?php endif; ?>
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
        <?= $this->Paginator->last(__('Ultimo') . ' >>') ?>
    </ul>
</div>

<script>
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
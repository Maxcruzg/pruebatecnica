<?= $this->Form->create($user) ?>
<div class="row">
    <div class="col-md-12 special-box">
        <div class="box box-warning">
            <div class="box-header with-border text-center agregar">
                <h1>Editar usuario</h1>
                <br><br>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus icon-special"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="container">


                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-5">
                                <?= $this->Form->control('name', [
                                    'label' => 'Nombre',
                                    'type' => 'text',
                                    'placeholder' => 'Juanito',
                                    'class' => 'form-control'
                                ]); ?>
                            </div>
                            <div class="col-md-5">
                                <?= $this->Form->control('apellido', [
                                    'label' => 'Apellido',
                                    'type' => 'text',
                                    'placeholder' => 'Pérez',
                                    'class' => 'form-control'
                                ]); ?>
                            </div>
                            <div class="col-md-2">
                                <?= $this->Form->control('roles_id', [
                                    'label' => 'Rol',
                                    'type' => 'select',
                                    'empty' => 'Seleccione',
                                    'options' => $roles,
                                    'class' => 'form-control select2'
                                ]); ?>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5">
                                <?= $this->Form->control('email', [
                                    'type' => 'text',
                                    'label' => 'Correo Electronico',
                                    'placeholder' => 'Ingrese una el correo personal',
                                    'class' => 'form-control',
                                    'required'
                                ]); ?>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5">
                                <?= $this->Form->control('password', [
                                    'type' => 'password',
                                    'label' => 'Ingrese una nueva contraseña',
                                    'placeholder' => 'Ingrese una nueva contraseña',
                                    'class' => 'form-control',
                                    'required' => true
                                ]); ?>
                            </div>
                            <div class="col-md-5">
                                <?= $this->Form->control('password2', [
                                    'type' => 'password',
                                    'label' => 'Confirmar nueva contraseña',
                                    'placeholder' => 'Confirme su nueva contraseña',
                                    'class' => 'form-control',
                                    'required' => true
                                ]); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center align-items-center">
                        <div class="col-md-12 text-center">
                            <div class="btn">
                                <br>
                                <?= $this->Form->button(
                                    __('<i class="fa-solid fa-floppy-disk"></i> Modificar'),
                                    ['class' => 'btn btn-danger']
                                ); ?>
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
<?= $this->Form->end() ?>


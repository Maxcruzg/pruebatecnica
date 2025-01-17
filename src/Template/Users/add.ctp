<?= $this->Form->create() ?>
<div class="row">
    <div class="col-md-12 special-box">
        <div class="box box-warning">
            <div class="box-header with-border text-center agregar">
                <h1>Registra un usuario</h1>
                <br><br>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus icon-special"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="container">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <?= $this->Form->control('name', [
                                    'label' => 'Nombre',
                                    'type' => 'text',
                                    'placeholder' => 'Ingrese un nombre válido',
                                    'class' => 'form-control'
                                ]); ?>
                            </div>
                            <div class="col-md-6">
                                <?= $this->Form->control('lastname', [
                                    'label' => 'Apellido',
                                    'type' => 'text',
                                    'placeholder' => 'Ingrese un apellido válido',
                                    'class' => 'form-control'
                                ]); ?>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
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
                            <div class="col-md-6">
                                <?= $this->Form->control('password', [
                                    'type' => 'password',
                                    'label' => 'Ingrese una contraseña',
                                    'placeholder' => 'Ingrese una contraseña',
                                    'class' => 'form-control',
                                    'required' => true
                                ]); ?>
                            </div>
                            <div class="col-md-6">
                                <?= $this->Form->control('password2', [
                                    'type' => 'password',
                                    'label' => 'Confirmacion contraseña',
                                    'placeholder' => 'confirme su contraseña',
                                    'class' => 'form-control',
                                    'required' => true
                                ]); ?>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center align-items-center">
                        <div class="col-md-12 text-center">
                            <div class="btn">
                                <?= $this->Form->button(
                                    __('<i class="fa-solid fa-floppy-disk"></i> Registrar'),
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

<?= $this->Form->end() ?>


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
                                <?= $this->Form->control('rut', [
                                    'type' => 'text',
                                    'label' => 'Ingrese su rut',
                                    'placeholder' => 'XX.XXX.XXX-X',
                                    'class' => 'form-control',
                                    'required'
                                ]); ?>
                            </div>
                            <div class="col-md-5">
                                <?= $this->Form->control('email', [
                                    'type' => 'text',
                                    'label' => 'Correo Electronico',
                                    'placeholder' => 'Ingrese una el correo personal',
                                    'class' => 'form-control',
                                    'required'
                                ]); ?>
                            </div>
                            <div class="col-md-2">
                                <?= $this->Form->control('roles_id', [
                                    'label' => 'Rol',
                                    'type' => 'select',
                                    'options' => $roles,
                                    'class' => 'form-control select2'
                                ]); ?>
                            </div>
                        </div>
                        <br>
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
                                <?= $this->Form->control('lastname', [
                                    'label' => 'Apellido',
                                    'type' => 'text',
                                    'placeholder' => 'Pérez',
                                    'class' => 'form-control'
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

<?= $this->Form->end() ?>


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
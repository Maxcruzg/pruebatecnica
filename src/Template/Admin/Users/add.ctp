<?= $this->Form->create() ?>
<div class="row">
    <div class="col-md-12 special-box">
        <div class="box box-warning">
            <div class="box-header with-border text-center agregar">
                <h1>AGREGAR USUARIO</h1>
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
                                    'label' => 'Rut',
                                    'placeholder' => 'XX.XXX.XXX-X',
                                    'class' => 'form-control',
                                    'required' => true
                                ]); ?>
                                <div id="rut-error" class="text-danger"></div>
                            </div>
                            <div class="col-md-5">
                                <?= $this->Form->control('email', [
                                    'type' => 'text',
                                    'label' => 'Correo Electrónico',
                                    'placeholder' => 'Ingrese un correo personal',
                                    'class' => 'form-control',
                                    'required' => true
                                ]); ?>
                                <div id="email-error" class="text-danger"></div>
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
                                <?= $this->Form->control('name', [
                                    'label' => 'Nombre',
                                    'type' => 'text',
                                    'placeholder' => 'Juanito',
                                    'class' => 'form-control'
                                ]); ?>
                                <div id="name-error" class="text-danger"></div> <!-- Contenedor para error -->
                            </div>
                            <div class="col-md-5">
                                <?= $this->Form->control('lastname', [
                                    'label' => 'Apellido',
                                    'type' => 'text',
                                    'placeholder' => 'Pérez',
                                    'class' => 'form-control'
                                ]); ?>
                                <div id="lastname-error" class="text-danger"></div> <!-- Contenedor para error -->
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5">
                                <?= $this->Form->control('password', [
                                    'type' => 'password',
                                    'label' => 'Contraseña',
                                    'placeholder' => '**********',
                                    'class' => 'form-control',
                                    'required' => true
                                ]); ?>
                                <div id="password-error" class="text-danger"></div> <!-- Contenedor para error -->
                            </div>
                            <div class="col-md-5">
                                <?= $this->Form->control('password2', [
                                    'type' => 'password',
                                    'label' => 'Confirmar contraseña',
                                    'placeholder' => '********',
                                    'class' => 'form-control',
                                    'required' => true
                                ]); ?>
                                <div id="password2-error" class="text-danger"></div> <!-- Contenedor para error -->
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center align-items-center">
                        <div class="col-md-12 text-center">
                            <div class="btn">
                                <br>
                                <?= $this->Form->button(
                                    __('<i class="fa-solid fa-floppy-disk"></i> Agregar'),
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
        const form = document.querySelector('form');
        form.addEventListener('submit', (event) => {
            const rut = document.querySelector('[name="rut"]');
            const email = document.querySelector('[name="email"]');
            const password = document.querySelector('[name="password"]');
            const password2 = document.querySelector('[name="password2"]');
            let valid = true;

            // Limpiar errores previos
            document.getElementById('rut-error').innerHTML = '';
            document.getElementById('email-error').innerHTML = '';
            document.getElementById('password-error').innerHTML = '';
            document.getElementById('password2-error').innerHTML = '';

            // Validar RUT
            if (!rut.value.match(/^\d{7,8}[0-9Kk]$/)) {
                document.getElementById('rut-error').innerHTML = 'El RUT ingresado no es válido.';
                valid = false;
            }

            // Validar Email
            if (!email.value.match(/^\S+@\S+\.\S+$/)) {
                document.getElementById('email-error').innerHTML = 'El correo electrónico no es válido.';
                valid = false;
            }

            // Validar Contraseña
            if (password.value.length < 8 || password.value.length > 16) {
                document.getElementById('password-error').innerHTML = 'La contraseña debe tener entre 8 y 16 caracteres.';
                valid = false;
            }

            // Validar que las contraseñas coincidan
            if (password.value !== password2.value) {
                document.getElementById('password2-error').innerHTML = 'Las contraseñas no coinciden.';
                valid = false;
            }

            if (!valid) {
                event.preventDefault(); // Prevenir el envío si hay errores
            }
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

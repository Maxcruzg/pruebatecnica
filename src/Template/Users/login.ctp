<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<div class="login-container">
    <div class="login-popup-wrap new_login_popup">
        <div class="login-popup-heading text-center">
            <h4><i class="fa fa-lock" aria-hidden="true"></i> INICIO SESIÓN </h4>
        </div>
        <?= $this->Form->create(null) ?>
        <div class="form-group">
            <?= $this->Form->control('email', [
                'label' => 'email',
                'required' => true,
                'class' => 'form-control',
                'placeholder' => 'EJEMPLO@EJEMPLO.CL'
            ]) ?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('password', [
                'label' => 'Contraseña',
                'required' => true,
                'class' => 'form-control',
                'placeholder' => 'INGRESA TU CONTRASEÑA'
            ]) ?>
        </div>
        <?= $this->Form->button('INGRESAR', [
            'class' => 'btn btn-danger login-popup-btn',
            'type' => 'submit'
        ]) ?>
        <!-- <div class="form-group text-center">
            <a class="pwd-forget" href="javascript:void(0)" id="open_forgotPassword">¿Olvidaste la Contraseña?</a>
        </div> -->
    </div>
</div>

<style>
    body {
        background-color: #f5f5f5;
        text-transform: uppercase;

    }


    .login-popup-heading>h4 {
        color: #7386D5;
        font-size: 18px;
        line-height: 30px;
    }

    .new_login_popup {
        border-radius: 2px;
        min-height: 332px;
        width: 400px;
        margin: 180px auto;
        /* Quitamos auto para centrar con flexbox */
    }

    /* Estilos para centrar el contenedor */

    .login-popup-btn {
        background: #7386D5;
        border: none;
        border-radius: 25px;
        color: #fff;
        display: block;
        font-size: 18px;
        height: 38px;
        line-height: 28px;
        margin: 20px auto 5px;
        width: 150px;
        -webkit-transition: all 700ms ease;
        -moz-transition: all 700ms ease;
        -ms-transition: all 700ms ease;
        -o-transition: all 700ms ease;
    }

    .login-popup-btn:hover {
        background: rgb(90, 112, 202);
        border: none;
        border-radius: 25px;
        color: #fff;
        display: block;
        font-size: 18px;
        height: 38px;
        line-height: 28px;
        margin: 20px auto 5px;
        width: 150px;
        -webkit-transition: all 700ms ease;
        -moz-transition: all 700ms ease;
        -ms-transition: all 700ms ease;
        -o-transition: all 700ms ease;
    }

    a {
        color: rgb(119, 137, 209);
        font-size: 18px;
    }
</style>
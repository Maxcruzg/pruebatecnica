<!DOCTYPE html>
<html>

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= isset($cakeDescription) ? h($cakeDescription) : 'Prueba técnica' ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

    <!-- Theme style -->
    <link rel="stylesheet" href="/css/AdminLTE.min.css">
    <link rel="stylesheet" href="/css/all-skins.min.css">
    <link rel="stylesheet" href="/css/admin.css">

    <!-- JQuery -->
    <!-- Cargar jQuery (una sola vez) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Cargar Bootstrap 3 (solo una vez) -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Notify -->
    <?= $this->Html->script(['bootstrap-notify']) ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-notify/0.2.0/css/bootstrap-notify.css">

    <!-- FontAwesome (iconos) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />



    <!-- Para que el sidebar se cierre y abra -->
    <?= $this->Html->script(['app.min', 'bootstrap-notify']) ?>

    <!-- date-Picker -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

</head>


<?php $user = $this->request->getsession()->read('Auth.User'); ?>

<body class="skin-yellow sidebar-mini sidebar-wrapper " data-toggle="push-menu">
    <div class="wrapper">
        <header class="main-header">
            <div class="logo">
                <h3 style="border-bottom: 2px solid white;"></h3>
            </div>
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="sidebar-toggle fa fa-bars" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu" style="margin-left:-20%;">
                            <a class="color">
                                <Strong class="hidden-xs"><?= $user->name . ' ' . $user->lastname;  ?></Strong>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="main-sidebar">
            <section class="sidebar" style="height: auto;">
                <ul class="sidebar-menu tree" data-widget="tree">
                    <li><a href="/admin/users/index"><i class="fa fa-users" aria-hidden="true" style="margin: 2px;"></i><span> Usuarios</span></a></li>
                    <li><a href="/admin/courses/index"><i class="fa fa-graduation-cap" aria-hidden="true" style="margin: 2px;"></i><span>Cursos</span></a></li>
                    <li><a href="/users/logout"><i class="fa fa-sign-out" aria-hidden="true" style="margin: 2px;"></i><span> Cerrar Sesión</span></a></li>
                </ul>
            </section>
        </aside>
        <div class="content-wrapper">
            <?= $this->Flash->render() ?>
            <section class="content">
                <?= $this->fetch('content') ?>
            </section>
        </div>
    </div>
</body>

</html>

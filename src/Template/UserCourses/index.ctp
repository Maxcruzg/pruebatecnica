<div class="row">
    <div class="col-md-12 special-box">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h1 class="box-title">CURSOS INSCRITOS</h1>
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
                                        <th>Nombre Curso</th>
                                        <th>F. Inicio</th>
                                        <th>F. Término</th>
                                        <th>Ácciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($courses as $course): ?>
                                        <tr>
                                            <td> <?= h($course->name) ?></td>
                                            <td><?= $course->start_date ?></td>
                                            <td><?= $course->end_date ?></td>
                                            <td class="actions">
                                                <?= $this->Html->link('<i class="fa-sharp fa-solid fa-eye icon-color"></i>', [
                                                    'action' => 'view',
                                                    $course->id
                                                ], [
                                                    'escape' => false,
                                                    'title' => 'Ver',
                                                    'class' => 'btn btn-box-tool'
                                                ]); ?> </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
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
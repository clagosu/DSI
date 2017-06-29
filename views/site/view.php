<?php
 use yii\helpers\Url;
 use yii\helpers\Html;
 use yii\widgets\ActiveForm;
 use yii\data\Pagination;
 use yii\widgets\LinkPager;
 ?>




<a href="<?= Url::toRoute("site/create") ?>">Crear una nueva Actividad de Convenio</a>
 
<?php $f = ActiveForm::begin([
    "method" => "get",
    "action" => Url::toRoute("site/view"),
    "enableClientValidation" => true,
]);
?>
 
<div class="form-group">
    <?= $f->field($form, "q")->input("search") ?>
</div>
 
<?= Html::submitButton("Buscar", ["class" => "btn btn-primary"]) ?>
 
<?php $f->end() ?>
 
<h3><?= $search ?></h3>
 
<h3>Lista de Actividades</h3>
<table class="table table-bordered">
    <tr>
        <th>ID Actividad Convenio</th>
        <th>Nombre Actividad</th>
        <th>ID Estado Actividad</th>
        <th>ID Tipo Actividad</th>
        <th>ID Responsable Actividad</th>
        <th>Fecha Inicio</th>
        <th>Fecha Fin</th>
        <th>ID Convenio</th>
        <th>Descripcion</th>
        <th>Vigente</th>
        <th></th>
        <th></th>
    </tr>
    <?php foreach($model as $row): ?>
    <tr>
        <td><?= $row->id_actividad_convenio ?></td>
        <td><?= $row->nombre_actividad ?></td>
        <td><?= $row->id_estado_actividad ?></td>
        <td><?= $row->id_tipo_actividad ?></td>
        <td><?= $row->id_responsable_actividad ?></td>
        <td><?= $row->fecha_inicio ?></td>
        <td><?= $row->fecha_fin ?></td>
        <td><?= $row->id_convenio ?></td>
        <td><?= $row->descripcion ?></td>
        <td><?= $row->vigente ?></td>
        
        <td><a href="<?= Url::toRoute(["site/update", "id_actividad_convenio" => $row->id_actividad_convenio]) ?>">Editar</a></td>
        <td>
            <a href="#" data-toggle="modal" data-target="#id_actividad_convenio_<?= $row->id_actividad_convenio ?>">Eliminar</a>
            <div class="modal fade" role="dialog" aria-hidden="true" id="id_actividad_convenio_<?= $row->id_actividad_convenio ?>">
                      <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title">Eliminar Actividad</h4>
                              </div>
                              <div class="modal-body">
                                    <p>¿Realmente deseas eliminar la actividad con ID <?= $row->id_actividad_convenio ?>?</p>
                              </div>
                              <div class="modal-footer">
                              <?= Html::beginForm(Url::toRoute("site/delete"), "POST") ?>
                                    <input type="hidden" name="id_actividad_convenio" value="<?= $row->id_actividad_convenio ?>">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Eliminar</button>
                              <?= Html::endForm() ?>
                              </div>
                            </div><!-- /.modal-content -->
                      </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </td>
    </tr>
    <?php endforeach ?>
</table>

<?= LinkPager::widget([
    "pagination" => $pages,
]);



<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\data\Pagination;
use yii\widgets\LinkPager;
?>
<a href="<?= Url::toRoute("site/create") ?>">Crear un nuevo convenio</a>

<h3>Lista de Convenios</h3>
<table class="table table-bordered">
    <tr>
        <th>ID Convenio</th>
        <th>ID Tipo</th>
        <th>ID Cordinador</th>
        <th>ID Estado</th>
        <th>Nombre Convenio</th>
        <th>Fecha Inicio</th>
        <th>Fecha Termino</th>
        <th>Fecha Firma</th>
        <th>Fecha Decreto</th>
        <th>Numero Decreto</th>
        <th>Descripcion</th>
        <th>Vigente</th>
        <th>Vigencia</th>
        <th></th>
        <th></th>
    </tr>
    <?php foreach($model as $row): ?>
    <tr>
        <td><?= $row->id_convenio ?></td>
        <td><?= $row->id_tipo_convenio ?></td>
        <td><?= $row->id_coordinador_convenio ?></td>
        <td><?= $row->id_estado_convenio ?></td>
        <td><?= $row->nombre_convenio ?></td>
        <td><?= $row->fecha_inicio ?></td>
        <td><?= $row->fecha_termino ?></td>
        <td><?= $row->fecha_firma ?></td>
        <td><?= $row->fecha_decreto ?></td>
        <td><?= $row->numero_decreto ?></td>
        <td><?= $row->descripcion ?></td>
        <td><?= $row->vigente ?></td>
        <td><?= $row->vigencia ?></td>
        <td><a href="<?= Url::toRoute(["site/update", "id_convenio" => $row->id_convenio]) ?>">Editar</a></td>
        <td>
            <a href="#" data-toggle="modal" data-target="#id_convenio<?= $row->id_convenio ?>">Eliminar</a>
            <div class="modal fade" role="dialog" aria-hidden="true" id="id_convenio<?= $row->id_convenio ?>">
                      <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title">Eliminar convenio</h4>
                              </div>
                              <div class="modal-body">
                                    <p>¿Realmente deseas eliminar el convenio con id <?= $row->id_convenio ?>?</p>
                              </div>
                              <div class="modal-footer">
                              <?= Html::beginForm(Url::toRoute("site/delete"), "POST") ?>
                                    <input type="hidden" name="id_convenio" value="<?= $row->id_convenio ?>">
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
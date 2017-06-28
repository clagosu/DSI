<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\data\Pagination;
use yii\widgets\LinkPager;

?>

<a href="<?= Url::toRoute("site/create") ?>"> Crear una nueva Institución </a>

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


<h3>Lista de Instituciones</h3>
<table class="table table-bordered">
    <tr>
    <th> ID Tipo Institucion </th>
    <th> Nombre Institucion </th>
    <th> ID Institucion </th>
    <th> ID Pais </th>
    <th> Vigente </th>
    <th> ID Internacional </th>
    <th> RUT Institucion </th>
    <th> Razon Social Institucion </th>
    <th> Direccion Institucion </th>
    <th> Telefono Institucion </th>
    <th> Email Institucion </th>
    <th> Link Institucion </th>
    
    <th> </th>
    <th> </th>
    </tr>
    <?php foreach($model as $row): ?>
    <tr>
        <td><?= $row->id_tipo_institucion ?></td>
        <td><?= $row->nombre_institucion ?></td>
        <td><?= $row->id_institucion ?></td>
        <td><?= $row->id_pais ?></td>
        <td><?= $row->vigente ?></td>
        <td><?= $row->id_internacional ?></td>
        <td><?= $row->rut_institucion ?></td>
        <td><?= $row->razon_social_institucion ?></td>
        <td><?= $row->direccion_institucion ?></td>
        <td><?= $row->telefono_institucion ?></td>
        <td><?= $row->email_institucion ?></td>
        <td><?= $row->link_institucion ?></td>
        <td><a href="<?= Url::toRoute(["site/update", "id_institucion" => $row->id_institucion]) ?>">Editar</a></td>
        <td>
            <a href="#" data-toggle="modal" data-target="#id_institucion_<?= $row->id_institucion ?>">Eliminar</a>
            <div class="modal fade" role="dialog" aria-hidden="true" id="id_institucion_<?= $row->id_institucion ?>">
                      <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title">Eliminar Institucion</h4>
                              </div>
                              <div class="modal-body">
                                    <p>¿Realmente deseas eliminar a la institucion con id <?= $row->id_institucion ?>?</p>
                              </div>
                              <div class="modal-footer">
                              <?= Html::beginForm(Url::toRoute("site/delete"), "POST") ?>
                                    <input type="hidden" name="id_institucion" value="<?= $row->id_institucion ?>">
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


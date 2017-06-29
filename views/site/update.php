<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>

<a href="<?= Url::toRoute("site/view") ?>">Ir a las Actividades por convenio</a>

<h1>Editar la actividad con ID <?= Html::encode($_GET["id_actividad_convenio"]) ?></h1>

<h3><?= $msg ?></h3>

<?php $form = ActiveForm::begin([
    "method" => "post",
    'enableClientValidation' => true,
]);
?>

<?= $form->field($model, "id_actividad_convenio")->input("hidden")->label(false) ?>

<div class="form-group">
 <?= $form->field($model, "id_actividad_convenio")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "nombre_actividad")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "id_estado_actividad")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "id_tipo_actividad")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "id_responsable_actividad")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "fecha_inicio")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "fecha_fin")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "id_convenio")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "descripcion")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "vigente")->input("text") ?>   
</div>

<?= Html::submitButton("Actualizar", ["class" => "btn btn-primary"]) ?>

<?php $form->end() ?>
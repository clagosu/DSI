<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>

<a href="<?= Url::toRoute("site/view") ?>">Ir al listado</a>

<h1>Editar registro con id <?= Html::encode($_GET["id_estado_convenio"]) ?></h1>

<h3><?= $msg ?></h3>

<?php $form = ActiveForm::begin([
    "method" => "post",
    'enableClientValidation' => true,
]);
?>

<?= $form->field($model, "id_estado_convenio")->input("hidden")->label(false) ?>

<div class="form-group">
 <?= $form->field($model, "nombre_estado_convenio")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "Descripcion")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "Vigente")->input("text") ?>   
</div>

<?= Html::submitButton("Actualizar", ["class" => "btn btn-primary"]) ?>

<?php $form->end() ?>
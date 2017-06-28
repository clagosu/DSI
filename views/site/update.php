<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>

<a href="<?= Url::toRoute("site/view") ?>">Ir a la lista de instituciones</a>

<h1>Editar institucion con id <?= Html::encode($_GET["id_institucion"]) ?></h1>

<h3><?= $msg ?></h3>

<?php $form = ActiveForm::begin([
    "method" => "post",
    'enableClientValidation' => true,
]);
?>

<?= $form->field($model, "id_institucion")->input("hidden")->label(false) ?>

<div class="form-group">
 <?= $form->field($model, "id_tipo_institucion")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "nombre_institucion")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "id_pais")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "vigente")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "id_internacional")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "rut_institucion")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "razon_social_institucion")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "direccion_institucion")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "telefono_institucion")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "email_institucion")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "link_institucion")->input("text") ?>   
</div>

<?= Html::submitButton("Actualizar", ["class" => "btn btn-primary"]) ?>

<?php $form->end() ?>

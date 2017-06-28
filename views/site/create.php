<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<h1>Crear Convenio</h1>
<h3><?= $msg ?></h3>
<?php $form = ActiveForm::begin([
    "method" => "post",
 'enableClientValidation' => true,
]);
?>
<div class="form-group">
 <?= $form->field($model, "id_convenio")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "id_tipo_convenio")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "id_coordinador_convenio")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "id_estado_convenio")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "nombre_convenio")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "fecha_inicio")->input("date") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "fecha_termino")->input("date") ?>   
</div>
<div class="form-group">
 <?= $form->field($model, "fecha_firma")->input("date") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "fecha_decreto")->input("date") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "numero_decreto")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "descripcion")->input("text") ?>   
</div>
<div class="form-group">
 <?= $form->field($model, "vigente")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "vigencia")->input("text") ?>   
</div>

<?= Html::submitButton("Crear", ["class" => "btn btn-primary"]) ?>

<?php $form->end() ?>
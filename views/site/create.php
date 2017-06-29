<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<h1>Crear Actividades por Convenio</h1>
<h3><?= $msg ?></h3>
<?php $form = ActiveForm::begin([
    "method" => "post",
 'enableClientValidation' => true,
]);
?>
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


<?= Html::submitButton("Crear", ["class" => "btn btn-primary"]) ?>

<?php $form->end() ?>
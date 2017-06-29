<?php

namespace app\models;
use Yii;
use yii\base\model;

class ValidarActividad extends model{

public $id_actividad_convenio;
public $nombre_actividad;
public $id_estado_actividad;
public $id_tipo_actividad;
public $id_responsable_actividad;
public $fecha_inicio;
public $fecha_fin;
public $id_convenio;
public $descripcion;
public $vigente;

public function rules()
 {
  return [
   ['nombre_actividad', 'required', 'message' => 'Campo requerido'],
   ['id_actividad_convenio', 'required', 'message' => 'Campo requerido'],
   ['id_estado_actividad', 'required', 'message' => 'Campo requerido'],
   ['id_tipo_actividad', 'required', 'message' => 'Campo requerido'],
   ['id_responsable_actividad', 'required', 'message' => 'Campo requerido'],
	['fecha_fin',  'date', 'format'=>'yyyy-mm-dd', 'message' => 'AAAA-MM-DD'],
 	['fecha_inicio', 'date', 'format'=>'yyyy-mm-dd', 'message' => 'AAAA-MM-DD'],
   ['id_convenio', 'required', 'message' => 'Campo requerido'],
   ['descripcion', 'required', 'message' => 'Solo se aceptan letras'],
   ['vigente', 'required', 'message' => 'Maximo 2 caracteres'],
  ];

 }
 
}

<?php

namespace app\models;
use Yii;
use yii\base\model;

class FormEstadoConvenio extends model{

public $id_estado_convenio;
public $nombre_estado_convenio;
public $Descripcion;
public $Vigente;

public function rules()
 {
  return [
   ['id_estado_convenio', 'integer', 'message' => 'Id incorrecto'],
   ['nombre_estado_convenio', 'required', 'message' => 'Campo requerido'],
   ['nombre_estado_convenio', 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Sólo se aceptan letras'],
   ['nombre_estado_convenio', 'match', 'pattern' => '/^.{3,50}$/', 'message' => 'Mínimo 3 máximo 50 caracteres'],
   ['Descripcion', 'required', 'message' => 'Campo requerido'],
   ['Descripcion', 'match', 'pattern' => '/^.{3,200}$/', 'message' => 'Mínimo 3 máximo 200 caracteres'],
   ['Vigente', 'required', 'message' => 'Campo requerido'],
   ['Vigente', 'match', 'pattern' => '/^.{1,1}$/', 'message' => 'Sólo un caracter'],
  ];
 }
 
}
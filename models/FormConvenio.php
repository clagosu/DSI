<?php

namespace app\models;
use Yii;
use yii\base\model;

class FormConvenio extends model{

public $id_convenio;
public $id_tipo_convenio;
public $id_coordinador_convenio;
public $id_estado_convenio;
public $nombre_convenio;
public $fecha_inicio;
public $fecha_termino;
public $fecha_firma;
public $fecha_decreto;
public $numero_decreto;
public $descripcion;
public $vigente;
public $vigencia;

public function rules()
 {
  return [
['id_convenio', 'integer', 'message' => 'Id incorrecto, deben ser numeros'],
['id_tipo_convenio', 'integer', 'message' => 'Id incorrecto, deben ser numeros'],
['id_estado_convenio', 'integer', 'message' => 'Id incorrecto, deben ser numeros'],
['id_coordinador_convenio', 'integer', 'message' => 'Id incorrecto, deben ser numeros'],
      
      
      [['id_convenio','id_tipo_convenio','id_estado_convenio','id_coordinador_convenio'], 'integer', 'min'=>1000, 'max'=>9999,
       'message' => 'Debe tener  4 numeros'],
      
      
['id_tipo_convenio', 'required', 'message' => 'Campo requerido'],
['id_convenio', 'required', 'message' => 'Campo requerido'],
['id_estado_convenio', 'required', 'message' => 'Campo requerido'],
['id_coordinador_convenio', 'required', 'message' => 'Campo requerido'],
['nombre_convenio', 'required', 'message' => 'Campo requerido'],
['fecha_inicio', 'required', 'message' => 'Campo requerido'],
['fecha_termino', 'required', 'message' => 'Campo requerido'],
['fecha_firma', 'required', 'message' => 'Campo requerido'],
['fecha_decreto', 'required', 'message' => 'Campo requerido'],
['numero_decreto', 'required', 'message' => 'Campo requerido'],
['descripcion', 'required', 'message' => 'Campo requerido'],
['vigente', 'required', 'message' => 'Campo requerido'],
['vigencia', 'required', 'message' => 'Campo requerido'],
      
      
     /* ['fecha_inicio', 'type', 'type' => 'date', 'message' => 'Formato de fecha no valido'],
      ['fecha_termino', 'type', 'type' => 'date', 'message' => 'Formato de fecha no valido'],
      ['fecha_firma', 'type', 'type' => 'date', 'message' => 'Formato de fecha no valido'],
      ['fecha_decreto', 'type', 'type' => 'date', 'message' => 'Formato de fecha no valido'],
      */
      
['nombre_convenio', 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Sólo se aceptan letras'],
['descripcion', 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Sólo se aceptan letras'],

      
      
   /*   
   ['nombre', 'match', 'pattern' => '/^.{3,50}$/', 'message' => 'Mínimo 3 máximo 50 caracteres'],
   ['apellidos', 'required', 'message' => 'Campo requerido'],
   ['apellidos', 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Sólo se aceptan letras'],
   ['apellidos', 'match', 'pattern' => '/^.{3,80}$/', 'message' => 'Mínimo 3 máximo 80 caracteres'],
   ['clase', 'required', 'message' => 'Campo requerido'],
   ['clase', 'integer', 'message' => 'Sólo números enteros'],
   ['nota_final', 'required', 'message' => 'Campo requerido'],
   ['nota_final', 'number', 'message' => 'Sólo números'],*/
  ];
 }
 
}

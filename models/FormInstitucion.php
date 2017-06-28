<?php

namespace app\models;
use Yii;
use yii\base\model;

class FormInstitucion extends model{

public $id_tipo_institucion;
public $nombre_institucion;
public $id_institucion;
public $id_pais;
public $vigente;
public $id_internacional;
public $rut_institucion;
public $razon_social_institucion;
public $direccion_institucion;
public $telefono_institucion;
public $email_institucion;
public $link_institucion;

public function rules()
 {
  return [
   ['id_tipo_institucion', 'integer', 'message' => 'ID incorrecto'],
   ['id_tipo_institucion', 'required', 'message' => 'Campo requerido'],
   ['nombre_institucion', 'required', 'message' => 'Campo requerido'],
   ['nombre_institucion', 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Sólo se aceptan letras'],
   ['nombre_institucion', 'match', 'pattern' => '/^.{3,500}$/', 'message' => 'Mínimo 3 y máximo 500 caracteres'],
   ['id_institucion', 'integer', 'message' => 'ID incorrecto'],
   ['id_institucion', 'required', 'message' => 'Campo requerido'],
   ['id_pais', 'integer', 'message' => 'ID incorrecto'],
   ['id_pais', 'required', 'message' => 'Campo requerido'],
   ['vigente', 'required', 'message' => 'Campo requerido'],
   ['vigente', 'match', 'pattern' => '/^[yn\s]+$/i', 'message' => 'Sólo se aceptan letras. Ingresar "y" en caso de estar vigente aún, o bien ingresar "n" en caso contrario'],
   ['id_internacional', 'required', 'message' => 'Campo requerido'],
   ['id_internacional', 'match', 'pattern' => '/^[123456789\s]+$/i', 'message' => 'Sólo se aceptan números del 1 al 9.'],
   ['rut_institucion', 'required', 'message' => 'Campo requerido'],
   ['rut_institucion', 'match', 'pattern' => '/^[0-9k\s]+$/i', 'message' => 'Sólo se aceptan números y la letra "k"'],
   ['rut_institucion', 'match', 'pattern' => '/^.{9,12}$/', 'message' => 'Mínimo 9 y máximo 12 caracteres'],
   ['razon_social_institucion', 'required', 'message' => 'Campo requerido'],
   ['razon_social_institucion', 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Sólo se aceptan letras'],
   ['razon_social_institucion', 'match', 'pattern' => '/^.{3,500}$/', 'message' => 'Mínimo 3 y máximo 500 caracteres'],
   ['direccion_institucion', 'required', 'message' => 'Campo requerido'],
   ['direccion_institucion', 'match', 'pattern' => '/^[0-9a-záéíóúñ\s]+$/i', 'message' => 'Sólo se aceptan letras y números'],
   ['direccion_institucion', 'match', 'pattern' => '/^.{3,500}$/', 'message' => 'Mínimo 3 y máximo 500 caracteres'],
   ['telefono_institucion', 'required', 'message' => 'Campo requerido'],
   ['telefono_institucion', 'match', 'pattern' => '/^[0-9\s]+$/i', 'message' => 'Sólo se aceptan números'],
   ['telefono_institucion', 'match', 'pattern' => '/^.{9,100}$/', 'message' => 'Mínimo 9 y máximo 100 caracteres'],
   ['email_institucion', 'required', 'message' => 'Campo requerido'],
   ['email_institucion', 'match', 'pattern' => '/^.{3,200}$/', 'message' => 'Mínimo 3 y máximo 200 caracteres'],
   ['email_institucion','email','message' => 'Formato no válido'],
   ['link_institucion', 'required', 'message' => 'Campo requerido'],
   ['link_institucion', 'match', 'pattern' => '/^.{3,200}$/', 'message' => 'Mínimo 3 y máximo 200 caracteres'],
  ];
 }
 
}

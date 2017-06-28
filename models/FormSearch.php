<?php
namespace app\models;
use Yii;
use yii\base\model;

class FormSearch extends model{
    public $q;
    
    public function rules()
    {
        return [
            ["q", "match", "pattern" => "/^[0-9a-záéíóúñA-Z \s]+$/i", "message" => "Sólo se aceptan letras y números"]
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'q' => "Buscar:",
        ];
    }
}

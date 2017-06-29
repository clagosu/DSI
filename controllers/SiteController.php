<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\ValidarActividad;
use app\models\Actividad;
// Actualizar
use yii\helpers\Html;
use yii\helpers\Url;
// Buscar
use app\models\FormSearch;

use yii\data\Pagination;

use yii\widgets\ActiveForm;

use app\models\ValidarFormulario;
use app\models\ValidarFormularioAjax;


class SiteController extends Controller
{   

    public function actionUpdate()
    {
        $model = new ValidarActividad;
        $msg = null;
        
        if($model->load(Yii::$app->request->post()))
        {
            if($model->validate())
            {
                $table = Actividad::findOne($model->id_actividad_convenio);
                if($table)
                {
                    $table->id_actividad_convenio = $model->id_actividad_convenio;
                    $table->nombre_actividad = $model->nombre_actividad;
                    $table->id_estado_actividad = $model->id_estado_actividad;
                    $table->id_tipo_actividad = $model->id_tipo_actividad;
                    $table->id_responsable_actividad = $model->id_responsable_actividad;
                    $table->fecha_inicio = $model->fecha_inicio;
                    $table->fecha_fin = $model->fecha_fin;
                    $table->id_convenio = $model->id_convenio;
                    $table->descripcion = $model->descripcion;
                    $table->vigente = $model->vigente;



                    if ($table->update())
                    {
                        $msg = "La Actividad ha sido actualizada correctamente";
                    }
                    else
                    {
                        $msg = "ELa Actividad  no ha podido ser actualizada";
                    }
                }
                else
                {
                    $msg = "La Actividad seleccionada no ha sido encontrado";
                }
            }
            else
            {
                $model->getErrors();
            }
        }
        
        
        if (Yii::$app->request->get("id_actividad_convenio"))
        {
            $id_actividad_convenio = Html::encode($_GET["id_actividad_convenio"]);
            if ((int) $id_actividad_convenio)
            {
                $table = Actividad::findOne($id_actividad_convenio);
                if($table)
                {
                    $model->id_actividad_convenio = $table->id_actividad_convenio;
                    $model->nombre_actividad = $table->nombre_actividad;
                    $model->id_estado_actividad = $table->id_estado_actividad;
                    $model->id_tipo_actividad = $table->id_tipo_actividad;
                    $model->id_responsable_actividad = $table->id_responsable_actividad;
                    $model->fecha_inicio = $table->fecha_inicio;
                    $model->fecha_fin = $table->fecha_fin;
                    $model->id_convenio = $table->id_convenio;
                    $model->descripcion = $table->descripcion;
                    $model->vigente = $table->vigente;
                }
                else
                {
                    return $this->redirect(["site/view"]);
                }
            }
            else
            {
                return $this->redirect(["site/view"]);
            }
        }
        else
        {
            return $this->redirect(["site/view"]);
        }
        return $this->render("update", ["model" => $model, "msg" => $msg]);
    }


    public function actionDelete()
    {
        if(Yii::$app->request->post())
        {
            $id_actividad_convenio = Html::encode($_POST["id_actividad_convenio"]);
            if((int) $id_actividad_convenio)
            {
                if(Actividad::deleteAll("id_actividad_convenio=:id_actividad_convenio", [":id_actividad_convenio" => $id_actividad_convenio]))
                {
                    echo "Actividad con ID $id_actividad_convenio eliminado con éxito, redireccionando ...";
                    echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("site/view")."'>";
                }
                else
                {
                    echo "Ha ocurrido un error al eliminar la Actividad, redireccionando ...";
                    echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("site/view")."'>"; 
                }
            }
            else
            {
                echo "Ha ocurrido un error al eliminar la Actividad, redireccionando ...";
                echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("site/view")."'>";
            }
        }
        else
        {
            return $this->redirect(["site/view"]);
        }
    }
     
 public function actionView()
    {

        $form = new FormSearch;
        $search = null;
        if($form->load(Yii::$app->request->get()))
        {
            if ($form->validate())
            {
                $search = Html::encode($form->q);
               $table = Actividad::find()
                         ->where(["=", "id_actividad_convenio", $search])
                         ->orWhere(["=", "id_estado_actividad", $search])
                         ->orWhere(["=", "id_tipo_actividad", $search]);
                $count = clone $table;
                $pages = new Pagination([
                    "pageSize" => 1,
                    "totalCount" => $count->count()
                ]);
                $model = $table
                        ->offset($pages->offset)
                        ->limit($pages->limit)
                        ->all();
            }
            else
            {
                $form->getErrors();
            }
        }
        else
        {
            $table = Actividad::find();
            $count = clone $table;
            $pages = new Pagination([
                "pageSize" => 5,
                "totalCount" => $count->count(),
            ]);
            $model = $table
                    ->offset($pages->offset)
                    ->limit($pages->limit)
                    ->all();
        }
        return $this->render("view", ["model" => $model, "form" => $form, "search" => $search, "pages" => $pages]);
    }
     
    public function actionCreate()
    {
        $model = new ValidarActividad;
        $msg = null;
        if($model->load(Yii::$app->request->post()))
        {
            if($model->validate())
            {
                $table = new Actividad;
                $table->id_actividad_convenio = $model->id_actividad_convenio;
                $table->nombre_actividad = $model->nombre_actividad;
                $table->id_estado_actividad = $model->id_estado_actividad;
                $table->id_tipo_actividad = $model->id_tipo_actividad;
                $table->id_responsable_actividad = $model->id_responsable_actividad;
                $table->fecha_inicio = $model->fecha_inicio;
                $table->fecha_fin = $model->fecha_fin;
                $table->id_convenio = $model->id_convenio;
                $table->descripcion = $model->descripcion;
                $table->vigente = $model->vigente;

                if ($table->insert())
                {
                    $msg = "Registro de Validacion Guardado Correctamente";
                    $model->id_actividad_convenio = null;
                    $model->nombre_actividad = null;
                    $model->id_estado_actividad = null;
                    $model->id_tipo_actividad = null;
                    $model->id_responsable_actividad = null;
                    $model->fecha_inicio = null;
                    $model->fecha_fin = null;
                    $model->id_convenio = null;
                    $model->descripcion = null;
                    $model->vigente = null;
                }
                else
                {
                    $msg = "Ha ocurrido un error al insertar el Registro deActividad";
                }
            }
            else
            {
                $model->getErrors();
            }
        }
        return $this->render("create", ['model' => $model, 'msg' => $msg]);
    }
     
    public function actionSaluda($get = "Tutorial Yii")
    {
        $mensaje = "Hola Mundo"; 
        $numeros = [0, 1, 2, 3, 4, 5];
        return $this->render("saluda",
                [
                    "saluda" => $mensaje,
                    "numeros" => $numeros,
                    "get" => $get,
                ]);
    }
     
    public function actionFormulario($mensaje = null)
    {
        return $this->render("formulario", ["mensaje" => $mensaje]);
    }
     
    public function actionRequest()
    {
        $mensaje = null;
        if (isset($_REQUEST["nombre"]))
        {
            $mensaje = "Bien, has enviando tu nombre correctamente: " . $_REQUEST["nombre"];
        }
        $this->redirect(["site/formulario", "mensaje" => $mensaje]);
    }
     
    public function actionValidarformulario()
    {
 
  $model = new ValidarFormulario;
   
  if ($model->load(Yii::$app->request->post()))
  {
      if($model->validate())
            {
                //Por ejemplo, consultar en una base de datos
            }
            else
            {
                $model->getErrors();
            }
  }
   
        return $this->render("validarformulario", ["model" => $model]);
    }
     
    public function actionValidarformularioajax()
    {
        $model = new ValidarFormularioAjax;
        $msg = null;
         
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
         
        if ($model->load(Yii::$app->request->post()))
        {
            if ($model->validate())
            {
                //Por ejemplo hacer una consulta a una base de datos
                $msg = "Enhorabuena Actividad enviado correctamente";
                $model->nombre = null;
                $model->email = null;
            }
            else
            {
                $model->getErrors();
            }
        }
         
        return $this->render("validarformularioajax", ['model' => $model, 'msg' => $msg]);
    }
     
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
 
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
 
    public function actionIndex()
    {
        return $this->render('index');
    }
 
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
 
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
 
    public function actionLogout()
    {
        Yii::$app->user->logout();
 
        return $this->goHome();
    }
 
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');
 
            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }
 
    public function actionAbout()
    {
        return $this->render('about');
    }
}


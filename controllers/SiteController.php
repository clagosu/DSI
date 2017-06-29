<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\FormConvenio;
use app\models\Convenio;
use yii\helpers\Html;
use yii\data\Pagination;
use yii\helpers\Url;

class SiteController extends Controller
{
    
    
   public function actionView()
    {
        $table = new Convenio;
        $model = $table->find()->all();
        return $this->render("view", ["model" => $model]);
    }
    
    public function actionCreate()
    {
        $model = new FormConvenio;
        $msg = null;
        if($model->load(Yii::$app->request->post()))
        {
            if($model->validate())
            {
                $table = new Convenio;
                $table->id_convenio = $model->id_convenio;
                $table->id_tipo_convenio = $model->id_tipo_convenio;
                $table->id_coordinador_convenio = $model->id_coordinador_convenio;
                $table->id_estado_convenio = $model->id_estado_convenio;
                $table->nombre_convenio = $model->nombre_convenio;
                $table->fecha_inicio = $model->fecha_inicio;
                $table->fecha_termino = $model->fecha_termino;
                $table->fecha_firma = $model->fecha_firma;
                $table->fecha_decreto = $model->fecha_decreto;
                $table->numero_decreto = $model->numero_decreto;
                $table->descripcion = $model->descripcion;
                $table->vigente = $model->vigente;
                $table->vigencia = $model->vigencia;
                if ($table->insert())
                {
                    $msg = "Enhorabuena registro guardado correctamente";
                    $model->id_convenio = null;
                    $model->id_tipo_convenio = null;
                    $model->id_coordinador_convenio = null;
                    $model->id_estado_convenio = null;
                    $model->nombre_convenio = null;
                    $model->fecha_inicio = null;
                    $model->fecha_termino = null;
                    $model->fecha_firma = null;
                    $model->fecha_decreto = null;
                    $model->numero_decreto = null;
                    $model->descripcion = null;
                    $model->vigente = null;
                    $model->vigencia = null;
                
                }
                else
                {
                    $msg = "Ha ocurrido un error al insertar el registro";
                }
            }
            else
            {
                $model->getErrors();
            }
        }
        return $this->render("create", ['model' => $model, 'msg' => $msg]);
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
                $msg = "Enhorabuena formulario enviado correctamente";
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

<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;


class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    
    public function actionCreate(){
        $model = new formInstitucion;
        $msg = null;
        if($model->load(Yii::$app->request->post()))
        {
        if($model->validate()
           {
           $table = new institucion;
               $table->nombre_institucion=$model->nombre_institucion;
               $table->id_tipo_institucion=$model->id_tipo_institucion;
               $table->id_institucion=$model->id_institucion;
               $table->id_pais=$model->id_pais;
               $table->vigente=$model->vigente;
               $table->id_internacional=$model->id_internacional;
               $table->rut_institucion=$model->rut_institucion;
               $table->razon_social_institucion=$model->razon_social_institucion;
               $table->direccion_institucion=$model->direccion_institucion;
               $table->telefono_institucion=$model->telefono_institucion;
               $table->email_institucion=$model->email_institucion;
               $table->link_institucion=$model->link_institucion;
               if($table->insert()){
                   $msg = "Registro guardado correctamente";
                   $model->nombre_institucion = null;
                   $model->id_tipo_institucion = null;
                   $model->id_institucion = null;
                   $model->id_pais = null;
                   $model->vigente = null;
                   $model->id_internacional=null;
                   $model->rut_institucion=null;
                   $model razon_social_institucion=null;
                   $model direccion_institucion=null;
                   $model telefono_institucion=null;
                   $model email_institucion=null;
                   $model link_institucion=null;
               }else{
               $msg = "Ha ocurrido un error al insertar el registro";
               }
               
               
           }else{
           
           $model->getErrors();
           }
        }
        return $this->render("create",['model' => $model, 'msg'=> $msg]);
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

    /**
     * @inheritdoc
     */
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}

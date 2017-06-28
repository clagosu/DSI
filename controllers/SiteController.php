<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\ValidarFormulario;
use app\models\ValidarFormularioAjax;
use yii\widgets\ActiveForm;
use app\models\FormInstitucion;
use app\models\Institucion;
use app\models\FormSearch;
use yii\helpers\Html;
use yii\data\Pagination;
use yii\helpers\Url;
// use yii\web\response;

class SiteController extends Controller
{
    
    
    public function actionUpdate()
    {
        $model = new FormInstitucion;
        $msg = null;
        
        if($model->load(Yii::$app->request->post()))
        {
            if($model->validate())
            {
                $table = Institucion::findOne($model->id_institucion);
                if($table)
                {
                $table -> id_tipo_institucion = $model->id_tipo_institucion;
                $table -> nombre_institucion = $model->nombre_institucion;
                $table -> id_pais = $model->id_pais;
                $table -> vigente = $model->vigente;
                $table -> id_internacional = $model->id_internacional;
                $table -> rut_institucion = $model->rut_institucion;
                $table -> razon_social_institucion = $model->razon_social_institucion;
                $table -> direccion_institucion = $model->direccion_institucion;
                $table -> telefono_institucion = $model->telefono_institucion;
                $table -> email_institucion = $model->email_institucion;
                $table -> link_institucion = $model->link_institucion;
                    if ($table->update())
                    {
                        $msg = "La institucion ha sido actualizada correctamente";
                    }
                    else
                    {
                        $msg = "La institucion no ha podido ser actualizada";
                    }
                }
                else
                {
                    $msg = "La institucion seleccionada no ha sido encontrada";
                }
            }
            else
            {
                $model->getErrors();
            }
        }
        
        
        if (Yii::$app->request->get("id_institucion"))
        {
            $id_institucion = Html::encode($_GET["id_institucion"]);
            if ((int) $id_institucion)
            {
                $table = Institucion::findOne($id_institucion);
                if($table)
                {

                    $model->id_tipo_institucion = $table -> id_tipo_institucion;
                    $model->nombre_institucion = $table -> nombre_institucion;
                    $model->id_institucion = $table -> id_institucion;
                    $model->id_pais = $table -> id_pais;
                    $model->vigente = $table -> vigente;
                    $model->id_internacional = $table -> id_internacional;
                    $model->rut_institucion = $table -> rut_institucion;
                    $model->razon_social_institucion = $table -> razon_social_institucion;
                    $model->direccion_institucion = $table -> direccion_institucion;
                    $model->telefono_institucion = $table -> telefono_institucion;
                    $model->email_institucion = $table -> email_institucion;
                    $model->link_institucion = $table -> link_institucion;
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
            $id_institucion = Html::encode($_POST["id_institucion"]);
            if((int) $id_institucion)
            {
                if(Institucion::deleteAll("id_institucion=:id_institucion", [":id_institucion" => $id_institucion]))
                {
                    echo "Institucion con id $id_institucion eliminado con éxito, redireccionando ...";
                    echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("site/view")."'>";
                }
                else
                {
                    echo "Ha ocurrido un error al eliminar la institucion, redireccionando ...";
                    echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("site/view")."'>"; 
                }
            }
            else
            {
                echo "Ha ocurrido un error al eliminar la institucion, redireccionando ...";
                echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("site/view")."'>";
            }
        }
        else
        {
            return $this->redirect(["site/view"]);
        }
    }
    
    
    
    public function actionView(){
        
        $form = new FormSearch;
        $search = null;
        if($form->load(Yii::$app->request->get()))
        {
            if ($form->validate())
            {
                $search = Html::encode($form->q);
                $table = Institucion::find()
                        ->where(["=", "id_institucion", $search])
                        ->orWhere(["=", "nombre_institucion", $search])
                        ->orWhere(["=", "rut_institucion", $search]);
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
            $table = Institucion::find();
            $count = clone $table;
            $pages = new Pagination([
                "pageSize" => 1,
                "totalCount" => $count->count(),
            ]);
            $model = $table
                    ->offset($pages->offset)
                    ->limit($pages->limit)
                    ->all();
        }
        return $this->render("view", ["model" => $model, "form" => $form, "search" => $search, "pages" => $pages]);
    }
    
    
    
    
    public function actionCreate(){
        $model = new FormInstitucion;
        $msg = null;
        if($model->load(Yii::$app->request->post())){
         
            if($model->validate()){
                $table = new Institucion;
                $table -> id_tipo_institucion = $model->id_tipo_institucion;
                $table -> nombre_institucion = $model->nombre_institucion;
                $table -> id_institucion = $model->id_institucion;
                $table -> id_pais = $model->id_pais;
                $table -> vigente = $model->vigente;
                $table -> id_internacional = $model->id_internacional;
                $table -> rut_institucion = $model->rut_institucion;
                $table -> razon_social_institucion = $model->razon_social_institucion;
                $table -> direccion_institucion = $model->direccion_institucion;
                $table -> telefono_institucion = $model->telefono_institucion;
                $table -> email_institucion = $model->email_institucion;
                $table -> link_institucion = $model->link_institucion;
                if($table->insert()){
                    $msg = "Enhorabuena, registro guardado correctamente";
                    $model->id_tipo_institucion = null;
                    $model->nombre_institucion = null;
                    $model->id_institucion = null;
                    $model->id_pais = null;
                    $model->vigente = null;
                    $model->id_internacional = null;
                    $model->rut_institucion = null;
                    $model->razon_social_institucion = null;
                    $model->direccion_institucion = null;
                    $model->telefono_institucion = null;
                    $model->email_institucion = null;
                    $model->link_institucion = null;
                }else{
                    $msg = "Ha ocurrido un error al insertar el registro";
                }
            }else{
               $model->getErrors(); 
            }
        }
        return $this->render("create",['model' => $model, 'msg' => $msg]);
    }
    
    /**
     * @inheritdoc
     */
    public function actionSaluda($get = "DSI")
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
    
    public function actionFormulario($mensaje = null){
        return $this->render("formulario", ["mensaje" => $mensaje]);
    }
    
    public function actionRequest(){
      $mensaje = null;
      
        if(isset($_REQUEST["nombre"])){
            $mensaje = "Bien, has enviado tu nombre correctamente: ". $_REQUEST["nombre"];
            
        }
        $this->redirect(["site/formulario", "mensaje" => $mensaje]);
                
    }
    
    public function actionValidarformulario(){
        $model = new ValidarFormulario;
        if($model->load(Yii::$app->request->post())){
            
            if($model->validate()){
              //Por ejemplo, consultar en una base de datos  
            }else{
                $model->getErrors();
            }
        }
        return $this->render("validarformulario", ["model" => $model]);
    }
    
    
    public function actionValidarformularioajax(){
        $model = new ValidarFormularioAjax;
        $msg = null;
        
        if($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
            
        }
        if($model->load(Yii::$app->request->post())){
            if ($model->validate()){
                //Por ejemplo, hacer una consulta a una base de datos
                $msg = "Enhorabuena, formulario enviado correctamente";
                $model->nombre = null;
                $model->email = null;
            }else{
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

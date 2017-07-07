<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\ValidarFormulario;
use app\models\ValidarFormularioAjax;
use yii\widgets\ActiveForm;
use yii\web\Response;
use app\models\FormEstadoConvenio;
use app\models\EstadoConvenio;
use app\models\FormSearch;
use yii\helpers\Html;
use yii\data\Pagination;
use yii\helpers\Url;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actionUpdate()
    {
        $model = new FormEstadoConvenio;
        $msg = null;
        
        if($model->load(Yii::$app->request->post()))
        {
            if($model->validate())
            {
                $table = EstadoConvenio::findOne($model->id_estado_convenio);
                if($table)
                {
                    $table->id_estado_convenio = $model->id_estado_convenio;
                    $table->nombre_estado_convenio = $model->nombre_estado_convenio;
                    $table->Descripcion = $model->Descripcion;
                    $table->Vigente = $model->Vigente;
                    if ($table->update())
                    {
                        $msg = "El registro ha sido actualizado correctamente";
                    }
                    else
                    {
                        $msg = "El registro no ha podido ser actualizado";
                    }
                }
                else
                {
                    $msg = "El registro seleccionado no ha sido encontrado";
                }
            }
            else
            {
                $model->getErrors();
            }
        }
        
        
        if (Yii::$app->request->get("id_estado_convenio"))
        {
            $id_estado_convenio = Html::encode($_GET["id_estado_convenio"]);
            if ((int) $id_estado_convenio)
            {
                $table = EstadoConvenio::findOne($id_estado_convenio);
                if($table)
                {
                    $model->id_estado_convenio = $table->id_estado_convenio;
                    $model->nombre_estado_convenio = $table->nombre_estado_convenio;
                    $model->Descripcion = $table->Descripcion;
                    $model->Vigente = $table->Vigente;
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
            $id_estado_convenio = Html::encode($_POST["id_estado_convenio"]);
            if((int) $id_estado_convenio)
            {
                if(EstadoConvenio::deleteAll("id_estado_convenio=:id_estado_convenio", [":id_estado_convenio" => $id_estado_convenio]))
                {
                    echo "Registro con id $id_estado_convenio eliminado con éxito, redireccionando ...";
                    echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("site/view")."'>";
                }
                else
                {
                    echo "Ha ocurrido un error al eliminar el registro, redireccionando ...";
                    echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("site/view")."'>"; 
                }
            }
            else
            {
                echo "Ha ocurrido un error al eliminar el registro, redireccionando ...";
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
                $table = EstadoConvenio::find()
                        ->where(["like", "id_estado_convenio", $search])
                        ->orWhere(["like", "nombre_estado_convenio", $search])
                        ->orWhere(["like", "Descripcion", $search]);
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
            $table = EstadoConvenio::find();
            $count = clone $table;
            $pages = new Pagination([
                "pageSize" => 2,
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
        $model = new FormEstadoConvenio;
        $msg = null;
        if($model->load(Yii::$app->request->post()))
        {
            if($model->validate())
            {
                $table = new EstadoConvenio;
                $table->id_estado_convenio = $model->id_estado_convenio;
                $table->nombre_estado_convenio = $model->nombre_estado_convenio;
                $table->Descripcion = $model->Descripcion;
                $table->Vigente = $model->Vigente;
                if ($table->insert())
                {
                    $msg = "Registro guardado correctamente";
                    $model->id_estado_convenio = null;
                    $model->nombre_estado_convenio = null;
                    $model->Descripcion = null;
                    $model->Vigente = null;
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

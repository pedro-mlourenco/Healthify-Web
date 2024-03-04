<?php

namespace backend\controllers;

use app\models\AuthAssignment;
use common\models\User;
use backend\models\UserCreateForm;
use dominus77\sweetalert2\Alert;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'actions' => ['login', 'error'],
                            'allow' => true,
                        ],
                        [
                            'actions' => ['index', 'view', 'create', 'update', 'delete'],
                            'allow' => true,
                            'roles' => ['admin'],
                        ],
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
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    /**
     * $searchModel = new UserSearch();
     * $dataProvider = $searchModel->search($this->request->queryParams);
     *
     * return $this->render('index', [
     * 'searchModel' => $searchModel,
     * 'dataProvider' => $dataProvider,
     * ]);
     **/

    public function actionIndex()
    {
        $currentUser = Yii::$app->getUser()->identity->getName();

        $query = User::find()->Where(['status' => 10])->andFilterCompare ( 'username', $currentUser, '!=' );

        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count, 'defaultPageSize' => 10]);

        $models = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'filterUsers' => $models,
            'pagination' => $pagination,
        ]);
    }

    /**
     * Displays a single User model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public
    function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public
    function actionCreate()
    {
        $model = new UserCreateForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash(Alert::TYPE_SUCCESS, "Utilizador Criado com Sucesso!\n\n");
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public
    function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $role = $model->getRole($model->id);
        $modelAuth = AuthAssignment::find()->all();

        if ($this->request->isPost && $model->save() && $model->load($this->request->post()) && $model->save()) {

            $redefinedRole = Yii::$app->request->post();

            $auth = Yii::$app->authManager;
            Yii::$app->authManager->revokeAll($model->id);
            $authRole = $auth->getRole($redefinedRole['AuthAssignment']['item_name']);
            $auth->assign($authRole, $model->id);
            Yii::$app->session->setFlash(Alert::TYPE_SUCCESS, "Utilizador Atualizado com Sucesso!\n\n");
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'modelAuth' => $modelAuth,
            'role' => $role,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public
    function actionDelete($id)
    {
        //Yii::$app->authManager->revokeAll($this->findModel($id)->id);
        $model = $this->findModel($id);
        $model->status = \common\models\User::STATUS_DELETED;
        $model->save();
        Yii::$app->session->setFlash(Alert::TYPE_SUCCESS, "Utilizador Apagado com Sucesso!\n\n");
        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected
    function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

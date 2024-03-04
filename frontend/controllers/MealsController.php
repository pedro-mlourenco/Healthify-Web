<?php

namespace frontend\controllers;

use app\models\Meals;
use backend\models\MealsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MealsController implements the CRUD actions for Meals model.
 */
class MealsController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
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
     * Lists all Meals models.
     * @return mixed
     */
    public function actionIndex()
    {
        $meals = Meals::find()->all();

        $mealCount = array (
            array("meat",0),
            array("fish",0),
            array("dessert",0),
            array("drinks",0),
            array("vegan",0),
            array("entree",0),
            array("soup",0)
        );

        foreach ($meals as $meal){
            foreach ($meal as $field){
                switch ($field){
                    case 'meat':
                        $mealCount[0][1]++;
                        break;
                    case 'fish':
                        $mealCount[1][1]++;
                        break;
                    case 'dessert':
                        $mealCount[2][1]++;
                        break;
                    case 'drinks':
                        $mealCount[3][1]++;
                        break;
                    case 'vegan':
                        $mealCount[4][1]++;
                        break;
                    case 'entree':
                        $mealCount[5][1]++;
                        break;
                    case 'soup':
                        $mealCount[6][1]++;
                        break;
                }
            }
        }

        return $this->render('index', [
            'mealCount' => $mealCount
        ]);
    }

    public function actionCategory($meal)
    {
        $searchModel = new MealsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $dataProvider->query->andWhere(['category'=>$meal]);

        return $this->render('category', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'meal' => $meal
        ]);
    }

    /**
     * Displays a single Meals model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Meals model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($category)
    {
        $model = new Meals();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'category' =>$category
        ]);
    }

    /**
     * Updates an existing Meals model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Meals model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Meals model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Meals the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Meals::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

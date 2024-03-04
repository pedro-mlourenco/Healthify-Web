<?php

namespace backend\controllers;

use dominus77\sweetalert2\Alert;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use yii\debug\panels\EventPanel;
use yii\filters\AccessControl;
use yii\helpers\Console;
use yii\web\Controller;
use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use backend\models\Ingredients;
use backend\models\IngredientsSearch;

use app\models\Meals;
use backend\models\MealsSearch;

use backend\models\Mealingredients;
use backend\models\MealingredientsSearch;

class MealplannerController extends Controller
{
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
                            'actions' => ['planner', 'add'],
                            'allow' => true,
                            'roles' => ['admin', 'chef'],
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

    public function actionPlanner($mealid)
    {
        $searchModel = new IngredientsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->pagination = ['pageSize' => 5];


        return $this->render('view', [
            'modelMeal' => Meals::findOne($mealid),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'modelMealIngredients' => Mealingredients::find()->where(['mealsid' => $mealid])->all(),
            'mealid' => $mealid
        ]);
    }

    public function actionAdd($ingredientid, $mealid)
    {
        $ingredient = Ingredients::findOne($ingredientid);//bloco save caso nao haja o ingrediente adicionado
        $addIngredients = Mealingredients::find()->where(['ingredientsid' => $ingredientid])->andWhere(['mealsid' => $mealid])->one();

        if ($addIngredients == null) {
            $newAddIngredients = new Mealingredients();
            $newAddIngredients->serving_size_g = 100;
            $newAddIngredients->total_sugar_g = $ingredient->sugar_g;
            $newAddIngredients->total_calories = $ingredient->calories;
            $newAddIngredients->total_protein_g = $ingredient->protein_g;
            $newAddIngredients->total_carbohydrates_total_g = $ingredient->carbohydrates_total_g;
            $newAddIngredients->total_fat_saturated_g = $ingredient->fat_saturated_g;
            $newAddIngredients->total_fat_total_g = $ingredient->fat_total_g;
            $newAddIngredients->total_fiber_g = $ingredient->fiber_g;
            $newAddIngredients->total_cholesterol_mg = $ingredient->cholesterol_mg;
            $newAddIngredients->mealsid = $mealid;
            $newAddIngredients->ingredientsid = $ingredientid;
            if (!$newAddIngredients->save(false)) {
                Yii::$app->session->setFlash(Alert::TYPE_ERROR, "Erro ao guardar na base de dados!\n\n" . $ingredient->id . " : " . $ingredient->name);
                return $this->redirect(['planner', 'mealid' => $mealid]);
            }
        }//bloco save caso haja o ingrediente adicionado
        else {
            Yii::$app->session->setFlash(Alert::TYPE_WARNING, "Ingrediente já está inserido!\n\n" . $ingredient->id . " : " . $ingredient->name);
            return $this->redirect(['planner', 'mealid' => $mealid]);
        }

        Yii::$app->session->setFlash(Alert::TYPE_SUCCESS, 'Ingrediente Adicionado!');

        return $this->redirect(['planner', 'mealid' => $mealid]);
    }
}
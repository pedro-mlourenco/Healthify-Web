<?php

use dominus77\sweetalert2\Alert;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \backend\models\Ingredients;

/* @var $this yii\web\View */

?>

<?= Alert::widget(['useSessionFlash' => true]) ?>

<div class="mealplaner-view">
    <table class="table">
        <tr>
            <td class="col-lg-7">
                <h4>Ingredientes no prato</h4>
                <div>
                    <table class="fc-widget-header">
                        <tr>
                            <th>Nome</th>
                            <th>Açucares</th>
                            <th>Calorias</th>
                            <th>Proteína</th>
                            <th>Hidratos de carbono</th>
                            <th>Lípidos (saturados)</th>
                            <th>Lípidos</th>
                            <th>Fibra</th>
                            <th>Colesterol (mg)</th>
                            <th class="text-center">Porção (g)</th>
                            <th colspan="2" class="text-center">Action</th>
                        </tr>

                        <?php foreach ($modelMealIngredients as $mealIngredient) { ?>
                            <?php $serving = ActiveForm::begin(['action' => ['mealingredients/update', 'id' => $mealIngredient->id], 'method' => 'post',]); ?>
                            <tr>
                                <td><?= Ingredients::findOne($mealIngredient->ingredientsid)->name ?></td>
                                <td><?= $mealIngredient->total_sugar_g ?></td>
                                <td><?= $mealIngredient->total_calories ?></td>
                                <td><?= $mealIngredient->total_protein_g ?></td>
                                <td><?= $mealIngredient->total_carbohydrates_total_g ?></td>
                                <td><?= $mealIngredient->total_fat_saturated_g ?></td>
                                <td><?= $mealIngredient->total_fat_total_g ?></td>
                                <td><?= $mealIngredient->total_fiber_g ?></td>
                                <td><?= $mealIngredient->total_cholesterol_mg ?></td>
                                <td><?= $serving->field($mealIngredient, 'serving_size_g')->textInput(['maxlength' => true])->label(false) ?></td>
                                <td><?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?></td>
                                <td><?= Html::a('Apagar', ['mealingredients/delete', 'id' => $mealIngredient->id, 'mealsid' => $mealIngredient->mealsid], ['class' => 'btn btn-danger', 'data' => ['method' => 'post',],]) ?></td>
                            </tr>
                            <?php ActiveForm::end(); ?>
                        <?php } ?>
                    </table>
                </div>
            </td>
        </tr>

        <tr>
            <td class="col-lg-3">
                <h4>Ingredientes a adicionar</h4>
            </td>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        'id',
                        'name',
                        'sugar_g',
                        'calories',
                        'protein_g',
                        'carbohydrates_total_g',
                        'fat_saturated_g',
                        'fat_total_g',
                        'fiber_g',
                        'cholesterol_mg',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{add}',
                            'buttons' => [
                                'add' => function ($url, $model) use ($mealid) {
                                    return Html::a('Adicionar', ['mealplanner/add', 'ingredientid' => $model->id, 'mealid' => $mealid], [
                                        'class' => 'btn btn-success',
                                    ]);
                                }
                            ]
                        ],
                    ],
                ]); ?>
        </tr>
    </table>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.pjax/2.0.1/jquery.pjax.min.js"></script>

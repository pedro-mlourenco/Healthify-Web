<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\IngredientsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ingredients-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'sugar_g') ?>

    <?= $form->field($model, 'calories') ?>

    <?= $form->field($model, 'protein_g') ?>

    <?php // echo $form->field($model, 'carbohydrates_total_g') ?>

    <?php // echo $form->field($model, 'fat_saturated_g') ?>

    <?php // echo $form->field($model, 'fat_total_g') ?>

    <?php // echo $form->field($model, 'fiber_g') ?>

    <?php // echo $form->field($model, 'cholesterol_mg') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

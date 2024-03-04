<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SalesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sales-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'salesday') ?>

    <?= $form->field($model, 'precototal') ?>

    <?= $form->field($model, 'discount') ?>

    <?= $form->field($model, 'paidamount') ?>

    <?php // echo $form->field($model, 'paymentmethod') ?>

    <?php // echo $form->field($model, 'paymentstate') ?>

    <?php // echo $form->field($model, 'userprofilesid') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

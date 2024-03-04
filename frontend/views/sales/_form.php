<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Sales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sales-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'salesday')->textInput() ?>

    <?= $form->field($model, 'precototal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'discount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'paidamount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'paymentmethod')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'paymentstate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'userprofilesid')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

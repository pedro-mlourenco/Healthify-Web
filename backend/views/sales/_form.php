<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Sales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sales-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'salesday')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'precototal')->textInput(['disabled' => true]) ?>

    <?= $form->field($model, 'discount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'paidamount')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'paymentmethod')->dropDownList([ 'card' => 'Cartão', 'cash' => 'Dinheiro'], ['prompt' => '']) ?>

    <?= $form->field($model, 'paymentstate')->hiddenInput(['value' => 'paid'])->label(false) ?>

    <?= $form->field($model, 'userprofilesid')->hiddenInput(['value' => $model->userprofilesid])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Pagar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

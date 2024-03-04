<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserprofileSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="userprofile-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nif') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'cellphone') ?>

    <?= $form->field($model, 'street') ?>

    <?php // echo $form->field($model, 'door') ?>

    <?php // echo $form->field($model, 'floor') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'nib') ?>

    <?php // echo $form->field($model, 'userid') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

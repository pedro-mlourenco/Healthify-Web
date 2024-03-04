<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \frontend\models\Userprofile */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Completar Registo';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup','action' => '../controllers/Userprofile/completesignup']); ?>

            <?= $form->field($model, 'name') ?>

            <?= $form->field($model, 'nif') ?>

            <?= $form->field($model, 'cellphone') ?>

            <?= $form->field($model, 'street') ?>

            <?= $form->field($model, 'door') ?>

            <?= $form->field($model, 'floor') ?>

            <?= $form->field($model, 'city') ?>

            <div class="form-group">
                <?= Html::submitButton('Completar registo', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

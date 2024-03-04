<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Userprofile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="container">

    <?php $form = ActiveForm::begin(); ?>

    <div class="main-body">
        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="Admin"
                                 class="rounded-circle" width="150">
                            <div class="mt-3">

                                <p class="text-black mb-1"><?php echo $username?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-sm-9 text-black">
                                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-sm-9 text-black">
                                <?= $form->field($model, 'nif')->textInput() ?>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-sm-9 text-black">
                                 <?= $form->field($model, 'cellphone')->textInput() ?>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-sm-9 text-black">
                                <?= $form->field($model, 'street')->textInput(['maxlength' => true]) ?>

                                <?= $form->field($model, 'door')->textInput() ?>

                                <?= $form->field($model, 'floor')->textInput() ?>

                                <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

                                <?= $form->field($model, 'userid')->hiddenInput(['value'=>$userid])->label(false); ?>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>

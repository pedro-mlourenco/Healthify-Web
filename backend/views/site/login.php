<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

$this->title = 'Backend Login';

?>

<div class="login-box">
    <div class="login-logo" style="margin-top: 120px; margin-bottom: -15px">
        <p style="color:white;"><b style="font-size: 50px">Healthify </b> Dashboard</p>
    </div>

    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>

                    <?php $form = ActiveForm::begin(['id' => 'login-form']) ?>

                    <?= $form->field($model,'username', [
                        'options' => ['class' => 'form-group has-feedback'],
                        'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-envelope"></span></div></div>',
                        'template' => '{beginWrapper}{input}{error}{endWrapper}',
                        'wrapperOptions' => ['class' => 'input-group mb-3']
                    ])
                        ->label(false)
                        ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>
                    <?= $form->field($model, 'password', [
                        'options' => ['class' => 'form-group has-feedback'],
                        'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-lock"></span></div></div>',
                        'template' => '{beginWrapper}{input}{error}{endWrapper}',
                        'wrapperOptions' => ['class' => 'input-group mb-3']
                    ])
                        ->label(false)
                        ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <?= $form->field($model, 'rememberMe')->checkbox() ?>
                        </div>
                    </div>

                    <div class="col-4">
                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block', 'name' => 'signin-button']) ?>
                    </div>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

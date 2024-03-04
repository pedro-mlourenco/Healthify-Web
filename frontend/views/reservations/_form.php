<?php

use app\models\Tables;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;
use yii\bootstrap4;

/* @var $this yii\web\View */
/* @var $model app\models\Reservations */
/* @var $form yii\widgets\ActiveForm */
/* @var $userid */

$tables = Tables::find()->all();
$listTables = ArrayHelper::map($tables, 'id', 'id');
?>

<div class="reservations-form">

    <?php $form = ActiveForm::begin(['enableClientValidation' => ['false']]); ?>

    <?= $form->errorSummary($model) ?>

    <?= $form->field($model, 'reservedday')->widget(DatePicker::classname(), [
        'dateFormat' => 'yyyy-MM-dd',
        'options' => ['class' => 'form-control', 'autocomplete'=>'off',],

        'clientOptions' => [
            'minDate' => 0,
            'autocomplete' => 'off',
        ]
    ]) ?>

    <?= $form->field($model, 'reservedtime')->dropDownList(['almoco' => 'Almoco', 'jantar' => 'Jantar',], ['prompt' => '']) ?>

    <?= $form->field($model, 'userprofilesid')->hiddenInput(['value' => $userid])->label(false) ?>

    <?= $form->field($model, 'tableid')->dropDownList($listTables, ['prompt' => 'Select...']); ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tables */

$this->title = 'Update Tables: ' . $model->id;
?>
<div class="tables-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

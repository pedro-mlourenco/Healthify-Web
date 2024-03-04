<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tables */

$this->title = 'Criar Mesa';
?>
<div class="tables-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Reservations */

$this->title = 'Atualizar Reserva: ' . $model->id;
?>
<div class="reservations-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

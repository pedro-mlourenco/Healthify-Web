<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Reservations */

$this->title = 'Criar Reserva';
?>
<div class="reservations-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

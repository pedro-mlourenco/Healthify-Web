<?php

use dominus77\sweetalert2\Alert;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Reservations */

$this->title = 'Reserva: ' . $model->id;

Alert::widget(['useSessionFlash' => true])

?>
<div class="reservations-view">
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id, 'action' => $action, 'title' => $title], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id, 'action' => $action, 'title' => $title], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem a certeza que deseja apagar esta reserva?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'reservedday',
            'reservedtime',
            'userprofilesid',
            'tableid',
        ],
    ]) ?>

    <p>
        <?= Html::a('Back to index', [$action, 'action' => $action, 'title' => $title], ['class' => 'btn btn-primary']) ?>
    </p>

</div>

<?php

use dominus77\sweetalert2\Alert;
use kartik\grid\GridView;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $searchModel app\models\ReservationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reservas ' . $title;
?>

<?= Alert::widget(['useSessionFlash' => true]) ?>

<div class="reservations-index">

    <p>
        <?= Html::a('Criar Reserva', ['create', 'action' => $action, 'title' => $title], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'reservedday',
            'reservedtime',
            'userprofilesid',
            'tableid',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'delete' => function ($url, $model) use ($action, $title) {
                        return Html::a('<i class="fas fa-trash-alt"></i>', ['delete', 'id' => $model->id, 'action' => $action, 'title' => $title], [
                            'class' => '',
                            'data' => [
                                'confirm' => 'Tem a certeza que deseja remover esta reserva? É impossivel desfazer esta ação.',
                                'method' => 'post',
                            ],
                        ]);
                    },
                    'view' => function ($url, $model) use ($action, $title) {
                        return Html::a('<i class="fas fa-eye"></i>', ['view', 'id' => $model->id, 'action' => $action, 'title' => $title], [
                            'class' => '',
                            'data' => [
                                'method' => 'post',
                            ],
                        ]);
                    },
                    'update' => function ($url, $model) use ($action, $title) {
                        return Html::a('<i class="fas fa-pencil-alt"></i>', ['update', 'id' => $model->id, 'action' => $action, 'title' => $title], [
                            'class' => '',
                            'data' => [
                                'method' => 'post',
                            ],
                        ]);
                    }
                ]
            ],
        ],
    ]); ?>

</div>




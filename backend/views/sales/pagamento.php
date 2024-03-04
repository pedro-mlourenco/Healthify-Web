<?php

use dominus77\sweetalert2\Alert;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SalesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Caixa de Pagamento';
?>

<?= Alert::widget(['useSessionFlash' => true]) ?>

<div class="sales-pagamento">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            //'id',
            'salesday',
            'precototal',
            'discount',
            //'paidamount',
            'paymentmethod',
            'paymentstate',
            'userprofilesid',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('Pagar', ['update', 'id' => $model->id], [
                            'class' => 'btn btn-success',
                        ]);
                    }
                ]
            ],
        ],
    ]);

    ?>

</div>









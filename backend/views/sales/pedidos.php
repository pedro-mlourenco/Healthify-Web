<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SalesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Histórico de Pedidos';
?>
<div class="sales-historico">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'salesday',
            'precototal',
            'discount',
            //'paidamount',
            'paymentmethod',
            'paymentstate',
            'userprofilesid',
        ],
    ]);

    ?>

</div>





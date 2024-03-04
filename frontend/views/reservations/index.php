<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\jui\Tabs;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReservationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $userid */

$this->title = 'Reservas';
?>
<div class="reservations-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <p>
        <?= Html::a('Fazer Reserva', ['create', 'userid' => $userid], ['class' => 'btn btn-success']) ?>
    </p>


    <?php

    echo Tabs::widget([
        'items' => [
            [
                'label' => 'As suas Reservas',
                'url' => ['reservations/activereserves', 'userid' => $userid],
            ],
            [
                'label' => 'Histórico de Reservas',
                'url' => ['reservations/pastreserves', 'userid' => $userid],
            ],
        ],
        'options' => ['tag' => 'div'],
        'itemOptions' => ['tag' => 'div'],
        'headerOptions' => ['class' => 'my-class'],
        'clientOptions' => ['collapsible' => false],
    ]);

    ?>

</div>


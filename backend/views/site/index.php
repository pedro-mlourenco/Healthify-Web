<?php

use miloschuman\highcharts\Highcharts;
use voime\GoogleMaps\Map;
use yii\helpers\Html;

$this->title = 'Zona Administrativa';

?>

<div class="container-fluid">

    <div id="meal-grid">

        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?php echo($numCategorias) ?><sup style="font-size: 20px"></sup></h3>

                <p>Número de Categorias</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <?= Html::a('More Info <i class="fas fa-arrow-circle-right"></i>', ['category/index'], ['data-method' => 'post', 'class' => 'small-box-footer']) ?>
        </div>

        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?php echo($numReservas) ?><sup style="font-size: 20px"></sup></h3>

                <p>Número de Reservas</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <?= Html::a('More Info <i class="fas fa-arrow-circle-right"></i>', ['reservations/activereserves', 'title' => 'Ativas', 'action' => 'activereserves'], ['data-method' => 'post', 'class' => 'small-box-footer']) ?>
        </div>

        <?php
        echo Highcharts::widget([
            'options' => [
                'title' => ['text' => 'Reservas'],
                'chart' => ['type' => 'column'],
                'xAxis' => [
                    'categories' => ['Almoço', 'Jantar']
                ],
                'yAxis' => [
                    'title' => ['text' => 'Número de reservas']
                ],
                'series' => [
                    ['name' => 'Reservas', 'data' => [$reservasContagem[0], $reservasContagem[1]]],
                ],
                'credits' => ['enabled' => false],
            ]
        ]);
        ?>

        <?php
        echo Highcharts::widget([
            'options' => [
                'title' => ['text' => 'Vendas'],
                'chart' => ['type' => 'column'],
                'xAxis' => [
                    'categories' => ['Vendas','Pedidos']
                ],
                'yAxis' => [
                    'title' => ['text' => 'Numero Total']
                ],
                'series' => [
                    ['name' => 'Vendas', 'data' => [$vendasContagem,$pedidosContagem]],
                ],
                'credits' => ['enabled' => false],
            ]
        ]);
        ?>
        <?php
        echo Highcharts::widget([
            'options' => [
                'title' => ['text' => 'Valor de Vendas'],
                'chart' => ['type' => 'column'],
                'xAxis' => [
                    'categories' => ['Vendas']
                ],
                'yAxis' => [
                    'title' => ['text' => 'Valor Total']
                ],
                'series' => [
                    ['name' => 'vendas', 'data' => [$valorVendas]],
                ],
                'credits' => ['enabled' => false],
            ]
        ]);
        ?>


    </div>

</div>
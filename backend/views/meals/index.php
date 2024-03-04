<?php

use app\models\Category;
use hail812\adminlte3\widgets\Alert;
use hail812\adminlte3\widgets\Callout;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MealsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */



$this->title = 'Refeições';


?>

<div>
    <div id="meal-grid">

        <?php foreach ($mealCount as $name => $count/*atribui par chave valor ao array recebido */) { ?>

            <div class="">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?php echo($count); ?><sup style="font-size: 20px"></sup></h3>
                        <p>Total de <?php echo(ucfirst($name)); ?></p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>

                    <?= Html::a('Mais Informação <i class="fas fa-arrow-circle-right"></i>', ['meals/category', 'categoryid' => Category::getCategoriaIDByName($name), 'categoryname' => $name], ['data-method' => 'post', 'class' => 'small-box-footer']) ?>

                </div>
            </div>

        <?php } ?>


    </div>
</div>

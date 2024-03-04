<?php

use app\models\Category;
use dominus77\sweetalert2\Alert;
use kartik\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MealsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = ucfirst($categoryname);
?>

<?= Alert::widget(['useSessionFlash' => true]) ?>

<div class="meals-index">

    <p>
        <?= Html::a('Criar ' . ucfirst($categoryname), ['create', 'categoryid' => $categoryid, 'categoryname' => $categoryname], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'price',
            'description',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<i class="fas fa-trash-alt"></i>', ['delete', 'id' => $model->id, 'categoryid' => $model->categoryid, 'categoryname' => Category::getCategoriaById($model->categoryid)->name], [
                            'class' => '',
                            'data' => [
                                'confirm' => 'Tem a certeza que deseja remover este prato? É impossivel desfazer esta ação.',
                                'method' => 'post',
                            ],
                        ]);
                    }
                ]
            ],
        ],
    ]); ?>


</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Ingredients */

$this->title = $model->name;
\yii\web\YiiAsset::register($this);
?>
<div class="ingredients-view">


    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'sugar_g',
            'calories',
            'protein_g',
            'carbohydrates_total_g',
            'fat_saturated_g',
            'fat_total_g',
            'fiber_g',
            'cholesterol_mg',
        ],
    ]) ?>

    <?= Html::a('Back to Index', ['index'], ['class' => 'btn btn-primary']) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Meals */

$this->title = 'Criar: ' . $categoryname;

?>
<div class="meals-create">

    <?= $this->render('_form', [
        'model' => $model,
        'categoryid' => $categoryid
    ]) ?>

</div>

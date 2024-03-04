<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ingredients */

$this->title = 'Update Ingredients: ' . $model->name;

?>
<div class="ingredients-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

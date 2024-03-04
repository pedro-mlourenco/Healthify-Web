<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ingredients */

$this->title = 'Criar Ingrediente';
?>
<div class="ingredients-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

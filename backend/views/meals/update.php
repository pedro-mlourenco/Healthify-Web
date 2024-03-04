<?php

use app\models\Category;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Meals */

//ID da categoria do prato
$categoryid = $model->categoryid;

//Nome da categoria com o ID
$categoryname = Category::getCategoriaById($categoryid)->name;

$this->title = 'Atualizar: ' . $model->name;
?>
<div class="meals-update">

    <?= $this->render('update_form', [
        'model' => $model,
    ]) ?>

</div>
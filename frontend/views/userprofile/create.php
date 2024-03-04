<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Userprofile */
//* @var $userid app\models\Userprofile */

$this->title = 'Complete a inscrição';
?>
<div class="userprofile-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'userid' => $userid,
        'username'=>$username,
    ]) ?>

</div>

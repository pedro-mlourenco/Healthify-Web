<?php

use app\models\Reviews;
use frontend\models\Userprofile;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReviewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $reviews */
/* @var $pagination */


$this->title = 'Reviews';
?>
<div class="reviews-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php foreach ($reviews as $review) { ?>
        <div class="card">
            <div class="container">
                <h4><b><?= Userprofile::getNameWithID($review->userprofilesid) ?></b></h4>
                <p><?= Reviews::stars($review->rating) ?></p>
                <p><?= $review->review ?></p>
            </div>
        </div>
        <br>
    <?php } ?>

    <?php
    // display pagination
    echo LinkPager::widget([
        'pagination' => $pagination,
    ]);
    ?>

</div>

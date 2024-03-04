<?php

use app\models\Meals;
use backend\models\Ingredients;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */

$this->title = 'Preparação de pedidos';

?>
<div class="mealprep-index" style="overflow: auto; width: auto">

    <?php
    if ($mealsToPrep == null) { ?>
        <div>
            <h3>Sem novos pedidos</h3>
        </div>
    <?php } else { ?>

        <?php foreach ($tables as $table) { ?>

            <div class="column" style="width: auto; margin-right: 50px">

                <h1> Mesa <?= $table->id; ?></h1>
                <?php foreach ($mealsToPrep as $prep) { ?>
                    <?php if ($prep->mesa == $table->id) { ?>

                        <div class="row">
                            <div class="card" style="width: 200px">
                                <h4><b><?= Meals::nameByID($prep->mealid) ?></b></h4>

                                <button type="button" class="collapsible">Ingredientes</button>
                                <div class="ingredients">
                                    <?php foreach ($mealIngredients as $mealIngredient) { ?>
                                        <?php if ($prep->mealid == $mealIngredient->mealsid) { ?>

                                            <?= Ingredients::nameByID($mealIngredient->ingredientsid) ?><br>

                                        <?php }
                                    } ?>
                                </div>

                                <br>

                                <?php if ($prep->state == 'waiting') { ?>
                                    <?= Html::a('Em Preparação', ['preparing', 'mealId' => $prep->id], ['class' => 'btn btn-danger']) ?>
                                <?php } else { ?>
                                    <?= Html::a('A Sair', ['deliver', 'mealId' => $prep->id], ['class' => 'btn btn-success']) ?>
                                <?php } ?>

                            </div>
                        </div>
                    <?php }
                } ?>
            </div>
        <?php } ?>
    <?php } ?>

    <?php foreach ($takeawayids as $id) { ?>

            <div class="column" style="width: auto; margin-right: 50px">

                <h1> Takeaway <?= $id; ?></h1>
                <?php foreach ($mealsToPrep as $prep) { ?>
                    <?php if ($prep->salesid == $id) { ?>

                        <div class="row">
                            <div class="card" style="width: 200px">
                                <h4><b><?= Meals::nameByID($prep->mealid) ?></b></h4>

                                <button type="button" class="collapsible">Ingredientes</button>
                                <div class="ingredients">
                                    <?php foreach ($mealIngredients as $mealIngredient) { ?>
                                        <?php if ($prep->mealid == $mealIngredient->mealsid) { ?>

                                            <?= Ingredients::nameByID($mealIngredient->ingredientsid) ?><br>

                                        <?php }
                                    } ?>
                                </div>

                                <br>

                                <?php if ($prep->state == 'waiting') { ?>
                                    <?= Html::a('Em Preparação', ['preparing', 'mealId' => $prep->id], ['class' => 'btn btn-danger']) ?>
                                <?php } else { ?>
                                    <?= Html::a('A Sair', ['deliver', 'mealId' => $prep->id], ['class' => 'btn btn-success']) ?>
                                <?php } ?>

                            </div>
                        </div>
                    <?php }
                } ?>
            </div>
        <?php } ?>




</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.pjax/2.0.1/jquery.pjax.min.js"></script>
<script src="../js/customJs.js"></script>
<script src="../js/mealprep.js"></script>

<script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>

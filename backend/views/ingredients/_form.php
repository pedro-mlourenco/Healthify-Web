<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Ingredients */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="column" style="width: auto">

    <h3>Pesquisa de Ingredientes</h3>

    <table>
        <tr>
            <td><form>
                    <label for="idPesquisa"></label><input type="text" name="Pesquisa" id="idPesquisa" placeholder="Pesquisa..">
                </form></td>
            <td><button id="idBtSearch" onclick="pesquisa();"><i class="fas fa-arrow-circle-right"></i></button></td>
        </tr>
    </table>

    <div class="column" style="width: auto">

        <?php $form = ActiveForm::begin(); ?>

        <table class="table" id="tableIngredients">
            <thead>
            <tr>
                <th colspan="2"><?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><?= $form->field($model, 'sugar_g')->textInput() ?></td>
                <td><?= $form->field($model, 'calories')->textInput() ?></td>
            </tr>
            <tr>
                <td><?= $form->field($model, 'protein_g')->textInput() ?></td>
                <td><?= $form->field($model, 'carbohydrates_total_g')->textInput() ?></td>
            </tr>
            <tr>
                <td><?= $form->field($model, 'fat_saturated_g')->textInput() ?></td>
                <td><?= $form->field($model, 'fat_total_g')->textInput() ?></td>
            </tr>
            <tr>
                <td><?= $form->field($model, 'fiber_g')->textInput() ?></td>
                <td><?= $form->field($model, 'cholesterol_mg')->textInput() ?></td>
            </tr>
            </tbody>
        </table>

        <div class="form-group">
            <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.pjax/2.0.1/jquery.pjax.min.js"></script>
<script type="text/javascript" src="../../web/js/customJs.js"></script>
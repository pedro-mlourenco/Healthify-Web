<?php

use dominus77\sweetalert2\Alert;
use yii\bootstrap4\LinkPager;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Utilizadores';
?>

<?= Alert::widget(['useSessionFlash' => true]) ?>

<div class="user-index">

    <p>
        <?= Html::a('Criar Utilizador', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <table class="table">
        <thead>
        <th><h3>Id</h3></th>
        <th><h3>Name</h3></th>
        <th><h3>Role</h3></th>
        <th><h3>Operações</h3></th>
        </thead>
        <?php foreach ($filterUsers as $user) { ?>
            <tr>

                <td><?= $user->id ?></td>
                <td><?= $user->username ?></td>
                <td><?= $user->getRole($user->id)->item_name ?></td>

                <td>
                    <?= Html::a('Editar Utilizador', ['update', 'id' => $user->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Apagar', ['delete', 'id' => $user->id], ['class' => 'btn btn-danger', 'data' => [
                        'confirm' => 'Tem a certeza que deseja apagar este utilizador: ' . $user->username . ' ?',
                        'method' => 'post',
                    ],]) ?>
                </td>
            </tr>
        <?php } ?>
    </table>

    <?php
    // display pagination
    echo LinkPager::widget([
        'pagination' => $pagination,
    ]);
    ?>


</div>

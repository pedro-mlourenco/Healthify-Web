<?php

use app\models\Category;
use yii\bootstrap4;
use yii\helpers\URL;
use yii\helpers\Html;
use yii\widgets\Menu;

$categories = Category::getCategorias();

?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= Url::home() ?>" class="brand-link">
        <img src="<?= $assetDir ?>/img/AdminLTELogo.png" alt="Healthify Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
        <span class="brand-text font-weight-light">Healthify</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <table style="width: 100%" align="center">
                <tr>
                    <td rowspan="2" align="center"><img src="<?= $assetDir ?>/img/user8-128x128.jpg"
                                                        class="img-circle elevation-2" alt="User Image" width="120px"
                                                        height="120px"></td>
                    <td><a href="#" class="d-block"><?= Yii::$app->getUser()->identity->getName() ?></td>
                </tr>
                <tr>
                    <td><?= Html::a('Sign out ', ['site/logout'], ['data-method' => 'post', 'class' => 'nav-icon']) ?></td>
                </tr>
            </table>
        </div>

        <!-- Sidebar Menu -->

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <?= HTML::a('Gestor de Utilizadores', ['user/index'], ['data-method' => 'post', 'class' => 'nav-link']) ?>
                </li>

                <li class="nav-item">
                    <?= HTML::a('Críticas', ['reviews/index'], ['data-method' => 'post', 'class' => 'nav-link']) ?>
                </li>

                <li class="nav-item">
                    <?= Html::a('Lista de Ingredientes', ['ingredients/index'], ['data-method' => 'post', 'class' => 'nav-link']) ?>
                </li>

                <li class="nav-item">
                    <?= Html::a('Mesas', ['tables/index'], ['data-method' => 'post', 'class' => 'nav-link']) ?>
                </li>

                <li class="nav-item">
                    <button class="dropdown-btn nav-link"><?= Html::a('Gerir Reservas', [''], ['data-method' => 'post']) ?>
                        <i id="dropdownCaret" class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-container">
                        <?= Html::a('Ativas', ['reservations/activereserves', 'title' => 'Ativas', 'action' => 'activereserves'], ['data-method' => 'post', 'class' => 'nav-link']) ?>
                        <?= Html::a('Futuras', ['reservations/futurereserves', 'title' => 'Futuras', 'action' => 'futurereserves'], ['data-method' => 'post', 'class' => 'nav-link']) ?>
                        <?= Html::a('Histórico', ['reservations/pastreserves', 'title' => 'Histórico', 'action' => 'pastreserves'], ['data-method' => 'post', 'class' => 'nav-link']) ?>
                    </div>
                </li>

                <li class="nav-item">
                    <?= Html::a('Histórico de Pedidos', ['sales/historico'], ['data-method' => 'post', 'class' => 'nav-link']) ?>
                </li>

                <li class="nav-item">
                    <?= Html::a('Caixa de Pagamento', ['sales/pagamento'], ['data-method' => 'post', 'class' => 'nav-link']) ?>
                </li>

                <li class="nav-item">
                    <button class="dropdown-btn nav-link"><?= Html::a('Gerir Ementa', ['meals/index'], ['data-method' => 'post']) ?>
                        <i id="dropdownCaret" class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-container">

                        <?= Html::a('Gerir Categorias', ['category/index'], ['data-method' => 'post', 'class' => 'nav-link']) ?>

                        <?php foreach ($categories as $category) {
                            echo(Html::a(ucfirst($category["name"]), ['meals/category', 'categoryid' => $category["id"], 'categoryname' => $category["name"]], ['data-method' => 'post', 'class' => 'nav-link']));
                        } ?>
                    </div>
                </li>

                <li class="nav-item">
                    <?= Html::a('Zona de preparação', ['mealprep/index'], ['data-method' => 'post', 'class' => 'nav-link']) ?>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
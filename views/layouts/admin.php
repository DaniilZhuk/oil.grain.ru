<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use app\models\User;

AppAsset::register($this);
?>
<?php
  $userId = Yii::$app->user->getId();
  $user= User::find()->where(['id'=>$userId])->one();
  $userIsadmin = $user->is_admin;
  if ($userIsadmin == 1 or $userIsadmin == 2){

  } else {
     
  }
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?=Yii::$app->user->identity->fio ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg_header fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
           // ['label' => 'Home', 'url' => ['/admin']],
            ['label' => 'Личный кабинет', 'url' => ['/admin/user']],
            ['label' => 'Заявки', 'url' => ['/admin/bid']],
            
            ['label' => 'Отклики', 'url' => ['/admin/response']],
            ($userIsadmin == 1 or $userIsadmin == 2) ? (
                ['label' => 'Заявки на доп. согл-ия', 'url' => ['/admin/ck']]
            ) : ( 
                ''
            ) ,
          
            ($userIsadmin == 1 or $userIsadmin == 2) ? (
                ['label' => 'Архивы', 'items' => [
                    ['label' => 'Архив заявок', 'url' => ['/admin/archive']],
                    ['label' => 'Архив откликов', 'url' => ['/admin/archiveresponse']],
                    ['label' => 'Архив доп. соглашений', 'url' => ['/admin/archiveck']],
                ]]
            ) : ( 
                ''
            ) ,
           
            Yii::$app->user->isGuest ? (
                ['label' => 'Вход', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
                . Html::submitButton(
                    'Выйти <br>(' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0 mt-50">
    <div class="container">
        <!-- <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?> -->
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-left">Аукцион &copy; Юг Руси <?= date('Y') ?></p>
        <!-- <p class="float-right"><?= Yii::powered() ?></p> -->
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

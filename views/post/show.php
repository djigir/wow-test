<?php

/* @var $this yii\web\View */

use yii\helpers\Url;


$this->title = $post->title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-show">
    <h1><?= $post->title ?></h1>

    <p><?=$post->description?></p>

    <p>Автор: <b><?= $post->getAuthor()->asArray()->one()['username']; ?></b></p>

    <p>Дата создания: <?=$post->create_at?></p>

    <a href="<?=Url::toRoute('site/index')?>" class="btn btn-primary">Вернуться назад</a>
    <?php
        $edit = Url::toRoute(['post/edit', 'id' => $post->id]);
        $delete = Url::toRoute(['post/delete', 'id' => $post->id]);

        if (Yii::$app->user->identity != null && $post->isUserPost($post->id, Yii::$app->user->identity->id)){
            echo "<a href='{$edit}' class='btn btn-warning'>Редактировать</a>";
            echo "<a href='{$delete}' class='delete-btn btn btn-danger'>Удалить</a>";
        }
    ?>
</div>


<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\widgets\LinkPager;
use \yii\widgets\ActiveForm;


$this->title = 'Главная';
?>
<div class="site-index">

    <div class="jumbotron">
        <!-- if user is guest hide create button -->
        <?php
        $route = Url::toRoute(['post/edit', 'id' => 'create']);
        if (!Yii::$app->user->isGuest):
            echo "<a href={$route} class='btn btn-success'>Create At</a>";
        endif;
        ?>
    </div>

    <!-- success msg -->
    <?php
        if (Yii::$app->session->hasFlash('success')) {
            echo Yii::$app->session->hasFlash('success');
        }
    ?>


    <?php if (Yii::$app->user->isGuest) { ?>
        <h3 class="sign-headline">Авторизация</h3>
        <!-- if user is auth hide login form -->
        <?php
        $form = ActiveForm::begin(['class' => 'form-horizontal']);

        echo $form->field($model, 'username')->textInput(['autofocus' => true]);
        echo $form->field($model, 'password')->passwordInput();
        ?>

        <div class="auth-form">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>

        <?php
        ActiveForm::end();
    }
    ?>

    <div class="body-content">

        <h1 class="post-headline">Список статей</h1>

        <div class="row">
            <?php foreach ($posts as $post): ?>
                <div class='col-lg-4'>
                    <h2><a href="<?= Url::toRoute(['post/show', 'id' => $post->id]) ?>"><?= $post->title ?></a></h2>
                    <p><?= $post->description ?></p>
                    <!-- author name get by relation -->
                    <p class='author-name'>Автор: <b><?= $post->getAuthor()->asArray()->one()['username']; ?></b></p>
                    <span>Дата: <?= $post->create_at ?></span>
                    <br>
                    <?php
                    /* show delete and edit buttons if user_id == author_id in post */
                    $edit = Url::toRoute(['post/edit', 'id' => $post->id]);
                    $delete = Url::toRoute(['post/delete', 'id' => $post->id]);
                    if (Yii::$app->user->identity != null && $post->author_id == Yii::$app->user->identity->id) {
                        echo "<a href='{$edit}' class='btn btn-warning'>Редактировать</a>";
                        echo "<a href='{$delete}' class='btn btn-danger'>Удалить</a>";
                    }
                    ?>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</div>

<?php

// display pagination
echo LinkPager::widget([
    'pagination' => $pagination,
]);

?>

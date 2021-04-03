<?php
    if ($post == 'create'){
        $title = 'Создание новой статьи';
        $btn_text = 'Создать запись';
    }else{
        $title = 'Редактирование ' . $post->title;
        $btn_text = 'Редактировать';
    }
?>

<h2><?= $title ?></h2>

<?php

use \yii\widgets\ActiveForm;


$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
$form = ActiveForm::begin(['class' => 'form-horizontal']);
?>

<?= $form->field($model, 'title')->textInput(['required' => true, 'value' => $post != 'create' ? $post->title : '']) ?>

<?= $form->field($model, 'description')->textarea(['required' => true, 'value' => $post != 'create' ? $post->description : '']) ?>


<div class="form">
    <button type="submit" class="btn btn-success"><?=$btn_text?></button>
    <a href="<?=\yii\helpers\Url::toRoute('site/index')?>" class="btn btn-primary">На главную</a>
</div>

<?php
ActiveForm::end();
?>

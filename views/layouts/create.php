<h2>Создание новой статьи</h2>

<?php

use \yii\widgets\ActiveForm;

$this->title = 'Создание новой статьи';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
$form = ActiveForm::begin(['class' => 'form-horizontal']);
?>

<?= $form->field($model, 'title')->textInput(['autofocus' => true, 'required' => true]) ?>

<?= $form->field($model, 'description')->textarea(['required' => true]) ?>


<div class="form">
    <button type="submit" class="btn btn-success">Submit</button>
</div>

<?php
ActiveForm::end();
?>

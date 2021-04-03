<h2>asdasdasd</h2>

<?php
    use \yii\widgets\ActiveForm;
?>

<?php
    $form = ActiveForm::begin(['class' => 'form-horizontal']);
?>

<?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

<?= $form->field($model, 'password')->passwordInput() ?>

<div class="auth-form">
    <button type="submit">Submit</button>
</div>

<?php
    ActiveForm::end();
?>

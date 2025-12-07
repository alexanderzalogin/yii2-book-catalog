<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\LoginForm $model */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Вход';
?>
<h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Имя пользователя') ?>

<?= $form->field($model, 'password')->passwordInput()->label('Пароль') ?>

<?= $form->field($model, 'rememberMe')->checkbox()->label('Запомнить меня') ?>

<div class="form-group">
    <?= Html::submitButton('Войти', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>

<p>
    <?= Html::a('Регистрация', ['site/signup']) ?>
</p>

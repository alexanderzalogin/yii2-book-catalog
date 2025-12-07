<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\LoginForm $model */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Регистрация';
?>
<h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'username')->textInput()->label('Имя пользователя') ?>

<?= $form->field($model, 'email')->input('email')->label('E-mail') ?>

<?= $form->field($model, 'password')->passwordInput()->label('Пароль') ?>

<div class="form-group">
    <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>

<p>
    <?= Html::a('Войти', ['site/login']) ?>
</p>

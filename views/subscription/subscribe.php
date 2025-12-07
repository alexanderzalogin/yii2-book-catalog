<?php

/** @var app\models\Author $author */
/** @var app\models\Subscription $model */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Подписка на ' . Html::encode($author->full_name);
?>
<h1><?= Html::encode($this->title) ?></h1>

<p>Вы подписываетесь на уведомления о новых книгах автора: <strong><?= Html::encode($author->full_name) ?></strong></p>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'email')->input('email') ?>

<div class="form-group">
    <?= Html::submitButton('Подписаться', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>

<?= Html::a('Назад', ['/author/view', 'id' => $author->id], ['class' => 'btn btn-default']) ?>

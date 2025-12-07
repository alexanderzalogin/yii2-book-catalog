<?php

/** @var app\models\Book $model */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Добавить книгу';
?>
<h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<?= $form->field($model, 'title')->textInput() ?>

<?= $form->field($model, 'year')->textInput() ?>

<?= $form->field($model, 'isbn')->textInput() ?>

<?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

<?= $form->field($model, 'cover_image')->fileInput() ?>
<p class="text-muted">Допустимо: JPG, PNG, GIF (до 1МБ)</p>

<div class="form-group">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>

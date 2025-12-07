<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Book;
use app\models\Author;

/* @var $this yii\web\View */
/* @var $model app\models\BookAuthor */

$this->title = 'Добавить привязку книги к автору';
?>

<h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'book_id')->dropDownList(
    Book::find()->select(['title', 'id'])->indexBy('id')->column(),
    ['prompt' => 'Выберите книгу']
) ?>

<?= $form->field($model, 'author_id')->dropDownList(
    Author::find()->select(['full_name', 'id'])->indexBy('id')->column(),
    ['prompt' => 'Выберите автора']
) ?>

<div class="form-group">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>

<?= Html::a('Назад к списку', ['index'], ['class' => 'btn btn-secondary']) ?>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Book */
$this->title = 'Обновление книги: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Книги', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновление';
?>
<div class="book-update">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'year')->textInput(['type' => 'number', 'min' => 1000, 'max' => date('Y') + 1]) ?>

    <?= $form->field($model, 'isbn')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <label>Текущая обложка</label>
        <?php if ($model->cover_image): ?>
            <div>
                <img src="/uploads/<?= $model->cover_image ?>" alt="<?= $model->title ?>" style="max-width: 200px; max-height: 200px;">
            </div>
        <?php else: ?>
            <p>Обложка не загружена</p>
        <?php endif; ?>
    </div>

    <?= $form->field($model, 'cover_image')->fileInput()->label('Загрузить новую обложку') ?>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Отмена', ['view', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

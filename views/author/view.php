<?php

/** @var app\models\Author $model */

use yii\helpers\Html;

$this->title = $model->full_name;
?>
<h1><?= Html::encode($this->title) ?></h1>

<h3>Книги автора:</h3>
<ul>
    <?php foreach ($model->books as $book): ?>
        <li><?= Html::a($book->title, ['/book/view', 'id' => $book->id]) ?> (<?= $book->year ?>)</li>
    <?php endforeach; ?>
</ul>

<p>
    <?= Html::a('Подписаться', ['/subscription/subscribe', 'authorId' => $model->id], ['class' => 'btn btn-info']) ?>
    <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'Вы уверены, что хотите удалить этого автора?',
            'method' => 'post',
        ],
    ]) ?>
</p>

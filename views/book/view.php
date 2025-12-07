<?php

/** @var app\models\Book $model */

use yii\helpers\Html;

$this->title = $model->title;
?>
<h1><?= Html::encode($this->title) ?></h1>

<p><strong>Год:</strong> <?= $model->year ?></p>
<p><strong>ISBN:</strong> <?= $model->isbn ?></p>
<p><strong>Описание:</strong><br><?= nl2br(Html::encode($model->description)) ?></p>

<?php if ($model->cover_image): ?>
    <p>
        <img src="/uploads/<?= $model->cover_image ?>" alt="<?= $model->title ?>" style="max-width: 300px;">
    </p>
<?php endif; ?>

<h3>Авторы:</h3>
<ul>
<?php foreach ($model->authors as $author): ?>
    <li><?= Html::a($author->full_name, ['/author/view', 'id' => $author->id]) ?></li>
<?php endforeach; ?>
</ul>

<p>
    <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'Вы уверены, что хотите удалить эту книгу?',
            'method' => 'post',
        ],
    ]) ?>
</p>

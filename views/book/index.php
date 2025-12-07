<?php

/** @var app\models\Book $books */

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Книги';
?>
<h1><?= Html::encode($this->title) ?></h1>

<p>
    <?= Html::a('Добавить книгу', ['create'], ['class' => 'btn btn-success']) ?>
</p>

<ul>
    <?php foreach ($books as $book): ?>
        <li>
            <?= Html::a(Html::encode($book->title), ['view', 'id' => $book->id]) ?>
            (<?= $book->year ?>)
        </li>
    <?php endforeach; ?>
</ul>

<?php

/** @var app\models\Author $authors */

use yii\helpers\Html;

$this->title = 'Авторы';
?>
<h1><?= Html::encode($this->title) ?></h1>

<p>
    <?= Html::a('Добавить автора', ['create'], ['class' => 'btn btn-success']) ?>
</p>

<ul>
    <?php foreach ($authors as $author): ?>
        <li>
            <?= Html::a(Html::encode($author->full_name), ['view', 'id' => $author->id]) ?>
        </li>
    <?php endforeach; ?>
</ul>

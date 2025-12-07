<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $models app\models\BookAuthor[] */

$this->title = 'Привязки книг к авторам';
?>

<h1><?= Html::encode($this->title) ?></h1>

<?= Html::a('Добавить привязку', ['create'], ['class' => 'btn btn-success mb-3']) ?>

<?= GridView::widget([
    'dataProvider' => new \yii\data\ArrayDataProvider([
        'allModels' => $models,
        'pagination' => ['pageSize' => 20],
        'sort' => [
            'attributes' => ['book.title', 'author.full_name'],
        ],
    ]),
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        [
            'attribute' => 'book_id',
            'value' => function ($model) {
                return $model->book ? Html::encode($model->book->title) : '—';
            },
            'label' => 'Книга',
        ],
        [
            'attribute' => 'author_id',
            'value' => function ($model) {
                return $model->author ? Html::encode($model->author->full_name) : '—';
            },
            'label' => 'Автор',
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{delete}',
            'buttons' => [
                'delete' => function ($url, $model) {
                    return Html::a(
                        '<i class="bi bi-trash"></i>',
                        ['delete', 'book_id' => $model->book_id, 'author_id' => $model->author_id],
                        [
                            'title' => 'Удалить',
                            'data-confirm' => 'Вы уверены?',
                            'data-method' => 'post',
                        ]
                    );
                },
            ],
        ],
    ],
]); ?>

<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
?>
<div class="site-index">
    <div class="jumbotron">
        <h1><?= Html::encode($this->title) ?></h1>
        <p class="lead">Добро пожаловать в систему управления книжным каталогом.</p>
    </div>

    <div class="body-content">
        <div class="row">
            <div class="col-lg-4">
                <h2>Книги</h2>
                <p>Управляйте списком книг: добавляйте новые, редактируйте существующие, просматривайте подробную информацию.</p>
                <p><?= Html::a('Перейти к книгам', ['/book/index'], ['class' => 'btn btn-primary']) ?></p>
            </div>
            <div class="col-lg-4">
                <h2>Авторы</h2>
                <p>Ведите каталог авторов, связывайте их с книгами, просматривайте список произведений каждого автора.</p>
                <p><?= Html::a('Перейти к авторам', ['/author/index'], ['class' => 'btn btn-primary']) ?></p>
            </div>
            <div class="col-lg-4">
                <h2>Привязать книгу к автору</h2>
                <p><?= Html::a('Перейти к привязке', ['/book-author/index'], ['class' => 'btn btn-primary']) ?></p>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-lg-6">
                <h3>Последние добавленные книги</h3>
                <?php if (!empty($latestBooks)): ?>
                    <ul>
                        <?php foreach ($latestBooks as $book): ?>
                            <li>
                                <?= Html::a(
                                    Html::encode($book->title) . ' (' . $book->year . ')',
                                    ['/book/view', 'id' => $book->id]
                                ) ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>Пока нет добавленных книг.</p>
                <?php endif; ?>
            </div>

            <div class="col-lg-6">
                <h3>Популярные авторы</h3>
                <?= Html::a('Перейти к авторам', ['/report/top-authors'], ['class' => 'btn btn-primary']) ?>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-lg-12">
                <h3>Что можно сделать?</h3>
                <ul>
                    <li>Добавить новую книгу в каталог</li>
                    <li>Зарегистрировать нового автора</li>
                    <li>Связать книги с авторами</li>
                    <li>Подписаться на уведомления о новых книгах</li>
                    <li>Искать популярных авторов за указанный год</li>
                </ul>
            </div>
        </div>
    </div>
</div>

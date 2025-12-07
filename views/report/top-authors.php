<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $topAuthors array */
/* @var $year int */
/* @var $totalAuthors int */

$this->title = "Топ‑10 авторов за $year год";
?>

<h1><?= Html::encode($this->title) ?></h1>

<!-- Форма для выбора года -->
<form method="get" action="<?= Url::to(['/report/top-authors']) ?>">
    <label for="year">Показать за год:</label>
    <input
            type="number"
            id="year"
            name="year"
            value="<?= $year ?>"
            min="1900"
            max="<?= (int)date('Y') + 1 ?>"
            style="width: 120px; margin-right: 10px;"
    >
    <button type="submit" class="btn btn-primary">Показать</button>
</form>

<hr>

<!-- Результаты -->
<?php if (empty($topAuthors)): ?>
    <p>За <?= $year ?> год нет данных о выпущенных книгах.</p>
<?php else: ?>
    <p><strong>Найдено авторов:</strong> <?= $totalAuthors ?></p>

    <table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse;">
        <thead>
        <tr style="background-color: #f0f0f0;">
            <th style="width: 50px;">№</th>
            <th>Автор</th>
            <th style="text-align: right;">Книг за год</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($topAuthors as $index => $author): ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td>
                    <?= Html::a(
                        Html::encode($author['full_name']),
                        ['/author/view', 'id' => $author['id']]
                    ) ?>
                </td>
                <td style="text-align: right; font-weight: bold;">
                    <?= $author['book_count'] ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

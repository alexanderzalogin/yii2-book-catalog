<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\helpers\Html;

class Author extends ActiveRecord
{
    public static function tableName() { return '{{%author}}'; }

    public function rules() {
        return [
            [['full_name'], 'required'],
            [['full_name'], 'string', 'max' => 255],
            [['full_name'], 'filter', 'filter' => function ($v) { return Html::encode($v); }],
        ];
    }

    public function attributeLabels() {
        return ['id' => 'ID', 'full_name' => 'ФИО автора'];
    }

    public function getBooks() {
        return $this->hasMany(Book::class, ['id' => 'book_id'])
            ->viaTable('{{%bookauthor}}', ['author_id' => 'id']);
    }

    /**
     * Возвращает топ‑10 авторов по количеству книг за указанный год.
     * Использует ActiveRecord для безопасной работы с БД.
     *
     * @param int $year Год (например, 2025)
     * @return array Массив авторов с количеством книг за год
     */
    public static function getTopAuthorsByYear($year)
    {
        $year = (int)$year;

        // 2. Формируем запрос
        $query = (new \yii\db\Query())
            ->select([
                'author.id',
                'author.full_name',
                'book_count' => 'COUNT(DISTINCT book.id)'
            ])
            ->from('{{%author}} author')
            ->innerJoin('{{%bookauthor}} ba', 'ba.author_id = author.id')
            ->innerJoin('{{%book}} book', 'book.id = ba.book_id')
            // Универсальное условие для года (работает в MySQL, PostgreSQL, SQLite)
            ->where([
                'AND',
                ['>=', 'book.year', "$year-01-01"],
                ['<', 'book.year', ($year + 1) . '-01-01']
            ])
            ->groupBy(['author.id', 'author.full_name'])
            ->having(['>', 'COUNT(DISTINCT book.id)', 0])
            ->orderBy([
                'book_count' => SORT_DESC,
                'author.full_name' => SORT_ASC
            ])
            ->limit(10);

        // 3. Отладка: выводим SQL и параметры
        $command = $query->createCommand();
        \Yii::info("SQL: " . $command->sql, 'author-top-sql');
        \Yii::info("Params: " . json_encode($command->params), 'author-top-params');

        // 4. Выполняем и возвращаем результат
        $result = $command->queryAll();

        \Yii::info("Found " . count($result) . " authors for year $year", 'author-top');

        return $result;
    }

}

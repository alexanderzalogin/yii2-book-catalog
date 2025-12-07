<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\helpers\Html;
use yii\web\UploadedFile;

class Book extends ActiveRecord
{

    public static function tableName()
    {
        return '{{%book}}';
    }

    public function rules()
    {
        return [
            [['title', 'year'], 'required'],
            ['title', 'string', 'max' => 255],
            ['year', 'integer', 'min' => 1000, 'max' => date('Y') + 1],
            ['isbn', 'string', 'max' => 20, 'skipOnEmpty' => true],
            ['description', 'string'],

            // Валидация изображения
            ['cover_image', 'file',
                'extensions' => 'jpg, png, gif',
                'maxSize' => 1024 * 1024, // 1 МБ
            ],

            // Санитация полей
            [['title', 'description', 'isbn'], 'filter',
                'filter' => function ($value) {
                    return $value ? Html::encode($value) : null;
                }
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название книги',
            'year' => 'Год издания',
            'description' => 'Описание',
            'isbn' => 'ISBN',
            'cover_image' => 'Обложка',
            'image' => 'Загрузить обложку',
        ];
    }

    public function getAuthors()
    {
        return $this->hasMany(Author::class, ['id' => 'author_id'])
            ->viaTable('{{%bookauthor}}', ['book_id' => 'id']);
    }
}

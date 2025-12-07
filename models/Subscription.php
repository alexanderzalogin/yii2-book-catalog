<?php

namespace app\models;

use yii\db\ActiveRecord;

class Subscription extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%subscription}}';
    }

    public function rules()
    {
        return [
            [['author_id', 'email'], 'required'],
            ['author_id', 'exist',
                'targetClass' => Author::class,
                'targetAttribute' => 'id',
                'message' => 'Автор не найден.'
            ],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],

            // Уникальность подписки
            [['author_id', 'email'], 'unique',
                'targetClass' => self::class,
                'message' => 'Вы уже подписаны на этого автора.'
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author_id' => 'Автор',
            'email' => 'Email для подписки',
        ];
    }

    public function getAuthor()
    {
        return $this->hasOne(Author::class, ['id' => 'author_id']);
    }
}

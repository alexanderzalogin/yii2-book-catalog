<?php

use yii\db\Migration;

class m240101_000004_create_bookauthor_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%bookauthor}}', [
            'book_id' => $this->integer()->notNull(),
            'author_id' => $this->integer()->notNull(),
        ]);

        $this->addPrimaryKey('pk-bookauthor', '{{%bookauthor}}', ['book_id', 'author_id']);

        $this->addForeignKey(
            'fk-bookauthor-book',
            '{{%bookauthor}}',
            'book_id',
            '{{%book}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-bookauthor-author',
            '{{%bookauthor}}',
            'author_id',
            '{{%author}}',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('{{%bookauthor}}');
    }
}

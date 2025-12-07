<?php

use yii\db\Migration;

class m240101_000003_create_book_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%book}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'year' => $this->integer()->notNull(),
            'isbn' => $this->string(20),
            'description' => $this->text(),
            'cover_image' => $this->string(255),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()
                ->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);

        $this->createIndex('idx-book-title', '{{%book}}', 'title');
        $this->createIndex('idx-book-year', '{{%book}}', 'year');
    }

    public function down()
    {
        $this->dropTable('{{%book}}');
    }
}

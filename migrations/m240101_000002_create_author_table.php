<?php

use yii\db\Migration;

class m240101_000002_create_author_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%author}}', [
            'id' => $this->primaryKey(),
            'full_name' => $this->string(255)->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()
                ->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);

        $this->createIndex('idx-author-full_name', '{{%author}}', 'full_name');
    }

    public function down()
    {
        $this->dropTable('{{%author}}');
    }
}

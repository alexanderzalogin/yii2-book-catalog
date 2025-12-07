<?php

use yii\db\Migration;

class m240101_000005_create_subscription_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%subscription}}', [
            'id' => $this->primaryKey(),
            'author_id' => $this->integer()->notNull(),
            'email' => $this->string(255)->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->createIndex('idx-subscription-author_email', '{{%subscription}}', ['author_id', 'email'], true);


        $this->addForeignKey(
            'fk-subscription-author',
            '{{%subscription}}',
            'author_id',
            '{{%author}}',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('{{%subscription}}');
    }
}

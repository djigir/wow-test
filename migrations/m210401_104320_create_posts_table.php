<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%posts}}`.
 */
class m210401_104320_create_posts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%posts}}', [
            'id' => $this->primaryKey(),
            'author_id' => $this->integer(),
            'title' => $this->string(),
            'description' => $this->text(),
            'create_at' => $this->dateTime(),
        ]);

        $this->addForeignKey('post_user_id', 'posts', 'author_id', 'users', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%posts}}');
    }
}

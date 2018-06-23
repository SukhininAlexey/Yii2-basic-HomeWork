<?php

use yii\db\Migration;

/**
 * Handles the creation of table `comments`.
 */
class m180618_051459_create_comments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('comments', [
            'id' => $this->primaryKey(),
            'date' => $this->dateTime()->notNull(),
            'content' => $this->text(),
            'user_id' => $this->integer(),
            'task_id' => $this->integer()
        ]);
        
        $this->addForeignKey('fk_comments_users', 'comments', 'user_id', 'users', 'id');
        $this->addForeignKey('fk_comments_tasks', 'comments', 'task_id', 'tasks', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('comments');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `comment_pics`.
 */
class m180618_052630_create_comment_pics_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('comment_pics', [
            'id' => $this->primaryKey(),
            'file_name' => $this->text(),
            'view_name' => $this->text(),
            'comment_id' => $this->integer()
        ]);
        
        $this->addForeignKey('fk_comments_pics', 'comment_pics', 'comment_id', 'comments', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('comment_pics');
    }
}

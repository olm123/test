<?php

use yii\db\Migration;

/**
 * Handles the creation of table `news`.
 * Has foreign keys to the tables:
 *
 * - `user`
 */
class m170828_170637_create_news_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('news', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'preview_text' => $this->text(),
            'full_text' => $this->text(),
            'image' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'author' => $this->integer()->notNull(),
        ]);

        // creates index for column `author`
        $this->createIndex(
            'idx-news-author',
            'news',
            'author'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-news-author',
            'news',
            'author',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-news-author',
            'news'
        );

        // drops index for column `author`
        $this->dropIndex(
            'idx-news-author',
            'news'
        );

        $this->dropTable('news');
    }
}

<?php

use yii\db\Migration;

class m000000_000004_create_token_table extends Migration
{
    public function up()
    {
        $this->createTable(
            '{{%token}}',
            [
                'user_id' => $this->integer(),
                'code' => $this->string(32)->notNull(),
                'created_at' => $this->integer()->notNull(),
            ]
        );
        $this->addForeignKey('fk_token_user', '{{%token}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%token}}');
    }
}

<?php

use yii\db\Migration;

class m000000_000001_create_user_table extends Migration
{
    public function up()
    {
        $this->createTable(
            '{{%user}}',
            [
                'id' => $this->primaryKey(),
                'email' => $this->string(255)->notNull(),
                'password_hash' => $this->string(60)->notNull(),
                'auth_key' => $this->string(32)->notNull(),
                'confirmed_at' => $this->integer(),
                'last_login_at' => $this->integer(),
                'updated_at' => $this->integer()->notNull(),
                'created_at' => $this->integer()->notNull(),
            ]
        );

        $this->createIndex('idx_user_email', '{{%user}}', 'email', true);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}

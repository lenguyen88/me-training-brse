<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%business}}`.
 */
class m200912_122642_create_business_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%business}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%business}}');
    }
}

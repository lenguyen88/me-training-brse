<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%project_business}}`.
 */
class m200912_122650_create_project_business_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%project_business}}', [
            'id' => $this->primaryKey(),
            'project_id' => $this->integer()->notNull(),
            'business_id' => $this->integer()->notNull(),
        ]);
        $this->addForeignKey('project_business-project_id-key', 'project_business', 'project_id', 'project', 'id');
        $this->addForeignKey('project_business-business_id-key', 'project_business', 'business_id', 'business', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%project_business}}');
    }
}

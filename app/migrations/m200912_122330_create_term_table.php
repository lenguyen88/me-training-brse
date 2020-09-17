<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%term}}`.
 */
class m200912_122330_create_term_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%term}}', [
            'id' => $this->primaryKey(),
            'language' => $this->string(2),
            'vocabulary' => $this->string(), 
            'description' => $this->text(),
            'type' => $this->tinyInteger(),
            'project_id' => $this->integer(),
            'parent_term_id' => $this->integer(),

        ]);
        $this->addForeignKey ( 'term-project_id-key', 'term', 'project_id', 'project', 'id' );
        $this->addForeignKey ( 'term-parent_term_id-key', 'term', 'parent_term_id', 'term', 'id' );
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%term}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%point}}`.
 */
class m200518_164308_create_point_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%point}}', [
            'point_id' => $this->primaryKey(),
            'point_name' => $this->string()->notNull(),
            'latitude' => $this->decimal(8,6)->notNull(),
            'longitude' => $this->decimal(8,6)->notNull(),
            'user_id'=>$this->integer(),
        ]);
        $this->createIndex( 
            'idx-point-user_id', 
            'point', 
            'user_id' 
            ); 
            $this->addForeignKey( 
                'fk-point-user_id', 
                'point', 
                'user_id', 
                'user', 
                'user_id', 
                'CASCADE' 
            ); 
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%point}}');
    }
}

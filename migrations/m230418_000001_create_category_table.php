<?php

use yii\db\Migration;

class m230418_000001_create_category_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);

        // Insert default categories
        $this->batchInsert('category', ['name'], [
            ['Category A'],
            ['Category B'],
            ['Category C'],
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('category');
    }
}
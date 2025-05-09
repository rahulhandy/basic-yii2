<?php

use yii\db\Migration;

class m230418_000002_create_todo_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('todo', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'timestamp' => $this->dateTime()->notNull(),
            'status' => $this->boolean()->defaultValue(0),
        ]);

        $this->addForeignKey(
            'fk-todo-category_id',
            'todo',
            'category_id',
            'category',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-todo-category_id', 'todo');
        $this->dropTable('todo');
    }
}

<?php
namespace app\models;

use yii\db\ActiveRecord;

class Todo extends ActiveRecord
{
    public static function tableName()
    {
        return 'todo';
    }

    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }
}

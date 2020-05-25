<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "skill".
 *
 * @property int $id
 * @property string $name
 * @property int $rate
 * @property int $user_id
 */
class Skill extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'skill';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'rate', 'user_id'], 'required'],
            [['rate', 'user_id'], 'integer'],
            [['name'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'rate' => 'Rate',
            'user_id' => 'User ID',
        ];
    }
}

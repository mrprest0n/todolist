<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $lists
 * @property int $done
 *
 * @property Lists $lists0
 */
class Tasks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'lists'], 'required'],
            //[['lists'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 500],
            [['done'], 'string', 'max' => 1],
            //[['lists'], 'exist', 'skipOnError' => true, 'targetClass' => Lists::className(), 'targetAttribute' => ['lists' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            //'id' => 'ID',
            'name' => 'Наименование',
            'description' => 'Описание',
            //'lists' => 'Lists',
            'done' => 'Статус',
        ];
    }
    
        /**
     * @return \yii\db\ActiveQuery
     */
    public function getLists()
    {
        
        return Lists::findOne(['id' => $this->lists, 'user' => Yii::$app->user->identity->id]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLists0()
    {
        return $this->hasOne(Lists::className(), ['id' => 'lists']);
    }
}

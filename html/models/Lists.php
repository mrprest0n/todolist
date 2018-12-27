<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lists".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $user
 * @property string $dt_create
 * @property string $dt_change
 *
 * @property User $user0
 */
class Lists extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lists';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', /*'user', 'dt_create'*/], 'required'],
            //[['user'], 'integer'],
            //[['dt_create', 'dt_change'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 100],
           // [['user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            //'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            //'user' => 'User',
            //'dt_create' => 'Dt Create',
            //'dt_change' => 'Dt Change',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser0()
    {
        return $this->hasOne(User::className(), ['id' => 'user']);
    }
}

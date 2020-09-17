<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "business".
 *
 * @property int $id
 * @property string $name
 *
 * @property ProjectBusiness[] $projectBusinesses
 */
class Business extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'business';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * Gets query for [[ProjectBusinesses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProjectBusinesses()
    {
        return $this->hasMany(ProjectBusiness::className(), ['business_id' => 'id']);
    }
}

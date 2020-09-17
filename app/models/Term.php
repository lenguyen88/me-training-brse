<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "term".
 *
 * @property int $id
 * @property string|null $language
 * @property string|null $vocabulary
 * @property string|null $description
 * @property int|null $type
 * @property int|null $project_id
 * @property int|null $parent_term_id
 *
 * @property Project $project
 * @property Term $parentTerm
 * @property Term[] $terms
 */
class Term extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'term';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['type', 'project_id', 'parent_term_id'], 'default', 'value' => null],
            [['type', 'project_id', 'parent_term_id'], 'integer'],
            [['language'], 'string', 'max' => 2],
            [['vocabulary'], 'string', 'max' => 255],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_id' => 'id']],
            [['parent_term_id'], 'exist', 'skipOnError' => true, 'targetClass' => Term::className(), 'targetAttribute' => ['parent_term_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'language' => 'Language',
            'vocabulary' => 'Vocabulary',
            'description' => 'Description',
            'type' => 'Type',
            'project_id' => 'Project',
            'parent_term_id' => 'Parent Term ID',
            'typeStr' => 'Type',
            'projectName' => 'Project',
        ];
    }

    /**
     * type array
     * @return string[]
     */
    public static function typeOptionArray()
    {
        return [
            1 => '案件の用語',
            2 => '追加用語',
            3 => 'その他'
        ];
    }

    /**
     * get type string
     * @return string
     */
    public function getTypeStr()
    {
        return ArrayHelper::getValue(self::typeOptionArray(),$this->type);
    }

    /**
     * Gets query for [[Project]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }

    /**
     * Gets query for [[ParentTerm]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParentTerm()
    {
        return $this->hasOne(Term::className(), ['id' => 'parent_term_id']);
    }

    /**
     * Get parent term vocabulary
     * @return string
     */
    public function getParentTermVocabulary()
    {
        return $this->parentTerm->vocabulary;
    }

    /**
     * Gets query for [[Terms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTerms()
    {
        return $this->hasMany(Term::className(), ['parent_term_id' => 'id']);
    }

    /**
     * Get project name of this term.
     * @return string
     */
    public function getProjectName()
    {
        return $this->project->name;
    }

    /**
     * Get parent term name of this term
     * @return string
     */
    public function getParentTemVocabulary()
    {
        return $this->parentTerm->name;
    }

    /**
     * trigger berfore delete()
     */
    function beforeDelete()
    {
        foreach($this->terms as $term){
            $term->delete();
        }
        return parent::beforeDelete();

    }
}

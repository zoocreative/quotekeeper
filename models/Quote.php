<?php

namespace mightyzoo\quotekeeper\models;

use Yii;
use app\models\Content;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "core_contents".
 *
 * @property integer $id
 * @property string $type
 * @property string $title
 * @property integer $displaytitle
 * @property string $slug
 * @property string $summary
 * @property string $content
 * @property integer $creator
 * @property integer $editor
 * @property integer $status
 * @property string $settings
 * @property string $language
 * @property string $created
 * @property string $modified
 */
class Quote extends \yii\db\ActiveRecord
{
    /**
     * Database Table
     * @return [string] [Table Name]
     */
    public static function tableName()
    {
        return 'core_contents';
    }

    ////////////////
    // VALIDATION //
    ////////////////

    /**
     * Validation Rules
     * @return [array] [Validation Settings]
     */
    public function rules()
    {
        return [
            [['type','title','content'], 'required'],
            [['content'], 'string'],
            [['type', 'title'], 'string', 'max' => 200],
        ];
    }

    ////////////
    // LABELS //
    ////////////

    /**
     * Form Labels
     * @return [array] [Plain text labels for forms]
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'title' => Yii::t('models_content','Source / Name'),
            'content' => Yii::t('models_content','Quote Text'),
        ];
    }

    ////////////////
    // BEHAVIOURS //
    ////////////////

    /**
     * Model Behaviours
     * @return [array] [Behaviour Configuration]
     */
    public function behaviors()
    {
        return [
            // Add User
            [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT  => 'creator',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'editor',
                ],
                'value' => function ($event) {
                    return Yii::$app->user->identity->id;
                },
            ],
            // Slug
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                'slugAttribute' => 'slug',
            ],
            // Add Timestamp
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created',
                'updatedAtAttribute' => 'modified',
                'value' => new Expression('NOW()')
            ],
        ];
    }

    //////////////////////
    // STATIC FUNCTIONS //
    //////////////////////

    /**
     * Get all the current quotes from the core_contents table
     * @return [object] [Active Record]
     */
    static function getQuotes()
    {
        return Content::find()->where(['type'=>'quote']);
    }

}

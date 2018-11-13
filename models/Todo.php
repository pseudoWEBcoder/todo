<?php

namespace app\models;

use app\models\Project;
use Yii;

/**
 * This is the model class for table "todo".
 *
 * @property int $id
 * @property int $timestamp
 * @property string $text
 * @property int $status_id
 * @property int $project_id
 */
class Todo extends \yii\db\ActiveRecord
{
    public  $namesDays =  [
        'Mon' =>'пн',
        'Tue' =>'вт',
        'Wed' =>'ср',
        'Thu' =>'чт',
        'Fri' =>'пт',
        'Sat' =>'сб',
        'San' =>'вс',
    ];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'todo';
    }

    /**
     * {@inheritdoc}
     * @return TodoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TodoQuery(get_called_class());
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['timestamp', 'status_id', 'project_id',  'text'], 'required'],
            [['timestamp', 'status_id', 'project_id'], 'integer'],
            [['text'], 'string', 'max' => 1500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'timestamp' => 'Timestamp',
            'text' => 'Text',
            'status_id' => Yii::t('app', 'Status ID'),
            'project_id' => Yii::t('app', 'Project ID'),
        ];
    }

    public function init()
    {
        if ($this->isNewRecord)
            $this->timestamp = time();
        parent::init();
    }

    public function getDateTime($format)
    {
        try {
            $timezone = new \DateTimeZone('Europe/moscow');
            if ($this->timestamp)
                $d = \DateTimeImmutable::createFromFormat('U',  $this->timestamp, $timezone);
            return $d && $format ? $d->format($format) : $d;

        } catch (\Exception $e) {
            return false;
        }
        return false;
    }
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }
}

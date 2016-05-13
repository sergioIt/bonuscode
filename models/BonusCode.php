<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "bonus_code".
 *
 * @property integer $id
 * @property string $series
 * @property string $number
 * @property string $created
 * @property string $expires
 * @property string $used
 * @property integer $status
 */
class BonusCode extends ActiveRecord
{
    const STATUS_INACTIVE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bonus_code';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['series', 'number', 'expires', 'status'], 'required'],
            [['created', 'expires', 'used'], 'safe'],
            [['status'], 'integer'],
            [['series'], 'string', 'max' => 4],
            [['number'], 'string', 'max' => 10],
            [['series', 'number'], 'unique', 'targetAttribute' => ['series', 'number'], 'message' => 'The combination of Series and Number has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'series' => 'Series',
            'number' => 'Number',
            'created' => 'Created',
            'expires' => 'Expires',
            'used' => 'Used',
            'status' => 'Status',
        ];
    }
}
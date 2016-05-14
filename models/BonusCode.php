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
    const STATUS_ACTIVE = 1;
    const STATUS_USED = 2;

    const SERIES_LENGTH = 4;
    const NUMBER_LENGTH = 10;

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
            'series' => 'серия',
            'number' => 'номер',
            'created' => 'создан',
            'expires' => 'истекает',
            'used' => 'использован',
            'status' => 'статус',
        ];
    }

    public function isActive(){

        return $this->status == self::STATUS_ACTIVE;
    }
}
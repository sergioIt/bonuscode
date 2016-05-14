<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 13.05.16
 * Time: 17:47
 */

namespace app\models;
use yii\base\Model;


class BonusCodeGenerator extends Model{

    public $count;
    public $expires;

    private static $salt = 'sfer4389kdfn';

    public function rules(){

        return [

            [['count','expires'], 'required'],
            ['count', 'integer','min'=>1, 'max'=> 100],
            [   'expires',
                'date',
                'format' => 'yyyy-MM-dd'
            ],
        ];

    }

    public function attributeLabels(){

        return [

            'count' => 'Число кодов',
            'expires' => 'Срок окончания действия'
        ];
    }

    /**
     * Генерирует номер и серию кода
     * серия одинакова для каждой генерации, номера уникальны
     * поэтому серия+номер тоже уникальны
     * @param $count
     * @param $expires
     */
    public static function generate($count,$expires){

        $initSting = md5(uniqid().self::$salt);
        $series = substr($initSting,0,BonusCode::SERIES_LENGTH);

        for($i=1; $i<=$count; $i++){

            $string = md5(uniqid().self::$salt);

            $code = new BonusCode();
            $code->series = $series;
            $code->number = substr($string,BonusCode::SERIES_LENGTH,BonusCode::NUMBER_LENGTH);
            $code->expires = $expires;
            $code->status = BonusCode::STATUS_INACTIVE;
            $code->save();

        }
    }
}
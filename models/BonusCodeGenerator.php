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

    public static function generate($count,$expires){

       // $lastSeries = BonusCode::findOne(['order' => 'id desc']);

        for($i=1; $i<=$count; $i++){


            $code = new BonusCode();
            $code->series = 'AAA';
            $code->number = (string)$i;
            $code->expires = $expires;
            $code->status = BonusCode::STATUS_INACTIVE;
            $code->save();

        }
    }
}
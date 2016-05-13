<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 13.05.16
 * Time: 16:59
 */

namespace app\controllers;

use Yii;
use app\models\BonusCode;
use app\models\BonusCodeGenerator;
use yii\web\Controller;
use yii\data\ActiveDataProvider;

class BonusController extends Controller{

    public function actionList(){

        $dataProvider = new ActiveDataProvider([
            'query' => BonusCode::find(),
            //->where(['in', 'status', [Test::STATUS_FINISHED, Test::STATUS_FAULT]]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('list',
            ['dataProvider' => $dataProvider,
                //'searchModel' => $searchModel,

            ]
        );

    }

    public function actionCreate(){

        var_dump($_POST);

        $model = new BonusCodeGenerator();

       // $model->load(\Yii::$app->request->post());

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

           // var_dump($model);
            // all inputs are valid

            BonusCodeGenerator::generate($model->count,$model->expires);
            $listUrl = Yii::$app->urlManager->createUrl('bonus/list');
            $this->redirect($listUrl);

        }
        else {
            // validation failed: $errors is an array containing error messages
          //  $errors = $model->errors;
            return $this->render('create',
                [
                    'model' => $model

                ]
            );
        }


    }

}
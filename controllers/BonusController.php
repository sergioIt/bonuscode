<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 13.05.16
 * Time: 16:59
 */

namespace app\controllers;

use app\models\BonusCodeSearch;
use Yii;
use app\models\BonusCode;
use app\models\BonusCodeGenerator;
use yii\base\Exception;
use yii\web\Controller;
use yii\data\ActiveDataProvider;

class BonusController extends Controller{

    public function actionList(){

        $searchModel = new BonusCodeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());
        //$dataProvider->setPagination(['pageSize' => 20])


        /*$dataProvider = new ActiveDataProvider([
            'query' => BonusCode::find(),
            //->where(['in', 'status', [Test::STATUS_FINISHED, Test::STATUS_FAULT]]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);*/

        return $this->render('list',
            ['dataProvider' => $dataProvider,
             'searchModel' => $searchModel,

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

    /**
     *
     * Удаляет запись с бонусным кодом
     * @throws Exception
     * @throws \Exception
     */
    public function actionDelete(){

        //var_dump($this->id);
        $codeId = Yii::$app->request->get('id');

        if(!$codeId){
            throw new Exception('no bonus code id get to delete');
        }

        BonusCode::findOne($codeId)->delete();

        $listUrl = Yii::$app->urlManager->createUrl('bonus/list');
        $this->redirect($listUrl);

    }

    /**
     *  Активирует код
     */
    public function actionActivate(){

        $codeId = Yii::$app->request->get('id');

        $code = BonusCode::findOne($codeId);
        $code->status = BonusCode::STATUS_ACTIVE;
        $code->update();

        $listUrl = Yii::$app->urlManager->createUrl('bonus/list');
        $this->redirect($listUrl);

    }

    /**
     * Деактивирует код
     */
    public function actionDeactivate(){

        $codeId = Yii::$app->request->get('id');

        $code = BonusCode::findOne($codeId);
        $code->status = BonusCode::STATUS_INACTIVE;
        $code->update();

        $listUrl = Yii::$app->urlManager->createUrl('bonus/list');
        $this->redirect($listUrl);

    }

}
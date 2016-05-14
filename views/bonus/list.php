<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 13.05.16
 * Time: 17:05
 */

use yii\grid\GridView;
use yii\helpers\Html;
use yii\bootstrap\Modal;

/*$this->registerJsFile('js/backend.js',
    ['depends' => ['\yii\web\JqueryAsset'],
        'position' => \yii\web\View::POS_END,]
);*/
?>
<h2>Список бонусных кодов </h2>

<?= Html::a('генератор кодов', Yii::$app->urlManager->createUrl('bonus/create'),['role' => 'button', 'class'=> 'btn btn-lg btn-info']); ?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
     'filterModel' => $searchModel,
    'columns' => [
        'id',
        'series',
        'number',
        'created',
        'expires',
        'used',
        'status' => [

            'attribute' => 'status',
            'format' => 'html',
            'value' => function($model){

                if($model->isActive()){

                    return Html::tag('span','активизирован',['class' => 'label label-success']);
                }

                return Html::tag('span','не активизирован',['class' => 'label label-default']);

            }
        ],
        'actions' =>
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Действия',
                'template' => '{activate}{deactivate}{delete}',
                'buttons' => [
                    'activate' => function ($url, $model, $key) {
                        if($model->status == \app\models\BonusCode::STATUS_INACTIVE)
                        {
                            return Html::a(Html::tag('span','',['class' => 'glyphicon glyphicon-arrow-up']),$url,
                                [
                                    'role' => 'button',
                                    'class' => 'btn btn-sm btn-success',
                                    'title' => 'Активировать',
                                ]);
                        }

                        return '';

                    },
                    'deactivate' => function ($url, $model, $key) {
                        if($model->status == \app\models\BonusCode::STATUS_ACTIVE)
                        {
                            return Html::a(Html::tag('span','',['class' => 'glyphicon glyphicon-arrow-down']),$url,
                                [
                                    'class' => 'btn btn-sm btn-warning',
                                    'title' => 'Деактивировать',
                                ]);
                        }

                        return '';

                    }

                ]

            ]
    ]]);

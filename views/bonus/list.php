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

<?= Html::a('генератор', Yii::$app->urlManager->createUrl('bonus/create')); ?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    // 'filterModel' => $searchModel,
    'columns' => [
        'id',
        'series',
        'number',
        'created',
        'expires',
        'used',
        'status',
        'actions' =>
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Действия',
                'template' => '{view}{update}{delete}',
/*                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a(Html::tag('span','',
                            ['class'=>'glyphicon glyphicon-search', 'aria-hidden'=>'true']),
                            '#',
                            [
                                'class' => 'btn_view_test',
                                'title' => Yii::t('yii', 'Просмотр теста'),
                                'data-toggle' => 'modal',
                                'data-target' => '#activity-modal',
                                'data-id' => $model->id,
                                'data-url' => \yii::$app->getUrlManager()->createUrl('test/view'),
                                'padding' => '5px'
                            ]);
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a(Html::tag('span','',
                            ['class'=>'glyphicon glyphicon-pencil', 'aria-hidden'=>'true']),
                            '#',
                            [
                                'class' => 'btn_update_test',
                                'title' => Yii::t('yii', 'Обновить'),
                                'data-toggle' => 'modal',
                                'data-target' => '#activity-modal',
                                'data-id' => $model->id,
                                'data-url' => \yii::$app->getUrlManager()->createUrl('test/update')
                            ]);
                    }

                ]*/

            ]
    ]]);

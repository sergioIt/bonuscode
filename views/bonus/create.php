<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 13.05.16
 * Time: 17:17
 */

use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;
?>

<h2>Генератор кодов</h2>
<?
    $form = ActiveForm::begin([
    'id' => 'login-form',
    'options' => ['class' => 'form-inline'],
    ]) ?>
<div class="form-group">
    <?= $form->field($model, 'count')->textInput(['type'=>'number']) ?>
</div>
<div class="form-group">
    <?= $form->field($model, 'expires')->widget(\yii\jui\DatePicker::classname(),[
        'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd',
        'inline' => false,
        'clientOptions' => [
            'changeMonth' => true,
            'yearRange' => '2016:2020',
            'changeYear' => true,
            'showOn' => 'button',
            //'buttonImage' => 'images/calendar.gif',
            'buttonImageOnly' => false,
            'buttonText' => 'Выберите дату',

        ],]) ?>

</div>
    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Сгенерировать', ['class' => 'btn btn-lg btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>

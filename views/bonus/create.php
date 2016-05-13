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
    'options' => ['class' => 'form-horizontal'],
    ]) ?>
<?= $form->field($model, 'count') ?>
<?= $form->field($model, 'expires')->widget(\yii\jui\DatePicker::classname(),[
    'language' => 'ru',
    'dateFormat' => 'yyyy-MM-dd',
    'inline' => false,
    'clientOptions' => [
        'changeMonth' => true,
        'yearRange' => '1925:2005',
        'changeYear' => true,
        'showOn' => 'button',
        //'buttonImage' => 'images/calendar.gif',
        'buttonImageOnly' => false,
        'buttonText' => 'Выберите дату',

    ],]) ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Сгенерировать', ['class' => 'btn btn-lg btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>

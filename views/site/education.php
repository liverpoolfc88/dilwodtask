<?php
/**
 * Created by PhpStorm.
 * Author: Abdujalilov Dilshod
 * Telegram: https://t.me/coloterra
 * Web: http://www.websar.uz
 * Project: basic
 * Date: 06.02.2020 13:02
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Education';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Please fill out the following fields to education:</p>
    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            <?= $form->field($model, 'university')->textInput(['autofocus' => true,'placeholder'=>'University']) ?>
            <?= $form->field($model, 'location')->textInput(['placeholder' => "City"]) ?>
            <?= $form->field($model, 'from_date')->textInput(['placeholder' => "02-09-2007"])?>
            <?= $form->field($model, 'to_date')->textInput(['placeholder' => "10-06-2011"]) ?>
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
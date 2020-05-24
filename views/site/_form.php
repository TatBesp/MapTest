<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $model app\models\Point */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="point-form">

    <?php $form = ActiveForm::begin([ 'options' => ['data' => ['pjax' => true]],]); ?>
    <div class="row">
        <div class="col-lg-3 col-md-12">
            <?= $form->field($model, 'point_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-3 col-md-12">
            <?= $form->field($model, 'latitude')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-3 col-md-12">
            <?= $form->field($model, 'longitude')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-3 col-md-12">
        
            <div class="form-group">
                    <?= Html::submitButton('Добавить', ['class' => 'btn btn-dark', 'id'=>'add-point']) ?>
                </div>
              
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>

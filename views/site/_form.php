<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $model app\models\Point */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="point-form">

    <?php $form = ActiveForm::begin(); ?>
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
        <?php //if (!Yii::$app->request->isAjax){ ?>
            <div class="form-group">
                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-dark']) ?>
                </div>
                <?php //} ?>	
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>

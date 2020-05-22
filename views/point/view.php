<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Point */
?>
<div class="point-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'point_id',
            'point_name',
            'latitude',
            'longitude',
            'user_id',
        ],
    ]) ?>

</div>

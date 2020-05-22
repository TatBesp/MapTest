<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;
use yii\widgets\Pjax;
$this->title = 'Map Test';
CrudAsset::register($this);
?>
<?php Pjax::begin(); ?>
<div class="site-index"  id="crud-datatable-pjax" data-pjax-container="" data-pjax-push-state data-pjax-timeout="1000">
    <div class="body-content">
    <div class="point-form">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
        <a class="btn btn-default" href="/point/create" title="Create new Points" role="modal-remote"><i class="glyphicon glyphicon-plus"></i></a>
</div>
        <div class="row">
            <div class="col-lg-8">
                <div class="map-block" id="map">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="points-block">
                    <?php foreach($points as $point):?>
                        <div class="points-block__item">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="points-block__item-desc">
                                    <h3 class="point-name"><?= $point->point_name ?></h3>
                                        <p><span class="latitude"><?= $point->latitude ?></span>
                                        / 
                                        <span class="longitude"><?= $point->longitude ?></span></p>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="points-block__item-btns">
                                    <?= Html::a('Изменить', ['point/update', 'id' => $point->point_id], 
                                    ['class' => 'btn btn-dark',
                                    'data-pjax' => true,
                                    'role' => 'modal-remote',
                                    'data-toggle' => 'tooltip']) ?>
                                    <?= Html::a('Удалить', ['point/delete', 'id' => $point->point_id], [
                                        'class' => 'btn btn-dark',
                                        'aria-label' => 'Delete', 
                                        'data-pjax' => true, 
                                        'role' => 'modal-remote', 
                                        'data' => [
                                            'confirm-title' => 'Вы уверены?',
                                            'confirm-message' => 'Вы уверены, что хотите удалить эту точку?',
                                            'request-method' => 'post',
                                            'toggle' => 'tooltip',
                                        ],
                                    ]) ?>                                                                                                  
                                    </div>
                                </div>
                            </div>                     
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>                                                           
    </div>
</div>
<?php Pjax::end(); ?>
<?php file_put_contents('my.json', 'w');
        if($points){
            foreach($points as $point){
                
                $map_points[] = array(
                                "type"=>"Feature",
                                "id"=> $point->point_id,
                                "geometry"=> array(
                                    "type"=> "Point",
                                    "coordinates"=> [$point->latitude, $point->longitude]
                                ),
                                "properties"=> array(
                                  "balloonContentBody"=>$point->point_name,
                                )
                            
                    );
                }
            file_put_contents('my.json', json_encode($map_points));
            }
            ?>

<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>

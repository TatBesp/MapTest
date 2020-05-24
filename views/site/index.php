<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\Modal;
use johnitvn\ajaxcrud\CrudAsset; 
use yii\widgets\Pjax;
$this->title = 'Map Test';
CrudAsset::register($this);
?>

<div class="site-index" >
    <div class="body-content">
    
    <?php Pjax::begin(['id' => 'points-data']);?>
    <div class="point-form">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
       </div>
       <?= $active_point_id ?>
        <div class="row">
            <div class="col-lg-8">
            <div class="map-block" id="map">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="points-block">
                    <?php foreach($points as $point):?>
                        <div class="points-block__item <?php if($point->point_id==$active_point_id): ?>active<?php endif ?>" id="point_id-<?=$point->point_id?> ">
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
                                    <?= Html::a('Изменить', ['update', 'id' => $point->point_id], 
                                    ['class' => 'btn btn-dark',
                                    'data-pjax' => '#points-data',
                                    'role' => 'modal-remote',
                                    'data-toggle' => 'tooltip']) ?>
                                    <?= Html::a('Удалить', ['delete', 'id' => $point->point_id], [
                                        'class' => 'btn btn-dark',
                                        'aria-label' => 'Delete', 
                                        'data-pjax' => '#points-data',
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
<?php Pjax::end(); ?>
<?php Modal::begin([
    'options' => ['data' => ['pjax' => true]],
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>

<?php Modal::end(); ?>


<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=3d1d1517-9f79-40c9-98c9-f882fcfe55ba" type="text/javascript"></script>
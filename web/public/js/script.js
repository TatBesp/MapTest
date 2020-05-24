jQuery(function($) {
    "use strict";
    $(document).ready(function () {
        ymaps.ready(init); 
    });
    $(document).on('pjax:complete',function(xhr, textStatus, options){
        ymaps.ready(init);   
    });

    var myMap;
    function init () {
        var geolocation = ymaps.geolocation;
        var objectManager;
         myMap = new ymaps.Map('map', {
                center: [55.76, 37.64],
                zoom: 10
            }, {
                searchControlProvider: 'yandex#search'
            }),
             objectManager = new ymaps.ObjectManager({
                //clusterize: true,
                //gridSize: 32,
                //clusterDisableClickZoom: true
            });
    
        
        myMap.geoObjects.add(objectManager);
    
        $.ajax({
            url: "../my.json"
        }).done(function(data) {
            objectManager.add(data);
        });

        var latitude = $('.points-block__item.active').find(".latitude").text();
        var longitude = $('.points-block__item.active').find(".longitude").text();
        if(!(latitude && longitude)){
            geolocation.get({
                provider: 'yandex',
                mapStateAutoApply: true
                }).then(function (result) {
                    result.geoObjects.options.set('preset', 'islands#redCircleIcon');
                    result.geoObjects.get(0).properties.set({
                        balloonContentBody: 'Мое местоположение'
                    });
                    myMap.geoObjects.add(result.geoObjects);
                }); 
            }
            else{
            myMap.setCenter([latitude, longitude] , 7);
            }
            $('.points-block__item').on('click', function(){
                if($('.points-block__item').hasClass('active')){
                    $('.points-block__item').removeClass('active');
                }
                $(this).addClass('active');
                var latitude = $(this).find(".latitude").text();
                var longitude = $(this).find(".longitude").text();
                myMap.setCenter([latitude, longitude] , 7);
            });  
    }
    
	
           /* validate();
            function validate(){
                $('#point-point_name').on('change', function(){
                    var point_name = $(this).val();
                    var valid = true;
                    $('.points-block__item').each(function(i,elem){
                        if($(this).find(".point-name").text()==point_name){
                            console.log('alarm');
                            valid = false;
                        }
                    });
                    if(!valid){
                        $(this).parent('.field-point-point_name').addClass('has-error').removeClass('has-success');
                        $(this).attr('aria-invalid', true);
                    }
                });
            }*/


         }); 

jQuery(function($) {
    "use strict";
		$(document).ready(function () {
            var myMap;
            ymaps.ready(init);
            
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

            $('.points-block__item').on('click', function(){
                $('.points-block__item').removeClass('active');
                $(this).addClass('active');
                var latitude = $(this).find(".latitude").text();
                var longitude = $(this).find(".longitude").text();
                myMap.setCenter([latitude, longitude] , 7);
            });

            
            
         }); 
});

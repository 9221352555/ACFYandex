ymaps.ready(function () {    
$('#extendbox').css('width','100%').css('height','400px');
let acfyandexElem = document.getElementsByClassName('acf-yandex');
let acfyandexCoords = acfyandexElem[0].value;

var acfyandexPlacemark;
var acfyandexMap = new ymaps.Map('extendbox',{
     center: [acfyandexCoords.split(',')[0], acfyandexCoords.split(',')[1]],
     zoom: 16
 }, {
     searchControlProvider: 'yandex#search'
 });
CreateNewPoint(acfyandexCoords);

acfyandexMap.events.add('click', function (e) {
    document.getElementsByClassName('acfyandex')[0].value = e.get('acfyandexCoords');
    CreateNewPoint(document.getElementsByClassName('acfyandex')[0].value);
});

$('.acf_yandex').change(function(){
    CreateNewPoint(this.value);
    acfyandexMap.setCenter([this.value.split(',')[0], this.value.split(',')[1]]);
});


function CreateNewPoint(par_acfyandexCoords){
    if(acfyandexPlacemark){
        acfyandexMap.geoObjects.remove(acfyandexPlacemark);
    }
    acfyandexPlacemark = new ymaps.GeoObject({
        geometry: {
            type: "Point",
            coordinates: [par_acfyandexCoords.split(',')[0], par_acfyandexCoords.split(',')[1]]
        },
    });
    acfyandexPlacemark.events.add('dragend', function(){getAddress(acfyandexPlacemark.geometry.getCoordinates());});
    getAddress(par_acfyandexCoords);            
    acfyandexMap.geoObjects.add(acfyandexPlacemark);       
}

    function getAddress(par_acfyandexCoords) {
        acfyandexPlacemark.properties.set('iconCaption', 'search...');
        ymaps.geocode(par_acfyandexCoords).then(function (res) {
            var firstGeoObject = res.geoObjects.get(0);

            acfyandexPlacemark.properties
                .set({
                    iconCaption: [
                        firstGeoObject.getLocalities().length ? firstGeoObject.getLocalities() : firstGeoObject.getAdministrativeAreas(),
                        firstGeoObject.getThoroughfare() || firstGeoObject.getPremise()
                    ].filter(Boolean).join(', '),
                    balloonContent: firstGeoObject.getAddressLine()
                });
        });
    }

});


  
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


 ymaps.ready(acfyandexInit);
 function acfyandexGetPoint(obj){
     return [obj.getAttribute('point').split(',')[0],obj.getAttribute('point').split(',')[1]];
 }

 function acfyandexGetZoom(obj){
     return obj.getAttribute('zoom');
 }

 function acfyandexGetTitle(obj){
     return obj.getAttribute('title');
 }

 function acfyandexGetMemo(obj){
     return obj.getAttribute('memo');
 }

 function acfyandexInit(){
    let obj = document.getElementById('map');
    let point = acfyandexGetPoint(obj);
    let zoom = acfyandexGetZoom(obj);
    var myMap = new ymaps.Map("map", {
        center: point,
        zoom: zoom
    });
    acfyandexPlacemark = new ymaps.GeoObject({
        geometry: {
            type: "Point",
            coordinates: point
        },
        properties: {
            clusterCaption: acfyandexGetMemo(obj),
            balloonContentBody: acfyandexGetMemo(obj),
            iconCaption: acfyandexGetTitle(obj)
        }        
    });
    myMap.geoObjects.add(acfyandexPlacemark);
    
}
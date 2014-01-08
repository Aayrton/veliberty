
var map;
var ib = new InfoBox({
        boxStyle: {
        background: "white",
        width: "300px",
        border: "1px solid grey"

    },
    pixelOffset: new google.maps.Size(-140, 0),
    closeBoxMargin: "5px 2px 2px 2px",
    closeBoxUrl: "bootstrap/img/delete.png"
});

var iconMarker = {
    url: 'bootstrap/img/marker.png',
    size: new google.maps.Size(71, 71),
    departure: new google.maps.Point(0, 0),
    anchor: new google.maps.Point(17, 34),
    scaledSize: new google.maps.Size(33, 33)
};

var available;
var free;
var total;
var calculateDirection;
var direction;
var instruction;



function initialize() {
    loadvelibXml();

    var latlng = new google.maps.LatLng(48.8566140, 2.3522219);

    var option = {
        center: latlng,
        zoom: 13,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

     map = new google.maps.Map(document.getElementById("map"), option);



    $(window).bind("load", parseXml());


    direction = new google.maps.DirectionsRenderer({
        map   : map
    });

    direction.setPanel(document.getElementById('instruction'));

}

function loadvelibXml(){
    $.get('velibXml.php');
    return false;
}

function parseXml(){
    if(window.XMLHttpRequest){
        xmlhttp = new XMLHttpRequest();
    }
    else{
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }


    xmlhttp.open("GET","js/velibCarto.xml",false);
    xmlhttp.send();
    var xmlVelib = xmlhttp.responseXML;



        var markers = xmlVelib.documentElement.getElementsByTagName("marker");

        for(var i= 0; i < markers.length ; i++){
            var name = markers[i].getAttribute("name");
            var station_number = markers[i].getAttribute("number");
            var address = markers[i].getAttribute("fullAddress");
            var point = new google.maps.LatLng(
                parseFloat(markers[i].getAttribute("lat")),
                parseFloat(markers[i].getAttribute("lng")));


            var html = '<div id="box-info">' +
                        '<span>Station ' + name + '</span><br/>' +
                        '<p>' + address +'</p> ' +
                        '<a href="addFavorite.php?name='+name+'&&address='+address+'">Ajouter aux favoris <img src="bootstrap/img/favorite.png" width="20px"> </a> ' +
                        '<a href="index.php?addressBike='+address+'">Point de départ <img src="bootstrap/img/marker.png" width="20px"> </a>';
            /**+
                        '</div>';**/


            var marker = new google.maps.Marker({
                map: map,
                position: point,
                number: station_number,
                html: html,
                icon: iconMarker

            });


            google.maps.event.addListener(marker, 'click', function() {
                parseXmlInfo(this.number);
                ib.open(map,this);
                ib.setContent(this.html+'<p class="number">Vélos disponibles: '+available+'<br/>Emplacements Libres: '+free+'<br/>Nombre d\'emplacement: '+total+'</p>');
                map.setZoom(14);
                map.setCenter(point);

            });

        }


}

function parseXmlInfo(station_number){
    if(window.XMLHttpRequest){
        xmlhttp = new XMLHttpRequest();
    }
    else{
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.open("GET","infoXml.php?station_number="+station_number,false);
    xmlhttp.send();
    var station = JSON.parse(xmlhttp.responseText);

     available = station.available;
     free = station.free;
     total = station.total;

}

calculateDirection = function(){
    origin      = document.getElementById('origin').value;
    destination = document.getElementById('destination').value;
    if(origin && destination){
        var request = {
            origin      : origin,
            destination : destination,
            travelMode  : google.maps.DirectionsTravelMode.DRIVING
        }
        var directionsService = new google.maps.DirectionsService();
        directionsService.route(request, function(response, status){
            if(status == google.maps.DirectionsStatus.OK){
                direction.setDirections(response);
            }
        });
    }
};


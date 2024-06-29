/**
 * Created by sonukumar.singh on 2/8/2017.
 */

// This example requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

//map js to find nighbers

var map;
var infowindow;
var markers = [];
function initMap(value) {


    var pyrmont = {lat: latitude, lng: longitude};

    if (value == 'commute') {

        //for communte map...................................................................................................
        $("#pac-input").css("display", "block");
        $('.map_category').hide();
        $('#commute_category').show();
        $("#near_location").show();


        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 12,
            center: pyrmont,

        });

        addMarker(pyrmont);
        //push new input element on map..................................................................................................
        var input= document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(document.getElementById('pac-input'));
        var autocomplete = new google.maps.places.Autocomplete(input);
        // Set initial restrict to the greater list of countries.
        autocomplete.setComponentRestrictions(
            {'country': ['ec'],radius:500});

        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;

        google.maps.event.addListener(searchBox, 'places_changed', function () {

            //searchBox.set('map', null);
            //clearMarkers(map);


            var places = searchBox.getPlaces();

            var bounds = new google.maps.LatLngBounds();
            var i, place;
            for (i = 0; place = places[i]; i++) {

                (function (place) {

                    var marker = new google.maps.Marker({

                        position: place.geometry.location,

                    });
                    marker.bindTo('map', searchBox, 'map');
                   setTimeout(function(){
                    var infowindow = new google.maps.InfoWindow({
                        content:parseInt($("#distance").val())+"km",
                    });
                    infowindow.open(map, marker);
                   },500);

                    google.maps.event.addListener(marker, 'map_changed', function () {


                        $("#distance_lat").val(place.geometry.location.lat());
                        $("#distance_long").val(place.geometry.location.lng());
                        $("#distance").val(distance($("#distance_lat").val(), $("#distance_long").val(), latitude, longitude, "K"));

                        $("#location_name").val($("#pac-input").val());
                        var location_name = $("#location_name").val();


                        calculateAndDisplayRoute(directionsService, directionsDisplay);

                        directionsDisplay.setMap(map);

                        var onChangeHandler = function () {
                            calculateAndDisplayRoute(directionsService, directionsDisplay);
                        };
                        document.getElementById('pac-input').addEventListener('change', onChangeHandler);
                        /* display map route.................................................................................................. */
                        function calculateAndDisplayRoute(directionsService, directionsDisplay) {

                            directionsService.route({
                                origin: locality,
                                destination: location_name,
                                travelMode: 'DRIVING'
                            }, function (response, status) {
                                if (status === 'OK') {
                                    directionsDisplay.setDirections(response);
                                    infowindow.close();
                                } else {
                                    //console.log('Directions request failed due to long route ' + status);
                                    window.alert('Directions request failed due to long route ' + status);
                                }
                            });
                        }
                        //display map route end.........................................................................

                        //display map route on mouse over end

                        if (!this.getMap()) {
                            this.unbindAll();
                        }
                    });
                    bounds.extend(place.geometry.location);


                }(place));

            }
            map.fitBounds(bounds);
            searchBox.set('map', map);
            map.setZoom(Math.min(map.getZoom(), 12));

        });


    }
    else {

        map = new google.maps.Map(document.getElementById('map'), {
            center: pyrmont,
            zoom: 12
        });


		var icon = {
    url: custom_pointer_of_property, // url
    scaledSize: new google.maps.Size(50, 50), // scaled size
    origin: new google.maps.Point(0,0), // origin
    anchor: new google.maps.Point(0, 0) // anchor
};   
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(latitude, longitude),
            map: map,
            center: pyrmont,
			zIndexProcess:1,
            mapTypeId: 'roadmap',
            icon: icon,
			


        });
        google.maps.event.addListener(marker, 'mouseover', function () {
            //gmarkers.push(marker);
            infowindow.setContent(infoWindowContent);
            infowindow.open(map, this);

        });


        marker.setMap(map);
        infowindow = new google.maps.InfoWindow();
        var service = new google.maps.places.PlacesService(map);


        service.nearbySearch({
            location: pyrmont, radius: 5000, type: [value]
        }, callback);


        //diplay default count of nearby................................

        //restaurant_count
        service.nearbySearch({
            location: pyrmont, radius: 5000, type: ['restaurant']
        }, restaurant_count);

        //hospital_count
        service.nearbySearch({
            location: pyrmont, radius: 5000, type: ['hospital']
        }, hospital_count);

        //atm_count
        service.nearbySearch({
            location: pyrmont, radius: 5000, type: ['atm']
        }, atm_count);

        //shopping_mall_count
        service.nearbySearch({
            location: pyrmont, radius: 5000, type: ['shopping_mall']
        }, shopping_mall_count);

        //shopping_mall_count
        service.nearbySearch({
            location: pyrmont, radius: 5000, type: ['bus_station']
        }, bus_station);




    }


}


//display count of near by bydefault................

function bus_station(results, status)
{
    var html='';
    if (status === google.maps.places.PlacesServiceStatus.OK) {
        for (var i = 0; i < 3; i++) {
                //html += '<li onmouseover="getRoute(this.id)" id="'+results[i].name+'">' + results[i].name + '</li>';
            html += '<li>' + results[i].name + '</li>';
                $('#near_location').append(html);
        }
    }
    var liText = '', liList = $('#near_location li'), listForRemove = [];
    $(liList).each(function () {
        var text = $(this).text();
        if (liText.indexOf('|'+ text + '|') == -1)
            liText += '|'+ text + '|';
        else
            listForRemove.push($(this));

    });
    $(listForRemove).each(function () { $(this).remove(); });

}

function restaurant_count(results, status) {

    total_restaurant = results.length;
    $("#total_restaurant").text(total_restaurant);

}

function hospital_count(results, status) {

    total_hospital = results.length;
    $("#total_hospital").text(total_hospital);

}


function atm_count(results, status) {

    total_atm = results.length;
    $("#total_atm").text(total_atm);

}


function shopping_mall_count(results, status) {

    total_shopping_mall = results.length;
    $("#total_shopping_mall").text(total_shopping_mall);

}


//add commute marker..........................

function addMarker(location) {
    var marker = new google.maps.Marker({
        position: new google.maps.LatLng(latitude, longitude),
        position: location,
        map: map,
        icon: flag,
    });

    markers.push(marker);
    marker.setMap(map);

    var infowindow = new google.maps.InfoWindow({
        content: infoWindowContent
    });

    infowindow.open(map, marker);
}


//nearbymarker.....................
function callback(results, status) {

    total_school = results.length;
    setTotal(total_school);
    //$('#total_school').text(total_school);
    if (status === google.maps.places.PlacesServiceStatus.OK) {
        for (var i = 0; i < results.length; i++) {

            createMarker(results[i]);
        }

    }
}


function createMarker(place) {

    var placeLoc = place.geometry.location;
    var marker = new google.maps.Marker({
        map: map,
        position: place.geometry.location

    });

    markers.push(marker);

    google.maps.event.addListener(marker, 'mouseover', function () {

        var LatOfMarker = this.position.lat();
        var LngOfMarker = this.position.lng();


        infowindow.setContent(place.name);
        infowindow.open(map, this);

    });


}

//clear marker code...........................

function setMapOnAll(map) {
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
    }
}
function clearMarkers() {
    setMapOnAll(null);
}
function deleteMarkers() {
    clearMarkers();
    markers = [];
}


//pages js...............
$(document).ready(function () {
    $('a[href*=#]:not([href=#]):not([href=#show]):not([href=#hide])').click(function () {

        $('.builder_profile_nav li a').removeClass('active');
        $(this).addClass('active');

        if ($(window).width() < 768) {
            $('#mainPage').removeClass('open');
            setTimeout(function () {
                $('#mainPage').removeClass('visible');
            }, 50);
            open = 0;
        }
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html,body').animate({
                    scrollTop: ((target.offset().top) - 100)
                }, 1000);
                return false;
            }
        }
    });

});


//Near search all tabes code...................... 

$(window).load(function () {
    $('#commute_category').hide();
    $('#map_search_type').val("#total_school");
    initMap('school');
    $("#restaurant_map").click(function () {
        $('#map_search_type').val("#total_restaurant")
        initMap('restaurant');
    });

    $("#hospital_map").click(function () {
        $('#map_search_type').val("#total_hospital")
        initMap('hospital');
    });

    $("#atm_map").click(function () {
        $('#map_search_type').val("#total_atm")
        initMap('atm');
    });

    $("#shopping_mall_map").click(function () {
        $('#map_search_type').val("#total_shopping_mall")
        initMap('shopping_mall');
    });

    $("#school_map").click(function () {
        $('#map_search_type').val("#total_school")
        initMap('school');
    });

    $("#commute_map").click(function () {

        deleteMarkers();
        initMap('commute');
    });
    $("#nearby").click(function () {
        $('.map_category').show();
        $('#commute_category').hide();

        $('#map_search_type').val("#total_school")
        initMap('school');
        $("#prashant_testing").html(' <input style="display: none !important;" id="pac-input" class="controls search_box_map" type="text" placeholder="Search Box">');
        $("#prashant_testing").append('<ul id="near_location" style="display: none !important;"></ul>');
    });


});

//set count of total search.................

function setTotal(value) {
    var map_total_id = $('#map_search_type').val();
    $(map_total_id).text(value);
}


function distance(lat1, lon1, lat2, lon2, unit) {
    var radlat1 = Math.PI * lat1 / 180
    var radlat2 = Math.PI * lat2 / 180
    var theta = lon1 - lon2
    var radtheta = Math.PI * theta / 180
    var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
    dist = Math.acos(dist)
    dist = dist * 180 / Math.PI
    dist = dist * 60 * 1.1515
    if (unit == "K") {
        dist = dist * 1.609344
    }
    if (unit == "N") {
        dist = dist * 0.8684
    }
    return dist
}

/*make sub header menu selected*/
 function mark_it(value)
    {
        $(".subhead li a").removeClass('active');
       $("#"+value).addClass('active');
    }
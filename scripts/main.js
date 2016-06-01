
//Map with markers
var map;

//User location
var lat;
var long;

//Default
lat = 51.811994;
long = 4.659263;

//Markers array
var markers = new Array();

$( document ).ready(function() {
    initMap(lat, long);
    //getPosition();
    characterLimit();
    addHeight();
    moveSidebar();
    addTimeColors();
    sortDocs();
    filterTags();
    filterType();
    filterTime();
    linkDoc();
    markerRange();
});

//ToDo: Switch to HTTPS website: HTML5 geolocation is depricated for non https websites. https://developers.google.com/web/updates/2016/04/geolocation-on-secure-contexts-only
////Get user position
//function getPosition(){
//    if (navigator.geolocation) {
//        navigator.geolocation.getCurrentPosition(showPosition);
//
//    } else {
//        //Default values
//        lat = 51.811994;
//        long = 4.659263;
//
//        //Initialize map with default latlong
//        initMap(lat, long);
//    }
//}

//function showPosition(position) {
//    //User location
//    lat = position.coords.latitude;
//    long = position.coords.longitude;
//
//    //Initialize map with user latlong
//    initMap(lat, long);
//}

function initMap(lat, long) {
    // Basic options for a simple Google Map
    // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
    var mapOptions = {
        // How zoomed in you want the map to start at (always required)
        zoom: 16,

        // The latitude and longitude to center the map (always required)
        center: new google.maps.LatLng(lat, long),

        //Custom style
        styles: [	{		"featureType":"landscape",		"stylers":[			{				"hue":"#FFBB00"			},			{				"saturation":43.400000000000006			},			{				"lightness":37.599999999999994			},			{				"gamma":1			}		]	},	{		"featureType":"road.highway",		"stylers":[			{				"hue":"#FFC200"			},			{				"saturation":-61.8			},			{				"lightness":45.599999999999994			},			{				"gamma":1			}		]	},	{		"featureType":"road.arterial",		"stylers":[			{				"hue":"#FF0300"			},			{				"saturation":-100			},			{				"lightness":51.19999999999999			},			{				"gamma":1			}		]	},	{		"featureType":"road.local",		"stylers":[			{				"hue":"#FF0300"			},			{				"saturation":-100			},			{				"lightness":52			},			{				"gamma":1			}		]	},	{		"featureType":"water",		"stylers":[			{				"hue":"#0078FF"			},			{				"saturation":-13.200000000000003			},			{				"lightness":2.4000000000000057			},			{				"gamma":1			}		]	},	{		"featureType":"poi",		"stylers":[			{				"hue":"#00FF6A"			},			{				"saturation":-1.0989010989011234			},			{				"lightness":11.200000000000017			},			{				"gamma":1			}		]	}]
    };

    //Get map element
    var mapElement = document.getElementById('map');

    //Create Google Map
    map = new google.maps.Map(mapElement, mapOptions);

    //Document vars
    var image;
    var marker;

    //Get document
    $('.doc-row[lat]').each(function() {

        //Get attributes
        var id = $(this).attr("id");
        var lat = $(this).attr("lat");
        var long = $(this).attr("long");
        var type = $(this).attr("type");
        var time = $(this).attr("time");
        var tags = $(this).attr("tags");

        //Get title
        var title = $(this).find(".doc-title").text();

        //Type physical
        if(type == "physical") {
            switch(time) {
                case "low":
                    image = './images/Marker_Icon_fysiek_green.png';
                    break;
                case "mid":
                    image = './images/Marker_Icon_fysiek_orange.png';
                    break;
                case "high":
                    image = './images/Marker_Icon_fysiek_red.png';
                    break;
            }
        }
        //Type social
        else if  (type == "social"){
            switch(time) {
                case "low":
                    image = './images/Marker_Icon_sociaal_green';
                    break;
                case "mid":
                    image = './images/Marker_Icon_sociaal_orange';
                    break;
                case "high":
                    image = './images/Marker_Icon_sociaal_red';
                    break;
            }
        }
        //Type money
        else if  (type == "money"){
            switch(time) {
                case "low":
                    image = './images/Marker_Icon_bestuur_green';
                    break;
                case "mid":
                    image = './images/Marker_Icon_bestuur_orange';
                    break;
                case "high":
                    image = './images/Marker_Icon_bestuur_red';
                    break;
            }
        }

        //Create marker
        marker = new google.maps.Marker({
            position: new google.maps.LatLng(lat, long),
            map: map,
            title: title,
            icon: image,
            id: id
        });
        //Set position
        marker.set('lat', lat);
        marker.set('long', long);
        //Set tags
        marker.set('tags', tags);
        //Push marker to array
        markers.push(marker);

        //Scroll to document
        marker.addListener('click', function() {
            $('html, body').animate({
                scrollTop: $('.doc-row[id*="'+id+'"]').offset().top
            }, 2000);
            $('.doc-row[id*="'+id+'"]').find('.doc-block').effect("highlight", {}, 3000);
        });
    });

    //Click document marker
    $('.doc-row a').click(function() {

        //Lat and long attributes
        var lat = $(this).closest('.doc-row').attr('lat');
        var long = $(this).closest('.doc-row').attr('long');

        //Center map
        map.setCenter(new google.maps.LatLng(lat, long));

        //Scroll to top
        $("html,body").animate({ scrollTop: 0 }, "slow");
    });

    //Location search
    $(".btn-loc").click(function(e){
        e.preventDefault();

        var geocoder = new google.maps.Geocoder();
        var address = $(".input-loc").val();

        geocoder.geocode( { 'address': address}, function(results, status) {

            if (status == google.maps.GeocoderStatus.OK) {
                var latitude = results[0].geometry.location.lat();
                var longitude = results[0].geometry.location.lng();
                map.setCenter(new google.maps.LatLng(latitude, longitude));
            }
        });
    });
}

//Limit characters.
function characterLimit(){
    var myTag = $('.document-content').text();
    if (myTag.length > 15) {
        var truncated = myTag.trim().substring(0, 300) + "…";
        $('.document-content').text(truncated);
    }
}

//To center location icon, add height to icon-block.
function addHeight(){
    var height = $('.loc-block').height();
    $('.icon-block').css("height", height + "px");
}

//Move sidebar for mobile users.
function moveSidebar(){
    if ($(window).width() < 992) {
        $(".cont-sidebar").detach().appendTo('.mob-sidebar');

        //Add and remove classes for proper padding placement
        $('.no-padding').removeClass('side-bar');
        $('.mob-sidebar').addClass('side-bar');

        //Make toggle button vertical
        $(".toggle-button").css({"top" : "99.2%", "left"  : "50%", "height" : "35px", "width" : "80px"});
        $(".toggle-button p").removeClass("rotate").css("margin-top", "0px");
        $(".toggle-button button").css({"transition" : "top 0.3s", "top" : "25px"});
    }
    else {
        $(".mob-sidebar").detach().appendTo('.cont-sidebar');
        //Add and remove classes for proper padding placement
        $('.mob-sidebar').removeClass('side-bar');
        $('.no-padding').addClass('side-bar');
    }
}

//Add side colors
function addTimeColors(){
    $('.doc-row[time="low"]').find('.doc-block').css({"border-right-width" : "10px", "border-right-color" : "#31931b" });
    $('.doc-row[time="mid"]').find('.doc-block').css({"border-right-width" : "10px", "border-right-color" : "#c0710b" });
    $('.doc-row[time="high"]').find('.doc-block').css({"border-right-width" : "10px", "border-right-color" : "#bf3e38" });
}

//Sidebar toggle
state = true;
$(document).on('click', '.toggle-button', function() {

    //Mobile
    if ($(window).width() < 992) {
        $(this).toggleClass("toggle-button-selected-vert");
        var sidebarH = $(".side-bar").outerHeight();

        if (state){
            $( ".mob-sidebar" ).animate({ "margin-top": "-="+sidebarH + "px" }, "slow" );
            state = false;
        }
        else {
            $( ".mob-sidebar" ).animate({ "margin-top": "+="+sidebarH+"px" }, "slow" );
            state = true;
        }
    }

    //Desktop
    else {
        $(this).toggleClass('toggle-button-selected');
        var sidebarW = $(".side-bar").outerWidth();
        if (state){
            $(".side-bar").animate({ "left": sidebarW + "px" }, "slow" );
            state = false;
        }
        else {
            $(".side-bar").animate({ "left": "-="+sidebarW+"px" }, "slow" );
            state = true;
        }
    }
});

//Sort documents by date
function sortDocs(){
    //Get all items with date
    var items = $(".doc-row");

    items.each(function() {
        //Convert to date format
        var BCDate = $(this).attr("date").split("-");
        var standardDate = BCDate[1]+" "+BCDate[0]+" "+BCDate[2];
        standardDate = new Date(standardDate).getTime();
        //Add new date format
        $(this).attr("date", standardDate);
    });

    items.sort(function(a,b){
        //Get date attributes
        a = parseFloat($(a).attr("date"));
        b = parseFloat($(b).attr("date"));
        //Sort by date
        return a<b ? -1 : a>b ? 1 : 0;
    }).each(function(){
        //Insert docs sorted by date
        $(this).insertAfter( $( ".doc-content" ) );
    });
}

//Filter by tags
//ToDo: Also filter markers by tags
function filterTags(){
    $(".btn-tags").click(function(e){
        e.preventDefault();

        //Split tag by , in array
        var tags = $(".input-tags").val().replace(/\s+/g,",");

        //Split by comma
        var tagsArray = tags.split(',');

        //Array with booleans if user tag exist in marker tags
        var markerBooleansArray = [];
        //Temp array to split makerBooleansArray
        var tempArr = [];

        //Reset
        $(".doc-row" ).removeClass("showBlock").removeClass("hidden");

        //If empty tag, reset
        if(tags == ""){
            $(".doc-row" ).removeClass("hidden");
        }

        //Filter by tags
        else{

            //FILTER DOCUMENTS
            //Loop through array
            $.each( tagsArray, function( i, val ) {
                //Remove/add documents that contain value specified in tags
                $('.doc-row[tags*="'+val+'"]').addClass("showBlock").removeClass("hidden");
                $(".doc-row" ).not(".showBlock").addClass("hidden");

                //FILTER MARKERS
                for(var i = 0; i < markers.length; i++) {

                    //Get marker tags
                    var tags = markers[i].get("tags");

                    //If marker contains tag, show marker
                    if (tags.indexOf(val) > -1) {

                        //markers[i].setVisible(true);
                        markerBooleansArray.push( {id:i, value: true} );

                        console.log("VISIBLE: Marker tags: " + tags);
                        //console.log("User tag: " + val);
                    }
                    //If marker does not contains tag, hide marker
                    else {
                        //markers[i].setVisible(false);
                        markerBooleansArray.push( {id:i, value: false} );

                        console.log("HIDDEN: Marker tags: " + tags);
                        //console.log("User tag: " + val);
                    }
                }

                //Sort array by ID
                markerBooleansArray.sort(function(a, b) {
                    return parseFloat(a.id) - parseFloat(b.id);
                });

            });


            //If marker contains user tag -> set visible
            //If marker does not contain user tag -> set hidden
            for(var i = 0; i < markers.length;  i++) {
                splitMarkerTags(i);

                //If boolean true (user tag and marker tag match) exists in tempArr, set marker visible
                if($.inArray(true, tempArr) !== -1){
                    markers[i].setVisible(true);
                }

                //If there is no boolean true in tempArr (user tag and marker tag do not match), set marker hidden
                else{
                    markers[i].setVisible(false);
                }

                //Empty temp array
                tempArr = [];
            }

            function splitMarkerTags(id){
                for(var i = 0; i < markerBooleansArray.length; i++){
                    //Select booleans by marker id
                    if(markerBooleansArray[i].id == id){
                        tempArr.push(markerBooleansArray[i].value);
                    }
                }
            }

        }
    });
}

//Filter by type
//ToDo: Also filter markers by type
function filterType(){
    $('#checkbox-physical').click(function(){

        if ($('#checkbox-physical').is(':checked')) {
            $('.doc-row[type*="physical"]').removeClass("hiddenType");
        } else {
            $('.doc-row[type*="physical"]').addClass("hiddenType");
        }
    });

    $('#checkbox-social').click(function(){

        if ($(this).is(':checked')) {
            $('.doc-row[type*="social"]').removeClass("hiddenType");
        } else {
            $('.doc-row[type*="social"]').addClass("hiddenType");
        }
    });

    $('#checkbox-money').click(function(){

        if ($(this).is(':checked')) {
            $('.doc-row[type*="money"]').removeClass("hiddenType");
        } else {
            $('.doc-row[type*="money"]').addClass("hiddenType");
        }
    });
}

//Filter by time
//ToDo: Also filter markers by time
function filterTime(){
    //Filter by <1 year
    $('#checkbox-low').click(function(){
        if ($(this).is(':checked')) {
            $('.doc-row[time*="low"]').removeClass("hiddenTime");
        } else {
            $('.doc-row[time*="low"]').addClass("hiddenTime");
        }
    });

    //Filter by 1-5 year
    $('#checkbox-mid').click(function(){
        if ($(this).is(':checked')) {
            $('.doc-row[time*="mid"]').removeClass("hiddenTime");
        } else {
            $('.doc-row[time*="mid"]').addClass("hiddenTime");
        }
    });

    //Filter by 5+ year
    $('#checkbox-high').click(function(){
        if ($(this).is(':checked')) {
            $('.doc-row[time*="high"]').removeClass("hiddenTime");
        } else {
            $('.doc-row[time*="high"]').addClass("hiddenTime");
        }
    });
}

//Link document to detail page
function linkDoc(){
    $('.btn-more').click(function(e) {
        var id = $(this).closest('.doc-row').attr('id');
        window.location.href = "dossier.html?id=" + id;
    });
}

//Filter amount of markers to show
function markerRange(){
    $('#marker-range').on("change", function() {
        //Range value
        var range = $(this).val();
        //Map center in latlong
        var center = map.getCenter();

        //Change ranger value
        $( "#range-value").empty().append('<h5>' + range + 'km' + '</h5>' );

        //Loop through all markers
        for(var i = 0; i < markers.length; i++) {

            //Latlong of marker
            var latlong = new google.maps.LatLng(markers[i].get('lat'), markers[i].get('long'));

            //Marker distance from center in km
            var distance = google.maps.geometry.spherical.computeDistanceBetween(center, latlong) / 1000;

            //If distance bigger then specified range, hide marker
            if(distance > range) {
                markers[i].setVisible(false);
            }
            //Else show marker
            else {
                markers[i].setVisible(true);
            }
        }
    });
}



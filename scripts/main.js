var map;
$( document ).ready(function() {
   initMap();
    characterLimit();
    addHeight();
    moveSidebar();
    sortDocs();
    filterTags();
    filterType();
});

function initMap() {
    // Basic options for a simple Google Map
    // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
    var mapOptions = {
        // How zoomed in you want the map to start at (always required)
        zoom: 16,

        // The latitude and longitude to center the map (always required)
        center: new google.maps.LatLng(51.811994, 4.659263),

        // How you would like to style the map.
        // This is where you would paste any style found on Snazzy Maps.
        styles: [	{		"featureType":"landscape",		"stylers":[			{				"hue":"#FFBB00"			},			{				"saturation":43.400000000000006			},			{				"lightness":37.599999999999994			},			{				"gamma":1			}		]	},	{		"featureType":"road.highway",		"stylers":[			{				"hue":"#FFC200"			},			{				"saturation":-61.8			},			{				"lightness":45.599999999999994			},			{				"gamma":1			}		]	},	{		"featureType":"road.arterial",		"stylers":[			{				"hue":"#FF0300"			},			{				"saturation":-100			},			{				"lightness":51.19999999999999			},			{				"gamma":1			}		]	},	{		"featureType":"road.local",		"stylers":[			{				"hue":"#FF0300"			},			{				"saturation":-100			},			{				"lightness":52			},			{				"gamma":1			}		]	},	{		"featureType":"water",		"stylers":[			{				"hue":"#0078FF"			},			{				"saturation":-13.200000000000003			},			{				"lightness":2.4000000000000057			},			{				"gamma":1			}		]	},	{		"featureType":"poi",		"stylers":[			{				"hue":"#00FF6A"			},			{				"saturation":-1.0989010989011234			},			{				"lightness":11.200000000000017			},			{				"gamma":1			}		]	}]
    };

    // Get the HTML DOM element that will contain your map
    // We are using a div with id="map" seen below in the <body>
    var mapElement = document.getElementById('map');

    // Create the Google Map using our element and options defined above
    var map = new google.maps.Map(mapElement, mapOptions);

    //Custom image
    var image = './images/Marker_Icon_fysiek_red.png';

    // Let's also add a marker while we're at it
    var marker = new google.maps.Marker({
        position: new google.maps.LatLng(51.811994, 4.659263),
        map: map,
        title: 'Marker!',
        icon: image
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
        jQuery(".cont-sidebar").detach().appendTo('.mob-sidebar');

        //Add and remove classes for proper padding placement
        $('.no-padding').removeClass('side-bar');
        $('.mob-sidebar').addClass('side-bar');

        //Make toggle button vertical
        $(".toggle-button").css({"top" : "97%", "left"  : "50%", "height" : "50px", "width" : "28px"});
        $(".toggle-button button").css({"transition" : "top 0.3s", "top" : "25px"});
    }
    else {
        jQuery(".mob-sidebar").detach().appendTo('.cont-sidebar');

        //Add and remove classes for proper padding placement
        $('.mob-sidebar').removeClass('side-bar');
        $('.no-padding').addClass('side-bar');
    }
}

//Sidebar toggle
state = true;
$(document).on('click', '.toggle-button', function() {

    //Mobile
    if ($(window).width() < 992) {
        $(this).toggleClass("toggle-button-selected-vert");

        if (state){
            $( ".mob-sidebar" ).animate({ "margin-top": "-565px" }, "slow" );
            state = false;
        }
        else {
            $( ".mob-sidebar" ).animate({ "margin-top": "0px" }, "slow" );
            state = true;
        }
    }

    //Desktop
    else {
        $(this).toggleClass('toggle-button-selected');

        if (state){
            $( ".cont-sidebar" ).animate({ "left": "20%" }, "slow" );
            state = false;
        }
        else {
            $( ".cont-sidebar" ).animate({ "left": "-=20%" }, "slow" );
            state = true;
        }
    }
});

//Sort documents by date
function sortDocs(){
        $(".doc-row").sort(function(a,b){
           return new Date($(a).attr("date")) > new Date($(b).attr("date"));
        }).each(function(){
          $(this).insertAfter( $( ".doc-content" ) );
        })
}

function filterTags(){
    $(".btn-tags").click(function(e){
        e.preventDefault();

        //Split tag by , in array.
        var tags = $(".input-tags").val().replace(/\s+/g,",");

        //Split by comma.
        var array = tags.split(',');

        //Reset
        $(".doc-row" ).removeClass("show").removeClass("hidden");

        //Loop through array
        jQuery.each( array, function( i, val ) {

            //Remove/add documents that contain value specified in tags.
            $('.doc-row[tags*="'+val+'"]').addClass("show");
            $(".doc-row" ).not(".show").addClass("hidden");

        });
    });
}

function filterType(){
    $('#checkbox-physical').click(function(){

        if ($('#checkbox-physical').is(':checked')) {
            $('.doc-row[type*="physical"]').removeClass("hidden").addClass("show");
        } else {
            $('.doc-row[type*="physical"]').addClass("hidden");
        }

    });

    $('#checkbox-social').click(function(){

        if ($(this).is(':checked')) {
            $('.doc-row[type*="social"]').removeClass("hidden").addClass("show");
        } else {
            $('.doc-row[type*="social"]').addClass("hidden");
        }

    });

    $('#checkbox-money').click(function(){

        if ($(this).is(':checked')) {
            $('.doc-row[type*="money"]').removeClass("hidden").addClass("show");
        } else {
            $('.doc-row[type*="money"]').addClass("hidden");
        }

    });

    //if ($('#checkbox-physical').is(':checked')) {
    //    console.log("checked");
    //}
}





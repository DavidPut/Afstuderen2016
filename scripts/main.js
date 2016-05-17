var map;
$( document ).ready(function() {
   initMap();
    characterLimit();
    addHeight();
    moveSidebar();
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

        //Remove toggle button
        $( ".toggle-button" ).remove();
    }
    else {
        jQuery(".mob-sidebar").detach().appendTo('.cont-sidebar')
        //Add and remove classes for proper padding placement
        $('.mob-sidebar').removeClass('side-bar');
        $('.no-padding').addClass('side-bar');
    }
}

//Sidebar toggle
state = true;
$(document).on('click', '.toggle-button', function() {

    $(this).toggleClass('toggle-button-selected');

    if (state){
        $( ".cont-sidebar" ).animate({ "left": "20%" }, "slow" );
        state = false;
    }
    else {
        $( ".cont-sidebar" ).animate({ "left": "-=20%" }, "slow" );
        state = true;
    }
});



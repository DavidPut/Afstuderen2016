var map;
$( document ).ready(function() {
    initMap();
    characterLimit();
    addHeight();
    moveSidebar();
    addTimeColors();
    sortDocs();
    filterTags();
    filterType();
    filterTime();
    linkDoc();
});

function initMap() {
    //ToDo: zoom map with user location

    // Basic options for a simple Google Map
    // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
    var mapOptions = {
        // How zoomed in you want the map to start at (always required)
        zoom: 16,

        // The latitude and longitude to center the map (always required)
        center: new google.maps.LatLng(51.811994, 4.659263),

        //Custom style
        styles: [	{		"featureType":"landscape",		"stylers":[			{				"hue":"#FFBB00"			},			{				"saturation":43.400000000000006			},			{				"lightness":37.599999999999994			},			{				"gamma":1			}		]	},	{		"featureType":"road.highway",		"stylers":[			{				"hue":"#FFC200"			},			{				"saturation":-61.8			},			{				"lightness":45.599999999999994			},			{				"gamma":1			}		]	},	{		"featureType":"road.arterial",		"stylers":[			{				"hue":"#FF0300"			},			{				"saturation":-100			},			{				"lightness":51.19999999999999			},			{				"gamma":1			}		]	},	{		"featureType":"road.local",		"stylers":[			{				"hue":"#FF0300"			},			{				"saturation":-100			},			{				"lightness":52			},			{				"gamma":1			}		]	},	{		"featureType":"water",		"stylers":[			{				"hue":"#0078FF"			},			{				"saturation":-13.200000000000003			},			{				"lightness":2.4000000000000057			},			{				"gamma":1			}		]	},	{		"featureType":"poi",		"stylers":[			{				"hue":"#00FF6A"			},			{				"saturation":-1.0989010989011234			},			{				"lightness":11.200000000000017			},			{				"gamma":1			}		]	}]
    };

    //Get map element
    var mapElement = document.getElementById('map');

    //Create Google Map
    var map = new google.maps.Map(mapElement, mapOptions);

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
function filterTags(){
    $(".btn-tags").click(function(e){
        e.preventDefault();

        //Split tag by , in array
        var tags = $(".input-tags").val().replace(/\s+/g,",");

        //Split by comma
        var array = tags.split(',');

        //Reset
        $(".doc-row" ).removeClass("showBlock").removeClass("hidden");

        //If empty tag, reset
        if(tags == ""){
            $(".doc-row" ).removeClass("hidden");
        }

        //Filter by tags
        else{
            //Loop through array
            jQuery.each( array, function( i, val ) {

                //Remove/add documents that contain value specified in tags
                $('.doc-row[tags*="'+val+'"]').addClass("showBlock");
                $(".doc-row" ).not(".showBlock").addClass("hidden");
            });
        }
    });
}

//Filter by type
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




//Map with markers
var map;

//User location
var lat;
var long;

///Default
lat = 51.811994;
long = 4.659263;

//Markers array
var markers = [];

$(document).ready(function() {
    initMap(lat, long);
    //getPosition();
    characterLimit();
    addHeight();
    toggleSidebar();
    moveSidebar();
    addIcons();
    addTimeColors();
    sortDocs();
    filterTags();
    filterType();
    filterTime();
    linkDoc();
    markerRange();
    toolTip();
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
    $('.doc-row[location]').each(function() {

        //Get attributes
        var id = $(this).attr("id");
        var location = $(this).attr("location");

        var type = $(this).attr("type");
        var time = $(this).attr("time");
        var tags = $(this).attr("tags");

        //Get title
        var title = $(this).find(".doc-title").text();



        //Remove spacing from title
        var trimTitle = title.replace(/^\s+|\s+$/gm,'');

        var geocoder = new google.maps.Geocoder();

        //Location to latlong
        geocoder.geocode( { 'address': location}, function(results, status) {

            if (status == google.maps.GeocoderStatus.OK) {

                var mlat = results[0].geometry.location.lat();
                var mlong = results[0].geometry.location.lng();

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
                            image = './images/Marker_Icon_sociaal_green.png';
                            break;
                        case "mid":
                            image = './images/Marker_Icon_sociaal_orange.png';
                            break;
                        case "high":
                            image = './images/Marker_Icon_sociaal_red.png';
                            break;
                    }
                }
                //Type money
                else if  (type == "money"){
                    switch(time) {
                        case "low":
                            image = './images/Marker_Icon_bestuur_green.png';
                            break;
                        case "mid":
                            image = './images/Marker_Icon_bestuur_orange.png';
                            break;
                        case "high":
                            image = './images/Marker_Icon_bestuur_red.png';
                            break;
                    }
                }

                //Create marker
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(mlat, mlong),
                    map: map,
                    title: trimTitle,
                    type: type,
                    time: time,
                    icon: image,
                    id: id
                });

                //Set position
                marker.set('lat', mlat);
                marker.set('long', mlong);
                //Set tags
                marker.set('tags', tags);
                //Set type
                marker.set('type', type);
                //Set time
                marker.set('time', time);
                //Push marker to array
                markers.push(marker);

                //Add infowindow
                var infowindow = new google.maps.InfoWindow({
                    content: trimTitle
                });

                //Scroll to document
                marker.addListener('click', function() {

                    //Open infowindow
                    infowindow.open(map, this);

                    $('html, body').delay(2000).animate({
                        scrollTop: $('.doc-row[id*="'+id+'"]').offset().top
                    },  2000);

                    //If animations are complete
                    $('html, body').promise().done(function(){
                        //Highlight document
                        $('.doc-row[id*="'+id+'"]').find('.doc-block').effect("highlight", {}, 3000);
                    });
                });
            }
        });
    });

    //Click document marker
    $('.doc-row a').click(function() {

        //Location attribute
        var location = $(this).closest('.doc-row').attr('location');

        var geocoder = new google.maps.Geocoder();

        //Location to latlong
        geocoder.geocode( { 'address': location}, function(results, status) {

            if (status == google.maps.GeocoderStatus.OK) {

                //Lat and long vars
                var mlat = results[0].geometry.location.lat();
                var mlong = results[0].geometry.location.lng();

                //Center map
                map.setCenter(new google.maps.LatLng(mlat, mlong));

                //Scroll to top
                $("html,body").animate({ scrollTop: 0 }, "slow");
            }
        });
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

//Limit characters
function characterLimit(){
    $('.document-content').each(function( index ) {
        var myTag = $(this).text();
        if (myTag.length > 80) {
            var truncated = myTag.trim().substring(0, 300) + "…";
            $(this).text(truncated);
        }
    });
}

//To center location icon, add height to icon-block
function addHeight(){
    var height = $('.loc-block').height();
    $('.icon-block').css("height", height + "px");
}

//Move sidebar for mobile users
function moveSidebar(){
    if ($(window).width() < 992) {
        $(".cont-sidebar").detach().appendTo('.mob-sidebar');

        //Add and remove classes for proper padding placement
        $('.no-padding').removeClass('side-bar');
        $('.mob-sidebar').addClass('side-bar');

        //Make toggle button vertical
        $(".toggle-button").css({"top" : "99.2%", "left"  : "1.5%", "height" : "35px", "width" : "97%"});
        $(".toggle-button p").removeClass("rotate").css("margin-top", "0px");
        $(".toggle-button button").css({"transition" : "top 0.3s", "top" : "25px"});
    }
    else {
        $(".mob-sidebar").detach().appendTo('.cont-sidebar');
        //Add and remove classes for proper padding placement
        $('.mob-sidebar').removeClass('side-bar');
        $('.no-padding').addClass('side-bar');

        //Place toggle button outside filter block
        var btnW = $(".toggle-button").outerWidth();
        $(".toggle-button").css({"margin-left": "-" + btnW + "px"});

    }
}

//Add documents icons
function addIcons() {
    //Main icon
    var mainIcon;
    //Location icon
    var locIcon;

    //Get documents
    $('.doc-row').each(function () {

        //Get document attributes
        var type = $(this).attr("type");
        var time = $(this).attr("time");

        //Type physical
        if (type == "physical") {
            //Set main icon
            mainIcon = "./images/Icon_hammer.png";
            //Set location icon
            switch(time) {
                case "low":
                    locIcon = './images/Icon_fysiek_green.png';
                    break;
                case "mid":
                    locIcon = './images/Icon_fysiek_orange.png';
                    break;
                case "high":
                    locIcon = './images/Icon_fysiek_red.png';
                    break;
            }
        }
        //Type social
        else if (type == "social") {
            //Set main icon
            mainIcon = './images/Icon_people.png';
            //Set location icon
            switch(time) {
                case "low":
                    locIcon = './images/Icon_sociaal_green.png';
                    break;
                case "mid":
                    locIcon = './images/Icon_sociaal_orange.png';
                    break;
                case "high":
                    locIcon = './images/Icon_sociaal_red.png';
                    break;
            }
        }
        //Type money
        else if (type == "money") {
            //Set main icon
            mainIcon = './images/Icon_money.png';
            //Set location icon
            switch(time) {
                case "low":
                    locIcon = './Icon_bestuur_green.png';
                    break;
                case "mid":
                    locIcon = './images/Icon_bestuur_orange.png';
                    break;
                case "high":
                    locIcon = './images/Icon_bestuur_red.png';
                    break;
            }
        }

        //Insert main icon
        $(this).find(".icon-document").attr('src', mainIcon);
        //Insert location icon
        $(this).find(".loc-icon").attr('src', locIcon);
    });
}

//Add side colors
function addTimeColors(){
    $('.doc-row[time="low"]').find('.doc-block').css({"border-right-width" : "10px", "border-right-color" : "#31931b" });
    $('.doc-row[time="mid"]').find('.doc-block').css({"border-right-width" : "10px", "border-right-color" : "#c0710b" });
    $('.doc-row[time="high"]').find('.doc-block').css({"border-right-width" : "10px", "border-right-color" : "#bf3e38" });
}

//Sidebar toggle
function toggleSidebar(){

    var state = true;
    var sidebarH = $(".side-bar").outerHeight();

    //Default mobile state closed
    if ($(window).width() < 992) {
        state = false;
        $( ".mob-sidebar" ).css({ "margin-top": "-="+sidebarH + "px" } );
    }

    $(document).on('click', '.toggle-button', function() {
        //Mobile
        if ($(window).width() < 992) {
            $(this).toggleClass("toggle-button-selected-vert");

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
}


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
        var tagsArray = tags.split(',');

        //Array with booleans if user tag exist in marker tags
        var markerBooleansArray = [];
        //Temp array to split makerBooleansArray
        var tempArr = [];

        //Reset documents
        $(".doc-row" ).removeClass("showBlock").removeClass("hidden");

        //Reset markers
        for(var j = 0; j < markers.length; j++) {
            markers[j].setVisible(true);
        }

        //If empty tag, reset
        if(tags == ""){
            //Show documents
            $('.doc-row').removeClass("hidden hiddenRange hiddenType hiddenTime");
            //Reset checkbox filters
            $('input:checkbox').prop('checked', true);
        }

        //Filter by tags
        else{
            //FILTER DOCUMENTS
            //Loop through array
            $.each( tagsArray, function( i, val ) {

                //User input to lowercase
                val = val.toLowerCase();

                //Remove/add documents that contain value specified in tags
                $('.doc-row[tags*="'+val+'"]').addClass("showBlock").removeClass("hidden hiddenType hiddenTime");
                $(".doc-row" ).not(".showBlock").addClass("hidden");

                //FILTER MARKERS
                for(var i = 0; i < markers.length; i++) {

                    //Get marker tags
                    var tags = markers[i].get("tags");
                    //Remove comma from tags
                    tags = tags.replace(',', '');

                    //If marker contains tag, show marker
                    if (tags.indexOf(val) > -1) {
                        markerBooleansArray.push( {id:i, value: true} );
                    }
                    //If marker does not contains tag, hide marker
                    else {
                        markerBooleansArray.push( {id:i, value: false} );
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

//Filter by document type
function filterType(){

    //FILTER DOCUMENTS
    $('#checkbox-physical').click(function(){
        if ($('#checkbox-physical').is(':checked')) {
            $('.doc-row[type*="physical"]').removeClass("hiddenType");
        } else {
            $('.doc-row[type*="physical"]').addClass("hiddenType");
        }
        markerFilter("physical", "");
    });

    $('#checkbox-social').click(function(){
        if ($(this).is(':checked')) {
            $('.doc-row[type*="social"]').removeClass("hiddenType");
        } else {
            $('.doc-row[type*="social"]').addClass("hiddenType");
        }
        markerFilter("social", "");
    });

    $('#checkbox-money').click(function(){
        if ($(this).is(':checked')) {
            $('.doc-row[type*="money"]').removeClass("hiddenType");
        } else {
            $('.doc-row[type*="money"]').addClass("hiddenType");
        }
        markerFilter("money", "");
    });
}

//Filter by document time
function filterTime(){

    //FILTER DOCUMENTS
    //Filter by <1 year
    $('#checkbox-low').click(function(){
        if ($(this).is(':checked')) {
            $('.doc-row[time*="low"]').removeClass("hiddenTime");
            //markerReset("", "low");
        } else {
            $('.doc-row[time*="low"]').addClass("hiddenTime");
            //markerFilterTime("low");
        }
        markerFilter("", "low");
    });

    //Filter by 1-5 year
    $('#checkbox-mid').click(function(){
        if ($(this).is(':checked')) {
            $('.doc-row[time*="mid"]').removeClass("hiddenTime");
            //markerReset("", "mid");
        } else {
            $('.doc-row[time*="mid"]').addClass("hiddenTime");
            //markerFilterTime("mid");
        }
        markerFilter("", "mid");
    });

    //Filter by 5+ year
    $('#checkbox-high').click(function(){
        if ($(this).is(':checked')) {
            $('.doc-row[time*="high"]').removeClass("hiddenTime");
            //markerReset("", "high");
        } else {
            $('.doc-row[time*="high"]').addClass("hiddenTime");
            //markerFilterTime("high");
        }
        markerFilter("", "high");
    });
}

//Filter markers
function markerFilter(mType, mTime){

    //If range is hidden
    if($('.doc-row').hasClass("hiddenRange")){
        //Don't do anything, because marker range is the most important filter
    }

    //Else filter markers
    else{
        //Get all rows with user specified type filter
        $('.doc-row[type*="'+mType+'"]').each(function() {
            //If doc has attr location (meaning it has a marker) and hidden class
            if($(this).attr("location") && $(this).hasClass("hiddenType")){
                //Get document id
                var mId = $(this).attr("id");
                //Loop through markers
                for(var i = 0; i < markers.length; i++) {
                    //If marker id is same as document id
                    if(markers[i].id == mId){
                        //Hide markers (same as document)
                        markers[i].setVisible(false);
                    }
                }
            }

            //If document does not have any hidden classes
            else if($(this).attr("location") && !$(this).hasClass("hiddenType") && !$(this).hasClass("hiddenTime") && !$(this).hasClass("hidden") ){
                //Get document id
                var mId = $(this).attr("id");
                //Loop through markers
                for(var i = 0; i < markers.length; i++) {
                    //If marker id is same as document id
                    if(markers[i].id == mId){
                        //Show markers (same as document)
                        markers[i].setVisible(true);
                    }
                }
            }
        });

        //Get all rows with user specified time filter
        $('.doc-row[time*="'+mTime+'"]').each(function() {
            //If doc has attr location (meaning it has a marker) and has hidden class
            if($(this).attr("location") && $(this).hasClass("hiddenTime")){
                //Get document id
                var mId = $(this).attr("id");
                //Loop through markers
                for(var i = 0; i < markers.length; i++) {
                    //If marker id is same as document id
                    if(markers[i].id == mId){
                        //Hide markers (same as document)
                        markers[i].setVisible(false);
                    }
                }
            }
            //If document does not have any hidden classes
            else if($(this).attr("location") && !$(this).hasClass("hiddenTime") && !$(this).hasClass("hiddenType") && !$(this).hasClass("hidden") ){
                //Get document id
                var mId = $(this).attr("id");
                //Loop through markers
                for(var i = 0; i < markers.length; i++) {
                    //If marker id is same as document id
                    if(markers[i].id == mId){
                        //Show markers (same as document)
                        markers[i].setVisible(true);
                    }
                }
            }
        });
    }
}

//Link document to detail page
function linkDoc(){
    $('.btn-more').click(function(e) {
        var id = $(this).closest('.doc-row').attr('id');
        window.location.href = "dossier.php?id=" + id;
    });
}

//Filter amount of markers to show
function markerRange() {
    $('#marker-range').on("change", function () {
        //Range value
        var range = $(this).val();
        //Map center in latlong
        var center = map.getCenter();

        //Change ranger value
        $("#range-value").empty().append('<h5>' + range + 'km' + '</h5>');

        //Loop through all markers
        for (var i = 0; i < markers.length; i++) {

            //Latlong of marker
            var latlong = new google.maps.LatLng(markers[i].get('lat'), markers[i].get('long'));

            //Marker distance from center in km
            var distance = google.maps.geometry.spherical.computeDistanceBetween(center, latlong) / 1000;

            //Marker id
            var id = markers[i].get("id");

            //If distance bigger then user specified range
            if (distance > range) {
                //Hide document with marker
                $('.doc-row[id*="' + id + '"]').addClass("hiddenRange");
                //Hide marker
                markers[i].setVisible(false);
                //Reset checkbox filters
                $('input:checkbox').prop('checked', true);
            }
            //Reset
            else {
                //Show documents
                $('.doc-row').removeClass("hiddenRange hiddenType hiddenTime hidden");
                //Show markers
                markers[i].setVisible(true);
                //Reset checkbox filters
                $('input:checkbox').prop('checked', true);
                //Empty tag filter
                $('.input-tags').val('');
                //Empty location filter
                $('.input-loc').val('');

            }
        }
    });
}

//Shows information tooltip
function toolTip() {
    $('.fa-info' ).tooltip();

}


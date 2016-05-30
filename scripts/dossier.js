/**
 * Created by David on 18-5-2016.
 */

$(document).ready(function() {
    toggleDossier();
    calendar();
    toggleButton();
    moveSidebar();
    emailAbbo();
    sortDocs();
    toggleTitleDate();
});

//Toggle title and date position
function toggleTitleDate(clickedClass){

    //Class variables
    var titleDateRow;
    var toggleRow;

    //If user has not clicked on toggle button, default status
    if(clickedClass == null) {
        titleDateRow = $(".closed").closest(".content-block").find(".titleDate-row");

        //Loop through all closed documents
        $(titleDateRow).each(function(i, obj) {
            toggleRow =  $(obj).parent().find(".toggle-row");
            //Place title and date next to toggle button
            $(obj).detach().appendTo(toggleRow).removeClass("row");
        });
    }

    //User clicked on toggle button and document is closed
    if($(clickedClass).closest(".content-block").find(".dos-content").hasClass("closed")){
        titleDateRow = $(clickedClass).closest(".content-block").find(".titleDate-row");
        toggleRow =  $(titleDateRow).parent().find(".toggle-row");
        //Place title and date next to toggle button
        $(titleDateRow).detach().appendTo(toggleRow).removeClass("row");
    }

    //User clicked on toggle button and document is open
    else{
        titleDateRow = $(clickedClass).closest(".content-block").find(".titleDate-row");
        toggleRow =  $(titleDateRow).closest(".toggle-row");
        //Place title and date under toggle button
        $(titleDateRow).detach().insertAfter(toggleRow).addClass("row");
    }
}

//Open or close dossier
function toggleDossier(){
    $(".dos-toggle").click(function(e) {
        $(this).closest(".content-block").find('.dos-content').slideToggle("slow", function(){
            $(this).toggleClass("closed");
            //Title and date placement
            toggleTitleDate(e.target);
        });
        //Change toggle image
        $(this).toggleClass("glyphicon-minus glyphicon-plus");
    });
}

//Calender plugin
function calendar(){
    $('#calendar').fullCalendar({

        //When clicked on item in calendar
        eventClick: function(calEvent, jsEvent, view) {
            console.log('Event: ' + calEvent.title);
            console.log('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
            console.log('View: ' + view.name);
        },

        //Header settings
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },

        //Calendar settings
        defaultDate: '2016-05-12',
        editable: true,
        eventLimit: true, // allow "more" link when too many events

        //Calendar items
        events: [
            {
                title: 'All Day Event',
                start: '2016-05-01'
            },
            {
                title: 'Long Event',
                start: '2016-05-07',
                end: '2016-05-10'
            },
            {
                id: 999,
                title: 'Repeating Event',
                start: '2016-05-09T16:00:00'
            },
            {
                id: 999,
                title: 'Repeating Event',
                start: '2016-05-16T16:00:00'
            },
            {
                title: 'Conference',
                start: '2016-05-11',
                end: '2016-05-13'
            },
            {
                title: 'Meeting',
                start: '2016-05-12T10:30:00',
                end: '2016-05-12T12:30:00'
            },
            {
                title: 'Lunch',
                start: '2016-05-12T12:00:00'
            },
            {
                title: 'Meeting',
                start: '2016-05-12T14:30:00'
            },
            {
                title: 'Happy Hour',
                start: '2016-05-12T17:30:00'
            },
            {
                title: 'Dinner',
                start: '2016-05-12T20:00:00'
            },
            {
                title: 'Birthday Party',
                start: '2016-05-13T07:00:00'
            },
            {
                title: 'Click for Google',
                url: 'http://google.com/',
                start: '2016-05-28'
            }
        ],

        //Calendar height
        height: 450
    });

    //Making calendar Bootstrap responsive
    $(".fc-toolbar").addClass("row");
    $(".fc-left").addClass("col-md-6");
    $(".fc-right").addClass("col-md-6");
}

//Toggle button placement
function toggleButton(){
    var sidebarHeight = $(".side-bar").outerHeight();
    $(".toggle-button").css("top", sidebarHeight / 2  + "px");
}

//Move sidebar for mobile users.
function moveSidebar(){
    if ($(window).width() < 992) {
        $(".side-bar").detach().appendTo('.mob-sidebar');

        //Make toggle button vertical
        $(".toggle-button").css({"top" : "99.5%", "left"  : "7%", "height" : "35px", "width" : "97%"});
        $(".toggle-button p").removeClass("rotate").css("margin-top", "0px");
        $(".toggle-button button").css({"transition" : "top 0.3s", "top" : "25px"});
    }
    else {
        $(".mob-sidebar").detach().appendTo('.side-bar');
    }
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

            $( ".side-bar" ).animate({ "left": sidebarW + "px" }, "slow" );
            state = false;
        }
        else {
            $( ".side-bar" ).animate({ "left": "-="+sidebarW+"px" }, "slow" );
            state = true;
        }
    }
});

//Keep updated on dossier changes
//ToDo: Adding email functionality
function emailAbbo(){
    $(".btn-abbo").click(function(e){
        e.preventDefault();
        email = $(".input-abbo").val();
        console.log(email);
    });
}

//Sort documents by date
function sortDocs(){

    //Get all items with date
    var items = $(".dos-doc");

    //Loop through each item with date
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
        //Set documents on default on close
        $(".dos-content").addClass("closed");
    });

    //Set the first document open as default
    $(".dos-content").first().removeClass("closed");
    //Switch image toggle button to open
    $(".dos-content").first().parent().find(".dos-toggle").toggleClass("glyphicon-minus glyphicon-plus");
}
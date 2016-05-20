/**
 * Created by David on 18-5-2016.
 */
$( document ).ready(function() {
    toggleDossier();
});

//open/close dossier
function toggleDossier(){
    $(".dos-toggle").click(function(e) {
        $(this).parent().find('.dos-content').slideToggle( "slow" );
        $(this).toggleClass("glyphicon-minus glyphicon-plus");
    });
}

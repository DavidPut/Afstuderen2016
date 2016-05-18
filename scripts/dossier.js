/**
 * Created by David on 18-5-2016.
 */
$( document ).ready(function() {
    toggleDossier();
});

//open/close dossier
function toggleDossier(){
    //ToDo: toggle fixen
    $(".dos-toggle").click(function(e) {
        $(this).parent().find('.dos-content').toggleClass("hidden", "show");
    });
}

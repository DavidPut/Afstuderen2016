/**
 * Created by David on 18-5-2016.
 */
$( document ).ready(function() {
    toggleDossier();
    linkDetail();
});

//open/close dossier
function toggleDossier(){
    $(".dos-toggle").click(function(e) {
        $(this).parent().find('.dos-content').slideToggle( "slow" );
        $(this).toggleClass("glyphicon-minus glyphicon-plus");
    });
}

//Link document to detail page
function linkDetail(){
    $('.btn-more').click(function(e) {
        var id = $(this).closest('.doss-row').attr('id');
        window.location.href = "detail.html?id=" + id;
    });

}

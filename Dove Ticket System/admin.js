$(document).ready(function(){

    //$('#table_users').dataTable( {
    //    "bPaginate": true,
    //    "bSort": true 
    // } );
    
    $('#table_users').dataTable({
         "oLanguage": {
            "sLengthMenu": "  Ver  _MENU_ registros por pagina",
            "sZeroRecords": "No hay datos para mostrar...",
            "sInfo": "Mostrando _START_ a _END_ de _TOTAL_ registros en total",
            "sInfoEmpty": "Mostrando 0 a 0 de 0 Registros",
            "sInfoFiltered": "(filtered from _MAX_ total records)",
            "sSearch": " Buscar usuarios: ",
            "oPaginate": {
               "sNext": "Siguiente",
               "sPrevious": "Anterior",
              }
        }    

    });

/* Funciona el ejemplo

  var oTable = $('#table_users').dataTable();      
 
  oTable.$('tr').click( function () {
    var data = oTable.fnGetData( this );
    // ... do something with the array / object of data for the row
    alert(data[0]);
  } );

*/
  

    //$("#table_ticket tr:odd td").css("background-color", "#eee");

    //$("#table_ticket tr:even td").css("background-color", "#f6f6f6");

    // Avriguar el indice 
    //$("img").click(function() {
    //    //var i = $(this).index();
    //    //alert('Has clickado sobre el elemento número: '+i);
    //    alert($(this).attr("img"));
    //});

//$("td a").click(function() {
    //$('img').attr("src",function() {
    //    var href=$(this).attr("src");
    //    alert(href);
    //});
//    $('img').attr("src","image/realstate.png");
//});

    $("#triangle-up").click(function(){
        $('html,body').animate({scrollTop: $("body").offset().top}, 'slow');
    });

    $("#triangle-up").mouseenter(function(){
        $("#triangle-up i").stop().animate({"marginTop":"10px"}, 500);
    });

    $("#triangle-up").mouseleave(function(){
        $("#triangle-up i").stop().animate({"marginTop":"15px"}, 500);
    });

    $('html').click(function() {
        $(".new_tickets_alert_box").fadeOut(0);// hide
        $(".new_tickets_alert_box").animate({marginTop: "0"}, 500);
        $(".new_tickets_alert_box").attr("data-flag", "true");
    });

    $('#message').click(function(event){

        var show_hide = $(".new_tickets_alert_box").attr("data-flag");
        if( show_hide == 'true' )
        {
            $('html').click();// For hide dropdown if is show
            event.stopPropagation();
            $(".new_tickets_alert_box").fadeIn(0);
            $(".new_tickets_alert_box").css('opacity', '0');
            $(".new_tickets_alert_box").animate({marginTop: "-11px", opacity: "1"}, 500);
            $(".new_tickets_alert_box").attr("data-flag", "false");
        }
        else
        {
            $(".new_tickets_alert_box").fadeOut(0);
            $(".new_tickets_alert_box").animate({marginTop: "0"}, 500);
            $(".new_tickets_alert_box").attr("data-flag", "true");
        }
    });

    $(".faq-decoration").click( function(){

        var clicked = $(this).attr("href");
        $.each($(".faq-decoration"), function( index, value ) {
            if( $(this).find("i").hasClass("glyphicon-minus") && $(this).attr("href") != clicked ) {
                $(this).find("i").attr("class", "glyphicon glyphicon-plus");
            }
        });

        if( $(this).find("i").hasClass("glyphicon-plus") ) {
            $(this).find("i").attr("class", "glyphicon glyphicon-minus");
        }
        else {
            $(this).find("i").attr("class", "glyphicon glyphicon-plus");
        }
    });
    admin_responsive_checker();
});
var FIREFOX = /Firefox/i.test(navigator.userAgent);
var OPERA = /Opera/i.test(navigator.userAgent);
function admin_responsive_checker()
{
    if ( FIREFOX || navigator.appName == "Microsoft Internet Explorer" || OPERA ) {
        $(".second-navbar-menu li").css( "margin-top", "-11px" );
    }
}
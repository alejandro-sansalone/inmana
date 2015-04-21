$(document).ready( function(){

    flag_enter = '';
    var search_open = false;
    $("#faq-search-btn").click( function(){

        $("#faq-search-btn").blur();
        if( !search_open ) {
            $(".faq-search-box .form-control").show();
            $(".faq-search-box .form-control").animate({ "width": "100%" }, 500, function(){
                $('input#search').focus();
                search_open = true;
            });
        }
        else {
            $(".faq-search-box .form-control").animate({ "width": "0" }, 500, function(){
                $(".faq-search-box .form-control").hide();
                $(".search_results_box").fadeOut();
                $('input#search').blur();
                search_open = false;
            });
        }

    });



    $("#remove-guest-ticket-box").click( function(){
        flag_enter = '';
        $("#guest-ticket-box").animate({"marginTop": "-1000"}, 500, function(){
            $(this).hide();
            $("#page_desc").show();
            $("#page_desc").animate({"marginTop": "0"}, 500);
            $('html,body').animate({scrollTop: $("body").offset().top}, 'slow');
        });
    });

    $('#media').carousel({
        pause: true,
        interval: false
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

    $("#triangle-up").click( function(){
        $('html,body').animate({scrollTop: $("body").offset().top}, 'slow');
    });

    $("#triangle-up").mouseenter( function(){
        $("#triangle-up i").stop().animate({"marginTop":"10px"}, 500);
    });

    $("#triangle-up").mouseleave( function(){
        $("#triangle-up i").stop().animate({"marginTop":"15px"}, 500);
    });

    $('#checkbox_responsive').change(function() {
        if($(this).is(":checked")) {
            $('#checkbox').prop( "checked", true );
        }
        else {
            $('#checkbox').prop( "checked", false );
        }
    });

    responsive_checker();
});
function isIE () {
    var Nav = navigator.userAgent.toLowerCase();
    return (Nav.indexOf('msie') != -1) ? parseInt(Nav.split('msie')[1]) : false;
}
var check_click = true;
var id_now = "";
var isiPad = /ipad/i.test(navigator.userAgent.toLowerCase());
var isiPhone = /iphone/i.test(navigator.userAgent.toLowerCase());
var isiPod = /ipod/i.test(navigator.userAgent.toLowerCase());
var isiDevice = /ipad|iphone|ipod/i.test(navigator.userAgent.toLowerCase());
var isAndroid = /android/i.test(navigator.userAgent.toLowerCase());
var isBlackBerry = /blackberry/i.test(navigator.userAgent.toLowerCase());
var isWebOS = /webos/i.test(navigator.userAgent.toLowerCase());
var isWindowsPhone = /windows phone/i.test(navigator.userAgent.toLowerCase());
if( !isiPad && !isiPhone && !isiPod && !isiDevice && !isAndroid && !isBlackBerry && !isWebOS && !isWindowsPhone ) {
    skrollr.init({
        forceHeight: false
    });
}

var FIREFOX = /Firefox/i.test(navigator.userAgent);
var OPERA = /Opera/i.test(navigator.userAgent);
if ( FIREFOX || navigator.appName == "Microsoft Internet Explorer" || OPERA ) {
    $(".btn-guest").css("margin-top", "-31px");
    $(".btn-guest").css("min-height", "105px");
    $(".guest-ticket").css( "min-height" , "123px" );
    $(".checkbox").css("border", "0");
    $(".faq-search-box").css( "margin-top", "15px" );
    if( isIE() < 10 ) {
        $(".btn-guest").css("margin-right", "33px");
    }
    if( OPERA || FIREFOX ) {
        $(".btn-guest").css("margin-right", "-15px");
    }
}

$(window).resize(function() {
    responsive_checker();
});

function responsive_checker()
{
    if ( FIREFOX || navigator.appName == "Microsoft Internet Explorer" || OPERA ) {

        if ( $(window).width() <= 750)  {
            $(".btn-guest").css("margin-top", "0px");
        }
        else if( $(window).width() < 1182 ) {
            $(".btn-guest").css("margin-top", "-20px");
        }
        else if( $(window).width() < 1100 ) {
            $(".btn-guest").css("margin-top", "-28px");
        }
        else if( $(window).width() < 991 ) {
            $(".btn-guest").css("margin-top", "-20px");
        }
        else if( $(window).width() < 765 ) {
            $(".btn-guest").css("margin-top", "-32px");
        }
        else {
            $(".btn-guest").css("margin-top", "-31px");
        }
        if( navigator.appName == "Microsoft Internet Explorer" ) {
            if( $(window).width() <= 768 ) {
                $(".btn-guest").css("margin-top", "0px");
            }
            else if( $(window).width() < 1200 ) {
                $(".btn-guest").css("margin-top", "-20px");
            }
        }
    }
}

$(".center_navbar").click(function(e)
{
    if(check_click)
    {
        check_click = false;
        id_now = "";
        var department_id = e.target.id;
        var id = "#" + department_id;
        if($(id).hasClass('active'))
        {
            check_click = true;
            return false;
        }
        $(".center_navbar").removeClass('active');
        $(id).addClass('active');

        $("#accordion").html("");
        $("#faq_preloader").show();
        $.post(
            'ajax.php',
            {
                method:"get_department",
                department_id:department_id
            },
            function(data, status)
            {
                if(status == "success")
                {
                    if(data != "error")
                    {
                        $("#faq_preloader").hide();
                        $("#accordion").html(data);
                        check_click = true;
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
                    }

                    $("#faq_preloader").hide();
                    check_click = true;
                }
            }
        );
    }
});

function show_faq(faq_id, scroll)
{
    if(check_click)
    {
        if(id_now == faq_id)
        {
            return false;
        }
        id_now = faq_id;
        check_click = false;
        $("#accordion").html("");
        $("#faq_preloader").show();
        $.post(
            'ajax.php',
            {
                method:"get_faq",
                faq_id:faq_id
            },
            function(data, status)
            {
                if(status == "success")
                {
                    if(data != "error")
                    {
                        $("#faq_preloader").hide();
                        $("#accordion").html(data);
                        check_click = true;
                        $(".center_navbar").removeClass('active');
                        $(".faq-decoration").click( function()
                        {
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
                        $(".faq-decoration").click();

                        if(scroll)
                        {
                            $('html, body').animate({
                                scrollTop: $("#show_result_of_faq").offset().top
                            }, 500);
                            $("#search").val('');
                            $("#search_results_box").fadeOut();
                            $("#faq-search-btn").click();
                        }
                    }
                }

                $("#faq_preloader").hide();
                check_click = true;
            }
        );
    }
}

$("#search").keyup( function(e)
{
    // Set Timeout
    clearTimeout($.data(this, 'timer'));

    // Set Search String
    var search_string = $(this).val();

    // Do Search
    if (search_string == '')
    {
        $("#search_results_box").fadeOut();
    }
    else
    {
        $("#search_results_box").fadeIn();
        $(this).data('timer', setTimeout(search, 100));
    }
});

function search()
{
    var query_value = $('#search').val();
    if(query_value !== '' && check_click)
    {
        check_click = false;
        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: { query: query_value, method:'live_search' },
            cache: false,
            success: function(html){
                $("#results").html(html);
                check_click = true;
            }
        });
    }
    return false;
}


$("#search").focusout(function()
{
    $("#search_results_box").fadeOut();
    $("#search").val('');
});

$(function() {
    if (navigator.appName === "Microsoft Internet Explorer") {
        $("input[type=text]").each(function() {
            var p;
            if (p = $(this).attr('placeholder')) {
                $(this).val(p);
                $(this).focus(function() {
                    if (p === $(this).val()) {
                        return $(this).val('');
                    }
                });
                $(this).blur(function() {
                    if ($(this).val() === '') {
                        return $(this).val(p);
                    }
                });
            }
        });
        $("input[type=email]").each(function() {
            var p;
            if (p = $(this).attr('placeholder')) {
                $(this).val(p);
                $(this).focus(function() {
                    if (p === $(this).val()) {
                        return $(this).val('');
                    }
                });
                $(this).blur(function() {
                    if ($(this).val() === '') {
                        return $(this).val(p);
                    }
                });
            }
        });
        $("input[type=password]").each(function() {
            var e_id, p;
            if (p = $(this).attr('placeholder')) {
                e_id = $(this).attr('id');
                document.getElementById(e_id).type = 'text';
                $(this).val(p);
                $(this).focus(function() {
                    document.getElementById(e_id).type = 'password';
                    if (p === $(this).val()) {
                        return $(this).val('');
                    }
                });
                $(this).blur(function() {
                    if ($(this).val() === '') {
                        document.getElementById(e_id).type = 'text';
                        $(this).val(p);
                    }
                });
            }
        });
        $('form').submit(function() {
            $("input[type=text]").each(function() {
                if ($(this).val() === $(this).attr('placeholder')) {
                    $(this).val('');
                }
            });
            $("input[type=email]").each(function() {
                if ($(this).val() === $(this).attr('placeholder')) {
                    $(this).val('');
                }
            });
            $("input[type=password]").each(function() {
                if ($(this).val() === $(this).attr('placeholder')) {
                    $(this).val('');
                }
            });
        });
    }
});
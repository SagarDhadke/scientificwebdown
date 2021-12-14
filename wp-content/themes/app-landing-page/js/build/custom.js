jQuery(document).ready(function ($) {

    if (app_landing_page_data.ed_scrollbar) {
        $("body").niceScroll({
            cursorcolor: "#5fbd3e",
            zindex: "999999",
            cursorborder: "none",
            cursoropacitymin: "0",
            cursoropacitymax: "1",
            cursorwidth: "8px",
            cursorborderradius: "0px;"
        });
    }

    /* Date Picker */
    $("#datepicker").datepicker();

    var date_in = app_landing_page_data.date;

    $('#days').countdown(date_in, function (event) {
        $(this).html(event.strftime('%D'));
    });
    $('#hours').countdown(date_in, function (event) {
        $(this).html(event.strftime('%H'));
    });
    $('#minutes').countdown(date_in, function (event) {
        $(this).html(event.strftime('%M'));
    });
    $('#seconds').countdown(date_in, function (event) {
        $(this).html(event.strftime('%S'));
    });

    //Event CountDown------------
    new WOW().init();

    //mobile-menu
    var winWidth = $(window).width();

    if (winWidth < 1025) {
        $('.mobile-menu-opener').on( 'click', function () {
            $('body').addClass('menu-open');
            $('#mobile-site-navigation .primary-menu-list').addClass('toggled');
            $('.btn-close-menu').on( 'click', function () {
                $('body').removeClass('menu-open');
                $('#mobile-site-navigation .primary-menu-list').removeClass('toggled');
            });
        });

        $('.overlay').on( 'click', function () {
            $('body').removeClass('menu-open');
            $('#mobile-site-navigation .primary-menu-list').removeClass('toggled');
        });

        // $('.main-navigation').prepend('<div class="btn-close-menu">Close Menu</div>');
        // $('.main-navigation ul .menu-item-has-children').append('<button class="angle-down"></button>');

        // $('.main-navigation ul li .angle-down').click(function(){
        //     $(this).prev().slideToggle();
        //     $(this).toggleClass('active');
        // });
    }


    //ul accessibilty
    
    $('<button class="angle-down"></button>').insertAfter($('.main-navigation.mobile-navigation ul .menu-item-has-children > a'));
    $('.main-navigation.mobile-navigation ul li .angle-down').on( 'click', function () {
        $(this).next().slideToggle();
        $(this).toggleClass('active');
    });
    if (winWidth > 1024) {
        $("#site-navigation ul li a").on( 'focus', function () {
            $(this).parents("li").addClass("focus");
        }).on( 'blur', function () {
            $(this).parents("li").removeClass("focus");
        });
          
    }
    $('.mobile-menu-opener').on( 'click', function () {
        $('body').addClass('menu-open');
        $('#mobile-site-navigation .primary-menu-list').addClass('toggled');
        $('.btn-close-menu').on( 'click', function () {
            $('body').removeClass('menu-open');
            $('#mobile-site-navigation .primary-menu-list').removeClass('toggled');
        });
    });
    // $(window).on('resize', function(){
    //     if ($(window).width() >  1025) {
    //        $('body').removeClass('menu-open')
    //     }
    // });


    $(window).on("load, resize", function() {
        var viewportWidth = $(window).width();
        if (viewportWidth < 1025) {
            $('.overlay').on( 'click', function () {
                $('body').removeClass('menu-open');
                $('#mobile-site-navigation .primary-menu-list').removeClass('toggled');
            });
    
            //ul accessibilty
            
            // $('<button class="angle-down"></button>').insertAfter($('.main-navigation.mobile-navigation ul .menu-item-has-children > a'));
            // $('.main-navigation.mobile-navigation ul li .angle-down').click(function () {
            //     $(this).next().slideToggle();
            //     $(this).toggleClass('active');
            // });

        } else if(viewportWidth >  1025) {
            $('body').removeClass('menu-open');
        }
    });

    
});



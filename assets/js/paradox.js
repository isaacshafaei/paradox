
jQuery(function($){

    // Loading
    if ($('.loadings_container').hasClass('kebrit')) {
            $('.paradox_loading').fadeOut(600, function () {
                $('.paradox_loading').remove();
            });
    }else{
            $('.second_loading').fadeOut(600, function () {
                $('.second_loading').remove();
            });
    }

    /**
     * Back to top
     */
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('#back-to-top').addClass('visible');
        } else {
            $('#back-to-top').removeClass('visible');
        }
    });

    $('#back-to-top').on('click', function (ev) {
        ev.preventDefault();

        $('html,body').animate({scrollTop: '0px'}, 800);
    })

    //Hedaer Fixed Scroll
    $(window).scroll(function(){
        var scroll = $(window).scrollTop();
        if(scroll>= 300){
            $('.stickey_header').addClass('scrolled');
        }else{
            $('.stickey_header').removeClass('scrolled');
        }
    });
    //product and article carousel
    $('.owl-carousel').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        dot:true,
        rtl:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:3
            }
        }
    });
    //download box
	$('.box_button_holder span').on('click', function(){
        $('.box_button_holder span').toggleClass('none-border');
        $('.box_content').slideToggle(400);
    });

    //link report
    $('.link_report').on('click', function(){
        $('.link_report_content').slideToggle(400);
    });

    //header search
    $('.top-bar-search').on('click', function(){
        $('.search_wrapper').toggleClass('display-header-search');
    });

    //close Icon search
    $('.top-bar-search').on('click', function(){
        if ($('.top-bar-search i').hasClass('fa fa-search')) {
                $('.top-bar-search i').removeClass('fa fa-search');
                $('.top-bar-search i').addClass('fa fa-close');    
        }else{
            $('.top-bar-search i').removeClass('fa fa-close');
            $('.top-bar-search i').addClass('fa fa-search');    
        }
    });
    
    //display cart box
    var miniCartOpener = $('.mini_cart');

    miniCartOpener.on('click', function (ev) {

        ev.preventDefault();

        $('.dropdown-cart').toggleClass('visible');
        $('.off-canvas-overlay').toggleClass('side-off-canvas-open');


        if($('.dropdown-cart').hasClass('visible'))
        {
            setTimeout(function()
            {
                $(document).on('click', closeMiniCartClickOutSide);
            }, 1);
        }
        else
        {
            $(document).off('click', closeMiniCartClickOutSide);
        }
    });

    var closeMiniCartClickOutSide = function (ev) {
        if( ! $(ev.target).closest($('.dropdown-cart')).length) {
            $('.dropdown-cart').removeClass('visible');
            $('.off-canvas-overlay').removeClass('side-off-canvas-open');
            $(document).off('click', closeMiniCartClickOutSide);
        }
    }

        /**
         * Login Form Modal
         */
            $('.register-modal-opener').on('click', function (e) {
                e.preventDefault();
                $('.modal').toggleClass('modal-login-open');
                $('.login-form-overlay').toggleClass('display-form-overlay');
            });

            $('.login-form-overlay, .login-form-modal-box .close').on('click', function (e) {
                e.preventDefault();
                $('.modal').removeClass('modal-login-open')
                $('.login-form-overlay').removeClass('display-form-overlay')
            });

        /**
         * DropDown Menu
         */
            $('.button_link').on('click', function() {
                    $('.user-menu__list').toggleClass('user-menu-open');
                    $('.button_link').toggleClass('list-open');
            });

        /**
         * Sticky Sidebar
         */
        if ($('.sticky-sidebar').length > 0) {
            $(".sticky-sidebar").theiaStickySidebar({
                "additionalMarginTop"   : 30,
                "additionalMarginBottom": "0",
                "updateSidebarHeight"   : false,
                "minWidth"              : "768",
                "sidebarBehavior"       : "modern"
            });
        }

        /**
         * Count Down Timer
         */
         $('.counter_number').each(function(){
            $(this).countdown($(this).data('date'), function(event) {
                $(this).html(event.strftime(''
                    + '<div class="counter_column"><span class="num second">%S </span><span class="txt">ثانیه</span></div> '
                    + '<div class="counter_column"><span class="num">%M </span><span class="txt">دقیقه</span></div> '
                    + '<div class="counter_column"><span class="num">%H </span><span class="txt">ساعت</span></div> '
                    + '<div class="counter_column"><span class="num">%-D </span><span class="txt">روز</span></div>'));
            });
        })

        //Toggle course links download
        $('.wcdlar_download_list a.title').on('click',function(event) {
            event.preventDefault();
            $('.wcdlar_download_list').toggleClass('active');
            $('.sub_items').slideToggle(400);
        });

        /**
         * Advice Form Modal
         */
            $('.advice-modal-opener').on('click', function (e) {
                e.preventDefault();
                $('.modal2').toggleClass('modal-open');
            });

            $('.advice-form-overlay, .advice-modal-content .close').on('click', function (e) {
                e.preventDefault();
                $('.modal2').removeClass('modal-open')
            });

        // Hamburger Menu in Mobile
        $('.mobile-nav-toggle').on('click', function(ev) {
            ev.preventDefault();
            $('.off-canvas-navigation').toggleClass('off-canvas-open');
            $('.off-canvas-overlay').toggleClass('off-canvas-open');
            body.toggleClass('off-canvas-open');
        });

        $('.off-canvas-overlay,.off-canvas-navigation .close_btn i').on('click', function(ev) {
            ev.preventDefault();

            $('.off-canvas-navigation').removeClass('off-canvas-open');
            $('.off-canvas-overlay').removeClass('off-canvas-open');
        });

        //Submenu in Mobile
        $( ".off-canvas-navigation ul.sub-menu" ).before( "<i class='sub-menu-arrow fa fa-angle-left'></a>" );
        $( ".off-canvas-navigation .sub-menu-arrow" ).click(function() {
        if($(this).hasClass("fa-angle-left")) {
            $(this).next("ul.sub-menu").show(500);
            $(this).removeClass("fa-angle-left").addClass("fa-angle-down");
        }
        else {
            $(this).next("ul.sub-menu").hide(500);
            $(this).removeClass("fa-angle-down").addClass("fa-angle-left");
        }


    }); 

    // Form Login Switch
    $('#signUp').on('click', function () {
        $('.container_register_login').addClass('right-panel-active');
    });
    $('#signIn').on('click', function () {
        $('.container_register_login').removeClass('right-panel-active');
    });

    // Form Login Switch On Mobile
    $('.register_for_mobile').on('click', function () {
        $('.sign-in-container').removeClass('register_button_for_mobile');
        $('.sign-up-container').addClass('login_button_for_mobile');
    });

    $('.login_for_mobile').on('click', function () {
        $('.sign-in-container').addClass('register_button_for_mobile');
        $('.sign-up-container').removeClass('login_button_for_mobile');
    });

    $('.account-nav-toggle').on('click', function () {
        $('.woocommerce-MyAccount-navigation.mobile').toggleClass('active_on_mobile');
        $('.login-form-overlay').toggleClass('display-form-overlay');
    });
    
    $('.login-form-overlay').on('click', function () {
        $('.woocommerce-MyAccount-navigation.mobile').removeClass('active_on_mobile');
    });
  });//End Jquery
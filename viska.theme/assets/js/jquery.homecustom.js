jQuery(function ($) {
    "use strict";
    //Preloader
    // $(document).ready(
    //     function(){
    setTimeout( function(){
        $('#preloader').fadeOut('slow',function(){$(this).remove();});
    },3200);
    //     }
    // ) 
    /*Matches height*/
    function aweViskaMatchesHeight()
    {
        if ( $().matchHeight )
        {
            $(".awe-services .js-content-item").matchHeight();
            $("#process .js-content-item").matchHeight();
        }
    }

    function mobilecheck() {
        if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
            return false;
        }
        return true;
    }

    $('#button-menu').on("click",function () {
        $('#nav-menu, #nav-menu ul').toggleClass('nav-menu-ef');
        $(this).toggleClass('active');
    });
    $('#close-menu, .menu-nav li a').click(function () {
        $('#nav-menu, #nav-menu ul').removeClass('nav-menu-ef');
        $('#button-menu').removeClass('active');
    });
    function setHeightHome() {
        var heightWindow = $(window).height();
        $('#home').height(heightWindow);
    }
    setHeightHome();
    //======= Slides ==============
    if( $('.slides').length > 0 ) {
        var transition = $('.slides').attr("data-transition");
        var speed = $('.slides').attr("data-speed");
        $('.slides').superslides({
            animation: transition,
            play: speed
        });
    }
    if($("#bg-video").length >0 ){
        $("#bg-video").mb_YTPlayer();
        $('#header-wrap.video').addClass('video-place');
        $('.play-btn').click(function () {
            $('.pause-btn, .volume-btn').fadeIn(600);
            $('.play-btn').fadeOut(600);
            // $()
            var height = $('#home').height();

            $('#home').css('background-image','');
            $('#home').height(height);
        });
        $('.pause-btn').click(function () {
            $('.play-btn').fadeIn(600);
            $('.pause-btn, .volume-btn').fadeOut(600);
            //$('#home').addClass('video-place');
        });
    }
    if($("#owl-banner").length > 0){
        $("#owl-banner").owlCarousel({
            autoPlay: 4000,
            slideSpeed: 4000,
            navigation: false,
            pagination: false,
            singleItem: true,
            transitionStyle: "fade",
            beforeInit: function(elem){
                var base = this;
                var transition = elem.attr("data-transition");
                var speed = elem.attr("data-speed");
                base.options.transitionStyle = transition;
                base.options.slideSpeed = speed;
                base.options.autoPlay = speed;
            }
        });
    }
    if($(".service-slider").length > 0){
        var num_ser = $('.service-slider').attr("data-num");
        $(".service-slider").owlCarousel({
            autoPlay: 10000,
            items: num_ser,
            slideSpeed: 1000,
            navigation: true,
            pagination: false,
            navigationText: ["&#xf104;", "&#xf105;"]
        });
    }

    if($('.awe_magnific_popup').length)
    {
        $('.awe_magnific_popup').magnificPopup({
            type: 'ajax',
            alignTop: true,
            overflowY: 'scroll' ,
            fixedContentPos: false,
            fixedBgPos: false,
            closeBtnInside: true,
            midClick: true,
            removalDelay: 600,
            mainClass: 'awe-mfp-lightbox',
            callbacks: {
                elementParse: function(item) {
                    item.src = item.el.attr('data-url');
                },
                ajaxContentAdded: function() {
                    $(".owl-box").owlCarousel({
                        navigation : true,
                        navigationText : ["", ""],
                        pagination:false,
                        slideSpeed : 300,
                        paginationSpeed : 400,
                        singleItem:true,
                        transitionStyle : "fade",
                        autoHeight : true
                    });
                }
            }
        });
    }

    if($(".idea-slider").length >0){
        var num_idea = $(".idea-slider").attr("data-num");
        $(".idea-slider").owlCarousel({
            autoPlay: 20000,
            items: num_idea,
            slideSpeed: 500,
            navigation: true,
            pagination: false,
            navigationText: ["&#xf104;", "&#xf105;"]
        });
    }
    if($('.skill-slider').length > 0){
        var num_skill = $('.skill-slider').attr("data-num");
        $(".skill-slider").owlCarousel({
            autoPlay: 20000,
            items: num_skill,
            slideSpeed: 500,
            navigation: true,
            pagination: false,
            navigationText: ["&#xf104;", "&#xf105;"]
        });
    }

    if($('.team-slider').length > 0){
        var num_team = $('.team-slider').attr("data-num");
        $(".team-slider").owlCarousel({
            autoPlay: 20000,
            items: num_team,
            slideSpeed: 500,
            navigation: true,
            pagination: false,
            navigationText: ["&#xf104;", "&#xf105;"]
        });
    }
    if($('.pricing-slider').length > 0){
        var num_pri = $('.pricing-slider').attr("data-num");
        $(".pricing-slider").owlCarousel({
            autoPlay: 20000,
            items: num_pri,
            itemsDesktop : [1199,num_pri],
            itemsDesktopSmall : [979,num_pri],
            itemsTablet: [768,num_pri],
            itemsTabletSmall: [600,num_pri],
            slideSpeed: 500,
            navigation: true,
            pagination: false,
            navigationText: ["&#xf104;", "&#xf105;"]
        });
    }

    if($(".client-slider").length > 0){
        var num_client = $(".client-slider").attr("data-num");
        $(".client-slider").owlCarousel({
            autoPlay: 20000,
            items: num_client,
            slideSpeed: 500,
            navigation: true,
            pagination: false,
            navigationText: ["&#xf104;", "&#xf105;"]
        });
    }



    if($("#owl-news").length > 0){
        $("#owl-news").owlCarousel({
            autoPlay: 10000,
            items: 3,
            slideSpeed: 1000,
            navigation: true,
            pagination: false,
            navigationText: ["&#xf104;", "&#xf105;"]
        });
    }

    if($("#owl-twitter").length > 0){
        $("#owl-twitter").owlCarousel({
            autoPlay: 10000,
            slideSpeed: 1000,
            navigation: true,
            pagination: false,
            singleItem: true,
            navigationText: ["&#xf104;", "&#xf105;"],
            transitionStyle: "fade"

        });
    }

    if($("#owl-testimonial").length > 0){
        $("#owl-testimonial").owlCarousel({
            autoPlay: 5000,
            slideSpeed: 1000,
            navigation: true,
            pagination: false,
            singleItem: true,
            navigationText: ["&#xf104;", "&#xf105;"],
            transitionStyle: "fadeUp"
        });
    }
    // SLIDER BLOG LIST
    if($("#owl-blog-list").length > 0){
        $("#owl-blog-list").owlCarousel({
            autoPlay: 4000,
            slideSpeed: 1000,
            navigation: true,
            navigationText: ["", ""],
            pagination: false,
            singleItem: true
        });
    }

    // Funfacts
    $('#funfacts .item p').appear(function () {
        var count_element = $('.countup', this).html();
        $(".countup", this).countTo({
            from: 0,
            to: count_element,
            speed: 2000,
            refreshInterval: 50
        });
    });

    // Nav
    $('#nav-left, #nav-menu, #menu-top').onePageNav({
        currentClass: 'current-page-item',
        changeHash: true
    });


    //Scroll contact
    $(".scroll-contact").click(function(){
        $("html,body").animate({scrollTop:$("#contact").offset().top},"slow");
        return false;
    });
    $(".scroll-down").click(function() {
        var scrollDown = $(this).closest('#home').siblings('#content-sort').children().first();
        $("html,body").animate({
            scrollTop:scrollDown.offset().top
        },"slow");
        return false;
    });
    //Banner fix height
    var dh = $(window).height();
    $('#banner').css('height', dh + 'px');

    //Height join team
    function calculator_height_team() {
        var height_item = $('#team .item').outerHeight(false);
        $('#team .join-team').height(height_item);
    }

    $(window).on('load', function () {
        calculator_height_team();
        aweViskaMatchesHeight();
    });
    calculator_height_team();
    $(window).on('resize', function () {
        calculator_height_team();

        //Banner fix height
        var dh = $(window).height();
        $('#banner').css('height', dh + 'px');

        // if ($(window).height() < $('.menu-nav').height() + 100) {
        //     $('#nav-menu').css('overflow-y', 'scroll');
        // } else {
        //     $('#nav-menu').css('overflow-y', 'visible');
        // }

    });

    // Scroll Top
    $('#scroll-top').click(function () {
        $("html, body").animate({ scrollTop: 0 }, 1000);
    });

    // Sticky
    $("#header").sticky({
        topSpacing: 0,
        className: 'header-sticky',
        wrapperClassName: ''
    }); 

    var colorCode = '#ff2b42';

/* SKill
 --------------------------------------------------------------------- */
    var char_color = $('.chart').attr('data-color');
    switch(char_color){
        case 'color-blue':
            colorCode = '#3498DB';
            break;
        case 'color-red':
            colorCode = '#ff2b42';
            break;
        case 'color-cyan':
            colorCode = '#1ABC9C';
            break;
        case 'color-purple':
            colorCode = '#9B59B6';
            break;               
        case 'color-yellow':
            colorCode = '#F1C40F';
            break;
        case 'color-green':
            colorCode = '#2ECC71';
            break;
        default:
            colorCode = char_color;
            
    }
    $('.chart').appear(function (index, el) {
        $('.chart').easyPieChart({
            barColor: colorCode,
            trackColor: 'rgba(255,225,225,0.5)',
            scaleColor: 'transparent',
            scaleLength: 5,
            lineCap: 'butt',
            lineWidth: 6,
            size: 150,
            rotate: 0,
            easing: 'easeOutBounce',
            delay: 1000,
            animate: {
                duration: 2000,
                enabled: true
            },
            onStep: function(from, to, percent) {
                this.el.children[0].innerHTML = Math.round(percent); 
            }
        });
    });
   
    function parallaxInit() {
        if($('.fullscreen-media.image').length > 0){
            $('.fullscreen-media.image').parallax("50%", 0.3);
        }
        if($('.awe-parallax').length >0)
        {
            $('.awe-parallax').each(function() {
                $(this).parallax("50%", 0.1);
            });
           // $('.about.awe-parallax').parallax("50%", 0.3);
           // $('.services.awe-parallax').parallax("50%", 0.3);
           // $('.team.awe-parallax').parallax("50%", 0.3);
           // $('.skill.awe-parallax').parallax("50%", 0.3);
           // $('.client.awe-parallax').parallax("50%", 0.3);
           // $('.news.awe-parallax').parallax("50%", 0.3);
           // $('.testimonial.awe-parallax').parallax("50%", 0.2);
           // $('.contact.awe-parallax').parallax("50%", 0.3);
        }
    }


    var draggable = true;
    if (mobilecheck()) {
        //Wow js animation
        new WOW().init();
        
    }else{
        draggable = false;
    }

    function splitColumns() {
        var winWidth = $(window).width(),
            columnNumb = 1;
        if (winWidth > 1024) {
            columnNumb = 4;
        } else if (winWidth > 992) {
            columnNumb = 3;
        } else if (winWidth > 479) {
            columnNumb = 2;
        } else if (winWidth < 700) {
            columnNumb = 1;
        }
        return columnNumb;
    }

    function setColumns() {
        var winWidth = $(window).width(),
            columnNumb = splitColumns(),
            postWidth = Math.floor(winWidth / columnNumb);
        $('#work-wrap').find('.work-item').each(function () {
            $(this).css( {
                width : postWidth + 'px'
            });
        });
    }

    function work_isotope(){
        if($('#work-wrap').length > 0){
            $('#work-wrap').isotope({
                animationEngine : 'best-available',
                animationOptions: {
                    duration: 200,
                    queue: false
                },
                cellsByRow: {
                    columnWidth: 200,
                    rowHeight: 150
                },
                layoutMode: 'masonry'
            });
        }

    }

    function setProjects() {
        setColumns();
        work_isotope();
    }

    $(window).on('load', function() {
        
        setProjects();

        $('#filters a').click(function(){
            $('.select-filter').removeClass('select-filter');
            $(this).parent('li').addClass('select-filter');
            var selector = $(this).attr('data-filter');
            $('#work-wrap').isotope({ filter: selector });
            setProjects();
            return false;
        });


        

    });
    $(window).bind('resize', function () {
        setProjects();
    });
    navigator.sayswho= (function(){
        var ua= navigator.userAgent, tem, 
        M= ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || [];
        if(/trident/i.test(M[1])){
            tem=  /\brv[ :]+(\d+)/g.exec(ua) || [];
            return 'IE '+(tem[1] || '');
        }
        if(M[1]=== 'Chrome'){
            tem= ua.match(/\bOPR\/(\d+)/)
            if(tem!= null) return 'Opera '+tem[1];
        }
        M= M[2]? [M[1], M[2]]: [navigator.appName, navigator.appVersion, '-?'];
        if((tem= ua.match(/version\/(\d+)/i))!= null) M.splice(1, 1, tem[1]);
        return M[0];
    })();

    var browser = navigator.sayswho;

    //Background parallax
    // $(window).on('load', function () {
    //     $("#all").click();                    
    // });


    //Nav scroll
    $(window).on('scroll',function () {
        // Nav
        $('#nav-left, #nav-menu, #menu-top').onePageNav({
            currentClass: 'current-page-item'
        });
        //About img
        $('#about .about-img img').css({
            'top': -($(this).scrollTop() / 2) + "px"
        });
    });

    $(window).on('load', function () {
        // if(mobilecheck()){
            parallaxInit();
        // }
    });

    

    // Google Map
    if($(".awe-map").length){
        var options = $(".awe-map").attr("data-options"), 
            map_latitude='45.738028',map_longitude='21.224535',
            map_marker='',
            theading='Viska Studio',
            tcontent='Come here and dring a coffee';
        if(options)
        {
            options = JSON.parse(options);
            map_latitude = options.latitude;
            map_longitude = options.longitude;
            map_marker = options.marker;
            theading = options.tooltip.heading;
            tcontent = options.tooltip.content;
            
        }
        var mapMarker = map_marker;
        // Google Map
        var MY_MAPTYPE_ID = 'custom_style';
        var featureOpts = [

            {    featureType: 'all',  stylers: [{saturation: -100},{gamma: 0.50}  ]}
        ];
        var latlng = new google.maps.LatLng(map_latitude, map_longitude);
        var settings = {
            zoom: 16,
            center: latlng,
            mapTypeControlOptions: {
                mapTypeIds: [google.maps.MapTypeId.ROADMAP, MY_MAPTYPE_ID]
            },
            mapTypeControl: false,
            mapTypeId: MY_MAPTYPE_ID,
            scrollwheel: false,
            draggable: draggable
        };

        var map = new google.maps.Map(document.getElementById("map"), settings);
        var styledMapOptions = {
            name: 'Custom Style'
        };
        var customMapType = new google.maps.StyledMapType(featureOpts, styledMapOptions);

        map.mapTypes.set(MY_MAPTYPE_ID, customMapType);

        google.maps.event.addDomListener(window, "resize", function () {
            var center = map.getCenter();
            google.maps.event.trigger(map, "resize");
            map.setCenter(center);
        });
        var contentString = '<div id="content">' +
            '<div id="siteNotice">' +
            '</div>' +
            '<h3 id="firstHeading" class="firstHeading">'+theading+'</h3>' +
            '<div id="bodyContent">' +
            '<p>'+tcontent+'</p>' +
            '</div>' +
            '</div>';
        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });

        var companyImage = new google.maps.MarkerImage(mapMarker,
            new google.maps.Size(26, 41),
            new google.maps.Point(0, 0),
            new google.maps.Point(35, 20)
        );
        var companyPos = new google.maps.LatLng(map_latitude, map_longitude);
        var companyMarker = new google.maps.Marker({
            position: companyPos,
            map: map,
            icon: companyImage,
            title: theading,
            zIndex: 3
        });
        google.maps.event.addListener(companyMarker, 'click', function () {
            infowindow.open(map, companyMarker);
        });
    }
    
    //});/// ready function
});

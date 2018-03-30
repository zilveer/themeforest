jQuery(document).ready(function($) {
    "use strict";

    var $sticky_header = $('#ABdev_sticky_header');
    var $header = $('body > header');
    $header.css('marginTop', $('html').css('marginTop'));
    $sticky_header.css('marginTop', $('html').css('marginTop'));
    if($sticky_header.length > 0){
        $(document).scroll(function(){
            var header_height = $header.height() + parseInt($('html').css('marginTop'),10) + 3;
            var top = $('#ABdev_sticky_header_content').offset().top - $(document).scrollTop();
            if(top<header_height){
                var diff = top - header_height;
                $header.css('top', diff+'px');
            }
            else{
                $header.css('top', '0');
            }
        });
    }


    // Event Tabs Share Icons
    $('.tcvpb_event_content_meta_share i.ci_icon-share').on('click', function() {
        $(this).parent('.tcvpb_event_content_meta_share').toggleClass('show');
    });


    // Revolution Slider Shape Layer
    function aeron_shape_layer(){
        $('.aeron_shape_layer').closest('.tp-parallax-wrap').addClass('aeron_shape_layer_wrapper');
    }


    function countdown_knob() {
        var timedate = $("#knob_countdown").attr("data-timedate");
        var endDate = new Date(timedate);
        var thisDate  = new Date();
        thisDate  = new Date(thisDate.getFullYear(), thisDate.getMonth() , thisDate.getDay(), thisDate.getHours(), thisDate.getMinutes(), thisDate.getSeconds());
        var daysLeft = parseInt((endDate-thisDate)/86400000, 10);
        var hoursLeft = parseInt((endDate-thisDate)/3600000, 10);
        var minutsLeft = parseInt((endDate-thisDate)/60000, 10);
        var secondsLeft = parseInt((endDate-thisDate)/1000, 10);
        var seconds = minutsLeft*60;
        seconds = secondsLeft-seconds;
        var minutes = hoursLeft*60;
        minutes = minutsLeft-minutes;
        var hours = daysLeft*24;
        hours = (hoursLeft-hours) < 0 ? 0 : hoursLeft-hours;
        var days = daysLeft;
        var old_days = parseInt($("#day").val(), 10);
        var old_hours = parseInt($("#hour").val(), 10);
        var old_minutes = parseInt($("#minute").val(), 10);
        var old_seconds = parseInt($("#second").val(), 10);
        $({value: old_seconds}).animate({value: seconds}, {
            duration: 500,
            easing: 'swing',
            step: function () {
                $("#second").val(Math.ceil(this.value)).trigger('change');
            },
            done: function() {
                $("#second").val(seconds);
            }
        });
        $({value: old_minutes}).animate({value: minutes}, {
            duration: 500,
            easing: 'swing',
            step: function () {
                $("#minute").val(Math.ceil(this.value)).trigger('change');
            },
            complete: function() {
                $("#minute").val(minutes);
            }
        });
        $({value: old_hours}).animate({value: hours}, {
            duration: 500,
            easing: 'swing',
            step: function () {
                $("#hour").val(Math.ceil(this.value)).trigger('change');
            },
            complete: function() {
                $("#hour").val(hours);
            }
        });
        $({value: old_days}).animate({value: days}, {
            duration: 500,
            easing: 'swing',
            step: function () {
                $("#day").val(Math.ceil(this.value)).trigger('change');
            },
            complete: function() {
                $("#day").val(days);
            }
        });
        setTimeout(countdown_knob, 1000);
    }
    $('p:empty').remove();
    $("#knob_countdown").show();
    $(".knob").knob();
    countdown_knob();


    function header_menu_line() {
        $("#magic-line").remove();
        $("#main_menu").append("<li id='magic-line'></li>");
        var $magicLine = $("#magic-line");
        if($magicLine.length > 0){
            var position;
            if(jQuery(".current-menu-ancestor").length > 0){
                position = $(".current-menu-ancestor").position().left + ($(".current-menu-ancestor").width()-70)/2;
            }
            else if(jQuery("#main_menu .current-menu-item").length > 0){
                position = $("#main_menu .current-menu-item").position().left + ($("#main_menu .current-menu-item").width()-70)/2;
            }
            else{
                position=0;
            }
            $magicLine
                .css("left", position)
                .data("origLeft", $magicLine.position().left);
            $("#main_menu > li").hover(function() {
                var position = $(this).position().left + ($(this).width()-70)/2;
                $magicLine.stop().animate({
                    left: position
                }, 300);
            }, function() {
                $magicLine.stop().animate({
                    left: $magicLine.data("origLeft")
                }, 300);
            });
        }
    }
    $(window).load(function() { 
        header_menu_line();
        aeron_shape_layer();
    });


    $('.accordion-group').on('show', function() {
        $(this).find('i').removeClass('icon-plus').addClass('icon-minus');
    });
    $('.accordion-group').on('hide', function() {
        $(this).find('i').removeClass('icon-minus').addClass('icon-plus');
    });


    var $sf = $('#main_menu');
    if ($(window).width()>1191) {
        var menu_height = $sf.outerHeight();
        $('.sf-mega').css('top', menu_height + 'px');
    }

    if($('#ABdev_menu_toggle').css('display') === 'none') {
        // enable superfish when the page first loads if we're on desktop
        $sf.superfish({
            delay:          300,
            animation:      {opacity:'show',height:'show'},
            animationOut:   {height:'hide'},
            speed:          'fast',
            speedOut:       'fast',
            cssArrows:      false,
            disableHI:      true /* load hoverIntent.js in header to use this option */,
            onBeforeShow:   function(){
                var ww = $(window).width();
                if(this.parent().offset() !== undefined){
                    var locUL = this.parent().offset().left + this.width();
                    var locsubUL = this.parent().offset().left + this.parent().width() + this.width();
                    var par = this.parent();
                    if(par.parent().is('#main_menu') && (locUL > ww)){
                        this.css('marginLeft', "-"+(locUL-ww+20)+"px");
                    }
                    else if (!par.parent().is('#main_menu') && (locsubUL > ww)){
                        this.css('left', "-"+(this.width())+"px");
                    }
                }
            }
        });
    }

    var $menu_responsive = $('#aeron_header #main_menu');
    $('#ABdev_menu_toggle').click(function(){
        $menu_responsive.animate({height:'toggle'},350);
    });


    //contact page google maps
    function initialize_gmap() {
        var myLatlng = new google.maps.LatLng(GMapsOptions.lat,GMapsOptions.lng);
        var markerLatlng = new google.maps.LatLng(GMapsOptions.markerLat,GMapsOptions.markerLng);
        var scrollwheel = (GMapsOptions.scrollwheel == 1 ? true : false);
        var mapTypeControl = (GMapsOptions.mapTypeControl == 1 ? true : false);
        var panControl = (GMapsOptions.panControl == 1 ? true : false);
        var zoomControl = (GMapsOptions.zoomControl == 1 ? true : false);
        var scaleControl = (GMapsOptions.scaleControl == 1 ? true : false);
        var map_type = google.maps.MapTypeId.ROADMAP;
        if (GMapsOptions.map_type == 'SATELLITE') map_type = google.maps.MapTypeId.SATELLITE;
        if (GMapsOptions.map_type == 'HYBRID') map_type = google.maps.MapTypeId.HYBRID;
        if (GMapsOptions.map_type == 'TERRAIN') map_type = google.maps.MapTypeId.TERRAIN;
      var mapOptions = {
        zoom: parseInt(GMapsOptions.zoom,10),
        center: myLatlng,
        mapTypeId: map_type,
        scrollwheel: scrollwheel,
        mapTypeControl: mapTypeControl,
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
            position: google.maps.ControlPosition.BOTTOM_CENTER
        },
        panControl: panControl,
        panControlOptions: {
            position: google.maps.ControlPosition.RIGHT_CENTER
        },
        zoomControl: zoomControl,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.LARGE,
            position: google.maps.ControlPosition.RIGHT_CENTER
        },
        scaleControl: scaleControl,
        scaleControlOptions: {
            position: google.maps.ControlPosition.BOTTOM_LEFT
        },
        streetViewControl: false,
        streetViewControlOptions: {
            position: google.maps.ControlPosition.RIGHT_CENTER
        }
      };
      var map = new google.maps.Map(document.getElementById('contact_map'), mapOptions);
      var infowindow = new google.maps.InfoWindow({
          content: GMapsOptions.markerContent
      });
      var marker = new google.maps.Marker({
          position: markerLatlng,
          map: map,
          title: GMapsOptions.markerTitle
      });
      google.maps.event.addListener(marker, 'click', function() {
        infowindow.open(map,marker);
      });
    }
    if($('#contact_map').length > 0){
        google.maps.event.addDomListener(window, 'load', initialize_gmap);
    }


    //contact page google street view
    function initialize_streetview() {
        var clickToGo = (GStreetViewOptions.clickToGo == 1 ? true : false);
        var disableDoubleClickZoom = (GStreetViewOptions.disableDoubleClickZoom == 1 ? true : false);
        var linksControl = (GStreetViewOptions.linksControl == 1 ? true : false);
        var scrollwheel = (GStreetViewOptions.scrollwheel == 1 ? true : false);
        var panControl = (GStreetViewOptions.panControl == 1 ? true : false);
        var zoomControl = (GStreetViewOptions.zoomControl == 1 ? true : false);
        var rotation = (GStreetViewOptions.rotation == 1 ? true : false);

      var fenway = new google.maps.LatLng(GStreetViewOptions.lat,GStreetViewOptions.lng);
      var panoOptions = {
        position: fenway,
        pov: {
            heading: parseInt(GStreetViewOptions.heading, 10), //True north is 0, east is 90, south is 180, west is 270
            pitch: parseInt(GStreetViewOptions.pitch, 10) //The camera pitch in degrees, relative to the street view vehicle. Ranges from 90 (directly upwards) to -90 (directly downwards).
        },
        zoom: parseInt(GStreetViewOptions.zoom, 10),
        clickToGo: clickToGo,
        addressControl: false,
        disableDoubleClickZoom: disableDoubleClickZoom,
        linksControl: linksControl,
        scrollwheel: scrollwheel,
        panControl: panControl,
        panControlOptions: {
          position: google.maps.ControlPosition.RIGHT_CENTER
        },
        zoomControl: zoomControl,
        zoomControlOptions: {
          position: google.maps.ControlPosition.RIGHT_CENTER
        },
      };
      var panorama = new google.maps.StreetViewPanorama(
          document.getElementById('contact_streetview'), panoOptions);
      if(rotation===true){
          window.setInterval(function() {
              var pov = panorama.getPov();
              pov.heading += parseFloat(GStreetViewOptions.rotationStep);
              panorama.setPov(pov);
          }, 50);
        }
    }
    if($('#contact_streetview').length > 0){
        google.maps.event.addDomListener(window, 'load', initialize_streetview);
    }


    $(".submit").click(function () {
        $(this).closest("form").submit();
    });


    $('input, textarea').placeholder();


    $('.overlayed_animated_highlight').find('.overlayed').append("<div class='overlayed_after'></div>");
    var $highlight;
    $('.overlayed_animated_highlight').mouseenter(function(){
        var height;
        height = parseInt($(this).find('h4').css('height'), 10) + parseInt($(this).find('span').css('height'), 10) + 35;
        $highlight = $(this).find('.overlayed_after');
        $highlight.animate({
            height: height+'px'
        },180);
    }).mouseleave(function(){
        $highlight.animate({
            height: '5px'
        },180);
    });


    //Timeline posts

    var $content = $("#timeline_posts");
    var $loader = $("#timeline_loading");
    var itemSelector = ('.timeline_post');

    function timeline_classes(){
        $("#timeline_posts").find('.timeline_post').each(function(){
           var posLeft = $(this).css("left");
           if(posLeft == "0px"){
               $(this).removeClass('timeline_post_right').addClass('timeline_post_left');
           } else{
               $(this).removeClass('timeline_post_left').addClass('timeline_post_right');
           }
        });
    }

    $content.imagesLoaded( function() {
        $content.masonry({
          columnWidth: ".timeline_post_first",
          gutter: 100,
          itemSelector: itemSelector,
        });

        timeline_classes();

    });

    $(window).on('scroll', function () {
        if ($(window).scrollTop() + $(window).height()  >= $(document).height() - $('#dz_main_footer').height()) {
             if(!( $loader.hasClass('timeline_loading_loader') || $loader.hasClass('timeline_no_more_posts'))){
                load_posts();
            }
        }
    });

    var pageNumber = 1;
    var cat = $loader.data('category');

    function load_posts(){
        if (!($loader.hasClass('timeline_loading_loader') || $loader.hasClass('timeline_no_more_posts'))) {
            pageNumber++;
            var str = '&cat=' + cat + '&pageNumber=' + pageNumber + '&action=abdev_get_timeline_posts';
            $.ajax({
                type: "POST",
                dataType: "html",
                url: abdev_timeline_posts.ajaxurl,
                data: str,
                success: function(data){
                    var $data = $(data);
                    if($data.length){
                        var $newElements = $data.css({ opacity: 0 });
                        $content.append( $newElements );
                        $content.imagesLoaded(function(){
                            $loader.removeClass('timeline_loading_loader');
                            $content.masonry( 'appended', $newElements, false );
                            $newElements.animate({ opacity: 1 });
                            timeline_classes();
                        });
                    } else {
                        $loader.addClass('timeline_no_more_posts').html(abdev_timeline_posts.noposts);
                    }
                },
                beforeSend : function(){
                        $loader.addClass('timeline_loading_loader').html('');
                },
                error : function(jqXHR, textStatus, errorThrown) {
                    $loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
                },
                complete : function(){
                    $loader.removeClass('timeline_loading_loader');
                    timeline_classes();
                }
            });
        }
        return false;
    }



    var $isotope_container = $('#portfolio_items');
    $isotope_container.imagesLoaded( function() {
        $isotope_container.isotope({
            itemSelector : '.portfolio_item',
            animationEngine: 'best-available',
        });
        var $optionSets = $('.option-set'),
            $optionLinks = $optionSets.find('a');
        $optionLinks.click(function(){
            var $this = $(this);
            if ( $this.hasClass('selected') ) {
                return false;
            }
            var $optionSet = $this.parents('.option-set');
            $optionSet.find('.selected').removeClass('selected');
            $this.addClass('selected');
            var options = {},
                key = $optionSet.attr('data-option-key'),
                value = $this.attr('data-option-value');
            value = value === 'false' ? false : value;
            options[ key ] = value;
            if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
                changeLayoutMode( $this, options );
            } else {
                $isotope_container.isotope( options );
            }
            return false;
        });
    });


    $(window).resize(function() {
        aeron_shape_layer();
        
        header_menu_line();

        timeline_classes();

        $isotope_container.imagesLoaded( function() {
            $isotope_container.isotope('layout');
        });

        if($('#ABdev_menu_toggle').css('display') === 'none' && !$sf.hasClass('sf-js-enabled')) {
            // you only want SuperFish to be re-enabled once ($sf.hasClass)
            $menu_responsive.show();
            $sf.superfish({
                delay:          300,
                animation:      {opacity:'show',height:'show'},
                animationOut:   {height:'hide'},
                speed:          'fast',
                speedOut:       'fast',
                cssArrows:      false,
                disableHI:      true /* load hoverIntent.js in header to use this option */,
                onBeforeShow:   function(){
                    this.css('marginLeft', "0px");
                    var ww = $(window).width();
                    var locUL = this.parent().offset().left + this.width();
                    var locsubUL = this.parent().offset().left + this.parent().width() + this.width();
                    var par = this.parent();
                    if(par.parent().is('#main_menu') && (locUL > ww)){
                        this.css('marginLeft', "-"+(locUL-ww+20)+"px");
                    }
                    else if (!par.parent().is('#main_menu') && (locsubUL > ww)){
                        this.css('left', "-"+(this.width())+"px");
                    }
                }
            });
        } else if($('#ABdev_menu_toggle').css('display') != 'none' && $sf.hasClass('sf-js-enabled')) {
            // smaller screen, disable SuperFish
            $sf.superfish('destroy');
            $menu_responsive.hide();
            $menu_responsive.find('.sf-mega').css('marginLeft','0');
        }
    });


});
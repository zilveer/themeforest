var bk_playing = 0;
var bk_slidenum = 0;
var bk_vm_uid;
var bk_yt_uid;

$=jQuery;
jQuery(document).ready(function($){
    //Ticker 
    if (ticker.length != 0) {
        $.each( ticker, function( id, config ) {      
            if(config == 'Scroll'){
                scroll_ticker_create('#'+id);
            }else if(config == 'Type'){
                type_ticker_create('#'+id);
            }else if(config == 'Slide'){
                $("#"+id+" ul.ticker").liScroll({travelocity: 0.07});
            }
        });
    }
    //Megamenu
    if (megamenu_carousel_el != null) {
        var bk_megamenu_item;
        $.each( megamenu_carousel_el, function( id, maxitems ) {         
            bk_megamenu_item = $('#'+id).find('.bk-sub-post').length;
            if(bk_megamenu_item > maxitems) {
                $('#'+id).flexslider({
                    animation: "slide",
                    animationLoop: true,
                    slideshow: false,
                    itemWidth: 10,
                    minItems: maxitems,
                    maxItems: maxitems,
                    controlNav: false,
                    directionNav: true,
                    slideshowSpeed: 3000,
                    move: 1,
                    touch: true,
                    useCSS: true,
                });
            }else{
                $('#'+id).removeClass('flexslider');
                $('#'+id).addClass('flexslider_destroy');
            }
        });
    }
    if (fixed_nav == 2) {
        var nav = $('nav.main-nav');
        var d = nav.offset().top;
        $(window).scroll(function () {
            if ($(this).scrollTop() > d) {
                nav.addClass("fixed");
            } else {
                nav.removeClass("fixed");
            }
        });
    }
    $(window).resize(function(){
        if($(this).width() >= 1050 ){
            $('#main-mobile-menu').hide();
        }
    });
    $('.main-nav .mobile').click(function(){
        $(this).siblings('#main-mobile-menu').toggle(300);
    });
    $('.main-nav #main-mobile-menu > ul > li.menu-item-has-children').prepend('<div class="expand"><i class="fa fa-chevron-down"></i></div>');
    $('.expand').click(function(){
        $(this).siblings('.sub-menu').toggle(300); 
    });
    
    $('#main-search .search-icon').click(function(){
        if ($(this).siblings('#s').width() == 0){
            $('#main-search #s').css('width','200px');
            $('#main-search.search-rtl #s').css('padding','5px 5px 5px 50px');
            $('#main-search.search-ltr #s').css('padding','5px 50px 5px 5px');
            $('#main-search #s').css('font-size','18px');  
        } else {
            $('#main-search #s').css('width','0');
            $('#main-search #s').css('padding','0');
            $('#main-search #s').css('font-size','0'); 
        }
        
    });
    
// Post Review
    $(".widget-reviews-tab-titles li").click(function() {
    	$(this).siblings("li").removeClass('active');
    	$(this).addClass("active");
    	$(this).parents(".widget-review-tabs").find(".reviews-tab-content").hide();
    	var selected_tab = $(this).find("a").attr("href");
    	$(this).parents(".widget-review-tabs").find(selected_tab).show();
    	return false;
    });
    
// Masonry Module Init
    $('.bk-masonry-content').imagesLoaded(function(){
        setTimeout(function() {
            $('.bk-masonry-content').masonry({
                itemSelector: '.item',
                columnWidth: 1,
                isAnimated: true,
                isFitWidth: true,
             });
            $('.bk-masonry-content').find('.item').addClass('bordered');    
            $('.bk-masonry-content').find('.post-details').removeClass('hide');
            $('.module-masonry .load-more').addClass('active');
         },500);
    });
// Classic blog module 
        $(".bk-classic-blog-tab-titles li").click(function() {
            $(this).siblings().removeClass('active');
			$(this).addClass("active");
            $(this).parents('.bk-classic-blog-tabs-title-container').siblings('.classic-blog-post').children().css({"top":"-9999999px","position": "absolute"});
			var selected_tab_id = $(this).find("a").attr("href");                  
            $(this).parents('.bk-classic-blog-tabs-title-container').siblings('.classic-blog-post').children(selected_tab_id).css({"position": "static"});                   
			return false;
        });  
        $('.bk-classic-blog-content').imagesLoaded(function(){
            $('.module-classic-blog .load-more').addClass('active');
        });
//Tabs
    $(".bk-masonry-tab-titles li").click(function() {
        $(this).siblings().removeClass('active');
    	$(this).addClass("active");
        $(this).parents('.bk-masonry-tabs-title-container').siblings('.masonry-post').children().css({"top":"-9999999px","position": "absolute"});
    
        var $container = $(this).parents('.bk-masonry-tabs-title-container').siblings('.masonry-post').children().children('.bk-masonry-content');
    	var selected_tab_id = $(this).find("a").attr("href");  
        
        $(this).parents('.bk-masonry-tabs-title-container').siblings('.masonry-post').children(selected_tab_id).css({"position": "static"});
        $container.masonry();                     
    	return false;
    });

//FlexSlider
    
    $(window).load(function() {
        if(bk_flex_el != null){
            $.each( bk_flex_el, function( module_type, module_id ) {
                if( module_type == "carousel") {
                    $(".module-carousel > div").removeClass('bkflex-loading'); 
                    if(module_id.length != 0) {
                        $.each( module_id, function( id, config ) {     
                            $("#"+id).flexslider({
                                animation: "slide",
                                slideshow: config['autoplay'],
                                animationLoop: true,
                                itemWidth: 210,
                                pauseOnHover: true,
                                maxItems: config['maxitem'],
                                directionNav: true,
                                slideshowSpeed: config['speed'],
                                move: 1,
                                controlNav: false,
                                touch: true,
                                useCSS: true,
                            });
                        });
                    }
                }
                else if( module_type == "grid") {
                    if(module_id.length != 0) {
                        $.each( module_id, function( id, value ) {
                            $('#'+id).parents('.grid-container').find('.item').removeClass('invisible');
                            $('#'+id).parents('.grid-container').imagesLoaded(function(){
                                setTimeout(function() {
                                    $('#'+id).parents('.grid-container').masonry({
                                        itemSelector: '.item',
                                        columnWidth: 1,
                                        isAnimated: true,
                                        isFitWidth: true
                                     });
                                 },500);
                            });
                            $('#'+id).flexslider({
                                animation: "fade",
                                controlNav: false,
                                directionNav: true,
                                touch: true,
                                slideshowSpeed: 5000,
                                animationLoop: true,
                                pauseOnHover: true,
                                smoothHeight: true,
                            });
                       });
                    } 
                }
                else if(( module_type == "sidebar_slider") || ( module_type == "category_slider" )){
                    if(module_id.length != 0) {
                        $.each( module_id, function( id, config ) {
                            $("#"+id).flexslider({
                                animation: "fade",
                                controlNav: false,
                                directionNav: true,
                                slideshowSpeed: 8000,
                                smoothHeight: true,
                                pauseOnHover: true,
                                after: function(slider) {                                                      
                                    if (!slider.playing) {
                                        slider.play();
                                    }
                                }
                            });
                        });
                    }
                }
                else if( module_type == "twitter_slider"){
                    if(module_id.length != 0) {
                        $.each( module_id, function( id, config ) {
                            $("#"+id).flexslider({
                                animation: "fade",
                                controlNav: true,
                                directionNav: false,
                                slideshowSpeed: 8000,
                                smoothHeight: true,
                                pauseOnHover: true,
                                after: function(slider) {                                                      
                                    if (!slider.playing) {
                                        slider.play();
                                    }
                                }
                            });
                        });
                    }
                }
                else if( module_type == "main_slider") {
                    $('.module-main-slider .main-slider .post-info').removeClass('overlay'); 
                    if(module_id.length != 0) {
                        $.each( module_id, function( id, config ) {
                            $("#thumb-"+id).flexslider({
                                animation: 'slide',
                                controlNav: false,
                                animationLoop: true,
                                slideshow: false,
                                directionNav: true,
                                itemWidth: 10,
                                itemMargin: 0,
                                maxItems: 5,
                                asNavFor: "#"+id,
                              });				    
                            $("#"+id).flexslider({
                                animation: 'fade',
                                controlNav: false,
                                animationLoop: true,
                                slideshow: true,
                                sync: "#thumb-"+id,
                                slideshowSpeed: 8000,
                                animationSpeed: 600,
                                smoothHeight: true,
                                directionNav: true,
                                after: function(slider) {
                                    if((bk_slidenum != 0) && (bk_playing != 0)){
                                        if(bk_yt_uid != 0){
                                            $("#"+bk_yt_uid).flexslider(parseInt(bk_slidenum));
                                        }else if(bk_vm_uid != 0){
                                            $("#"+bk_vm_uid).flexslider(parseInt(bk_slidenum));
                                        }
                                    }else if ((!slider.playing)&& (bk_playing == 0)) {
                                        slider.play();
                                    }
                                    $("#"+id+" .post-info h2").css("opacity","0");
                                    $("#"+id+" .post-info .post-info-line").css("opacity","0");    
                                }
                            });
                        });
                    }
                }
            });
        }
        //Gallery Script
       $('#bk-carousel-gallery-thumb').flexslider({
            animation: 'slide',
            controlNav: false,
            animationLoop: true,
            slideshow: false,
            directionNav: true,
            itemWidth: 10,
            itemMargin: 0,
            maxItems: 4,
            asNavFor: '#bk-gallery-slider',
          })				    
        $('#bk-gallery-slider').flexslider({
            animation: 'fade',
            controlNav: false,
            animationLoop: true,
            slideshow: true,
            sync: '#bk-carousel-gallery-thumb',
            pauseOnHover: true,
            slideshowSpeed: 5000,
            animationSpeed: 600,
            smoothHeight: true,
            directionNav: true,
        }); 
    });
    // Back top
		$(window).scroll(function () {
			if ($(this).scrollTop() > 500) {
				$('#back-top').css('bottom','0');
			} else {
				$('#back-top').css('bottom','-34px');
			}
		});
        
		// scroll body to top on click
		$('#back-top').click(function () {
			$('body,html').animate({
				scrollTop: 0,
			}, 300);
			return false;
		});

    
    //Tab widget
    $(".widget-tab-titles li").click(function() {	    
		$(this).siblings("li").removeClass('active');
		$(this).addClass("active");
		$(this).parents(".widget-tabs").find(".tab-content").hide();
		var selected_tab = $(this).find("a").attr("href");
		$(this).parents(".widget-tabs").find(selected_tab).show();
		return false;
	});
    
    //Rating canvas
        var canvasArray  = $('.rating-canvas');
        $.each(canvasArray, function(i,canvas){            
            var percent = $(canvas).data('rating');
            var ctx     = canvas.getContext('2d');

            canvas.width  = $(canvas).parent().width();
            canvas.height = $(canvas).parent().height();
            if ($(canvas).parent().hasClass('rating-wrap')) {
                lineWidth = 2;
            } else {
                lineWidth = 4;
            }
  
            var x = (canvas.width) / 2;
            var y = (canvas.height) / 2;
            if ($(canvas).parent().hasClass('rating-wrap')) {
                radius = (canvas.width - 6) / 2;
            } else {
                radius = (canvas.width - 10) / 2;
            }
                    
            var endAngle = (Math.PI * percent * 2 / 100);
            ctx.beginPath();
            ctx.arc(x, y, radius, -(Math.PI/180*90), endAngle - (Math.PI/180*90), false);   
            ctx.lineWidth = lineWidth;
            ctx.strokeStyle = "#fff";
            ctx.stroke();  
        });
        
    //FitVids
    $('.content .article-content').fitVids();
    
});//end main jquery

//Main slider controller
    function convertnumber(number){
        var str = "" + number;
        var pad = "000";
        return (pad.substring(0, pad.length - str.length) + str);        
    }
  // Vimeo API nonsense
  
    var i,j;
    if (mconfig != null) {
        if (mconfig.hasOwnProperty('vm_frame_No')) {
            j= mconfig.vm_frame_No;
        }
    }
    for( i=0;i<j;i++){
        var player = document.getElementById('vmplayer-'+convertnumber(i)+ mconfig.vmslide_array[i]);
        $f(player).addEvent('ready', ready);
    }
    function addEvent(element, eventName, callback) {
        if (element.addEventListener) {
            element.addEventListener(eventName, callback, false)
        } else {
            element.attachEvent(eventName, callback, false);
        }
    }

    function ready(player_id) {
        var froogaloop = $f(player_id);
      
        froogaloop.addEvent('play', function(data) {
            bk_yt_uid = 0;
            bk_playing = 1;
            bk_vm_uid = $("#"+data).parents('.flexslider').attr('id');
            bk_slidenum = data.substring(12);
            $('#'+bk_vm_uid).flexslider("pause");
            $('#thumb-'+bk_vm_uid).css("visibility","hidden");
            $('#'+bk_vm_uid+' .post-info').addClass('hide');
            $('#'+bk_vm_uid+' .flex-prev').addClass('hide');
            $('#'+bk_vm_uid+' .flex-next').addClass('hide');
            setTimeout(function() { 
                $('#'+bk_vm_uid).flexslider(parseInt(bk_slidenum));
            },100);
        });
        froogaloop.addEvent('pause', function(data) {
            bk_playing = 0;
            bk_slidenum = 0;
            bk_vm_uid = $("#"+data).parents('.flexslider').attr('id');

            $('#thumb-'+bk_vm_uid).css("visibility","visible");
            $('#'+bk_vm_uid+' .flex-prev').removeClass('hide');
            $('#'+bk_vm_uid+' .flex-next').removeClass('hide');
            $('#'+bk_vm_uid+' .post-info').removeClass('hide');
            $('#'+bk_vm_uid+' .post-info h2').css("opacity","1");
            $('#'+bk_vm_uid+' .post-info .post-info-line').css("opacity","1");

        });
    }

    // create youtube player
    var player;
    function onYouTubePlayerAPIReady() {
        var i,j = mconfig.yt_frame_No;
            for(i=0;i<j;i++){
                player = new YT.Player('player-'+convertnumber(i)+ mconfig.ytslide_arr[i], {
                  events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange,
                  }
                });
            }
    }
    // autoplay video
    function onPlayerReady(event) {
        event.target.pauseVideo();
    }
    // when video ends
    function onPlayerStateChange(event) {   
        bk_vm_uid = 0;
        iframe_id = event.target.a.id;
        bk_yt_uid = $("#"+iframe_id).parents('.flexslider').attr('id');
        if (event.data == YT.PlayerState.PLAYING) {
            bk_playing = 1;
            bk_slidenum=event.target.a.id.substring(10); 
            
            $('#'+bk_yt_uid).flexslider("pause");
            $('#thumb-'+bk_yt_uid).css("visibility","hidden");
            $('#'+bk_yt_uid+' .post-info').addClass('hide');
            $('#'+bk_yt_uid+' .flex-prev').addClass('hide');
            $('#'+bk_yt_uid+' .flex-next').addClass('hide');
            setTimeout(function() { 
                $('#'+bk_yt_uid).flexslider(parseInt(bk_slidenum));
            },100);
        }
        else if (event.data == YT.PlayerState.PAUSED) {
            bk_playing = 0;
            bk_slidenum = 0;
            $('#thumb-'+bk_yt_uid).css("visibility","visible");
            $('#'+bk_yt_uid+' .flex-prev').removeClass('hide');
            $('#'+bk_yt_uid+' .flex-next').removeClass('hide');
            $('#'+bk_yt_uid+' .post-info').removeClass('hide');
            $('#'+bk_yt_uid+' .post-info h2').css("opacity","1");
            $('#'+bk_yt_uid+' .post-info .post-info-line').css("opacity","1");

        }   
    }

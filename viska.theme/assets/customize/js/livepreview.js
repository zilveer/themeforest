
/**
 * Created by duongle on 5/7/14.
 */
( function( $ ) {
    "use strict";
    var is_add_style=false;

    /************************************************************************************/
    /**** This does not to remove, just change name options for keeping this works fine */
    /************************************************************************************/

    /***************** TYPOGRAPHY *******************/

    wp.customize( 'awe-typography', function( value ) {
        value.bind( function( newval ) {
            $("head style[rel='typography']").remove();
            var style = '';
            var options = JSON.parse(newval);
            if(options.length>0)
                for(var i=0;i<options.length;i++)
                {   //console.log(options[i]);
                    switch(options[i].name){
                        case 'body':
                            style +='body{';
                            style += generate_style(options[i]);
                            style +='}';
                            break;
                        case 'content':
                            style +='.content{';
                            style += generate_style(options[i]);
                            style +='}';
                            break;
                        case 'navbar':
                            style +='#main-menu li a,#menu-top li a,#nav-left ul li a{';
                            style += generate_style(options[i]);
                            style += '}';
                            //console.log("dsadsdsd");
                            break;
                        case 'h1':
                            style +='html .blog-descript h1{';
                            style += generate_style(options[i]);
                            style +='}';
                            break;
                        case 'h2':
                            style +='html .blog-descript h2{';
                            style += generate_style(options[i]);
                            style +='}';
                            break;
                        case 'h3':
                            style +='html .blog-descript h3{';
                            style += generate_style(options[i]);
                            style +='}';
                            break;
                        case 'h4':
                            style +='html .blog-descript h4{';
                            style += generate_style(options[i]);
                            style +='}';
                            break;
                        case 'h5':
                            style +='html .blog-descript h5{';
                            style += generate_style(options[i]);
                            style +='}';
                            break;
                        case 'h6':
                            style +='html .blog-descript h6{';
                            style += generate_style(options[i]);
                            style +='}';
                            break;
                        case 'p':
                            style +='html .blog-descript p{';
                            style += generate_style(options[i]);
                            style +='}';
                            break;
                        case 'logo':
                            style +='.logo{';
                            style += generate_style(options[i]);
                            style +='}';
                            break;
                        case 'slogan':
                            style +='.slogan{';
                            style += generate_style(options[i]);
                            style +='}';
                            break;


                    }

                }


            var newstyle = '<style rel="typography">'+style+'</style>';
            $("head").append(newstyle);
        } );
    } );

    function generate_style(option)
    {
        var style='';
        if(option.font!='' && option.font!=undefined)
            style +='font-family:'+option.font+';';
        if(option.weight!='' && option.weight!=undefined){
            style +='font-weight:'+getFontWeight(option.weight)+';';
            style +='font-style:'+getFontStyle(option.weight)+';';

        }
        if(option.size!='' && option.size!=undefined)
            style +='font-size:'+option.size+'px;';
        if(option.transform!='' && option.transform!=undefined)
            style +='text-transform:'+option.transform+';';
        if(option.color!='' && option.color!=undefined)
            style +='color:'+option.color+';';
        if(option.lineheight!='' && option.lineheight!=undefined)
            style +='line-height:'+option.lineheight+"px";
        return style;
    }

    function getFontStyle(fw){
        var italic =["i1","i2","i3","i4","i5","i6","i7","i8","i9","100italic","200italic","300italic","400italic","500italic","600italic","700italic","800italic","900italic"]
        return italic.indexOf(fw) != -1 ? "italic" : "normal";
    }
    function getFontWeight(fw)
    {
        var fontExpands = {
            "n1": "100",
            "i1": "100",
            "n2": "200",
            "i2": "200",
            "n3": "300",
            "i3": "300",
            "n4": "400",
            "i4": "400",
            "n5": "500",
            "i5": "500",
            "n6": "600",
            "i6": "600",
            "n7": "700",
            "i7": "700",
            "n8": "800",
            "i8": "800",
            "n9": "900",
            "i9": "900",
            "100": "100",
            "100italic": "100",
            "200": "200",
            "200italic": "200",
            "300": "300",
            "300italic": "300",
            "400": "400",
            "400italic": "400",
            "500": "500",
            "500italic": "500",
            "600": "600",
            "600italic": "600",
            "700": "700",
            "700italic": "700",
            "800": "800",
            "800italic": "800",
            "900": "900",
            "900italic": "900",
            "": "400"
        }
        return fontExpands[fw] != undefined ? fontExpands[fw] : "400";
    }
    /** END TYPOGRAPHY **/

    /* LOGO & SLOGAN */
    wp.customize( 'awe-logo', function( value ) {
        value.bind( function( newval ) {

            var options = JSON.parse(newval);
            console.log(options);
            var a = $('.logo').find('.logo-image');
            a.find("img").attr("src",options.image);
            if(options.image_height!=''){
                a.css("height",options.image_height);
            }
            if(options.image_width!= ''){
                a.css("width",options.image_width);
            }
            
        } );
    } );
    
    wp.customize('wm_options[logo_stickey][image]',function(value){
        value.bind(function(newval){
            var a = $('.logo').find('.logo-image-sticky');
            a.find('img').attr("src",newval);
        });
    });

    wp.customize('wm_options[logo_stickey][image_width]',function(value){
        value.bind(function(newval){
            var a = $('.logo').find('.logo-image-sticky');
            a.css("width",newval+'px');
        });
    });

    wp.customize('wm_options[logo_stickey][image_height]',function(value){
        value.bind(function(newval){
            var a = $('.logo').find('.logo-image-sticky');
            a.css("height",newval+'px');
        });
    });
    /* site link <- This info get from awe-customize */
    wp.customize( 'wm_options[typography][site-link][color]', function( value ) {
        value.bind( function( newval ) {
            $(".blog-descript").find('a').css("color",newval);
        } );
    } );

    wp.customize( 'wm_options[typography][site-link][color-hover]', function( value ) {
        value.bind( function( newval ) {
            $(".blog-descript a:hover").css("color",newval);
        } );
    } );

    /* footer script */
    wp.customize( 'wm_options[footer][copyright]', function( value ) {
        value.bind( function( newval ) {
            console.log(newval);
            $("#footer .site-info").html(newval);
        } );
    } );

    wp.customize( 'wm_options[footer][remove]', function( value ) {
        value.bind( function( newval ) {
           if(newval==true)
                $("#footer .site-info").hide();
           else
               $("#footer .site-info").show();

        } );
    } );

    /* SOCIAL */
    wp.customize( 'awe-social', function( value ) {
        value.bind( function( newval ) {
            
            var twitter_icons = {
                'fa fa-facebook'  : 'fa fa-facebook',
                'fa fa-google-plus'    :  'fa fa-google-plus',
                'fa fa-twitter'   :  'fa fa-twitter',
                'fa fa-github'    :  'fa fa-github',
                'fa fa-instagram' :  'fa fa-instagram',
                'fa fa-pinterest' :  'fa fa-pinterest',
                'fa fa-linkedin-square'  :  'fa fa-linkedin',
                'fa fa-skype'     :  'fa fa-skype',
                'fa fa-tumblr'    :  'fa fa-tumblr',
                'fa fa-youtube'   :  'fa fa-youtube-square',
                'fa fa-vimeo-square'     :  'fa fa-vimeo-square',
                'fa fa-flickr'    :  'a fa-flickr',
                'fa fa-dribbble'  :  'fa af-dribbble'
            };
            var options = JSON.parse(newval);
            console.log(options);

            var html = '';
            if(options.length>0){
                var display = options[0].display;
                if(options.length>1)
                    for(var i=1;i<options.length;i++)
                    {
                        if(options[i].href!='' && options[i].href!=undefined && options[i].show=='on')
                            html +='<a class="wow fadeInLeft" data-wow-delay=".4s" href="'+options[i].href+'"><i class="awe-icon '+twitter_icons[options[i].icon]+'"></i></a>';
                    }
                if(display=='off')
                {
                    $(".share").html();
                }
                if(html!='' && display=='on')
                {
                    $(".share").html(html);
                }

            }

        } );
    } );

    /****** END ******/

    /************************** Style color *********************************/
    wp.customize( 'wm_options[extra][style_color]', function( value ) {
        value.bind( function( newval ) {
            console.log(newval);
            $("head style[rel='custom-color']").remove();
            var style ='<link rel="alternate stylesheet" type="text/css" href="'+template_uri+'/assets/css/colors/blue.css" title="color-blue" media="screen" />';
            style +='<link rel="alternate stylesheet" type="text/css" href="'+template_uri+'/assets/css/colors/cyan.css" title="color-cyan" media="screen" />';
            style +='<link rel="alternate stylesheet" type="text/css" href="'+template_uri+'/assets/css/colors/green.css" title="color-green" media="screen" />';
            style +='<link rel="alternate stylesheet" type="text/css" href="'+template_uri+'/assets/css/colors/purple.css" title="color-purple" media="screen" />';
            style +='<link rel="alternate stylesheet" type="text/css" href="'+template_uri+'/assets/css/colors/red.css" title="color-red" media="screen" />';
            style +='<link rel="alternate stylesheet" type="text/css" href="'+template_uri+'/assets/css/colors/yellow.css" title="color-yellow" media="screen" />';
            if(is_add_style==false){
                $("head").append(style);
                is_add_style = true;
            }

            $("link[rel*=style][title]").each(function () {
                this.disabled = true;
                if(this.getAttribute("title") == newval) this.disabled = false;
            });
            var colorCode ='';
            switch(newval){
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
                    colorCode = '#ff2b42';
                    
            }
            //$('.chart').appear(function (index, el) {
            $('.chart').each(function(){
                if ($(this).data('easyPieChart')) {
                    $(this).data('easyPieChart').changecolor(colorCode);
                }else{
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
                            $(this.el).find('.percent').text(Math.round(percent));
                        }
                    });

                }
            });
            //});
        } );

    } );

    wp.customize( 'wm_options[extra][skin]', function( value ) {
        value.bind( function( newval ) {
            $("body").removeClass("dark");
            if(newval=='dark')
                $("body").addClass("dark");
        } );

    } );

    wp.customize( 'wm_options[extra][footer_skin]', function( value ) {
        value.bind( function( newval ) {
            $("#footer-wrap").removeClass("dark");
            if(newval=='dark')
                $("#footer-wrap").addClass("dark");
        } );

    } );

    /************************** Custom color *********************************/
    wp.customize( 'wm_options[extra][style_color_custom]', function( value ) {
        value.bind( function( newval ) {
            $("link[rel*=style][title]").each(function () {
                $(this).disabled = true;
                //if(this.getAttribute("title") == newval) this.disabled = false;
            });
            $("link[rel*=style][id='awe-color-css']").remove();
            console.log($("link[rel*=style][id='awe-color-css']"));
            change_style_color(newval);
        } );

    } );

    function hex2rbga(hex,opacity){
        hex = hex.replace('#','');
        var r = parseInt(hex.substring(0,2), 16);
        var g = parseInt(hex.substring(2,4), 16);
        var b = parseInt(hex.substring(4,6), 16);

        var result = 'rgba('+r+','+g+','+b+','+opacity/100+')';
        return result;
    }

    function change_style_color(color)
    {
        $("head style[rel='custom-color']").remove();
        var newstyle = '<style rel="custom-color">#button-menu:hover,.header-sticky #button-menu:hover{-webkit-text-shadow:-29px 0 0 #000,0 0 0 '+color+';-moz-text-shadow:-29px 0 0 #000,0 0 0 '+color+';-ms-text-shadow:-29px 0 0 #000,0 0 0 '+color+';-o-text-shadow:-29px 0 0 #000,0 0 0 '+color+';text-shadow:-29px 0 0 #000,0 0 0 '+color+'}.menu li.current-page-item a,.menu li:hover a,.awe-works #filters ul li.select-filter a,.awe-works #filters ul li:hover a,.awe-process .item:hover .awe-icon,.awe-process .item:hover h2,.awe-twitter .item p a,.awe-twitter .item h2,.owl-buttons div:hover,.awe-news .item ul li.wish .awe-icon,.awe-news .item h2 a:hover,.awe-testimonial .item h2,.ajaxpage h4,.blog-title h2 a:hover,.nextProject .awe-icon:hover,.prevProject .awe-icon:hover,.awe-contact .contact-info div p b a:hover,.closeProject a:hover .awe-icon,.reply-comment,.blog-item .blog-quote span,ul.ul-category li a:hover,.recent-post ul.ul-category li a:hover,.blog-item h2 a span{color:'+color+'}.awe-news .owl-buttons div:hover,#owl-services .item a:hover,.awe-testimonial .owl-buttons div:hover,.awe-twitter .owl-buttons div:hover,#owl-services .owl-controls .owl-buttons div:hover,#nav-left ul li.current-page-item,#nav-left ul li:hover,.awe-teams .item:hover,.awe-works #filters ul li.select-filter,.awe-works #filters ul li:hover,.owl-buttons div:hover,.footer #scroll-top,.blog-item .blog-quote,.blog-leave-reply button:hover{border-color:'+color+'}#nav-left ul li a:before{border-right-color:'+color+'}.awe-process .item:hover .hr:after{border-top-color:'+color+'}.home-content h3,#nav-left ul li a:after,.awe-button,.funfacts,.awe-funfacts,.awe-teams .join-team,.awe-twitter .awe-icon,.awe-pricing .item .price,.awe-pricing .item:hover .sign-up a,.awe-news .item .image .share,.awe-testimonial .awe-icon,.blog-title .fa,#owl-blog-list .owl-buttons div:hover,.blog-leave-reply button:hover,.footer #scroll-top{background-color:'+color+'}.awe-teams .item .img .content,.work-wrap .work-item .caption{background-color: '+hex2rbga(color,85)+'}#preloader .circle-ef{border-left-color:'+color+'}.blog-item .blog-read-more:hover,#ajaxpage .detail-pj ul li .list-tt a.link:hover{background-color:'+color+';color:#fff;border-color:'+color+'}.blog-grid.blog-item .blog-link:hover,.blog-grid.blog-item .blog-link:hover .fa{border-color:'+color+'}.blog-grid.blog-item .blog-link:hover p,.blog-grid.blog-item .blog-link:hover .fa{color:'+color+'}#loadmore a{background-color:'+color+'}#funfacts{background-color:'+color+'}</style>';
        var colorCode = color;
        $('.chart').each(function(){
                if ($(this).data('easyPieChart')) {
                    $(this).data('easyPieChart').changecolor(colorCode);
                }else{
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
                            $(this.el).find('.percent').text(Math.round(percent));
                        }
                    });

                }
            });        
        $("head").append(newstyle);
    }
    
    wp.customize( 'wm_options[logo][image]' ,function(value){
        value.bind(function(newval){
            console.log(newval);
        $('.logo a').css("background","url("+newval+")");    
        })
        
    });
    wp.customize( 'wm_options[logo][image_height]', function(value){
        value.bind(function(newval){
            console.log(newval);
            $('.logo a').css("height",newval);
        });
    });
    wp.customize( 'wm_options[logo][image_width]', function(value){
        value.bind(function(newval){
            console.log(newval);
            $('.logo a').css("width",newval);
        });
    });
    /************************** Introduction Info *********************************/
    wp.customize( 'wm_options[extra][intro_data]', function( value ) {
        value.bind( function( newval ) {
            if($('.livepreview-home').length){
                // console.log(newval);
                var options = JSON.parse(decodeURIComponent(newval));
                var logo_html='',title_html='',slogan_html='',button_html='',links_html='';

                
                if(options.logo.enable)
                    $('h1.logo').css("display","block");
                else $('h1.logo').css("display","none");

                if(options.title.enable)
                    title_html = '<h2 class="intro-title">'+options.title.text+'</h2>';

                if(options.slogan.enable)
                {
                    $('.js-slide-content').css("display","block");
                    if(options.slogan.type=='slider')
                    {
                        var data = $('#owl-banner').find('.owl-wrapper-outer');
                        if( data.length ) {
                            $("#owl-banner").data('owlCarousel').destroy();
                        }else{
                            $('.js-slide-content').attr("id","owl-banner");
                        }
                        //$('.js-slide-content').css("display","block");
                        $('.js-slide-content').find('.item').each(function(){$(this).remove(); });
                        var items = '';
                        for(var i=0;i< options.slogan.slider_text.length; i++){
                            items += '<div class="item"><h2>'+options.slogan.slider_text[i]+'</h2></div>';
                        }
                        $('.js-slide-content').append(items);
                        $("#owl-banner").owlCarousel({
                            autoPlay: options.slogan.speed,
                            slideSpeed: options.slogan.speed,
                            navigation: false,
                            pagination: false,
                            singleItem: true,
                            transitionStyle: options.slogan.transition
                        });
                        
                    }else{

                        var data = $('#owl-banner').find('.owl-wrapper-outer');
                        if(data.length) $("#owl-banner").data('owlCarousel').destroy();
                        $('.js-slide-content').attr("id","");
                        var i = 1;
                        $('.js-slide-content').find('.item').each(function(){
                            if(i>1) $(this).remove(); 
                            i++;
                        });
                        $('.js-slide-content').find("h2").text(options.slogan.static_text);
                    }// end slider content

                }else{
                    var data = $('#owl-banner').find('.owl-wrapper-outer');
                    if( data.length ) {
                        $("#owl-banner").data('owlCarousel').destroy();
                    }
                    $('.js-slide-content').css("display","none");
                }
                //====== end slogan ===============//
                //====== title ===============//

                if(options.button.enable)
                {
                    $('.js-intro-desc').css("display","inline-block");
                    $('.js-intro-desc').text(options.button.text);
                }else{
                    $('.js-intro-desc').css("display","none");
                }

            }
        } );// end bind data
    } );

    //=================== Blog Header livepreview =====================//
    wp.customize( 'wm_options[extra][blog_data]', function( value ) {
        value.bind( function( newval ) {
            if($('.blog-home').length){
                console.log(newval);
                var options = JSON.parse(decodeURIComponent(newval));
                var logo_html='',title_html='',slogan_html='',button_html='',links_html='';

                if(options.title.enable)
                    title_html = '<h2 class="intro-title">'+options.title.text+'</h2>';

                if(options.slogan.enable)
                {
                    $('.js-slide-content').css("display","block");
                    if(options.slogan.type=='slider')
                    {
                        var data = $('#owl-banner').find('.owl-wrapper-outer');
                        if( data.length ) {
                            $("#owl-banner").data('owlCarousel').destroy();
                        }else{
                            $('.js-slide-content').attr("id","owl-banner");
                        }
                        //$('.js-slide-content').css("display","block");
                        $('.js-slide-content').find('.item').each(function(){$(this).remove(); });
                        var items = '';
                        for(var i=0;i< options.slogan.slider_text.length; i++){
                            items += '<div class="item"><h2>'+options.slogan.slider_text[i]+'</h2></div>';
                        }
                        $('.js-slide-content').append(items);
                        $("#owl-banner").owlCarousel({
                            autoPlay: options.slogan.speed,
                            slideSpeed: options.slogan.speed,
                            navigation: false,
                            pagination: false,
                            singleItem: true,
                            transitionStyle: options.slogan.transition
                        });
                        
                    }else{

                        var data = $('#owl-banner').find('.owl-wrapper-outer');
                        if(data.length) $("#owl-banner").data('owlCarousel').destroy();
                        $('.js-slide-content').attr("id","");
                        var i = 1;
                        $('.js-slide-content').find('.item').each(function(){
                            if(i>1) $(this).remove(); 
                            i++;
                        });
                        $('.js-slide-content').find("h2").text(options.slogan.static_text);
                    }// end slider content

                }else{
                    var data = $('#owl-banner').find('.owl-wrapper-outer');
                    if( data.length ) {
                        $("#owl-banner").data('owlCarousel').destroy();
                    }
                    $('.js-slide-content').css("display","none");
                }
                //====== end slogan ===============//
                //====== title ===============//

                if(options.button.enable)
                {
                    $('.js-intro-desc').css("display","inline-block");
                    $('.js-intro-desc').text(options.button.text);
                }else{
                    $('.js-intro-desc').css("display","none");
                }

            }
        } );// end bind data
    } );
    /************************* Overlay Customize **************************************/

    function customize_overlay(session,value){
        //console.log(value.overlay);
        //var overlay = '<div class="awe-overlay-bg js-overlay-intro"></div>';
        var tranparent_type = value.overlay.type;
        if(value.overlay.enable == "1"){
            var style = "";
            for(var i=0;i< tranparent_type.length;++i){
                if(tranparent_type[i] == 'color'){
                    style += 'background-color: '+value.overlay.color+';';
                }
                if(tranparent_type[i] == 'pattern'){
                    style += 'background-image: url('+value.overlay.pattern+');';
                }
            }
        if(session.find('.awe-overlay-bg').length) $(session).find('.awe-overlay-bg').remove();
        var overlay = '<div class="awe-overlay-bg js-overlay-intro" style="'+style+'"></div>';
            session.append(overlay);
            
        }else{  
            session.find('.awe-overlay-bg').remove();
        }
        
    }// end customize_overlay



//console.log("dsadas");
    /************************** Introduction Background *********************************/



    wp.customize( 'wm_options[extra][intro_bg_data]', function( value ) {
        value.bind( function( newval ) {
            if($('.livepreview-home').length){
                console.log("home");
                var options = JSON.parse(decodeURIComponent(newval));
                var media = $("#home").find(".fullscreen-media");
                var home = $('#home-content');
                switch(options.type){
                    case 'video':
                        $('#home').removeAttr("style");
                        // if($('#home').find('.play-btn').length){
                        //     $('#home').find('.play-btn').fadeIn();
                        // }
                        var url = options.video.url;
                        console.log(url);
                        var autoPlay = options.video.autoplay;
                        var loop = options.video.loop;
                        var mute = options.video.mute;
                        var placeholder = options.video.placeholder;
                        var video = '<div class="fullscreen-media video">';
                        video += '<div id="bg-video" class="fullscreen-video" data-property="{videoURL:\''+url+'\',containment:\'.fullscreen-media\', showControls:false, autoPlay:'+autoPlay+', loop:'+loop+', mute:'+mute+', startAt:0, opacity:1, addRaster:false, quality:\'default\'}"></div>';
                        video += '</div>';
                        media.remove();
                        $(video).insertAfter(home);
                        if(autoPlay){
                            $('#home').attr('style','');
                            $('.play-btn').fadeOut(600);
                            $('.pause-btn, .volume-btn').fadeIn(600);
                        }
                        var button_play = '<a class="play-btn"><span class="fa fa-play"></span></a>';
                        if(placeholder){
                            $('#home').css("background-image","url("+options.video.video_place_holder+")");    
                            //$('#home-content').append(button_play);
                            $('.play-btn').fadeIn(600);
                            $(document).on("click",'.play-btn',function(){
                                $('#home').find('#bg-video').playYTP();
                                $('#home').attr('style','');
                                $(this).fadeOut();
                                $('.pause-btn, .volume-btn').fadeIn(600);
                            });
                        }
                        
                        console.log(options.video.placeholder);
                        $('.fullscreen-media').find('#bg-video').mb_YTPlayer();
                        break;
                    case 'slider':
                        $('#home').removeAttr("style");
                        if($('#home').find('.play-btn').length){
                            $('#home').find('.play-btn').fadeOut();
                        }
                        var silder = '<div class="fullscreen-media slides">';
                            silder += '<div class="slides-container">';
                        var img = options.slider.images;
                        for(var index = 0;index < img.length; ++index){
                            silder += '<img src="'+img[index]+'" >';
                        }
                        silder += '</div></div>';
                        media.remove();
                        $(silder).insertAfter(home);
                        $('.slides').superslides({
                            animation: options.slider.transition,
                            play: options.slider.speed,
                        });
                        //console.log(silder);
                        break;
                    case 'static':
                        $('#home').removeAttr("style");
                        if($('#home').find('.play-btn').length){
                            $('#home').find('.play-btn').fadeOut();
                        }
                        var url = options.static.image;
                        var image = '<div class="fullscreen-media" style="background-image: url('+url+') ">';
                        image += '</div>';
                        media.remove();                                                                         
                        $(image).insertAfter(home);
                        break;
                    case 'color':
                        if($('#home').find('.play-btn').length){
                            $('#home').find('.play-btn').fadeOut();
                        }
                        media.remove();
                        $('#home').css("background-color",options.color);
                        break;

                }
                customize_overlay($('#home'),options);
            }
        } );
    } );
    wp.customize( 'wm_options[extra][team][content][join]', function( value ){
        value.bind(function(newval){
            console.log(newval);
            if(newval){
                $('.join-team').parent().fadeIn();
            }else{
                $('.join-team').parent().fadeOut();
            }
        });
    });
    wp.customize( 'wm_options[extra][blog_bg]', function( value ) {
        value.bind( function( newval ) {
            if($('.blog-home').length){
                console.log("home blog");
                var options = JSON.parse(decodeURIComponent(newval));
                var media = $(".blog-home").find(".fullscreen-media");
                var home = $('#home-content');
                switch(options.type){
                    case 'static':
                        $('#blog-banner').removeAttr("style");
                        var url = options.static.image;
                        $('#blog-banner').css('background-image','url('+url+')');
                        break;
                    case 'color':
                        media.remove();
                        $('.blog-home').css("background-color",options.color);
                        //console.log(options.color);
                        break;

                }
                customize_overlay($('.blog-home'),options);
            }

        } );
    } );


    /************************** Navigation ******************************/
    wp.customize( 'wm_options[extra][nav_style]', function( value ) {
        value.bind( function( newval ) {
            $("#navigation").attr("class","navigation");
            $("#navigation").addClass(newval);
        } );
    });

    /************************** Section Settings *************************/
    /* About display */

    wp.customize('wm_options[extra][about][footer][enable]', function(value){
        value.bind(function(newval){
            if(newval==1)
            $('.js-about-button').css("display","inline-block");
            else $('.js-about-button').css("display","none");    
        });
        
    });
    wp.customize('wm_options[extra][about][footer][button][enable]', function(value){
        value.bind(function(newval){
            if(newval==1)
            $('.js-about-button').css("display","inline-block");
            else $('.js-about-button').css("display","none");    
        });
        
    });

    wp.customize('wm_options[extra][about][footer][button][text]', function(value){
        value.bind(function(newval){
            $('.js-about-button').text(newval);   
        });  
    });

    wp.customize('wm_options[extra][about][footer][button][link]', function(value){
        value.bind(function(newval){
            $('.js-about-button').attr("href",newval);   
        });  
    });

    section_settings('about','#about');
    section_settings('skill','#skill');
    section_settings('team','#team');
    section_settings('funfact','#funfacts');
    section_settings('idea','#process');
    section_settings('portfolio','#work');
    section_settings('client','#client');
    section_settings('map','#map');
    section_settings('testimonial','#testimonial');
    section_settings('twitter','#twitter');
    section_settings('service','#services');
    section_settings('pricing','#plans');
    section_settings('lastedpost','#news');
    section_settings('address','#contact');
    section_settings('contact','#awe-contact');
    function section_settings(section_name,section_id){
        wp.customize( 'wm_options[extra]['+section_name+'][show]', function( value ) {
            value.bind( function( newval ) {
                var $getOffset = 0;
                if(newval==true)
                {
                    $(section_id).show();
                    if ( $(section_id).length>0 )
                    {
                        $getOffset = $(section_id).offset().top;
                        $(window).scrollTop($getOffset);
                    }
                }
                else
                {
                    $(section_id).hide();
                }
            } );
        });
        /* Header Enable */
        if(section_name=='about'){
            wp.customize( 'wm_options[extra]['+section_name+'][header][enable]', function( value ) {
                value.bind( function( newval ) {
                    if(newval==1){
                        $(section_id+" .js-header").removeAttr("style");
                        $(section_id+" .js-header").addClass('wow');
                    }
                    else{
                        $(section_id+" .js-header").removeClass('wow');
                        $(section_id+" .js-header").fadeOut();
                    }

                } );
            } );
        }else{
            wp.customize( 'wm_options[extra]['+section_name+'][header][enable]', function( value ) {
                value.bind( function( newval ) {
                    if(newval==1){
                        $(section_id+" .awe-header").parent().removeAttr("style");
                        // $(section_id+" .awe-header").addClass('wow');
                    }
                    else{
                        
                        $(section_id+" .awe-header").parent().fadeOut();
                    }

                } );
            } );
        }
        /* Header Style */
        wp.customize( 'wm_options[extra]['+section_name+'][header][style]', function( value ) {
            value.bind( function( newval ) {
                $(section_id+" .awe-header").find("h2").attr("class","awe-header js-title "+newval);

            } );
        } );
        /* Skin */
        wp.customize( 'wm_options[extra]['+section_name+'][skin]', function( value ) {
            value.bind( function( newval ) {
                $(section_id).removeClass("dark");
                if(newval=='dark')
                    $(section_id).addClass("dark");
            } );

        } );
        /* Title */
        wp.customize( 'wm_options[extra]['+section_name+'][header][title]', function( value ) {
            value.bind( function( newval ) {
                switch (section_id){
                    case '#awe-idea':
                        $(section_id+' .title').html(newval);
                        break;
                    case '#awe-subscribe':
                        $(section_id+' .sub-title').html(newval);
                        break;
                    default :
                        $(section_id+' .awe-header .js-title').html(newval);
                }

            } );
        } );

        /* SubTitle*/
        wp.customize( 'wm_options[extra]['+section_name+'][header][subtitle][enable]', function( value ) {
            value.bind( function( newval ) {
                if(newval){
                    $(section_id+' .awe-header .js-desc').removeAttr("style");
                }else{
                    $(section_id+' .awe-header .js-desc').fadeOut();
                }
            } );
        } );

        wp.customize( 'wm_options[extra]['+section_name+'][header][subtitle][text]', function( value ) {
            value.bind( function( newval ) {
                switch (section_id){
                    case '#awe-idea':
                        $(section_id+' .subtitle').html(newval);
                        break;
                    case '#awe-subscribe':
                        $(section_id+' .sub-desc').html(newval);
                        break;
                    default:
                        $(section_id+' .awe-header .js-desc').html(newval);
                }


            } );
        } );

        /* Content Style */
        wp.customize( 'wm_options[extra]['+section_name+'][content][style]', function( value ) {
            value.bind( function( newval ) {
                var section = $(section_id+" .js-awe-get-items");
                section.attr("data-style",newval);
                switch(section_id){
                    case '#awe-funfact':
                        switch(newval){
                            case 'style-1':
                                section.find(".awe-funfacts-1").show();
                                section.find(".awe-funfacts-2").hide();
                                break;
                            case 'style-2':
                                section.find(".awe-funfacts-1").hide();
                                section.find(".awe-funfacts-2").show();
                                break;
                        }
                        break;
                    case '#awe-address':

                        switch(newval){
                            case 'style-1':
                                $(section_id +" #awe-address-1").show();
                                $(section_id +" #awe-address-2").hide();
                                break;
                            case 'style-2':
                                $(section_id +" #awe-address-1").hide();
                                $(section_id +" #awe-address-2").show();
                                break;
                        }
                        break;
                    case '#awe-work':
                        if(newval=='style-1'){
                            $(section_id + " .work-wrap").removeClass("fullwidth");
                            $(section_id + " .work-wrap").addClass("boxed");
                            $(section_id + " .container2").addClass("container");
                            $(section_id + " .row2").addClass("row");
                        }
                        else{
                            $(section_id + " .work-wrap").addClass("fullwidth");
                            $(section_id + " .work-wrap").removeClass("boxed");
                            $(section_id + " .container2").removeClass("container");
                            $(section_id + " .row2").removeClass("row");
                        }

                        break;

                    default:
                        update_style(section);
                }


                if(section_id=='#awe-team')
                    switch(newval){
                        case 'style-1':
                            section.find(".desc-person").show();
                            section.find(".awe-social-icon").show();
                            section.find(".awe-social").hide();
                            break;
                        case 'style-2':
                            section.find(".desc-person").hide();
                            section.find(".awe-social").show();
                            section.find(".awe-social-icon").hide();
                            break;
                    }

            } );
        } );

        /* button */
        wp.customize( 'wm_options[extra]['+section_name+'][button][label]', function( value ) {
            value.bind( function( newval ) {
                $(section_id+' a.sign-up').html(newval);
            } );
        } );
        wp.customize( 'wm_options[extra]['+section_name+'][button][url]', function( value ) {
            value.bind( function( newval ) {
                $(section_id+' a.sign-up').attr("href",newval);
            } );
        } );
        // animation header //
        wp.customize( 'wm_options[extra]['+section_name+'][header][animation]', function( value ) {
            value.bind( function( newval ) {
                var section = $(section_id+' .js-header');

                section.each(function(){

                    var current_animate = $(this).attr('data-animate');
                    $(this).removeClass(current_animate).addClass(newval+ ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                        $(this).removeClass('animated');
                    });
                    $(this).attr("data-animate",newval);
                })
            } );
        } );

        /* animate */
        if(section_name == 'about'){
            wp.customize( 'wm_options[extra]['+section_name+'][content][animation]', function( value ) {
                value.bind( function( newval ) {
                    var section = $(section_id+' .js-awe-get-items');
                    
                    section.each(function(){
                        // console.log(section);
                        var current_animate = $(this).attr('data-animate');
                        $(this).removeClass(current_animate).addClass(newval+ ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                            $(this).removeClass('animated');
                        });
                        $(this).attr("data-animate",newval);
                    })
                } );
            } );
        }else{
            wp.customize( 'wm_options[extra]['+section_name+'][content][animation]', function( value ) {
                value.bind( function( newval ) {
                    var section = $(section_id+' .js-content-item');
                    //console.log(section);
                    section.each(function(){
                        // console.log($(this));
                        var current_animate = $(this).attr('data-animate');
                        $(this).removeClass(current_animate).addClass(newval+ ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                            $(this).removeClass('animated');
                        });
                        $(this).attr("data-animate",newval);
                    })
                } );
            } );
        }

        /* slider */
        wp.customize( 'wm_options[extra]['+section_name+'][slider]', function( value ) {
            value.bind( function( newval ) {
                var options = JSON.parse(newval);
                var slider_name = section_name+'-slider';
                var section = $(section_id).find('.'+slider_name);
                var slider_section = $(section_id).find('.js-content-slider');
                if(options.enable==1){
                    if(slider_section.find('.owl-wrapper-outer').length) {
                        $(section_id).find('.js-content-slider').data('owlCarousel').destroy();
                    }
                   // slider_section.addClass('idea-slider');
                    if(section_name == 'pricing'){
                        $(section_id).find('.js-content-item').removeClass('col-ms-12 col-xs-6 col-md-4 item');
                    }else{
                        $(section_id).find('.js-content-item').removeClass('col-ms-12 col-xs-6 col-md-3 item');
                    }
                    $(section_id).find('.js-content-slider').owlCarousel({
                        autoPlay: 20000,
                        itemsDesktop : [1199,options.num],
                        itemsDesktopSmall : [979,options.num],
                        itemsTablet: [768,options.num],
                        itemsTabletSmall: [600,options.num],
                        items: options.num,
                        slideSpeed: 500,
                        navigation: true,
                        pagination: false,
                        navigationText: ["&#xf104;", "&#xf105;"]
                    });
                }else{
                    if(section_name == 'client'){
                        $(section_id).find('.js-content-item').addClass('item');
                    }
                    $(section_id).find('.js-content-slider').data('owlCarousel').destroy();
                    if(section_name == 'pricing'){
                        $(section_id).find('.js-content-item').addClass('col-ms-12 col-xs-6 col-md-4');
                    }else{
                        $(section_id).find('.js-content-item').addClass('col-ms-12 col-xs-6 col-md-3');
                    }
                }

            });
        });

        /* parallax */
        wp.customize( 'wm_options[extra]['+section_name+'][parallax]', function( value ) {
            value.bind( function( newval ) {
                var options = JSON.parse(newval),rel_name = 'parallax-'+section_name+'-bg';
                if(options.enable){
                    $(section_id).removeAttr("style");
                    if(options.image == ""){
                        $(section_id).css("background-color","transparent");
                        $(section_id).css("background-color",options.color);

                    }
                    else 
                        $(section_id).css("background-image","url("+options.image+")");
                }else{
                    $(section_id).removeAttr("style");
                }
               
            });
        });

        //============== Footer =======================//

        wp.customize('wm_options[extra]['+section_name+'][footer][enable]',function(value){
            value.bind(function(newval){
                var footer = $(section_id).find('.js-footer');
                if(newval){
                    footer.fadeIn();
                }else{
                    footer.fadeOut();
                }
            });
        });
        wp.customize('wm_options[extra]['+section_name+'][footer][title][enable]',function(value){
            value.bind(function(newval){
                var footer = $(section_id).find('.awe-footer');
                if(newval){
                    footer.find(".js-footer-title").fadeIn();
                }else{
                    footer.find(".js-footer-title").fadeOut();
                }
            });
        });

        wp.customize('wm_options[extra]['+section_name+'][footer][subtitle][enable]',function(value){
            value.bind(function(newval){
                var footer = $(section_id).find('.awe-footer').find(".js-footer-subtitle");
                if(newval){
                    footer.fadeIn();
                }else{
                    footer.fadeOut();
                }
            });
        });
        wp.customize('wm_options[extra]['+section_name+'][footer][desc][enable]',function(value){
            value.bind(function(newval){
                var footer = $(section_id).find('.awe-footer').find(".js-footer-desc");
                if(newval){
                    footer.fadeIn();
                }else{
                    footer.fadeOut();
                }
            });
        });
        wp.customize('wm_options[extra]['+section_name+'][footer][button][enable]',function(value){
            value.bind(function(newval){
                var footer = $(section_id).find('.awe-footer').find(".js-footer-button");
                if(newval){
                    footer.fadeIn();
                }else{
                    footer.fadeOut();
                }
            });
        });

        wp.customize('wm_options[extra]['+section_name+'][footer][title][text]',function(value){
            value.bind(function(newval){
                var footer = $(section_id).find('.awe-footer').find('.js-footer-title');
                footer.html(newval);
            });
        });
        wp.customize('wm_options[extra]['+section_name+'][footer][subtitle][text]',function(value){
            value.bind(function(newval){
                var footer = $(section_id).find('.awe-footer').find('.js-footer-subtitle');
                footer.text(newval);
            });
        });
        wp.customize('wm_options[extra]['+section_name+'][footer][desc][text]',function(value){
            value.bind(function(newval){
                var footer = $(section_id).find('.awe-footer').find('.js-footer-desc');
                footer.text(newval);
            });
        });
        wp.customize('wm_options[extra]['+section_name+'][footer][button][text]',function(value){
            value.bind(function(newval){
                var footer = $(section_id).find('.awe-footer').find('.js-footer-button');
                footer.text(newval);
            });
        });
        wp.customize('wm_options[extra]['+section_name+'][footer][button][link]',function(value){
            value.bind(function(newval){
                var footer = $(section_id).find('.awe-footer').find('.js-footer-button');
                footer.attr("href",newval);
            });
        });
        
        wp.customize('wm_options[extra]['+section_name+'][footer][style]',function(value){
            value.bind(function(newval){
                var footer = $(section_id).find('.awe-footer');
                footer.removeClass();
                footer.addClass('awe-footer '+newval);
            });
        });

        wp.customize('wm_options[extra]['+section_name+'][footer][animation]',function(value){
            value.bind( function( newval ) {
                var section = $(section_id+' .awe-footer');

                section.each(function(){

                    var current_animate = $(this).attr('data-animate');
                    $(this).removeClass(current_animate).addClass(newval+ ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                        $(this).removeClass('animated');
                    });
                    $(this).attr("data-animate",newval);
                })
            } );
        });

        //============== Overlay ======================//
        wp.customize( 'wm_options[extra]['+section_name+'][overlay]', function( value ) {
            value.bind(function(newval){
                var options = JSON.parse(newval);
                if(options.enable == "1"){
                var style = "";
                for(var i=0;i< options.type.length;i++){
                    if(options.type[i] == 'color'){
                        style += 'background-color: '+options.color+';';
                    }
                    if(options.type[i] == 'pattern'){
                        style += 'background-image: url('+options.pattern+');';
                    }
                }
                if($(section_id).find('.awe-overlay-bg').length) $(section_id).find('.awe-overlay-bg').remove();
                var overlay = '<div class="awe-overlay-bg" style="'+style+'"></div>';
                    $(section_id).append(overlay);
                }else{
                    $(section_id).find('.awe-overlay-bg').remove();
                }
             
            }); // end bind function
        });


    }
    /*hover transparent */
    wp.customize( 'wm_options[extra][portfolio][content][hover_transparent]', function( value ) {
        value.bind( function( newval ) {
            $("head style[rel='porfolio_hover_transparent']").remove();
            var newstyle = '<style rel="porfolio_hover_transparent">.work-item.hoverdir .folio-overlay {background-color: '+newval+';}</style>';
            $("head").append(newstyle);
        } );
    } );
    wp.customize( 'wm_options[extra][team][content][hover_transparent]', function( value ) {
        value.bind( function( newval ) {
            $("head style[rel='team_hover_transparent']").remove();
            var newstyle = '<style rel="team_hover_transparent">.team-item .photo-person:hover .hover-event{background-color: '+newval+';}</style>';
            $("head").append(newstyle);
        } );
    } );
    /* address */
    wp.customize( 'wm_options[extra][address][content][studio]', function( value ) {
        value.bind( function( newval ) {
            $('#contact .js-studio').html(newval);
        } );
    } );
    wp.customize( 'wm_options[extra][address][content][address]', function( value ) {
        value.bind( function( newval ) {
            $('#contact .js-address').html(newval);
        } );
    } );
    wp.customize( 'wm_options[extra][address][content][phone]', function( value ) {
        value.bind( function( newval ) {
            $('#contact .js-phone').html(newval);
        } );
    } );
    wp.customize( 'wm_options[extra][address][content][email]', function( value ) {
        value.bind( function( newval ) {
            $('#contact .js-email').html('<a href="mailto:'+newval+'">'+newval+'</a>');
        } );
    } );
    /* map */
    wp.customize( 'wm_options[extra][map][latitude]', function( value ) {
        value.bind( function( newval ) {
            var options = $(".awe-map").attr("data-options");
            options = JSON.parse(options);
            options.latitude = newval;
            $(".awe-map").html('<div id="map_canvas"></div>');
            $(".awe-map").attr("data-options",JSON.stringify(options));
            map_reinit(options);
        } );
    } );
    wp.customize( 'wm_options[extra][map][longitude]', function( value ) {
        value.bind( function( newval ) {
            var options = $(".awe-map").attr("data-options");
            options = JSON.parse(options);
            options.longitude = newval;
            $(".awe-map").html('<div id="map_canvas"></div>');
            $(".awe-map").attr("data-options",JSON.stringify(options));
            map_reinit(options);
        } );
    } );

    wp.customize( 'wm_options[extra][map][marker]', function( value ) {
        value.bind( function( newval ) {
            var options = $(".awe-map").attr("data-options");
            options = JSON.parse(options);
            options.marker = newval;
            $(".awe-map").html('<div id="map_canvas"></div>');
            $(".awe-map").attr("data-options",JSON.stringify(options));
            map_reinit(options);
        } );
    } );

    wp.customize( 'wm_options[extra][map][tooltip][heading]', function( value ) {
        value.bind( function( newval ) {
            var options = $(".awe-map").attr("data-options");
            options = JSON.parse(options);
            options.tooltip.heading = newval;
            $(".awe-map").html('<div id="map_canvas"></div>');
            $(".awe-map").attr("data-options",JSON.stringify(options));
            map_reinit(options);
        } );
    } );


    wp.customize( 'wm_options[extra][map][tooltip][content]', function( value ) {
        value.bind( function( newval ) {
            var options = $(".awe-map").attr("data-options");
            options = JSON.parse(options);
            options.tooltip.content = newval;
            $(".awe-map").html('<div id="map_canvas"></div>');
            $(".awe-map").attr("data-options",JSON.stringify(options));
            map_reinit(options);
        } );
    } );

    function map_reinit(options){
        if($(".awe-map").length){
        var options = $(".awe-map").attr("data-options"), map_latitude='45.738028',map_longitude='21.224535',map_marker='',theading='Viska Studio',tcontent='Come here and dring a coffee';
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
            draggable: true
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
    }
    function update_style(section)
    {
        var sclass = section.attr("class"),
            classes = sclass.split(' '),
            is_slider = section.attr("data-slider"),
            style = section.attr("data-style");


        // remove col-* class
        section.find("div.wow").each(function(){
            var item_class = $(this).attr("class"),iclasses=item_class.split(' ');
            for(var i=0;i<iclasses.length;i++)
                if(iclasses[i].match(/col-*/g))
                    iclasses[i]='';
            $(this).attr("class", iclasses.join(' '));
        });

        if(section.data('owlCarousel')!=undefined)
            section.data('owlCarousel').destroy();

        for(var i=0;i<classes.length;i++)
            if(classes[i].match(/style-/i))
                classes[i] = style;
        section.attr("class",classes.join(' '));

        section.removeClass("owl-carousel","owl-theme");
        if(is_slider==0){

            switch (style)
            {
                case 'style-1':
                    section.find("div.wow").each(function(){
                        $(this).addClass('col-sm-4 col-xs-12');
                    });
                    break;
                case 'style-2':
                    section.find("div.wow").each(function(){
                        $(this).addClass('col-md-3 col-sm-6');
                    });
                    break;
                case 'style-3':
                    section.find("div.wow").each(function(){
                        $(this).addClass('col-sm-4 col-xs-12');
                    });
                    break;
                case 'style-4':
                    section.find("div.wow").each(function(){
                        $(this).addClass('col-lg-6 col-md-12');
                    });
                    break;
            }
        }else{

            var num = section.attr("data-num");

            section.owlCarousel({
                autoPlay: true,
                items : num,
                navigation: false,
                pagination: true,
                itemsDesktop:false
            });
        }

    }





    /* Sort Section*/
    wp.customize( 'wm_options[extra][sort_section]', function( value ) {
        value.bind( function( newval ) {
            if(newval!='' && newval!=undefined)
            {
                var section = {'about':'#about','funfact':'#funfacts','idea':'#process','lastedpost':'#news','client':'#client','portfolio':'#work','pricing':'#plans','service':'#services','skill':'#skill','team':'#team','twitter':'#twitter','testimonial':'#testimonial','contact':'#contact','map':'#map','address':'#address'};
                var positions = newval.split(',');
                console.log(positions);
                var isset_positions = [];
                if(positions.length>0)
                    for(var i=0;i<positions.length;i++)
                    {
                        if($(section[positions[i]]).length)
                            isset_positions.push(positions[i]);
                    }

                if(isset_positions.length>0){
                    console.log(isset_positions);
                    for(var j=0;j<(isset_positions.length);j++)
                    {
                        console.log(section[isset_positions[j]]);
                        $(section[isset_positions[j]]).detach().appendTo("#content-sort");

                    }
                }

            }
        } );
    } );

} )( jQuery );
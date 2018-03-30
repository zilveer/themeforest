(function($){

    /*======= PIE CHART =======*/
    $('.piechart').each(function(){

        if (typeof jQuery.fn.waypoint !== 'undefined') {
            $(this).waypoint(function() {
                $(this).easyPieChart({
                    scaleColor:false,
                    barColor: $(this).data('barcolor'),
                    lineWidth:$(this).data('linewidth'),
                    trackColor: $(this).data('trackcolor')
                });
            }, { offset: '85%' });
        }else{
            $(this).easyPieChart({
                scaleColor:false,
                barColor: $(this).data('barcolor'),
                lineWidth:$(this).data('linewidth'),
                trackColor: $(this).data('trackcolor')
            });
        }
    });


    /*======= PROGRESS BAR =======*/
    $('.yit-progress-bar').each(function(){
        var bar = $(this);
        var progress_bar = bar.find('.progress-bar');
        var progress_start_value = 0
        var progress_max_value = progress_bar.data('progress');

        var progress_speed = bar.data('speed');

        if( typeof progress_speed != 'undefined' ) {

            if( progress_speed == 'slow' ) {
                progress_speed = 3000;
            } else if( progress_speed == 'normal' ) {
                progress_speed = 2000;
            } else if( progress_speed == 'fast' ) {
                progress_speed = 1000;
            }

            var progress_step = 1;

            function start_progress_bar() {
                'use strict';

                progress_start_value = progress_start_value + progress_step;

                if ( progress_start_value < progress_max_value ) {
                    progress_bar.css( "width", progress_start_value+'%' );
                    setTimeout( start_progress_bar, ( progress_speed / progress_max_value ) );
                }  else {
                    progress_bar.css( "width", progress_max_value+'%' );
                }
            }

            start_progress_bar();

        } else if (typeof jQuery.fn.waypoint !== 'undefined' && ! YIT_Browser.isMobile()) {
            bar.waypoint(function() {
                bar.not('.animated').addClass('animated').find('.progress-bar').css('width', progress);
                bar.find('.bar-value').fadeIn('slow');
            }, { offset: '99%' });
        } else {
            bar.find('.progress-bar').css('width', progress);
            bar.find('.bar-value').show();
        }

    });

    /*======= TOGGLE / ACCORDION =======*/
    $('.toggle-content:not(.opened), .content-tab:not(.opened)').hide();
    $('.tab-index a').on('click', function(){
        $this = $(this);
        var opened_class = $this.children('span').data('opened');
        var closed_class = $this.children('span').data('closed');
        $this.parent().next().slideToggle(600, 'easeOutExpo');
        $this.parent().toggleClass('tab-opened tab-closed');
        $this.children('span').toggleClass(closed_class+' '+opened_class);
        $this.attr('title', ($(this).attr('title') == 'Close') ? 'Open' : 'Close');
        return false;
    });

    /*======= SECTION WITH BACKGROUND COLOR  =======*/


    var sectionvideofix = function(){
        var windowsize = $(window).width();

        if(isRtl()) {
            $(".section_background_outer").css({
                right: -(( windowsize-$('.container').width())/2),
                width: windowsize
            });
        }
        else{
            $(".section_background_outer").css({
                left: -(( windowsize-$('.container').width())/2),
                width: windowsize
            });
        }

    }

    $(window).on('load resize', sectionvideofix );


    /*======= IMAGE BANNER =======*/
    /* Vertical center */
    var image_banner_center_info = function(){

        var selector = ".banner-image-slogan-wrapper.middle";
        var infoBannerHeight = $(selector).height();
        $(selector).css({
            'margin-top': -(infoBannerHeight/2)
        });
    }

    $(window).on('resize', image_banner_center_info);
    image_banner_center_info();


    function isRtl(){
        var attr_dir = $( "html" ).attr( "dir" );
        return (attr_dir=="rtl");
    }

})(jQuery) ;
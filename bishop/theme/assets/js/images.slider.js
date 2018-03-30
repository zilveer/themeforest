/**
 * JS For Swiper Images Slider
 */

(function ($, window) {
    "use strict";

    var imagesSlider = new Array();

    $('.swiper-container').each(function() {
        var t = $(this);
        var postID = t.data('postid');
        var pagination = '.pagination-post-' + postID;

        initSwiper( postID, pagination );
    });

    $(window).resize( function(){
        $('.swiper-container').each(function() {
            var t = $(this);
            var postID = t.data('postid');
            var pagination = '.pagination-post-' + postID;

            slideDimensionFix( postID );
        });
    });

    $('body').on('yit_next_page_loaded', '.swiper-container', function(e, postid){
        if( typeof imagesSlider[postid] == 'undefined' ){
            var pagination = '.pagination-post-' + postid;
            var navigation = $( '.swiper-' + postid + ' .swiper-direction' );

            initSwiper( postid, pagination );

            navigation.click(function(){
                var t = $(this);
                var postID = t.parents('.swiper-container').data('postid');

                initDirection(t, postID);
            })
        }
        else{
            imagesSlider[postid].reInit();
        }

    });

    $('.swiper-direction').on('click', function(){
        var t = $(this);
        var postID = t.parents('.swiper-container').data('postid');

        initDirection( t, postID );
    });

    function initSwiper(postID, pagination){
        imagesSlider[postID] = $('.swiper-' + postID).swiper({
            mode : 'horizontal',
            loop : true,
            speed: 750,
            autoplay: 5000,
            calculateHeight: false,
            keyboardControl: true,
            createPagination: true,
            pagination: pagination,
            paginationClickable: true,
            autoresize: true,
            resizeReInit:true,
            onSlideChangeStart: function( swiper ){
                var postID = $(swiper.container).data('postid');
                slideDimensionFix( postID );
            }
        });

        slideDimensionFix( postID );
    }

    function slideDimensionFix( postID ){
        //Unset height and width
        $('.swiper-container').css({
            height:''
        }).css({
            height: $('.swiper-container .swiper-slide-active').children().first().height()
        })
    }

    function initDirection(t, postID){
        t.hasClass( 'left' ) ? imagesSlider[postID].swipePrev() : imagesSlider[postID].swipeNext();
        slideDimensionFix( postID );
    }

})( jQuery, window );
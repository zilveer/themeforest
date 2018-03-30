(function ($, window, document) {
    "use strict";

    //Store frequently used query
    var next = $('.slide-tab.next-post'),
        current = $('.slide-tab.current-post'),
        body = $(document.body),

        slideNext = function() {
            if( next.length != 0 ){
                var placeholder_height = next.find('.placeholder').height();
                var translationvalue = document.getElementById('next').getBoundingClientRect().top - $('#wpadminbar').outerHeight();

                if( ! body.hasClass( 'force-sticky-header' ) ) {
                    translationvalue -= $('#header').outerHeight();
                }
                var post_id = next.data('post_id');
                //Add exit transition to current post tab
                current.addClass('fade-up-out');
                //Shows content for next post
                next.removeClass('hidden-content')
                    .height('auto')
                    //Remove next id
                    .removeAttr('id')
                    //Add enter transition
                    .addClass('easing-upward')

                if( next.hasClass('no-thumb') ){
                    next.css({ "margin-top": $('#header').outerHeight() })
                }

                //Applay enter transition
                next.css({ "transform": "translate3d(0, -" + translationvalue + "px, 0" });

                next.find('.big-image > img').show();
                next.find('.big-image .swiper-container').show();
                next.find('.big-image .swiper-container').trigger( 'yit_next_page_loaded', post_id );

                setTimeout(function () {
                    next.find('.big-image .placeholder').remove();
                    //Scroll to top
                    body.add(document.documentElement).scrollTop( 0 );
                    //Remove transition class from ex next element
                    next.removeClass('easing-upward');
                    //Remove ex current element
                    current.remove();

                    //Remove transition from inline css
                    next.css({ "transform": "" });
                    //Set ex next element as current element
                    next.removeClass('next-post')
                        .addClass('current-post')
                    next.off( 'click' );
                    //Require next post
                    $.ajax({
                        beforeSend: function(){
                            $('body').trigger('yit_share_init');
                        },
                        cache: false,
                        complete: function(){ },
                        method: "post",
                        data: {
                            action: yit_page_slider_options.action,
                            post_id: post_id
                        },
                        dataType: 'html',
                        error: function(){},
                        success: function(data, status, xhr){
                            $('#primary').append(data);
                            next.show();

                            current = $('.slide-tab.current-post')
                            next = $('.slide-tab.next-post');
                            next.height(placeholder_height);
                            next.click(slideNext);

                            var post_title = $('.post-title'),
                                title = post_title.text(),
                                href = post_title.find('a').attr( 'href' );

                            history.pushState( '', title, href );
                        },
                        url: yit.ajaxurl
                    })
                }, 750)
            }
        };

    //$(document).ready(function(){
        //Append click listener
        next.on( 'click', slideNext );
    //});

})( jQuery, window, document );
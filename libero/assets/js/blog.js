(function($) {
    "use strict";


    var blog = {};
    mkd.modules.blog = blog;

    blog.mkdInitAudioPlayer = mkdInitAudioPlayer;

    $(document).ready(function() {
        mkdInitAudioPlayer();
    });

    $(window).load(function(){
    	mkdBlogInfoFollow().init();
    });

    function mkdInitAudioPlayer() {

        var players = $('audio.mkd-blog-audio');

        players.mediaelementplayer({
            audioWidth: '100%'
        });
    }


    /*
    ** Function for Info Box following on Single Blog Posts
    */

    var mkdBlogInfoFollow = function() {

        var single = $('.mkd-blog-single');

        if (single.length) {
            var infoHolder = single.find('.mkd-post-info-column-inner'),
                infoHolderOffset = infoHolder.offset().top,
                infoHolderHeight = infoHolder.outerHeight(),
                contentHolder = $('.mkd-post-text'),
                contentHolderHeight = contentHolder.height(),
                header = $('.header-appear, .mkd-fixed-wrapper'),
                headerHeight = (header.length) ? header.height() : 0;

				if (single.find('article').hasClass('format-link') || single.find('article').hasClass('format-quote')){
					var contentHolderPart1 = $('.mkd-post-content-column-inner');
					var contentHolderPart2 = $('.mkd-post-single-quote-link-content');
					contentHolderHeight = contentHolderPart1.outerHeight(true) + contentHolderPart2.outerHeight(true);
				}
        }

        var infoHolderPosition = function() {

            if(single.length && mkd.windowWidth > 600) {

                if (contentHolderHeight > infoHolderHeight) {
                    if(mkd.scroll > infoHolderOffset ) {
                        infoHolder.animate({
                            marginTop: (mkd.scroll - (infoHolderOffset) + mkdGlobalVars.vars.mkdAddForAdminBar + headerHeight + 20) //20 px is for styling, spacing between header and info holder
                        });
                    }
                }

            }
        };

        var recalculateInfoHolderPosition = function() {

            if (single.length && mkd.windowWidth > 600) {
                if(contentHolderHeight > infoHolderHeight) {
                    if(mkd.scroll > infoHolderOffset) {

                        if(mkd.scroll + headerHeight + mkdGlobalVars.vars.mkdAddForAdminBar + infoHolderHeight + 20 < infoHolderOffset + contentHolderHeight) {    //20 px is for styling, spacing between header and info holder

                            //Calculate header height if header appears
                            if ($('.header-appear, .mkd-fixed-wrapper').length) {
                                headerHeight = $('.header-appear, .mkd-fixed-wrapper').height();
                            }
                            infoHolder.stop().animate({
                                marginTop: (mkd.scroll - (infoHolderOffset) + mkdGlobalVars.vars.mkdAddForAdminBar + headerHeight + 20) //20 px is for styling, spacing between header and info holder
                            });
                            //Reset header height
                            headerHeight = 0;
                        }
                        else{
                            infoHolder.stop().animate({
                                marginTop: contentHolderHeight - infoHolderHeight
                            });
                        }
                    } else {
                        infoHolder.stop().animate({
                            marginTop: 0
                        });
                    }
                }
            }
        };

        return {

            init : function() {

                infoHolderPosition();
                $(window).scroll(function(){
                    recalculateInfoHolderPosition();
                });

            }

        };

    };


})(jQuery);
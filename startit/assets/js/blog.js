(function($) {
    "use strict";


    var blog = {};
    qodef.modules.blog = blog;

    blog.qodefInitAudioPlayer = qodefInitAudioPlayer;

    $(document).ready(function() {
        qodefInitAudioPlayer();
        qodefInitBlogMasonry();
        qodefInitBlogMasonryLoadMore();
        qodefInitBlogGallery();
        qodefBlogGalleryAnimation();
    });

    function qodefInitAudioPlayer() {

        var players = $('audio.qodef-blog-audio');

        players.mediaelementplayer({
            audioWidth: '100%'
        });
    }


    function qodefInitBlogMasonry() {

        if($('.qodef-blog-holder.qodef-blog-type-masonry').length) {

            var container = $('.qodef-blog-holder.qodef-blog-type-masonry');

            container.isotope({
                itemSelector: 'article',
                resizable: false,
                masonry: {
                    columnWidth: '.qodef-blog-masonry-grid-sizer',
                    gutter: '.qodef-blog-masonry-grid-gutter'
                }
            });

            var filters = $('.qodef-filter-blog-holder');
            $('.qodef-filter').click(function() {
                var filter = $(this);
                var selector = filter.attr('data-filter');
                filters.find('.qodef-active').removeClass('qodef-active');
                filter.addClass('qodef-active');
                container.isotope({filter: selector});
                return false;
            });
        }
    }

    function qodefInitBlogGallery() {

        if($('.qodef-blog-holder.qodef-blog-type-gallery').length) {

            var container = $('.qodef-blog-holder.qodef-blog-type-gallery');

            var size = $('.qodef-blog-gallery-grid-sizer').width() * 1.25;
            container.find('article').css('height', size);

            container.isotope({
                itemSelector: 'article',
                resizable: false,
                masonry: {
                    columnWidth: '.qodef-blog-gallery-grid-sizer',
                    gutter: '.qodef-blog-gallery-grid-gutter'
                }
            });
	        container.waitForImages(function(){
		        container.animate({opacity: "1"}, 300, function() {
			        container.isotope('layout');
		        });
	        });
        }
    }

    function qodefBlogGalleryAnimation() {
        var blogGalleries = $('.qodef-blog-holder.qodef-blog-type-gallery');
        if (blogGalleries.length) {
            blogGalleries.each(function(){
                var blogGallery = $(this),
                    articles = blogGallery.find('article');

                articles.each(function(){
                    var article = $(this),
                        excerpt = article.find('.qodef-post-excerpt'),
                        excerptHeight = parseInt(excerpt.outerHeight(true)),
                        category = article.find('.qodef-post-info-category'),
                        title = article.find('.qodef-post-title');

                    category.css({'transform':'translateY('+excerptHeight+'px)'});
                    title.css({'transform':'translateY('+excerptHeight+'px)'});

                    article.mouseenter(function(){
                        category.css({'transform':'translateY(0px)'});
                        title.css({'transform':'translateY(0px)'});
                        excerpt.css({'visibility':'visible','opacity':'1'});
                    });
                    article.mouseleave(function(){
                        category.css({'transform':'translateY('+excerptHeight+'px)'});
                        title.css({'transform':'translateY('+excerptHeight+'px)'});
                        excerpt.css({'visibility':'hidden', 'opacity':'0'});
                    });
                });
            });
        }
    }

    function qodefInitBlogMasonryLoadMore() {

        if($('.qodef-blog-holder.qodef-blog-type-masonry').length || $('.qodef-blog-holder.qodef-blog-type-gallery').length) {

            var container = $('.qodef-blog-holder.qodef-blog-type-masonry, .qodef-blog-holder.qodef-blog-type-gallery');
            var size;
            var resizable = false;
            if(container.hasClass('qodef-gallery-pagination-load-more') || container.hasClass('qodef-gallery-pagination-infinite-scroll')) {
                size = container.find('.qodef-blog-gallery-grid-sizer').width() * 1.25;
                resizable = true;
            }
            if(container.hasClass('qodef-masonry-pagination-infinite-scroll') || container.hasClass('qodef-gallery-pagination-infinite-scroll')) {
                container.infinitescroll({
                        navSelector: '.qodef-blog-infinite-scroll-button',
                        nextSelector: '.qodef-blog-infinite-scroll-button a',
                        itemSelector: 'article',
                        loading: {
                            finishedMsg: qodefGlobalVars.vars.qodefFinishedMessage,
                            msgText: qodefGlobalVars.vars.qodefMessage
                        }
                    },
                    function(newElements) {
                        container.append(newElements).isotope('appended', $(newElements));
                        if(resizable) {
                            container.find('article').css('height', size);
                            qodefBlogGalleryAnimation();
                        }
                        qodef.modules.blog.qodefInitAudioPlayer();
                        qodef.modules.common.qodefOwlSlider();
                        qodef.modules.common.qodefFluidVideo();
                        setTimeout(function() {
                            container.isotope('layout');
                        }, 400);
                    }
                );
            } else if(container.hasClass('qodef-masonry-pagination-load-more') || container.hasClass('qodef-gallery-pagination-load-more')) {
                var i = 1;
                $('.qodef-blog-load-more-button a').on('click', function(e) {
                    e.preventDefault();

                    var button = $(this);

                    var link = button.attr('href');
                    var content;
                    if(container.hasClass('qodef-masonry-pagination-load-more')) {
                        content = '.qodef-masonry-pagination-load-more';
                    }
                    else if(container.hasClass('qodef-gallery-pagination-load-more')) {
                        content = '.qodef-gallery-pagination-load-more';
                    }
                    var anchor = '.qodef-blog-load-more-button a';
                    var nextHref = $(anchor).attr('href');
                    $.get(link + '', function(data) {
                        var newContent = $(content, data).wrapInner('').html();
                        nextHref = $(anchor, data).attr('href');
                        container.append(newContent).isotope('reloadItems').isotope({sortBy: 'original-order'});
                        if(resizable) {
                            container.find('article').css('height', size);
                            qodefBlogGalleryAnimation();
                        }
                        qodef.modules.blog.qodefInitAudioPlayer();
                        qodef.modules.common.qodefOwlSlider();
                        qodef.modules.common.qodefFluidVideo();
                        setTimeout(function() {
                            if(container.hasClass('qodef-masonry-pagination-load-more')) {
                                $('.qodef-masonry-pagination-load-more').isotope('layout');
                            }
                            else if(container.hasClass('qodef-gallery-pagination-load-more')) {
                                $('.qodef-gallery-pagination-load-more').isotope('layout');
                            }
                        }, 400);
                        if(button.parent().data('rel') > i) {
                            button.attr('href', nextHref); // Change the next URL
                        } else {
                            button.parent().remove();
                        }
                    });
                    i++;
                });
            }
        }
    }




})(jQuery);
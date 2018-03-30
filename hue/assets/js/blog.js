(function($) {
    "use strict";


    var blog = {};
    mkd.modules.blog = blog;

    blog.mkdInitAudioPlayer = mkdInitAudioPlayer;

    blog.mkdOnDocumentReady = mkdOnDocumentReady;
    blog.mkdOnWindowLoad = mkdOnWindowLoad;
    blog.mkdOnWindowResize = mkdOnWindowResize;
    blog.mkdOnWindowScroll = mkdOnWindowScroll;

    $(document).ready(mkdOnDocumentReady);
    $(window).load(mkdOnWindowLoad);
    $(window).resize(mkdOnWindowResize);
    $(window).scroll(mkdOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function mkdOnDocumentReady() {
        mkdInitAudioPlayer();
        mkdInitBlogMasonry();
        mkdInitBlogMasonryLoadMore();
		mkdInitBlogMasonryGallery();
		mkdInitBlogMasonryGalleryLoadMore();
        mkdInitBlogLoadMore();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function mkdOnWindowLoad() {

    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function mkdOnWindowResize() {

    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function mkdOnWindowScroll() {

    }



    function mkdInitAudioPlayer() {

        var players = $('audio.mkd-blog-audio');

        players.mediaelementplayer({
            audioWidth: '100%'
        });
    }


    function mkdInitBlogMasonry() {

        if($('.mkd-blog-holder.mkd-blog-type-masonry').length) {

            var container = $('.mkd-blog-holder.mkd-blog-type-masonry');

            container.isotope({
                itemSelector: 'article',
                resizable: false,
                masonry: {
                    columnWidth: '.mkd-blog-masonry-grid-sizer',
                    gutter: '.mkd-blog-masonry-grid-gutter'
                }
            });

            var filters = $('.mkd-filter-blog-holder');
            $('.mkd-filter').click(function() {
                var filter = $(this);
                var selector = filter.attr('data-filter');
                filters.find('.mkd-active').removeClass('mkd-active');
                filter.addClass('mkd-active');
                container.isotope({filter: selector});
                return false;
            });

			container.waitForImages(function(){
				container.animate({opacity: "1"}, 300, function() {
					container.isotope().isotope('layout');
				});
			});
        }
    }

    function mkdInitBlogMasonryLoadMore() {

        if($('.mkd-blog-holder.mkd-blog-type-masonry').length) {

            var container = $('.mkd-blog-holder.mkd-blog-type-masonry');

            if(container.hasClass('mkd-masonry-pagination-infinite-scroll')) {
                container.infinitescroll({
                        navSelector: '.mkd-blog-infinite-scroll-button',
                        nextSelector: '.mkd-blog-infinite-scroll-button a',
                        itemSelector: 'article',
                        loading: {
                            finishedMsg: mkdGlobalVars.vars.mkdFinishedMessage,
                            msgText: mkdGlobalVars.vars.mkdMessage
                        }
                    },
                    function(newElements) {
                        container.append(newElements).isotope('appended', $(newElements));
                        mkd.modules.blog.mkdInitAudioPlayer();
                        mkd.modules.common.mkdOwlSlider();
                        mkd.modules.common.mkdFluidVideo();
                        setTimeout(function() {
                            container.isotope('layout');
                        }, 400);
                    }
                );
            } else if(container.hasClass('mkd-masonry-pagination-load-more')) {
                var i = 1;
                $('.mkd-blog-load-more-button a').on('click', function(e) {
                    e.preventDefault();

                    var button = $(this);

                    var link = button.attr('href');
                    var content = '.mkd-masonry-pagination-load-more';
                    var anchor = '.mkd-blog-load-more-button a';
                    var nextHref = $(anchor).attr('href');
                    $.get(link + '', function(data) {
                        var newContent = $(content, data).wrapInner('').html();
                        nextHref = $(anchor, data).attr('href');
                        container.append(newContent).isotope('reloadItems').isotope({sortBy: 'original-order'});
                        mkd.modules.blog.mkdInitAudioPlayer();
                        mkd.modules.common.mkdOwlSlider();
                        mkd.modules.common.mkdFluidVideo();
                        setTimeout(function() {
                            $('.mkd-masonry-pagination-load-more').isotope('layout');
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

	function mkdInitBlogMasonryGallery() {

		if($('.mkd-blog-holder.mkd-blog-type-masonry-gallery').length) {

			mkdResizeBlogMasonryGallery($('.mkd-blog-masonry-gallery-grid-sizer').width());

			var container = $('.mkd-blog-holder.mkd-blog-type-masonry-gallery');
			container.width(Math.round(container.parent().width()));
			container.isotope({
				itemSelector: 'article',
				resizable: false,
				layoutMode: 'packery',
				packery: {
					columnWidth: '.mkd-blog-masonry-gallery-grid-sizer',
					gutter: '.mkd-blog-masonry-gallery-grid-gutter'
				}
			});

			var filters = $('.mkd-filter-blog-holder');
			$('.mkd-filter').click(function() {
				var filter = $(this);
				var selector = filter.attr('data-filter');
				filters.find('.mkd-active').removeClass('mkd-active');
				filter.addClass('mkd-active');
				container.isotope({filter: selector});
				return false;
			});

			container.waitForImages(function(){
				container.animate({opacity: "1"}, 300, function() {
					container.isotope().isotope('layout');
				});
			});

			$(window).resize(function() {
				mkdResizeBlogMasonryGallery($('.mkd-blog-masonry-gallery-grid-sizer').width());
				container.isotope().isotope('layout');
				container.width(Math.round(container.parent().width()));
			});
		}
	}

	function mkdInitBlogMasonryGalleryLoadMore() {

		var containers = $('.mkd-blog-holder.mkd-blog-type-masonry-gallery');

		if(containers.length) {

			containers.each(function() {

				var container = $('.mkd-blog-holder.mkd-blog-type-masonry-gallery'),
					article = container.find('article');

				if(container.hasClass('mkd-masonry-pagination-load-more')) {
					var i = 1;
					$('.mkd-blog-load-more-button a').on('click', function(e) {
						e.preventDefault();

						var button = $(this);
						var buttonText = button.find('.mkd-btn-text').text();
						var link = button.attr('href');
						var content = '.mkd-masonry-pagination-load-more';
						var anchor = '.mkd-blog-load-more-button a';
						var nextHref = $(anchor).attr('href');

						button.find('.mkd-btn-text').text('Loading');

						$.get(link + '', function(data) {
							var newContent = $(content, data).wrapInner('').html();
							nextHref = $(anchor, data).attr('href');
							container.append(newContent).isotope('reloadItems').isotope({sortBy: 'original-order'});
							mkd.modules.blog.mkdInitAudioPlayer();
							mkd.modules.common.mkdOwlSlider();
							mkd.modules.common.mkdFluidVideo();
							mkdResizeBlogMasonryGallery($('.mkd-blog-masonry-gallery-grid-sizer').width());
							setTimeout(function() {
								$('.mkd-masonry-pagination-load-more').isotope('layout');
								mkdMasonryLoadMoreAppear(container,200);
								button.find('.mkd-btn-text').text(buttonText);
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
				else if(container.hasClass('mkd-masonry-pagination-infinite-scroll')) {
					container.infinitescroll({
							navSelector: '.mkd-blog-infinite-scroll-button',
							nextSelector: '.mkd-blog-infinite-scroll-button a',
							itemSelector: 'article',
							loading: {
								finishedMsg: mkdGlobalVars.vars.mkdFinishedMessage,
								msgText: mkdGlobalVars.vars.mkdMessage
							}
						},
						function(newElements) {
							container.append(newElements).isotope('appended', $(newElements));
							mkd.modules.blog.mkdInitAudioPlayer();
							mkd.modules.common.mkdOwlSlider();
							mkd.modules.common.mkdFluidVideo();
							mkdResizeBlogMasonryGallery($('.mkd-blog-masonry-gallery-grid-sizer').width());
							setTimeout(function() {
								container.isotope('layout');
							}, 400);
						}
					);
				}
			});

			$(window).resize(function() {
				mkdResizeBlogMasonryGallery($('.mkd-blog-masonry-gallery-grid-sizer').width());
				mkd.modules.common.mkdOwlSlider();
			});
		}
	}

	function mkdResizeBlogMasonryGallery(size) {

		var rectangle_portrait = $('.mkd-blog-holder.mkd-blog-type-masonry-gallery .mkd-post-size-large-height');
		var rectangle_landscape = $('.mkd-blog-holder.mkd-blog-type-masonry-gallery .mkd-post-size-large-width');
		var square_big = $('.mkd-blog-holder.mkd-blog-type-masonry-gallery .mkd-post-size-large-width-height');
		var square_small = $('.mkd-blog-holder.mkd-blog-type-masonry-gallery .mkd-post-size-square');

		rectangle_portrait.css('height',2*size);
		rectangle_landscape.css('height',size);
		square_big.css('height',2*size);
		if(square_big.width() < 600) {
			square_big.css('height', square_big.width());
		}
		square_small.css('height', size);

	}

	function mkdMasonryLoadMoreAppear(container,delay) {
		var hiddenArticles = container.find('article:not(.mkd-appeared)');
		if (hiddenArticles.length) {
			var animateCycle = 6, // rewind delay
				animateCycleCounter = 0;

			hiddenArticles.each(function(i){
				var thisArticle = $(this);
				setTimeout(function(){
					thisArticle.appear(function(){
						animateCycleCounter ++;
						if(animateCycleCounter == animateCycle) {
							animateCycleCounter = 0;
						}
						setTimeout(function(){
							thisArticle.addClass('mkd-appeared');
						},animateCycleCounter * 120);
					},{accX: 0, accY: 0});
				},30);
			});
		}
	}

    function mkdInitBlogLoadMore(){
        var blogHolder = $('.mkd-blog-holder.mkd-blog-load-more:not(.mkd-blog-type-masonry)');
        
        if(blogHolder.length){
            blogHolder.each(function(){
                var thisBlogHolder = $(this);
                var nextPage;
                var maxNumPages;
                
                var loadMoreButton = thisBlogHolder.find('.mkd-load-more-ajax-pagination .mkd-btn');
                maxNumPages =  thisBlogHolder.data('max-pages');                
                
                loadMoreButton.on('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    var loadMoreDatta = getBlogLoadMoreData(thisBlogHolder);
                    nextPage = loadMoreDatta.nextPage;
                    
                    if(nextPage <= maxNumPages){
                        var ajaxData = setBlogLoadMoreAjaxData(loadMoreDatta);
                        $.ajax({
                            type: 'POST',
                            data: ajaxData,
                            url: MikadoAjaxUrl,
                            success: function (data) {
                                nextPage++;
                                thisBlogHolder.data('next-page', nextPage);
                                var response = $.parseJSON(data);
                                var responseHtml =  response.html;
                                thisBlogHolder.waitForImages(function(){    
                                    thisBlogHolder.find('article:last').after(responseHtml); // Append the new content 
                                    setTimeout(function() {               
                                        mkd.modules.blog.mkdInitAudioPlayer();
                                        mkd.modules.common.mkdOwlSlider();
                                        mkd.modules.common.mkdFluidVideo();
                                    },400);
                                });
                            }
                        });
                    }
                    
                    if(nextPage === maxNumPages){
                        loadMoreButton.hide();
                    }
                    
                });
            });
        }
    }
    function getBlogLoadMoreData(container){
        
        var returnValue = {};
        
        returnValue.nextPage = '';
        returnValue.number = '';
        returnValue.category = '';
        returnValue.blogType = '';
        returnValue.archiveCategory = '';
        returnValue.archiveAuthor = '';
        returnValue.archiveTag = '';
        returnValue.archiveDay = '';
        returnValue.archiveMonth = '';
        returnValue.archiveYear = '';
        
        if (typeof container.data('next-page') !== 'undefined' && container.data('next-page') !== false) {
            returnValue.nextPage = container.data('next-page');
        }
        if (typeof container.data('post-number') !== 'undefined' && container.data('post-number') !== false) {                    
            returnValue.number = container.data('post-number');
        }
        if (typeof container.data('category') !== 'undefined' && container.data('category') !== false) {                    
            returnValue.category = container.data('category');
        }
        if (typeof container.data('blog-type') !== 'undefined' && container.data('blog-type') !== false) {                    
            returnValue.blogType = container.data('blog-type');
        }
        if (typeof container.data('archive-category') !== 'undefined' && container.data('archive-category') !== false) {                    
            returnValue.archiveCategory = container.data('archive-category');
        }
        if (typeof container.data('archive-author') !== 'undefined' && container.data('archive-author') !== false) {                    
            returnValue.archiveAuthor = container.data('archive-author');
        }
        if (typeof container.data('archive-tag') !== 'undefined' && container.data('archive-tag') !== false) {                    
            returnValue.archiveTag = container.data('archive-tag');
        }
        if (typeof container.data('archive-day') !== 'undefined' && container.data('archive-day') !== false) {                    
            returnValue.archiveDay = container.data('archive-day');
        }
        if (typeof container.data('archive-month') !== 'undefined' && container.data('archive-month') !== false) {                    
            returnValue.archiveMonth = container.data('archive-month');
        }
        if (typeof container.data('archive-year') !== 'undefined' && container.data('archive-year') !== false) {                    
            returnValue.archiveYear = container.data('archive-year');
        }
        
        return returnValue;
        
    }
    
    function setBlogLoadMoreAjaxData(container){
        
        var returnValue = {
            action: 'hue_mikado_blog_load_more',
            nextPage: container.nextPage,
            number: container.number,
            category: container.category,
            blogType: container.blogType,
            archiveCategory: container.archiveCategory,
            archiveAuthor: container.archiveAuthor,
            archiveTag: container.archiveTag,
            archiveDay: container.archiveDay,
            archiveMonth: container.archiveMonth,
            archiveYear: container.archiveYear
        };
        
        return returnValue;
    }



})(jQuery);
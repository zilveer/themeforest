(function($) {
    "use strict";


    var blog = {};
    eltd.modules.blog = blog;

    blog.eltdInitAudioPlayer = eltdInitAudioPlayer;

    blog.eltdOnDocumentReady = eltdOnDocumentReady;
    blog.eltdOnWindowLoad = eltdOnWindowLoad;
    blog.eltdOnWindowResize = eltdOnWindowResize;
    blog.eltdOnWindowScroll = eltdOnWindowScroll;
    blog.eltdSplitColumnPostHeight = eltdSplitColumnPostHeight;
    blog.eltdInitBlogLoadMore = eltdInitBlogLoadMore;
    blog.eltdGetPostCategories = eltdGetPostCategories;
    blog.eltdGetAuthorPosts = eltdGetAuthorPosts;
    blog.eltdGetPostTags = eltdGetPostTags;
    blog.eltdGetRelatedPost = eltdGetRelatedPost;
    
    

    $(document).ready(eltdOnDocumentReady);
    $(window).load(eltdOnWindowLoad);
    $(window).resize(eltdOnWindowResize);
    $(window).scroll(eltdOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdOnDocumentReady() {
        eltdInitAudioPlayer();
        eltdInitBlogLoadMore();
        eltdGetPostCategories();
        eltdGetAuthorPosts();
        eltdGetPostTags();
        eltdGetRelatedPost();
        eltdGetPageContent();
        eltdInitTransitions();
        eltdSplitColumnPostHeight();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function eltdOnWindowLoad() {
        eltdInitBlogMasonry();
        eltdSetExpandableTiles();
        eltdGetInfiniteScrollTriggerPosition();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function eltdOnWindowResize() {
        eltdSplitColumnPostHeight();
        eltdInitBlogMasonry();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function eltdOnWindowScroll() {

    }



    function eltdInitAudioPlayer() {

        var players = $('audio.eltd-blog-audio');

        players.mediaelementplayer({
            audioWidth: '100%'
        });
    }

    function eltdInitBlogMasonry() {

        if($('.eltd-blog-holder.eltd-blog-type-masonry').length) {

            var container = $('.eltd-blog-holder.eltd-blog-type-masonry');

            container.isotope({
                itemSelector: 'article',
                resizable: false,
                masonry: {
                    columnWidth: '.eltd-blog-masonry-grid-sizer',
                    gutter: '.eltd-blog-masonry-grid-gutter'
                }
            });

            var filters = $('.eltd-filter-blog-holder');
            $('.eltd-filter').click(function() {
                var filter = $(this);
                var selector = filter.attr('data-filter');
                filters.find('.eltd-active').removeClass('eltd-active');
                filter.addClass('eltd-active');
                container.isotope({filter: selector});
                return false;
            });
            container.animate({opacity: "1"}, 400, function(){
                container.isotope( 'layout');
            });
        }
    }
    
    /* 
        Initialize load more ajax pagination
    */
    function eltdInitBlogLoadMore(){
        
        var blogHolder = $('.eltd-blog-holder.eltd-blog-load-more');
        
        var nextPage;
        var maxNumPages;

        var loadMoreButton = blogHolder.find('.eltd-load-more-ajax-pagination .eltd-btn');
        if(blogHolder.hasClass('eltd-blog-type-masonry')){
            loadMoreButton = blogHolder.next().find('.eltd-btn');
        }
        
        //check initialy if there are posts on second page
        
        maxNumPages =  blogHolder.data('max-pages');                    
        nextPage = blogHolder.data('next-page');
        
        if(nextPage <= maxNumPages){
            loadMoreButton.show();
        }else{
            loadMoreButton.hide();
        }

        
        // on click initialize ajax pagination
        loadMoreButton.off('click').on('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            loadMoreButton.animate({opacity:0},200);
            $('.eltd-list-loading').css({'visibility':'visible'});
            $('.eltd-list-loading').css({'display':'block'});            
            $('.eltd-list-loading').animate({opacity:1},200);            
            setTimeout(function(){
                eltdInitAjaxPagination(blogHolder);
            },700);
            
        });       
        
    }
    
    /* 
        Initialize infinite scroll ajax pagination
    */
    function eltdGetInfiniteScrollTriggerPosition() {
        
        var blogHolder = $('.eltd-blog-holder.eltd-blog-infinite-scroll');
        var trigger = $('.eltd-infinite-scroll-trigger');
        var loader = $('.eltd-list-loading');
        loader.css({'visibility':'hidden', 'opacity' : 0, 'display': 'none'});
        
        trigger.appear(function() {
            setTimeout(function(){
                loader.css({'visibility':'visible', 'display':'block'});
                loader.animate({opacity:1},200);
                setTimeout(function(){
                    eltdInitAjaxPagination(blogHolder);
                },700);
            }, 300);
        });

    }

    function eltdInitAjaxPagination(container){
        
        var nextPage;
        var maxNumPages;

        var loadMoreDatta = getBlogAjaxPaginationData(container);
        maxNumPages =  container.data('max-pages');                    
        nextPage = loadMoreDatta.nextPage;

        if(nextPage <= maxNumPages){

            var ajaxData = setBlogAjaxPaginationData(loadMoreDatta);
            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: ElatedAjaxUrl,
                success: function (data) {
                    nextPage++;
                    container.data('next-page', nextPage);
                    var response = $.parseJSON(data);
                    var responseHtml =  response.html;

                    container.waitForImages(function(){

                        if(container.hasClass('eltd-blog-type-expanding-tiles')){
                            eltd.modules.blog.eltdExpandableTiles.update_grid({
                                action: 'append',
                                html: responseHtml
                            });
                        }
                        
                        else if(container.hasClass('eltd-blog-type-masonry')){
                            
                            container.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
                            
                            setTimeout(function(){
                                eltd.modules.ajax.eltdReinitiateAll(typeof eltdET !== 'undefined' ? eltdET.modulesToExclude : []);
                            },400); 
                            
                        }
                        
                        else{
                           container.find('article:last').after(responseHtml); // Append the new content 
                            setTimeout(function() {
                                eltd.modules.ajax.eltdReinitiateAll(typeof eltdET !== 'undefined' ? eltdET.modulesToExclude : []);

                            },400);
                        }

                    $('.eltd-list-loading').css({
                        'visibility' : 'hidden',
                        'display' : 'none'
                    });
                    $('.eltd-load-more-ajax-pagination .eltd-btn').delay(700).animate({opacity:1},200);

                    });
                }
            });
        } else {
            $('.eltd-list-loading').css({
                'visibility' : 'hidden',
                'display' : 'none'
            });
        }
        if(container.hasClass('eltd-blog-load-more')){
            if(nextPage > maxNumPages){
                var loadMoreButton = container.find('.eltd-load-more-ajax-pagination .eltd-btn');
                if(container.hasClass('eltd-blog-type-masonry')){
                    loadMoreButton = container.next().find('.eltd-btn');
                }
                loadMoreButton.hide();
                $('.eltd-list-loading').css({
                    'visibility' : 'hidden',
                    'display' : 'none'
                });
            }
        }
        
    }
    
    
    
    
    /* 
        Get data parametters for ajax pagination from container
    */

    function getBlogAjaxPaginationData(container){
        
        var returnValue = {};
        
        returnValue.nextPage = '';
        returnValue.number = '';
        returnValue.category = '';
        returnValue.catId = '';
        returnValue.tagSlug = '';
        returnValue.searchValue = '';
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
        if (typeof container.data('cat-id') !== 'undefined' && container.data('cat-id') !== false) {                    
            returnValue.catId = container.data('cat-id');
        }
        if (typeof container.data('tag-slug') !== 'undefined' && container.data('tag-slug') !== false) {                    
            returnValue.tagSlug = container.data('tag-slug');
        }
        if (typeof container.data('search-value') !== 'undefined' && container.data('search-value') !== false) {                    
            returnValue.searchValue = container.data('search-value');
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
    
    /* 
        Sets ajax parametters for ajax pagination 
    */
    
    function setBlogAjaxPaginationData(container){
        
        var returnValue = {
            action: 'flow_elated_blog_load_more',
            nextPage: container.nextPage,
            number: container.number,
            category: container.category,
            catId: container.catId,
            tagSlug: container.tagSlug,
            searchValue: container.searchValue,
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

    function eltdSetExpandableTiles() {
        if ($('.eltd-expandable-tiles').length) {
            var eltdET = {};
            eltd.modules.blog.eltdExpandableTiles = eltdET;

            eltdET.grid = $('.eltd-expandable-tiles .eltd-post-list');

            eltdET.transitionEnd = 'webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend';
            eltdET.layoutDuration = 0.4; // seconds
            eltdET.minImportance = 20000;

            eltdET.empty_item_holder =
                '<div class="eltd-blog-list-expandable-item eltd-blei-h-1 eltd-blei-post eltd-blei-temp">\
                    <div class="eltd-blei-inner">\
                        <div class="eltd-blei-upper-wrapper"></div>\
                        <div class="eltd-blei-lower-wrapper">\
                            <div class="full-text-container"></div>\
                        </div>\
                        <div class="eltd-blei-collapse"><span class="icon_close"></span></div>\
                    </div>\
                </div>'
            ;

            eltdET.modulesToExclude = ['headerBehaviour'];

            eltdET.get_items = function() {
                eltdET.items = eltdET.grid.find('.eltd-blog-list-expandable-item');
            };

            eltdET.insert_item = function($item) {
                eltdET.grid.append($item).isotope('insert',$item);
                eltdET.assign_buttons($item);
                eltdET.get_items();
            };

            eltdET.get_unit_height = function(type) {
                // values here must match the CSS rules
                type = typeof type === 'undefined' ? 'outer' : type;
                var padding = type == 'inner' ? 8 : 0; // sum of top and bottom padding on element
                var w = Math.max(eltd.windowWidth, window.innerWidth); // Fix for scrollbar width problem
                var h;
                if (w >= 1701              || w >= 1301 && w <= 1400 || w >= 901 && w <= 1024 || w >= 501 && w <= 600) {
                    h = 280;
                }
                if (w >= 1601 && w <= 1700 || w >= 1201 && w <= 1300 || w >= 801 && w <= 900 || w >= 401 && w <= 500) {
                    h = 260;
                }
                if (w >= 1501 && w <= 1600 || w >= 1101 && w <= 1200 || w >= 701 && w <= 800 || w >= 301 && w <= 400) {
                    h = 230;
                }
                if (w >= 1401 && w <= 1500 || w >= 1025 && w <= 1100 || w >= 601 && w <= 700 || w >= 201 && w <= 300) {
                    h = 200;
                }
                return h - padding;
            };

            eltdET.show_outer_page = function($link) {
                $.ajax({
                    type: 'POST',
                    dataType: 'html',
                    data: {ajaxReq: 'yes'},
                    url: $link.attr('href'),
                    success: function(response) {
                        var page = $(response).find('.eltd-content');
                        var page_title = page.find('.eltd-title-holder h1, .eltd-post-title h2').eq(0).text();
                        page.find('.eltd-infinite-scroll-trigger, .eltd-list-loading').remove();
                        page.find('.eltd-title').remove();
                        var $item = $(eltdET.empty_item_holder);
                        $item.find('.eltd-blei-upper-wrapper').css('height', eltdET.get_unit_height('inner'));
                        $item.find('.eltd-blei-upper-wrapper').html('<div class="eltd-blei-page-title-holder"></div>');
                        var place = Math.round(eltd.windowWidth / eltdET.items.not('.expanded').eq(0).width()) - 1;

                        eltdET.new_url = $link.attr('href');

                        if (eltdET.items.eq(place).length) {
                            $item.insertBefore(eltdET.items.eq(place));
                        }
                        else {
                            $item.appendTo(eltdET.grid);
                        }
                        $item.attr('data-importance',2);
                        $item.prevAll('.eltd-blog-list-expandable-item').attr('data-importance',1);
                        $item.nextAll('.eltd-blog-list-expandable-item').attr('data-importance',3);

                        $item.find('.full-text-container').html(page).waitForImages(function() {
                            eltdET.grid.isotope('addItems',$item);
                            eltdET.grid.isotope('updateSortData');
                            eltdET.assign_buttons($item);
                            eltdET.get_items();

                            function roll_up($item) {
                                $item.find('.eltd-blei-upper-wrapper').css({
                                    'margin-top': - $item.find('.eltd-blei-upper-wrapper').height() + 'px',
                                    'transition': 'margin-top .5s ease-out'
                                });
                            }

                            var prev = eltdET.items.filter('.expanded');
                            if (prev.length) {
                                eltdET.collapse(prev, function() {

                                    eltdET.expand($item, function() {
                                        roll_up($item);
                                    });
                                });
                            }
                            else {
                                eltdET.expand($item, function() {
                                    roll_up($item);
                                });
                            }
                        });
                    }
                });
            };
            
            eltdET.handle_resize = function() {
                setTimeout(function() {
                    eltdET.items.find('.eltd-blei-upper-wrapper').each(function() {
                        $(this).css({
                            width: '',
                            height: '',
                            transition: 'none'
                        });
                        $(this).width($(this).width()).height($(this).height()).css('transition','');
                    });
                    eltdET.grid.isotope();
                    setTimeout(function() {    
                        eltdET.analyze_rows();
                        $('.owl-carousel').each(function() {
                            var owlCar = $(this).data('owlCarousel');
                        if (typeof owlCar !== 'undefined') owlCar.reinit();
                        });
                        eltdET.items.filter('.format-audio').each(function() {
                            var audio_tag = $(this).find('.eltd-blog-audio-holder audio').clone();
                            var audio_wrap = $('<div class="eltd-blog-audio-holder"></div>');
                            audio_wrap.insertBefore($(this).find('.eltd-blog-audio-holder').first()).siblings('.eltd-blog-audio-holder').remove();
                            audio_wrap.append(audio_tag);
                        });
                        eltd.modules.blog.eltdInitAudioPlayer();
                    }, eltdET.layoutDuration * 1000 * 1.1);
                }, eltdET.layoutDuration * 1000 * 1.1);
            };
            
            eltdET.initMenu = function(){
                var menuItems = $('.eltd-main-menu ul li a, .eltd-vertical-menu ul li a, .eltd-mobile-nav ul li a');
                menuItems.off('click').click(function(e){

                    function stopClick(click) {
                        click.preventDefault();
                        click.stopImmediatePropagation();
                        click.stopPropagation();
                    }

                    if (eltdET.busy) {
                        stopClick(e);
                        return;
                    }
                    else {
                        eltdET.busy = true;

                        if ($(this).attr('href').split('#')[0] == eltdET.back_url) {
                            stopClick(e);
                            if ($('.eltd-mobile-nav').is(':visible')) $('.eltd-mobile-menu-opener a').click();
                            eltdET.reopen_list();
                        }
                    
                        else if ($(this).closest('li').is('.menu-item-type-post_type')) {
                            stopClick(e);
                            if ($('.eltd-mobile-nav').is(':visible')) $('.eltd-mobile-menu-opener a').click();
                            eltdET.show_outer_page($(this));
                        }
                        
                        else if($(this).closest('li').is('.menu-item-object-category')){
                            stopClick(e);
                            if ($('.eltd-mobile-nav').is(':visible')) $('.eltd-mobile-menu-opener a').click();
                            var currentCat = $(this);
                            var currentCatId;
                            if (typeof currentCat.closest('.menu-item').data('nav-item-id') !== 'undefined' && currentCat.closest('.menu-item').data('nav-item-id') !== false) {
                                currentCatId = currentCat.closest('.menu-item').data('nav-item-id');
                            }                
                            eltdGetCategoryHtml(currentCatId);
                        }
                        
                        else if($(this).closest('li').is('.menu-item-object-post_tag')){
                            stopClick(e);
                            if ($('.eltd-mobile-nav').is(':visible')) $('.eltd-mobile-menu-opener a').click();
                            var currentTag = $(this);
                            var currentTagSlug = '';
                            if (typeof currentTag.closest('.menu-item').data('nav-item-tag-slug') !== 'undefined' && currentTag.closest('.menu-item').data('nav-item-tag-slug') !== false) {                    
                                currentTagSlug = currentTag.closest('.menu-item').data('nav-item-tag-slug');
                            }
                            eltdGetTagHtml(currentTagSlug);
                        }

                        else {
                            eltdET.busy = false;
                        }
                    }
                });
            };

            eltdET.initLogo = function() {
                var logo = $('.eltd-logo-wrapper a, .eltd-mobile-logo-wrapper a');
                logo.off('click').on('click', function(e) {
                    if ($(this).attr('href').split('#')[0] == eltdET.back_url) {
                        e.preventDefault();
                        e.stopImmediatePropagation();
                        e.stopPropagation();

                        if (eltdET.busy) {
                            return;
                        }
                        else {
                            eltdET.busy = true;

                            eltdET.reopen_list();
                        }
                    }
                });
            };

            eltdET.reopen_list = function() {
                $.ajax({
                    type: 'POST',
                    data: {
                        ajaxReq: 'yes'
                    },
                    url: eltdET.back_url,
                    success: function (data) {
                        var new_blog_holder = $(data).find('.eltd-blog-type-expanding-tiles');
                        var cur_blog_holder = eltd.body.find('.eltd-blog-type-expanding-tiles');
                        cur_blog_holder.data('next-page',new_blog_holder.data('next-page'));
                        cur_blog_holder.data('max-pages',new_blog_holder.data('max-pages'));

                        cur_blog_holder.data('cat-id', typeof new_blog_holder.data('cat-id') !== 'undefined' ? new_blog_holder.data('cat-id') : '');

                        cur_blog_holder.data('tag-slug', typeof new_blog_holder.data('tag-slug') !== 'undefined' ? new_blog_holder.data('tag-slug') : '');

                        cur_blog_holder.data('search-value', typeof new_blog_holder.data('search-value') !== 'undefined' ? new_blog_holder.data('search-value') : '');

                        cur_blog_holder.data('author-id', typeof new_blog_holder.data('author-id') !== 'undefined' ? new_blog_holder.data('author-id') : '');

                        var response = new_blog_holder.find('article');
                        eltdET.update_grid({html: response, action: 'refresh'});
                    }
                });
            };
            
            eltdET.assign_buttons = function(item) {
                $(item).find('.eltd-blei-upper-wrapper a').not($(item).find('.eltd-post-info-category a')).not($(item).filter('.ajax-page-content').find('a')).off('click').click(function(e) {
                    var next = $(this).parents('.eltd-blog-list-expandable-item');
                    var post_url = next.find('.eltd-post-title a').attr('href');
                    if (next.is('.expanded') || $(this).attr('href').split('#')[0] != post_url) {
                        return;
                    }
                    else {
                        e.preventDefault();
                        e.stopImmediatePropagation();
                        e.stopPropagation();

                        if (eltdET.busy) {
                            return;
                        }
                        else {
                            eltdET.busy = true;
                        
                            var currentItemId = next.attr('id');
                            var currentItemPostID = currentItemId.substring(5,currentItemId.length);
                            var ajaxData = {
                                action: 'flow_elated_get_post_by_ajax',
                                currentItemId: currentItemPostID,
                                ajaxReq: 'yes'
                            };
                            //preload trigger
                            var readMore = $(item).find('.eltd-read-more'),
                                playBtn = $(item).find('.eltd-play-button'),
                                slideBtn = $(item).filter('.format-gallery').find('.owl-pagination');
                            if (readMore.length) {
                                readMore.animate({opacity:0},100);
                                //calcs
                                var readMoreOffsetHeight = readMore.offset().top + readMore.outerHeight() - 8, //height of the before/after element
                                    articleOffsetHeight = readMore.closest('article').offset().top + readMore.closest('article').outerHeight(),
                                    preloaderBottom = articleOffsetHeight - readMoreOffsetHeight;
                                //html
                                readMore.after('<div class="eltd-single-post-preload-holder eltd-read-more-preload"></div>');
                                $(item).find('.eltd-single-post-preload-holder.eltd-read-more-preload').css('bottom',preloaderBottom);
                            }
                            if (playBtn.length) {
                                playBtn.addClass('eltd-preloading');
                                playBtn.after('<span class="eltd-video-post-preloading"></span>');
                            }
                            if (slideBtn.length) {
                                var slide = $(item).find('.eltd-blei-slide');
                                slide.animate({opacity:0},200,'easeOutSine');
                                var preloader = $(item).find('.slides').siblings('.eltd-format-gallery');
                                preloader.fadeIn(300);
                            }
                            $.ajax({
                                type: 'POST',
                                data: ajaxData,
                                url: ElatedAjaxUrl,
                                success: function (data) {
                                    var response = $.parseJSON(data);
                                    var responseHtml =  response.html;
                                    next.find('.full-text-container').html('<div class="eltd-blog-holder eltd-blog-single">'+responseHtml+'</div>').waitForImages(function() {
                                        var img = next.find('.eltd-post-image');
                                        if (img.find('img').length) {
                                            next.find('.eltd-blei-upper-wrapper .image-container').css('background-image', "url('"+img.find('img').attr('src')+"')");
                                        }
                                        img.remove();
                                        //preload end
                                        eltdET.new_url = post_url;
                                        if (readMore.length) {
                                            setTimeout(function(){
                                                $('.eltd-single-post-preload-holder.eltd-read-more-preload').fadeOut().remove();
                                                readMore.animate({opacity:1},250);
                                            },eltdET.layoutDuration*2000);
                                        }
                                        if (playBtn.length) {
                                            setTimeout(function(){
                                                $('.eltd-video-post-preloading').fadeOut().remove();
                                                playBtn.removeClass('eltd-preloading');
                                            },eltdET.layoutDuration*2000);
                                        }
                                        var prev = eltdET.items.filter('.expanded');
                                        if (prev.length) {
                                            eltdET.collapse(prev, function() {
                                                eltdET.expand(next);
                                            });
                                        }
                                        else {
                                            eltdET.expand(next);
                                        }
                                    });
                                }
                            });
                        }
                    }
                });
                $(item).find('.eltd-blei-collapse').off('click').click(function() {
                    var item = $(this).parents('.eltd-blog-list-expandable-item');
                    eltdET.collapse(item);
                });
            };

            eltdET.analyze_rows = function() {
                eltdET.items.each(function() {
                    var upper = $(this).find('.eltd-blei-upper-wrapper');
                    var opposite = {even: 'odd', odd: 'even'};
                    var row_class = Math.round(parseInt($(this).css('top'),10) / $(this).outerHeight()) % 2 == 0 ? 'even' : 'odd';
                    upper.addClass(row_class).removeClass(opposite[row_class]).width(upper.width()).height(upper.height());
                });
            };

            eltdET.getAllPositions = function() {
                var positions = [];
                eltdET.items.each(function() {
                    positions.push($(this).offset());
                });
                return positions;
            };

            eltdET.changeOfPositions = function(positions1, positions2) {
                for (var i=0; i<positions1.length; i++) {
                    if (positions1[i].top != positions2[i].top || positions1[i].left != positions2[i].left) {
                        return true;
                    }
                }
                return false;
            };

            eltdET.init = function() {
                eltdET.get_items();
                eltdET.grid.isotope({
                    itemSelector: '.eltd-blog-list-expandable-item',
                    isResizeBound: false,
                    masonry: {
                        columnWidth: '.eltd-blog-list-expandable-grid-sizer',
                        gutter: '.eltd-blog-list-expandable-grid-sizer-gutter'
                    },
                    getSortData: {
                        date: '[data-date]',
                        importance: function(item) {
                            return parseInt($(item).attr('data-importance'),10);
                        }
                    },
                    transitionDuration: eltdET.layoutDuration + 's',
                    sortBy: 'importance'
                });
                eltdET.items.filter('.eltd-blei-post').each(function() {
                    eltdET.assign_buttons(this);
                });
                eltdET.items.filter('.sticky-slider').find('.slides').each(function() {
                    $(this).owlCarousel({
                        singleItem: true,
                        loop: true
                    });
                });
                eltdET.busy = false;
                if (typeof eltdET.grid.closest('.eltd-expandable-tiles').data('default-url') === 'undefined') {
                    eltdET.grid.closest('.eltd-expandable-tiles').data('default-url',window.location.href);
                }
                eltdET.back_url = eltdET.grid.closest('.eltd-expandable-tiles').data('default-url');
                eltdET.initMenu();
                eltdET.initLogo();
                eltdET.handle_resize() ;
                $(window).resize(eltdET.handle_resize);
                $('.eltd-blog-audio-holder').resize(function(e) {
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    e.stopPropagation();
                });
            };

            eltdET.expand = function($item, callback) {

                function perform_expansion($item) {
                    eltdET.grid.off('layoutComplete');
                    eltdET.analyze_rows();
                    $('html, body').animate({scrollTop: $item.offset().top - eltdGlobalVars.vars.eltdTopBarHeight - $('.eltd-page-header').is(':visible') * Math.max(eltdGlobalVars.vars.eltdStickyHeaderHeight, eltdGlobalVars.vars.eltdStickyHeaderTransparencyHeight) /*- $('.eltd-mobile-header').is(':visible') * (typeof eltdGlobalVars.vars.eltdMobileHeaderHeight !== 'undefined' ? eltdGlobalVars.vars.eltdMobileHeaderHeight : 0)*/ +'px'}, 300, 'swing');
                    $item.css('transition','');
                    upper_wrapper
                    .css({
                        'width': '',
                        'height': ''
                    })
                    .on(eltdET.transitionEnd, function(e) {
                        if (!$(e.target).is($(this))) return;
                        $(this).off(eltdET.transitionEnd);
                        lower_wrapper.find('.full-text-container').css({
                            'height': lower_h + 'px',
                            'transition': 'height .5s ease-out'
                        }).on(eltdET.transitionEnd, function(e) {
                            if (!$(e.target).is($(this))) return;
                            $(this).off(eltdET.transitionEnd);
                            var url = eltdET.new_url;
                            if (window.history.pushState) {
                                if(url!==window.location.href){
                                    window.history.pushState({path:url},'',url);
                                }

                                //does Google Analytics code exists on page?
                                if(typeof _gaq !== 'undefined') {
                                    //add new url to Google Analytics so it can be tracked
                                    _gaq.push(['_trackPageview', url]);
                                }
                            } else {
                                document.location.href = window.location.protocol + '//' + window.location.host + '#' + url.split(window.location.protocol + '//' + window.location.host)[1];
                            }
                            inner.css('box-shadow','');
                            $item.find('.eltd-blei-collapse').css('opacity',1);
                            $item.find('.eltd-blei-collapse').css('visibility','visible');
                            $item.find('.slides-cover').fadeOut(eltdET.layoutDuration * 1000);
                            var owlCar = $item.find('.owl-carousel').data('owlCarousel');
                            if (typeof owlCar !== 'undefined') { owlCar.reinit(); }
                            eltd.modules.ajax.eltdReinitiateAll(eltdET.modulesToExclude);
                            setTimeout(function() {
                                eltdET.adjust_height($item);
                            },300);
                            if (typeof callback === 'function') {
                                callback();
                            }
                        });
                    });
                }

                var init_positions = eltdET.getAllPositions();
                var upper_wrapper = $item.find('.eltd-blei-upper-wrapper');
                var lower_wrapper = $item.find('.eltd-blei-lower-wrapper');
                var inner = $item.find('.eltd-blei-inner');
                inner.css('box-shadow','none');
                var lower_h = Math.ceil(lower_wrapper.find('.full-text-container').outerHeight() / $item.outerHeight()) * $item.outerHeight();
                $item.addClass('expanded');
                $item.height( ($item.is('.eltd-blei-temp') ? 0 : inner.height()) + lower_h - ($item.is('.eltd-blei-temp') ? $item.outerHeight() - $item.height() : 0) );
                lower_wrapper.find('.full-text-container').css({
                    'height': 0,
                    'opacity': 1,
                    'transition': 'none'
                });
                upper_wrapper.find('.description-container').css({'left': '-50%', 'transition': 'left '+eltdET.layoutDuration+'s ease-out'});
                upper_wrapper.find('.image-container').css({'left': '50%', 'transition': 'left '+eltdET.layoutDuration+'s ease-out'});
                $item.find('.slides-cover').fadeIn(eltdET.layoutDuration * 1000, function() {
                    var slideBtn =  $item.filter('.format-gallery').find('.owl-pagination');
                    if (slideBtn.length){
                        setTimeout(function() {
                            $('.eltd-single-post-preload-holder.eltd-format-gallery').fadeOut().remove();
                            $item.find('.eltd-blei-slide').animate({opacity:1},200);
                        },eltdET.layoutDuration*1000)
                    }
                    $item.find('.eltd-blei-video-holder').show();
                    $item.find('.eltd-blei-link').hide();
                });
                eltdET.expansion_indicator = '';
                eltdET.grid.isotope({sortBy: 'importance'}).on('layoutComplete', function() {
                    $(this).off('layoutComplete');
                    eltdET.expansion_indicator = 'after-layout';
                    perform_expansion($item);
                });
                setTimeout(function() { // Set to check if the layout has changed, because the layoutComplete event will not launch if it hasn't.
                    if (!eltdET.changeOfPositions(eltdET.getAllPositions(), init_positions)) {
                        setTimeout(function() {
                            eltdET.expansion_indicator = 'no-layout';
                            perform_expansion($item);
                        }, eltdET.layoutDuration*1000 / 2);
                    }
                }, eltdET.layoutDuration*1000 / 2);
                setTimeout(function() { // Last resort to check whether the expansion has been performed
                    eltdET.grid.off('layoutComplete');
                    if (eltdET.expansion_indicator === '') { // Nothing has expanded the content
                        perform_expansion($item);
                    }
                }, eltdET.layoutDuration + 100);
            };

            eltdET.collapse = function($item, callback) {
                var upper_wrapper = $item.find('.eltd-blei-upper-wrapper');
                var lower_wrapper = $item.find('.eltd-blei-lower-wrapper');
                var inner = $item.find('.eltd-blei-inner');
                inner.css('box-shadow','none');
                $item.find('.eltd-blei-collapse').css('opacity','');
                $item.find('.slides-cover').fadeIn(eltdET.layoutDuration * 1000, function() {
                    $item.find('.eltd-blei-video-holder').hide();
                    $item.find('.eltd-blei-link').show();
                });
                $('html, body').animate({scrollTop: $item.offset().top - eltdGlobalVars.vars.eltdTopBarHeight - $('.eltd-page-header').is(':visible') * Math.max(eltdGlobalVars.vars.eltdStickyHeaderHeight, eltdGlobalVars.vars.eltdStickyHeaderTransparencyHeight) - $('.eltd-mobile-header').is(':visible') * (typeof eltdGlobalVars.vars.eltdMobileHeaderHeight !== 'undefined' ? eltdGlobalVars.vars.eltdMobileHeaderHeight : 0) +'px'}, 300, 'swing');
                lower_wrapper.find('.full-text-container').css({
                    'height': 0,
                    'transition': 'height .5s ease-out'
                }).on(eltdET.transitionEnd, function() {
                    $(this).off(eltdET.transitionEnd);
                    if (window.history.pushState) {
                        if(eltdET.back_url!==window.location.href){
                            window.history.replaceState({path:eltdET.back_url},'',eltdET.back_url);
                        }
                    } else {
                        document.location.href = eltdET.back_url;
                    }
                    if (!$item.is('.eltd-blei-temp')) {
                        $(this).html('');
                        $(this).css({
                            'opacity': '',
                            'height': '',
                            'transition': 'none'
                        });
                        $item.css('height','').removeClass('expanded');
                        upper_wrapper.css({width: '', height: ''});
                        $item.on(eltdET.transitionEnd, function(e) {
                            if (!$(e.target).is($(this))) return;
                            inner.css('box-shadow','');
                            $(this).off(eltdET.transitionEnd);
                            upper_wrapper.width(upper_wrapper.width()).height(upper_wrapper.height());
                            upper_wrapper.find('.description-container').css({'left': '', 'transition': ''});
                            upper_wrapper.find('.image-container').css({'left': '', 'transition': ''});
                            $item.find('.slides-cover').fadeOut(eltdET.layoutDuration * 1000);
                            var owlCar = $item.find('.owl-carousel').data('owlCarousel');
                            if (typeof owlCar !== 'undefined') { owlCar.reinit(); }
                            var iframe = $item.find('iframe');
                            iframe.each(function() {
                                $(this).attr('src',$(this).attr('src'));
                            });

                            if (typeof callback === 'function') {
                                callback();
                            }
                            else {
                                eltdET.grid.isotope({sortBy: 'original-order'}).on('layoutComplete', function() {
                                    $(this).off('layoutComplete');
                                    eltdET.analyze_rows();
                                });
                            }
                        });
                    }
                    else {
                        eltdET.items = eltdET.items.not($item);
                        eltdET.grid.isotope('remove',$item).isotope('updateSortData');
                        $item.remove();
                        if (typeof callback === 'function') {
                            callback();
                        }
                        else {
                            eltdET.grid.isotope({sortBy: 'original-order'}).on('layoutComplete', function() {
                                $(this).off('layoutComplete');
                                eltdET.analyze_rows();
                            });
                        }
                    }
                });
            };

            eltdET.update_grid = function(params) {
                
                function setDefaultParam(key,value) {
                    params[key] = typeof params[key] !== 'undefined' ? params[key] : value;
                }
                
                if (typeof params !== 'object') {return; }
                else {

                    setDefaultParam('action', 'append');
                    setDefaultParam('html', '');
                    setDefaultParam('callback', function() {});

                    eltdET.grid.find('.eltd-no-posts-notice').fadeOut(200, function() {
                        $(this).remove();
                    });

                    if (params.action == 'refresh') {
                        eltd.html.animate({scrollTop: eltdET.grid.offset().top}, 300, 'swing');
                    }

                    var adding_items = $(params.html);
                    var removing_items = params.action == 'refresh' ? eltdET.items : $('');
                    var reinit_timeout;

                    if (adding_items.is('.eltd-blei-no-posts')) {
                        var notice = $('<div class="eltd-no-posts-notice"></div>');
                        notice.html(adding_items.find('.eltd-blei-page-title-holder').html());
                        notice.css('top', (eltd.windowHeight + eltdET.grid.offset().top)/2 +'px').appendTo(eltdET.grid).fadeIn(200);
                        adding_items = $('');
                    }

                    setTimeout(function() {
                        if (window.history.pushState) {
                            if(eltdET.back_url!==window.location.href){
                                window.history.replaceState({path:eltdET.back_url},'',eltdET.back_url);
                            }
                        } else {
                            document.location.href = eltdET.back_url;
                        }
                        switch (params.action) {
                            case 'refresh': 
                                adding_items.appendTo(eltdET.grid);
                                eltdET.grid.isotope('addItems', adding_items);
                                eltdET.grid.isotope('updateSortData');
                                eltdET.grid.isotope('remove', removing_items);
                                removing_items.remove();
                                eltdET.grid.isotope();
                                reinit_timeout = eltdET.layoutDuration*1000*2;
                            break;

                            case 'append': 
                                adding_items.appendTo(eltdET.grid);
                                eltdET.grid.isotope('appended', adding_items);
                                reinit_timeout = eltdET.layoutDuration*1000;
                            break;
                        }
                        eltdET.analyze_rows();
                        
                        setTimeout(function() {
                            eltd.modules.ajax.eltdReinitiateAll( eltdET.modulesToExclude );
                            $('.eltd-list-loading').css({
                                'visibility' : 'hidden',
                                'display' : 'none'
                            });
                            params.callback();
                        },reinit_timeout);
                    }, params.action == 'refresh' ? 350 : 0);
                }
            };

            eltdET.adjust_height = function(item) {
                var ftc = item.find('.full-text-container');
                var inner = item.find('.eltd-blei-inner');
                var upper_wrapper = item.find('.eltd-blei-upper-wrapper');

                inner.css('background-color', ftc.css('background-color'));
                ftc.css('height','');
                var lower_h = Math.ceil(ftc.outerHeight() / eltdET.get_unit_height()) * eltdET.get_unit_height(); // adjust this if CSS is changed!!!
                item.height( !item.is('.eltd-blei-temp') * upper_wrapper.height() - item.is('.eltd-blei-temp') * (eltdET.get_unit_height('outer') - eltdET.get_unit_height('inner')) + lower_h );
                ftc.height(lower_h);
                inner.css('background-color', '');
                eltdET.grid.isotope();
            };  

            eltdET.init();
        }
    }
    
    function eltdGetRelatedPost(){
       var selector = $('.eltd-blog-holder.eltd-blog-type-expanding-tiles .eltd-blog-list-expandable-item .eltd-related-post > a, .eltd-blog-holder.eltd-blog-type-expanding-tiles .eltd-blog-list-expandable-item .eltd-related-post-title > a');
       selector.off('click').on('click',function(e){
           
            e.preventDefault();
            e.stopPropagation();
            
            if (eltd.modules.blog.eltdExpandableTiles.busy) {
                return;
            }
            else {
                eltd.modules.blog.eltdExpandableTiles.busy = true;
                var currentItem = $(this);
                eltd.modules.blog.eltdExpandableTiles.show_outer_page(currentItem);

                var relatedImage = $(this).closest('.eltd-related-post').find('.eltd-related-post-image');
                relatedImage.find('img').animate({opacity:0},200,'easeOutSine');
                relatedImage.find('.eltd-related-post-preloader').fadeIn(300);
            }
       });
    }
    /* 
        Generate html for related post via ajax
    */
    function eltdGetSinglePostHtml(postID){
        
        var ajaxData = {
            action: 'flow_elated_get_post_by_ajax',
            currentItemId: postID
        };
        $.ajax({
            type: 'POST',
            data: ajaxData,
            url: ElatedAjaxUrl,
            success: function (data) {
                var response = $.parseJSON(data);
                var responseHtml =  response.html;
                eltd.modules.blog.eltdExpandableTiles.update_grid({
                    action: 'append',
                    html: responseHtml
                });
            }
        });
    }
     /* 
        Generate html for category archive page via ajax
    */
    function eltdGetPostCategories(){
        var selector = $('.eltd-blog-holder.eltd-blog-type-expanding-tiles .eltd-blog-list-expandable-item .eltd-post-info-category > a');
        selector.off('click').on('click', function(e){
            e.preventDefault();
            e.stopPropagation();
            
            if (eltd.modules.blog.eltdExpandableTiles.busy) {
                return;
            }
            else {
                eltd.modules.blog.eltdExpandableTiles.busy = true;

                var currentCat = $(this);
                var currentCatId;
                if (typeof currentCat.data('cat-id') !== 'undefined' && currentCat.data('cat-id') !== false) {
                    currentCatId = currentCat.data('cat-id');
                }
                //preload trigger
                var categoryHolder = $(this).parent('.eltd-post-info-category');
                if (categoryHolder.length) {
                    categoryHolder.animate({opacity:0},100);
                    categoryHolder.after('<div class="eltd-category-preload-holder"></div>');
                }
                eltdGetCategoryHtml(currentCatId);

            }
        });
    }
    
    /* 
        Generate html for category archive page via ajax
    */
    function eltdGetCategoryHtml(catID){
        
        var blogHolder = $('.eltd-blog-holder.eltd-blog-type-expanding-tiles');
        var postNumber = blogHolder.data('post-number');        
        
        var ajaxData = {
            action: 'flow_elated_get_archive_page_html',
            postNumber: postNumber,
            currentCatId: catID,
            ajaxReq: 'yes'
        };

        //reinit load more params
        blogHolder.data('cat-id', catID); // append cat id on blog holder because of load more(infinite scroll) pagination
        blogHolder.data('next-page',2);

        $.ajax({
            type: 'POST',
            data: ajaxData,
            url: ElatedAjaxUrl,
            success: function (data) {                       

                var response = $.parseJSON(data);
                var responseHtml =  response.html;
                var maxPages = response.maxPages;

                //reinit load more params                        
                blogHolder.data('max-pages', maxPages);

                eltd.modules.blog.eltdExpandableTiles.update_grid({
                    action: 'refresh',
                    html: responseHtml
                });                        
            }
        });
    }
    function eltdGetPostTags(){
        var selector = $('.eltd-blog-holder.eltd-blog-type-expanding-tiles .eltd-blog-list-expandable-item .eltd-tags > a');
        selector.off('click').on('click', function(e){
            e.preventDefault();
            e.stopPropagation();

            if (eltd.modules.blog.eltdExpandableTiles.busy) {
                return;
            }
            else {
                eltd.modules.blog.eltdExpandableTiles.busy = true;
               
                var currentTag = $(this);
                var currentTagSlug;
                if (typeof currentTag.data('tag-slug') !== 'undefined' && currentTag.data('tag-slug') !== false) {
                    currentTagSlug = currentTag.data('tag-slug');
                }
                //preload trigger
                var tagHolder = $(this);
                if (tagHolder.length) {
                    tagHolder.parent('.eltd-tags').find('a').animate({opacity:0},100);
                    tagHolder.after('<div class="eltd-tag-preload-holder"></div>');
                }
                eltdGetTagHtml(currentTagSlug);
            }
        })
    }
    
    /* 
        Generate html for tag archive page via ajax
    */
    function eltdGetTagHtml(tagSlug){
        var blogHolder = $('.eltd-blog-holder.eltd-blog-type-expanding-tiles');
        var postNumber = blogHolder.data('post-number');
       
        var ajaxData = {
            action: 'flow_elated_get_archive_page_html',
            postNumber: postNumber,
            currentTagSlug: tagSlug,
            ajaxReq: 'yes'
        };

        //reinit load more params
        blogHolder.data('tag-slug', tagSlug); // append cat id on blog holder because of load more(infinite scroll) pagination
        blogHolder.data('next-page',2);

        $.ajax({
            type: 'POST',
            data: ajaxData,
            url: ElatedAjaxUrl,
            success: function (data) {

                var response = $.parseJSON(data);
                var responseHtml =  response.html;
                var maxPages = response.maxPages;

                //reinit load more params                        
                blogHolder.data('max-pages', maxPages);

                eltd.modules.blog.eltdExpandableTiles.update_grid({
                    action: 'refresh',
                    html: responseHtml
                });                       
            }
        });
    }
    
    function eltdGetAuthorPosts(){
        
        var selector = $('.eltd-blog-holder.eltd-blog-type-expanding-tiles article.format-link .eltd-post-info-author > a');
        selector.off('click').on('click', function(e){
            e.preventDefault();
            e.stopPropagation();

            if (eltd.modules.blog.eltdExpandableTiles.busy) {
                return;
            }
            else {
                eltd.modules.blog.eltdExpandableTiles.busy = true;
               
                var currentAuthor = $(this);
                var currentAuthorId;
                if (typeof currentAuthor.data('author-id') !== 'undefined' && currentAuthor.data('author-id') !== false) {
                    currentAuthorId = currentAuthor.data('author-id');
                }
                //preload trigger
                var authorHolder = $(this);
                if (authorHolder.length) {
                    authorHolder.parent('.eltd-tags').find('a').animate({opacity:0},100);
                    authorHolder.after('<div class="eltd-tag-preload-holder"></div>');
                }
                eltdGetAuthorHtml(currentAuthorId);
            }
        })
        
    }
    /* 
        Generate html for author archive page via ajax
    */
    function eltdGetAuthorHtml(authorId){
        
        var blogHolder = $('.eltd-blog-holder.eltd-blog-type-expanding-tiles');
        var postNumber = blogHolder.data('post-number');
       
        var ajaxData = {
            action: 'flow_elated_get_archive_page_html',
            postNumber: postNumber,
            currentAuthorId: authorId,
            ajaxReq: 'yes'
        };

        //reinit load more params
        blogHolder.data('author-id', authorId); // append cat id on blog holder because of load more(infinite scroll) pagination
        blogHolder.data('next-page',2);

        $.ajax({
            type: 'POST',
            data: ajaxData,
            url: ElatedAjaxUrl,
            success: function (data) {

                var response = $.parseJSON(data);
                var responseHtml =  response.html;
                var maxPages = response.maxPages;

                //reinit load more params                        
                blogHolder.data('max-pages', maxPages);

                eltd.modules.blog.eltdExpandableTiles.update_grid({
                    action: 'refresh',
                    html: responseHtml
                });                       
            }
        });
    }
    
    function eltdGetPageContent(){
        
        var selector = $('.eltd-blog-holder.eltd-blog-type-expanding-tiles .eltd-blog-list-expandable-item.ajax-page-content');
        selector.off('click').on('click',function(e){
            e.preventDefault();
            e.stopPropagation();

            if (eltd.modules.blog.eltdExpandableTiles.busy) {
                return;
            }
            else {
                eltd.modules.blog.eltdExpandableTiles.busy = true;
            
                var currentItemHref = $(this).find('.eltd-post-title a');
                eltd.modules.blog.eltdExpandableTiles.show_outer_page(currentItemHref);
            }
            
       });
        
    }


    /*
    * Blog Navigation Transitions
    */
    function eltdInitTransitions() {
        var animatedElements = $('.eltd-blog-single-next, .eltd-blog-single-prev');
        if (animatedElements.length) {
            animatedElements.each(function(){
                var animatedElement = $(this),
                    title = animatedElement.parent().find('.eltd-blog-navigation-info-holder a');
                animatedElement.mouseenter(function(){
                    title.addClass('eltd-animating');
                });
                animatedElement.mouseleave(function(){
                    title.removeClass('eltd-animating');
                });
            });
        }
    }

    function eltdSplitColumnPostHeight() {
        var blogHolders = $('.eltd-blog-holder');
        if ( blogHolders.length && eltd.windowWidth > 1024 ) {
            blogHolders.each(function(){
                var blogHolder = $(this);
                if ( blogHolder.hasClass('eltd-blog-type-split-column') ) {
                    var firstPost = blogHolder.find('.format-standard').eq(0),
                        soundcloud = blogHolder.find('.eltd-blog-souncloud-holder iframe'),
                        video = blogHolder.find('.format-video .fluidvids'),
                        gallery = blogHolder.find('.format-gallery .eltd-blog-gallery-item'),
                        linkQuoute = blogHolder.find('.format-link .eltd-post-text, .format-quote .eltd-post-text');

                    if ( soundcloud.length ) {
                        soundcloud.each(function(){
                            $(this).css({
                                'height' : firstPost.height()
                            })
                        });
                    }
                    if ( video.length ) {
                        video.each(function(){
                            $(this).css({
                                'padding-top' : firstPost.height()
                            })
                        });
                    }
                    if ( gallery.length ) {
                        gallery.each(function(){
                            $(this).css({
                                'min-height' : firstPost.height()
                            })
                        });
                    }
                    if ( linkQuoute.length ) {
                        linkQuoute.each(function(){
                            $(this).css({
                                'min-height' : firstPost.height()
                            })
                        });
                    }
                }
            });
        }
    }

})(jQuery);
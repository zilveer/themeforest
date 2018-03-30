(function($) {
    'use strict';

    var ajax = {};

    eltd.modules.ajax = ajax;

    var animation = {};
    ajax.animation = animation;

    ajax.eltdFetchPage = eltdFetchPage;
    ajax.eltdInitAjax = eltdInitAjax;
    ajax.eltdHandleLinkClick = eltdHandleLinkClick;
    ajax.eltdInsertFetchedContent = eltdInsertFetchedContent;
    ajax.eltdInitBackBehaviour = eltdInitBackBehaviour;
    ajax.eltdSetActiveState = eltdSetActiveState;
    ajax.eltdReinitiateAll = eltdReinitiateAll;
    ajax.eltdHandleMeta = eltdHandleMeta;

    ajax.eltdOnDocumentReady = eltdOnDocumentReady;
    ajax.eltdOnWindowLoad = eltdOnWindowLoad;
    ajax.eltdOnWindowResize = eltdOnWindowResize;
    ajax.eltdOnWindowScroll = eltdOnWindowScroll;

    $(document).ready(eltdOnDocumentReady);
    $(window).load(eltdOnWindowLoad);
    $(window).resize(eltdOnWindowResize);
    $(window).scroll(eltdOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdOnDocumentReady() {
        eltdInitAjax();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function eltdOnWindowLoad() {
        qodefHandleAjaxFader();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function eltdOnWindowResize() {
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function eltdOnWindowScroll() {
    }


    var loadedPageFlag = true; // Indicates whether the page is loaded
    var firstLoad = true; // Indicates whether this is the first loaded page, for back button functionality
    animation.type = null;
    animation.time = 500; // Duration of animation for the content to be changed
    animation.simultaneous = true; // False indicates that the new content should wait for the old content to disappear, true means that it appears at the same time as the old content disappears
    animation.loader = null;
    animation.loaderTime = 500;

    /**
     * Fetching the targeted page
     */
    function eltdFetchPage(params, destinationSelector, targetSelector) {

        function setDefaultParam(key,value) {
            params[key] = typeof params[key] !== 'undefined' ? params[key] : value;
        }

        destinationSelector = typeof destinationSelector !== 'undefined' ? destinationSelector : '.eltd-content';
        targetSelector = typeof targetSelector !== 'undefined' ? targetSelector : '.eltd-content';
        
        // setting default ajax parameters
        params = typeof params !== 'undefined' ? params : {};

        setDefaultParam('url', window.location.href);
        setDefaultParam('type', 'POST');
        setDefaultParam('success', function(response) {
            var jResponse = $(response);

            var meta = jResponse.find('.eltd-meta');
            if (meta.length) { eltdHandleMeta(meta); }

            var new_content = jResponse.find(targetSelector);
            if (!new_content.length) {
                loadedPageFlag = true;
                return false;
            }
            else {
                eltdInsertFetchedContent(params.url, new_content, destinationSelector);
            }
        });

        // setting data parameters
        setDefaultParam('ajaxReq', 'yes');

        $.ajax({
            url: params.url,
            type: params.type,
            data: {
                ajaxReq: params.ajaxReq
            },
            success: params.success
        });
    }

    function qodefHandleAjaxFader() {
        if (animation.loader.length) {
            if (firstLoad) {
                animation.loader.fadeOut(animation.loaderTime);
            }
            $(window).bind("pageshow", function(event) {
                if (event.originalEvent.persisted) {
                    animation.loader.fadeOut(animation.loaderTime);
                }
            });
        }
    }

    function eltdInitAjax() {
        eltd.body.removeClass('page-not-loaded'); // Might be necessary for ajax calls
        animation.loader = $('body > .eltd-smooth-transition-loader.ajax');
        if (animation.loader.length) {

            if(eltd.body.hasClass('woocommerce') || eltd.body.hasClass('woocommerce-page')) {
                return false;
            }
            else {
                eltdInitBackBehaviour();
                $(document).on('click', 'a[target!="_blank"]:not(.no-ajax):not(.no-link)', function(click) {
                    var link = $(this);

                    if(click.ctrlKey == 1) { // Check if CTRL key is held with the click
                        window.open(link.attr('href'), '_blank');
                        return false;
                    }

                    if(link.parents('.eltd-ptf-load-more').length){ return false; } // Don't initiate ajax for portfolio load more link

                    if(link.parents('.eltd-blog-load-more-button').length){ return false; } // Don't initiate ajax for blog load more link

                    if(link.parents('eltd-post-info-comments').length){ // If it's a comment link, don't load any content, just scroll to the comments section
                        var hash = link.attr('href').split("#")[1];  
                        $('html, body').scrollTop( $("#"+hash).offset().top );  
                        return false;  
                    }

                    if(window.location.href.split('#')[0] == link.attr('href').split('#')[0]){ return false; } //  If the link leads to the same page, don't use ajax

                    if(link.closest('.eltd-no-animation').length === 0){ // If no parents are set to no-animation...

                        if(document.location.href.indexOf("?s=") >= 0){ // Don't use ajax if currently on search page
                            return true;
                        }
                        if(link.attr('href').indexOf("wp-admin") >= 0){ // Don't use ajax for wp-admin
                            return true;
                        }
                        if(link.attr('href').indexOf("wp-content") >= 0){ // Don't use ajax for wp-content
                            return true;
                        }

                        var no_hash_url = link.attr('href').split('#')[0];
                        if(
                            jQuery.inArray(no_hash_url, eltdGlobalVars.vars.no_ajax_pages) !== -1 || 
                            jQuery.inArray(no_hash_url + '/', eltdGlobalVars.vars.no_ajax_pages) !== -1 || 
                            (no_hash_url[no_hash_url.length-1] == '/' && jQuery.inArray(no_hash_url.substr(0,no_hash_url.length-1), eltdGlobalVars.vars.no_ajax_pages) !== -1)) { // If the target page is a no-ajax page, don't use ajax
                            document.location.href = link.attr('href');
                            return false;
                        }

                        if((link.attr('href') !== "http://#") && (link.attr('href') !== "#")){ // Don't use ajax if the link is empty
                            //disableHashChange = true;

                            var url = link.attr('href');
                            var start = url.indexOf(window.location.protocol + '//' + window.location.host); // Check if the link leads to the same domain
                            if(start === 0){
                                if(!loadedPageFlag){ return false; } //if page is not loaded don't load next one
                                click.preventDefault();
                                click.stopImmediatePropagation();
                                click.stopPropagation();
                                if (!link.is('.current')) {
                                    eltdHandleLinkClick(link);
                                }
                            }

                        }else{
                            return false;
                        }
                    }
                });
            }
        }
    }

    function eltdInitBackBehaviour() {
        if (window.history.pushState) {
            /* the below code is to override back button to get the ajax content without reload*/
            $(window).bind('popstate', function() {
                "use strict";

                var url = location.href;
                if (!firstLoad && loadedPageFlag) {
                    loadedPageFlag = false;
                    eltdFetchPage({
                        url: url
                    });
                }
            });
        }
    }

    function eltdHandleLinkClick(link) {
        loadedPageFlag = false;
        animation.loader.fadeIn(animation.loaderTime);
        eltdFetchPage({
            url: link.attr('href')
        });
    }

    function eltdSetActiveState(url) {
        var me = $("nav a[href='"+url+"'], .widget_nav_menu a[href='"+url+"']");

        $('.eltd-main-menu a, .eltd-mobile-nav a, .eltd-mobile-nav h4, .eltd-vertical-menu a, .popup_menu a').parent().removeClass('eltd-active-item');
        //$('.main_menu a, .mobile_menu a, .mobile_menu h4, .vertical_menu a, .popup_menu a').parent().removeClass('active');

        me.each(function() {
            var me = $(this);

            if(me.closest('.second').length === 0){
                me.parent().addClass('eltd-active-item');
            }else{
                me.closest('.second').parent().addClass('eltd-active-item');
            }

            if(me.closest('.eltd-mobile-nav').length > 0){
                me.closest('.level0').addClass('eltd-active-item');
                me.closest('.level1').addClass('eltd-active-item');
                me.closest('.level2').addClass('eltd-active-item');
            }

            if(me.closest('.widget_nav_menu').length > 0){
                $('.widget_nav_menu ul.menu > li').removeClass('current-menu-item');
                me.closest('.widget_nav_menu').find('.menu-item').addClass('current-menu-item');
            }


            $('.eltd-main-menu a, .eltd-mobile-nav a, .eltd-vertical-menu a, .popup_menu a').removeClass('current');
            me.addClass('current');
        });
    }

    /**
     * Reinitiate all function
     *
     * @param modules - array of modules to exclude
     */
    function eltdReinitiateAll( modulesToExclude ) {
        $(document).off(); // Remove all event handlers before reinitialization
        eltd.body.off().find('*').off(); // Remove all event handlers before reinitialization

        eltd.eltdOnDocumentReady();
        eltd.eltdOnWindowLoad();
        eltd.eltdOnWindowResize();
        eltd.eltdOnWindowScroll();

        var defaultModules = ['common', 'ajax', 'header', 'headerBehaviour', 'title', 'blog', 'like', 'shortcodes'];
        var modules = [];

        if ( typeof modulesToExclude !== 'undefined' && modulesToExclude.length ) {
            defaultModules.forEach(function(key) {
                if (-1 === modulesToExclude.indexOf(key)) {
                    modules.push(key);
                }
            }, this);
        } else {
            modules = defaultModules;
        }

        for (var i=0; i<modules.length; i++) {
            if (1 || typeof eltd.modules[modules[i]] !== 'undefined') {
                eltd.modules[modules[i]].eltdOnDocumentReady();
                eltd.modules[modules[i]].eltdOnWindowLoad();
                eltd.modules[modules[i]].eltdOnWindowResize();
                eltd.modules[modules[i]].eltdOnWindowScroll();
            }
        }
    }

    function eltdHandleMeta(meta_data) {
        // set up title, meta description and meta keywords
        var newTitle = meta_data.find(".eltd-seo-title").text();
        var pageTransition = meta_data.find(".eltd-page-transition").text();
        var newDescription = meta_data.find(".eltd-seo-description").text();
        var newKeywords = meta_data.find(".eltd-seo-keywords").text();
        if (typeof pageTransition !== 'undefined') {
            animation.type = pageTransition;
        } 
        if ($('head meta[name="description"]').length) {
            $('head meta[name="description"]').attr('content', newDescription);
        } else if (typeof newDescription !== 'undefined') {
            $('<meta name="description" content="'+newDescription+'">').prependTo($('head'));
        } 
        if ($('head meta[name="keywords"]').length) {
            $('head meta[name="keywords"]').attr('content', newKeywords);
        } else if (typeof newKeywords !== 'undefined') {
            $('<meta name="keywords" content="'+newKeywords+'">').prependTo($('head'));
        } 
        document.title = newTitle;

        var newBodyClasses = meta_data.find(".eltd-body-classes").text();
        var myArray = newBodyClasses.split(',');
        eltd.body.removeClass();
        for(var i=0;i<myArray.length;i++){
            if (myArray[i] !== "eltd-page-not-loaded"){
                eltd.body.addClass(myArray[i]);
            }
        }

        if($("#wp-admin-bar-edit").length > 0){
            // set up edit link when wp toolbar is enabled
            var pageId = meta_data.find("#eltd-page-id").text();
            var old_link = $('#wp-admin-bar-edit a').attr("href");
            var new_link = old_link.replace(/(post=).*?(&)/,'$1' + pageId + '$2');
            $('#wp-admin-bar-edit a').attr("href", new_link);
        }
    }

    function eltdInsertFetchedContent(url, new_content, destinationSelector) {
        destinationSelector = typeof destinationSelector !== 'undefined' ? destinationSelector : '.eltd-content';
        var destination = eltd.body.find(destinationSelector);
        
        
        
        $('.eltd-wrapper').css('overflow','hidden');
        new_content.height(destination.height()).css({'position': 'relative', 'opacity': 0, 'overflow': 'hidden'}).insertBefore(destination);
        destination.css({'position': 'absolute', 'width': new_content.width()+'px', 'top': new_content.offset().top - new_content.parent().offset().top +'px', 'left': new_content.offset().left - new_content.parent().offset().left + parseInt(new_content.parent().css('padding-left'),10) + 'px'});
       
        new_content.waitForImages(function() {
            if (url.indexOf('#') !== -1) {
                $('<a class="eltd-temp-anchor eltd-anchor" href="'+url+'" style="display: none"></a>').appendTo('body');
            }
            firstLoad = false;
            eltdReinitiateAll();

            if (animation.type == "fade") {
                destination.stop().fadeTo(animation.time, 0, function() {
                    destination.remove();
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
                    eltdSetActiveState(url);
                    eltd.body.animate({scrollTop: 0}, animation.time, 'swing');
                });
                setTimeout(function() {
                    new_content.css('position','relative').height('').stop().fadeTo(animation.time, 1, function() {
                        $('.eltd-wrapper').css('overflow','');
                        loadedPageFlag = true;
                        //firstLoad = false;
                        animation.loader.fadeOut(animation.loaderTime, function() {
                            var anch = $('.eltd-temp-anchor');
                            if (anch.length) {
                                anch.trigger('click').remove();
                            }
                        });
                    });
                }, !animation.simultaneous * animation.time);
            }
        });
    }


})(jQuery);
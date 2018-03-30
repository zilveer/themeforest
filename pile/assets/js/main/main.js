var $window             = $(window),
    $document           = $(document),
    $html               = $('html'),
    $body               = $('body'),
    // needed for browserSize
    windowWidth         = window.innerWidth,
    windowHeight        = window.innerHeight,
    orientation         = windowWidth > windowHeight ? 'landscape' : 'portrait',
    documentHeight      = $document.height(),
    // needed for requestAnimationFrame
    knownScrollY        = -1,
    latestKnownScrollY  = window.scrollY,
    scrollDirection     = 'down',
    resized             = true,
    scrolled            = true,
    isLoadingProjects   = false,
    $portfolio_container;

if ( window.location.hash.indexOf('comment') > -1 ) {
    $html.css('opacity', 0);
    window.location.href = window.location.href.split('#')[0];
}

fixWindowHeight();

function fixWindowHeight() {
    if ( Modernizr.touchevents && typeof window.screen.height !== "undefined" && orientation == 'portrait' ) {
        windowHeight = window.screen.height;
    }
}

function onResize() {
    var newOrientation;

    windowWidth = window.innerWidth;
    windowHeight = window.innerHeight;
    documentHeight = $document.height();
    newOrientation = windowWidth > windowHeight ? 'landscape' : 'portrait';
    fixWindowHeight();

    if ( ! Modernizr.touchevents || newOrientation !== orientation ) {
        orientation = newOrientation;
        fixWindowHeight();
        resizeVideos();
        requestAnimationFrame(refresh);
    }
}

$(document).on('ready', function() {
    init();
});

function init() {
    if (globalDebug) {console.group("global::init");}

    var iexplore = getInternetExplorerVersion();
    if ( iexplore ) { $body.addClass('is--ie is--ie-' + iexplore); }

    eventHandlersOnce();
    eventHandlers();

    if (globalDebug) {console.groupEnd();}
}

function onDocumentReady() {
    if (globalDebug) {console.log("document.ready");}

    $html.addClass('is-ready');

    platformDetect();
    loadAddThisScript();
    AjaxLoading.init();

    loadingAnimation.init();
    updateLoop();

    $('.article').addClass('post--loaded');
}

function refresh() {
    Parallax.initialize();
    ArchiveParallax.initialize();
    Pile.initialize();
    Header.init();

    $('.hero--next').imagesLoaded(function() {
        scaleImage($('.hero--next').find('img, video'));
    });
}



/* ====== CONDITIONAL LOADING ====== */

function onLoad() {
    if (globalDebug) {console.group("global::onLoad");}

    initVideos();
    resizeVideos();
    Nav.init();
    magnificPopupInit();

    var $masonry = $('.masonry');
    $masonry.imagesLoaded(function() {
        $masonry.masonry({ transitionDuration: 0 });
    });

    $('.pixcode--tabs').organicTabs();

    if (typeof woocommerce_events_handlers == 'function') {
        woocommerce_events_handlers();
    }

    $('.video-placeholder').each(function(i, obj) {
        var $placeholder = $(obj),
            video = document.createElement('video'),
            $video = $(video).addClass('hero-bg hero-bg--video');

        video.onloadedmetadata = function() {
            scaleImage($video);
            video.play();
        };

        video.src       = $placeholder.data('src');
        video.poster    = $placeholder.data('poster');
        video.muted     = true;
        video.loop      = true;
        $placeholder.replaceWith($video);

        if ( Modernizr.touchevents ) {
            // if ( isiPhone ) {
                makeVideoPlayableInline( video, /* hasAudio */ false);
            // }
        }

    });

    requestAnimationFrame(refresh);
    royalSliderInit();
    handleCustomCSS();

    $('iframe').each(function() {
        var $iframe = $(this),
            url = $iframe.attr("src");
        $iframe.attr("src",url+"?wmode=transparent");
        $iframe.on('load', resizeVideos);
    });

    if ( $body.is('.js-open-cart') ) {
        TweenMax.to($body, .3, {opacity: 1});
        $body.addClass('is-cart-open');
    }

    loadDynamicScripts();

    if (globalDebug) {console.groupEnd();}
}

function handleCustomCSS() {
    var $element, css;

    $element = $('#customCSS');

    if ( $element.length ) {
        css = $element.data('css');

        if ( typeof css !== "undefined" ) {
            $('<style type="text/css">' + css + '</style>').insertAfter($element);
            $element.remove();
        }
    }
}

function loadDynamicScripts() {
    if ( ! window.hasOwnProperty('pile_static_resources') ) return;

    var $scripts = $('#pile_scripts_and_styles'),
        scripts = $scripts.data('scripts'),
        styles = $scripts.data('styles');

    // pile_dynamic_loaded_scripts is generated in footer when all the scripts should be already enqueued
    $.each(scripts, function (key, url) {
        if (key in pile_static_resources.scripts) return;

        // add this script to our global stack so we don't enqueue it again
        pile_static_resources.scripts[key] = url;

        $.ajaxSetup({
            cache: true,
            async: false
        });

        jQuery.ajax({
            async:false,
            type:'GET',
            url:url,
            data:null,
            success:function (script, textStatus) {
//                                  console.log(textStatus);
                $(document).trigger('pile' + key + ':script:loaded');
            },
            fail:function (script, textStatus) {
//                                  console.log(textStatus);
                console.log('could not load ' + key + ' script');
            },
            dataType:'script'
        });

        if (globalDebug) {
            console.groupEnd();
        }

    });

    $(document).trigger('pile:dynamic_scripts:loaded');

    $.each(styles, function (key, url) {

        if (key in pile_static_resources.styles) return;

        // add this style to our global stack so we don't enqueue it again
        pile_static_resources.styles[key] = url;

        $.ajax({
            cache: true,
            async: true,
            url: url,
            dataType: 'html',
            success: function (data) {
                $('<style type="text/css">\n' + data + '</style>').appendTo("head");
            }
        });

        if (globalDebug) {
            console.groupEnd();
        }

    });
    $(document).trigger('pile:dynamic_styles:loaded');
}

/* ====== EVENT HANDLERS ====== */

function eventHandlersOnce() {
    if (globalDebug) {console.group("eventHandlers::once");}

    copyrightOverlayInit();

    $('a[href="#top"]').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        smoothScrollTo(0);
    });

    var resizeTimer;

    $window.on('resize', function(e) {

        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            // Run code here, resizing has "stopped"
            $window.trigger('debouncedresize');
            onResize();
        }, 250);

    });


    $window.scroll(onScroll);
    $window.load(function() {
        if (globalDebug) {console.log("window.load");}
        $html.addClass('is-loaded');
        onLoad();
        loadingAnimation.play();
    });

    $document.ready(onDocumentReady);

    $document.on('post-load', function () {
        if (globalDebug) {console.log("Jetpack Post load");}

        initVideos();
        resizeVideos();

        // figure out which are the new loaded posts
        var $newBlocks = $('.masonry').children().not('.post--loaded').addClass('post--loaded').filter('.article');

        $newBlocks.imagesLoaded(function () {
            $('.masonry').masonry('appended', $newBlocks, true).masonry('layout');
        });

    });

    if (globalDebug) {console.groupEnd();}
}

function eventHandlers() {
    if (globalDebug) {console.group("eventHandlers");}

    // var nextVideoTimeout;

    // $('.hero--next').hover(function() {
    //     $(this).find('video').each(function(i, video) {
    //         clearTimeout(nextVideoTimeout);
    //         video.play();
    //     });
    // }, function() {
    //     $(this).find('video').each(function(i, video) {
    //         nextVideoTimeout = setTimeout(function() {
    //             video.pause();
    //         }, 300);
    //     });
    // });

    $body.on('click touchstart .cart-widget', function(e) {
        var $target = $(e.target);

        if ( $target.is('.cart-widget') ) {
            $body.removeClass('is-cart-open');

            // Prevent click event from bubbling
            // onto other element beneath cart widget
            e.preventDefault();
            e.stopPropagation();
        }
    });

    $('.hero-bg--map').on('click', function() {
        $(this).addClass('is-active');
    });

    // Scroll Down Arrows on Full Height Hero
    $('.hero-scroll-down').on('click', function(e) {
        smoothScrollTo(windowHeight);
    });

    var $thumbnails = $('.js-post-gallery .thumbnails'),
        $images = $('.js-post-gallery .big-images');

    $thumbnails.on('click', 'a', function(e) {
        e.preventDefault();
        e.stopPropagation();

        var $item = $(this),
            index = $item.index();

        $thumbnails.children().removeClass('current').eq(index).addClass('current');
        $images.children().removeClass('current').eq(index).addClass('current');

        return false;
    });

    $('.js-cart-icon').on('click', function(e) {
        $body.addClass('is-cart-open');
        e.preventDefault();
    });

    $document.keyup(function(e){
        if (e.keyCode === 27) {
            $body.removeClass('is-cart-open');
        }
    });

    if (globalDebug) {console.groupEnd();}
}


function onScroll(e) {
    latestKnownScrollY = $(this).scrollTop();
}

var scheduledAnimationFrame = false;

function updateLoop() {
    if (scheduledAnimationFrame) return;
    scheduledAnimationFrame = true;

    if ( knownScrollY !== latestKnownScrollY ) {
        scrollDirection = latestKnownScrollY > knownScrollY ? 'down' : 'up';
        knownScrollY = latestKnownScrollY;
        update();
    }

    requestAnimationFrame(function() {
        scheduledAnimationFrame = false;
        updateLoop();
    });

    scrolled = false;
    resized = false;
}

function update() {
    Parallax.update();
    ArchiveParallax.update();
    Pile.update();
    Header.update();
}


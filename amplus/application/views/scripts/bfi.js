var bfi;

(function($) {
    
bfi = {
    lang: {
        loadingNext: "Loading next items",
        noMoreItems: "No more items to load",
        tweet: "Tweet",
        like: "Like",
        plusOne: "+1",
        pin: "Pin"
    },
    rtl: false,
    
    fixImageWidths: function() {
        $('.content').find('img.alignnone, img.size-full, img.alignleft, img.alignright, img.aligncenter').each(function() {
            $(this).attr('data-origwidth', $(this).width());
            var p = $(this).parents('.column, .columns, div, span').not('.wp-caption');
            var img = $(this);
            if (p.length > 0) {
                p = p.eq(0);
                $(window).resize(function() {
                    if (parseInt(img.attr('data-origwidth')) > p.width()) { 
                        img.width(p.width());
                        img.addClass('made-small');
                    } else { 
                        img.css('width', 'auto');
                        img.removeClass('made-small');
                    }
                });
            }
        });
        $('.content').find('.wp-caption').each(function() {
            $(this).attr('data-origwidth', $(this).width());
            var p = $(this);
            $(window).resize(function() {
                if (parseInt(p.attr('data-origwidth')) > p.width()) { 
                    p.addClass('made-small');
                } else {
                    p.removeClass('made-small');
                }
            });
        });
        $(window).trigger('resize');
    },
    
    // re-places alpha and omega classes in columns
    portfolioRearrangeCols: function(cols, colClass) {
        var i = 0;
        for (var x = 0; x < $('.blog-content '+colClass+':not(.hidden)').length; x++) {
            $('.blog-content '+colClass+':not(.hidden):eq('+x+')').removeClass('alpha omega');
            if (x % cols == 0) {
                $('.blog-content '+colClass+':not(.hidden):eq('+x+')').addClass('alpha');
            } else if (x % cols == cols - 1) {
                $('.blog-content '+colClass+':not(.hidden):eq('+x+')').addClass('omega');
            }
        }
    },
    
    // filter function for portfolio pages
    portfolioFilter: function(obj) {
        //if ($(obj).hasClass('selected')) { return; }
        
        // change button classes
        $('.filters > .button').removeClass('selected').removeClass('not-selected').addClass('not-selected');
        $(obj).removeClass('not-selected').addClass('selected');
        
        var filter = $(obj).attr('data-filter');
        
        // filter in and out the items
        if (filter != '') {
            $('.blog-content > article').each(function() {
                var cats = $(this).attr('data-cats').split(',');
                if (cats.indexOf(filter) != -1) {
                    $(this).removeClass('hidden');//.fadeOut();
                } else {
                    $(this).addClass('hidden');//.fadeIn();
                }
            })
        // show everything
        } else {
            $('.blog-content > article').removeClass('hidden');//.fadeIn();
        }
        
        var cols = 2;
        var colClass = '.one-half';
        if ($('.blog-content .one-fourth').length) {
            cols = 4;
            colClass = '.one-fourth';
        } else if ($('.blog-content .one-third').length) {
            cols = 3;
            colClass = '.one-third';
        }
        
        // bfi.portfolioRearrangeCols(cols, colClass);
        setTimeout("bfi.portfolioRearrangeCols("+cols+", '"+colClass+"')", 100);
    },
    
    init : function() {
        
        this.fixImageWidths();
        
        if ($("#main-menu").length) {
            ddsmoothmenu.init({
                mainmenuid: "main-menu",
                orientation: 'h',
                contentsource: "markup",
                rtl: bfi.rtl
            });
        }
        // enable tinyNav. class "current-menu-item" is given by WP
        $("#main-menu > ul").tinyNav({active: 'current-menu-item'});
        
        // fit all youtube and vimeo videos
        $('iframe').parent().fitVids();
        
        /* 
         * accordions
         */
        $('.bfi_accordion li > h4').click(function(e) { 
            e.preventDefault();
            if (!$(this).hasClass('selected') && $(this).find(':animated').length == 0) {
                $(this).parents('.bfi_accordion').find('li > h4.selected').attr('class', '').closest('li').find('div').slideToggle();
                $(this).addClass('selected');
                $(this).closest('li').find('div').not(':animated').slideToggle();
            }
        })
        
        // initialize accordion
        $('.bfi_accordion').each(function() {
            $(this).children().find('h4').eq($(this).attr('data-opentab')).trigger('click');
        });
        
        /*
         * tabs
         */
        $('.bfi_tabs').each(function() {
            $(this).append('<ul class="tab-body"></ul>');
            $(this).find('ul.tab-title > li div').each(function() {
                $(this).parents('.bfi_tabs').find('ul.tab-body').append('<li></li>');
                $(this).parents('.bfi_tabs').find('ul.tab-body > li:last').append($(this).html());
                $(this).remove();
            });
        });
        $('.bfi_tabs ul.tab-title h4').click(function(e) {
            e.preventDefault();
            if (!$(this).hasClass('selected') && $(this).parents('.bfi_tabs').find(':animated').length == 0) {
                $(this).parents('.bfi_tabs').find('.tab-title > li').attr('class', '');
                $(this).parents('li').addClass('selected');
                var a = $(this).parents('.bfi_tabs').find('.tab-title > li.selected').index()
                $(this).parents('.bfi_tabs').find('.tab-body > li').fadeOut(0).eq(a).fadeIn(300);
            }
        });
        // initialize tabs
        $('.bfi_tabs').each(function() {
            $(this).find('.tab-title h4').eq($(this).attr('data-opentab')).trigger('click');
        });
        
        // apply syntax highlights
        if (typeof SyntaxHighlighter != 'undefined') {
            $('.bfi_syntaxhighlighter').css('display', 'none');
            SyntaxHighlighter.defaults['gutter'] = true;
            SyntaxHighlighter.defaults['toolbar'] = false;
            SyntaxHighlighter.all();
        }

        /*
         * Toggler
         */
        $('.bfi_toggle > h4').click(function(e) { 
            e.preventDefault();
            if ($(this).parent().find(':animated').length == 0) {
                $(this).parent().toggleClass('open').find('div:eq(0)').slideToggle();
            }
        });
        // initialize togglers
        $('.bfi_toggle:not(.open)').each(function() {
            $(this).find('div:eq(0)').slideToggle(0);
        });
        // $('.bfi_toggle:not(.open) div:eq(0)').slideToggle(0);
        
        /*
         * Info boxes
         */
        $('.bfi_infobox').click(function(e) {
            $(this).not(':animated').fadeOut();
        })
        
        /*
         * Tooltips
         */
        // if ($('section*[data-tooltip]').qtip != undefined) {
        //             $('section *[data-tooltip], footer > .widget-container *[data-tooltip]').each(function() {
        //                 $(this).qtip({
        //                     content: {
        //                         attr: 'data-tooltip'
        //                     },
        //                     position: {
        //                         my: 'bottom left',
        //                         at: 'top left'
        //                     }
        //                 });
        //             });
        //         }
        if ($('*[data-tooltip]').qtip != undefined) {
            $('*[data-tooltip]').each(function() {
                if ($(this).attr('data-x') == undefined) { $(this).attr('data-x', 0) }
                if ($(this).attr('data-y') == undefined) { $(this).attr('data-y', 0) }
                if ($(this).attr('data-my') == undefined) { $(this).attr('data-my', 'bottom left') }
                if ($(this).attr('data-at') == undefined) { $(this).attr('data-at', 'top center') }
                $(this).qtip({
                    content: {
                        attr: 'data-tooltip'
                    },
                    position: {
                        my: $(this).attr('data-my'),
                        at: $(this).attr('data-at'),
                        adjust: {
                            x: parseInt($(this).attr('data-x')),
                            y: parseInt($(this).attr('data-y'))
                        }
                    }
                });
            });
        }
        
        /*
         * Pricing table
         */
        $('.bfi_pricingtable > div > .description').equalHeights();
        $('.bfi_pricingtable > div > .description > div').vAlign();
        
        /*
         * Fancybox
         */
        $('a.fancybox:not(.video)').each(function() { 
            $(this).fancybox({
                'titlePosition':'inside'
            }) 
        });
        $('a.fancybox.video').each(function() { 
            $(this).fancybox({
                type: 'iframe',
            }) 
        });
        $('a.fancybox, a.lightbox').hover(function() { 
            $(this).addClass('hovered');
        });
        
        /*
         * lazy load images
         */
        if ($('img[data-original]').lazyload != undefined) {
            $('img[data-original]').show().lazyload({ 
                threshold : 150,
                effect : "fadeIn"
            });
        }
        
        $('.nivoSlider .nivo-main-image').css('height', '100%');
        $(window).resize(function() {
            $('.nivoSlider .nivo-main-image').css('height', '100%');
        });
        
        
        /*
         * infinite scrolling content
         */
        if ($('.blog-content').infinitescroll != undefined &&
            $('#page-nav').length > 0 &&
            $('#page-nav a.next').length > 0) {
            $('#page-nav').hide(0);
            $('.blog-content').infinitescroll({
                navSelector  : "#page-nav", // selector for the paged navigation (it will be hidden)
                nextSelector : "#page-nav a.next", // selector for the NEXT link (to page 2)
                itemSelector : ".blog-content article", // selector for all items you'll retrieve
                debug: false,
                loading: {
                    img: '',
                    msgText: "<i class='icon-spinner icon-large icon-spin'></i> <em>"+bfi.lang.loadingNext+"...</em>",
                    finishedMsg: "<i class='icon-exclamation-sign icon-large'></i> <em>"+bfi.lang.noMoreItems+".</em>"
                }
            }, function(arrayOfNewElems){
                // stop the suddent fade, and slide up instead for a more smoother effect
                $('#infscr-loading').stop().slideUp();
                // create a unique class name for the newly added elements
                var id = 'loaded-' + $('.blog-content article').length;
                // add the new class
                $(arrayOfNewElems).each(function() {
                    $(this).addClass(id);
                });
                // Lazy load the images
                if ($('img[data-original]').lazyload != undefined) {
                    $('article.'+id).find('img[data-original]').show().lazyload({ 
                        threshold : 150,
                        effect : "fadeIn"
                    });
                }
                // fit all youtube and vimeo videos
                $('article.'+id+' iframe').parent().fitVids();
                // apply fancybox lightboxes
                $('article.'+id+' a.fancybox:not(.video)').each(function() { 
                    $(this).fancybox({
                        'titlePosition':'inside'
                    }) 
                });
                $('article.'+id+' a.fancybox.video').each(function() { 
                    $(this).fancybox({
                        type: 'iframe',
                    }) 
                });
                // fix arrangement of portfolio if possible
                if ($('.filter.selected').length) {
                    bfi.portfolioFilter($('.filter.selected')[0]);
                }
                // try and trigger some additional methods (this is mostly for IE)
                $.event.trigger({type: 'loadedNextItems'});
                // bring back the lightbox overlays
                $('article.'+id+' a.fancybox, article.'+id+' a.lightbox').hover(function() { 
                    $(this).addClass('hovered');
                });
            });
         }
         
         /*
          * Clean up footer of WP's calendar widget
          */
         $('.widget_calendar tfoot').each(function() { 
             if ($(this).find('td').length == 3) {
                 if ($(this).find('td:eq(0)').html() == "&nbsp;" &&
                     $(this).find('td:eq(1)').html() == "&nbsp;" &&
                     $(this).find('td:eq(2)').html() == "&nbsp;") {
                     $(this).css('display', 'none');
                 }
             }
         });
         
         
         /*
          * Social buttons
          */
          // TODO: CHANGE PHP VARS INTO DATA-* ATTRIBUTES
         $('.share-twitter').each(function() {
             $(this).sharrre({
                 share: {
                     twitter: true
                 },
                 template: '<a class=\"box\" href=\"#\"><div class=\"count\" href=\"#\">{total}</div><div class=\"share\"><i class=\"icon-twitter\"></i>'+bfi.lang.tweet+'</div></a>',
                 enableHover: false,
                 enableTracking: true,
                 click: function(api, options){
                    api.simulateClick();
                    api.openPopup('twitter');
                 },
                 text: $(this).attr('data-title')
             });
          });
         $('.share-facebook').each(function() {
             $(this).sharrre({
                 share: {
                     facebook: true
                 },
                 template: '<a class=\"box\" href=\"#\"><div class=\"count\" href=\"#\">{total}</div><div class=\"share\"><i class=\"icon-facebook\"></i>'+bfi.lang.like+'</div></a>',
                 enableHover: false,
                 enableTracking: true,
                 click: function(api, options){
                     api.simulateClick();
                     api.openPopup('facebook');
                 }
             });
         });
         $('.share-googleplus').each(function() {
             $(this).sharrre({
                 share: {
                     googlePlus: true
                 },
                 urlCurl: $(this).attr('data-curl'),
                 template: '<a class=\"box\" href=\"#\"><div class=\"count\" href=\"#\">{total}</div><div class=\"share\"><i class=\"icon-google-plus\"></i>'+bfi.lang.plusOne+'</div></a>',
                 enableHover: false,
                 enableTracking: true,
                 click: function(api, options){
                     api.simulateClick();
                     api.openPopup('googlePlus');
                 },
                 title: $(this).attr('data-title')
             });
         });
         $('.share-pinterest').each(function() {
             $(this).sharrre({
                 share: {
                     pinterest: true
                 },
                 urlCurl: $(this).attr('data-curl'),
                 template: '<a class=\"box\" href=\"#\"><div class=\"count\" href=\"#\">{total}</div><div class=\"share\"><i class=\"icon-pinterest\"></i>'+bfi.lang.pin+'</div></a>',
                 enableHover: false,
                 enableTracking: true,
                 click: function(api, options){
                     api.simulateClick();
                     api.openPopup('pinterest');
                 },
                 title: $(this).attr('data-title'),
                 buttons: {
                     pinterest: {
                         media: $(this).attr('data-media'),
                         description: $(this).attr('data-desc')
                     }
                 }
             });
         });
         
         
         /*
          * fix the location of the recaptcha error for comment forms only
          */
         $('#respond .error.icon-warning-sign').appendTo('#respond .error_container');
    },
}

})(jQuery);



// http://imgscale.kjmeath.com
(function(a){a.fn.imgscale=function(f){f=a.extend({parent:false,scale:"fill",center:true,fade:0},f);var i,e,j,k,c,d,h,b;this.each(function(){var l=a(this);var m=(!f.parent?l.parent():l.parents(f.parent));m.css({opacity:0,overflow:'hidden'});if(m.length>0){l.removeAttr("height").removeAttr("width");if(this.complete){g(l,m,false)}else{l.load(function(){g(l,m,true)})}}});function g(l,p,r){i=p.height();e=p.width();j=l.height();k=l.width();n();function n(){if(e>i){m("w")}else{if(e<i){m("t")}else{if(e==i){m("s")}}}}function m(v){if(k>j){t(v,"w")}else{if(k<j){t(v,"t")}else{if(k==j){t(v,"s")}}}}function t(w,v){if(w=="w"&&v=="w"){q()}else{if(w=="w"&&v=="t"){s("w")}else{if(w=="w"&&v=="s"){s("w")}else{if(w=="t"&&v=="w"){s("w")}else{if(w=="t"&&v=="t"){q()}else{if(w=="t"&&v=="s"){s("t")}else{if(w=="s"&&v=="w"){s("t")}else{if(w=="s"&&v=="t"){s("w")}else{if(w=="s"&&v=="s"){s("w")}}}}}}}}}}function q(){if((k*i/k)>=e){s("t")}else{s("w")}}function s(v){switch(v){case"t":if(f.scale=="fit"){l.attr("width",e)}else{l.attr("height",i)}break;case"w":if(f.scale=="fit"){l.attr("height",i)}else{l.attr("width",e)}break}if(f.center){o()}else{u()}}function o(){c=l.width();d=l.height();if(d>i){b="-"+(Math.floor((d-i)/2))+"px";l.css("margin-top",b)}if(c>e){h="-"+(Math.floor((c-e)/2))+"px";l.css("margin-left",h)}u()}function u(){if(f.fade>0&&r){p.animate({opacity:1},f.fade)}else{p.css("opacity",1)}}}}})(jQuery);
/**
    MyImgScale v0.2
 
    MyImgScale is a jQuery plugin to scale images to fit or fill their parent container.
    Note: The parent container of the image must have a defined height and width in CSS.
    
    It is actually a merger/improvement from two existing plugins:
     1) Image Scale v1.0 by Kelly Meath (http://imgscale.kjmeath.com/), and
     2) CJ Object Scaler v3.0.0 by Doug Jones (http://www.cjboco.com/projects.cfm/project/cj-object-scaler/)

    The reasons for this merger are:
    . CJ Object Scaler has a conciser image resizing algorithm while Image Scale has a clearer layout.
    . CJ Object Scaler has an overflow issue, ie. the image scaled is not confined in parent container.
    . Both have the wrong calculation when parent container is invisible.
    
    If the parent container has padding, the scaled image might still cross boundary.
    One of the solutions is to insert a wrapper div with the same height and width as the parent container, eg:
    <div id="parent" style="height: 120px; width: 90px; padding: 10px">
      <div id="interimWrapper" style="height: 120px; width: 90px;">
        <img src="<Your img link here>" />
      </div>
    </div>
    I prefer to do this in application rather than in plugin as it is somewhat obtrusive.
    
    Web: https://bitbucket.org/marshalking/myimgscale
    Updated: Apr 15, 2011 by Marshal
    
    -----------------------------------------------------------------------
    MIT License

    Copyright (c) 2011 Doug Jones, Kelly Meath, Marshal

    Permission is hereby granted, free of charge, to any person obtaining
    a copy of this software and associated documentation files (the
    "Software"), to deal in the Software without restriction, including
    without limitation the rights to use, copy, modify, merge, publish,
    distribute, sublicense, and/or sell copies of the Software, and to
    permit persons to whom the Software is furnished to do so, subject to
    the following conditions:

    The above copyright notice and this permission notice shall be
    included in all copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
    EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
    MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
    NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
    LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
    OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
    WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
(function($) {
    $.fn.scaleImage = function(options) {
        var opts = $.extend({parent: false, scale: 'fill', center: true, fade: 0}, options); // merge default options with user's

        return this.each(function() {
            var $img = $(this);
            var $parent = opts.parent ? $img.parents(opts.parent) : $img.parent(); // if not supplied, use default direct parent
            $parent.css({opacity: 0, overflow: 'hidden'}); // keep the img inside boundaries
           
            if ($parent.length > 0) {
                $img.removeAttr('height').removeAttr('width');
                if (this.complete) { // img already loaded/cached
                    scale($img, $parent);
                } else {
                    $img.load(function() {
                        scale($img, $parent);
                    });
                }
            }
        });
       
        function scale($img, $parent) {
            var imgSize = getOriginalImgSize($img),
                imgW = imgSize.width,
                imgH = imgSize.height,
                destW = $parent.width(),
                destH = $parent.height(),
                borderW = parseInt($img.css("borderLeftWidth"), 10) + parseInt($img.css("borderRightWidth"), 10),
                borderH = parseInt($img.css("borderTopWidth"), 10) + parseInt($img.css("borderBottomWidth"), 10),
                ratioX, ratioY, ratio, newWidth, newHeight;
           
            if (destH === 0 || destW === 0) { // parent is invisible, eg. display: none
                var parentSize = getHiddenElemSize($parent);
                destW = parentSize.width;
                destH = parentSize.height;
            }
           
            // check for valid border values. IE takes in account border size when calculating width/height so just set to 0
            borderW = isNaN(borderW) ? 0 : borderW;
            borderH = isNaN(borderH) ? 0 : borderH;
           
            // calculate scale ratios
            ratioX = destW / imgW;
            ratioY = destH / imgH;

            // Determine which algorithm to use
            if (opts.scale === "fit") {
                ratio = ratioX < ratioY ? ratioX : ratioY;
            } else if (opts.scale === "fill") {
                ratio = ratioX > ratioY ? ratioX : ratioY;
            }

            // calculate our new image dimensions
            //newWidth = parseInt(imgW * ratio, 10) - borderW;
            //newHeight = parseInt(imgH * ratio, 10) - borderH;
            newWidth = Math.ceil(imgW * ratio, 10) - borderW;
            newHeight = Math.ceil(imgH * ratio, 10) - borderH;
           
            // Set new dimensions to both css and img's attributes
            $img.css({
                "width": newWidth,
                "height": newHeight
            }).attr({
                "width": newWidth,
                "height": newHeight
            });
           
            if (opts.center) { // set offset if center is true
                $img.css("margin-left", Math.floor((destW - newWidth) / 2));
                $img.css("margin-top", Math.floor((destH - newHeight) / 2));
            }
       
            if (opts.fade > 0) { // fade-in effect
                $parent.animate({opacity: 1}, opts.fade);
            } else {
                $parent.css("opacity", 1);
            }
        }

        /**
         * To calculate the correct scale ratio, we need the image's original size rather than some preset values,
         * which were set either manually in code or automatically by browser.
         * Thanks FDisk for the solution:
         * http://stackoverflow.com/questions/318630/get-real-image-width-and-height-with-javascript-in-safari-chrome
         */
        function getOriginalImgSize($img) {
            var t = new Image();
            t.src = $img.attr("src");
            return {width: t.width, height: t.height};
        }
       
        /**
         * If the element is invisible, jQeury .height() and .width() return 0 in IE.
         * This function returns the hidden element's correct width and height.
         * Thanks elliotlarson for the solution:
         * http://stackoverflow.com/questions/2345784/jquery-get-height-of-hidden-element-in-jquery-1-4-2
         */
        function getHiddenElemSize(element) {
            var copy = element.clone().css({visibility: 'hidden', display: 'block', position: 'absolute'});
            $("body").append(copy);
            var size = {width: copy.width(), height: copy.height()};
            copy.remove();
            return size;
        }
    };
})(jQuery);



/*! http://tinynav.viljamis.com v1.1 by @viljamis */
(function(a,i,g){a.fn.tinyNav=function(j){var b=a.extend({active:"selected",header:"",label:""},j);return this.each(function(){g++;var h=a(this),d="tinynav"+g,f=".l_"+d,e=a("<select/>").attr("id",d).addClass("tinynav "+d);if(h.is("ul,ol")){""!==b.header&&e.append(a("<option/>").text(b.header));var c="";h.addClass("l_"+d).find("a").each(function(){c+='<option value="'+a(this).attr("href")+'">';var b;for(b=0;b<a(this).parents("ul, ol").length-1;b++)c+="- ";c+=a(this).text()+"</option>"});e.append(c);
b.header||e.find(":eq("+a(f+" li").index(a(f+" li."+b.active))+")").attr("selected",!0);e.change(function(){i.location.href=a(this).val()});a(f).after(e);b.label&&e.before(a("<label/>").attr("for",d).addClass("tinynav_label "+d+"_label").append(b.label))}})}})(jQuery,this,0);





/*global jQuery */
/*jshint multistr:true browser:true */
/*!
* FitVids 1.0
*
* Copyright 2011, Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com
* Credit to Thierry Koblentz - http://www.alistapart.com/articles/creating-intrinsic-ratios-for-video/
* Released under the WTFPL license - http://sam.zoy.org/wtfpl/
*
* Date: Thu Sept 01 18:00:00 2011 -0500
*/

(function($){

  "use strict";

  $.fn.fitVids = function( options ) {
    var settings = {
      customSelector: null
    };

    var div = document.createElement('div'),
        ref = document.getElementsByTagName('base')[0] || document.getElementsByTagName('script')[0];

    div.className = 'fit-vids-style';
    div.innerHTML = '&shy;<style>         \
      .fluid-width-video-wrapper {        \
         width: 100%;                     \
         position: relative;              \
         padding: 0;                      \
      }                                   \
                                          \
      .fluid-width-video-wrapper iframe,  \
      .fluid-width-video-wrapper object,  \
      .fluid-width-video-wrapper embed {  \
         position: absolute;              \
         top: 0;                          \
         left: 0;                         \
         width: 100%;                     \
         height: 100%;                    \
      }                                   \
    </style>';

    ref.parentNode.insertBefore(div,ref);

    if ( options ) {
      $.extend( settings, options );
    }

    return this.each(function(){
      var selectors = [
        "iframe[src*='player.vimeo.com']",
        "iframe[src*='www.youtube.com']",
        "iframe[src*='www.youtube-nocookie.com']",
        "iframe[src*='www.kickstarter.com']",
        "object",
        "embed"
      ];

      if (settings.customSelector) {
        selectors.push(settings.customSelector);
      }

      var $allVideos = $(this).find(selectors.join(','));

      $allVideos.each(function(){
        var $this = $(this);
        if (this.tagName.toLowerCase() === 'embed' && $this.parent('object').length || $this.parent('.fluid-width-video-wrapper').length) { return; }
        var height = ( this.tagName.toLowerCase() === 'object' || ($this.attr('height') && !isNaN(parseInt($this.attr('height'), 10))) ) ? parseInt($this.attr('height'), 10) : $this.height(),
            width = !isNaN(parseInt($this.attr('width'), 10)) ? parseInt($this.attr('width'), 10) : $this.width(),
            aspectRatio = height / width;
        if(!$this.attr('id')){
          var videoID = 'fitvid' + Math.floor(Math.random()*999999);
          $this.attr('id', videoID);
        }
        $this.wrap('<div class="fluid-width-video-wrapper"></div>').parent('.fluid-width-video-wrapper').css('padding-top', (aspectRatio * 100)+"%");
        $this.removeAttr('height').removeAttr('width');
      });
    });
  };
})( jQuery );

/**
 * From: http://www.hardcode.nl/archives_139/article_515-vertical-align-plugin.htm
 */
(function ($) {
$.fn.vAlign = function() {
    return this.each(function(i){
        var ah = $(this).height();
        var ph = $(this).parent().height();
        var mh = (ph - ah) / 2;
    $(this).css('padding-top', mh);
    });
};
})(jQuery);


/**
 * Equal Heights Plugin
 * Equalize the heights of elements. Great for columns or any elements
 * that need to be the same size (floats, etc).
 * 
 * Version 1.0
 * Updated 12/10/2008
 *
 * Copyright (c) 2008 Rob Glazebrook (cssnewbie.com) 
 *
 * Usage: $(object).equalHeights([minHeight], [maxHeight]);
 * 
 * Example 1: $(".cols").equalHeights(); Sets all columns to the same height.
 * Example 2: $(".cols").equalHeights(400); Sets all cols to at least 400px tall.
 * Example 3: $(".cols").equalHeights(100,300); Cols are at least 100 but no more
 * than 300 pixels tall. Elements with too much content will gain a scrollbar.
 * 
 */
(function($) {
    $.fn.equalHeights = function(minHeight, maxHeight) {
        tallest = (minHeight) ? minHeight : 0;
        this.each(function() {
            if($(this).height() > tallest) {
                tallest = $(this).height();
            }
        });
        if((maxHeight) && tallest > maxHeight) tallest = maxHeight;
        return this.each(function() {
            $(this).css('min-height', tallest).css("overflow","hidden");
        });
    }
})(jQuery);



// This is a fix for NIVO in IE7 & IE8
// derived somewhat from http://stackoverflow.com/questions/6170441/wordpress-plugin-not-working-in-ie7-and-8
if (!Number.prototype.slice) {
    Number.prototype.slice = function (i, i2) {
        var t = String(this);
        var cake = "";
        for (; i < i2; i++)
            cake += t.chatAt(i);
        return cake;
    };
}


// This si a fix for indexOf in IE7 & IE8
// from http://stackoverflow.com/questions/3629183/why-doesnt-indexof-work-on-an-array-ie8
if (!Array.prototype.indexOf)
{
  Array.prototype.indexOf = function(elt /*, from*/)
  {
    var len = this.length >>> 0;

    var from = Number(arguments[1]) || 0;
    from = (from < 0)
         ? Math.ceil(from)
         : Math.floor(from);
    if (from < 0)
      from += len;

    for (; from < len; from++)
    {
      if (from in this &&
          this[from] === elt)
        return from;
    }
    return -1;
  };
}
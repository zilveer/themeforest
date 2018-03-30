/**
 * Certain functions below Theme License to Striking MultiFlex by Lyon Holdings Ltd (WP Corporate Themes)
 * Author: Lyon Holdings Ltd
 **/
jQuery.noConflict();
document.documentElement.className = document.documentElement.className.replace(/(^|\s)no-js(\s|$)/, '$1js$2');
var themeUpdateImages = function(items, width, height) {
    if (responsve_image_resize === false) {
        return;
    }

    function isImageOk(img) {
        if (!img.complete) {
            return false;
        }
        if (typeof img.naturalWidth != "undefined" && img.naturalWidth == 0) {
            return false;
        }
        return true;
    }

    items.each(function() {
        var $image = jQuery(this);
        var thumbnail = $image.attr('data-thumbnail');
        if (thumbnail) {

            function update() {
                var width = parseInt($image.width(), 10);
                var height = parseInt($image.height(), 10);

                var images = $image.data('images');
                var size = width + '.' + height;
                if (!images) {
                    images = [];
                }
                if (width <= 0 || height <= 0) { // image is hidden
                    return;
                }
                if (width === $image[0].naturalWidth && height === $image[0].naturalHeight) {
                    images[size] = $image.attr('src');
                } else {
                    if (typeof images[size] !== 'undefined') {
                        $image.attr('src', images[size]);
                    } else {
                        jQuery.post(window.location.href, {
                            imageAjax: true,
                            width: width,
                            height: height,
                            thumbnail_id: thumbnail
                        }, function(data) {
                            var tmpImg = new Image();
                            tmpImg.onload = function() {
                                $image.attr('src', data);
                                images[size] = data;
                                $image.data('images', images);
                            };
                            tmpImg.src = data;
                        });
                    }
                }
            }

            if (isImageOk($image[0])) {
                update();
            } else {
                $image.one("load", function() {
                    update();
                });
            }
        }
    });
}

jQuery(document).ready(function($) {
    $('.form-submit #submit').addClass('button white');

    $("#navigation > ul").nav({
        child: {
            beforeFirstRender: function() {
                if ($(this).find('.cufon').length > 0) {
                    Cufon.replace($('> a', this));
                }
            }
        },
        root: {
            afterHoverIn: function() {},
            afterHoverOut: function() {},
            beforeHoverIn: function() {
                $(this).addClass('hover');
                if ($(this).find('.cufon').length > 0) {
                    Cufon.replace($('> a', this));
                }
            },
            beforeHoverOut: function() {
                $(this).removeClass('hover');
                if ($(this).find('.cufon').length > 0) {
                    Cufon.replace($('> a', this));
                }
            }
        }
    });

    if ($('body').is('.responsive')) {
        $('.table_style table').addClass('responsive');

        function splitTable(original) {
            original.wrap("<div class='table-wrapper' />");

            var copy = original.clone();
            copy.find("td:not(:first-child), th:not(:first-child)").css("display", "none");
            copy.removeClass("responsive");

            original.closest(".table-wrapper").prepend(copy);
            copy.wrap("<div class='pinned' />");
            original.wrap("<div class='scrollable' />");

            setCellHeights(original, copy);
        }

        function unsplitTable(original) {
            original.closest(".table-wrapper").find(".pinned").remove();
            original.unwrap();
            original.unwrap();
        }
        var isMobile = $('body').is('.isMobile');


        function setCellHeights(original, copy) {
            var tr = original.find('tr'),
                tr_copy = copy.find('tr'),
                heights = [];

            tr.each(function(index) {
                var self = $(this),
                    tx = self.find('th, td');

                tx.each(function() {
                    var height = $(this).outerHeight(true);
                    heights[index] = heights[index] || 0;
                    if (height > heights[index]) heights[index] = height;
                });

            });

            tr_copy.each(function(index) {
                $(this).height(heights[index]);
            });
        }


        $('#navigation > ul').navToSelect({
            namespace: 'nav2select',
            activeClass: 'current_page_item',
            indentString: nav2select_indentString,
            placeholder: nav2select_defaultText,
            indentSpace: true,
            itemFilter: function($li) {
                return !$li.is('.not_show_in_mobile');
            },
            getItemLabel: function($li) {
                var $item = $li.find(this.options.linkSelector).clone();
                $item.find('.menu-subtitle').remove();
                return $item.text();
            }
        });
    }

    $("#sidebar_content .widget:last-child").css('margin-bottom', '20px');
    $(".home #sidebar_content .widget:last-child").css('margin-bottom', '0px');
    $('.top a').click(function() {
        $('html, body').animate({
            scrollTop: 0
        }, 'slow');
        return false;
    });
    if ($('body').is('.scroll-to-top')) {
        if ($('body').is('.scroll-to-top-square')) {
            $('body').append('<a href="#top" class="style-square" id="back-to-top">Back To Top</a>');
        } else {
            $('body').append('<a href="#top" id="back-to-top">Back To Top</a>');
        }

        $(function() {
            $(window).scroll(function() {
                if ($(this).scrollTop() > 100) {
                    $('#back-to-top').fadeIn();
                } else {
                    $('#back-to-top').fadeOut();
                }
            });
            // scroll body to 0px on click
            $('#back-to-top').click(function() {
                var $delay = $(window).scrollTop();
                $('body,html').animate({
                    scrollTop: 0
                }, 500 * Math.atan($delay / 3000));
                return false;
            });
        });
    }

    $('.milestone_number').on('scrollSpy:enter', function() {
        if (!$(this).data('visibled')) {
            $(this).data('visibled', 1);
            var separator = $(this).data('separator');
            $(this).countTo({
                refreshInterval: 25,
                formatter: function(value, options) {
                    if (separator == '') {
                        return value.toFixed(options.decimals);
                    } else {
                        var parts = value.toFixed(options.decimals).toString().split(".");
                        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, separator);
                        return parts.join(".");
                    }
                }
            });
        }
    }).scrollSpy();
    $('.pie_progress_wrap').on('scrollSpy:enter', function() {
        if (!$(this).data('visibled')) {
            $(this).data('visibled', 1);
            var $self = $(this),
                size = 150,
                lineWidth = 7,
                trackColor = pie_progress_track_color,
                barColor = pie_progress_bar_color;
            if ($self.is('.pie_progress_small')) {
                size = 120;
                lineWidth = 6;
            } else if ($self.is('.pie_progress_large')) {
                size = 180;
                lineWidth = 8;
            }
            if ($self.data('trackcolor')) {
                trackColor = $self.data('trackcolor');
            }
            if ($self.data('barcolor')) {
                barColor = $self.data('barcolor');
            }
            $self.find('.pie_progress').easyPieChart({
                size: size,
                scaleLength: 0,
                trackColor: trackColor,
                barColor: barColor,
                lineCap: 'square',
                lineWidth: lineWidth
            });
        }
    }).scrollSpy();

    $('.progress').on('scrollSpy:enter', function() {
        if (!$(this).data('visibled')) {
            $(this).data('visibled', 1);

            var meter = $(this).data('meter');
            $(this).find('.progress-meter').animate({
                width: meter + '%'
            }, 1500);
        }
    }).scrollSpy();

    $(".icon_email").each(function() {
        if ($(this).attr('href') !== undefined) {
            $(this).attr('href', $(this).attr('href').replace("*", "@"));
        }
        $(this).html($(this).html().replace("*", "@"));
    });

    $(".tabs_container").each(function() {
        var $history = $(this).attr('data-history');
        if ($history !== undefined && $history === 'true') {
            $history = true;
        } else {
            $history = false;
        }
        var $initialIndex = $(this).attr('data-initialIndex');
        if ($initialIndex === undefined) {
            $initialIndex = 0;
        }
        $("ul.tabs, ul.theme_tabs", this).tabs("div.panes > div, div.theme_panes > div", {
            tabs: 'a',
            effect: 'fade',
            fadeOutSpeed: -400,
            history: $history,
            initialIndex: $initialIndex
        });
    }).addClass('tabs_inited');
    $(".vertical_tabs_container").each(function() {
        var $history = $(this).attr('data-history');
        if ($history !== undefined && $history === 'true') {
            $history = true;
        } else {
            $history = false;
        }
        var $initialIndex = $(this).attr('data-initialIndex');
        if ($initialIndex === undefined) {
            $initialIndex = 0;
        }
        $("ul.vertical_tabs, ul.theme_vertical_tabs", this).tabs("div.panes > div, div.theme_panes > div", {
            tabs: 'a',
            effect: 'fade',
            fadeOutSpeed: -400,
            history: $history,
            initialIndex: $initialIndex
        });
        $("div.panes, div.theme_panes", this).css('min-height', $("ul.vertical_tabs, ul.theme_vertical_tabs", this).height());
    }).addClass('tabs_inited');
    $(".mini_tabs_container").each(function() {
        var $history = $(this).attr('data-history');
        if ($history !== undefined && $history === 'true') {
            $history = true;
        } else {
            $history = false;
        }
        var $initialIndex = $(this).attr('data-initialIndex');
        if ($initialIndex === undefined) {
            $initialIndex = 0;
        }
        $("ul.mini_tabs, ul.theme_mini_tabs", this).tabs("div.panes > div, div.theme_panes > div", {
            tabs: 'a',
            effect: 'fade',
            fadeOutSpeed: -400,
            history: $history,
            initialIndex: $initialIndex
        });
    }).addClass('tabs_inited');
    if ($.tools !== undefined) {
        if ($.tools.tabs !== undefined) {
            $.tools.tabs.addEffect("slide", function(i, done) {
                this.getPanes().slideUp();
                this.getPanes().eq(i).slideDown(function() {
                    done.call();
                });
            });
        }
    }
    $(".accordion, .theme_accordion").each(function() {
        var $initialIndex = $(this).attr('data-initialIndex');
        if ($initialIndex === undefined) {
            $initialIndex = 0;
        }
        $(this).tabs("div.pane, div.theme_pane", {
            tabs: '.tab, .theme_tab',
            effect: 'slide',
            initialIndex: $initialIndex
        });
    });
    $(".toggle_title").click(function() {
        var parent = $(this).parent('.toggle');
        if (parent.is(".toggle_active")) {
            parent.removeClass('toggle_active');
            $(this).siblings('.toggle_content').slideUp("fast");
            $(this).trigger('toggle::close');
        } else {
            parent.addClass('toggle_active');
            $(this).siblings('.toggle_content').slideDown("fast");
            $(this).trigger('toggle::open');
        }
    });

    $('.responsive_text').each(function() {


        var tabs = $(this).parents('.tabs_container,.mini_tabs_container,.accordion, .theme_accordion');
        var toggle = $(this).parents('.toggle');
        var self = this;

        if (tabs.length != 0) {
            tabs.each(function() {
                var api = null;
                if ($(this).is('.accordion, .theme_accordion')) {
                    api = $(this).data("tabs");
                } else {
                    api = $(this).find('.tabs, .theme_tabs, .mini_tabs, .theme_mini_tabs').data("tabs");
                }
                api.onClick(function(index) {
                    if (!$.data(self, 'adaptText')) {
                        $(self).adaptText();
                    } else {
                        $(self).adaptText('resize', true);
                    }
                });
            });
        } else if (toggle.length != 0) {
            toggle.find('.toggle_title').on('toggle::open', function() {
                if (!$.data(self, 'adaptText')) {
                    $(self).adaptText();
                } else {
                    $(self).adaptText('resize', true);
                }
            });
        } else {
            $(this).adaptText();
        }
    });

    $(".button, .theme_button").hover(function() {
        var $hoverBg = $(this).attr('data-hoverBg');
        var $hoverColor = $(this).attr('data-hoverColor');

        if ($hoverBg !== undefined) {
            $(this).css('background-color', $hoverBg);
        }
        if ($hoverColor !== undefined) {
            $('span', this).css('color', $hoverColor);
        }
    }, function() {
        var $hoverBg = $(this).attr('data-hoverBg');
        var $hoverColor = $(this).attr('data-hoverColor');
        var $bg = $(this).attr('data-bg');
        var $color = $(this).attr('data-color');

        if ($hoverBg !== undefined) {
            if ($bg !== undefined) {
                $(this).css('background-color', $bg);
            } else {
                $(this).css('background-color', '');
            }
        }
        if ($hoverColor !== undefined) {
            if ($color !== undefined) {
                $('span', this).css('color', $color);
            } else {
                $('span', this).css('color', '');
            }
        }
    });

    $('.testimonials').each(function() {
        var autoplay = $(this).data('autoplay'),
            duration = $(this).data('duration');

        eval("var items = testimonials_" + $(this).data('items'));

        var current = 0;
        var $content = $(this).find('.testimonial_content > div'),
            $name = $(this).find('.testimonial_name'),
            $meta = $(this).find('.testimonial_meta'),
            $avatar = $(this).find('.testimonial_avatar');
        var autoplay_timeout;

        function update(item) {
            $content.hide().html(item.content).fadeIn();
            $name.hide().html(item.author).fadeIn();
            if (item.meta) {
                if (item.link) {
                    $meta.hide().html('<a href="' + item.link + '" target="_blank" rel="nofollow">' + item.meta + '</a>').fadeIn();
                } else {
                    $meta.hide().html(item.meta).fadeIn();
                }
            } else {
                $meta.html();
            }

            $avatar.attr('src', item.avatar);


            if (autoplay === true) {
                clearTimeout(autoplay_timeout);
                autoplay_timeout = setTimeout(function() {
                    next();
                }, duration);
            }
        }

        function previous() {
            if (current == 0) {
                current = items.length - 1;
            } else {
                current = current - 1;
            }
            update(items[current]);
        }

        function next() {
            if (current == items.length - 1) {
                current = 0;
            } else {
                current = current + 1;
            }
            update(items[current]);
        }

        if (autoplay === true) {
            autoplay_timeout = setTimeout(function() {
                next();
            }, duration);
        }

        $(this).find('.testimonial_previous').on('click', function() {
            previous();

            return false;
        });

        $(this).find('.testimonial_next').on('click', function() {
            next();
            return false;
        });
    });

    /* enable lightbox */
    var enable_lightbox = function(selector, parent) {
        if ($('body').is('.no_fancybox')) {
            return;
        }
        var options = {
            width: fancybox_options.width,
            height: fancybox_options.height,
            autoSize: fancybox_options.autoSize,
            autoWidth: fancybox_options.autoWidth,
            autoHeight: fancybox_options.autoHeight,
            fitToView: fancybox_options.fitToView,
            aspectRatio: fancybox_options.aspectRatio,
            arrows: fancybox_options.arrows,
            closeBtn: fancybox_options.closeBtn,
            closeClick: fancybox_options.closeClick,
            nextClick: fancybox_options.nextClick,
            autoPlay: fancybox_options.autoPlay,
            playSpeed: fancybox_options.playSpeed,
            preload: fancybox_options.preload,
            loop: fancybox_options.loop,
            iframe: {
                preload: false
            },
            beforeLoad: function() {
                if (this.element.is('.fancyaudio')) {
                    var loop = this.element.data('loop'),
                        autoplay = this.element.data('autoplay'),
                        loop_attribute, autoplay_attribute,
                        source = this.element.data('source');

                    if (loop !== 'false') {
                        loop_attribute = ' loop="true"';
                    } else {
                        loop_attribute = ' loop="false"';
                    }

                    if (autoplay !== 'false') {
                        autoplay_attribute = " autoplay";
                    } else {
                        autoplay_attribute = "";
                    }
                    var id = Math.round(Math.random() * 10000 + 1);
                    this.content = '<div class="audio_frame" style="width:380px;height:100%">' +
                        '<audio id="audio' + id + '" width="100%" height="100%" controls="controls"' + loop_attribute + ' type="audio/mp3" src="' + source + '"/>' +
                        '</div>';
                    this.wrapCSS = this.wrapCSS + ' skin-audio';
                    this.arrows = false;
                    this.width = 380;
                    this.height = 30;
                    this.minHeight = 30;
                    this.scrolling = 'no';
                    var player;
                    this.beforeShow = function() {
                        if (MediaElementPlayer === undefined) return;
                        player = new MediaElementPlayer('#audio' + id);
                        if (autoplay !== 'false') {
                            player.play();
                        }
                    };
                    this.helpers.media = false;
                    this.beforeChange = function() {
                        if (player) {
                            player.pause();
                            player.remove();
                        }
                    };
                    this.beforeClose = function() {
                        if (player) {
                            player.pause();
                            player.remove();
                        }
                    };
                } else if (this.element.is('.fancyvideo')) {
                    var source = this.element.data('source'),
                        autoplay = this.element.data('autoplay'),
                        autoplay_attribute, autoplay_var;

                    if (autoplay !== 'false') {
                        autoplay_attribute = " autoplay";
                        autoplay_var = 'autoplay=true&amp;';
                        this.helpers.media = {};
                    } else {
                        autoplay_attribute = "";
                        autoplay_var = '';
                        this.helpers.media = {
                            youtube: {
                                params: {
                                    autoplay: 0
                                }
                            },
                            vimeo: {
                                params: {
                                    autoplay: 0
                                }
                            }
                        };
                    }
                    this.width = parseInt(this.element.data('width'), 10);
                    this.height = parseInt(this.element.data('height'), 10);


                    if (isMobile && this.width > $('body').width()) {
                        this.height = parseInt(($('body').width() - 20) * this.height / this.width, 10);
                        this.width = $('body').width() - 20;
                    }

                    var videowidth = this.width;
                    var videoheight = this.height;
                    var id = Math.round(Math.random() * 10000 + 1);
                    var preload = '';
                    if (/chrom(e|ium)/.test(navigator.userAgent.toLowerCase())) {
                        preload = ' preload="none"';
                    } else {
                        preload = '';
                    }
                    this.content = '<div class="video_frame" style="width:' + this.width + 'px">' +
                        '<video id="video' + id + '" width="' + this.width + '" height="' + this.height + '" autoplay="' + autoplay + '" controls="controls"' + preload + '>' +
                        '<source type="video/mp4" src="' + source + '" />' +
                        '</video>' +
                        '</div>';
                    this.wrapCSS = this.wrapCSS + ' skin-video';
                    this.scrolling = 'no';
                    var videoplayer;
                    this.beforeShow = function() {
                        if (this.element.is('.fancymobile') || MediaElementPlayer === undefined) {
                            $('#video' + id).css('height', videoheight);

                            return;
                        }
                        videoplayer = new MediaElementPlayer('#video' + id, {
                            defaultVideoWidth: videowidth,
                            defaultVideoHeight: videoheight,
                            pluginWidth: videowidth,
                            pluginHeight: videoheight,
                            enableAutosize: false
                        });
                    };
                    this.helpers.media = false;
                    this.beforeChange = function() {
                        if (videoplayer) {
                            videoplayer.pause();
                            //videoplayer.remove();
                        }
                    };
                    this.beforeClose = function() {
                        if (videoplayer) {
                            videoplayer.pause();
                            //videoplayer.remove();
                        }
                    };
                } else {
                    this.closeBtn = fancybox_options.closeBtn;
                    this.arrows = fancybox_options.arrows;
                    this.width = fancybox_options.width;
                    this.height = fancybox_options.height;
                    this.minHeight = 100;
                    this.beforeShow = null;
                    this.scrolling = 'auto';
                    this.beforeChange = null;
                    this.beforeClose = null;

                    if (fancybox_options.skin === 'theme') {
                        this.wrapCSS = 'skin-theme';
                    } else {
                        this.wrapCSS = 'skin-fancybox';
                    }
                }

                if (this.element.data('width')) {
                    this.width = parseInt(this.element.data('width'), 10);
                }
                if (this.element.data('height')) {
                    this.height = parseInt(this.element.data('height'), 10);
                }
                if (this.element.attr('data-autoSize') !== undefined) {
                    this.autoSize = (this.element.attr('data-autoSize') === 'true') ? true : false;
                }
                if (this.element.attr('data-autowidth') !== undefined) {
                    this.autoWidth = (this.element.attr('data-autowidth') === 'false') ? false : true;
                }
                if (this.element.attr('data-autoheight') !== undefined) {
                    this.autoHeight = (this.element.attr('data-autoheight') === 'false') ? false : true;
                }
                if (this.element.attr('data-fittoview') !== undefined) {
                    this.fitToView = (this.element.attr('data-fittoview') === 'false') ? false : true;
                }
                if (this.element.attr('data-aspectratio') !== undefined) {
                    this.aspectRatio = (this.element.attr('data-aspectratio') === 'false') ? false : true;
                }
                if (this.element.attr('data-close') !== undefined) {
                    this.closeBtn = (this.element.attr('data-close') === 'true') ? true : false;
                }
                if (this.element.attr('data-closeclick') !== undefined) {
                    this.closeClick = (this.element.attr('data-closeclick') === 'true') ? true : false;
                }
                // if(fancybox_options.fitToView_mode && $(window).width() > 979){
                //     this.fitToView = false;
                // }
                var type = this.element.data('type');
                if (type === 'iframe') {
                    this.type = type;
                }
                if (type === 'inline' || type === 'html' || type === 'ajax') {
                    if (this.element.data('width')) {
                        this.autoWidth = false;
                    }
                    if (this.element.data('height')) {
                        this.autoHeight = false;
                    }
                }
            },
            helpers: {
                media: {},
                title: {
                    type: fancybox_options.title_type
                }
            }
        };
        if (fancybox_options.skin === 'theme') {
            options.padding = 0;
            options.wrapCSS = 'skin-theme';
        } else {
            options.wrapCSS = 'skin-fancybox';
        }
        if (fancybox_options.thumbnail) {
            options.helpers.thumbs = {
                width: fancybox_options.thumbnail_width,
                height: fancybox_options.thumbnail_height,
                position: fancybox_options.thumbnail_position,
                source: function(item) {
                    var href;
                    if (item.element) {
                        if (item.element.data('thumb')) {
                            href = item.element.data('thumb');
                        } else {
                            href = $(item.element).find('img').attr('src');
                        }
                    }

                    if (!href && item.type === 'image' && item.href) {
                        href = item.href;
                    }
                    return href;
                }
            };
        }

        $(parent).find(selector).fancybox(options);
    };
    $('.wp_lightbox').each(function() {
        var $self = $(this);
        if (!$self.attr('title')) {
            $self.attr('title', $self.children('img').attr('alt'));
        }

    });
    enable_lightbox('.lightbox, .wp_lightbox', document);

    enable_lightbox('.fancybox, .colorbox', document);
    /* woocommerce lightbox */
    enable_lightbox("a[rel^='prettyPhoto']", document);
    enable_lightbox(".woocommerce a.zoom", document);
    enable_lightbox(".woocommerce a.show_review_form", document);
    /* woocommerce lightbox end */
    var enable_image_grayscale_hover = function(image) {

    }
    /* enable image hover effect */
    var enable_image_hover = function(image) {
        if (image.is(".image_icon_zoom,.image_icon_play,.image_icon_doc,.image_icon_link")) {
            if ($.browser.msie && parseInt($.browser.version, 10) < 7) {} else {
                if ($.browser.msie && parseInt($.browser.version, 10) < 9) {
                    image.hover(function() {
                        $(".image_overlay", this).css("visibility", "visible");
                    }, function() {
                        $(".image_overlay", this).css("visibility", "hidden");
                    }).children('img').after('<span class="image_overlay"></span>');
                } else {
                    image.hover(function() {
                        $(".image_overlay", this).animate({
                            opacity: '1'
                        }, "fast");
                    }, function() {
                        $(".image_overlay", this).animate({
                            opacity: '0'
                        }, "fast");
                    });
                    if (image.find('.image_overlay').length == 0) {
                        image.children('img').after($('<span class="image_overlay"></span>').css({
                            opacity: '0',
                            visibility: 'visible'
                        }));
                    }
                }
            }
        }
    };

    $('.image_no_link').click(function() {
        return false;
    });

    function fillBrokenImage(width, height) {
        var canvas = document.createElement('canvas');
        canvas.width = width;
        canvas.height = height;

        return canvas.toDataURL();
    }

    function preloader($to_be_load_images) {
        $to_be_load_images.each(function() {
            $(this).addClass('image-on-loading');
        }).imagesLoaded().progress(function(instance, image) {
            if (!image.isLoaded) {
                var $image = $(image.img);
                $image.addClass('image-is-broken');
                $image.attr('broken_src', $image.attr('src'));
                var width = $image.attr('width');
                var height = $image.attr('height');
                $image.attr('src', theme_url + '/includes/broken.php?width=' + width + '&height=' + height);
            } else {
                var $image = $(image.img);
                var image_frame = $image.closest('.image_frame');
                var image = $image.closest('a');

                if (image_frame.is('.effect-grayscale')) {
                    enable_image_grayscale_hover(image);

                } else if (image_frame.is('.effect-icon')) {
                    enable_image_hover(image);
                }

                $image.css('visibility', 'visible');
                $image.removeClass('image-on-loading');
            }
        });
    }

    /* portfolio sortable */
    $(".portfolios").each(function() {
        var $section = $(this);
        var $pagenavi = $('.wp-pagenavi', this);
        var _ajax = false;
        if ($section.attr('data-options') !== undefined) {
            eval("var _options = " + $section.attr('data-options'));
            _ajax = true;
        } else {
            var _options = {};
        }
        var _cufon = false;
        if ($section.find('.portfolio_title .cufon').length > 0) {
            _cufon = true;
        }

        if ($section.is('.sortable')) {
            var _preferences = {
                duration: 1000,
                adjustHeight: false,
                adjustWidth: false,
                easing: 'easeInOutQuad',
                attribute: function(v) {
                    return $(v).attr('data-id');
                },
                enhancement: function() {
                    if (typeof Cufon !== "undefined" && _cufon === true) {
                        if ($.browser.msie) {
                            $('.portfolio_title').each(function() {
                                $(this).html($(this).text());
                            });
                        }
                        Cufon.replace('.portfolio_title');
                    }
                }
            };

            var $list = $('ul.portfolio_container', this);

            var $clone = $list.clone();
            $clone.find('.image_frame img').css('visibility', 'visible');
            if (typeof Cufon !== "undefined" && _cufon === true) {
                $clone.find('.portfolio_title').each(function() {
                    if ($('a', this).length > 0) {
                        $('a', this).html(this.textContent);
                    } else {
                        $(this).html(this.textContent);
                    }
                });
            }
            // var _column;
            // if ($list.is('.portfolio_one_column')) {
            //     _column = 1;
            // } else if ($list.is('.portfolio_two_columns')) {
            //     _column = 2;
            // } else if ($list.is('.portfolio_three_columns')) {
            //     _column = 3;
            // } else if ($list.is('.portfolio_four_columns')) {
            //     _column = 4;
            // }

            var callback = function() {
                enable_lightbox('.lightbox', $list);
                $list.find('.image_frame').css('background-image', 'none');
                $list.find('.image_frame').each(function() {
                    if ($(this).is('.effect-grayscale')) {
                        if ($(this).find('.grayscale-wrapper').length === 0 && $(this).find('.image-on-loading').length === 0) {
                            enable_image_grayscale_hover($('a', this));
                        }
                    } else if ($(this).is('.effect-icon')) {
                        enable_image_hover($('a', this));
                    }
                });

                if (typeof Cufon !== "undefined" && _cufon === true && $.browser.msie && parseInt($.browser.version, 10) < 7) {
                    $list.find('.portfolio_title').each(function() {
                        if ($('a', this).length > 0) {
                            $('a', this).html($(this).text());
                        } else {
                            $(this).html($(this).text());
                        }
                    });
                    Cufon.replace('.portfolio_title');
                }
            };
            var ajax_callback = function(data) {
                var $temp = $(data);
                $temp.find('.image_frame img').css('visibility', 'visible');
                var $temp_pagenavi = $temp.find('.wp-pagenavi');
                $list.quicksand($temp.find('.portfolio_item'), _preferences, callback);

                themeUpdateImages($list.find('.image_frame img'));

                if ($.browser.msie && parseInt($.browser.version, 10) < 7) {
                    callback();
                }
                if ($temp_pagenavi.length > 0) {
                    $pagenavi = $section.find('.wp-pagenavi');
                    if ($pagenavi.length > 0) {
                        $pagenavi.html($temp_pagenavi.html());
                    } else {
                        $temp_pagenavi.appendTo($section);
                    }
                } else {
                    $section.find('.wp-pagenavi').remove();
                }
            };
            if (_ajax) {
                $(this).on('click', '.wp-pagenavi a', function(e) {
                    var category = 'all';
                    if ($section.find('.sort_by_cat a.current').length > 0) {
                        category = $section.find('.sort_by_cat a.current').attr('data-value');
                    }

                    $.post(window.location.href, {
                        portfolioAjax: true,
                        portfolioOptions: _options,
                        category: category,
                        portfolioPage: $(this).attr('data-page'),
                        cache: true
                    }, ajax_callback);

                    e.preventDefault();
                });
            }

            $('.sort_by_cat a', this).click(function(e) {
                $(this).siblings('.current').removeClass('current');
                $(this).addClass('current');

                if (_ajax) {
                    var category = $(this).attr('data-value');
                    $.post(window.location.href, {
                        portfolioAjax: true,
                        portfolioOptions: _options,
                        category: category,
                        cache: true
                    }, ajax_callback);
                } else {
                    var $sorted_data;
                    if ($(this).attr('data-value') === 'all') {
                        $sorted_data = $clone.find('.portfolio_item').clone();
                    } else {
                        $sorted_data = $clone.find('.portfolio_item[data-cat*=' + $(this).attr('data-value') + ']').clone();
                    }

                    $list.quicksand($sorted_data, _preferences, callback);
                    if ($.browser.msie && parseInt($.browser.version, 10) < 7) {
                        callback();
                    }
                }

                e.preventDefault();
            });
        } else {
            if (_ajax) {
                $(this).on('click', '.wp-pagenavi a', function(e) {
                    $.post(window.location.href, {
                        portfolioAjax: true,
                        portfolioOptions: _options,
                        portfolioPage: $(this).attr('data-page'),
                        cache: true
                    }, function(data) {
                        $section.html(data);
                        enable_lightbox('.lightbox', $section);
                        if (typeof Cufon !== "undefined" && _cufon === true) {
                            Cufon.replace('.portfolio_title');
                        }

                        preloader($section.find('.portfolio_image .image_frame img'));
                    });

                    e.preventDefault();
                });
            }
        }
    });

    preloader($(".portfolios").find('.portfolio_image .image_frame img'));

    preloader($("body").find('.image_styled:not(.portfolio_image) .image_frame img'));

    $(".gallery .gallery-image").imagesLoaded(function(instance) {
        $.each(instance.images, function(i, image) {
            var $image = $(image.img);
            setTimeout(function() {
                $image.css('visibility', 'visible').animate({
                    opacity: 1
                }, 500, function() {
                    if ($(this).parent().is('.effect-grayscale')) {
                        enable_image_grayscale_hover($(this).parent());
                    } else {
                        enable_image_hover($(this).parent());
                    }
                });
            }, 100 * (i + 1));
        });
    });

    $(".contact_info_wrap .icon_email").each(function() {
        $(this).attr('href', $(this).attr('href').replace("*", "@"));
        $(this).html($(this).html().replace("*", "@"));
    });
    if ($.tools.validator !== undefined) {
        $.tools.validator.addEffect("contact_form", function(errors, event) {
            $.each(errors, function(index, error) {
                var input = error.input;

                input.addClass('invalid');
            });
        }, function(inputs) {
            inputs.removeClass('invalid');
        }); /* contact form widget */
        $('.widget_contact_form .contact_form').validator({
            effect: 'contact_form'
        }).submit(function(e) {
            var form = $(this);
            if (!e.isDefaultPrevented()) {
                $.post(this.action, {
                    'theme_contact_form_submit': 1,
                    'to': $('input[name="contact_to"]').val().replace("*", "@"),
                    'name': $('input[name="contact_name"]').val(),
                    'email': $('input[name="contact_email"]').val(),
                    'content': $('textarea[name="contact_content"]').val()
                }, function(data) {
                    form.fadeOut('fast', function() {
                        $(this).siblings('p').show();
                    }).delay(3000).fadeIn('fast', function() {
                        $(this).find('input[name="contact_name"]').val('');
                        $(this).find('input[name="contact_email"]').val('');
                        $(this).find('textarea[name="contact_content"]').val('');
                        $(this).siblings('p').hide();
                    });
                });
                e.preventDefault();
            }
        }); /* contact page form */
        $('.contact_form_wrap .contact_form').validator({
            effect: 'contact_form'
        }).submit(function(e) {
            var form = $(this);
            if (!e.isDefaultPrevented()) {
                var id = form.find('input[name="contact_widget_id"]').val();
                $.post(this.action, {
                    'theme_contact_form_submit': 1,
                    'to': $('input[name="contact_' + id + '_to"]').val().replace("*", "@"),
                    'name': $('input[name="contact_' + id + '_name"]').val(),
                    'email': $('input[name="contact_' + id + '_email"]').val(),
                    'content': $('textarea[name="contact_' + id + '_content"]').val()
                }, function(data) {
                    form.fadeOut('fast', function() {
                        $(this).siblings('.success').show();
                    }).delay(3000).fadeIn('fast', function() {
                        $(this).find('input[name="contact_' + id + '_name"]').val('');
                        $(this).find('input[name="contact_' + id + '_email"]').val('');
                        $(this).find('textarea[name="contact_' + id + '_content"]').val('');
                        $(this).siblings('.success').hide();
                    });
                });
                e.preventDefault();
            }
        });
    }

    if ($('body').is('.responsive')) {
        function updateVideos() {
            // if (!isMobile) {
            //     return;
            // }
            $('.video_frame').each(function() {
                var ratio = $(this).data('ratio');
                if (ratio) {
                    var height = $(this).width() / ratio;
                    $(this).css('height', height);
                }
            });
        }

        function updateImages() {
            themeUpdateImages($('.image_styled img, .product-thumbnail, .woocommerce-main-image img, .easy-image'));
        }

        enquire.register("screen and (min-width: 980px)", {
            match: function() {
                updateImages();
                updateVideos();
            }
        }).register("screen and (min-width: 768px) and (max-width: 979px)", {
            match: function() {
                updateImages();
                updateVideos();
            }
        }).register("screen and (min-width: 568px) and (max-width: 767px)", {
            match: function() {
                updateImages();
                updateVideos();
            }
        }).register("screen and (min-width: 480px) and (max-width: 567px)", {
            match: function() {
                updateImages();
                updateVideos();
            }
        }).register("screen and (max-width: 479px)", {
            match: function() {
                updateImages();
                updateVideos();
            }
        }).register("screen and (max-width: 767px)", {
            match: function() {
                $("table.responsive").each(function(i, element) {
                    splitTable($(element));
                });
            },
            unmatch: function() {
                $("table.responsive").each(function(i, element) {
                    unsplitTable($(element));
                });
            }
        });
    }
});

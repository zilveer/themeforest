/**
 * Plugins Package
 *
 * @author Vedmant <vedmant@gmail.com>
 * @package Mental WP
 * @link http://azelab.com
 *
 * jQuery plugins:
 * mental_menu_bar
 * mental_menu
 * mental_gallery
 * mental_blog
 */


(function ($) {
    "use strict";

    // Avoid `console` errors in browsers that lack a console.
    (function () {
        var method;
        var noop = function () {
        };
        var methods = [
            'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
            'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
            'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
            'timeStamp', 'trace', 'warn'
        ];
        var length = methods.length;
        var console = (window.console = window.console || {});

        while (length--) {
            method = methods[length];

            // Only stub undefined methods.
            if (!console[method]) {
                console[method] = noop;
            }
        }
    }());


    // ============================================================================
    // Mental menu-bar plugin
    // ============================================================================

    (function ($, window, document, undefined) {

        var pluginName = 'mental_menu_bar';
        var defaults = {
            always_show_after_threshold: $('body').hasClass('menu-bar-opened-big') && !$('body').hasClass('menu-bar-ontop') && !$('body').hasClass('menu-bar-push'),
            container_960_threshold: 1300,   // Menubar is always opened if screen width more than 1300px (960px container)
            container_1170_threshold: 1300,  // Menubar is always opened if screen width more than 1600px (1170px container)
            load_closed_below: 768,          // Close menubar on load if screen width less than 768px
            main_block: '#main'              // By default menuber pushes main block when opens
        };

        function Plugin(element, options) {
            this._name = pluginName;
            this.element = element;
            this.options = $.extend({}, defaults, options);

            this.$element = $(element);
            this.$main_block = $(this.options.main_block);

            this.init();
        }

        Plugin.prototype = {
            init: function () {
                var
                    that = this;

                // Determine menubar opening threshold based on max conianter width (query string ?960px)
                this.current_threshold = $('body').hasClass('cont-960') ?
                    this.options.container_960_threshold : this.options.container_1170_threshold;

                // Shod menubar on hover (and hide on mouseout)
                this.$element.hover(
                    function () {
                        that.show();
                    }, function () {
                        if (window.innerWidth < that.current_threshold)
                            that.hide();
                    }
                );

                // Hide menubar on #main hover
                $('#main').hover(function () {
                    if (!that.options.always_show_after_threshold || window.innerWidth < that.current_threshold)
                        that.hide();
                });

                // Toggle menubar on mb-toggler click
                this.$element.find('.mb-toggler').click(function (e) {
                    e.preventDefault();
                    that.toggle();
                });

                // Show/hide menubar based on window width when resizing
                if (this.options.always_show_after_threshold) {
                    $(window).resize(function () {
                        if (window.innerWidth < that.current_threshold && that.is_opened()) that.hide();
                        else if (window.innerWidth > that.current_threshold && !that.is_opened()) that.show();
                    }).resize();
                }

                // Hide on click elsewhere
                $(document).click(function (e) {
                    var container = that.$element;
                    if (!container.is(e.target) // if the target of the click isn't the container...
                        && container.has(e.target).length === 0 // ... nor a descendant of the container
                        && !$('.mb-toggler').is(e.target)
                        && $('.mb-toggler').has(e.target).length === 0
                    ) {
                        // Hide only if screen width less than screen_width_threshold when menu is alsways shown
                        if (!that.options.always_show_after_threshold || window.innerWidth < that.current_threshold)
                            that.hide();
                    }
                });

                // Hide menu with delay if touch screen
                $(window).load(function () {
                    if (Modernizr.touch)
                        setTimeout(function () {
                            that.hide();
                            //start = false;
                        }, 1000);
                });

                // Hide instantly w/o animation if screen width is less than load_closed_below
                if (window.innerWidth < this.options.load_closed_below && this.is_opened()) {
                    this.sw_off_transitions();
                    that.hide();
                    setTimeout(function () {
                        that.sw_on_transitions();
                    }, 500);
                }

            }, // init
            hide: function () {
                $('body').removeClass('menu-bar-opened');
            },
            show: function () {
                $('body').addClass('menu-bar-opened');
            },
            toggle: function () {
                $('body').toggleClass('menu-bar-opened');
            },
            sw_off_transitions: function () {
                this.$main_block.css({
                    'transition-property': 'none',
                    '-moz-transition-property': 'none',
                    '-webkit-transition-property': 'none',
                    '-o-transition-property': 'none'
                })
                this.$element.css({
                    'transition-property': 'none',
                    '-moz-transition-property': 'none',
                    '-webkit-transition-property': 'none',
                    '-o-transition-property': 'none'
                })
            },
            sw_on_transitions: function () {
                this.$main_block.css({
                    'transition-property': '',
                    '-moz-transition-property': '',
                    '-webkit-transition-property': '',
                    '-o-transition-property': ''
                })
                this.$element.css({
                    'transition-property': '',
                    '-moz-transition-property': '',
                    '-webkit-transition-property': '',
                    '-o-transition-property': ''
                })
            },
            is_opened: function () {
                return $('body').hasClass('menu-bar-opened');
            }
        } // Plugin.prototype

        $.fn[pluginName] = function (options) {
            var args = [].slice.call(arguments, 1);
            return this.each(function () {
                if (!$.data(this, 'plugin_' + pluginName))
                    $.data(this, 'plugin_' + pluginName, new Plugin(this, options));
                else if ($.isFunction(Plugin.prototype[options]))
                    $.data(this, 'plugin_' + pluginName)[options].apply($.data(this, 'plugin_' + pluginName), args);
            });
        }
    })(jQuery, window, document);


    // ============================================================================
    // mental_menu plugin
    // ============================================================================

    (function ($, window, document, undefined) {

        var pluginName = 'mental_menu';
        var defaults = {
            easing: 'easeOutBack',
            speed: 'slow',
            accordion_type: true
        };

        function Plugin(element, options) {
            this.element = element;
            this.$element = $(element);
            this.options = $.extend({}, defaults, options);
            this._name = pluginName;
            this.init();
        }

        Plugin.prototype = {
            init: function () {
                var that = this;

                this.options.accordion_type = this.$element.find('>div').hasClass('menu-accordion-type')
                    || this.$element.find('>div >ul').hasClass('menu-accordion-type');

                // Add plus icon
                this.$element.find("li:has(ul)").each(function () {
                    $(this).append('<a class="submenu-toggler" href="#"><i class="fa fa-plus"></i></a>');
                });

                // Bind toggler button
                this.$element.find('.submenu-toggler').click(function (e) {
                    e.preventDefault();
                    that.toggle_sub($(this).closest('ul'), $(this).siblings('ul'), $(this).find('i.fa'))
                });

            },
            toggle_sub: function ($parent_ul, $sub_ul, $icon) {
                if ($icon.hasClass('fa-plus')) $icon.removeClass('fa-plus').addClass('fa-minus');
                else $icon.removeClass('fa-minus').addClass('fa-plus');
                $sub_ul.slideToggle(this.options.speed, this.options.easing);

                // Close all other submenus
                if (this.options.accordion_type) {
                    $parent_ul.find('> li > ul').not($sub_ul)
                        .slideUp(this.options.speed, this.options.easing)
                        .closest('li').find('> a > i.fa').removeClass('fa-minus').addClass('fa-plus');
                }
            }
        } // Plugin.prototype

        $.fn[pluginName] = function (options) {
            var args = [].slice.call(arguments, 1);
            return this.each(function () {
                if (!$.data(this, 'plugin_' + pluginName))
                    $.data(this, 'plugin_' + pluginName, new Plugin(this, options));
                else if ($.isFunction(Plugin.prototype[options]))
                    $.data(this, 'plugin_' + pluginName)[options].apply($.data(this, 'plugin_' + pluginName), args);
            });
        }
    })(jQuery, window, document);


    // ============================================================================
    // Mental Gallery plugin
    // ============================================================================

    (function ($, window, document, undefined) {

        var pluginName = 'mental_gallery';
        var defaults = {
            ajaxurl: mental_vars.ajaxurl || '/wp-admin/admin-ajax.php',
            category: '',
            type: 'expanding',
            ajax_action: 'mental_gallery',
            screen_sm: 768,
            screen_md: 992,
            screen_lg: 1200,
            debug: false
        };

        function Plugin(element, options)
        {
            this._name = pluginName;
            this.element = element;
            this.$element = $(element);
            var data_options = parse_data_options(this.$element.data('options'));
            this.options = $.extend({}, defaults, options);
            this.options = $.extend({}, this.options, data_options);
            this.init();
        }

        function parse_data_options(data_options_raw)
        {
            if(data_options_raw === undefined) return [];
            var options = [];
            data_options_raw.split(';').forEach(function(el){
                var pair = el.split(':');
                if(pair.length == 2) options[pair[0].trim()] = pair[1].trim();
            });
            return options;
        }

        Plugin.prototype = {

            /**
             * Plugin initialization
             */
            init: function () {
                var that = this;

                if (!$.fn.isotope) {
                    console.log('Mental_gallery: Isotope is not loaded');
                    return false;
                }

                // Variables
                this.$gallery = this.$element;
                this.id = this.$gallery.attr('id');
                this.$last_clicked_item = $();
                this.$gl_items = that.$gallery.find('.gl-item:not(.gl-preview):visible');
                this.items_per_page = this.$gallery.data('items-per-page');
                this.columns = this.calc_columns();
                this.$gallery_filters = $('.gallery-filters[data-gallery-id="' + this.id + '"]');
                this.$load_more = $('a[data-gallery-id="' + this.id + '"]');
                this.$load_more_onscroll = this.$gallery.next('.lmb-on-scroll');

                // Initialization
                if (this.options.type == 'expanding') {
                    this.init_isotope_preview();
                    this.init_preview();
                } else {
                    this.init_isotope_masonry();
                }

                this.init_filters();
                this.init_load_more();

                // Relayout on show/hide menubar
                $('#menu-bar').on("webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend", function () {
                    that.$gallery.isotope('layout');
                });
            },

            /**
             * Init Isotope with previews
             */
            init_isotope_preview: function () {
                this.debug('init_isotope_preview');
                this.refresh_items_order_data();

                this.$gallery.isotope({
                    itemSelector: '.gl-item',
                    resizable: false,
                    layoutMode: 'masonry',
                    sortBy: 'custom',
                    getSortData: {
                        custom: function (itemElem) {
                            return $(itemElem).data('order');
                        }
                    }
                });

                // Remove min-height for gl-item when image loaded on home page
                this.process_images_load();
            },

            /**
             * Init Isotope masonry style
             */
            init_isotope_masonry: function () {
                this.debug('init_isotope_masonry');
                this.$gallery.isotope({
                    itemSelector: '.gl-item',
                    resizable: false,
                    layoutMode: 'masonry'
                });
                this.process_images_load();
            },
            /**
             * Init gellery filters
             */
            init_filters: function () {
                this.debug('init_filters');
                var that = this;
                // Filter items
                this.$gallery_filters.on('click', '> li > a', function (e) {
                
                    e.preventDefault();
                    that.remove_preview();
                    that.$gl_items = that.$gallery.find('.gl-item:not(.gl-preview):visible');
                    that.$last_clicked_item = $();

                    that.$gallery_filters.find('> li').removeClass('active');
                    $(this).closest('li').addClass('active');
                    var filterValue = $(this).attr('data-filter');

                    that.$gallery.isotope({
                        filter: function () {
                            if (filterValue == '*') return true;
                            return $.inArray(filterValue, $(this).data('category').toString().split(/[\s,]+/)) != -1;
                        }
                    });


                    
                });
            },

            /**
             * Load more Initialization
             */
            init_load_more: function () {
                this.debug('init_load_more');
                var that = this;
                // Load more
                this.$load_more.on('click', function (e) {
                    var $this = $(this);
                    e.preventDefault();
                    that.remove_preview();
                    that.load_more(that.$load_more.closest('.load-more-block'));
                });

                if(this.$load_more_onscroll.length) {

                    $(window).scroll(function(){
                        if(that.$load_more_onscroll.hasClass('loading')) return;
                        var window_bottom = $(window).scrollTop() + $(window).height();

                        if(window_bottom > that.$load_more_onscroll.offset().top){
                            that.load_more(that.$load_more_onscroll);
                        }
                    });
                }
            },

            /**
             * Previews initialization
             */
            init_preview: function () {
                this.debug('init_preview');
                var that = this;

                // ==== On item Click
                this.$gallery.on('click', '.gl-item:not(.gl-preview) > a', function (e) {
                    e.preventDefault();
                    var $this = $(this).parent();

                    that.remove_preview();

                    if (!that.$last_clicked_item.is($this)) that.show_preview($this);
                    else that.$last_clicked_item = $();

                });

                // Close button
                this.$gallery.on('click', '.glp-close', function (e) {
                    e.preventDefault();
                    that.remove_preview();
                    that.$last_clicked_item = $();
                });

                // === On window resize
                $(window).resize(function () {
                    that.columns = that.calc_columns();
                    that.update_all_previews();
                });
            },

            /**
             * Zoomming in expanded preview image using Intense library
             */
            init_intense_zoom_image: function ($preview) {
                this.debug('init_intense_zoom_image');
                if(Intense == undefined) return;
                $preview.find('.glp-zoom').each(function(){
                    Intense(this);
                })
            },

            /**
             * Load next page of items through Ajax
             * @param $button
             */
            load_more: function ($load_more_block) {
                this.debug('load_more');
                var that = this;

                if($load_more_block.hasClass('no-more-items')
                    || $load_more_block.hasClass('loading')) return;

                $load_more_block.addClass('loading');

                $.ajax({
                    type: "POST",
                    url: that.options.ajaxurl,
                    data: {
                        action: that.options.ajax_action,
                        offset: that.$gallery.find('.gl-item:not(.gl-preview)').length,
                        options: that.options,
                    },
                    success: function (data) {
                        // Get elements from request
                        var $elems = $('<div>' + data + '</div>').find('.gl-item');
                        // append elements to container
                        that.$gallery.append($elems);
                        that.refresh_items_order_data();
                        // add and lay out newly appended elements
                        that.$gallery.isotope('appended', $elems);

                        if ($elems.length == 0){
                            $load_more_block.addClass('no-more-items');
                        }

                        that.process_images_load();
                    },
                    complete: function () {
                        $load_more_block.removeClass('loading');
                    },
                    error: function (jqXHR, textStatus) {
                        console.log(textStatus);
                    }
                });
            },

            /**
             * Columns count calculation
             * @returns {number}
             */
            calc_columns: function () {
                var columns = window.innerWidth < this.options.screen_sm ? 1
                    : window.innerWidth < this.options.screen_md ? 2
                    : window.innerWidth < this.options.screen_lg ? 3
                    : this.$gallery.hasClass('gl-cols-3') ? 3
                    : this.$gallery.hasClass('gl-cols-4') ? 4
                    : this.$gallery.hasClass('gl-cols-5') ? 5
                    : 4;
                return columns;
            },

            /**
             * Refresh Isotope Layout when each image is loaded
             */
            process_images_load: function () {
                var that = this;
                // Remove min-height for gl-item when image loaded on home page
                this.$gallery.find('.gl-loading img').one('load', function () {
                    var $img = $(this);
                    var tempImage1 = new Image();
                    tempImage1.src = $img.attr('src');
                    tempImage1.onload = function() {
                        var ratio = tempImage1.width / tempImage1.height;
                        if(!isNaN(ratio) && ratio < 1) $img.addClass('img-vertical');
                    };

                    $(this).closest('.gl-loading').removeClass('gl-loading');
                    that.$gallery.isotope();
                }).each(function () {
                    if (this.complete) $(this).load();
                });
            },

            /**
             * Refresh items order data
             */
            refresh_items_order_data: function () {
                this.$gl_items = this.$gallery.find('.gl-item:not(.gl-preview):visible').each(function () {
                    $(this).attr('data-order', ($(this).index() + 1) * 10);
                });
            },

            /**
             * Scropp to expanded preview (make it in the center of screen)
             * @param $preview
             */
            scroll_to_preview: function ($preview) {
                setTimeout(function () {
                    $('html, body').animate({
                        scrollTop: $preview.offset().top - (window.innerHeight - $preview.outerHeight(true)) / 2
                    }, 500);
                }, 500);
            },

            /**
             * Remove expanded preview
             */
            remove_preview: function () {
                var $preview = this.$gallery.find('> .gl-preview');
                if ($preview.length) this.$gallery.isotope('remove', $preview).isotope('layout');
            },

            /**
             * Show expanding preview
             * @param $item clicked item
             */
            show_preview: function ($item) {
                var that = this;
                var item_index = $item.siblings(":not(.gl-preview):visible").andSelf().index($item);
                var $preview = this.insert_preview($item, item_index);

                this.set_arrow(item_index, $preview);
                setTimeout(function () {
                    that.$gallery.isotope('layout');
                }, 10);
                this.scroll_to_preview($preview);
                // Fix bootstrap caorusel, set unique ids
                this.carousel_fix($preview.find('.carousel'));
                this.video_audio_init($preview);
                this.init_intense_zoom_image($preview);
                this.$last_clicked_item = $item;
            },

            /**
             * Update all previews
             */
            update_all_previews: function ()
            {
                var that = this;

                this.$gallery.find('> .gl-preview').each(function(){
                    that.update_preview($(this));
                });

                this.$gallery.isotope('updateSortData').isotope({sortBy: 'custom'});
            },

            /**
             * Update preview
             * @param $preview
             */
            update_preview: function ($preview)
            {
                var item_index = $preview.data('item_index');
                var preview_order = this.get_preview_order(item_index);

                $preview.data('order', preview_order);
                this.set_arrow(item_index, $preview);
            },

            /**
             * Find preview order
             * @param item_index
             * @returns {*}
             */
            get_preview_order: function(item_index)
            {
                var row_index = Math.floor(item_index / this.columns);
                var last_in_row_index = (row_index + 1) * this.columns;
                var $gl_items_visible = this.$gallery.find('> .gl-item:not(.gl-preview):visible');
                if (last_in_row_index > $gl_items_visible.length - 1) // If bigger that items count, set last item
                    last_in_row_index = $gl_items_visible.length;
                var last_in_row_order = $gl_items_visible.eq(last_in_row_index - 1).data('order');
                var preview_order = last_in_row_order + 1;

                return preview_order;
            },

            /**
             * Insert preview block into DOM
             * @param $item
             * @param item_index
             * @returns {*|HTMLElement}
             */
            insert_preview: function ($item, item_index) {
                var that = this;
                var $preview = $item.find('.gl-preview');
                var preview_order = this.get_preview_order(item_index);
                var $temp_preview = $('<li class="gl-item gl-preview" data-category="' + $item.data('category') + '" data-order="' + preview_order + '">' + $preview.html() + '</li>');

                // Set max height for preview
                $temp_preview.find('img').css({'max-height': (window.innerHeight - 45) + 'px'});

                // Save item_index
                $temp_preview.data('item_index', item_index);

                // Add preview and refresh isotope
                this.$gallery.append($temp_preview.show());
                this.$gallery.isotope('insert', $temp_preview);

                // Reyalout when image is loaded
                $temp_preview.find('img').one('load', function () {
                    that.$gallery.isotope('layout');
                });

                return $temp_preview;
            },

            /**
             * Set Arrow position
             * @param item_index
             * @param $preview
             */
            set_arrow: function (item_index, $preview) {
                var row_index = Math.floor(item_index / this.columns);
                var row_item_index = item_index - ((row_index + 1) * this.columns - this.columns);
                $preview.find('.glp-arrow').css({
                    left: ((row_item_index + 1) * (100 / this.columns)) - (100 / this.columns / 2) + '%'
                });

            },

            /**
             * Fix Bootstrap carousel: alter IDs, reinit
             * @param $carousel
             */
            carousel_fix: function ($carousel) {
                var new_id = $carousel.attr('id') + '-a';
                $carousel.attr('id', new_id);
                $carousel.find('.carousel-control').attr('href', '#' + new_id);
                $carousel.find('.carousel-indicators li').attr('data-target', '#' + new_id);
                $carousel.carousel();
            },

            /**
             * Fix Mediaelementplayer initialization in preview
             * @param $temp_preview
             */
            video_audio_init: function ($temp_preview) {
                var settings = {};
                if (typeof _wpmejsSettings !== 'undefined') {
                    settings.pluginPath = _wpmejsSettings.pluginPath;
                }
                if($.fn.mediaelementplayer)
                    $temp_preview.find('.wp-audio-shortcode-preview, .wp-video-shortcode-preview').mediaelementplayer(settings);
                $temp_preview.find('.wp-playlist-preview').each(function () {
                    $(this).addClass('wp-playlist');
                    return new WPPlaylistView({el: this});
                });
            },

            /**
             * Debug function
             * @param msg
             */
            debug: function (msg) {
                if (!this.options.debug) return;
                console.log(msg);
            }

        }; // Plugin.prototype

        $.fn[pluginName] = function (options) {
            var args = [].slice.call(arguments, 1);
            return this.each(function () {
                if (!$.data(this, 'plugin_' + pluginName))
                    $.data(this, 'plugin_' + pluginName, new Plugin(this, options));
                else if ($.isFunction(Plugin.prototype[options]))
                    $.data(this, 'plugin_' + pluginName)[options].apply($.data(this, 'plugin_' + pluginName), args);
            });
        }
    })(jQuery, window, document);


    // ============================================================================
    // Mental blog plugin
    // ============================================================================

    (function ($, window, document, undefined) {

        var pluginName = 'mental_blog';
        var defaults = {
            ajaxurl: mental_vars.ajaxurl || '/wp-admin/admin-ajax.php',
            type: 'vertical',
        };

        function Plugin(element, options)
        {
            this.element = element;
            this.$element = $(element);
            var data_options = parse_data_options(this.$element.data('options'));
            this.options = $.extend({}, defaults, options);
            this.options = $.extend({}, this.options, data_options);
            this._name = pluginName;
            this.init();
        }

        function parse_data_options(data_options_raw)
        {
            if(data_options_raw === undefined) return [];
            var options = [];
            data_options_raw.split(';').forEach(function(el){
                var pair = el.split(':');
                if(pair.length == 2) options[pair[0].trim()] = pair[1].trim();
            });
            return options;
        }

        Plugin.prototype = {

            /**
             * Plugin initialization
             * @returns {boolean}
             */
            init: function () {
                var that = this;

                if (!$.fn.isotope) {
                    console.log('Mental_blog: Isotope is not loaded');
                    return false;
                }

                // Isotope supported types
                if(this.options.type == 'full') this.options.type = 'vertical';

                this.id = this.$element.attr('id');
                this.$load_more_onscroll = this.$element.next('.lmb-on-scroll');
                this.$load_more = $('a[data-blog-id="' + this.id + '"]');

                this.$element.isotope({
                    itemSelector: '.isotope-item',
                    resizable: false,
                    layoutMode: this.options.type,
                    vertical: {horizontalAlignment: 0.5}
                });

                this.init_load_more();

                this.process_images_load();

                setTimeout(function () {
                    that.$element.isotope('layout');
                }, 500);
            },

            /**
             * Load more Initialization
             */
            init_load_more: function () {
                var that = this;
                // Load more
                this.$load_more.on('click', function (e) {
                    e.preventDefault();
                    that.load_more(that.$load_more.closest('.load-more-block'));
                });

                if(this.$load_more_onscroll.length) {

                    $(window).scroll(function(){
                        if(that.$load_more_onscroll.hasClass('loading')) return;
                        var window_bottom = $(window).scrollTop() + $(window).height();

                        if(window_bottom > that.$load_more_onscroll.offset().top){
                            that.load_more(that.$load_more_onscroll);
                        }
                    });
                }
            },

            /**
             * Load next page of items through Ajax
             * @param $button
             */
            load_more: function ($load_more_block) {
                var that = this;

                if($load_more_block.hasClass('no-more-items')
                    || $load_more_block.hasClass('loading') )return;

                $load_more_block.addClass('loading');

                $.ajax({
                    type: "POST",
                    url: that.options.ajaxurl,
                    data: {
                        action: 'mental_blog',
                        offset: that.$element.find('.blog-item').length,
                        options: that.options,
                    },
                    success: function (data) {
                        // Get elements from request
                        var $elems = $('<div>' + data + '</div>').find('.blog-item');
                        // append elements to container
                        var $grid = that.$element.append($elems)
                        // add and lay out newly appended elements
                            .isotope('appended', $elems);
                        $grid.imagesLoaded().progress( function() {
                            $grid.isotope('layout');
                        });
                        if ($elems.length == 0) {
                            $load_more_block.addClass('no-more-items');
                        }

                        that.process_images_load();
                        that.carousel_init($elems);
                        that.video_audio_init($elems);
                    },
                    complete: function () {
                        $load_more_block.removeClass('loading');
                    },
                    error: function (jqXHR, textStatus) {
                        console.log(textStatus);
                    }
                });
            },

            /**
             * Relayout isotope blog when image loaded
             */
            process_images_load: function () {
                var that = this;
                // Remove min-height for gl-item when image loaded on home page
                this.$element.find('img').one('load', function () {
                    that.$element.isotope();
                }).each(function () {
                    if (this.complete) $(this).load();
                });
            },

            /**
             * Fix Bootstrap carousel: reinit
             * @param $carousel
             */
            carousel_init: function ($items) {
                $items.find('.carousel').carousel();
            },

            /**
             * Fix Mediaelementplayer initialization in preview
             * @param $items
             */
            video_audio_init: function ($items) {
                var settings = {};
                if (typeof _wpmejsSettings !== 'undefined') {
                    settings.pluginPath = _wpmejsSettings.pluginPath;
                }
                if($.fn.mediaelementplayer)
                    $items.find('.wp-audio-shortcode, .wp-video-shortcode').mediaelementplayer(settings);

                if(typeof WPPlaylistView != 'undefined')
                    $items.find('.wp-playlist').each(function () {
                        return new WPPlaylistView({el: this});
                    });
                this.$element.isotope('layout');
            },


        } // Plugin.prototype

        $.fn[pluginName] = function (options) {
            var args = [].slice.call(arguments, 1);
            return this.each(function () {
                if (!$.data(this, 'plugin_' + pluginName))
                    $.data(this, 'plugin_' + pluginName, new Plugin(this, options));
                else if ($.isFunction(Plugin.prototype[options]))
                    $.data(this, 'plugin_' + pluginName)[options].apply($.data(this, 'plugin_' + pluginName), args);
            });
        }
    })(jQuery, window, document);


    // ============================================================================
    // Helpers
    // ============================================================================


    (window.onpopstate = function () {
        var match,
            pl = /\+/g,  // Regex for replacing addition symbol with a space
            search = /([^&=]+)=?([^&]*)/g,
            decode = function (s) {
                return decodeURIComponent(s.replace(pl, " "));
            },
            query = window.location.search.substring(1);

        window.urlParams = {};
        while (match = search.exec(query))
            urlParams[decode(match[1])] = decode(match[2]);
    })();


})(jQuery);
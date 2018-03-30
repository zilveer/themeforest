<?php
namespace Handyman\Core;

if (!class_exists('\Handyman\Core\Colors')) {

    /**
     * Class Colors
     *
     * Generate color scheme file for selected combination for primary and secondary color
     *
     * @package Handyman\Core
     */
    class Colors
    {

        /**
         * @var
         */
        public static $_color_shemes;


        /**
         * @var Colors
         */
        public static $single;


        /**
         * Primary Color
         * @var string
         */
        protected $_primary;


        /**
         * Secondary color
         * @var string
         */
        protected $_secondary;


        /**
         * Mobile Menu Background
         * @var string
         */
        protected $_mob_menu_bg;
        protected $_mob_submenu_bg;


        /**
         * @var
         */
        protected $_slider_btn_bg;
        protected $_slider_btn_bg_hover;
        protected $_slider_btn_text;
        protected $_slider_btn_text_hover;

        protected $_form_btn_bg;
        protected $_form_btn_bg_hover;
        protected $_form_btn_text;
        protected $_form_btn_text_hover;

        protected $_comment_avatar_color;


        public function __construct()
        {
            self::$single =& $this;
            self::set_color_schemes_presets();
            add_action('wp_enqueue_scripts', array($this, 'generateCss'), 101);
        }


        public static function single(){

            if(self::$single == null){
                new Colors();
            }

            return self::$single;
        }


        /**
         * Generates CSS code
         */
        public function generateCss()
        {
            if (is_admin()) return;

            $_c = \Handyman\Core\Customizer::$instance;

            // Load colors
            $this->_primary = $_c::opt('theme-primary-color');
            $this->_secondary = $_c::opt('theme-secondary-color');
            $this->_mob_menu_bg = $_c::opt('theme-mobile-menu-bg-color');
            $this->_mob_submenu_bg = $_c::opt('theme-mobile-submenu-bg-color');

            $this->_slider_btn_bg = $_c::opt('slider-btn-bg');
            $this->_slider_btn_bg_hover = $_c::opt('slider-btn-bg-hover');
            $this->_slider_btn_text = $_c::opt('slider-btn-text');
            $this->_slider_btn_text_hover = $_c::opt('slider-btn-text-hover');

            $this->_form_btn_bg = $_c::opt('form-btn-bg');
            $this->_form_btn_bg_hover = $_c::opt('form-btn-bg-hover');
            $this->_form_btn_text = $_c::opt('form-btn-text');
            $this->_form_btn_text_hover = $_c::opt('form-btn-text-hover');

            $this->_comment_avatar_color = $_c::opt('comment_avatar_color');

            $header_color = layers_get_theme_mod( 'header-background-color', false );

            if(!$header_color){
                $header_color = $this->_secondary;
            }


            // Preloader
            layers_inline_styles('.tl-loader-wrapper.animated, .tl-loader-wrapper { background-color: ' . $this->_primary . ';}');

            layers_inline_styles(array(
                'selectors' => array('mark',
                    '.sitename.sitetitle a',
                    '.header-contact',
                    '.header-contact ul li a',
                    '.slide .section-title .excerpt',
                    'ul.menu li',
                    'ul.menu li a:hover',
                    'ul.menu li.active > a',
                    'ul.menu li.devider'
                ),
                'css' => array('color' => $this->_primary)
            ));

            layers_inline_styles(array(
                    'selectors' => array('.title-container'),
                    'css' => array('background-color' => $this->_primary)
            ));

            // Header stucked to top
            layers_inline_styles(array(
                'selectors' => array('.header-site.is_stuck .header-contact ul li a'),
                'css' => array('border-color' => $this->_primary)
            ));

            // Mobile sidebar

            layers_inline_styles(array(
                'selectors' => array('.responsive-nav .l-menu'), 'css' => array('color' => $this->_primary)
            ));

            layers_inline_styles(array(
                'selectors' => array('div[class*=\' off-canvas-\']'),
                'css' => array('background-color' => $this->_mob_menu_bg)
            ));

            layers_inline_styles(array(
                'selectors' => array(
                    '.nav-mobile .nav-vertical li:hover > a',
                    '.nav-mobile .nav-vertical li.active > a'
                ),
                'css' => array('background-color' => 'rgb(' . $this->shade($this->_mob_menu_bg, 'darker', 10, true) . ')') // !important
            ));

            // Navigation - submenu background color

            // Second level
            layers_inline_styles('.flexnav li ul li a{background:' . 'rgb(' . $this->shade($this->_mob_menu_bg, 'darker', 2, true) . ')' . ';}');

            //nth level
            layers_inline_styles('.flexnav ul li ul li a{background:' . 'rgb(' . $this->shade($this->_mob_menu_bg, 'darker', 2, true) . ')' . ';}');
            layers_inline_styles('.flexnav li ul > li:hover > a{background:' . 'rgb(' . $this->shade($this->_mob_menu_bg, 'darker', 8, true) . ')' . ';}');

            // n-ht level

            // Buttons

            layers_inline_styles(array(
                'selectors' => array('.button'),
                'css' => array(
                    'border-color' => $this->_secondary,
                    'color' => $this->_secondary
                )
            ));
            layers_inline_styles(array(
                'selectors' => array('.button:hover', '.button.active'),
                'css' => array('background-color' => $this->_secondary)
            ));

            // Button in slider

            layers_inline_styles(array(
                'selectors' => array('.slide .button'),
                'css' => array(
                    'background-color' => $this->_slider_btn_bg,
                    'color' => $this->_slider_btn_text
                )
            ));
            layers_inline_styles(array(
                'selectors' => array('.slide .button i'),
                'css' => array('color' => $this->_slider_btn_text)
            ));
            layers_inline_styles(array(
                'selectors' => array('.slide .button:hover'),
                'css' => array('color' => $this->_slider_btn_text_hover,
                    'background-color' => $this->_slider_btn_bg_hover
                )
            ));
            layers_inline_styles(array(
                'selectors' => array('.slide .button:hover i'),
                'css' => array('color' => $this->_slider_btn_text_hover)
            ));

            layers_inline_styles(array(
                'selectors' => array(
                    '.swiper-container .swiper-pagination-switch:hover',
                    '.swiper-container .swiper-pagination-switch.swiper-visible-switch.swiper-active-switch'),
                'css' => array('border-color' => $this->_slider_btn_bg)
            ));

            // Headings

            layers_inline_styles(array(
                'selectors' => array('.thumbnail-body .article-title .heading a:hover', 'article .article-title .heading a:hover'),
                'css' => array('color' => $this->_primary)
            ));

            // Form buttons

            layers_inline_styles(array(
                'selectors' => array('.wpcf7-form .form-action a.button',
                    '.wpcf7-form .form-action input.button'),
                'css' => array('color' => $this->_form_btn_text,
                    'background-color' => $this->_form_btn_bg)
            ));
            layers_inline_styles(array(
                'selectors' => array('.wpcf7-form .form-action a.button:hover'),
                'css' => array('color' => $this->_form_btn_text_hover,
                    'background-color' => $this->_form_btn_bg_hover)
            ));

            // Form label

            layers_inline_styles(array('selectors' => array('label.label-floatlabel'), 'css' => array('color' => $this->_primary . ' !important')));
            layers_inline_styles(array('selectors' => array('.section-title .excerpt'), 'css' => array('color' => $this->_secondary)));

            /* -- 404 & search -- */

            layers_inline_styles(array(
                'selectors' => array('.error404 .search-submit', '.search .search-submit'),
                'css' => array('background-color' => $this->_secondary)
            ));
            layers_inline_styles(array(
                'selectors' => array('.error404 .search-submit:hover', '.search .search-submit:hover'),
                'css' => array('background-color' => $this->_primary, 'color' => $this->_secondary)
            ));

            // Pricing Table
            layers_inline_styles(array(
                'selectors' => array('.pricing-table-column .price-item-inner .button'),
                'css' => array('background-color' => $this->_form_btn_bg_hover, 'color' => $this->_form_btn_text_hover)
            ));
            layers_inline_styles(array(
                'selectors' => array('.pricing-table-column .price-item-inner .button:hover'),
                'css' => array('background-color' => $this->_form_btn_bg, 'color' => $this->_form_btn_text)
            ));
            layers_inline_styles(array(
                'selectors' => array('.pricing-table-column.primary .price-item-inner .button'),
                'css' => array('background-color' => $this->_form_btn_bg, 'color' => $this->_form_btn_text)
            ));
            layers_inline_styles(array(
                'selectors' => array('.pricing-table-column.primary .price-item-inner .button:hover'),
                'css' => array('background-color' => $this->_form_btn_bg_hover, 'color' => $this->_form_btn_text_hover)
            ));
            layers_inline_styles(array(
                'selectors' => array('.pricing-table-column.primary .price-item-inner'),
                'css' => array(
                    'border-top-color' => $this->_primary,
                    'border-bottom-color' => $this->_primary,
                )
            ));
            layers_inline_styles(array(
                'selectors' => array('.pricing-table-column.primary .pricing-plan-number > span', '.pricetable-body li:before'),
                'css' => array('color' => $this->_primary)
            ));

            // Request a handyman section

            layers_inline_styles(array(
                'selectors' => array('.tl-contactinfo ul li span'),
                'css' => array('color' => $this->_primary)
            ));
            layers_inline_styles(array(
                'selectors' => array('.request-handyman'),
                'css' => array('background-color' => $this->_secondary)
            ));


            // Sidebar

            layers_inline_styles(array(
                'selectors' => array('.sidebar .widget a'),
                'css' => array('color' => $this->_secondary)
            ));
            layers_inline_styles(array(
                'selectors' => array('.sidebar .widget a:hover'),
                'css' => array('color' => $this->_primary)
            ));

            layers_inline_styles(array(
                'selectors' => array('.widget_tl_tag .tag-list a:hover'),
                'css' => array('background-color' => $this->_secondary)
            ));
            layers_inline_styles(array(
                'selectors' => array('.sidebar .widget_tl_recent_tweets .tweet-meta a'),
                'css' => array('color' => $this->_secondary, 'opacity' => '0.75')
            ));
            layers_inline_styles(array(
                'selectors' => array('.sidebar .tweet-text'),
                'css' => array('color' => $this->_secondary)
            ));
            layers_inline_styles(array(
                'selectors' => array('.sidebar .tweet-text a'),
                'css' => array('color' => $this->_primary)
            ));

            layers_inline_styles(array(
                'selectors' => array('.widget_categories li > span'),
                'css' => array('color' => $this->_secondary,
                    'border-color' => $this->_secondary)
            ));

            // Sidebar navigation widget
            layers_inline_styles(array(
                'selectors' => array('.sidebar .widget.widget_nav_menu > div > ul li a'),
                'css' => array('color' => $this->_secondary)
            ));
            layers_inline_styles(array(
                'selectors' => array('.sidebar .widget.widget_nav_menu > div > ul li a:hover'),
                'css' => array('color' => $this->_primary)
            ));

            //Calendar widget
            layers_inline_styles(array(
                'selectors' => array('#footer .sidebar .widget_calendar table th', '.widget.widget_calendar table#wp-calendar a'),
                'css' => array('color' => $this->_primary)
            ));

            // Footer
            layers_inline_styles(array(
                'selectors' => array('#footer .sidebar .widget .section-nav-title', "div[class*=' off-canvas-'] .section-nav-title"),
                'css' => array('color' => $this->_primary)
            ));

            layers_inline_styles(array(
                'selectors' => array('.footer-site .social-icon'),
                'css' => array('color' => $this->_primary, 'border-color' => $this->_primary)
            ));
            layers_inline_styles(array(
                'selectors' => array('.footer-site .social-icon:hover'),
                'css' => array('color' => $this->_secondary, 'background-color' => $this->_primary)
            ));

            layers_inline_styles(array(
                'selectors' => array('footer > .social-share a'),
                'css' => array('color' => $this->_secondary)
            ));
            layers_inline_styles(array(
                'selectors' => array('footer > .social-share a:hover'),
                'css' => array('color' => $this->_primary)
            ));


            // Subscription Widget
            layers_inline_styles(array(
                'selectors' => array('.jetpack_subscription_widget.widget.well', '.jetpack_subscription_widget a.button:hover'),
                'css' => array('background' => $this->_primary)
            ));
            layers_inline_styles('.jetpack_subscription_widget a.button{ background: ' . $this->_secondary . '; color: #fff; }');
            layers_inline_styles('.jetpack_subscription_widget a.button:hover{ background: ' . $this->_primary . '; color: #fff;}');


            // Widgets in footer
            layers_inline_styles(array(
                'selectors' => array('#footer .sidebar .widget a:hover'),
                'css' => array('color' => $this->_primary)
            ));

            layers_inline_styles(array(
                'selectors' => array('.header-contact i[class*=\' icon-ti-\']',
                    '.header-contact i[class^=\'icon-ti-\']'),
                'css' => array('color' => $this->_secondary)
            ));
            layers_inline_styles(array(
                'selectors' => array('.header-contact ul li a'),
                'css' => array('border-color' => $this->_primary)
            ));

            // Popup Content wrapper

            layers_inline_styles(array(
                'selectors' => array('.popup-content-wrapper footer .header-contact',
                    '.popup-content-wrapper footer .header-contact li.text-slogan'),
                'css' => array('color' => $this->_secondary)
            ));
            layers_inline_styles(array(
                'selectors' => array('.popup-content-wrapper footer .header-contact li.phonedigits span'),
                'css' => array('color' => $this->_primary)
            ));
            layers_inline_styles(array(
                'selectors' => array('.popup-content-wrapper footer .button'),
                'css' => array('color' => $this->_form_btn_text,
                    'background-color' => $this->_form_btn_bg)
            ));
            layers_inline_styles(array(
                'selectors' => array('.popup-content-wrapper footer .button:hover'),
                'css' => array('color' => $this->_form_btn_text_hover,
                    'background-color' => $this->_form_btn_bg_hover)
            ));


            // Forms

            layers_inline_styles(array(
                'selectors' => array('.wpcf7-form-control-wrap.required:after',
                    '.form-inner-wrapper .mandatory span'),
                'css' => array('border-right-color' => $this->_primary, 'border-top-color' => $this->_primary)
            ));
            layers_inline_styles(array(
                'selectors' => array('.wpcf7-form .form-action input.button[type="submit"]'),
                'css' => array('background-color' => $this->_primary, 'color' => $this->_secondary)
            ));
            layers_inline_styles(array(
                'selectors' => array('.wpcf7-form .form-action input.button[type="submit"]:hover'),
                'css' => array('color' => $this->_secondary)
            ));
            layers_inline_styles(array(
                'selectors' => array('.form-inner-wrapper .mandatory span'),
                'css' => array('border-top-color' => $this->_primary . ' !important', 'border-right-color' => $this->_primary . ' !important')
            ));


            // Sticky Header

            layers_inline_styles( '.header-site, .header-site.header-sticky', 'css', array(
                'css' => 'background-color: rgba(' . implode( ', ' , layers_hex2rgb( $header_color ) ) . ', 0.9 );'
            ));

            layers_inline_styles(array(
                'selectors' => array('.widget .tl-nav-container'),
                'css' => array('background' => $this->_secondary,
                    //'background' => 'rgba(' . apply_filters('tl/hex2rgba', $this->_secondary, '0.9', true) . ') !important')
                    //'background' => $this->_secondary . ' !important'
            )));

            layers_inline_styles(array(
                'selectors' => array('div.is_stuck_show .tl-nav-container'),
                'css' => array('background' => $this->_secondary,
                               'background' => 'rgb(' . $this->shade($this->_secondary, 'darker', 5, true) . ') !important')
            ));

            layers_inline_styles(array(
                'selectors' => array(
                    'header.article-title.large',
                    '.blogtips .article-title .heading',
                    '.blogtips .article-title .heading a'
                ),
                'css' => array('color' => $this->_secondary)
            ));

            // Main section's heading
            layers_inline_styles(array(
                'selectors' => array('.section-title .heading'),
                'css' => array('color' => $this->_secondary)
            ));
            layers_inline_styles(array(
                'selectors' => array('.section-title .heading span'),
                'css' => array('color' => $this->_primary)
            ));

            layers_inline_styles(array(
                'selectors' => array(
                    '.layers-tl-service-widget .media-image,
                     .layers-tl-service-widget .media-image a'),
                'css' => array('color' => $this->_primary)
            ));

            layers_inline_styles(array(
                'selectors' => array('.layers-tl-service-widget .media-body .button:hover'),
                'css' => array('color' => $this->_secondary)
            ));

            // Post / Page content
            layers_inline_styles('.related-posts-wrapper .heading a{ color:' . $this->_secondary . ';}');

            layers_inline_styles(array('selectors' => array('.story p a'), 'css' => array('color' => $this->_secondary)));
            layers_inline_styles(array('selectors' => array('.story p a:hover'), 'css' => array('color' => $this->_primary)));

            // Title container - teaser

            layers_inline_styles(array('selectors' => array('.title-container .heading', '.title-container .bread-crumbs a'),
                'css' => array('color' => $this->_secondary)));

            // Inner post navigation

            layers_inline_styles(array(
                'selectors' => array('.inner-post-pagination a'),
                'css' => array('color' => $this->_secondary)
            ));

            layers_inline_styles(array(
                'selectors' => array('.inner-post-pagination > span',
                    '.inner-post-pagination a:hover',
                    '.inner-post-pagination a:hover span'),
                'css' => array('color' => $this->_primary)
            ));

            // Pagination

            layers_inline_styles(array(
                'selectors' => array('.pagination a', '.pagination span'),
                'css' => array('color' => $this->_secondary, 'border-color' => $this->_secondary)
            ));
            layers_inline_styles(array(
                'selectors' => array('.pagination .current',
                    '.pagination a:hover'),
                'css' => array('background-color' => $this->_secondary)
            ));

            // Testimonials

            layers_inline_styles(array(
                'selectors' => array('.tl-blockquote.swiper-slide span',
                    '.tl-blockquote blockquote:before',
                    '.tweet-meta i',
                    '.tweet-text a',
                    '.meta-info .meta-item i'),
                'css' => array('color' => $this->_primary)
            ));

            // Featured section

            layers_inline_styles(array(
                'selectors' => array('.featured-section .heading',
                    '.featured-section .heading a',
                    '.featured-section .header-icon i'),
                'css' => array('color' => $this->_form_btn_text)
            ));

            layers_inline_styles(array(
                'selectors' => array('.featured-section .grid > div:nth-child(1)'),
                'css' => array('background-color' => $this->_primary)
            ));
            layers_inline_styles(array(
                'selectors' => array('.featured-section .grid > div:nth-child(2)'),
                'css' => array('background-color' => 'rgb(' . $this->shade($this->_primary, 'darker', 5, true) . ')')
            ));
            layers_inline_styles(array(
                'selectors' => array('.featured-section .grid > div:nth-child(3)'),
                'css' => array('background-color' => 'rgb(' . $this->shade($this->_primary, 'darker', 10, true) . ')')
            ));
            layers_inline_styles(array(
                'selectors' => array('.featured-section .grid > div:nth-child(4)'),
                'css' => array('background-color' => 'rgb(' . $this->shade($this->_primary, 'darker', 15, true) . ')')
            ));

            // Shortcodes

            layers_inline_styles(array(
                'selectors' => array('.tl-spoiler h6:before', '.tl-spoiler > h6:before'),
                'css' => array('color' => $this->_primary)
            ));

            // Footer
            layers_inline_styles(array('selectors' => array('.footer-site'), 'css' => array('background-color' => $this->_secondary)));
            layers_inline_styles(array('selectors' => array('.footer-arrow'), 'css' => array('border-bottom-color' => $this->_secondary)));

            $footer_color = layers_get_theme_mod('footer-background-color', FALSE);

            if ('' != $footer_color) {
                layers_inline_styles('#footer.footer-site', 'background', array(
                    'background' => array('color' => $footer_color),
                ));
                layers_inline_styles('.footer-site .footer-arrow{ border-bottom-color:' . $footer_color . ';}');
            }

            // Comments

            layers_inline_styles(array(
                'selectors' => array('#comments mark',
                    '.comment .avatar-name a'),
                'css' => array('color' => $this->_comment_avatar_color)
            ));

            layers_inline_styles(array(
                'selectors' => array('.form-row.comment-form-email:before',
                    '.form-row.comment-form-comment:before',
                    '.form-row.comment-form-author:before',
                    '.comment-form .column:before'),
                'css' => array('border-top-color' => $this->_primary, 'border-right-color' => $this->_primary)
            ));

            layers_inline_styles(array(
                'selectors' => array('.comment-form-wrapper .button.send-comment-fake'),
                'css' => array('color' => $this->_form_btn_text, 'background-color' => $this->_form_btn_bg)
            ));
            layers_inline_styles(array(
                'selectors' => array('.comment-form-wrapper .button.send-comment-fake:hover'),
                'css' => array('color' => $this->_form_btn_text_hover, 'background-color' => $this->_form_btn_bg_hover)
            ));
            layers_inline_styles(array(
                'selectors' => array('.comment .avatar-body .comment-reply-link i'),
                'css' => array('color' => $this->_primary)
            ));

            layers_inline_styles("@media (min-width: 769px){
                                            .with-overlay .thumbnail-body{
                                                background-color: " . $this->_secondary . ";
                                                background-color: rgba(" . apply_filters('tl/hex2rgba', $this->_secondary, 0.75, true) . ");
                                            }
                                 }"
            );
        }


        /**
         * @param $rgb
         * @param string $type
         * @param int $percentage_change
         * @return array
         */
        public function shade($rgb, $type = 'darker', $percentage_change = 10, $to_string = false)
        {
            $new_shade = array();

            if (!is_array($rgb)) {
                $rgb = apply_filters('tl/hex2rgba', $rgb);
            }

            if ($type == 'lighter') {
                $new_shade = array(
                    'red' => 255 - (255 - $rgb['red']) + $percentage_change,
                    'green' => 255 - (255 - $rgb['green']) + $percentage_change,
                    'blue' => 255 - (255 - $rgb['blue']) + $percentage_change
                );
            } else {
                $new_shade = array(
                    'red' => $rgb['red'] - $percentage_change,
                    'green' => $rgb['green'] - $percentage_change,
                    'blue' => $rgb['blue'] - $percentage_change
                );
            }

            if ($to_string) {
                $new_shade = implode(',', $new_shade);
            }
            return $new_shade;
        }


        /**
         * @param $key
         * @return string
         */
        public function get($key)
        {
            return isset($this->$key) ? $this->$key : '';
        }


        public static function set_color_schemes_presets()
        {
            self::$_color_shemes = array(
                // Yellow - Blue
                'yb' => array('layers-theme-primary-color' => '#f2a61f',
                    'layers-theme-secondary-color' => '#003668',
                    'layers-theme-mobile-menu-bg-color' => '#00284c',
                    'layers-theme-mobile-submenu-bg-color' => '#042240',
                    'layers-slider-btn-bg' => '#f2a61f',
                    'layers-slider-btn-bg-hover' => '#003668',
                    'layers-slider-btn-text' => '#003668',
                    'layers-slider-btn-text-hover' => '#ffffff',
                    'layers-form-btn-bg' => '#f2a61f',
                    'layers-form-btn-bg-hover' => '#003668',
                    'layers-form-btn-text' => '#003668',
                    'layers-form-btn-text-hover' => '#ffffff',
                    'layers-comment_avatar_color' => '#003368',
                    'layers-header-background-color' => '',
                    'layers-site-accent-color' => '',
                    'layers-footer-background-color' => '',
                ),
                // Cherry - Dark Grey
                'cdg' => array(
                    'layers-theme-primary-color' => '#ff5a51',
                    'layers-theme-secondary-color' => '#444444',
                    'layers-theme-mobile-menu-bg-color' => '#343434',
                    'layers-theme-mobile-submenu-bg-color' => '#272727',
                    'layers-slider-btn-bg' => '#ff5a51',
                    'layers-slider-btn-bg-hover' => '#444444',
                    'layers-slider-btn-text' => '#ffffff',
                    'layers-slider-btn-text-hover' => '#ff5a51',
                    'layers-form-btn-bg' => '#ff5a51',
                    'layers-form-btn-bg-hover' => '#444444',
                    'layers-form-btn-text' => '#ffffff',
                    'layers-form-btn-text-hover' => '#ff5a51',
                    'layers-comment_avatar_color' => '#ff5a51',
                    'layers-header-background-color' => '',
                    'layers-site-accent-color' => '',
                    'layers-footer-background-color' => '',
                ),
                // Green - Brown
                'gbr' => array(
                    'layers-theme-primary-color' => '#8aa177',
                    'layers-theme-secondary-color' => '#8e5043',
                    'layers-theme-mobile-menu-bg-color' => '#754137',
                    'layers-theme-mobile-submenu-bg-color' => '#754137',
                    'layers-slider-btn-bg' => '#8aa177',
                    'layers-slider-btn-bg-hover' => '#8e5043',
                    'layers-slider-btn-text' => '#ffffff',
                    'layers-slider-btn-text-hover' => '#ffffff',
                    'layers-form-btn-bg' => '#8aa177',
                    'layers-form-btn-bg-hover' => '#8e5043',
                    'layers-form-btn-text' => '#ffffff',
                    'layers-form-btn-text-hover' => '#ffffff',
                    'layers-comment_avatar_color' => '#8aa177',
                    'layers-header-background-color' => '',
                    'layers-site-accent-color' => '',
                    'layers-footer-background-color' => '',
                ),
                // Light Blue / Dark Blue
                'lbdb' => array(
                    'layers-theme-primary-color' => '#4fc0e8',
                    'layers-theme-secondary-color' => '#003668',
                    'layers-theme-mobile-menu-bg-color' => '#00284c',
                    'layers-theme-mobile-submenu-bg-color' => '#042240',
                    'layers-slider-btn-bg' => '#4fc0e8',
                    'layers-slider-btn-bg-hover' => '#003668',
                    'layers-slider-btn-text' => '#003668',
                    'layers-slider-btn-text-hover' => '#ffffff',
                    'layers-form-btn-bg' => '#4fc0e8',
                    'layers-form-btn-bg-hover' => '#003668',
                    'layers-form-btn-text' => '#003668',
                    'layers-form-btn-text-hover' => '#ffffff',
                    'layers-comment_avatar_color' => '#003368',
                    'layers-header-background-color' => '',
                    'layers-site-accent-color' => '',
                    'layers-footer-background-color' => '',
                ),
                // Light Red / Dark Blue
                'lrdb' => array(
                    'layers-theme-primary-color' => '#d63767',
                    'layers-theme-secondary-color' => '#061d2f',
                    'layers-theme-mobile-menu-bg-color' => '#021526',
                    'layers-theme-mobile-submenu-bg-color' => '#011523',
                    'layers-slider-btn-bg' => '#d63767',
                    'layers-slider-btn-bg-hover' => '#061d2f',
                    'layers-slider-btn-text' => '#ffffff',
                    'layers-slider-btn-text-hover' => '#ffffff',
                    'layers-form-btn-bg' => '#d63767',
                    'layers-form-btn-bg-hover' => '#061d2f',
                    'layers-form-btn-text' => '#ffffff',
                    'layers-form-btn-text-hover' => '#ffffff',
                    'layers-comment_avatar_color' => '#d63767',
                    'layers-header-background-color' => '',
                    'layers-site-accent-color' => '',
                    'layers-footer-background-color' => '',
                ),
                // Light Blue / Dark Grey
                'lbdg' => array(
                    'layers-theme-primary-color' => '#4fc0e8',
                    'layers-theme-secondary-color' => '#222527',
                    'layers-theme-mobile-menu-bg-color' => '#1d2021',
                    'layers-theme-mobile-submenu-bg-color' => '#1b1d1e',
                    'layers-slider-btn-bg' => '#4fc0e8',
                    'layers-slider-btn-bg-hover' => '#222527',
                    'layers-slider-btn-text' => '#ffffff',
                    'layers-slider-btn-text-hover' => '#ffffff',
                    'layers-form-btn-bg' => '#4fc0e8',
                    'layers-form-btn-bg-hover' => '#222527',
                    'layers-form-btn-text' => '#ffffff',
                    'layers-form-btn-text-hover' => '#ffffff',
                    'layers-comment_avatar_color' => '#4fc0e8',
                    'layers-header-background-color' => '',
                    'layers-site-accent-color' => '',
                    'layers-footer-background-color' => '',
                ),
                // Golder / Dark Grey
                'gdg' => array(
                    'layers-theme-primary-color' => '#c7a156',
                    'layers-theme-secondary-color' => '#2c3138',
                    'layers-theme-mobile-menu-bg-color' => '#1c2126',
                    'layers-theme-mobile-submenu-bg-color' => '#1c2126',
                    'layers-slider-btn-bg' => '#c7a156',
                    'layers-slider-btn-bg-hover' => '#2c3138',
                    'layers-slider-btn-text' => '#ffffff',
                    'layers-slider-btn-text-hover' => '#ffffff',
                    'layers-form-btn-bg' => '#c7a156',
                    'layers-form-btn-bg-hover' => '#2c3138',
                    'layers-form-btn-text' => '#ffffff',
                    'layers-form-btn-text-hover' => '#ffffff',
                    'layers-comment_avatar_color' => '#c7a156',
                    'layers-header-background-color' => '',
                    'layers-site-accent-color' => '',
                    'layers-footer-background-color' => '',
                ),
                // Green / Purple
                'gp' => array(
                    'layers-theme-primary-color' => '#b2bb49',
                    'layers-theme-secondary-color' => '#6a5f85',
                    'layers-theme-mobile-menu-bg-color' => '#5b5377',
                    'layers-theme-mobile-submenu-bg-color' => '#5e5577',
                    'layers-slider-btn-bg' => '#b2bb49',
                    'layers-slider-btn-bg-hover' => '#6a5f85',
                    'layers-slider-btn-text' => '#ffffff',
                    'layers-slider-btn-text-hover' => '#ffffff',
                    'layers-form-btn-bg' => '#b2bb49',
                    'layers-form-btn-bg-hover' => '#6a5f85',
                    'layers-form-btn-text' => '#ffffff',
                    'layers-form-btn-text-hover' => '#ffffff',
                    'layers-comment_avatar_color' => '#b2bb49',
                    'layers-header-background-color' => '',
                    'layers-site-accent-color' => '',
                    'layers-footer-background-color' => '',
                ),
                // Dark Purple
                'dp' => array(
                    'layers-theme-primary-color' => '#daad00',
                    'layers-theme-secondary-color' => '#252432',
                    'layers-theme-mobile-menu-bg-color' => '#1a1a26',
                    'layers-theme-mobile-submenu-bg-color' => '#272727',
                    'layers-slider-btn-bg' => '#252432',
                    'layers-slider-btn-bg-hover' => '#daad00',
                    'layers-slider-btn-text' => '#ffffff',
                    'layers-slider-btn-text-hover' => '#ffffff',
                    'layers-form-btn-bg' => '#252432',
                    'layers-form-btn-bg-hover' => '#181823',
                    'layers-form-btn-text' => '#ffffff',
                    'layers-form-btn-text-hover' => '#ffffff',
                    'layers-comment_avatar_color' => '#daad00',
                    'layers-header-background-color' => '',
                    'layers-site-accent-color' => '',
                    'layers-footer-background-color' => '',
                ),
                // Light Green - Dark Grey
                'lgdg' => array(
                    'layers-theme-primary-color' => '#28b491',
                    'layers-theme-secondary-color' => '#222527',
                    'layers-theme-mobile-menu-bg-color' => '#1b1d1e',
                    'layers-theme-mobile-submenu-bg-color' => '#222527',
                    'layers-slider-btn-bg' => '#28b491',
                    'layers-slider-btn-bg-hover' => '#222527',
                    'layers-slider-btn-text' => '#ffffff',
                    'layers-slider-btn-text-hover' => '#ffffff',
                    'layers-form-btn-bg' => '#28b491',
                    'layers-form-btn-bg-hover' => '#222527',
                    'layers-form-btn-text' => '#ffffff',
                    'layers-form-btn-text-hover' => '#ffffff',
                    'layers-comment_avatar_color' => '#28b491',
                    'layers-header-background-color' => '',
                    'layers-site-accent-color' => '',
                    'layers-footer-background-color' => '',
                ),

                // Orange - Dark Grey
                'odg' => array(
                    'layers-theme-primary-color' => '#f57a20',
                    'layers-theme-secondary-color' => '#222527',
                    'layers-theme-mobile-menu-bg-color' => '#1d2021',
                    'layers-theme-mobile-submenu-bg-color' => '#1b1d1e',
                    'layers-slider-btn-bg' => '#f57a20',
                    'layers-slider-btn-bg-hover' => '#222527',
                    'layers-slider-btn-text' => '#ffffff',
                    'layers-slider-btn-text-hover' => '#ffffff',
                    'layers-form-btn-bg' => '#f57a20',
                    'layers-form-btn-bg-hover' => '#222527',
                    'layers-form-btn-text' => '#ffffff',
                    'layers-form-btn-text-hover' => '#ffffff',
                    'layers-comment_avatar_color' => '#f57a20',
                    'layers-header-background-color' => '',
                    'layers-site-accent-color' => '',
                    'layers-footer-background-color' => '',
                ),
            );
        }
    } // Class
}

<?php
/**
 * Flat Skin Class
 *
 * @package Total WordPress Theme
 * @subpackage Skins
 * @deprecated Since 3.0.0
 */

if ( ! class_exists( 'Total_Flat_Skin' ) ) {

    class Total_Flat_Skin {

        /**
         * Main constructor
         *
         * @since 1.3.0
         */
        public function __construct() {

            // Load skin CSS
            add_action( 'wp_enqueue_scripts', array( $this, 'load_styles' ), 999 );

            // Tweak accent colors
            add_filter( 'wpex_accent_texts', array( $this, 'accent_texts' ), 20 );
            add_filter( 'wpex_accent_backgrounds', array( $this, 'accent_backgrounds' ), 20 );
            add_filter( 'wpex_accent_borders', array( $this, 'accent_borders' ), 20 );

        }

       /**
         * Load custom stylesheet for this skin
         *
         * @since 1.3.0
         */
        public function load_styles() {
            wp_enqueue_style( 'wpex-flat-skin', WPEX_SKIN_DIR_URI .'classes/flat/css/flat-style.css', array( 'wpex-style' ), '1.0', 'all' );
        }

        /**
         * Adds text accents for this skin
         *
         * @since 2.1.0
         */
        public function accent_texts( $texts ) {

            // Combine array so we can remove some items
            $texts = array_combine( $texts, $texts );

            // Remove items
            $remove = array(
                '.woocommerce ul.products li.product h3',
                '.navbar-style-two .dropdown-menu > .current-menu-item > a',
                '.navbar-style-two .dropdown-menu ul a:hover',
                '.navbar-style-three .dropdown-menu > .current-menu-item > a',
                '.navbar-style-four .dropdown-menu > .current-menu-item > a',
                '.navbar-style-four .dropdown-menu a:hover',
                '.navbar-style-four .dropdown-menu ul a:hover',
            );

            // Remove items
            foreach ( $remove as $key => $val ) {
                if ( isset( $texts[$val] ) ) {
                    unset( $texts[$val] );
                }
            }

            // Add new ones
            $new = array(
                '#sidr-main a:hover',
                '#footer a',
                '#footer li a:before',
                '.woocommerce ul.products li.product h3:hover',
                '.woocommerce ul.products li.product h3 mark:hover',
                '#top-bar a:hover',
                '#sidebar .modern-menu-widget a:hover',
                '.navbar-style-one .dropdown-menu > li.sfHover > a',
                '.navbar-style-one .dropdown-menu > li > a:hover',
                '.navbar-style-one .dropdown-menu > .current-menu-item > a',
                '.navbar-style-one .dropdown-menu > .current-menu-parent > a',
            );

            // Merge old and new
            $texts = array_merge( $new, $texts );

            // Return texts
            return $texts;

        }

        /**
         * Adds background accents for this skin
         *
         * @since 2.1.0
         */
        public function accent_backgrounds( $backgrounds ) {

            // Add new elements to apply the accent to
            $new = array(
                '.staff-social a:hover',
                '#mobile-menu a',
                '#mobile-menu a:hover',
                '.vcex-filter-links a:hover',
                '.vcex-filter-links li.active a',
                '.vcex-navbar.style-buttons a:hover',
                '.vcex-navbar.style-buttons a.active',
                '.page-numbers a:hover',
                '.page-numbers.current',
                '.page-numbers.current:hover',
                '.navbar-style-two',
                '.navbar-style-three',
                '.navbar-style-four',
                '.is-sticky .fixed-nav',
                'body #header-two-search #header-two-search-submit',
            );

            // Merge old and new
            $backgrounds = array_merge( $new, $backgrounds );

            // Return backgrounds accent elements
            return $backgrounds;

        }

        /**
         * Adds borders accents for this skin
         *
         * @since 2.1.0
         */
        public function accent_borders( $borders ) {
            $new = array( );
            $borders = array_merge( $new, $borders );
            return $borders;
        }

    }
    
}
$wpex_flat_skin = new Total_Flat_Skin();
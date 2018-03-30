<?php
/**
 * Agent Skin Class
 *
 * @package Total WordPress Theme
 * @subpackage Skins
 * @deprecated Since 3.0.0
 */

if ( ! class_exists( 'Total_Agent_Skin' ) ) {
    
    class Total_Agent_Skin {

        /**
         * Main constructor.
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
         * Load custom stylesheet for this skin.
         *
         * @since 1.3.0
         */
        public function load_styles() {
            wp_enqueue_style( 'wpex-agent-skin', WPEX_SKIN_DIR_URI .'classes/agent/css/agent-style.css', array( 'wpex-style' ), '1.0', 'all' );
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
                '.woocommerce ul.products li.product h3:hover',
                '.woocommerce ul.products li.product h3 mark:hover',
                '#top-bar a:hover',
                '#sidebar .modern-menu-widget a:hover',
            );
            $texts = array_merge( $new, $texts );
            return $texts;
        }

        /**
         * Adds background accents for this skin
         *
         * @since 2.1.0
         */
        public function accent_backgrounds( $backgrounds ) {
            $new = array(
            	'.navbar-style-one .dropdown-menu ul li a:hover',
            	'.staff-social a:hover',
				'.vcex-filter-links a:hover',
                '.vcex-filter-links li.active a',
            );
            $backgrounds = array_merge( $new, $backgrounds );
            return $backgrounds;
        }

        /**
         * Adds borders accents for this skin
         *
         * @since 2.1.0
         */
        public function accent_borders( $borders ) {
            $new = array(
                '.toggle-bar-btn' => array( 'top', 'right' ),
            );
            $borders = array_merge( $new, $borders );
            return $borders;
        }

    }

}
$wpex_agent_skin = new Total_Agent_Skin();
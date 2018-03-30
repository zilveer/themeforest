<?php

/**
 * Redux Framework is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Redux Framework is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Redux Framework. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package     ReduxFramework
 * @author      Dovy Paukstys (dovy)
 * @version     3.0.0
 */

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;

// Don't duplicate me!
if( !class_exists( 'ReduxFramework_extension_post_type_ajax' ) ) {


    /**
     * Main ReduxFramework post_type_ajax extension class
     *
     * @since       3.1.6
     */
    class ReduxFramework_extension_post_type_ajax extends ReduxFramework {

        // Protected vars
        protected $parent;
        public $extension_url;
        public $extension_dir;
        public static $theInstance;

        /**
        * Class Constructor. Defines the args for the extions class
        *
        * @since       1.0.0
        * @access      public
        * @param       array $sections Panel sections.
        * @param       array $args Class constructor arguments.
        * @param       array $extra_tabs Extra panel tabs.
        * @return      void
        */
        public function __construct( $parent ) {
            
            $this->parent = $parent;
            if ( empty( $this->extension_dir ) ) {
                $this->extension_dir = trailingslashit( str_replace( '\\', '/', dirname( __FILE__ ) ) );
            }
            $this->field_name = 'post_type_ajax';

            self::$theInstance = $this;

            add_filter( 'redux/'.$this->parent->args['opt_name'].'/field/class/'.$this->field_name, array( &$this, 'overload_field_path' ) ); // Adds the local field
            add_action('wp_ajax_post_type_ajax_ac', array( &$this, 'post_type_ajax_action' ));

        }

        public function getInstance() {
            return self::$theInstance;
        }

        // Forces the use of the embeded field path vs what the core typically would use    
        public function overload_field_path($field) {      
            return dirname(__FILE__).'/'.$this->field_name.'/field_'.$this->field_name.'.php';
        }

        public function post_type_ajax_action(){
            $post_type = $_GET['post_type'];
            $q = $_GET['q'];
            $additional = !empty( $_GET['additional'] ) ? $_GET['additional'] : array();
            $args = array(
                'post_type' => $post_type,
                'posts_per_page' => '-1',
                'post_status' => 'publish',
                's' => $q
            );
            $args = $args + $additional;
            $posts = get_posts( $args );
            $posts_array = array();
            if( !empty( $posts ) ){
                foreach( $posts as $post ){
                    $posts_array[] = array(
                        'id' => $post->ID,
                        'text' => htmlspecialchars_decode($post->post_title),
                    );
                }
            }
            echo json_encode( $posts_array );
            die();
        }        

    } // class
} // if

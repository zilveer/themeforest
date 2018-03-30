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
 * @author      Dovy Paukstys
 * @version     3.1.5
 */
// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;


// Don't duplicate me!
if( !class_exists( 'ReduxFramework_dummy_content' ) ) {

    /**
     * Main ReduxFramework_dummy_content class
     *
     * @since       1.0.0
     */
    class ReduxFramework_dummy_content extends ReduxFramework {
    
        /**
         * Field Constructor.
         *
         * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        function __construct( $field = array(), $value ='', $parent ) {
            
            $this->parent = $parent;
            $this->field = $field;
            $this->value = $value;

            if ( empty( $this->extension_dir ) ) {
                $this->extension_dir = trailingslashit( str_replace( '\\', '/', dirname( __FILE__ ) ) );
                $this->extension_url = site_url( str_replace( trailingslashit( str_replace( '\\', '/', ABSPATH ) ), '', $this->extension_dir ) );
            }    

            // Set default args for this field to avoid bad indexes. Change this to anything you use.
            $defaults = array(
                'options'           => array(),
                'stylesheet'        => '',
                'output'            => true,
                'enqueue'           => true,
                'enqueue_frontend'  => true
            );
            $this->field = wp_parse_args( $this->field, $defaults );            
        
        }

        /**
         * Field Render Function.
         *
         * Takes the vars and outputs the HTML for the field in the settings
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        public function render() {
        
            // HTML output goes here

            $demo_data_installed = get_option('demo_data_installed');

            define('ETHEME_THEME', 'theme/');
            define('ETHEME_BASE_URI', get_template_directory_uri() .'/');

            $versions_preview = 'http://8theme.com/demo/classico/';

            $versions = array(
                'variant1' => array(
                        'name' => 'Victoria',
                        'pageid' => 3411
                    ),
                    'variant2' => array(
                        'name' => 'Julia',
                        'pageid' => 180
                    ),
                    'variant3' => array(
                        'name' => 'Margaret',
                        'pageid' => 116
                    ),
                    'variant4' => array(
                        'name' => 'Maria',
                        'pageid' => 159
                    ),
                    'variant6' => array(
                        'name' => 'Helen',
                        'pageid' => 143
                    ),
                    'variant7' => array(
                        'name' => 'Felicia',
                        'pageid' => 155
                    ),
                    'variant8' => array(
                        'name' => 'Florence',
                        'pageid' => 133
                    ),
                    'variant9' => array(
                        'name' => 'Eleonora',
                        'pageid' => 101
                    ),
                    'variant11' => array(
                        'name' => 'Lucia',
                        'pageid' => 175
                    ),
                    'variant13' => array(
                        'name' => 'Rose',
                        'pageid' => 165
                    ),
                    'variant14' => array(
                        'name' => 'Linda',
                        'pageid' => 183
                    ),
                    'variant15' => array(
                        'name' => 'Eva',
                        'pageid' => 97
                    ),
            );

			echo '</td></tr></table>';

            ?>

			<div class="et-import-section">

				<div class="et-instal-base">

					<h3><?php esc_html_e( 'Import base dummy content', ET_DOMAIN); ?> </h3>

					<?php if( $demo_data_installed != 'yes' ) : ?>

						<button class="install_dummy button button-primary" data-version="base" data-pageid="0" data-name="base"><?php _e('Install Base Demo Content' , ET_DOMAIN ); ?></button>
						<p><?php _e('<strong>Note:</strong> We recommend to install base demo content first', ET_DOMAIN ) ?></p>
					
					<?php else : ?>

						<p><?php _e('<strong>Note:</strong> You have already installed demo content.', ET_DOMAIN ) ?></p>

					<?php endif; ?>

				</div>

				<div class="et-instal-demo">

					<h3><?php esc_html_e( 'Import demo versions', ET_DOMAIN ); ?></h3>
					<div class="import-demos">

						<?php foreach ($versions as $key => $version): ?>

						<div class="demo-version version-<?php echo $key; ?>">

							<img src="<?php echo ETHEME_BASE_URI . 'theme/assets/images/versions/' . $key . '.jpg'; ?>" alt="<?php echo $key; ?>">

							<a href="<?php echo $versions_preview . $key; ?>" target="_blank"><?php esc_html_e('Live prview', ET_DOMAIN ); ?></a>

							<button class="install_dummy button button-primary" data-version="<?php echo $key;?>" data-pageid="<?php echo $version['pageid'];?>" data-name="<?php echo $version['name'];?>" ><?php _e('import version' , ET_DOMAIN ); ?></button>

							<h5><?php echo esc_html( $version['name'] ); ?></h5>

						</div>

						<?php endforeach ?>
					
					</div>
				
				</div>
			
			</div><!-- End .et-import-section-->    
        <?php

        }
    
        /**
         * Enqueue Function.
         *
         * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        public function enqueue() {

           // $extension = ReduxFramework_extension_dummy_content::getInstance();
        
            wp_enqueue_script(
                'redux-field-dummy-content-js', 
                $this->extension_url . 'field_dummy_content.js', 
                array( 'jquery' ),
                time(),
                true
            );

            wp_enqueue_style(
                'redux-field-dummy-content-css', 
                $this->extension_url . 'field_dummy_content.css',
                time(),
                true
            );
        
        }
        
        /**
         * Output Function.
         *
         * Used to enqueue to the front-end
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */        
        public function output() {

            if ( $this->field['enqueue_frontend'] ) {

            }
            
        }        
        
    }
}

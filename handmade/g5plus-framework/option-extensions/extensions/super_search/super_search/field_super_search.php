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
if( !class_exists( 'ReduxFramework_super_search' ) ) {

    /**
     * Main ReduxFramework_super_search class
     *
     * @since       1.0.0
     */
    class ReduxFramework_super_search extends ReduxFramework {
    
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
                $this->extension_dir = trailingslashit( str_replace( '\\', '/', THEME_DIR . 'g5plus-framework/option-extensions/extensions/super_search/super_search/' ) );
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
   
       public function render () {

            $defaults = array(
                'show' => array(
                    'title' => true,
                    'description' => true,
                    'url' => true,
                ),
                'content_title' => __ ( 'Filter', 'redux-framework' )
            );

            $this->field = wp_parse_args ( $this->field, $defaults );

            echo '<div class="redux-supersearch-accordion" data-new-content-title="' . esc_attr ( sprintf ( __ ( 'New %s', 'redux-framework' ), $this->field[ 'content_title' ] ) ) . '">';

            $x = 0;

            $multi = ( isset ( $this->field[ 'multi' ] ) && $this->field[ 'multi' ] ) ? ' multiple="multiple"' : "";

            if ( isset ( $this->value ) && is_array ( $this->value ) && !empty ( $this->value ) ) {

                $slides = $this->value;

                foreach ( $slides as $slide ) {

                    if ( empty ( $slide ) ) {
                        continue;
                    }
			
					$defaults = array(
                        'beforetext' => '',
                        'ss-filter' => '',
                        'label' => '',
                        'aftertext' => '',
                    );
                    $slide = wp_parse_args ( $slide, $defaults );

                    echo '<div class="redux-supersearch-accordion-group"><fieldset class="redux-field" data-id="' . $this->field[ 'id' ] . '"><h3><span class="redux-supersearch-header">' . $slide[ 'beforetext' ] . '</span></h3><div>';

                    echo '<div class="redux_slides_add_remove">';

                  	echo '<ul id="' . $this->field[ 'id' ] . '-ul" class="redux-slides-list">';

                    //BEFORE TEXT
					$placeholder = ( isset ( $this->field[ 'placeholder' ][ 'beforetext' ] ) ) ? esc_attr ( $this->field[ 'placeholder' ][ 'beforetext' ] ) : __ ( 'Before Text', 'redux-framework' );
                    echo '<li><input type="text" id="' . $this->field[ 'id' ] . '-before_text_' . $x . '" name="' . $this->field[ 'name' ] . '[' . $x . '][beforetext]' . $this->field['name_suffix'] . '" value="' . esc_attr ( $slide[ 'beforetext' ] ) . '" placeholder="' . $placeholder . '" class="full-text slide-title" /></li>';

              		$filter_array = sf_get_woo_product_filters_array();
					
              		//FILTER 
			        $placeholder = ( isset ( $this->field[ 'placeholder' ][ 'ss-filter' ] ) ) ? esc_attr ( $this->field[ 'placeholder' ][ 'ss-filter' ] ) : __ ( 'Filter', 'redux-framework' );
              			
                    echo '<li><select  id="' . $this->field[ 'id' ] . '-filter_' . $x . '" name="' . $this->field[ 'name' ] . '[' . $x . '][ss-filter]' . $this->field['name_suffix'] .'" value="' . esc_attr ( $slide[ 'ss-filter' ] ) . '" class="ss-select full-text" placeholder="' . $placeholder . '" />';
					
					echo '<option value="">'.__ ( 'Choose an option', 'redux-framework' ).'</option>';
										
					foreach ($filter_array as $filter => $filter_text) {
						
						if ($filter ==  $slide[ 'ss-filter' ]) {
							echo '<option value="'.$filter.'" selected>'.$filter_text.'</option>';
						}
						else{
							echo '<option value="'.$filter.'" >'.$filter_text.'</option>';
						}
					}
										
					echo '</select></li>';
					
					//LABEL
			        $placeholder = ( isset ( $this->field[ 'placeholder' ][ 'label' ] ) ) ? esc_attr ( $this->field[ 'placeholder' ][ 'label' ] ) : __ ( 'Label', 'redux-framework' );
              			
                    echo '<li><input type="text" id="' . $this->field[ 'id' ] . '-label_' . $x . '" name="' . $this->field[ 'name' ] . '[' . $x . '][label]' . $this->field['name_suffix'] .'" value="' . esc_attr ( $slide[ 'label' ] ) . '" class="full-text" placeholder="' . $placeholder . '" /></li>';
					
					//AFTER TEXT
			        $placeholder = ( isset ( $this->field[ 'placeholder' ][ 'aftertext' ] ) ) ? esc_attr ( $this->field[ 'placeholder' ][ 'aftertext' ] ) : __ ( 'After Text', 'redux-framework' );
              			
                    echo '<li><input type="text" id="' . $this->field[ 'id' ] . '-after_text_' . $x . '" name="' . $this->field[ 'name' ] . '[' . $x . '][aftertext]' . $this->field['name_suffix'] .'" value="' . esc_attr ( $slide[ 'aftertext' ] ) . '" class="full-text" placeholder="' . $placeholder . '" /></li>';
					
                    echo '<li><input type="hidden" class="slide-sort" name="' . $this->field[ 'name' ] . '[' . $x . '][sort]' . $this->field['name_suffix'] .'" id="' . $this->field[ 'id' ] . '-sort_' . $x . '" value="' . $slide[ 'sort' ] . '" />';


                    echo '<li><a href="javascript:void(0);" class="button deletion redux-supersearch-remove">' . sprintf ( __ ( 'Delete %s', 'redux-framework' ), $this->field[ 'content_title' ] ) . '</a></li>';
                    echo '</ul></div></fieldset></div>';
                    $x ++;
                }
            }

            if ( $x == 0 ) {
                echo '<div class="redux-supersearch-accordion-group"><fieldset class="redux-field" data-id="' . $this->field[ 'id' ] . '"><h3><span class="redux-supersearch-header">New ' . $this->field[ 'content_title' ] . '</span></h3><div>';

                $hide = ' hide';

                echo '<div class="screenshot' . $hide . '">';
                echo '<a class="of-uploaded-image" href="">';
                echo '<img class="redux-supersearch-image" id="image_image_id_' . $x . '" src="" alt="" target="_blank" rel="external" />';
                echo '</a>';
                echo '</div>';

                echo '<ul id="' . $this->field[ 'id' ] . '-ul" class="redux-supersearch-list">';
              
                $placeholder = ( isset ( $this->field[ 'placeholder' ][ 'beforetext' ] ) ) ? esc_attr ( $this->field[ 'placeholder' ][ 'beforetext' ] ) : __ ( 'Before Text', 'redux-framework' );
                echo '<li><input type="text" id="' . $this->field[ 'id' ] . '-before_text_' . $x . '" name="' . $this->field[ 'name' ] . '[' . $x . '][beforetext]' . $this->field['name_suffix'] .'" value="" placeholder="' . $placeholder . '" class="full-text slide-title" /></li>';

                /*   Filter Field	*/
				$placeholder = ( isset ( $this->field[ 'placeholder' ][ 'ss-filter' ] ) ) ? esc_attr ( $this->field[ 'placeholder' ][ 'ss-filter' ] ) : __ ( 'Filter', 'redux-framework' );
				echo '<li><select id="' . $this->field[ 'id' ] . '-filter_' . $x . '" name="' . $this->field[ 'name' ] . '[' . $x . '][ss-filter]' . $this->field['name_suffix'] .'" value=""  class="ss-select full-text" placeholder="' . $placeholder . '" />';
				
				
				$filter_array = sf_get_woo_product_filters_array();
					
				echo '<option value="">'.__ ( 'Choose an option', 'redux-framework' ).'</option>';
				
				foreach ($filter_array as $filter => $filter_text) {
					if ($filter ==  $slide[ 'ss-filter' ]) {
						echo '<option value="'.$filter.'" selected>'.$filter_text.'</option>';
					}
					else{
						echo '<option value="'.$filter.'" >'.$filter_text.'</option>';
					}
				}
										
				echo '</select></li>';
				
			/* Label Field */
				$placeholder = ( isset ( $this->field[ 'placeholder' ][ 'label' ] ) ) ? esc_attr ( $this->field[ 'placeholder' ][ 'label' ] ) : __ ( 'Label', 'redux-framework' );
				echo '<li><input type="text" id="' . $this->field[ 'id' ] . '-label_' . $x . '" name="' . $this->field[ 'name' ] . '[' . $x . '][label]' . $this->field['name_suffix'] .'" value="" class="full-text" placeholder="' . $placeholder . '" /></li>';

				
				/*   After Text Field */
				$placeholder = ( isset ( $this->field[ 'placeholder' ][ 'after' ] ) ) ? esc_attr ( $this->field[ 'placeholder' ][ 'after' ] ) : __ ( 'After Text', 'redux-framework' );
				echo '<li><input type="text" id="' . $this->field[ 'id' ] . '-after_text_' . $x . '" name="' . $this->field[ 'name' ] . '[' . $x . '][aftertext]' . $this->field['name_suffix'] .'" value="" class="full-text" placeholder="' . $placeholder . '" /></li>';				
                echo '</ul></div></fieldset></div>';
            }
            echo '</div><a href="javascript:void(0);" class="button redux-supersearch-add button-primary" rel-id="' . $this->field[ 'id' ] . '-ul" rel-name="' . $this->field[ 'name' ] . '[title][]' . $this->field['name_suffix'] .'">' . sprintf ( __ ( 'Add %s', 'redux-framework' ), $this->field[ 'content_title' ] ) . '</a><br/>';
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
        
		
		   public function enqueue () {


            wp_enqueue_script(
                'redux-field-media-js',
                ReduxFramework::$_url . 'assets/js/media/media' . Redux_Functions::isMin() . '.js',
                array( 'jquery', 'redux-js' ),
                time(),
                true
            );

            wp_enqueue_style (
                'redux-field-media-css', 
                ReduxFramework::$_url . 'inc/fields/media/field_media.css', 
                time (), 
                true
            );

            wp_enqueue_script (
                'redux-field-super-search-js', 
                $this->extension_url . 'field_super_search.js',  
                array( 'jquery', 'jquery-ui-core', 'jquery-ui-accordion', 'wp-color-picker', 'redux-field-media-js' ), 
                time (), 
                true
            );
			
            wp_enqueue_style (
                'redux-field-super-search-css', 
                $this->extension_url . 'field_super_search.css',  
                time (), 
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

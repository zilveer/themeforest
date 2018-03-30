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
if( !class_exists( 'ReduxFramework_button' ) ) {

	/**
	 * Main ReduxFramework_custom_field class
	 *
	 * @since       1.0.0
	 */
	class ReduxFramework_button extends ReduxFramework {
	
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

			if(isset($this->value['id']) && $this->value['id'] != '') {
				$this->guid = $this->value['id'];
			}

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
				'enqueue_frontend'  => true,
				'style'				=> '',
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

			if(!isset($this->value['style'])) {
				$this->value['style'] = 'btn-primary';
			}
			if(!isset($this->value['size'])) {
				$this->value['size'] = 'btn-sm';
			}			
			if(!isset($this->value['arrow'])) {
				$this->value['arrow'] = 'off';
			}
			if(!isset($this->value['text-color'])) {
				$this->value['text-color'] = '#fff';
			}
			if(!isset($this->value['background-color'])) {
				$this->value['background-color'] = '#fff';
			}
			if(!isset($this->value['border-color'])) {
				$this->value['border-color'] = '#fff';
			}
			if(!isset($this->value['text-hover-color'])) {
				$this->value['text-hover-color'] = '#fff';
			}
			if(!isset($this->value['background-hover-color'])) {
				$this->value['background-hover-color'] = '#fff';
			}
			if(!isset($this->value['border-hover-color'])) {
				$this->value['border-hover-color'] = '#fff';
			}

			// print_r($this->value);
			// HTML output goes here
			// if($this->value['style'] == 'custom') {
				
			if(!isset($this->guid) || $this->guid == '' ) {
				$this->guid = uniqid();
			}
			// } else {
				// $this->guid = '';
			// }
			?>
				<input type="hidden" value="<?php echo $this->guid; ?>" data-generated-id="<?php echo $this->guid; ?>" <?php echo 'data-id="' . $this->field['id'] . '" name="' . $this->field['name'] . $this->field['name_suffix'] . '[id]" id="' . $this->field['id'] . '-id"'; ?> />
				<select <?php echo 'data-id="' . $this->field['id'] . '" name="' . $this->field['name'] . $this->field['name_suffix'] . '[style]" id="' . $this->field['id'] . '-button-style"'; ?> class="button-field-style" >
					<option value="none" <?php selected( $this->value['style'], 'btn-primary' ); ?>>None</option>
					<option value="btn-primary" <?php selected( $this->value['style'], 'btn-primary' ); ?>>Primary full button</option>
					<option value="btn-primary-o" <?php selected( $this->value['style'], 'btn-primary-o' ); ?>>Primary ghost button</option>
					<option value="btn-primary-t" <?php selected( $this->value['style'], 'btn-primary-t' ); ?>>Primary text button</option>
					<option value="btn-color" <?php selected( $this->value['style'], 'btn-color' ); ?>>Highlight full button</option>
					<option value="btn-color-o" <?php selected( $this->value['style'], 'btn-color-o' ); ?>>Highlight ghost button</option>
					<option value="btn-color-t" <?php selected( $this->value['style'], 'btn-color-t' ); ?>>Highlight text button</option>
					<option value="custom" <?php selected( $this->value['style'], 'custom' ); ?>>Custom button</option>
				</select>
				<select <?php echo 'data-id="' . $this->field['id'] . '" name="' . $this->field['name'] . $this->field['name_suffix'] . '[size]" id="' . $this->field['id'] . '-button-size"'; ?> class="button-field-size" >
					<option value="btn-xs" <?php selected( $this->value['size'], 'btn-xs' ); ?>>Extra small</option>
					<option value="btn-sm" <?php selected( $this->value['size'], 'btn-sm' ); ?>>Small</option>
					<option value="btn-md" <?php selected( $this->value['size'], 'btn-md' ); ?>>Medium</option>
					<option value="btn-lg" <?php selected( $this->value['size'], 'btn-lg' ); ?>>Large</option>
				</select>
				
				<input type="hidden" value="off" class="hidden" <?php echo 'data-id="' . $this->field['id'] . '[arrow]" name="' . $this->field['name'] . $this->field['name_suffix'] . '[arrow]" id="' . $this->field['id'] . '-button-arrow"'; ?> ></input>
				<label for="<?php echo $this->field['id'] . '-arrow'?>"><input type="checkbox" id="<?php echo $this->field['id'] . '-arrow';?>" <?php checked( $this->value['arrow'], 'on' ); ?> <?php echo 'data-id="' . $this->field['id'] . '[arrow]" name="' . $this->field['name'] . $this->field['name_suffix'] . '[arrow]" id="' . $this->field['id'] . '-button-arrow"'; ?> ></input> Show arrow on hover</label>
			<?php
			$default = '#fff';
			echo '<div class="button-field-custom" style="display:none">';
			echo '<div class="button-field-base">';
			echo '<div class="pull-left"><small>Text </small><br/><input name="' . $this->field['name'] . $this->field['name_suffix'] . '[text-color]" id="' . $this->field['id'] . '-border" class="redux-button-color redux-color redux-color-init ' . $this->field['class'] . '"  type="text" value="' . $this->value['text-color'] . '"  data-default-color="' . $default . '" data-id="' . $this->field['id'] . '" /></div>';
			echo '<div class="pull-left"><small>Background </small><br/><input name="' . $this->field['name'] . $this->field['name_suffix'] . '[background-color]" id="' . $this->field['id'] . '-border" class="redux-button-color redux-color redux-color-init ' . $this->field['class'] . '"  type="text" value="' . $this->value['background-color'] . '"  data-default-color="' . $default . '" data-id="' . $this->field['id'] . '" /></div>';
			echo '<div class="pull-left"><small>Border </small><br/><input name="' . $this->field['name'] . $this->field['name_suffix'] . '[border-color]" id="' . $this->field['id'] . '-border" class="redux-button-color redux-color redux-color-init ' . $this->field['class'] . '"  type="text" value="' . $this->value['border-color'] . '"  data-default-color="' . $default . '" data-id="' . $this->field['id'] . '" /></div>';
			echo '</div><div class="button-field-hover clear">';
			echo '<div class="pull-left"><small>Hover text</small><br/><input name="' . $this->field['name'] . $this->field['name_suffix'] . '[text-hover-color]" id="' . $this->field['id'] . '-border" class="redux-button-color redux-color redux-color-init ' . $this->field['class'] . '"  type="text" value="' . $this->value['text-hover-color'] . '"  data-default-color="' . $default . '" data-id="' . $this->field['id'] . '" /></div>';
			echo '<div class="pull-left"><small>Hover background</small><br/><input name="' . $this->field['name'] . $this->field['name_suffix'] . '[background-hover-color]" id="' . $this->field['id'] . '-border" class="redux-button-color redux-color redux-color-init ' . $this->field['class'] . '"  type="text" value="' . $this->value['background-hover-color'] . '"  data-default-color="' . $default . '" data-id="' . $this->field['id'] . '" /></div>';
			echo '<div class="pull-left"><small>Hover border</small><br/><input name="' . $this->field['name'] . $this->field['name_suffix'] . '[border-hover-color]" id="' . $this->field['id'] . '-border" class="redux-button-color redux-color redux-color-init ' . $this->field['class'] . '"  type="text" value="' . $this->value['border-hover-color'] . '"  data-default-color="' . $default . '" data-id="' . $this->field['id'] . '" /></div>';
			echo '</div></div>';
			?>
			<script type="text/javascript">
				jQuery(document).ready(function($) {
					$('#<?php echo $this->field['id']; ?>-button-style').change(function() {
						if ($(this).find('option:selected').val() === 'custom') {
							$(this).parent().find('.button-field-custom').css('display', 'block');

							$(this).parent().find('#<?php echo $this->field['id'];?>-id').val($(this).parent().find('#<?php echo $this->field['id'];?>-id').data('generatedId'));
						} else {
							$(this).parent().find('.button-field-custom').css('display', 'none');
							$(this).parent().find('#<?php echo $this->field['id'];?>-id').val($(this).parent().find('#<?php echo $this->field['id'];?>-id').data(''));
						}
					}).change();
				});
			</script>
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
			$extension = ReduxFramework_extension_button::getInstance();

            if ($this->parent->args['dev_mode']) {
                wp_enqueue_style( 'redux-color-picker-css' );
            }

            if (is_admin()) {
            	wp_enqueue_style('wp-color-picker');	
            }

            wp_enqueue_script(
                'redux-field-button-js',
                $this->extension_url . 'field_button'.Redux_Functions::isMin().'.js', 
                array( 'jquery', 'wp-color-picker', 'redux-js' ),
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
			if($this->value['style'] == 'custom') {
			$this->parent->outputCSS .= '.btn-'.$this->guid . ' { color: '.$this->value['text-color'].' !important; background-color: '.$this->value['background-color'].' !important; border-color: '.$this->value['border-color'].' !important; }';
			$this->parent->outputCSS .= '.btn-'.$this->guid . ' i { color: '.$this->value['text-color'].' !important;  }';
			$this->parent->outputCSS .= '.btn-'.$this->guid . ':hover { color: '.$this->value['text-hover-color'].' !important; background-color: '.$this->value['background-hover-color'].' !important; border-color: '.$this->value['border-hover-color'].' !important; }';
			$this->parent->outputCSS .= '.btn-'.$this->guid . ':hover i { color: '.$this->value['text-hover-color'].' !important }';			

			}
		}
	}
}

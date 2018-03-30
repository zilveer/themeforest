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
if( !class_exists( 'ReduxFramework_less_compile' ) ) {

	/**
	 * Main ReduxFramework_custom_field class
	 *
	 * @since       1.0.0
	 */
	class ReduxFramework_less_compile extends ReduxFramework {
	
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
			?>
			<button class="compile_less button button-primary"><?php echo __('Generate CSS', 'BERG') ?></button>
			<textarea id="less_container_id" name="less_container" class="hidden"></textarea>
			<script>
			jQuery(document).ready(function(){
				jQuery(".submit input").addClass("hidden");	
				// jQuery(".submit").append(jQuery(".compile_less"));
			})
			
			less = {
	    		env: "development",
			    logLevel: 0,
			    async: false,
			    fileAsync: false,
			    poll: 1000,
			    functions: {},
			    relativeUrls: false,
			    rootpath: "<?php echo THEME_DIR_URI; ?>/styles/less/",
			};	

			var less_compiler = false;
			jQuery("#redux-less_compile").on("change", "#less_container_id", function(){
				var data = {
					"action" : "save_custom_css",
					"css" : jQuery("#less_container_id").val()
				};
				jQuery.post(ajaxurl, data, function(response) {
					jQuery("#less_css_file_id").val(response.url);
					jQuery('.compile_less').html(jQuery('.compile_less').data('oldText'));	
					jQuery('#redux_ajax_overlay').hide(0);
				}, "json");
			})
			jQuery(".compile_less").click(function(e){
				e.preventDefault();

				jQuery('#redux_ajax_overlay').show(0);
				jQuery('#redux_save').click();
				jQuery('.compile_less').data('oldText', jQuery('.compile_less').text()).html('Please wait...');
				// if(less_compiler === false) {
				// 	jQuery.getScript("'.THEME_DIR_URI.'/admin/includes/js/less.min.js", function(){
				// 		less.modifyVars({
				// 			"@bgColor" : jQuery('input[name="yopress[berg_less_background_color_1]"]').val(),
				// 			"@bgColor2" : jQuery('input[name="yopress[berg_less_background_color_2]"]').val(),
				// 			"@bgColor3" : jQuery('input[name="yopress[berg_less_background_color_3]"]').val(),
				// 			"@textColor" : jQuery('input[name="yopress[berg_less_text_color_1]"]').val(),
				// 			"@textColor2" : jQuery('input[name="yopress[berg_less_text_color_2]"]').val(),
				// 			"@highlightColor" : jQuery('input[name="yopress[berg_less_highlight_color]"]').val(),
				// 			"@borderColor" : jQuery('input[name="yopress[berg_less_border_color]"]').val(),
				// 			"@headerBg" : jQuery('input[name="yopress[berg_less_header_background_1]"]').val(),
				// 			"@headerBg2" : jQuery('input[name="yopress[berg_less_header_background_2]"]').val(),
				// 			"@headerText" : jQuery('input[name="yopress[berg_less_header_text_1]"]').val(),
				// 			"@headerText2" : jQuery('input[name="yopress[berg_less_header_text_2]"]').val(),
				// 			"@headerActive" : jQuery('input[name="yopress[berg_less_header_active]"]').val(),
				// 			"@headerReorderActive" : jQuery('input[name="yopress[berg_less_header_reorder_active]"]').val(),
				// 			"@footerBg" : jQuery('input[name="yopress[berg_less_footer_background]"]').val(),
				// 			"@footerText" : jQuery('input[name="yopress[berg_less_footer_text]"]').val(),
				// 			"@footerLink" : jQuery('input[name="yopress[berg_less_footer_link]"]').val()
				// 		})
				// 	});
				// } else {
					setTimeout(function(){

					less.modifyVars({
						"@bgColor" : jQuery('input[name="redux[berg_less_background_color_1]"]').val(),
						"@bgColor2" : jQuery('input[name="redux[berg_less_background_color_2]"]').val(),
						"@bgColor3" : jQuery('input[name="redux[berg_less_background_color_3]"]').val(),
						"@textColor" : jQuery('input[name="redux[berg_less_text_color_1]"]').val(),
						"@textColor2" : jQuery('input[name="redux[berg_less_text_color_2]"]').val(),
						"@highlightColor" : jQuery('input[name="redux[berg_less_highlight_color]"]').val(),
						"@borderColor" : jQuery('input[name="redux[berg_less_border_color]"]').val(),
						"@headerBg" : jQuery('input[name="redux[berg_less_header_background_1]"]').val(),
						"@headerBg2" : jQuery('input[name="redux[berg_less_header_background_2]"]').val(),
						"@headerText" : jQuery('input[name="redux[berg_less_header_text_1]"]').val(),
						"@headerText2" : jQuery('input[name="redux[berg_less_header_text_2]"]').val(),
						"@headerActive" : jQuery('input[name="redux[berg_less_header_active]"]').val(),
						"@headerReorderActive" : jQuery('input[name="redux[berg_less_header_reorder_active]"]').val(),
						"@footerBg" : jQuery('input[name="redux[berg_less_footer_background]"]').val(),
						"@footerText" : jQuery('input[name="redux[berg_less_footer_text]"]').val(),
						"@footerLink" : jQuery('input[name="redux[berg_less_footer_link]"]').val()
					})
					}, 50)
				// }
				less_compiler = true;
			});

			</script>

			<link rel="stylesheet/less" type="text/css" href="<?php echo THEME_DIR_URI;?>/styles/less/custom.less" />

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
			$extension = ReduxFramework_extension_less_compile::getInstance();

            if ($this->parent->args['dev_mode']) {
                wp_enqueue_style( 'redux-color-picker-css' );
            }

            if (is_admin()) {
            	wp_enqueue_style('wp-color-picker');	
            }

            wp_enqueue_script(
                'redux-field-less-compile-js',
                $this->extension_url . 'field_less_compile'.Redux_Functions::isMin().'.js', 
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

		}
	}
}

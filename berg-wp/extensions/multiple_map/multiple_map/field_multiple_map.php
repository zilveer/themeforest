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
if( !class_exists( 'ReduxFramework_multiple_map' ) ) {

	/**
	 * Main ReduxFramework_custom_field class
	 *
	 * @since       1.0.0
	 */
	class ReduxFramework_multiple_map extends ReduxFramework {
	
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
				<?php
			$locations = YSettings::g("multiple_contact_map_div"); 
			if(!isset($locations['multiple_contact_locations']) || $locations['multiple_contact_locations'] == '') {
				$locations['multiple_contact_locations'] = '1';
			}
			$mapElements = $locations['multiple_contact_locations'];
			$mapElements = explode("|", $mapElements);
			$last = 0;
			foreach ($mapElements as $key => $element) {
				$this->mapElement($element, $key);
				$last++;
			}

			?>
			<tr class="form-field add-new-map map_position">
				<th scope="row"><label><?php echo __('Add more', 'BERG');?></label></th>
				<td>
					<input type="text" class="hidden" name="<?php echo $this->field['name'] . $this->field['name_suffix'] . '[multiple_contact_locations]' ; ?>" value="<?php echo $locations['multiple_contact_locations']; ?>" id="multiple_contact_locations_id" />
					<button id="multiple_contact_map_add" class="button button-primary" data-id="<?php echo $last+1; ?>"><?php echo __('Add new location', 'BERG');?></button>
				</td>
			</tr>
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

			$extension = ReduxFramework_extension_multiple_map::getInstance();

            wp_enqueue_script(
                'redux-field-multiple_map-js',
                $this->extension_url . 'field_multiple_map.js', 
                array( 'jquery', 'wp-color-picker', 'redux-js' ),
                time(),
                true
            );
             wp_enqueue_style(
                'redux-field-multiple_map-css', 
                $this->extension_url . 'field_multiple_map.css',
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

		public function drawMultipleMap() {

		}

		public function mapElement($uuid, $i) {
			?>
			<tr class="form-field field-map map_id_<?php echo $uuid; ?>">
				<th scope="row">
					<label for="map_canvas"><?php echo __('Location ', 'BERG');?>#<?php echo $i+1; ?></label>
				</th>
				<td><div style="width: 100%; height:250px;" id="map_<?php echo $uuid; ?>" class="mulitiple_map_canvas map_<?php echo $uuid; ?>" data-uuid="<?php echo $uuid; ?>"></div></td>
			</tr>

			<tr class="form-field field-location map_id_<?php echo $uuid; ?>">
				<th scope="row"><label for="multiple_contact_map_address_id"><?php echo __('Find location', 'BERG');?></label></th>
				<td><?php 
					
					$locations = YSettings::g("multiple_contact_map_div"); 
					$class_border = '';
					if( $uuid == '1') {
						$class_border = 'show-bottom-border';
					}

 					if(!isset($locations["multiple_contact_map_address_".$uuid])) {
 						$locations["multiple_contact_map_address_".$uuid] = 'Świdnica';
 					}					
 					if(!isset($locations["multiple_contact_map_lat_".$uuid])) {
 						$locations["multiple_contact_map_lat_".$uuid] = '50.8498434';
 					}
 					if(!isset($locations["multiple_contact_map_lng_".$uuid])) {
 						$locations["multiple_contact_map_lng_".$uuid] = '16.475679000000014';
 					}
 					if(!isset($locations["multiple_contact_map_zoom_".$uuid])) {
 						$locations["multiple_contact_map_zoom_".$uuid] = 10;
 					}
 					if(!isset($locations["multiple_contact_marker_width_".$uuid])) {
 						$locations["multiple_contact_marker_width_".$uuid] = 0;
 					}
 					if(!isset($locations["multiple_contact_marker_height_".$uuid])) {
 						$locations["multiple_contact_marker_height_".$uuid] = 0;
 					} 					

				?>
					<input style="width:310px;" type="text" class="<?php echo $uuid; ?>" id="multiple_contact_map_address_<?php echo $uuid; ?>_id" name="<?php echo $this->field['name'] . $this->field['name_suffix'] . '[multiple_contact_map_address_'.$uuid.']'; ?>" value="<?php echo $locations['multiple_contact_map_address_'.$uuid]; ?>"> <button id="multiple_contact_map_search_<?php echo $uuid; ?>" data-uuid="<?php echo $uuid; ?>" class="button button-search"><?php echo __('Search', 'BERG');?></button>
					<input type="text" class="hidden" name="<?php echo $this->field['name'].$this->field['name_suffix'].'[multiple_contact_map_lat_'.$uuid.']';?>" id="multiple_contact_map_lat_<?php echo $uuid; ?>_id" value="<?php echo $locations["multiple_contact_map_lat_".$uuid]; ?>" />
					<input type="text" class="hidden" name="<?php echo $this->field['name'] . $this->field['name_suffix'] . '[multiple_contact_map_lng_'.$uuid.']'; ?>" id="multiple_contact_map_lng_<?php echo $uuid; ?>_id" value="<?php echo $locations["multiple_contact_map_lng_".$uuid]; ?>" />
					<input type="text" class="hidden" name="<?php echo $this->field['name'].$this->field['name_suffix'].'[multiple_contact_map_zoom_'.$uuid.']'; ?>" id="multiple_contact_map_zoom_<?php echo $uuid; ?>_id" value="<?php echo $locations["multiple_contact_map_zoom_".$uuid]; ?>" />
					<input type="text" class="hidden" name="<?php echo $this->field['name'].$this->field['name_suffix'].'[multiple_contact_marker_width_'.$uuid.']'; ?>" id="multiple_contact_marker_width_<?php echo $uuid; ?>_id" value="<?php echo $locations["multiple_contact_marker_width_".$uuid]; ?>" />
					<input type="text" class="hidden" name="<?php echo $this->field['name'].$this->field['name_suffix'].'[multiple_contact_marker_height_'.$uuid.']'; ?>" id="multiple_contact_marker_height_<?php echo $uuid; ?>_id" value="<?php echo $locations["multiple_contact_marker_height_".$uuid]; ?>" />
				</td>
			</tr>

			<tr valign="form-field" class="form-field field-marker map_id_<?php echo $uuid; ?>">
				<th>
					<label for="multiple_contact_map_marker_image_<?php echo $uuid; ?>_id"><?php echo __('Marker image', 'BERG');?></label>
				</th>
				<td>
					<?php if(!isset($locations["multiple_contact_map_marker_image_".$uuid])) {
						$locations["multiple_contact_map_marker_image_".$uuid] = '';
					}

					;?>
					<input id="upload_image" type="text" size="20" style="width:310px;" name="<?php echo $this->field['name'].$this->field['name_suffix'].'[multiple_contact_map_marker_image_'.$uuid.']';?>" value="<?php echo $locations["multiple_contact_map_marker_image_".$uuid]; ?>" class="marker_image_<?php echo $uuid; ?>">
					<input id="upload_image_button" class="button button-secondary upload_image_button" type="button" value="Upload" data-id="2">
					<input id="multiple_contact_map_marker_image_<?php echo $uuid; ?>_id" class="hidden" value="<?php echo $locations["multiple_contact_map_marker_image_".$uuid]; ?>">
					<input class="button button-secondary upload_image_remove_button" type="button" value="Remove" data-id="2">
				</td>
			</tr>
			<tr class="form-field field-header-info map_id_<?php echo $uuid; ?>">
				<th scope="row"><label><?php echo __('Location header', 'BERG');?></label></th>
				<td><?php 
					
 					if(!isset($locations["multiple_contact_address_header_".$uuid])) {
 						$locations["multiple_contact_address_header_".$uuid] = '';
 					}	
 					if(!isset($locations["multiple_contact_address_desc_".$uuid])) {
 						$locations["multiple_contact_address_desc_".$uuid] = '';
 					}					

				?>
					<input style="width:310px;" type="text" class="header_<?php echo $uuid; ?>" id="multiple_contact_address_header_<?php echo $uuid; ?>_id" name="<?php echo $this->field['name'] . $this->field['name_suffix'] . '[multiple_contact_address_header_'.$uuid.']'; ?>" value="<?php echo $locations['multiple_contact_address_header_'.$uuid]; ?>"> 
				</td>
			</tr>
			<tr class="form-field field-desc-info map_id_<?php echo $uuid; ?> <?php echo $class_border ;?>">
				<th scope="row"><label><?php echo __('Location description', 'BERG');?></label></th>
				<td><?php 
					
 					if(!isset($locations["multiple_contact_address_desc_".$uuid])) {
 						$locations["multiple_contact_address_desc_".$uuid] = '';
 					}					
 					$content = $locations["multiple_contact_address_desc_".$uuid];
 					// $content = '';
				?>

					<?php wp_editor( $content, 'multiple_contact_address_desc_'.$uuid.'_id', $settings = array('textarea_name' => ''.$this->field['name'] . $this->field['name_suffix'] . '[multiple_contact_address_desc_'.$uuid.']', 'media_buttons' => false, 'textarea_rows' => get_option('default_post_edit_rows', 2), 'editor_class' => $uuid. ' contact-editor') ); ?>
				</td>
			</tr>

			<?php if ($i > 0) : ?>
			<tr class="form-field field-remove-location map_id_<?php echo $uuid; ?>">
				<th scope="row"><label><?php echo __('Remove', 'BERG');?></label></th>
				<td><button id="multiple_contact_map_search" data-uuid="<?php echo $uuid; ?>" class="button button-remove button-remove-map"><?php echo __('Remove this location', 'BERG');?></button></td>
			</tr>
			<?php endif; ?>
			<!-- <tr class="form-field map_id_<?php //echo $uuid; ?>">
				<th scope="row"><hr/></th>
				<td><hr/></td>
			</tr> -->
			<?php
		}


	}
}

<?php
/**
 * Create custom fields for WordPress Menus admin section
 *
 * @author		Bob Ulusoy
 * @copyright	Artbees LTD (c)
 * @link		http://artbees.net
 * @since		Version 5.3
 * @package 	artbees
 */


/**
 *
 * This class demonstrate the usage of Menu Item Custom Fields in plugins/themes.
 *
 * @since 0.1.0
 */
class Menu_Item_Custom_Fields_Example {

	/**
	 * Holds our custom fields
	 *
	 * @var    array
	 * @access protected
	 * @since  Menu_Item_Custom_Fields_Example 0.2.0
	 */
	protected static $fields = array();


	/**
	 * Initialize plugin
	 */
	public static function init() {
		add_action( 'wp_nav_menu_item_custom_fields', array( __CLASS__, '_fields' ), 10, 4 );
		add_action( 'wp_update_nav_menu_item', array( __CLASS__, '_save' ), 10, 3 );
		add_filter( 'manage_nav-menus_columns', array( __CLASS__, '_columns' ), 99 );

		self::$fields = array(
							array(
			 					"key"		  => "menu_icon",
								"type"		  => "text",
								"label" 	  => __( 'Menu Item Icon', 'mk_framework' ),
								"description" => __( "<a target='_blank' href='".admin_url( 'admin.php?page=icon-library')."'>Click here</a> to get the icon class name (or any other font icons library that you have installed in the theme)", 'mk_framework' )
							 ),
						 	array(
			 					"key"		  => "megamenu",
								"type"		  => "checkbox",
								"label" 	  => __( 'Make this Item Mega Menu?', 'mk_framework' ),
								"description" => __( '', 'mk_framework' )
							 ),
			 				array(
			 					"key"		  => "megamenu_styles",
								"type"		  => "textarea",
								"label" 	  => __( 'Mega Menu Container Styles', 'mk_framework' ),
								"description" => __( 'This option will allow you add custom styles (background position, background repeat,..) to your mega menu main container.', 'mk_framework' )
							 ),
			 				array(
			 					"key"		  => "megamenu_background",
								"type"		  => "upload",
								"label" 	  => __( 'Set Background Image', 'mk_framework' ),
								"description" => __( '', 'mk_framework' )
							 ),

			 				array(
			 					"key"		  => "megamenu_widgetarea",
								"type"		  => "widget_area",
								"label" 	  => __( 'Mega Menu Widget Area', 'mk_framework' ),
								"description" => __( '', 'mk_framework' )
							 )
		);
	}


	/**
	 * Save custom field value
	 *
	 * @wp_hook action wp_update_nav_menu_item
	 *
	 * @param int   $menu_id         Nav menu ID
	 * @param int   $menu_item_db_id Menu item ID
	 * @param array $menu_item_args  Menu item data
	 */
	public static function _save( $menu_id, $menu_item_db_id, $menu_item_args ) {
		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			return;
		}

		check_admin_referer( 'update-nav_menu', 'update-nav-menu-nonce' );

		foreach ( self::$fields as $field ) {
			$key = sprintf( '_menu_item_%s', $field["key"] );

			// Sanitize
			if ( ! empty( $_POST[ $key ][ $menu_item_db_id ] ) ) {
				// Do some checks here...
				$value = $_POST[ $key ][ $menu_item_db_id ];
			}
			else {
				$value = null;
			}

			// Update
			if ( ! is_null( $value ) ) {
				update_post_meta( $menu_item_db_id, $key, $value );
			}
			else {
				delete_post_meta( $menu_item_db_id, $key );
			}
		}
	}


	/**
	 * Print field
	 *
	 * @param object $item  Menu item data object.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args  Menu item args.
	 * @param int    $id    Nav menu ID.
	 *
	 * @return string Form fields
	 */
	public static function _fields( $id, $item, $depth, $args ) {
		foreach ( self::$fields as $field) :
			
			$key   			= sprintf( '_menu_item_%s', $field["key"] );
			$id    			= sprintf( 'edit%s_%s', $key, $item->ID );
			$label  		= $field["label"];
			$description  	= $field["description"];
			$name  			= sprintf( '%s[%s]', $key, $item->ID );
			$value 			= get_post_meta( $item->ID, $key, true );
			$class 			= sprintf( 'field-%s', $field["key"] );

			$field_type = '_field_'.$field["type"];

			 self::{$field_type}($id, $label, $description, $name, $value, $class);

		endforeach;
	}


	/**
	 * Textarea field
	 *
	 * @param string    $id  			Unique field id.
	 * @param string  	$label  		field title.
	 * @param string    $description  	field short desciption.
	 * @param string    $name   		field form element name attribute.
	 * @param string    $value    		field option value.
	 * @param string    $class    		field class.
	 *
	 * @return string Form fields
	 */

	public static function _field_textarea($id, $label, $description, $name, $value, $class) {
			?>
				<p class="description description-wide <?php echo esc_attr( $class ) ?>">
					<?php printf(
						'<label for="%1$s"><strong>%2$s</strong><br /><textarea rows="6" cols="20" id="%1$s" class="widefat %1$s" name="%3$s">%4$s</textarea></label><span class="description">%5$s</span>',
						esc_attr( $id ),
						esc_html( $label ),
						esc_attr( $name ),
						esc_attr( $value ),
						esc_attr( $description )
					) ?>
                </p>	
			<?php
	}





	/**
	 * Upload Image
	 *
	 * @param string    $id  			Unique field id.
	 * @param string  	$label  		field title.
	 * @param string    $description  	field short desciption.
	 * @param string    $name   		field form element name attribute.
	 * @param string    $value    		field option value.
	 * @param string    $class    		field class.
	 *
	 * @return string Form fields
	 */

	public static function _field_upload($id, $label, $description, $name, $value, $class) {

			?>
				<div class="wp-clearfix"></div>
				<a href="#" id="mk-media-upload-<?php echo esc_attr( $id ); ?>" class="mk-open-media button button-primary mk-megamenu-upload-background"><?php echo $label; ?></a>

				<p class="description description-wide <?php echo esc_attr( $class ) ?>">

                    <label for="<?php echo esc_attr( $id ); ?>">
                        <input type="hidden" id="<?php echo esc_attr( $id ); ?>" class="mk-new-media-image widefat code <?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $value ); ?>" />
                        <img src="<?php echo esc_attr( $value ); ?>" id="mk-media-img-<?php echo esc_attr( $id ); ?>" class="mk-megamenu-background-image" />
                        <a href="#" id="mk-media-remove-<?php echo esc_attr( $id ); ?>" class="remove-mk-megamenu-background">Remove Image</a>
                    </label>
                </p>

			<?php
	}



	/**
	 * Select Widget Area
	 *
	 * @param string    $id  			Unique field id.
	 * @param string  	$label  		field title.
	 * @param string    $description  	field short desciption.
	 * @param string    $name   		field form element name attribute.
	 * @param string    $value    		field option value.
	 * @param string    $class    		field class.
	 *
	 * @return string Form fields
	 */

	public static function _field_widget_area($id, $label, $description, $name, $value, $class) {
			global $wp_registered_sidebars;
			?>
                <p class="description description-wide <?php echo esc_attr( $class ) ?>">
                    <label for="<?php echo esc_attr( $id ); ?>">
                        <strong><?php echo esc_html( $label ); ?></strong>
                        <select id="<?php echo esc_attr( $id ); ?>" class="widefat code <?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>">
                            <option value="0"><?php _e( 'Select Widget Area', 'mk_framework' ); ?></option>
                            <?php
                            if( ! empty( $wp_registered_sidebars ) && is_array( $wp_registered_sidebars ) ):
                            foreach( $wp_registered_sidebars as $sidebar ):
                            ?>
                            <option value="<?php echo $sidebar['id']; ?>" <?php selected( esc_attr( $value ), $sidebar['id'] ); ?>><?php echo $sidebar['name']; ?></option>
                            <?php endforeach; endif; ?>
                        </select>
                    </label>
                </p>

			<?php
	}




	/**
	 * Checkbox Field
	 *
	 * @param string    $id  			Unique field id.
	 * @param string  	$label  		field title.
	 * @param string    $description  	field short desciption.
	 * @param string    $name   		field form element name attribute.
	 * @param string    $value    		field option value.
	 * @param string    $class    		field class.
	 *
	 * @return string Form fields
	 */

	public static function _field_checkbox($id, $label, $description, $name, $value, $class) {
			$field_value = ($value != "") ? "checked='checked'" : '';
			?>
                <p class="description description-wide <?php echo esc_attr( $class ); ?>">
                    <label for="<?php echo esc_attr( $id ); ?>">
                        <input type="checkbox" value="enabled" class="edit-menu-item-mk-megamenu-check" id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php echo $field_value; ?> />
                        <strong><?php echo esc_html( $label ); ?></strong>
                    </label>
                </p>

			<?php
	}



	/**
	 * Text Field
	 *
	 * @param string    $id  			Unique field id.
	 * @param string  	$label  		field title.
	 * @param string    $description  	field short desciption.
	 * @param string    $name   		field form element name attribute.
	 * @param string    $value    		field option value.
	 * @param string    $class    		field class.
	 *
	 * @return string Form fields
	 */

	public static function _field_text($id, $label, $description, $name, $value, $class) {
			?>
                <p class="description description-wide <?php echo esc_attr( $class ); ?>">
	                <label for="<?php echo esc_attr( $id ); ?>">
	                        <strong><?php echo esc_html( $label ); ?></strong><br />
	                        <input class="widefat" type="text" id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $value ); ?>" />   
	                        <span class="description"><?php echo $description; ?></span>
	                </label>
                </p>

			<?php
	}




	/**
	 * Add our fields to the screen options toggle
	 *
	 * @param array $columns Menu item columns
	 * @return array
	 */
	public static function _columns( $columns ) {
		$columns = array_merge( $columns, self::$fields );

		return $columns;
	}
}
Menu_Item_Custom_Fields_Example::init();

<?php if(! defined('ABSPATH')){ return; }

// We need to load the default menu walker so we can extend it
	require_once( ABSPATH . 'wp-admin/includes/nav-menu.php' ); // Load all the nav menu interface functions

	add_action( 'admin_enqueue_scripts', 'znfw_wp_admin_nav_menus_css' );
	add_filter( 'wp_edit_nav_menu_walker', 'znfw_modify_backend_walker', 100);
	add_action( 'wp_nav_menu_item_custom_fields', 'znfw_add_menu_button_fields', 10, 4 );
	add_action( 'wp_update_nav_menu_item', 'znfw_update_menu', 100, 3);

	/* 
	* Add CSS 
	*/
	function znfw_wp_admin_nav_menus_css($hook)
	{
		// Check the hook so that the .css is only added to the .php file where we need it
		if( 'nav-menus.php' != $hook )
				return;
		wp_register_style( 'znfw_wp_admin_nav_menus_css', FW_URL .'/assets/css/zn_html_css.css' );
		wp_enqueue_style( 'znfw_wp_admin_nav_menus_css' );
	} // function


	/*
	 * SAVE / UPDATE CUSTOM OPTIONS
	 * @param int $menu_id
	 * @param int $menu_item_db
	 */
	function znfw_update_menu( $menu_id, $menu_item_db ) { 

		$fields = array(
			'menu_item_zn_mega_menu_enable',
			'menu_item_zn_mega_menu_headers',
			'menu_item_zn_mega_menu_label'
		);


		foreach ( $fields as $key )
		{
			if(!isset($_REQUEST[$key][$menu_item_db]))
			{
				$_REQUEST[$key][$menu_item_db] = "";
			}

			$value = $_REQUEST[$key][$menu_item_db];
			update_post_meta( $menu_item_db, '_'.$key , $value );

		}
	}

	function znfw_modify_backend_walker( $walker ){
		return 'ZnBackendWalker';
	}

	function znfw_add_menu_button_fields( $item_id, $item, $depth, $args ){

		$item_id = esc_attr( $item->ID );
		// LABEL
		$key = 'menu_item_zn_mega_menu_label';
		$value = get_post_meta( $item_id, '_'.$key, true);
		?>
		<p class="field-mega-menu-badge description description-wide">
			<label for="edit-menu-item-attr-title-<?php echo $item_id; ?>">
				<?php _e( 'Label' , 'zn_framework' ); ?><br />
				<input type="text" id="edit-menu-item-attr-label-<?php echo $item_id; ?>" class="widefat edit-menu-item-attr-label" name="<?php echo $key; ?>[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $value ); ?>" />
			</label>
		</p>

		<?php
			// USE AS MEGAMENU
			$title = __( 'Use as Mega Menu ?' , 'zn_framework' );
			$key = 'menu_item_zn_mega_menu_enable';
			$value = get_post_meta( $item_id, '_'.$key, true);

			if($value != "") $value = "checked='checked'";
		?>
		<p class="field-enable-mega-menu description description-wide">
			<label for="enable-mega-menu-<?php echo $item_id; ?>">
				<input id="enable-mega-menu-<?php echo $item_id; ?>" type="checkbox" class="menu-item-checkbox" <?php echo $value; ?> name="<?php echo $key; ?>[<?php echo $item_id; ?>]">
				<?php echo $title; ?>
			</label>
		</p>

		<?php
			$title = __( 'Hide menu header' , 'zn_framework' );
			$key = 'menu_item_zn_mega_menu_headers';
			$value = get_post_meta( $item_id, '_'.$key, true);

			if($value != "") $value = "checked='checked'";
		?>
		<p class="field-enable-mega-menu-headers description description-wide">
			<label for="enable-mega-menu-headers-<?php echo $item_id; ?>">
				<input id="enable-mega-menu-headers-<?php echo $item_id; ?>" type="checkbox" class="menu-item-checkbox" <?php echo $value; ?> name="<?php echo $key; ?>[<?php echo $item_id; ?>]">
				<?php echo $title; ?>
			</label>
		</p>

		<?php
	}

	/**
	 * Create HTML list of nav menu input items. ( COPIED FROM DEFAULT WALKER )
	 *
	 * @package WordPress
	 * @since 3.0.0
	 * @uses Walker_Nav_Menu
	 */
	class ZnBackendWalker extends Walker_Nav_Menu_Edit {

		function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) 
		{

			$item_output = '';
			parent::start_el( $item_output, $item, $depth, $args, $id );
			
			$position = '<p class="field-move';		 
			$extra = $this->get_fields( $item, $depth, $args, $id );
			
			 $output .= str_replace( $position, $extra . $position, $item_output );
		} // function
		
		function get_fields( $item, $depth, $args = array(), $id = 0 ) 
		{
			ob_start();

			// conform to https://core.trac.wordpress.org/attachment/ticket/14414/nav_menu_custom_fields.patch
			do_action( 'wp_nav_menu_item_custom_fields', $id, $item, $depth, $args );
					
			return ob_get_clean();
		}

	} // Walker_Nav_Menu_Edit

<?php
/**
 * Edit menu walker.
 *
 */

/**
 * Create HTML list of nav menu input items.
 *
 * @package WordPress
 * @since 3.0.0
 * @uses Walker_Nav_Menu
 */
class Df_Edit_Walker_Nav_Menu extends Walker_Nav_Menu {
	/**
	 * Starts the list before the elements are added.
	 *
	 * @see Walker_Nav_Menu::start_lvl()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   Not used.
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {}

	/**
	 * Ends the list of after the elements are added.
	 *
	 * @see Walker_Nav_Menu::end_lvl()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   Not used.
	 */
	function end_lvl( &$output, $depth = 0, $args = array() ) {}

	/**
	 * Start the element output.
	 *
	 * @see Walker_Nav_Menu::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Menu item data object.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   Not used.
	 * @param int    $id     Not used.
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $_wp_nav_menu_max_depth;
		$_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

		ob_start();
		$item_id = esc_attr( $item->ID );
		$removed_args = array(
			'action',
			'customlink-tab',
			'edit-menu-item',
			'menu-item',
			'page-tab',
			'_wpnonce',
		);

		$original_title = '';
		if ( 'taxonomy' == $item->type ) {
			$original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
			if ( is_wp_error( $original_title ) )
				$original_title = false;
		} elseif ( 'post_type' == $item->type ) {
			$original_object = get_post( $item->object_id );
			if ( $original_object ) {
				$original_title = get_the_title( $original_object->ID );
			}
		}

		$classes = array(
			'menu-item menu-item-depth-' . $depth,
			'menu-item-' . esc_attr( $item->object ),
			'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
		);

		$title = $item->title;

		if ( ! empty( $item->_invalid ) ) {
			$classes[] = 'menu-item-invalid';
			/* translators: %s: title of menu item which is invalid */
			$title = sprintf( __( '%s (Invalid)', 'woothemes' ), $item->title );
		} elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
			$classes[] = 'pending';
			/* translators: %s: title of menu item in draft status */
			$title = sprintf( __('%s (Pending)', 'woothemes'), $item->title );
		}

		$title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;

		$submenu_text = '';
		if ( 0 == $depth )
			$submenu_text = 'style="display: none;"';

		// set default item fields
		$default_mega_menu_fields = array(
			'df_mega_menu_icon' => 'none',
			'df_mega_menu_iconfont' => '',
			'df_mega_menu_image' => '',
			'df_mega_menu_image_width' => 0,
			'df_mega_menu_image_height' => 0,
			'df_mega_menu_enabled' => 0,
			'df_mega_menu_fullwidth' => 0,
			'df_mega_menu_columns' => 3,
			'df_mega_menu_position' => 'left',
			'df_mega_menu_text_align' => 'left',
			'df_mega_menu_hide_title' => 0,
			'df_mega_menu_remove_link' => 0,
			'df_mega_menu_new_row' => 0,
			'df_mega_menu_new_column' => 0
		);

		// set defaults
		foreach ( $default_mega_menu_fields as $field=>$value ) {
			if ( !isset($item->$field) ) {
				$item->$field = $value;
			}
		}

		// for ajax added items
		if ( empty( $item->df_mega_menu_icon ) ) {
			$item->df_mega_menu_icon = 'none';
		}

		if ( empty( $item->df_mega_menu_columns ) ) {
			$item->df_mega_menu_columns = 3;
		}
        
		if ( empty( $item->df_mega_menu_position ) ) {
			$item->df_mega_menu_position = 'left'; // Mega Menu Position left / right
		}

		if ( empty( $item->df_mega_menu_text_align ) ) {
			$item->df_mega_menu_text_align = 'left'; // Mega Menu Text Align center / left / right
		}

		$mega_menu_container_classes = array( 'df-mega-menu-feilds' );
		if ( !empty($item->df_mega_menu_enabled) ) {
			$classes[] = 'field-df-mega-menu-enabled';
		}
		switch ( $item->df_mega_menu_icon ) {
			case 'image': $mega_menu_container_classes[] = 'field-df-mega-menu-image-icon'; break;
			case 'iconfont': $mega_menu_container_classes[] = 'field-df-mega-menu-iconfont-icon';
		}

		$mega_menu_container_classes = implode( ' ', $mega_menu_container_classes );
		?>
		<li id="menu-item-<?php echo $item_id; ?>" class="<?php echo implode(' ', $classes ); ?>">
			<dl class="menu-item-bar">
				<dt class="menu-item-handle">
					<span class="item-title"><span class="menu-item-title"><?php echo esc_html( $title ); ?></span> <span class="is-submenu" <?php echo $submenu_text; ?>><?php _e( 'sub item', 'woothemes' ); ?></span></span>
					<span class="item-controls">
						<span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
						<span class="item-order hide-if-js">
							<a href="<?php
								echo wp_nonce_url(
									add_query_arg(
										array(
											'action' => 'move-up-menu-item',
											'menu-item' => $item_id,
										),
										remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
									),
									'move-menu_item'
								);
							?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up', 'woothemes'); ?>">&#8593;</abbr></a>
							|
							<a href="<?php
								echo wp_nonce_url(
									add_query_arg(
										array(
											'action' => 'move-down-menu-item',
											'menu-item' => $item_id,
										),
										remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
									),
									'move-menu_item'
								);
							?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down', 'woothemes'); ?>">&#8595;</abbr></a>
						</span>
						<a class="item-edit" id="edit-<?php echo $item_id; ?>" title="<?php esc_attr_e('Edit Menu Item', 'woothemes'); ?>" href="<?php
							echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
						?>"><?php _e( 'Edit Menu Item', 'woothemes' ); ?></a>
					</span>
				</dt>
			</dl>

			<div class="menu-item-settings" id="menu-item-settings-<?php echo $item_id; ?>">
				<?php if( 'custom' == $item->type ) : ?>
					<p class="field-url description description-wide">
						<label for="edit-menu-item-url-<?php echo $item_id; ?>">
							<?php _e( 'URL', 'woothemes' ); ?><br />
							<input type="text" id="edit-menu-item-url-<?php echo $item_id; ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
						</label>
					</p>
				<?php endif; ?>
				<p class="description description-thin">
					<label for="edit-menu-item-title-<?php echo $item_id; ?>">
						<?php _e( 'Navigation Label', 'woothemes' ); ?><br />
						<input type="text" id="edit-menu-item-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
					</label>
				</p>
				<p class="description description-thin">
					<label for="edit-menu-item-attr-title-<?php echo $item_id; ?>">
						<?php _e( 'Title Attribute', 'woothemes' ); ?><br />
						<input type="text" id="edit-menu-item-attr-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
					</label>
				</p>
				<p class="field-link-target description">
					<label for="edit-menu-item-target-<?php echo $item_id; ?>">
						<input type="checkbox" id="edit-menu-item-target-<?php echo $item_id; ?>" value="_blank" name="menu-item-target[<?php echo $item_id; ?>]"<?php checked( $item->target, '_blank' ); ?> />
						<?php _e( 'Open link in a new window/tab', 'woothemes' ); ?>
					</label>
				</p>
				<p class="field-css-classes description description-thin">
					<label for="edit-menu-item-classes-<?php echo $item_id; ?>">
						<?php _e( 'CSS Classes (optional)', 'woothemes' ); ?><br />
						<input type="text" id="edit-menu-item-classes-<?php echo $item_id; ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo $item_id; ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
					</label>
				</p>
				<p class="field-xfn description description-thin">
					<label for="edit-menu-item-xfn-<?php echo $item_id; ?>">
						<?php _e( 'Link Relationship (XFN)', 'woothemes' ); ?><br />
						<input type="text" id="edit-menu-item-xfn-<?php echo $item_id; ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
					</label>
				</p>
				<p class="field-description description description-wide">
					<label for="edit-menu-item-description-<?php echo $item_id; ?>">
						<?php _e( 'Description', 'woothemes' ); ?><br />
						<textarea id="edit-menu-item-description-<?php echo $item_id; ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo $item_id; ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
						<span class="description"><?php _e('The description will be displayed in the menu if the current theme supports it.', 'woothemes' ); ?></span>
					</label>
				</p>

				<!-- DF Mega Menu Start -->

				<div class="<?php echo esc_attr( $mega_menu_container_classes ); ?>">

					<p class="field-df-icon description description-wide">
						<?php _ex( 'Icon :', 'edit menu walker', 'woothemes' ); ?>
						<label>
							<input type="radio" name="menu-item-df-icon[<?php echo $item_id; ?>]" value="none" <?php checked( $item->df_mega_menu_icon, 'none' ); ?>/>
							<?php _ex( 'no', 'edit menu walker', 'woothemes' ); ?>
						</label>
						<label>
							<input type="radio" name="menu-item-df-icon[<?php echo $item_id; ?>]" value="iconfont" <?php checked( $item->df_mega_menu_icon, 'iconfont' ); ?>/>
							<?php _ex( 'iconfont', 'edit menu walker', 'woothemes' ); ?>
						</label>
						<label>
							<input type="radio" name="menu-item-df-icon[<?php echo $item_id; ?>]" value="image" <?php checked( $item->df_mega_menu_icon, 'image' ); ?>/>
							<?php _ex( 'custom image', 'edit menu walker', 'woothemes' ); ?>
						</label>
					</p>
					<p class="field-df-iconfont description description-wide">
						<label>
							<?php _ex( 'Iconfont code', 'edit menu walker', 'woothemes' ); ?><br />
							<textarea class="widefat edit-menu-item-iconfont" rows="3" cols="20" name="menu-item-df-iconfont[<?php echo $item_id; ?>]"><?php echo esc_html( $item->df_mega_menu_iconfont ); // textarea_escaped ?></textarea>
						</label>
					</p>
					 <div class="field-df-image upload-controls"><!-- use image?  -->
						<?php
						 if ( function_exists('navmenu_uploader') ) {
						 	echo navmenu_uploader( 'menu-item-df-image-' . $item_id, $item->df_mega_menu_image, 'uri_only', null, "menu-item-df-image[{$item_id}]" );
							?>
							<input type="hidden" class="upload-image-width" name="menu-item-df-image-width[<?php echo $item_id; ?>]" value="<?php echo absint($item->df_mega_menu_image_width); ?>"/>
						 	<input type="hidden" class="upload-image-height" name="menu-item-df-image-height[<?php echo $item_id; ?>]" value="<?php echo absint($item->df_mega_menu_image_height); ?>"/>
						<?php 
						 }
						?>
					</div>

					<!-- first level -->
					<p class="field-df-enable-mega-menu">
						<label for="edit-menu-item-df-enable-mega-menu-<?php echo $item_id; ?>">
							<input id="edit-menu-item-df-enable-mega-menu-<?php echo $item_id; ?>" type="checkbox" class="menu-item-df-enable-mega-menu" name="menu-item-df-enable-mega-menu[<?php echo $item_id; ?>]" <?php checked( $item->df_mega_menu_enabled ); ?>/>
							<?php _ex( 'Enable Mega Menu', 'edit menu walker', 'woothemes' ); ?>
						</label>
					</p>
					<p class="field-df-fullwidth-menu">
						<label for="edit-menu-item-df-fullwidth-menu-<?php echo $item_id; ?>">
							<input id="edit-menu-item-df-fullwidth-menu-<?php echo $item_id; ?>" type="checkbox" name="menu-item-df-fullwidth-menu[<?php echo $item_id; ?>]" <?php checked( $item->df_mega_menu_fullwidth ); ?>/>
							<?php _ex( 'Fullwidth', 'edit menu walker', 'woothemes' ); ?>
						</label>
					</p>
					<p class="field-df-columns description description-wide">
						<?php _ex( 'Number of columns: ', 'edit menu walker', 'woothemes' ); ?>
						<select name="menu-item-df-columns[<?php echo $item_id; ?>]" id="edit-menu-item-df-columns-<?php echo $item_id; ?>">
							<?php foreach( array( '1' => 1, '2' => 2, '3' => 3, '4' => 4, '5' => 5 ) as $title=>$value): ?>
								<option value="<?php echo esc_attr($value); ?>" <?php selected($value, $item->df_mega_menu_columns); ?>><?php echo esc_html($title); ?></option>
							<?php endforeach; ?>
						</select>
					</p>
					<p class="field-df-position description description-wide">
						<?php _ex( 'Position: ', 'edit menu walker', 'woothemes' ); ?>
						<select name="menu-item-df-position[<?php echo $item_id; ?>]" id="edit-menu-item-df-position-<?php echo $item_id; ?>">
							<?php foreach( array( 'Left' => 'left', 'center' => 'center', 'Right' => 'right' ) as $title=>$value): ?>
								<option value="<?php echo esc_attr($value); ?>" <?php selected($value, $item->df_mega_menu_position); ?>><?php echo esc_html($title); ?></option>
							<?php endforeach; ?>
						</select>
					</p>	
					<p class="field-df-text-align description description-wide">
						<?php _ex( 'Menu Text Align: ', 'edit menu walker', 'woothemes' ); ?>
						<select name="menu-item-df-text-align[<?php echo $item_id; ?>]" id="edit-menu-item-df-text-align-<?php echo $item_id; ?>">
							<?php foreach( array( 'Center' => 'center', 'Left' => 'left', 'Right' => 'right' ) as $title=>$value): ?>
								<option value="<?php echo esc_attr($value); ?>" <?php selected($value, $item->df_mega_menu_text_align); ?>><?php echo esc_html($title); ?></option>
							<?php endforeach; ?>
						</select>
					</p>

					<!-- second level -->
					<p class="field-df-hide-title">
						<label for="edit-menu-item-df-hide-title-<?php echo $item_id; ?>">
							<input id="edit-menu-item-df-hide-title-<?php echo $item_id; ?>" type="checkbox" name="menu-item-df-hide-title[<?php echo $item_id; ?>]" <?php checked( $item->df_mega_menu_hide_title ); ?>/>
							<?php _ex( 'Hide title in mega menu', 'edit menu walker', 'woothemes' ); ?>
						</label>
					</p>
					<p class="field-df-remove-link">
						<label for="edit-menu-item-df-remove-link-<?php echo $item_id; ?>">
							<input id="edit-menu-item-df-remove-link-<?php echo $item_id; ?>" type="checkbox" name="menu-item-df-remove-link[<?php echo $item_id; ?>]" <?php checked( $item->df_mega_menu_remove_link ); ?>/>
							<?php _ex( 'Remove link', 'edit menu walker', 'woothemes' ); ?>
						</label>
					</p>
					<p class="field-df-new-row">
						<label for="edit-menu-item-df-new-row-<?php echo $item_id; ?>">
							<input id="edit-menu-item-df-new-row-<?php echo $item_id; ?>" type="checkbox" name="menu-item-df-new-row[<?php echo $item_id; ?>]" <?php checked( $item->df_mega_menu_new_row ); ?>/>
							<?php _ex( 'This item should start a new row', 'edit menu walker', 'woothemes' ); ?>
						</label>
					</p>

					<!-- third level -->
					<p class="field-df-new-column">
						<label for="edit-menu-item-df-new-column-<?php echo $item_id; ?>">
							<input id="edit-menu-item-df-new-column-<?php echo $item_id; ?>" type="checkbox" name="menu-item-df-new-column[<?php echo $item_id; ?>]" <?php checked( $item->df_mega_menu_new_column ); ?>/>
							<?php _ex( 'This item should start a new column', 'edit menu walker', 'woothemes' ); ?>
						</label>
					</p>

				</div>

				<?php do_action( 'df_edit_menu_walker_print_item_settings', $item, $depth, $args, $id, $item_id ); ?>

				<!-- DF Mega Menu End -->

				<p class="field-move hide-if-no-js description description-wide">
					<label>
						<span><?php _e( 'Move', 'woothemes' ); ?></span>
						<a href="#" class="menus-move-up"><?php _e( 'Up one', 'woothemes' ); ?></a>
						<a href="#" class="menus-move-down"><?php _e( 'Down one', 'woothemes' ); ?></a>
						<a href="#" class="menus-move-left"></a>
						<a href="#" class="menus-move-right"></a>
						<a href="#" class="menus-move-top"><?php _e( 'To the top', 'woothemes' ); ?></a>
					</label>
				</p>

				<div class="menu-item-actions description-wide submitbox">
					<?php if( 'custom' != $item->type && $original_title !== false ) : ?>
						<p class="link-to-original">
							<?php printf( __('Original: %s', 'woothemes' ), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
						</p>
					<?php endif; ?>
					<a class="item-delete submitdelete deletion" id="delete-<?php echo $item_id; ?>" href="<?php
					echo wp_nonce_url(
						add_query_arg(
							array(
								'action' => 'delete-menu-item',
								'menu-item' => $item_id,
							),
							admin_url( 'nav-menus.php' )
						),
						'delete-menu_item_' . $item_id
					); ?>"><?php _e( 'Remove', 'woothemes' ); ?></a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo $item_id; ?>" href="<?php echo esc_url( add_query_arg( array( 'edit-menu-item' => $item_id, 'cancel' => time() ), admin_url( 'nav-menus.php' ) ) );
						?>#menu-item-settings-<?php echo $item_id; ?>"><?php _e('Cancel', 'woothemes'); ?></a>
				</div>

				<input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo $item_id; ?>]" value="<?php echo $item_id; ?>" />
				<input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
				<input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
				<input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
				<input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
				<input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
			</div><!-- .menu-item-settings-->
			<ul class="menu-item-transport"></ul>
		<?php
		$output .= ob_get_clean();
	}

} // Walker_Nav_Menu_Edit

if ( ! function_exists( 'navmenu_uploader' ) ) :

function navmenu_uploader( $_id, $_value, $_mode = 'uri_only', $_desc = '', $_name = '' ) {

	//$df_options = get_theme_mod( 'df_options' );
	
	// Gets the unique option id
	//$option_name = $df_options['id'];

	$output = '';
	$id = '';
	$class = '';
	$int = '';
	$value = '';
	$name = '';
	$att_id = 0;

	$id = strip_tags( strtolower( $_id ) );
	
	// If a value is passed and we don't have a stored value, use the value that's passed through.
	if ( !empty( $_value ) ) {
		$value = $_value;

		// In case it's array
		if ( is_array($value) ) {
			$att_id = !empty( $value[1] ) ? absint($value[1]) : 0;
			$value = !empty( $value[0] ) ? $value[0] : '';
		}
	}

	if ( empty($_mode) ) { $_mode = 'uri_only'; }

	// if ($_name != '') { $name = $_name;
	// } else { $name = $option_name.'['.$id.']'; }

		if ($_name != '') { $name = $_name;
	} else { $name = $id; }
	
	if ( $value ) { $class = ' has-file'; }

	$uploader_name = $name;

	if ( 'full' == $_mode ) {
		$uploader_name .= '[uri]';
		$output .= '<input type="hidden" class="upload-id" name="'.$name.'[id]" value="' . $att_id . '" />' . "\n";
	}

	$output .= '<input id="' . $id . '" class="upload' . $class . '" type="text" name="'.$uploader_name.'" value="' . $value . '" placeholder="' . __('No file chosen', 'woothemes') .'" readonly="readonly"/>' . "\n";
	
	if ( function_exists( 'wp_enqueue_media' ) ) {
		if ( ( $value == '' ) ) {
			$output .= '<input id="upload-' . $id . '" class="upload-button uploader-button button" type="button" value="' . __( 'Upload', 'woothemes' ) . '" />' . "\n";
		} else {
			$output .= '<input id="remove-' . $id . '" class="remove-file uploader-button button" type="button" value="' . __( 'Remove', 'woothemes' ) . '" />' . "\n";
		}
	} else {
		$output .= '<p><i>' . __( 'Upgrade your version of WordPress for full media support.', 'woothemes' ) . '</i></p>';
	}
	
	if ( $_desc != '' ) {
		$output .= '<span class="of-metabox-desc">' . $_desc . '</span>' . "\n";
	}
	
	$output .= '<div class="screenshot" id="' . $id . '-image">' . "\n";
	
	if ( $value != '' ) { 
		$remove = '<a class="remove-image">Remove</a>';

		$image = preg_match( '/(^.*\.jpg|jpeg|png|gif|ico*)/i', $value );
		if ( $image ) {
			$output .= '<img src="' . $value . '" alt="" />' . $remove;
		} else {
			$parts = explode( "/", $value );
			for( $i = 0; $i < sizeof( $parts ); ++$i ) {
				$title = $parts[$i];
			}

			// No output preview if it's not an image.			
			$output .= '';
		
			// Standard generic output if it's not an image.	
			$title = __( 'View File', 'woothemes' );
			$output .= '<div class="no-image"><span class="file_link"><a href="' . $value . '" target="_blank" rel="external">'.$title.'</a></span></div>';
		}	
	}
	$output .= '</div>' . "\n";
	return $output;
}

endif;
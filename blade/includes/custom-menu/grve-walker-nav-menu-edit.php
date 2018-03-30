<?php

/**
 * Create HTML list of nav menu input items.
 *
 * @package WordPress
 * @since 3.0.0
 * @uses Walker_Nav_Menu
 */
class Blade_Grve_Walker_Nav_Menu_Edit extends Walker_Nav_Menu {
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
	public function start_lvl( &$output, $depth = 0, $args = array() ) {}

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
	public function end_lvl( &$output, $depth = 0, $args = array() ) {}

	/**
	 * Start the element output.
	 *
	 * @see Walker_Nav_Menu::start_el()
	 * @since 3.0.0
	 *
	 * @global int $_wp_nav_menu_max_depth
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Menu item data object.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   Not used.
	 * @param int    $id     Not used.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
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
			$original_title = get_the_title( $original_object->ID );
		} elseif ( 'post_type_archive' == $item->type ) {
			$original_object = get_post_type_object( $item->object );
			if ( $original_object ) {
				$original_title = $original_object->labels->archives;
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
			$title = sprintf( esc_html__( '%s (Invalid)', 'blade' ), $item->title );
		} elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
			$classes[] = 'pending';
			/* translators: %s: title of menu item in draft status */
			$title = sprintf( esc_html__( '%s (Pending)', 'blade' ), $item->title );
		}

		$title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;

		$submenu_text = '';
		if ( 0 == $depth )
			$submenu_text = 'style="display: none;"';

		?>
		<li id="menu-item-<?php echo esc_attr( $item_id ); ?>" class="<?php echo implode(' ', $classes ); ?>">
			<div class="menu-item-bar">
				<div class="menu-item-handle">
					<span class="item-title"><span class="menu-item-title"><?php echo esc_html( $title ); ?></span> <span class="is-submenu" <?php echo esc_attr( $submenu_text ); ?>><?php esc_html_e( 'sub item', 'blade' ); ?></span></span>
					<span class="item-controls">
						<span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
						<span class="item-type grve-item-type-megamenu"><?php esc_html_e( '(Mega Menu)', 'blade' ); ?></span>
						<span class="item-order hide-if-js">
							<a href="<?php
								echo esc_url( wp_nonce_url(
									add_query_arg(
										array(
											'action' => 'move-up-menu-item',
											'menu-item' => $item_id,
										),
										remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
									),
									'move-menu_item'
								));
							?>" class="item-move-up"><abbr title="<?php esc_attr_e( 'Move up', 'blade' ); ?>">&#8593;</abbr></a>
							|
							<a href="<?php
								echo esc_url( wp_nonce_url(
									add_query_arg(
										array(
											'action' => 'move-down-menu-item',
											'menu-item' => $item_id,
										),
										remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
									),
									'move-menu_item'
								));
							?>" class="item-move-down"><abbr title="<?php esc_attr_e( 'Move down', 'blade' ); ?>">&#8595;</abbr></a>
						</span>
						<a class="item-edit" id="edit-<?php echo esc_attr( $item_id ); ?>" title="<?php esc_attr_e( 'Edit Menu Item', 'blade' ); ?>" href="<?php
							echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
						?>"><?php esc_html_e( 'Edit Menu Item', 'blade' ); ?></a>
					</span>
				</div>
			</div>

			<div class="menu-item-settings wp-clearfix" id="menu-item-settings-<?php echo esc_attr( $item_id ); ?>">
				<?php if ( 'custom' == $item->type ) : ?>
					<p class="field-url description description-wide">
						<label for="edit-menu-item-url-<?php echo esc_attr( $item_id ); ?>">
							<?php esc_html_e( 'URL', 'blade' ); ?><br />
							<input type="text" id="edit-menu-item-url-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
						</label>
					</p>
				<?php endif; ?>
				<p class="description description-wide">
					<label for="edit-menu-item-title-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'Navigation Label', 'blade' ); ?><br />
						<input type="text" id="edit-menu-item-title-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
					</label>
				</p>
				<p class="field-title-attribute description description-wide">
					<label for="edit-menu-item-attr-title-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'Title Attribute', 'blade' ); ?><br />
						<input type="text" id="edit-menu-item-attr-title-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
					</label>
				</p>
				<p class="field-link-target description">
					<label for="edit-menu-item-target-<?php echo esc_attr( $item_id ); ?>">
						<input type="checkbox" id="edit-menu-item-target-<?php echo esc_attr( $item_id ); ?>" value="_blank" name="menu-item-target[<?php echo esc_attr( $item_id ); ?>]"<?php checked( $item->target, '_blank' ); ?> />
						<?php esc_html_e( 'Open link in a new window/tab', 'blade' ); ?>
					</label>
				</p>
				<p class="field-css-classes description description-thin">
					<label for="edit-menu-item-classes-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'CSS Classes (optional)', 'blade' ); ?><br />
						<input type="text" id="edit-menu-item-classes-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
					</label>
				</p>
				<p class="field-xfn description description-thin">
					<label for="edit-menu-item-xfn-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'Link Relationship (XFN)', 'blade' ); ?><br />
						<input type="text" id="edit-menu-item-xfn-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
					</label>
				</p>
				<p class="field-description description description-wide">
					<label for="edit-menu-item-description-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'Description', 'blade' ); ?><br />
						<textarea id="edit-menu-item-description-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo esc_attr( $item_id ); ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
						<span class="description"><?php esc_html_e( 'The description will be displayed in the menu if the current theme supports it.', 'blade' ); ?></span>
					</label>
				</p>
				<p class="grve-field-custom description description-wide">
					<label for="edit-menu-item-grve-megamenu-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'Mega Menu', 'blade' ); ?><br />
						<select class="widefat grve-menu-item-megamenu" id="edit-menu-grve-item-megamenu-<?php echo esc_attr($item_id); ?>" data-grve-menu-item data-grve-menu-name="<?php echo esc_attr( '_grve_menu_item_megamenu_' . $item_id ); ?>">
							<option value="" <?php selected( "", $item->grve_megamenu ); ?>><?php esc_html_e( 'None', 'blade' ); ?></option>
							<option value="2" <?php selected( "2", $item->grve_megamenu ); ?>><?php esc_html_e( '2 Columns', 'blade' ); ?></option>
							<option value="3" <?php selected( "3", $item->grve_megamenu ); ?>><?php esc_html_e( '3 Columns', 'blade' ); ?></option>
							<option value="4" <?php selected( "4", $item->grve_megamenu ); ?>><?php esc_html_e( '4 Columns', 'blade' ); ?></option>
							<option value="5" <?php selected( "5", $item->grve_megamenu ); ?>><?php esc_html_e( '5 Columns', 'blade' ); ?></option>
							<option value="6" <?php selected( "6", $item->grve_megamenu ); ?>><?php esc_html_e( '6 Columns', 'blade' ); ?></option>
						</select>
						<span class="description"><?php esc_html_e( 'Mega Menu should be used only on first level menu items.', 'blade' ); ?></span>
					</label>
				</p>
				<p class="grve-field-custom description description-wide">
					<label for="edit-menu-item-grve-link-mode-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'Link Mode', 'blade' ); ?><br />
						<select class="widefat" id="edit-menu-item-grve-link-mode-<?php echo esc_attr($item_id); ?>" data-grve-menu-item data-grve-menu-name="<?php echo esc_attr( '_grve_menu_item_link_mode_' . $item_id ); ?>">
							<option value="" <?php selected( "", $item->grve_link_mode ); ?>><?php esc_html_e( 'Default', 'blade' ); ?></option>
							<option value="no-link" <?php selected( "no-link", $item->grve_link_mode ); ?>><?php esc_html_e( 'No Link', 'blade' ); ?></option>
							<option value="hidden" <?php selected( "hidden", $item->grve_link_mode ); ?>><?php esc_html_e( 'Hidden', 'blade' ); ?></option>
						</select>
					</label>
				</p>
				<p class="grve-field-custom description description-wide">
					<label for="edit-menu-item-grve-link-classes-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'Link CSS Classes', 'blade' ); ?><br />
						<input type="text" id="edit-menu-item-grve-link-classes-<?php echo esc_attr( $item_id ); ?>" class="widefat code" value="<?php echo esc_attr( $item->grve_link_classes ); ?>" data-grve-menu-item data-grve-menu-name="<?php echo esc_attr( '_grve_menu_item_link_classes_' . $item_id ); ?>"/>
					</label>
				</p>
				<p class="grve-field-custom description description-wide">
					<label for="edit-menu-item-grve-label-text-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'Label Text', 'blade' ); ?><br />
						<input id="edit-menu-item-grve-label-text-<?php echo esc_attr( $item_id ); ?>" type="text" class="widefat"  value="<?php echo esc_attr( $item->grve_label_text ); ?>" data-grve-menu-item data-grve-menu-name="<?php echo esc_attr( '_grve_menu_item_label_text_' . $item_id ); ?>"/>
					</label>
				</p>
				<p class="grve-field-custom description description-wide">
					<label for="edit-menu-item-grve-style-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'Menu item Style', 'blade' ); ?><br />
						<select class="widefat grve-menu-item-style" id="edit-menu-grve-item-style-<?php echo esc_attr($item_id); ?>" data-grve-menu-item data-grve-menu-name="<?php echo esc_attr( '_grve_menu_item_style_' . $item_id ); ?>">
							<option value="" <?php selected( "", $item->grve_style ); ?>><?php esc_html_e( 'Default', 'blade' ); ?></option>
							<option value="button" <?php selected( "button", $item->grve_style ); ?>><?php esc_html_e( 'Button', 'blade' ); ?></option>
						</select>
					</label>
				</p>
				<p class="grve-field-custom description description-wide grve-menu-item-color-container">
					<label for="edit-menu-item-grve-color-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'Menu Item Color', 'blade' ); ?><br />
						<select class="widefat" id="edit-menu-grve-item-color-<?php echo esc_attr($item_id); ?>" data-grve-menu-item data-grve-menu-name="<?php echo esc_attr( '_grve_menu_item_color_' . $item_id ); ?>">
							<option value="" <?php selected( "", $item->grve_color ); ?>><?php esc_html_e( 'Default', 'blade' ); ?></option>
							<?php blade_grve_print_media_button_color_selection( $item->grve_color ); ?>
						</select>
					</label>
				</p>
				<p class="grve-field-custom description description-wide grve-menu-item-hover-color-container">
					<label for="edit-menu-item-grve-hover-color-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'Menu Item Hover color', 'blade' ); ?><br />
						<select class="widefat" id="edit-menu-grve-item-hover-color-<?php echo esc_attr($item_id); ?>" data-grve-menu-item data-grve-menu-name="<?php echo esc_attr( '_grve_menu_item_hover_color_' . $item_id ); ?>">
							<option value="" <?php selected( "", $item->grve_hover_color ); ?>><?php esc_html_e( 'Default', 'blade' ); ?></option>
							<?php blade_grve_print_media_button_color_selection( $item->grve_hover_color ); ?>
						</select>
					</label>
				</p>
				<?php
					global $blade_grve_awsome_fonts_list;
				?>
				<p class="grve-field-custom description description-wide">
					<label for="edit-menu-item-grve-icon-fontawesome-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'Icon', 'blade' ); ?><br />
						<select class="widefat" id="edit-menu-item-grve-icon-fontawesome-<?php echo esc_attr($item_id); ?>" data-grve-menu-item data-grve-menu-name="<?php echo esc_attr( '_grve_menu_item_icon_fontawesome_' . $item_id ); ?>">
							<option value="" <?php selected( "", $item->grve_icon_fontawesome ); ?>><?php esc_html_e( 'None', 'blade' ); ?></option>
						<?php
							$icons_array = $blade_grve_awsome_fonts_list;
							foreach ($icons_array as $icon) {
						?>
								<option value="fa fa-<?php echo esc_attr( $icon ); ?>" <?php selected( $item->grve_icon_fontawesome, 'fa fa-' . $icon ); ?>><?php echo esc_html( $icon ); ?></option>
						<?php
							}
						?>
						</select>
					</label>
				</p>
				<p class="field-move hide-if-no-js description description-wide">
					<label>
						<span><?php esc_html_e( 'Move', 'blade' ); ?></span>
						<a href="#" class="menus-move menus-move-up" data-dir="up"><?php esc_html_e( 'Up one', 'blade' ); ?></a>
						<a href="#" class="menus-move menus-move-down" data-dir="down"><?php esc_html_e( 'Down one', 'blade' ); ?></a>
						<a href="#" class="menus-move menus-move-left" data-dir="left"></a>
						<a href="#" class="menus-move menus-move-right" data-dir="right"></a>
						<a href="#" class="menus-move menus-move-top" data-dir="top"><?php esc_html_e( 'To the top', 'blade' ); ?></a>
					</label>
				</p>

				<div class="menu-item-actions description-wide submitbox">
					<?php if ( 'custom' != $item->type && $original_title !== false ) : ?>
						<p class="link-to-original">
							<?php printf( esc_html__('Original: %s', 'blade' ), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
						</p>
					<?php endif; ?>
					<a class="item-delete submitdelete deletion" id="delete-<?php echo esc_attr( $item_id ); ?>" href="<?php
					echo esc_url( wp_nonce_url(
						add_query_arg(
							array(
								'action' => 'delete-menu-item',
								'menu-item' => $item_id,
							),
							admin_url( 'nav-menus.php' )
						),
						'delete-menu_item_' . $item_id
					)); ?>"><?php esc_html_e( 'Remove', 'blade' ); ?></a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo esc_attr( $item_id ); ?>" href="<?php echo esc_url( add_query_arg( array( 'edit-menu-item' => $item_id, 'cancel' => time() ), admin_url( 'nav-menus.php' ) ) );
						?>#menu-item-settings-<?php echo esc_attr( $item_id ); ?>"><?php esc_html_e( 'Cancel', 'blade' ); ?></a>
				</div>

				<input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item_id ); ?>" />
				<input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
				<input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
				<input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
				<input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
				<input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
			</div><!-- .menu-item-settings-->
			<ul class="menu-item-transport"></ul>
		<?php
		$output .= ob_get_clean();
	}

} // Blade_Grve_Walker_Nav_Menu_Edit

//Omit closing PHP tag to avoid accidental whitespace output errors.

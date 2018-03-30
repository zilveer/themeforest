<?php

function barcelona_setup_nav_menu_item( $item ) {

	$item->barcelonamegamenu = get_post_meta( $item->ID, '_menu_item_barcelonamegamenu', true );

	if ( $item->barcelonamegamenu != '0' ) {
		$item->barcelonamegamenu = '1';
	}

	return $item;

}
add_filter( 'wp_setup_nav_menu_item', 'barcelona_setup_nav_menu_item' );

function barcelona_update_nav_menu_item( $menu_id, $menu_item_db_id ) {

	$barcelona_menu_item_megamenu = isset( $_POST['menu-item-barcelonamegamenu'][ $menu_item_db_id ] ) ? $_POST['menu-item-barcelonamegamenu'][ $menu_item_db_id ] : '0';

	update_post_meta( $menu_item_db_id, '_menu_item_barcelonamegamenu', sanitize_key( $barcelona_menu_item_megamenu ) );

}
add_action( 'wp_update_nav_menu_item', 'barcelona_update_nav_menu_item', 10, 2 );

function barcelona_edit_megamenu_walker( $class, $menu_id ) {

	$barcelona_nav_menu_locations = get_nav_menu_locations();

	if ( $class == 'Walker_Nav_Menu_Edit' && array_key_exists( 'main', $barcelona_nav_menu_locations ) && $barcelona_nav_menu_locations['main'] == $menu_id ) {
		return 'barcelona_edit_nav_menu_walker';
	}

	return $class;

}
add_filter( 'wp_edit_nav_menu_walker', 'barcelona_edit_megamenu_walker', 10, 2 );

class barcelona_edit_nav_menu_walker extends  Walker_Nav_Menu {

	public function start_lvl( &$output, $depth = 0, $args = array() ) {}

	public function end_lvl( &$output, $depth = 0, $args = array() ) {}

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
		}

		$classes = array(
			'menu-item menu-item-depth-' . intval( $depth ),
			'menu-item-' . esc_attr( $item->object ),
			'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
		);

		$title = $item->title;

		if ( ! empty( $item->_invalid ) ) {
			$classes[] = 'menu-item-invalid';
			/* translators: %s: title of menu item which is invalid */
			$title = sprintf( esc_html__( '%s (Invalid)', 'default' ), $item->title );
		} elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
			$classes[] = 'pending';
			/* translators: %s: title of menu item in draft status */
			$title = sprintf( esc_html__( '%s (Pending)', 'default' ), $item->title );
		}

		$title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;

	?>
	<li id="menu-item-<?php echo sanitize_html_class( $item_id ); ?>" class="<?php echo esc_attr( implode(' ', $classes ) ); ?>">
		<dl class="menu-item-bar">
			<dt class="menu-item-handle">
				<span class="item-title"><span class="menu-item-title"><?php echo esc_html( $title ); ?></span> <span class="is-submenu"<?php echo ( $depth == 0 ) ? ' style="display: none;"' : ''; ?>><?php esc_html_e( 'sub item', 'default' ); ?></span></span>
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
							?>" class="item-move-up"><abbr title="<?php esc_attr_e( 'Move up', 'default' ); ?>">&#8593;</abbr></a>
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
							?>" class="item-move-down"><abbr title="<?php esc_attr_e( 'Move down', 'default' ); ?>">&#8595;</abbr></a>
						</span>
						<a class="item-edit" id="edit-<?php echo esc_attr( $item_id ); ?>" title="<?php esc_attr_e( 'Edit Menu Item', 'default' ); ?>" href="<?php
						echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? esc_url( admin_url( 'nav-menus.php' ) ) : esc_url( add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) ) );
						?>"><?php esc_html_e( 'Edit Menu Item', 'default' ); ?></a>
					</span>
			</dt>
		</dl>

		<div class="menu-item-settings" id="menu-item-settings-<?php echo esc_attr( $item_id ); ?>">
			<?php if( 'custom' == $item->type ) : ?>
				<p class="field-url description description-wide">
					<label for="edit-menu-item-url-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'URL', 'default' ); ?><br />
						<input type="text" id="edit-menu-item-url-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
					</label>
				</p>
			<?php endif; ?>
			<p class="description description-thin">
				<label for="edit-menu-item-title-<?php echo esc_attr( $item_id ); ?>">
					<?php esc_html_e( 'Navigation Label', 'default' ); ?><br />
					<input type="text" id="edit-menu-item-title-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
				</label>
			</p>
			<p class="description description-thin">
				<label for="edit-menu-item-attr-title-<?php echo esc_attr( $item_id ); ?>">
					<?php esc_html_e( 'Title Attribute', 'default' ); ?><br />
					<input type="text" id="edit-menu-item-attr-title-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
				</label>
			</p>
			<p class="field-link-target description">
				<label for="edit-menu-item-target-<?php echo esc_attr( $item_id ); ?>">
					<input type="checkbox" id="edit-menu-item-target-<?php echo esc_attr( $item_id ); ?>" value="_blank" name="menu-item-target[<?php echo esc_attr( $item_id ); ?>]"<?php checked( $item->target, '_blank' ); ?> />
					<?php esc_html_e( 'Open link in a new window/tab', 'default' ); ?>
				</label>
			</p>
			<p class="field-css-classes description description-thin">
				<label for="edit-menu-item-classes-<?php echo esc_attr( $item_id ); ?>">
					<?php esc_html_e( 'CSS Classes (optional)', 'default' ); ?><br />
					<input type="text" id="edit-menu-item-classes-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
				</label>
			</p>
			<p class="field-xfn description description-thin">
				<label for="edit-menu-item-xfn-<?php echo esc_attr( $item_id ); ?>">
					<?php esc_html_e( 'Link Relationship (XFN)', 'default' ); ?><br />
					<input type="text" id="edit-menu-item-xfn-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
				</label>
			</p>
			<?php if ( 'taxonomy' == $item->type && 0 == $depth ) { ?>
				<p class="field-barcelonamegamenu description description-thin">
					<label for="edit-menu-item-barcelonamegamenu-<?php echo esc_attr( $item_id ); ?>">
						<input type="checkbox" id="edit-menu-item-barcelonamegamenu-<?php echo esc_attr( $item_id ); ?>" value="1" name="menu-item-barcelonamegamenu[<?php echo esc_attr( $item_id ); ?>]"<?php checked( isset( $item->barcelonamegamenu) ? $item->barcelonamegamenu : '1', '1' ); ?> />
						<?php esc_html_e( 'Show Mega Menu', 'barcelona' ); ?>
					</label>
				</p>
			<?php } ?>
			<p class="field-description description description-wide">
				<label for="edit-menu-item-description-<?php echo esc_attr( $item_id ); ?>">
					<?php esc_html_e( 'Description', 'default' ); ?><br />
					<textarea id="edit-menu-item-description-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo esc_attr( $item_id ); ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
					<span class="description"><?php esc_html_e( 'The description will be displayed in the menu if the current theme supports it.', 'default' ); ?></span>
				</label>
			</p>

			<p class="field-move hide-if-no-js description description-wide">
				<label>
					<span><?php esc_html_e( 'Move', 'default' ); ?></span>
					<a href="#" class="menus-move menus-move-up" data-dir="up"><?php esc_html_e( 'Up one', 'default' ); ?></a>
					<a href="#" class="menus-move menus-move-down" data-dir="down"><?php esc_html_e( 'Down one', 'default' ); ?></a>
					<a href="#" class="menus-move menus-move-left" data-dir="left"></a>
					<a href="#" class="menus-move menus-move-right" data-dir="right"></a>
					<a href="#" class="menus-move menus-move-top" data-dir="top"><?php esc_html_e( 'To the top', 'default' ); ?></a>
				</label>
			</p>

			<div class="menu-item-actions description-wide submitbox">
				<?php if( 'custom' != $item->type && $original_title !== false ) : ?>
					<p class="link-to-original">
						<?php printf( esc_html__( 'Original: %s', 'default' ), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
					</p>
				<?php endif; ?>
				<a class="item-delete submitdelete deletion" id="delete-<?php echo esc_attr( $item_id ); ?>" href="<?php
				echo wp_nonce_url(
					add_query_arg(
						array(
							'action' => 'delete-menu-item',
							'menu-item' => $item_id,
						),
						admin_url( 'nav-menus.php' )
					),
					'delete-menu_item_' . $item_id
				); ?>"><?php esc_html_e( 'Remove', 'default' ); ?></a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo esc_attr( $item_id ); ?>" href="<?php echo esc_url( add_query_arg( array( 'edit-menu-item' => $item_id, 'cancel' => time() ), admin_url( 'nav-menus.php' ) ) );
				?>#menu-item-settings-<?php echo esc_attr( $item_id ); ?>"><?php esc_html_e( 'Cancel', 'default' ); ?></a>
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

}

class barcelona_megamenu_walker extends Walker_Nav_Menu {

	/**
	 * Starts the list before the elements are added.
	 *
	 * @see Walker::start_lvl()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {

		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"sub-menu\">\n";

	}

	/**
	 * Ends the list of after the elements are added.
	 *
	 * @see Walker::end_lvl()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	function end_lvl( &$output, $depth = 0, $args = array() ) {

		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";

	}

	/**
	 * Start the element output.
	 *
	 * @see Walker::start_el()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Menu item data object.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 * @param int    $id     Current item ID.
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . intval( $item->ID );

		$barcelona_has_mega_menu = ( $item->menu_item_parent == '0' && $item->barcelonamegamenu == '1' );

		if ( $barcelona_has_mega_menu ) {
			$classes = array_unique( array_merge( $classes, array( 'menu-item-mega-menu', 'menu-item-has-children' ) ) );
		}

		/**
		 * Filter the CSS class(es) applied to a menu item's list item element.
		 *
		 * @since 3.0.0
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param array  $classes The CSS classes that are applied to the menu item's `<li>` element.
		 * @param object $item    The current menu item.
		 * @param array  $args    An array of {@see wp_nav_menu()} arguments.
		 * @param int    $depth   Depth of menu item. Used for padding.
		 */
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		/**
		 * Filter the ID applied to a menu item's list item element.
		 *
		 * @since 3.0.1
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param string $menu_id The ID that is applied to the menu item's `<li>` element.
		 * @param object $item    The current menu item.
		 * @param array  $args    An array of {@see wp_nav_menu()} arguments.
		 * @param int    $depth   Depth of menu item. Used for padding.
		 */
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names .'>';

		/**
		 * Filter the HTML attributes applied to a menu item's anchor element.
		 *
		 * @since 3.6.0
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param array $atts {
		 *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
		 *
		 *     @type string $title  Title attribute.
		 *     @type string $target Target attribute.
		 *     @type string $rel    The rel attribute.
		 *     @type string $href   The href attribute.
		 * }
		 * @param object $item  The current menu item.
		 * @param array  $args  An array of {@see wp_nav_menu()} arguments.
		 * @param int    $depth Depth of menu item. Used for padding.
		 */
		$atts = array();

		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		/** This filter is documented in wp-includes/post-template.php */
		$item_output .= $args->link_before . do_shortcode( $item->title ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		/**
		 * Filter a menu item's starting output.
		 *
		 * The menu item's starting output only includes `$args->before`, the opening `<a>`,
		 * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
		 * no filter for modifying the opening and closing `<li>` for a menu item.
		 *
		 * @since 3.0.0
		 *
		 * @param string $item_output The menu item's starting HTML output.
		 * @param object $item        Menu item data object.
		 * @param int    $depth       Depth of menu item. Used for padding.
		 * @param array  $args        An array of {@see wp_nav_menu()} arguments.
		 */
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

		if ( $barcelona_has_mega_menu ) {

			$args = array(
				'cat'                 => $item->object_id,
				'posts_per_page'      => '4',
				'post_status'         => 'publish',
				'ignore_sticky_posts' => 0
			);

			/*
			 * Posts Ordering
			 */
			switch ( barcelona_get_option( 'mm_orderby' ) ) {
				case 'views':
					$args['orderby'] = 'meta_value_num';
					$args['meta_key'] = '_barcelona_views';
					break;
				case 'comments':
					$args['orderby'] = 'comment_count';
					break;
				case 'votes':
					$args['orderby'] = 'meta_value_num';
					$args['meta_key'] = '_barcelona_vote_up';
					break;
				case 'random':
					$args['orderby'] = 'rand';
					break;
				case 'posts':
					$args['orderby'] = 'post__in';
					break;
				default:
					$args['orderby'] = 'date';
			}

			$args['order'] = ( barcelona_get_option( 'mm_order' ) != 'asc' ) ? 'DESC' : 'ASC';

			$latest_posts = new WP_Query( $args );
			$post_ids = array();
			$i = 0;

			if ( $latest_posts->have_posts() ):

				$barcelona_mm_posts = '<div class="posts-wrapper row">';

				while ( $latest_posts->have_posts() ): $latest_posts->the_post();

					$post_ids[] = get_the_ID();

					$barcelona_mm_posts .= '<div class="col col-xs-3">
											<div class="post-summary post-format-'. sanitize_html_class( barcelona_get_post_format() ) .'">
												<div class="post-image">
													<a href="'. esc_url( get_the_permalink() ) .'" title="'. esc_attr( get_the_title() ) .'">'. barcelona_psum_overlay( false ) . barcelona_get_thumbnail( 'barcelona-sm' ) .'</a>
												</div>
												<div class="post-details">
													<h2 class="post-title">
														<a href="'. esc_url( get_the_permalink() ) .'">'. esc_html( get_the_title() ) .'</a>
													</h2>
													'. barcelona_post_meta( barcelona_get_option( 'mm_post_meta_choices' ), false, false ) .'
												</div>
											</div>
										</div>';

					$i++;

					if ( $i == 4 ) {
						break;
					}

				endwhile;
				wp_reset_postdata();

				$barcelona_mm_posts .= '</div>';

				// Mega Menu Bottom
				$barcelona_mm_bottom = '<div class="mm-bottom row"><div class="col col-sm-9">';

				// Show popular tags under mega menu
				if ( barcelona_get_option( 'show_tags_under_mm' ) == 'on' ) {

					$tags = array();

					foreach ( $post_ids as $k ) {

						$post_tags = wp_get_post_tags( $k, array( 'orderby' => 'count', 'order' => 'DESC' ) );

						foreach ( $post_tags as $tag ) {
							$tags[ $tag->term_id ] = $tag;
						}

					}

					if ( count( $tags ) ) {

						usort( $tags, function ( $a, $b ) {
							return $a->count < $b->count;
						} );

						$tags = array_slice( $tags, 0, 5 );

						$barcelona_mm_bottom .= '<div class="tag-list"><div class="title">' . esc_html__( 'Popular Tags:', 'barcelona' ) . '</div><div class="list">';

						foreach ( $tags as $tag ) {
							$barcelona_mm_bottom .= '<a href="' . esc_url( get_term_link( $tag ) ) . '">' . esc_html( $tag->name ) . '</a>,';
						}

						$barcelona_mm_bottom = rtrim( $barcelona_mm_bottom, ',' ) . '</div></div>';

					}

				}

				// Add "see all" link to the bottom
				$barcelona_mm_bottom .= '</div><div class="col col-sm-3"><div class="see-all"><a href="' . esc_url( $item->url ) . '">' . esc_html__( 'See All', 'barcelona' ) . '</a></div></div>';

				// Close .mm-bottom
				$barcelona_mm_bottom .= '</div>';

				$output .= '<div class="mega-menu">' . $barcelona_mm_posts . $barcelona_mm_bottom . '</div>';

			endif; // have_posts

		}

	}

	/**
	 * Ends the element output, if needed.
	 *
	 * @see Walker::end_el()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Page data object. Not used.
	 * @param int    $depth  Depth of page. Not Used.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$output .= "</li>\n";
	}

}

/*
 * Add search button to main menu
 */
function barcelona_add_search_button_menu( $items, $args ) {

	if ( $args->theme_location == 'main' && barcelona_get_option( 'show_search_button' ) == 'on' ) {

		$items .= '<li class="search"><button class="btn btn-search"><span class="fa fa-search"></span></button></li>';

	}

	return $items;

}
add_filter( 'wp_nav_menu_items', 'barcelona_add_search_button_menu', 10, 2 );
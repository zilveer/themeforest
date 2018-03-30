<?php

class tie_mega_menu_walker extends Walker_Nav_Menu {

	private $tie_megamenu_type 			= '';
	private $tie_megamenu_icon 			= '';
	private $tie_megamenu_image 		= '';
	private $tie_megamenu_position 		= '';
	private $tie_megamenu_position_y 	= '';
	private $tie_megamenu_repeat 		= '';
	private $tie_megamenu_min_height 	= '';
	private $tie_megamenu_padding_left	= '';
	private $tie_megamenu_padding_right = '';
	private $tie_has_children 			= '';

	/**
	 * Starts the list before the elements are added.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);

		if( $depth === 0 && $this->tie_megamenu_type == 'links' ){
			$output .= "\n$indent<ul class=\"sub-menu-columns\">\n";
		}
		elseif( $depth === 1 && $this->tie_megamenu_type == 'links' ){
			$output .= "\n$indent<ul class=\"sub-menu-columns-item\">\n";
		}
		elseif( $depth === 0 && $this->tie_megamenu_type == 'sub-posts' ){
			$output .= "\n$indent<ul class=\"sub-menu mega-cat-more-links\">\n";
		}
		elseif( $depth === 0 && $this->tie_megamenu_type == 'recent' ){
			$output .= "\n$indent<ul class=\"mega-recent-featured-list sub-list\">\n";
		}
		else{
			$output .= "\n$indent<ul class=\"sub-menu menu-sub-content\">\n";
		}
	}


	/**
	 * Ends the list of after the elements are added.
	 */
	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";

	}


	/**
	 * Start the element output.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		/**
		 * Filter the CSS class(es) applied to a menu item's <li>.
		 */
		$class_names = join( " " , apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );


	//By TieLabs ===========
		$a_class = $item_output = '';

		// Define the mega vars
		if( $depth === 0 ){

			$this->tie_has_children = 0;
			if( !empty( $args->has_children ) )
				$this->tie_has_children           = $args->has_children;

			$this->tie_megamenu_type 	      = get_post_meta( $item->ID, 'tie_megamenu_type', 			true );
			$this->tie_megamenu_columns       = get_post_meta( $item->ID, 'tie_megamenu_columns', 		true );
			$this->tie_megamenu_image         = get_post_meta( $item->ID, 'tie_megamenu_image', 		true );
			$this->tie_megamenu_position      = get_post_meta( $item->ID, 'tie_megamenu_position', 		true );
			$this->tie_megamenu_position_y    = get_post_meta( $item->ID, 'tie_megamenu_position_y', 	true );
			$this->tie_megamenu_repeat 	      = get_post_meta( $item->ID, 'tie_megamenu_repeat',		true );
			$this->tie_megamenu_min_height    = get_post_meta( $item->ID, 'tie_megamenu_min_height',	true );
			$this->tie_megamenu_padding_left  = get_post_meta( $item->ID, 'tie_megamenu_padding_left',	true );
			$this->tie_megamenu_padding_right = get_post_meta( $item->ID, 'tie_megamenu_padding_right', true );
		}
		$this->tie_megamenu_icon = get_post_meta( $item->ID, 'tie_megamenu_icon', true);

		//Menu Classes
		if( $depth === 0 && !empty( $this->tie_megamenu_type ) && $this->tie_megamenu_type != 'disable' ){
			$class_names .= ' mega-menu';

			if(  $this->tie_megamenu_type == 'sub-posts' &&  $item->object == 'category' ){
				$class_names .= ' mega-cat ';
			}
			elseif( $this->tie_megamenu_type == 'links' ){
				$columns = ( !empty( $this->tie_megamenu_columns ) ? $this->tie_megamenu_columns :  2 );
				$class_names .= ' mega-links mega-links-'.$columns.'col ';
			}
			elseif( $this->tie_megamenu_type == 'recent' ){
				$class_names .= ' mega-recent-featured ';
			}
		}

		if( $depth === 1 && $this->tie_megamenu_type == 'links' ){
			$class_names .=' mega-link-column ';
			$a_class = ' class="mega-links-head" ';
		}
	// =====================

		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		/**
		 * Filter the ID applied to a menu item's <li>.
		 */
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names .'>';

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

		/**
		 * Filter the HTML attributes applied to a menu item's <a>.
		 *
		 */
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		if( !empty( $args->before ) ) $item_output = $args->before;
		$item_output .= '<a'.$a_class . $attributes .'>';

		if( !empty( $this->tie_megamenu_icon ) )
			$item_output .= '<i class="fa '.$this->tie_megamenu_icon.'"></i>';

		/** This filter is documented in wp-includes/post-template.php */
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;


	//By TieLabs ===========
		if( $depth === 0 && !empty( $this->tie_megamenu_type ) && $this->tie_megamenu_type != 'disable' ){

			$img = $padding_left = $padding_right = $style = $min_height ='';
			if ( !empty( $this->tie_megamenu_image )) {
				$img = " background-image: url($this->tie_megamenu_image) ; background-position: $this->tie_megamenu_position_y $this->tie_megamenu_position ; background-repeat: $this->tie_megamenu_repeat ; ";
			}
			if ( !empty( $this->tie_megamenu_padding_left ) ) {
				$padding_left = $this->tie_megamenu_padding_left;
				if ( strpos( $padding_left , 'px' ) === false && strpos( $padding_left , '%' ) === false ) $padding_left .= 'px';
				$padding_left = " padding-left : $padding_left; ";
			}
			if ( !empty( $this->tie_megamenu_padding_right ) ) {
				$padding_right = $this->tie_megamenu_padding_right;
				if ( strpos( $padding_right , 'px' ) === false && strpos( $padding_right , '%' ) === false ) $padding_right .= 'px';
				$padding_right = " padding-right : $padding_right; ";
			}
			if ( !empty( $this->tie_megamenu_min_height ) ) {
				$min_height = $this->tie_megamenu_min_height;
				if ( strpos( $min_height , 'px' ) === false ) $min_height .= 'px';
				$min_height = " min-height : $min_height; ";
			}

			if ( !empty( $img ) || !empty( $padding_left ) || !empty( $padding_right ) ) $style=' style="'.$img.$padding_left.$padding_right.$min_height.'"';

			$item_output .="\n<div class=\"mega-menu-block menu-sub-content\"$style>\n";
		}
	// =====================

		/**
		 * Filter a menu item's starting output.
		 */
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}


	/**
	 * Ends the element output, if needed.
	 */
	public function end_el( &$output, $item, $depth = 0, $args = array() ) {

	//By TieLabs ===========
		if( $depth === 0 && !empty( $this->tie_megamenu_type ) && $this->tie_megamenu_type != 'disable' ){
			global $post;

			$output .="\n<div class=\"mega-menu-content\">\n";

		//Sub Categories ===============================================================
			if(  $this->tie_megamenu_type == 'sub-posts' &&  $item->object == 'category' ){
				$no_sub_categories = $sub_categories_exists = $sub_categories = '';

				$query_args = array(
					'child_of'                 => $item->object_id,
				);
				$sub_categories = get_categories($query_args);

				//Check if the Category doesn't contain any sub categories.
				if( count($sub_categories) == 0) {
					$sub_categories = array( $item->object_id ) ;
					$no_sub_categories = true ;
				}else{
					$sub_categories_exists = ' mega-cat-sub-exists';
				}

				$output .= '<div class="mega-cat-wrapper"> ';

						if( !$no_sub_categories ){
				$output .= '<ul class="mega-cat-sub-categories"> ';
							foreach( $sub_categories as $category ) {
							   $output .= '<li><a href="#mega-cat-'.$item->ID.'-'.$category->term_id.'">'.$category->name.'</a></li>';
							}
				$output .=  '</ul> ';
						}

				$output .= ' <div class="mega-cat-content'. $sub_categories_exists.'">';

				foreach( $sub_categories as $category ) {

					if( !$no_sub_categories )
						$cat_id = $category->term_id;
					else
						$cat_id = $category;

					$output .=  '<div id="mega-cat-'.$item->ID.'-'.$cat_id.'" class="mega-cat-content-tab">';

					$original_post = $post;

					$args = array(
						'posts_per_page'		 => 4,
						'cat'          			 => $cat_id,
						'no_found_rows'          => true,
						'ignore_sticky_posts'	 => true
					);
					$cat_query = new WP_Query( $args );
					while ( $cat_query->have_posts() ) {
						$cat_query->the_post();
						$img_classes 	= tie_get_post_class( 'post-thumbnail' );
						$post_time 		= tie_get_time( true );
						$img_title 		= esc_attr( get_the_title() );
						$output .= '<div class="mega-menu-post">';
						if ( function_exists("has_post_thumbnail") && has_post_thumbnail() )
						$output .= '<div '.$img_classes.'><a class="mega-menu-link" href="'. get_permalink().'" title="'.get_the_title().'"><img src="'.tie_thumb_src( 'tie-medium' ).'" width="310" height="165" alt="'.$img_title.'" /><span class="fa overlay-icon"></span></a></div>';
						$output .= '<h3 class="post-box-title"><a class="mega-menu-link" href="'. get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h3>
									'.$post_time.'
							</div> <!-- mega-menu-post -->';
					}

					$post = $original_post;
					wp_reset_query();

					$output .=  '</div><!-- .mega-cat-content-tab --> ';
				}

				$output .= '</div> <!-- .mega-cat-content -->
								<div class="clear"></div>
							</div> <!-- .mega-cat-Wrapper --> ';
			}

		// End of Sub Categories =====================================================

		//Recent + Check also ========================================================
			if( $this->tie_megamenu_type == 'recent' &&  $item->object == 'category' ){
				$count = 0;
				$output_more_posts = '';
				$posts_number = ( empty( $this->tie_has_children ) ? 7 :  4 );

				$original_post = $post;

				$args = array(
					'posts_per_page'		 => $posts_number,
					'cat'          			 => $item->object_id,
					'no_found_rows'          => true,
					'ignore_sticky_posts'	 => true
				);

				$cat_query = new WP_Query( $args );
				while ( $cat_query->have_posts() ) { $count ++ ;
					$cat_query->the_post();
					$img_classes 	= tie_get_post_class( 'post-thumbnail' );
					$post_time 		= tie_get_time( true );
					$img_title 		= esc_attr( get_the_title() );

					if( $count == 1){
						$output .= '<div class="mega-recent-post">';
						if ( function_exists("has_post_thumbnail") && has_post_thumbnail() )
						$output .= '<div '.$img_classes.'><a class="mega-menu-link" href="'. get_permalink().'" title="'.get_the_title().'"><img src="'.tie_thumb_src( 'slider' ).'" width="660" height="330" alt="'.$img_title.'" /><span class="fa overlay-icon"></span></a></div>';
						$output .= '<h3 class="post-box-title"><a class="mega-menu-link" href="'. get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h3>
						'.$post_time.'
						</div> <!-- mega-recent-post -->';
					}else{
						$output_more_posts .= '<li>';
						if ( function_exists("has_post_thumbnail") && has_post_thumbnail() )
						$output_more_posts .= '<div '.$img_classes.'><a class="mega-menu-link" href="'. get_permalink().'" title="'.get_the_title().'"><img src="'.tie_thumb_src( ).'" width="110" height="75" alt="'.$img_title.'" /><span class="fa overlay-icon"></span></a></div>';
						$output_more_posts .= '<h3 class="post-box-title"><a class="mega-menu-link" href="'. get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h3>'.$post_time;
						$output_more_posts .= '</li>';
					}
				}

				$post = $original_post;
				wp_reset_query();

				$output .= '<div class="mega-check-also"><ul>'.$output_more_posts.'</ul></div> <!-- mega-check-also -->';

			}

		// End of Sub Categories =====================================================

			$output .= "\n</div><!-- .mega-menu-content --> \n</div><!-- .mega-menu-block --> \n";
		}
	// =====================

		$output .= "</li>\n";
	}


	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args = array() , &$output ) {
		$id_field = $this->db_fields['id'];
		if ( is_object( $args[0] ) ) {
			$args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
		}
		return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}
} // Walker_Nav_Menu



// Back end modification on Menus page ===============================================
add_filter( 'wp_edit_nav_menu_walker', 'tie_custom_nav_edit_walker',10,2 );
function tie_custom_nav_edit_walker($walker,$menu_id) {
    return 'tie_mega_menu_edit_walker';
}


// The Custom Tielabs menu fields
add_action( 'wp_nav_menu_item_custom_fields', 'tie_add_megamenu_fields', 10, 4 );
function tie_add_megamenu_fields( $item_id, $item, $depth, $args ) { ?>

	<div class="clear"></div>
	<div class="tie-mega-menu-type">
		<p class="field-megamenu-icon description description-wide">
			<label for="edit-menu-item-megamenu-icon-<?php echo $item_id; ?>">
				<?php _e( 'Menu Icon', 'tie' ); ?>
				<input type="hidden" id="edit-menu-item-megamenu-icon-<?php echo $item_id; ?>" class="widefat code edit-menu-item-megamenu-icon" name="menu-item-tie-megamenu-icon[<?php echo $item_id; ?>]" value="<?php echo $item->tie_megamenu_icon; ?>" />
				<div id="preview_edit-menu-item-megamenu-icon-<?php echo $item_id; ?>" data-target="#edit-menu-item-megamenu-icon-<?php echo $item_id; ?>" class="button icon-picker fa <?php echo $item->tie_megamenu_icon; ?>"></div>
			</label>
		</p>


		<p class="field-megamenu-type description description-wide">
			<label for="edit-menu-item-megamenu-type-<?php echo $item_id; ?>">
				<?php _e( 'Enable Mega Menu ?', 'tie' ); ?>
				<select id="edit-menu-item-megamenu-type-<?php echo $item_id; ?>" class="widefat code edit-menu-item-megamenu-type" name="menu-item-tie-megamenu-type[<?php echo $item_id; ?>]">
					<option value=""><?php _e( 'Disable', 'tie' ); ?></option>
					<?php  if( $item->object == 'category' ){  ?>
					<option value="sub-posts" <?php selected( $item->tie_megamenu_type, 'sub-posts' ); ?>><?php _e( 'Sub Categories + Posts', 'tie' ); ?></option>
					<option value="recent" <?php selected( $item->tie_megamenu_type, 'recent' ); ?>><?php _e( 'Recent post + Check also', 'tie' ); ?></option>
					<?php } ?>
					<option value="links" <?php selected( $item->tie_megamenu_type, 'links' ); ?>><?php _e( 'Mega Links', 'tie' ); ?></option>
				</select>
			</label>
		</p>
		<p class="field-megamenu-columns description description-wide">
			<label for="edit-menu-item-megamenu-columns-<?php echo $item_id; ?>">
				<?php _e( 'Mega Links - Columns', 'tie' ); ?>
				<select id="edit-menu-item-megamenu-columns-<?php echo $item_id; ?>" class="widefat code edit-menu-item-megamenu-columns" name="menu-item-tie-megamenu-columns[<?php echo $item_id; ?>]">
					<option value=""></option>
					<option value="2" <?php selected( $item->tie_megamenu_columns, '2' ); ?>>2</option>
					<option value="3" <?php selected( $item->tie_megamenu_columns, '3' ); ?>>3</option>
					<option value="4" <?php selected( $item->tie_megamenu_columns, '4' ); ?>>4</option>
					<option value="5" <?php selected( $item->tie_megamenu_columns, '5' ); ?>>5</option>
				</select>
			</label>
		</p>

		<p class="field-megamenu-image description description-wide">
			<label for="edit-menu-item-megamenu-image-<?php echo $item_id; ?>">
				<?php _e( 'Mega Menu Background Image', 'tie' ); ?>
			</label>
			<input type="text" id="edit-menu-item-megamenu-image-<?php echo $item_id; ?>" class="widefat code edit-menu-item-megamenu-image" name="menu-item-tie-megamenu-image[<?php echo $item_id; ?>]" value="<?php echo $item->tie_megamenu_image; ?>" />
			<select id="edit-menu-item-megamenu-position-<?php echo $item_id; ?>" class="widefat code edit-menu-item-megamenu-position" name="menu-item-tie-megamenu-position[<?php echo $item_id; ?>]">
				<option value=""></option>
				<option value="center" <?php selected( $item->tie_megamenu_position, 'center' ); ?>><?php _e( 'Center', 'tie' ); ?></option>
				<option value="right" <?php selected( $item->tie_megamenu_position, 'right' ); ?>><?php _e( 'Right', 'tie' ); ?></option>
				<option value="left" <?php selected( $item->tie_megamenu_position, 'left' ); ?>><?php _e( 'Left', 'tie' ); ?></option>
			</select>
			<select id="edit-menu-item-megamenu-position-y-<?php echo $item_id; ?>" class="widefat code edit-menu-item-megamenu-position-y" name="menu-item-tie-megamenu-position-y[<?php echo $item_id; ?>]">
				<option value=""></option>
				<option value="center" <?php selected( $item->tie_megamenu_position_y, 'center' ); ?>><?php _e( 'Center', 'tie' ); ?></option>
				<option value="top" <?php selected( $item->tie_megamenu_position_y, 'top' ); ?>><?php _e( 'Top', 'tie' ); ?></option>
				<option value="bottom" <?php selected( $item->tie_megamenu_position_y, 'bottom' ); ?>><?php _e( 'Bottom', 'tie' ); ?></option>
			</select>
			<select id="edit-menu-item-megamenu-repeat-<?php echo $item_id; ?>" class="widefat code edit-menu-item-megamenu-repeat" name="menu-item-tie-megamenu-repeat[<?php echo $item_id; ?>]">
				<option value=""></option>
				<option value="no-repeat" <?php selected( $item->tie_megamenu_repeat, 'no-repeat' ); ?>><?php _e( 'no-repeat', 'tie' ); ?></option>
				<option value="repeat" <?php selected( $item->tie_megamenu_repeat, 'repeat' ); ?>><?php _e( 'repeat', 'tie' ); ?></option>
				<option value="repeat-x" <?php selected( $item->tie_megamenu_repeat, 'repeat-x' ); ?>><?php _e( 'repeat-x', 'tie' ); ?></option>
				<option value="repeat-y" <?php selected( $item->tie_megamenu_repeat, 'repeat-y' ); ?>><?php _e( 'repeat-y', 'tie' ); ?></option>
			</select>
		</p>

		<p class="field-megamenu-styling description description-thin">
			<label for="edit-menu-item-megamenu-padding-right-<?php echo $item_id; ?>">
				<?php _e( 'Padding Right', 'tie' ); ?>
				<input type="text" id="edit-menu-item-megamenu-padding-right-<?php echo $item_id; ?>" class="widefat code edit-menu-item-megamenu-padding-right" name="menu-item-tie-megamenu-padding-right[<?php echo $item_id; ?>]" value="<?php echo $item->tie_megamenu_padding_right; ?>" />
			</label>
		</p>

		<p class="field-megamenu-styling description description-thin">
			<label for="edit-menu-item-megamenu-padding-left-<?php echo $item_id; ?>">
				<?php _e( 'Padding left', 'tie' ); ?>
				<input type="text" id="edit-menu-item-megamenu-padding-left-<?php echo $item_id; ?>" class="widefat code edit-menu-item-megamenu-padding-left" name="menu-item-tie-megamenu-padding-left[<?php echo $item_id; ?>]" value="<?php echo $item->tie_megamenu_padding_left; ?>" />
			</label>
		</p>

		<p class="field-megamenu-styling description description-thin">
			<label for="edit-menu-item-megamenu-min-height-<?php echo $item_id; ?>">
				<?php _e( 'Min Height', 'tie' ); ?>
				<input type="text" id="edit-menu-item-megamenu-min-height-<?php echo $item_id; ?>" class="widefat code edit-menu-item-megamenu-min-height" name="menu-item-tie-megamenu-min-height[<?php echo $item_id; ?>]" value="<?php echo $item->tie_megamenu_min_height; ?>" />
			</label>
		</p>


	</div><!-- .tie-mega-menu-type-->
<?php }


// Save The custom Fields
add_action('wp_update_nav_menu_item', 'tie_custom_nav_update', 10, 3);
function tie_custom_nav_update($menu_id, $menu_item_db_id, $args ) {

	$custom_meta_fields = array(
		'menu-item-tie-megamenu-type',
		'menu-item-tie-megamenu-columns',
		'menu-item-tie-megamenu-icon',
		'menu-item-tie-megamenu-image',
		'menu-item-tie-megamenu-position',
		'menu-item-tie-megamenu-position-y',
		'menu-item-tie-megamenu-min-height',
		'menu-item-tie-megamenu-repeat',
		'menu-item-tie-megamenu-padding-left',
		'menu-item-tie-megamenu-padding-right'
	);

	foreach( $custom_meta_fields as $custom_meta_field ){
		$save_option_name		= str_replace( 'menu-item-', '', $custom_meta_field);
		$save_option_name		= str_replace( '-', '_', $save_option_name);

		if ( !empty($_REQUEST[ $custom_meta_field ][ $menu_item_db_id ] ) ) {
			$custom_value = $_REQUEST[ $custom_meta_field ][ $menu_item_db_id ];
			update_post_meta( $menu_item_db_id, $save_option_name, $custom_value );
		}else{
			delete_post_meta( $menu_item_db_id, $save_option_name );
		}
	}
}

/*
 * Adds value of new field to $item object that will be passed to     Walker_Nav_Menu_Edit_Custom
 */
add_filter( 'wp_setup_nav_menu_item','tie_custom_nav_item' );
function tie_custom_nav_item($menu_item) {
    $menu_item->tie_megamenu_type			= get_post_meta( $menu_item->ID, 'tie_megamenu_type',			true );
    $menu_item->tie_megamenu_icon			= get_post_meta( $menu_item->ID, 'tie_megamenu_icon',			true );
    $menu_item->tie_megamenu_image			= get_post_meta( $menu_item->ID, 'tie_megamenu_image',			true );
    $menu_item->tie_megamenu_position 		= get_post_meta( $menu_item->ID, 'tie_megamenu_position',		true );
    $menu_item->tie_megamenu_position_y		= get_post_meta( $menu_item->ID, 'tie_megamenu_position_y',		true );
    $menu_item->tie_megamenu_repeat			= get_post_meta( $menu_item->ID, 'tie_megamenu_repeat',			true );
    $menu_item->tie_megamenu_min_height		= get_post_meta( $menu_item->ID, 'tie_megamenu_min_height',		true );
    $menu_item->tie_megamenu_padding_left	= get_post_meta( $menu_item->ID, 'tie_megamenu_padding_left',	true );
    $menu_item->tie_megamenu_padding_right	= get_post_meta( $menu_item->ID, 'tie_megamenu_padding_right',	true );
    return $menu_item;
}


/**
 * Navigation Menu template functions
 */
class tie_mega_menu_edit_walker extends Walker_Nav_Menu {
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
			$title = sprintf( __( '%s (Invalid)' ), $item->title );
		} elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
			$classes[] = 'pending';
			/* translators: %s: title of menu item in draft status */
			$title = sprintf( __('%s (Pending)'), $item->title );
		}

		$title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;

		$submenu_text = '';
		if ( 0 == $depth )
			$submenu_text = 'style="display: none;"';

		?>
		<li id="menu-item-<?php echo $item_id; ?>" class="<?php echo implode(' ', $classes ); ?>">
			<dl class="menu-item-bar">
				<dt class="menu-item-handle">
					<span class="item-title"><span class="menu-item-title"><?php echo esc_html( $title ); ?></span> <span class="is-submenu" <?php echo $submenu_text; ?>><?php _e( 'sub item' ); ?></span></span>
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
							?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up'); ?>">&#8593;</abbr></a>
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
							?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down'); ?>">&#8595;</abbr></a>
						</span>
						<a class="item-edit" id="edit-<?php echo $item_id; ?>" title="<?php esc_attr_e('Edit Menu Item'); ?>" href="<?php
							echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
						?>"><?php _e( 'Edit Menu Item' ); ?></a>
					</span>
				</dt>
			</dl>

			<div class="menu-item-settings wp-clearfix" id="menu-item-settings-<?php echo $item_id; ?>">
				<?php if( 'custom' == $item->type ) : ?>
					<p class="field-url description description-wide">
						<label for="edit-menu-item-url-<?php echo $item_id; ?>">
							<?php _e( 'URL' ); ?><br />
							<input type="text" id="edit-menu-item-url-<?php echo $item_id; ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
						</label>
					</p>
				<?php endif; ?>
				<p class="description description-thin">
					<label for="edit-menu-item-title-<?php echo $item_id; ?>">
						<?php _e( 'Navigation Label' ); ?><br />
						<input type="text" id="edit-menu-item-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
					</label>
				</p>
				<p class="description description-thin">
					<label for="edit-menu-item-attr-title-<?php echo $item_id; ?>">
						<?php _e( 'Title Attribute' ); ?><br />
						<input type="text" id="edit-menu-item-attr-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
					</label>
				</p>
				<p class="field-link-target description">
					<label for="edit-menu-item-target-<?php echo $item_id; ?>">
						<input type="checkbox" id="edit-menu-item-target-<?php echo $item_id; ?>" value="_blank" name="menu-item-target[<?php echo $item_id; ?>]"<?php checked( $item->target, '_blank' ); ?> />
						<?php _e( 'Open link in a new window/tab' ); ?>
					</label>
				</p>
				<p class="field-css-classes description description-thin">
					<label for="edit-menu-item-classes-<?php echo $item_id; ?>">
						<?php _e( 'CSS Classes (optional)' ); ?><br />
						<input type="text" id="edit-menu-item-classes-<?php echo $item_id; ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo $item_id; ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
					</label>
				</p>
				<p class="field-xfn description description-thin">
					<label for="edit-menu-item-xfn-<?php echo $item_id; ?>">
						<?php _e( 'Link Relationship (XFN)' ); ?><br />
						<input type="text" id="edit-menu-item-xfn-<?php echo $item_id; ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
					</label>
				</p>
				<p class="field-description description description-wide">
					<label for="edit-menu-item-description-<?php echo $item_id; ?>">
						<?php _e( 'Description' ); ?><br />
						<textarea id="edit-menu-item-description-<?php echo $item_id; ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo $item_id; ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
						<span class="description"><?php _e('The description will be displayed in the menu if the current theme supports it.'); ?></span>
					</label>
				</p>


				<?php
					//By Tielabs **************************************************

						do_action( 'wp_nav_menu_item_custom_fields', $item_id, $item, $depth, $args );

					// END ********************************************************
				?>

				<p class="field-move hide-if-no-js description description-wide">
					<label>
						<span><?php _e( 'Move' ); ?></span>
						<a href="#" class="menus-move-up"><?php _e( 'Up one' ); ?></a>
						<a href="#" class="menus-move-down"><?php _e( 'Down one' ); ?></a>
						<a href="#" class="menus-move-left"></a>
						<a href="#" class="menus-move-right"></a>
						<a href="#" class="menus-move-top"><?php _e( 'To the top' ); ?></a>
					</label>
				</p>

				<div class="menu-item-actions description-wide submitbox">
					<?php if( 'custom' != $item->type && $original_title !== false ) : ?>
						<p class="link-to-original">
							<?php printf( __('Original: %s'), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
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
					); ?>"><?php _e( 'Remove' ); ?></a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo $item_id; ?>" href="<?php echo esc_url( add_query_arg( array( 'edit-menu-item' => $item_id, 'cancel' => time() ), admin_url( 'nav-menus.php' ) ) );
						?>#menu-item-settings-<?php echo $item_id; ?>"><?php _e('Cancel'); ?></a>
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


} // Walker_Nav_Menu
?>

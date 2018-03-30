<?php
/**
 * Karma Mega Menu
 *
 * This file helps to alter the WP Menu back-end
 * and adds our custom nav_walker for front-end output
 *
 * @since 4.8
 */
if( !class_exists( 'karma_megamenu' ) ) {
	class karma_megamenu
	{
/*-------------------------------------------------------------- 
Fire our functions
--------------------------------------------------------------*/
function karma_megamenu() {
	add_action('admin_menu', array(&$this,'karma_enqueue'));
	add_filter('wp_nav_menu_args', array(&$this,'modify_arguments'), 100);
	add_filter( 'wp_edit_nav_menu_walker', array(&$this,'change_backend_walker') , 100);
	add_action( 'wp_update_nav_menu_item', array(&$this,'update_menu'), 100, 3);
}
/*-------------------------------------------------------------- 
Enqueue Mega Menu JS
--------------------------------------------------------------*/
function karma_enqueue() {
	if(basename( $_SERVER['PHP_SELF']) == "nav-menus.php" ) {
		wp_enqueue_script( 'karma_mega_menu' , TRUETHEMES_JS . '/karma_mega_menu.js',array('jquery', 'jquery-ui-sortable'), false, true );
	}
}
/*-------------------------------------------------------------- 
Replace default arguments for front-end output
--------------------------------------------------------------*/
function modify_arguments($arguments) {

	$walker = apply_filters("karma_mega_menu_walker", "karma_walker");

	if($walker) {
		$arguments['walker'] 				= new $walker();
		$arguments['container_class'] 		= $arguments['container_class'] .= ' megaWrapper';
		$arguments['menu_class']			= 'karma_mega';
	}

	return $arguments;
}
/*-------------------------------------------------------------- 
Tell Wordpress to use our custom walker
--------------------------------------------------------------*/
function change_backend_walker($name) {
	return 'karma_admin_mega_walker';
}
/*-------------------------------------------------------------- 
Save The Menu Item Properties
--------------------------------------------------------------*/
function update_menu($menu_id, $menu_item_db)
{
	$check = apply_filters('avf_mega_menu_post_meta_fields',array('megamenu','division','textarea'), $menu_id, $menu_item_db);

	foreach ( $check as $key ) {
		if(!isset($_POST['menu-item-karma-'.$key][$menu_item_db]))
		{
			$_POST['menu-item-karma-'.$key][$menu_item_db] = "";
		}

		$value = $_POST['menu-item-karma-'.$key][$menu_item_db];
		update_post_meta( $menu_item_db, '_menu-item-karma-'.$key, $value );
	}
}
}
}
/**
 * Karma Walker
 *
 * This combines the old Karma Nav Walker with
 * the new Nav Walker to work nicely with Mega Menu
 *
 * @since 4.8
 */
if( !class_exists( 'karma_walker' ) ) {

//here's where we build the walker
class karma_walker extends Walker {
	
	var $tree_type = array( 'post_type', 'taxonomy', 'custom' );
	var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );
	var $columns = 0;
	var $max_columns = 0;
	var $rows = 1;
	var $rowsCounter = array();
	var $mega_active = 0;

	//Walker::start_lvl()
	function start_lvl(&$output, $depth = 0, $args = array()) {
		$indent = str_repeat("\t", $depth);
		if($depth === 0) $output .= "\n{replace_one}\n";
		$output .= "\n$indent<ul class=\"sub-menu\">\n";
	}

	//Walker::end_lvl()
	function end_lvl(&$output, $depth = 0, $args = array()) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";

		if($depth === 0) {
			if($this->mega_active) {

				$output .= "\n</div>\n";
				$output = str_replace("{replace_one}", "<div class='karma_mega_div karma_mega".$this->max_columns."'>", $output);

				foreach($this->rowsCounter as $row => $columns)
				{
					$output = str_replace("{current_row_".$row."}", "karma_mega_menu_columns_".$columns, $output);
				}
				$this->columns     = 0;
				$this->max_columns = 0;
				$this->rowsCounter = array();
			}
		else
			{
				$output = str_replace("{replace_one}", "", $output);
			}
		}
	}

	//Walker::start_el()
	function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0 ) {
		global $wp_query;

		$custom_icon  = get_post_meta( $item->ID, '_menu_custom_icon', true ); //custom icon field
		$custom_icon_mkp = '';
		if ($custom_icon) {
			$custom_icon_mkp = '<i class="fa ' . $custom_icon . ' tt-menu-icon"></i>';
		}

		if(!isset($args->max_columns)) $args->max_columns = 5;

		$item_output = $li_text_block_class = $column_class = "";
		$append = $prepend = $description;

		if($depth === 0) {
			$this->mega_active = get_post_meta( $item->ID, '_menu-item-karma-megamenu', true);
			$prepend           = '<strong>';
			$append            = '</strong>';
			$description       = ! empty( $item->description ) ? '<span class="navi-description">'.esc_attr( $item->description ).'</span>' : '';
		}

		if($depth === 1 && $this->mega_active) {
			$this->columns ++;

			if($this->columns > $args->max_columns || (get_post_meta( $item->ID, '_menu-item-karma-division', true) && $this->columns != 1)) {
				$this->columns = 1;
				$this->rows ++;
				$output .= "\n<li class='karma_mega_hr'></li>\n";
			}

			$this->rowsCounter[$this->rows] = $this->columns;
			if($this->max_columns < $this->columns) $this->max_columns = $this->columns;
			$title = apply_filters( 'the_title', $item->title, $item->ID );

			
			if($item->title != '-' && $title != "-" && $title != '"-"') {
				$item_output .= "<span class='karma-mega-title'>".$custom_icon_mkp.$title."</span>";
			}

			$column_class  = ' {current_row_'.$this->rows.'}';
			if($this->columns == 1) {
				$column_class  .= " karma_mega_menu_first_column";
			}
		}
		else if($depth >= 2 && $this->mega_active && get_post_meta( $item->ID, '_menu-item-karma-textarea', true) ) {
			$li_text_block_class = 'karma_mega_text_block ';
			$item_output.= "<span class='karma-mega-title'>" . $custom_icon_mkp.do_shortcode($item->post_content) . "</span>";
		}
		else
		{
			$attributes   = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
			$attributes  .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
			$attributes  .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
			$attributes  .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
			$item_output .= $args->before;
			$item_output .= '<a'. $attributes .'><span>'.$custom_icon_mkp;
			$item_output .= $args->link_before . $prepend . apply_filters( 'the_title', $item->title, $item->ID ) . $append . $description . $args->link_after;
			$item_output .= '</span></a>';
			$item_output .= $args->after;
		}

		$indent      = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$class_names = $value = '';
		$classes     = empty( $item->classes ) ? array() : (array) $item->classes;

		if ($custom_icon) {
			// see framework/nav-output.php
			// The old karma walker uses this to tell the theme
			// that this item should leave a space for the icon
			$classes[] = 'tt-menu-icon-active';
		}
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="'.$li_text_block_class. esc_attr( $class_names ) . $column_class.'"';
		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	//Walker::end_el()
	function end_el(&$output, $item, $depth = 0, $args = array()) {
		$output .= "</li>\n";
	}
}
}
/*-------------------------------------------------------------- 
Create HTML input fields on nav-menus.php
--------------------------------------------------------------*/
if( !class_exists( 'karma_admin_mega_walker' ) ) {
	class karma_admin_mega_walker extends Walker_Nav_Menu {
		function start_lvl(&$output, $depth = 0, $args = array() ) {}
		function end_lvl(&$output, $depth = 0, $args = array()) {}

		//Walker::start_el()
		function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0 ) {
			global $_wp_nav_menu_max_depth;
			$_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

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
			} elseif ( 'post_type' == $item->type ) {
				$original_object = get_post( $item->object_id );
				$original_title = $original_object->post_title;
			}

			$classes = array(
				'menu-item menu-item-depth-' . $depth,
				'menu-item-' . esc_attr( $item->object ),
				'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
			);

			$title = $item->title;

			if ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
				$classes[] = 'pending';
				/* translators: %s: title of menu item in draft status */
				$title = sprintf( __('%s (Pending)'), $item->title );
			}

			$title = empty( $item->label ) ? $title : $item->label;

			$itemValue = "";
			if($depth == 0)
			{
				$itemValue = get_post_meta( $item->ID, '_menu-item-karma-megamenu', true);
				if($itemValue != "") $itemValue = 'karma_mega_active ';
			}

			?>
			<li id="menu-item-<?php echo $item_id; ?>" class="<?php echo $itemValue; echo implode(' ', $classes ); ?>">
				<dl class="menu-item-bar">
					<dt class="menu-item-handle">
						<span class="item-title"><?php echo esc_html( $title ); ?></span>
						<span class="item-controls">
							<span class="item-type item-type-default"><?php echo esc_html( $item->type_label ); ?></span>
							<span class="item-type item-type-karma"><?php _e('Column'); ?></span>
							<span class="item-type item-type-karma-mega-section"><?php _e('Mega Menu'); ?></span>
							<a class="item-edit" id="edit-<?php echo $item_id; ?>" title="<?php _e('Edit Menu Item'); ?>" href="<?php
								echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
							?>"><?php _e( 'Edit Menu Item' ); ?></a>
						</span>
					</dt>
				</dl>
				<div class="menu-item-settings" id="menu-item-settings-<?php echo $item_id; ?>">
					<?php if( 'custom' == $item->type ) : ?>
						<p class="field-url description description-wide">
							<label for="edit-menu-item-url-<?php echo $item_id; ?>">
								<?php _e( 'URL' ); ?><br />
								<input type="text" id="edit-menu-item-url-<?php echo $item_id; ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
							</label>
						</p>
					<?php endif; ?>
					<p class="description description-thin description-label karma_label_desc_on_active">
						<label for="edit-menu-item-title-<?php echo $item_id; ?>">
						<span class='karma_default_label'><?php _e( 'Navigation Label' ); ?></span>
						<span class='karma_mega_label'><?php _e( 'Mega Menu Column Title &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(use a "-" dash for no title)' ); ?></span>

							<br />
							<input type="text" id="edit-menu-item-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
						</label>
					</p>
					<p class="description description-thin description-title">
						<label for="edit-menu-item-attr-title-<?php echo $item_id; ?>">
							<?php _e( 'Title Attribute' ); ?><br />
							<input type="text" id="edit-menu-item-attr-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
						</label>
					</p>
					<p class="field-link-target description description-thin">
						<label for="edit-menu-item-target-<?php echo $item_id; ?>">
							<?php _e( 'link Target' ); ?><br />
							<select id="edit-menu-item-target-<?php echo $item_id; ?>" class="widefat edit-menu-item-target" name="menu-item-target[<?php echo $item_id; ?>]">
								<option value="" <?php selected( $item->target, ''); ?>><?php _e('Same window or tab'); ?></option>
								<option value="_blank" <?php selected( $item->target, '_blank'); ?>><?php _e('New window or tab'); ?></option>
							</select>
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
							<?php _e( 'link Relationship (XFN)' ); ?><br />
							<input type="text" id="edit-menu-item-xfn-<?php echo $item_id; ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
						</label>
					</p>
					<p class="field-description description description-wide">
						<label for="edit-menu-item-description-<?php echo $item_id; ?>">
							<?php _e( 'Description' ); ?><br />
							<textarea id="edit-menu-item-description-<?php echo $item_id; ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo $item_id; ?>]"><?php echo esc_html( $item->post_content ); ?></textarea>
						</label>
					</p>    
		            <p class="field-custom description description-wide">
		                <label for="edit-menu-custom-icon-<?php echo $item_id; ?>">
		                    <?php _e( 'Font Awesome Icon &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;example: fa fa-chevron-right' ); ?><br />
		                    <input type="text" id="edit-menu-custom-icon-<?php echo $item_id; ?>" class="widefat code edit-menu-item-custom" name="menu-custom-icon[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->subtitle ); ?>" />
		                </label>
		            </p>
					<div class='karma_mega_menu_options'>
					<!-- karma mega menu code -->
						<?php
						$title = 'Karma Mega Menu';
						$key = "menu-item-karma-megamenu";
						$value = get_post_meta( $item->ID, '_'.$key, true);
						if($value != "") $value = "checked='checked'";
						?>
						<p class="description description-wide karma_checkbox karma_mega_menu karma_mega_menu_d0">
							<label for="edit-<?php echo $key.'-'.$item_id; ?>">
								<input type="checkbox" value="active" id="edit-<?php echo $key.'-'.$item_id; ?>" class=" <?php echo $key; ?>" name="<?php echo $key . "[". $item_id ."]";?>" <?php echo $value; ?> /><?php _e( $title ); ?>
							</label>
						</p>
						<?php
						$title = 'This column should start a new row';
						$key = "menu-item-karma-division";
						$value = get_post_meta( $item->ID, '_'.$key, true);
						if($value != "") $value = "checked='checked'";
						?>
						<p class="description description-wide karma_checkbox karma_mega_menu karma_mega_menu_d1">
							<label for="edit-<?php echo $key.'-'.$item_id; ?>">
								<input type="checkbox" value="active" id="edit-<?php echo $key.'-'.$item_id; ?>" class=" <?php echo $key; ?>" name="<?php echo $key . "[". $item_id ."]";?>" <?php echo $value; ?> /><?php _e( $title ); ?>
							</label>
						</p>
						<?php
						$title = 'Dont display this item as a link. Use the description field to input text or HTML code. Please ensure to keep a Navigation label on this item or it will get deleted.';
						$key = "menu-item-karma-textarea";
						$value = get_post_meta( $item->ID, '_'.$key, true);

						if($value != "") $value = "checked='checked'";
						?>
						<p class="description description-wide karma_checkbox karma_mega_menu karma_mega_menu_d2">
							<label for="edit-<?php echo $key.'-'.$item_id; ?>">
								<input type="checkbox" value="active" id="edit-<?php echo $key.'-'.$item_id; ?>" class=" <?php echo $key; ?>" name="<?php echo $key . "[". $item_id ."]";?>" <?php echo $value; ?> /><span class='karma_long_desc'><?php _e( $title ); ?></span>
							</label>
						</p>
					</div><!-- END karma_mega_menu_options -->

					<?php do_action('karma_mega_menu_option_fields', $output, $item, $depth, $args); ?>

					<div class="menu-item-actions description-wide submitbox">
						<?php if( 'custom' != $item->type ) : ?>
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
								remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
							),
							'delete-menu_item_' . $item_id
						); ?>"><?php _e('Remove'); ?></a> <span class="meta-sep"> | </span> <a class="item-cancel submitcancel" id="cancel-<?php echo $item_id; ?>" href="<?php	echo add_query_arg( array('edit-menu-item' => $item_id, 'cancel' => time()), remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) ) );
							?>#menu-item-settings-<?php echo $item_id; ?>">Cancel</a>
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
	}
}
/*-------------------------------------------------------------- 
Create fallback menu
--------------------------------------------------------------*/
if( !function_exists( 'karma_fallback_menu' ) ) {
	function karma_fallback_menu() {
		$current = "";
		$exclude = karma_get_option('frontpage');
		if (is_front_page()){$current = "class='current-menu-item'";}
		if ($exclude) $exclude ="&exclude=".$exclude;
		echo "<div class='fallback_menu av-main-nav-wrap'>";
		echo "<ul class='karma_mega menu av-main-nav'>";
		echo "<li $current><a href='".get_bloginfo('url')."'>".__('Home','karma_framework')."</a></li>";
		wp_list_pages('title_li=&sort_column=menu_order'.$exclude);
		echo apply_filters('avf_fallback_menu_items', "", 'fallback_menu');
		echo "</ul></div>";
	}
}
<?php 
/**
	Penguin Framework - Penguin Mega Menu
	
	Copyright: (c) 2009-2015 ThemeFocus.

	@url http://penguin.themefocus.co
	@package Penguin
	@version 4.0
**/
class PenguinMegaMenu {

	function PenguinMegaMenu(){
		
		if (is_admin()){
			// add style, js when edit menu
			add_action( 'admin_menu' , array( $this , 'penguin_admin_menu'));
			// add custom menu options when edit menu
			add_filter( 'wp_edit_nav_menu_walker', array($this, 'penguin_wp_edit_nav_menu_walker'), 10, 2 );
			// update custom menu option after edit
			add_action( 'wp_update_nav_menu_item', array( $this , 'penguin_nav_menu_item_custom_update'),10, 3);
		}
		// get custom field value
		add_filter( 'wp_setup_nav_menu_item',array( $this , 'penguin_nav_menu_item_custom'));
		
	}
	
	/**
	 * load page all scripts
	 */
	function penguin_admin_menu(){
		global $pagenow;
		
		$ver = Penguin::$FRAMEWORK_VERSION;
		
		//get template directory url
		$dir = get_template_directory_uri();
		
		if($pagenow == "nav-menus.php"){
			//style
			wp_enqueue_style( 'fontawesome', $dir . '/fontawesome/css/font-awesome.min.css' , array() , $ver );
			wp_enqueue_style( 'penguin', $dir . Penguin::$FRAMEWORK_PATH . '/style/penguin-megamenu.css' , array() , $ver );
			if ( is_rtl() ) {
				wp_enqueue_style( 'penguin_rtl', $dir . Penguin::$FRAMEWORK_PATH . '/style/rtl-megamenu.css' , array() , $ver );
			}
			//scripts
			wp_enqueue_script( 'jquery');
			wp_enqueue_script( 'penguin', $dir . Penguin::$FRAMEWORK_PATH . '/scripts/penguin-megamenu.js' , array('jquery'), $ver, true);
		}
	}
	 
	 
	/**
	 * Use custom Walker class when edit menu items.
	 */
	function penguin_wp_edit_nav_menu_walker($class, $menu_id){
		return 'Penguin_Walker_Nav_Menu_Edit';
	}
	
	/**
	 * out custom field value
	 */
	function penguin_nav_menu_item_custom($menu_item){
		$post_fields = array(
								array('key'=> 'megamenu', 'name' => 'menu-item-megamenu'),
								array('key'=>'megadirection','name'=>'menu-item-megadirection'),
								array('key'=>'megashorttitle','name'=>'menu-item-megashorttitle'),
								array('key'=>'megawidget','name'=>'menu-item-megawidget'),
								array('key'=>'megadescription','name'=>'menu-item-megadescription'),
								array('key'=>'megaimage','name'=>'menu-item-megaimage'),
								array('key'=>'megaimgenable','name'=>'menu-item-megaimgenable'),
								array('key'=>'megaimglink','name'=>'menu-item-megaimglink'),
								array('key'=>'megawide','name'=>'menu-item-megawide')
								
							);
		foreach($post_fields as $field){
			$menu_item->$field['key'] = get_post_meta( $menu_item->ID, '_'.$field['name'], true );
		}
    	return $menu_item;
	}
	
	/**
	 * save custom field value
	 */
	function penguin_nav_menu_item_custom_update($menu_id, $menu_item_db_id, $args){
		
		$post_fields = array('menu-item-megamenu','menu-item-megadirection','menu-item-megashorttitle','menu-item-megadescription','menu-item-megaimage','menu-item-megaimgenable','menu-item-megaimglink','menu-item-megawide','menu-item-megawidget');
		
		if ( ! empty( $_POST['menu-item-db-id'] ) ) {
			
			foreach($post_fields as $field){
				if ( isset( $_POST[$field]) && is_array($_POST[$field])  && isset( $_POST[$field][$menu_item_db_id] )) {
					update_post_meta( $menu_item_db_id, '_'.$field , $_POST[$field][$menu_item_db_id] );
				}else{
					if($field == 'menu-item-megamenu' || $field == 'menu-item-megawide' || $field == 'menu-item-megaimgenable'){
						update_post_meta( $menu_item_db_id, '_'.$field , '' );
					}
				}
			}
		}
	}
}

/**
 * Create Custom HTML list of nav menu items.
 */
class Penguin_Walker extends Walker {
	/**
	 * What the class handles.
	 *
	 * @see Walker::$tree_type
	 */
	var $tree_type = array( 'post_type', 'taxonomy', 'custom' );

	/**
	 * Database fields to use.
	 *
	 * @see Walker::$db_fields
	 */
	var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );
	
	/**
	 * Current menu had been enabled mega style
	 *
	 */
	var $megamenu_enabled = false;
	
	/**
	 * Current sub menu mega width
	 *
	 */
	var $megamenu_megawide = false;
	
	/**
	 * Current menu show direction
	 *
	 */
	var $megamenu_direction = 'horizontal';
	
	/**
	 * Starts the list before the elements are added.
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		if($depth == 0 && $this->megamenu_enabled){
			$output .= "\n$indent<div class=\"mega-menu mega-".$this->megamenu_direction.( $this->megamenu_megawide ? " mega-wide" : "")."\"><ul class=\"sub-menu\">\n";
		}else{
			$output .= "\n$indent<ul class=\"sub-menu\">\n";
		}
	}

	/**
	 * Ends the list of after the elements are added.
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		if($depth == 0 && $this->megamenu_enabled){
			$output .= "$indent</ul></div>\n";
		}else{
			$output .= "$indent</ul>\n";
		}
	}

	/**
	 * Start the element output.
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Menu item data object.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 * @param int    $id     Current item ID.
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		
		if($depth == 0){
			if($item->megamenu == "enabled"){
				$this->megamenu_enabled = true;
				$classes[] = 'mega-menu-main';
				if($item->megadirection != ''){
					$this->megamenu_direction = $item->megadirection;
				}else{
					$this->megamenu_direction = 'horizontal';
				}
				if($item->megawide == "enabled"){
					$this->megamenu_megawide = true;
				}else{
					$this->megamenu_megawide = false;
				}
			}else{
				$this->megamenu_enabled = false;
				$this->megamenu_megawide = false;
				$this->megamenu_direction = 'horizontal';
			}
		}
		
		/**
		 * Filter the CSS class(es) applied to a menu item's <li>.
		 *
		 * @param array  $classes The CSS classes that are applied to the menu item's <li>.
		 * @param object $item    The current menu item.
		 * @param array  $args    An array of arguments. @see wp_nav_menu()
		 */
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		/**
		 * Filter the ID applied to a menu item's <li>.
		 *
		 * @param string The ID that is applied to the menu item's <li>.
		 * @param object $item The current menu item.
		 * @param array $args An array of arguments. @see wp_nav_menu()
		 */
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names .'>';

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';
		
		
		/**
		 * Filter the HTML attributes applied to a menu item's <a>.
		 *
		 * @param array $atts {
		 *     The HTML attributes applied to the menu item's <a>, empty strings are ignored.
		 *
		 *     @type string $title  The title attribute.
		 *     @type string $target The target attribute.
		 *     @type string $rel    The rel attribute.
		 *     @type string $href   The href attribute.
		 * }
		 * @param object $item The current menu item.
		 * @param array  $args An array of arguments. @see wp_nav_menu()
		 */
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

		$attributes = '';
		$megaimglink = '';
		
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				if( 'href' === $attr ) {
					$value = esc_url( $value );
					$megaimglink = $value;
				}else{
					$value = esc_attr( $value );
				}
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}
		
		$item_output = $args->before;
		
		if($depth != 0 && $this->megamenu_enabled ){
			if($this->megamenu_direction == 'horizontal' && $item->megawidget != ""){
				ob_start();
				generated_dynamic_sidebar($item->megawidget);
				$widget_content = ob_get_clean();
				$item_output .= '<div class="mega-custom-widget-content">'.$widget_content.'</div>';
			}else if($item->megaimgenable == "enabled" && $item->megaimage != ""){
				if($item->megaimglink != ""){
					
					$item_output .= '<a class="mega-menu-item-img-link" href="'.esc_url( $megaimglink ).'"><div class="mega-menu-item-img"><img src="'.esc_url( $item->megaimage ).'" alt="" ></div></a>';
					
				}else{
					$item_output .= '<div class="mega-menu-item-img"><img src="'.esc_url( $item->megaimage ).'" alt="" ></div>';
				}
				
				if($item->megadescription != ""){
					$item_output .= '<div class="mega-menu-item-desc">'.esc_html( $item->megadescription ).'</div>';
				}
				
			}else{
				
				$item_output .= '<a'. $attributes .'>';
		
				$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
				
				if($item->megashorttitle != ""){
					$item_output .= '<span class="mega-menu-item-stitle">'.esc_attr( $item->megashorttitle ).'</span>';
				}
				$item_output .= '</a>';
				
				if($item->megaimage != ""){
					if($item->megaimglink != ""){
						$item_output .= '<a class="mega-menu-item-img-link" href="'.esc_url( $item->megaimglink ).'"><div class="mega-menu-item-img"><img src="'.esc_url( $item->megaimage ).'" alt="" ></div></a>';
					}else{
						$item_output .= '<div class="mega-menu-item-img"><img src="'.esc_url( $item->megaimage ).'" alt="" ></div>';
					}
				}
				
				if($item->megadescription != ""){
					$item_output .= '<div class="mega-menu-item-desc">'.esc_html( $item->megadescription ).'</div>';
				}
			}
		}else{
			$item_output .= '<a'. $attributes .'>';
		
			/** This filter is documented in wp-includes/post-template.php */
			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			$item_output .= '</a>';
		}
		
		
		
		
		
		$item_output .= $args->after;

		/**
		 * Filter a menu item's starting output.
		 *
		 * The menu item's starting output only includes $args->before, the opening <a>,
		 * the menu item's title, the closing </a>, and $args->after. Currently, there is
		 * no filter for modifying the opening and closing <li> for a menu item.
		 *
		 * @param string $item_output The menu item's starting HTML output.
		 * @param object $item        Menu item data object.
		 * @param int    $depth       Depth of menu item. Used for padding.
		 * @param array  $args        An array of arguments. @see wp_nav_menu()
		 */
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	/**
	 * Ends the element output, if needed.
	 *
	 * @see Walker::end_el()
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Page data object. Not used.
	 * @param int    $depth  Depth of page. Not Used.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$output .= "</li>\n";
	}

} // Penguin_Walker


/**
 * Edit HTML list of nav menu input items.
 */
class Penguin_Walker_Nav_Menu_Edit extends Walker_Nav_Menu {
	/**
	 * Starts the list before the elements are added.
	 *
	 * @param string $output Passed by reference.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   Not used.
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {}

	/**
	 * Ends the list of after the elements are added.
	 *
	 * @param string $output Passed by reference.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   Not used.
	 */
	function end_lvl( &$output, $depth = 0, $args = array() ) {}

	/**
	 * Start the element output.
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
			$title = sprintf( __( '%s (Invalid)' ,Penguin::$THEME_NAME), $item->title );
		} elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
			$classes[] = 'pending';
			/* translators: %s: title of menu item in draft status */
			$title = sprintf( __('%s (Pending)',Penguin::$THEME_NAME), $item->title );
		}

		$title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;

		$submenu_text = '';
		if ( 0 == $depth ){
			$submenu_text = 'style="display: none;"';
			
			if(isset($item->megamenu) && $item->megamenu == "enabled"){
				$classes[] = 'megamenu-enabled';
			}
		}
		
		?>
		<li id="menu-item-<?php echo $item_id; ?>" class="<?php echo implode(' ', $classes ); ?>">
			<dl class="menu-item-bar">
				<dt class="menu-item-handle">
                	<span class="penguin-megamenu-handle"><?php _e('Mega Menu',Penguin::$THEME_NAME); ?></span>
                    <span class="penguin-megamenu-handle-sub"><?php _e('Sub Menu',Penguin::$THEME_NAME); ?></span>
					<span class="item-title"><span class="menu-item-title"><?php echo esc_html( $title ); ?></span> <span class="is-submenu" <?php echo $submenu_text; ?>><?php _e( 'sub item' ,Penguin::$THEME_NAME); ?></span></span>
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
							?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up',Penguin::$THEME_NAME); ?>">&#8593;</abbr></a>
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
							?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down',Penguin::$THEME_NAME); ?>">&#8595;</abbr></a>
						</span>
						<a class="item-edit" id="edit-<?php echo $item_id; ?>" title="<?php esc_attr_e('Edit Menu Item',Penguin::$THEME_NAME); ?>" href="<?php
							echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : esc_url(add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) ));
						?>"><?php _e( 'Edit Menu Item',Penguin::$THEME_NAME ); ?></a>
					</span>
				</dt>
			</dl>
			<div class="menu-item-settings" id="menu-item-settings-<?php echo $item_id; ?>">
            	<?php // custom field for mega menu  start?>
            	<div class="penguin-megamenu">
                	<h4 class="penguin-megamenu-title"><?php _e( 'Mega Menu Setting',Penguin::$THEME_NAME ); ?></h4>
                	<p class="penguin-megamenu-enable">
                    	<label for="edit-menu-item-megamenu-<?php echo $item_id; ?>">
                            <input type="checkbox" class="penguin-megamenu-enable-checkbox" id="edit-menu-item-megamenu-<?php echo $item_id; ?>" value="enabled" name="menu-item-megamenu[<?php echo $item_id; ?>]" <?php checked( $item->megamenu, 'enabled' ); ?>/>
                            <?php _e( 'Mega Menu Enabled',Penguin::$THEME_NAME ); ?>
                        </label>
                    </p>
                    
                    <p class="penguin-megamenu-direction">
                    	<?php if($item->megadirection == '') { $item->megadirection = 'horizontal'; } ?>
                    	<label for="edit-menu-item-megadirection-<?php echo $item_id; ?>-1">
                            <input type="radio" id="edit-menu-item-megadirection-<?php echo $item_id; ?>-1" value="horizontal" name="menu-item-megadirection[<?php echo $item_id; ?>]" <?php checked( $item->megadirection, 'horizontal' ); ?>/>
                            <?php _e( 'Horizontal',Penguin::$THEME_NAME ); ?>
                        </label>
                        
                        <label for="edit-menu-item-megadirection-<?php echo $item_id; ?>-2">
                            <input type="radio" id="edit-menu-item-megadirection-<?php echo $item_id; ?>-2" value="vertical" name="menu-item-megadirection[<?php echo $item_id; ?>]" <?php checked( $item->megadirection, 'vertical' ); ?>/>
                            <?php _e( 'Vertical',Penguin::$THEME_NAME ); ?>
                        </label>
                    </p>
                    
                    <p class="penguin-megamenu-wideenable">
                    	<label for="edit-menu-item-megawide-<?php echo $item_id; ?>">
                            <input type="checkbox" class="penguin-megamenu-megawide-checkbox" id="edit-menu-item-megawide-<?php echo $item_id; ?>" value="enabled" name="menu-item-megawide[<?php echo $item_id; ?>]" <?php checked( $item->megawide, 'enabled' ); ?>/>
                            <?php _e( 'Sub Menu Full Width Show Enabled',Penguin::$THEME_NAME ); ?>
                        </label>
                    </p>
                    
                   	<p class="penguin-megamenu-megaimgenable">
                    	<label for="edit-menu-item-megaimgenable-<?php echo $item_id; ?>">
                            <input type="checkbox" class="penguin-megamenu-megaimgenable-checkbox" id="edit-menu-item-megaimgenable-<?php echo $item_id; ?>" value="enabled" name="menu-item-megaimgenable[<?php echo $item_id; ?>]" <?php checked( $item->megaimgenable, 'enabled' ); ?>/>
                            <?php _e( 'Only Show Image Enabled',Penguin::$THEME_NAME ); ?>
                            <span class="description"><?php _e('The enabled need you input Image Url option and use menu default menu link.Description can been showed when you already input.',Penguin::$THEME_NAME); ?></span>
                        </label> 
                    </p>
                    
                    <p class="penguin-megamenu-megawidget">
                        <label for="edit-menu-item-megawidget-<?php echo $item_id; ?>">
                            <?php _e( 'Widget Name (optional)',Penguin::$THEME_NAME ); ?><br />
                            <input type="text" id="edit-menu-item-megawidget-<?php echo $item_id; ?>" class="widefat code edit-menu-item-megawidget" name="menu-item-megawidget[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->megawidget ); ?>" />
                        </label>
                    </p>
                    
                    <p class="penguin-megamenu-megashorttitle">
                        <label for="edit-menu-item-megashorttitle-<?php echo $item_id; ?>">
                            <?php _e( 'Short Title (optional)',Penguin::$THEME_NAME ); ?><br />
                            <input type="text" id="edit-menu-item-megashorttitle-<?php echo $item_id; ?>" class="widefat code edit-menu-item-megashorttitle" name="menu-item-megashorttitle[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->megashorttitle ); ?>" />
                        </label>
                    </p>
                    
                    <p class="penguin-megamenu-megaimage">
                        <label for="edit-menu-item-megaimage-<?php echo $item_id; ?>">
                            <?php _e( 'Image Url (optional)',Penguin::$THEME_NAME ); ?><br />
                            <input type="text" id="edit-menu-item-megaimage-<?php echo $item_id; ?>" class="widefat code edit-menu-item-megaimage" name="menu-item-megaimage[<?php echo $item_id; ?>]" value="<?php echo esc_url( $item->megaimage ); ?>" />
                        </label>
                    </p>
                    
                     <p class="penguin-megamenu-megaimglink">
                        <label for="edit-menu-item-megaimglink-<?php echo $item_id; ?>">
                            <?php _e( 'Image Link (optional)',Penguin::$THEME_NAME ); ?><br />
                            <input type="text" id="edit-menu-item-megaimglink-<?php echo $item_id; ?>" class="widefat code edit-menu-item-megaimglink" name="menu-item-megaimglink[<?php echo $item_id; ?>]" value="<?php echo esc_url( $item->megaimglink ); ?>" />
                        </label>
                    </p>
                    
                    <p class="penguin-megamenu-megadescription">
                        <label for="edit-menu-item-megadescription-<?php echo $item_id; ?>">
                            <?php _e( 'Description (optional)',Penguin::$THEME_NAME ); ?><br />
                            <textarea id="edit-menu-item-megadescription-<?php echo $item_id; ?>" class="widefat edit-menu-item-megadescription" rows="3" cols="20" name="menu-item-megadescription[<?php echo $item_id; ?>]"><?php echo esc_html( $item->megadescription ); // textarea_escaped ?></textarea>
                        </label>
                    </p>
                    
                </div>
                <?php // custom field for mega menu  end?>
				<?php if( 'custom' == $item->type ) : ?>
					<p class="field-url description description-wide">
						<label for="edit-menu-item-url-<?php echo $item_id; ?>">
							<?php _e( 'URL' ,Penguin::$THEME_NAME); ?><br />
							<input type="text" id="edit-menu-item-url-<?php echo $item_id; ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
						</label>
					</p>
				<?php endif; ?>
				<p class="description description-thin">
					<label for="edit-menu-item-title-<?php echo $item_id; ?>">
						<?php _e( 'Navigation Label' ,Penguin::$THEME_NAME); ?><br />
						<input type="text" id="edit-menu-item-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
					</label>
				</p>
				<p class="description description-thin">
					<label for="edit-menu-item-attr-title-<?php echo $item_id; ?>">
						<?php _e( 'Title Attribute' ,Penguin::$THEME_NAME); ?><br />
						<input type="text" id="edit-menu-item-attr-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
					</label>
				</p>
				<p class="field-link-target description">
					<label for="edit-menu-item-target-<?php echo $item_id; ?>">
						<input type="checkbox" id="edit-menu-item-target-<?php echo $item_id; ?>" value="_blank" name="menu-item-target[<?php echo $item_id; ?>]"<?php checked( $item->target, '_blank' ); ?> />
						<?php _e( 'Open link in a new window/tab' ,Penguin::$THEME_NAME); ?>
					</label>
				</p>
				<p class="field-css-classes description description-thin">
					<label for="edit-menu-item-classes-<?php echo $item_id; ?>">
						<?php _e( 'CSS Classes (optional)' ,Penguin::$THEME_NAME); ?><br />
						<input type="text" id="edit-menu-item-classes-<?php echo $item_id; ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo $item_id; ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
					</label>
				</p>
				<p class="field-xfn description description-thin">
					<label for="edit-menu-item-xfn-<?php echo $item_id; ?>">
						<?php _e( 'Link Relationship (XFN)' ,Penguin::$THEME_NAME); ?><br />
						<input type="text" id="edit-menu-item-xfn-<?php echo $item_id; ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
					</label>
				</p>
				<p class="field-description description description-wide">
					<label for="edit-menu-item-description-<?php echo $item_id; ?>">
						<?php _e( 'Description' ,Penguin::$THEME_NAME); ?><br />
						<textarea id="edit-menu-item-description-<?php echo $item_id; ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo $item_id; ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
						<span class="description"><?php _e('The description will be displayed in the menu if the current theme supports it.',Penguin::$THEME_NAME); ?></span>
					</label>
				</p>

				<p class="field-move hide-if-no-js description description-wide">
					<label>
						<span><?php _e( 'Move' ,Penguin::$THEME_NAME); ?></span>
						<a href="#" class="menus-move-up"><?php _e( 'Up one' ,Penguin::$THEME_NAME); ?></a>
						<a href="#" class="menus-move-down"><?php _e( 'Down one' ,Penguin::$THEME_NAME); ?></a>
						<a href="#" class="menus-move-left"></a>
						<a href="#" class="menus-move-right"></a>
						<a href="#" class="menus-move-top"><?php _e( 'To the top' ,Penguin::$THEME_NAME); ?></a>
					</label>
				</p>

				<div class="menu-item-actions description-wide submitbox">
					<?php if( 'custom' != $item->type && $original_title !== false ) : ?>
						<p class="link-to-original">
							<?php printf( __('Original: %s',Penguin::$THEME_NAME), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
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
					); ?>"><?php _e( 'Remove' ,Penguin::$THEME_NAME); ?></a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo $item_id; ?>" href="<?php echo esc_url( add_query_arg( array( 'edit-menu-item' => $item_id, 'cancel' => time() ), admin_url( 'nav-menus.php' ) ) );
						?>#menu-item-settings-<?php echo $item_id; ?>"><?php _e('Cancel',Penguin::$THEME_NAME); ?></a>
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


?>
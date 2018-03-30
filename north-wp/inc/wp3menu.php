<?php
add_action('init','thb_register_my_menus');

function thb_register_my_menus() {
	register_nav_menus(
		array(
			'nav-menu' => __( 'Navigation Menu','north' ),
			'acc-menu-out' => __( 'Secondary Menu (Not Logged-in)', 'north' ),
			'acc-menu-in' => __( 'Secondary Menu (Logged-in)', 'north' ),
			'mobile-menu' => __( 'Mobile Menu','north' ),
			'footer-menu' => __( 'Footer Menu','north' )
		)
	);
}

/**
 * Custom Walker - Mobile Menu
 *
 * @access      public
 * @since       1.0 
 * @return      void
*/
class thb_mobileDropdown extends Walker_Nav_Menu {

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class=" ' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names .'>';

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}
		$children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>'. (!empty($children) ? '<span><i class="fa fa-plus"></i></span>' : '');
		
		/** This filter is documented in wp-includes/post-template.php */
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;


		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

/**
 * Custom Walker
 *
 * @access      public
 * @since       1.0 
 * @return      void
*/
class thb_MegaMenu extends Walker_Nav_Menu {

  var $active_megamenu = 0;

  /**
   * @see Walker::start_lvl()
   *
   * @param string $output Passed by reference. Used to append additional content.
   * @param int $depth Depth of page. Used for padding.
   */
  function start_lvl(&$output, $depth = 0, $args = array()) {
  		
      $indent = str_repeat("\t", $depth);
      
      if ($this->active_megamenu && $depth === 0) {
      	$output .= "\n$indent<div class=\"thb_mega_holder\"><ul class=\"sub-menu {locate_class}\">\n";
      }	else if ($this->active_megamenu && $depth === 1) {
      	$output .= "\n$indent<ul class=\"sub-menu{locate2_class}\">\n";
      }	else {
    		$output .= "\n$indent<ul class=\"sub-menu \">\n";
  		}

  }

  /**
   * @see Walker::end_lvl()
   *
   * @param string $output Passed by reference. Used to append additional content.
   * @param int $depth Depth of page. Used for padding.
   */
  function end_lvl(&$output, $depth = 0, $args = array()) {
      $indent = str_repeat("\t", $depth);
      

      if ($this->active_megamenu && $depth === 0) {
      		$output = str_replace("{locate_class}", " thb_mega_menu row full-width-row", $output);
          $output .= "$indent</ul></div>\n";
      } else if ($this->active_megamenu && $depth === 1) {
          $output = str_replace("{locate2_class}", " thb_mega_submenu", $output);
          $output .= "$indent</ul>\n";
      } else {
          $output = str_replace("{locate_class}", " thb_mega_submenu", $output);
          $output .= "$indent</ul>\n";
      }
  }    

  function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0) {
      $item_output = $column_class = "";
      
      $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
      		
  		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
  		$classes[] = 'menu-item-' . $item->ID;
  		
  		/**
			 * Filters the arguments for a single nav menu item.
			 *
			 * @since 4.4.0
			 *
			 * @param array  $args  An array of arguments.
			 * @param object $item  Menu item data object.
			 * @param int    $depth Depth of menu item. Used for padding.
			 */
			$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );
			
  		/**
			 * Filters the CSS class(es) applied to a menu item's list item element.
			 *
			 * @since 3.0.0
			 * @since 4.1.0 The `$depth` parameter was added.
			 *
			 * @param array  $classes The CSS classes that are applied to the menu item's `<li>` element.
			 * @param object $item    The current menu item.
			 * @param array  $args    An array of wp_nav_menu() arguments.
			 * @param int    $depth   Depth of menu item. Used for padding.
			 */
			if($depth === 0) {   
			    $this->active_megamenu = get_post_meta( $item->ID, '_menu_item_megamenu', true);
			    if($this->active_megamenu) { $classes[] = "menu-item-mega-parent"; }
			}
			if($depth === 1) {   
			    if($this->active_megamenu) { $classes[] = "menu-item-mega-child small-12 medium-3 columns"; }  
			}
			if($depth === 2) {   
			    if($this->active_megamenu) { $classes[] = "menu-item-mega-link"; }  
			}
			
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
			
			/**
			 * Filters the ID applied to a menu item's list item element.
			 *
			 * @since 3.0.1
			 * @since 4.1.0 The `$depth` parameter was added.
			 *
			 * @param string $menu_id The ID that is applied to the menu item's `<li>` element.
			 * @param object $item    The current menu item.
			 * @param array  $args    An array of wp_nav_menu() arguments.
			 * @param int    $depth   Depth of menu item. Used for padding.
			 */
			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
			
			$output .= $indent . '<li' . $id . $class_names .'>';
			
      $atts = array();
      $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
  		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
  		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
  		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';
  		
      $menu_icon_tag  = ! empty( $item->menuicon ) ? '<i class="fa '.esc_attr( $item->menuicon ).'"></i>' : '';
      $menu_anchor  = ! empty( $item->menuanchor ) ? '#'.esc_attr( $item->menuanchor ) : '';
      $menu_image  = ! empty( $item->menuimage ) ? esc_attr( $item->menuimage ) : '';
      $atts['class'] = ! empty( $item->menuimage ) ? 'menu-image' : '';
      
      /**
  		 * Filters the HTML attributes applied to a menu item's anchor element.
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
  		 * @param array  $args  An array of wp_nav_menu() arguments.
  		 * @param int    $depth Depth of menu item. Used for padding.
  		 */
  		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );
  		$attributes = '';
  		foreach ( $atts as $attr => $value ) {
  			if ( ! empty( $value ) ) {
  				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
  				$attributes .= ' ' . $attr . '="' . $value . '"';
  			}
  		}
  		/** This filter is documented in wp-includes/post-template.php */
  		$title = apply_filters( 'the_title', $item->title, $item->ID );	
  		
  		/**
			 * Filters a menu item's title.
			 *
			 * @since 4.4.0
			 *
			 * @param string $title The menu item's title.
			 * @param object $item  The current menu item.
			 * @param array  $args  An array of wp_nav_menu() arguments.
			 * @param int    $depth Depth of menu item. Used for padding.
			 */
			$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );
			
      $item_output = $args->before;
      if($depth === 1 && $this->active_megamenu && empty( $menu_image ))  {
      	$item_output .= '<div class="megamenu-title">';
      }
      $item_output .= '<a'. $attributes .'>';
      $item_output .= $menu_icon_tag;
      if (! empty( $menu_image )) {
      	$item_output .= $args->link_before;
      	$item_output .= '<img src="'.$menu_image.'" alt="'.apply_filters( 'the_title', $item->title, $item->ID ).'" />';
      	$item_output .= $args->link_after;
      } else {
      	$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
      }
      $item_output .= '</a>';
      if($depth === 1 && $this->active_megamenu && empty( $menu_image ) )  {
      	$item_output .= '</div>';
      }
      $item_output .= $args->after;
      
      /**
  		 * Filters a menu item's starting output.
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
  		 * @param array  $args        An array of wp_nav_menu() arguments.
  		 */
  		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
  }
}

/**
 * Custom Walker - One Page Menu
 *
 * @access      public
 * @since       1.0 
 * @return      void
*/
class thb_OnePageMenu extends Walker_Nav_Menu {  
	function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

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

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';
		$menu_icon_tag  = ! empty( $item->menuicon ) ? '<i class="fa '.esc_attr( $item->menuicon ).'"></i>' : '';
		$menu_anchor  = ! empty( $item->menuanchor ) ? '#'.esc_attr( $item->menuanchor ) : '';
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
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value.$menu_anchor ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}
		  
		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		/** This filter is documented in wp-includes/post-template.php */
		$item_output .= $menu_icon_tag;
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
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
	  
	}
}

/* Custom Menu Fields */
$GLOBALS['thb_custom_menu'] = new rc_thb_custom_menu();

class rc_thb_custom_menu {

    /*--------------------------------------------*
     * Constructor
     *--------------------------------------------*/

    /**
     * Initializes the plugin by setting localization, filters, and administration functions.
     */
    function __construct() {

        
        // add custom menu fields to menu
        add_filter( 'wp_setup_nav_menu_item', array( $this, 'rc_scm_add_custom_nav_fields' ) );

        // save menu custom fields
        add_action( 'wp_update_nav_menu_item', array( $this, 'rc_scm_update_custom_nav_fields'), 10, 3 );
        
        // edit menu walker
        add_filter( 'wp_edit_nav_menu_walker', array( $this, 'rc_scm_edit_walker'), 10, 2 );

    } // end constructor
    

    /**
     * Add custom fields to $item nav object
     * in order to be used in custom Walker
     *
     * @access      public
     * @since       1.0 
     * @return      void
    */
    function rc_scm_add_custom_nav_fields( $menu_item ) {
    
        $menu_item->menuicon = get_post_meta( $menu_item->ID, '_menu_item_menuicon', true );
        $menu_item->menuanchor = get_post_meta( $menu_item->ID, '_menu_item_menuanchor', true );
        $menu_item->megamenu = get_post_meta( $menu_item->ID, '_menu_item_megamenu', true );
        $menu_item->menuimage = get_post_meta( $menu_item->ID, '_menu_item_menuimage', true );
        return $menu_item;
        
    }
    
    /**
     * Save menu custom fields
     *
     * @access      public
     * @since       1.0 
     * @return      void
    */
    function rc_scm_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {
    
        // Check if element is properly sent

        if (!empty($_REQUEST['edit-menu-item-menuicon']) && is_array( $_REQUEST['edit-menu-item-menuicon']) ) {
            $menu_icon_value = $_REQUEST['edit-menu-item-menuicon'][$menu_item_db_id];
            update_post_meta( $menu_item_db_id, '_menu_item_menuicon', $menu_icon_value );
        }
				
				if (!empty($_REQUEST['edit-menu-item-menuanchor'][$menu_item_db_id])) {
				    $menu_anchor_value = $_REQUEST['edit-menu-item-menuanchor'][$menu_item_db_id];  
				    update_post_meta( $menu_item_db_id, '_menu_item_menuanchor', $menu_anchor_value );
				}
				if (!empty($_REQUEST['edit-menu-item-menuimage']) && is_array( $_REQUEST['edit-menu-item-menuimage']) ) {
				    $menu_image_value = $_REQUEST['edit-menu-item-menuimage'][$menu_item_db_id];
				    update_post_meta( $menu_item_db_id, '_menu_item_menuimage', $menu_image_value );
				}
				if (!isset($_REQUEST['edit-menu-item-megamenu'][$menu_item_db_id])) {
				    $_REQUEST['edit-menu-item-megamenu'][$menu_item_db_id] = '';
				}
				$menu_mega_enabled_value = $_REQUEST['edit-menu-item-megamenu'][$menu_item_db_id];        
				update_post_meta( $menu_item_db_id, '_menu_item_megamenu', $menu_mega_enabled_value );
    }
    
    /**
     * Define new Walker edit
     *
     * @access      public
     * @since       1.0 
     * @return      void
    */
    function rc_scm_edit_walker($walker,$menu_id) {
    
        return 'Walker_Nav_Menu_Edit_Custom'; 
    }
}

/**
 *  /!\ This is a copy of Walker_Nav_Menu_Edit class in core
 * 
 * Create HTML list of nav menu input items.
 *
 * @package WordPress
 * @since 3.0.0
 * @uses Walker_Nav_Menu
 */
class Walker_Nav_Menu_Edit_Custom extends Walker_Nav_Menu  {
	/**
	 * @see Walker::$tree_type
	 * @var string
	 */
	var $tree_type = array( 'post_type', 'taxonomy', 'custom' );
	
	/**
	 * @see Walker::$db_fields
	 * @todo Decouple this.
	 * @var array
	 */
	var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );
	
	var $thb_icons;
	
	function __construct() {
	    $this->thb_icons = thb_getIconArray();
	}
	
	/**
	 * @see Walker_Nav_Menu::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 */
	function start_lvl(&$output, $depth = 0, $args = array()) {  
	}
	
	/**
	 * @see Walker_Nav_Menu::end_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 */
	function end_lvl(&$output, $depth = 0, $args = array()) {
	}
	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param object $args
	 */
	function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0) {
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
		    if ( is_wp_error( $original_title ) )
		        $original_title = false;
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
		
		if ( ! empty( $item->_invalid ) ) {
		    $classes[] = 'menu-item-invalid';
		    /* translators: %s: title of menu item which is invalid */
		    $title = sprintf( __( '%s (Invalid)', 'north'), $item->title );
		} elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
		    $classes[] = 'pending';
		    /* translators: %s: title of menu item in draft status */
		    $title = sprintf( __('%s (Pending)', 'north'), $item->title );
		}
		
		$title = empty( $item->label ) ? $title : $item->label;
		
		?>
		<li id="menu-item-<?php echo $item_id; ?>" class="<?php echo implode(' ', $classes ); ?>">
			<dl class="menu-item-bar">
					<dt class="menu-item-handle">
					    <span class="item-title"><?php echo esc_html( $title ); ?></span>
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
					            ?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up', 'north'); ?>">&#8593;</abbr></a>
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
					            ?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down','north'); ?>">&#8595;</abbr></a>
					        </span>
					        <a class="item-edit" id="edit-<?php echo $item_id; ?>" title="<?php esc_attr_e('Edit Menu Item', 'north'); ?>" href="<?php
					            echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
					        ?>"><?php _e( 'Edit Menu Item', 'north'); ?></a>
					    </span>
					</dt>
				</dl>
		
		  <div class="menu-item-settings clearfix" id="menu-item-settings-<?php echo $item_id; ?>">
		        <?php if( 'custom' == $item->type ) : ?>
		            <p class="field-url description description-wide">
		                <label for="edit-menu-item-url-<?php echo $item_id; ?>">
		                    <?php _e( 'URL', 'north' ); ?><br />
		                    <input type="text" id="edit-menu-item-url-<?php echo $item_id; ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
		                </label>
		            </p>
		        <?php endif; ?>
		        <p class="description description-thin">
		            <label for="edit-menu-item-title-<?php echo $item_id; ?>">
		                <?php _e( 'Navigation Label', 'north' ); ?><br />
		                <input type="text" id="edit-menu-item-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
		            </label>
		        </p>
		        <p class="description description-thin">
		            <label for="edit-menu-item-attr-title-<?php echo $item_id; ?>">
		                <?php _e( 'Title Attribute', 'north' ); ?><br />
		                <input type="text" id="edit-menu-item-attr-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
		            </label>
		        </p>
		        <p class="field-link-target description">
		            <label for="edit-menu-item-target-<?php echo $item_id; ?>">
		                <input type="checkbox" id="edit-menu-item-target-<?php echo $item_id; ?>" value="_blank" name="menu-item-target[<?php echo $item_id; ?>]"<?php checked( $item->target, '_blank' ); ?> />
		                <?php _e( 'Open link in a new window/tab', 'north' ); ?>
		            </label>
		        </p>
		        <p class="field-css-classes description description-thin">
		            <label for="edit-menu-item-classes-<?php echo $item_id; ?>">
		                <?php _e( 'CSS Classes (optional)', 'north' ); ?><br />
		                <input type="text" id="edit-menu-item-classes-<?php echo $item_id; ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo $item_id; ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
		            </label>
		        </p>
		        <p class="field-xfn description description-thin">
		            <label for="edit-menu-item-xfn-<?php echo $item_id; ?>">
		                <?php _e( 'Link Relationship (XFN)', 'north'  ); ?><br />
		                <input type="text" id="edit-menu-item-xfn-<?php echo $item_id; ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
		            </label>
		        </p>
		        <p class="field-description description description-wide">
		            <label for="edit-menu-item-description-<?php echo $item_id; ?>">
		                <?php _e( 'Description', 'north' ); ?><br />
		                <textarea id="edit-menu-item-description-<?php echo $item_id; ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo $item_id; ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
		                <span class="description"><?php _e('The description will be displayed in the menu if the current theme supports it.', 'north'); ?></span>
		            </label>
		        </p>
						<?php do_action( 'wp_nav_menu_item_custom_fields', $item_id, $item, $depth, $args );?>
		
		        <div class="clearboth"></div>
		        <div class="thb_menu_options">
		        	<h2><?php _e('Fuel Themes Menu Options', 'north'); ?></h2>   
		          <div class="thb-field-link description description-thin">
		            <h3><?php _e( 'Menu Item Icon', 'north' ); ?></h3>
		            <?php $saved = get_post_meta( $item_id, '_menu_item_menuicon', true); ?>
		            <select id="edit-menu-item-menuicon-<?php echo $item_id; ?>" name="edit-menu-item-menuicon[<?php echo $item_id; ?>]">
		            	
		            	<?php foreach ($this->thb_icons as $key => $value) { ?>
		            		<?php $selected = ($key === $saved ? " selected" : ""); ?>
		            		<option value="<?php echo $key; ?>"<?php echo $selected; ?>><?php echo $value; ?></option>
		            	<?php } ?>
		            </select>
		          </div>
<!--							<div class="thb-field-link description description-thin">
							  <h3><?php _e( 'Menu Item Anchor', 'north' ); ?></h3>
							  <?php $savedanchor = get_post_meta( $item_id, '_menu_item_menuanchor', true);?>
							  <input type="text" id="edit-menu-item-menuanchor-<?php echo $item_id; ?>" name="edit-menu-item-menuanchor[<?php echo $item_id; ?>]" value="<?php echo $savedanchor; ?>"/>
							</div>-->
							<div class="thb-field-link-mega description description-thin">
		          	<h3><?php _e( 'Mega Menu', 'north'  ); ?></h3>
		              <?php 
		
		                  $value = get_post_meta( $item_id, '_menu_item_megamenu', true);
		                  if($value != "") $value = "checked='checked'";
		
		              ?>
		              <label for="edit-menu-item-megamenu-<?php echo $item_id; ?>">
		                  <input type="checkbox" value="enabled" id="edit-menu-item-megamenu-<?php echo $item_id; ?>" name="edit-menu-item-megamenu[<?php echo $item_id; ?>]" <?php echo $value; ?> />
		                  <?php _e( 'Enable', 'north'  ); ?>
		              </label>
		          </div>
		          <div class="thb-field-link-image description description-thin">
              	<h3><?php _e( 'Image', 'north'  ); ?></h3>
                  <?php $savedimage = get_post_meta( $item_id, '_menu_item_menuimage', true);?>
                  <input type="text" id="edit-menu-item-menuimage-<?php echo $item_id; ?>" name="edit-menu-item-menuimage[<?php echo $item_id; ?>]" value="<?php echo $savedimage; ?>"/>
              </div>
		      </div>
		     
		
		      <div class="menu-item-actions description-wide submitbox">
		          <?php if( 'custom' != $item->type && $original_title !== false ) : ?>
		              <p class="link-to-original">
		                  <?php printf( __('Original: %s', 'north'), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
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
		          ); ?>"><?php _e('Remove', 'north' ); ?></a> <span class="meta-sep"> | </span> <a class="item-cancel submitcancel" id="cancel-<?php echo $item_id; ?>" href="<?php echo esc_url( add_query_arg( array('edit-menu-item' => $item_id, 'cancel' => time()), remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) ) ) );
		              ?>#menu-item-settings-<?php echo $item_id; ?>"><?php _e('Cancel', 'north'); ?></a>
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
<?php

/*
|--------------------------------------------------------------------------
| Add Iconclass Custom Field
|--------------------------------------------------------------------------
*/

if ( !function_exists( 'ut_add_custom_nav_fields' ) ) {

    function ut_add_custom_nav_fields( $menu_item ) {
        
        $menu_item->menutype = get_post_meta( $menu_item->ID, '_menu_item_menutype', true );
        return $menu_item;
        
    }
    
    /* add custom menu fields to menu */
    add_filter( 'wp_setup_nav_menu_item', 'ut_add_custom_nav_fields' );

}

/*
|--------------------------------------------------------------------------
| Update Iconclass Custom Field
|--------------------------------------------------------------------------
*/

if ( !function_exists( 'ut_update_custom_nav_fields' ) ) {
    
    function ut_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {
        
        if ( isset($_REQUEST['menu-item-menutype']) && is_array( $_REQUEST['menu-item-menutype']) && isset( $_REQUEST['menu-item-menutype'][$menu_item_db_id] ) ) {
            $menutypeclass_value = $_REQUEST['menu-item-menutype'][$menu_item_db_id];
            update_post_meta( $menu_item_db_id, '_menu_item_menutype', $menutypeclass_value );
        }
        
    }
    
    /* save menu custom fields */
    add_action( 'wp_update_nav_menu_item', 'ut_update_custom_nav_fields' , 10 , 3 );

}

/*
|--------------------------------------------------------------------------
| Edit Menutype Custom Field
|--------------------------------------------------------------------------
*/

if ( !function_exists( 'ut_edit_walker' ) ) {

    function ut_edit_walker( $walker , $menu_id ) {
        
        return 'Walker_Nav_Menu_Edit_Custom';
        
    }
    
    /* edit menu walker */
    add_filter( 'wp_edit_nav_menu_walker', 'ut_edit_walker' , 10 , 2 );

}

/*
|--------------------------------------------------------------------------
| Enhance "Appearance" => "Menus"
|--------------------------------------------------------------------------
*/

class Walker_Nav_Menu_Edit_Custom extends Walker_Nav_Menu  {
	
    /**
	 * @see Walker_Nav_Menu::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {	
	}
	
	/**
	 * @see Walker_Nav_Menu::end_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 */
	function end_lvl( &$output, $depth = 0, $args = array() ) {
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
	function start_el( &$output, $item, $depth = 0, $args = array() , $current_object_id = 0 ) {
	    
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
	        $title = sprintf( __( '%s (Invalid)' , 'unitedthemes' ), $item->title );
	    } elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
	        $classes[] = 'pending';
	        /* translators: %s: title of menu item in draft status */
	        $title = sprintf( __('%s (Pending)' , 'unitedthemes' ), $item->title );
	    }
	
	    $title = empty( $item->label ) ? $title : $item->label;
	
	    ?>
	    <li id="menu-item-<?php echo $item_id; ?>" class="<?php echo implode(' ', $classes ); ?>">
	        <dl class="menu-item-bar">
	            <dt class="menu-item-handle">
	                <span class="item-title"><?php echo esc_html( $title ); ?></span>
	                <span class="item-controls">
	                    <span class="item-type"><?php 
                        
                        if( $item->object == 'portfolio' ) {
                        
                            echo esc_html__( 'Portfolio', 'unitedthemes' ); 
                        
                        } else {
                            
                            echo esc_html( $item->type_label );        
                            
                        }
                        
                        ?></span>
	                    <span class="item-order hide-if-js">
	                        <a href="<?php
	                            echo wp_nonce_url(
	                                esc_url( add_query_arg(
	                                    array(
	                                        'action' => 'move-up-menu-item',
	                                        'menu-item' => $item_id,
	                                    ),
	                                    esc_url( remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) ) )
	                                )),
	                                'move-menu_item'
	                            );
	                        ?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up' , 'unitedthemes'); ?>">&#8593;</abbr></a>
	                        |
	                        <a href="<?php
	                            echo wp_nonce_url(
	                                esc_url( add_query_arg(
	                                    array(
	                                        'action' => 'move-down-menu-item',
	                                        'menu-item' => $item_id,
	                                    ),
	                                    esc_url( remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) ) )
	                                )),
	                                'move-menu_item'
	                            );
	                        ?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down' , 'unitedthemes'); ?>">&#8595;</abbr></a>
	                    </span>
	                    <a class="item-edit" id="edit-<?php echo $item_id; ?>" title="<?php esc_attr_e('Edit Menu Item' , 'unitedthemes' ); ?>" href="<?php
	                        echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : esc_url( add_query_arg( 'edit-menu-item', $item_id, esc_url( remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) ) ) );
	                    ?>"><?php _e( 'Edit Menu Item' , 'unitedthemes' ); ?></a>
	                </span>
	            </dt>
	        </dl>
	
	        <div class="menu-item-settings wp-clearfix" id="menu-item-settings-<?php echo $item_id; ?>">
	            <?php if( 'custom' == $item->type ) : ?>
	                <p class="field-url description description-wide">
	                    <label for="edit-menu-item-url-<?php echo $item_id; ?>">
	                        <?php _e( 'URL' , 'unitedthemes' ); ?><br />
	                        <input type="text" id="edit-menu-item-url-<?php echo $item_id; ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
	                    </label>
	                </p>
	            <?php endif; ?>
	            <p class="description description-thin">
	                <label for="edit-menu-item-title-<?php echo $item_id; ?>">
	                    <?php _e( 'Navigation Label' , 'unitedthemes' ); ?><br />
	                    <input type="text" id="edit-menu-item-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
	                </label>
	            </p>
	            <p class="description description-thin">
	                <label for="edit-menu-item-attr-title-<?php echo $item_id; ?>">
	                    <?php _e( 'Title Attribute' , 'unitedthemes' ); ?><br />
	                    <input type="text" id="edit-menu-item-attr-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
	                </label>
	            </p>
	            <p class="field-link-target description">
	                <label for="edit-menu-item-target-<?php echo $item_id; ?>">
	                    <input type="checkbox" id="edit-menu-item-target-<?php echo $item_id; ?>" value="_blank" name="menu-item-target[<?php echo $item_id; ?>]"<?php checked( $item->target, '_blank' ); ?> />
	                    <?php _e( 'Open link in a new window/tab' , 'unitedthemes' ); ?>
	                </label>
	            </p>
	            <p class="field-css-classes description description-thin">
	                <label for="edit-menu-item-classes-<?php echo $item_id; ?>">
	                    <?php _e( 'CSS Classes (optional)' , 'unitedthemes' ); ?><br />
	                    <input type="text" id="edit-menu-item-classes-<?php echo $item_id; ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo $item_id; ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
	                </label>
	            </p>
	            <p class="field-xfn description description-thin">
	                <label for="edit-menu-item-xfn-<?php echo $item_id; ?>">
	                    <?php _e( 'Link Relationship (XFN)' , 'unitedthemes' ); ?><br />
	                    <input type="text" id="edit-menu-item-xfn-<?php echo $item_id; ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
	                </label>
	            </p>
	            <p class="field-description description description-wide">
	                <label for="edit-menu-item-description-<?php echo $item_id; ?>">
	                    <?php _e( 'Description' , 'unitedthemes' ); ?><br />
	                    <textarea id="edit-menu-item-description-<?php echo $item_id; ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo $item_id; ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
	                    <span class="description"><?php _e( 'The description will be displayed in the menu if the current theme supports it.' , 'unitedthemes' ); ?></span>
	                </label>
	            </p>        
	            
                <?php
	            /* New fields insertion starts here */
	            ?>      
	            
                <?php 
                
                if( $item->object_id != get_option('page_for_posts') && $item->object_id != get_option('page_on_front') ) : ?>
                
                <p class="field-custom description description-wide">
	                <label for="edit-menu-item-menutype-<?php echo $item_id; ?>">
	                    
						<?php _e( 'Menu Type' , 'unitedthemes' ); ?><br />
	                    
                        <?php
                            
                            /* fallback if there is no menutype has been set yet */
                            if( empty( $item->menutype ) ) {
                                
                                $selected = get_post_meta( $item->object_id, 'ut_page_type', true );
                                
                            } else {
                            
                                $selected = $item->menutype;
                                
                            }
                            
                        ?>
                        
                        <select id="edit-menu-item-menutype-<?php echo $item_id; ?>" name="menu-item-menutype[<?php echo $item_id; ?>]">
                        	
                            <?php if( $item->object == 'portfolio' ) { ?>
                            
                                <option value="page" <?php selected('page' , esc_attr( $selected ) , true); ?>><?php _e( 'Page' , 'unitedthemes'); ?></option>
                                <option value="section" <?php selected('section' , esc_attr( $selected ) , true); ?>><?php _e( 'Section' , 'unitedthemes'); ?></option>
                            
                            <?php } else { ?>
                                
                                <option value="page" <?php selected('page' , esc_attr( $selected ) , true); ?>><?php _e( 'Page' , 'unitedthemes'); ?></option>
                                <option value="section" <?php selected('section' , esc_attr( $selected ) , true); ?>><?php _e( 'Section' , 'unitedthemes'); ?></option>                                                                
                            
                            <?php } ?>
                            
                        </select>
                        
	                </label>
	            </p>
                
                <?php endif; ?>
                
	            <?php
	            /* New fields insertion ends here */
	            ?>
                
	            <div class="menu-item-actions description-wide submitbox">
	                <?php if( 'custom' != $item->type && $original_title !== false ) : ?>
	                    <p class="link-to-original">
	                        <?php printf( __('Original: %s' , 'unitedthemes' ), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
	                    </p>
	                <?php endif; ?>
	                <a class="item-delete submitdelete deletion" id="delete-<?php echo $item_id; ?>" href="<?php
	                echo wp_nonce_url(
	                    esc_url( add_query_arg(
	                        array(
	                            'action' => 'delete-menu-item',
	                            'menu-item' => $item_id,
	                        ),
	                        esc_url( remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) ) )
	                    )),
	                    'delete-menu_item_' . $item_id
	                ); ?>"><?php _e('Remove' , 'unitedthemes'); ?></a> <span class="meta-sep"> | </span> <a class="item-cancel submitcancel" id="cancel-<?php echo $item_id; ?>" href="<?php echo esc_url( add_query_arg( array('edit-menu-item' => $item_id, 'cancel' => time()), esc_url( remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) ) ) ) );
	                    ?>#menu-item-settings-<?php echo $item_id; ?>"><?php _e('Cancel' , 'unitedthemes' ); ?></a>
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





/*
|--------------------------------------------------------------------------
| Custom Walker for wp_nav_menu args
|--------------------------------------------------------------------------
*/
 
class ut_menu_walker extends Walker_Nav_Menu {

	
      function start_el( &$output, $item, $depth = 0, $args = array() , $current_object_id = 0 ) {
          
           global $wp_query;
		   
   		   /* front and blog page */
		   $blog_page_id 	= get_option('page_for_posts');
		   $front_page_id 	= get_option('page_on_front');
		   
		   /* extra settings */		   
		   $blog_url    = esc_url( home_url() );
		   $front_url   = is_front_page() ? '#top' : esc_url( home_url() );
		   $extraClass	= !is_front_page() ? 'external' : '';
		   
           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
			
		   /* reset values */	
           $class_names = $class_names_cache = $value = $post_data = '';
                        	
		   /*class name for front page */
		   if( is_front_page() && $front_page_id == $item->object_id )	{
			  
			   $class_names = ' class="ut-home-link"';
			  
		   } else {	
						
			   $classes = empty( $item->classes ) ? array() : (array) $item->classes;
			   $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
			   $class_names_cache = $class_names = ' class="'. esc_attr( $class_names ) . ' ' . $extraClass . '"';               
		   
		   }
		   
           if( strpos($class_names, 'contact-us') !== false ) {
           
                $ut_activate_csection = ot_get_option('ut_activate_csection');
                        
                if( ut_return_csection_config('ut_activate_csection' , 'on') == 'off' && is_array( $ut_activate_csection ) && in_array( 'is_front_page', $ut_activate_csection ) ) {
                    
                    $class_names = str_replace('contact-us', '', $class_names);                    
                    
                }
           
           }
           
		   $output .= $indent . '<li ' . $value . $class_names .'>';
		   
		   if ( !empty( $item->object_id ) ) {
		        $post_data = get_post($item->object_id);
		   }
		   
		   $slug = ( isset($post_data->post_name) ) ? ut_clean_section_id( $post_data->post_name ) : '';
		   		   
           $attributes  = ! empty( $item->attr_title )  ? ' title="'   . esc_attr( $item->attr_title ) .'"' : '';
           $attributes .= ! empty( $item->target )      ? ' target="'  . esc_attr( $item->target ) .'"' : '';
           $attributes .= ! empty( $item->xfn )         ? ' rel="'     . esc_attr( $item->xfn ) .'"' : '';
            
		   /* create a regular link for the blog - all other menu items are anchors */
		   if( $blog_page_id == $item->object_id || $item->menutype == 'page' && $item->title != 'Home') {
		   		
                if( strpos($class_names_cache, 'contact-us') !== false ) {
                
                    if( ut_return_csection_config('ut_activate_csection' , 'on') == 'on' ) {
                    
                        $attributes .= ! empty( $item->url ) ? ' href="'   . esc_attr( $item->url ) .'"' : '';
                        
                    } else {
                         
                        $ut_activate_csection = ot_get_option('ut_activate_csection');
                        
                        if( is_array( $ut_activate_csection ) && in_array( 'is_front_page', $ut_activate_csection ) ) {
                            
                            $attributes .= ! empty( $item->url ) ? ' href="' . $blog_url . '/'   . esc_attr( $item->url ) .'"' : '';    
                            $extraClass = 'external';
                            
                        }
                        
                    }        
                
                } else {
                
                    $attributes .= ! empty( $item->url ) ? ' href="'   . esc_attr( $item->url ) .'"' : '';     
                    $extraClass = 'external';    
                }
          
           /* create a regular link for the front page or an anchors - depends on which page we are */  
		   } elseif( $front_page_id == $item->object_id || $item->title == 'Home' ) {
		   		
				/* anchor if is front page */
				if( is_front_page() || $item->title == 'Home' && is_front_page() ) {
					
					$attributes .= ! empty( $item->url ) ? ' href="#top"' : '';
				
				/* regular link if not */	
				} else {
					
                    if( $item->title != 'Home' ) {
                        
                        $attributes .= ! empty( $item->url ) ? ' href="'   . esc_attr( $item->url ) .'"' : '';
					
                    } else {
                    
                        $attributes .= ' href="'   . esc_attr( get_permalink( $front_page_id ) ) .'"';    
                        
                    }
                        
				}
		   
		   } else {
				
				$attributes .= ! empty( $slug ) ? ' href="' . $blog_url . '/#section-' . esc_attr( $slug ) .'"' : '';
		        
		   }
		   
           /* WPML temp fix */
           $attributes = str_replace('//#section-','/#section-',$attributes);
           

           $prepend = '';
           $append = '';
                                    
           if($depth >= 2)
           {
	           $append = $prepend = "";
           }

           $item_output  = $args->before;
           $item_output .= '<a'. $attributes .' class="' . $extraClass . '">';
           $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
           $item_output .= $args->link_after;
           $item_output .= '</a>';
           $item_output .= $args->after;

           $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
           
           }
}
?>
<?php
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
	        $title = sprintf( __( '%s (Invalid)', 'swift-framework-admin' ), $item->title );
	    } elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
	        $classes[] = 'pending';
	        /* translators: %s: title of menu item in draft status */
	        $title = sprintf( __('%s (Pending)', 'swift-framework-admin' ), $item->title );
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
	                        ?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down', 'swift-framework-admin'); ?>">&#8595;</abbr></a>
	                    </span>
	                    <a class="item-edit" id="edit-<?php echo $item_id; ?>" title="<?php esc_attr_e('Edit Menu Item'); ?>" href="<?php
	                        echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
	                    ?>"><?php _e( 'Edit Menu Item', 'swift-framework-admin' ); ?></a>
	                </span>
	            </dt>
	        </dl>
	
	        <div class="menu-item-settings" id="menu-item-settings-<?php echo $item_id; ?>">
	            <?php if( 'custom' == $item->type ) : ?>
	                <p class="field-url description description-wide">
	                    <label for="edit-menu-item-url-<?php echo $item_id; ?>">
	                        <?php _e( 'URL', 'swift-framework-admin' ); ?><br />
	                        <input type="text" id="edit-menu-item-url-<?php echo $item_id; ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
	                    </label>
	                </p>
	            <?php endif; ?>
	            <p class="description description-thin">
	                <label for="edit-menu-item-title-<?php echo $item_id; ?>">
	                    <?php _e( 'Navigation Label', 'swift-framework-admin' ); ?><br />
	                    <input type="text" id="edit-menu-item-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
	                </label>
	            </p>
	            <p class="description description-thin">
	                <label for="edit-menu-item-attr-title-<?php echo $item_id; ?>">
	                    <?php _e( 'Title Attribute', 'swift-framework-admin' ); ?><br />
	                    <input type="text" id="edit-menu-item-attr-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
	                </label>
	            </p>
	            <p class="field-link-target description">
	                <label for="edit-menu-item-target-<?php echo $item_id; ?>">
	                    <input type="checkbox" id="edit-menu-item-target-<?php echo $item_id; ?>" value="_blank" name="menu-item-target[<?php echo $item_id; ?>]"<?php checked( $item->target, '_blank' ); ?> />
	                    <?php _e( 'Open link in a new window/tab', 'swift-framework-admin' ); ?>
	                </label>
	            </p>
	            <p class="field-css-classes description description-thin">
	                <label for="edit-menu-item-classes-<?php echo $item_id; ?>">
	                    <?php _e( 'CSS Classes (optional)', 'swift-framework-admin' ); ?><br />
	                    <input type="text" id="edit-menu-item-classes-<?php echo $item_id; ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo $item_id; ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
	                </label>
	            </p>
	            <p class="field-xfn description description-thin">
	                <label for="edit-menu-item-xfn-<?php echo $item_id; ?>">
	                    <?php _e( 'Link Relationship (XFN)', 'swift-framework-admin' ); ?><br />
	                    <input type="text" id="edit-menu-item-xfn-<?php echo $item_id; ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
	                </label>
	            </p>
	            <p class="field-description description description-wide">
	                <label for="edit-menu-item-description-<?php echo $item_id; ?>">
	                    <?php _e( 'Description', 'swift-framework-admin' ); ?><br />
	                    <textarea id="edit-menu-item-description-<?php echo $item_id; ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo $item_id; ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
	                    <span class="description"><?php _e('The description will be displayed in the menu if the current theme supports it.', 'swift-framework-admin'); ?></span>
	                </label>
	            </p>        
	            <?php
	            /* New fields insertion starts here */
	            ?>      
	           <!-- <p class="field-custom description description-wide">
	                <label for="edit-menu-item-subtitle-<?php echo $item_id; ?>">
	                    <?php _e( 'Subtitle', 'swift-framework-admin' ); ?><br />
	                    <input type="text" id="edit-menu-item-subtitle-<?php echo $item_id; ?>" class="widefat edit-menu-item-custom" name="menu-item-subtitle[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->subtitle ); ?>" />
	                </label>
	            </p>-->
	            <!--<p class="field-custom description description-wide">
	                <label for="edit-menu-is-megamenu-<?php echo $item_id; ?>">
	                    <?php _e( 'Enable Mega Menu', 'swift-framework-admin' ); ?><br />
	                    <input type="checkbox" id="edit-menu-is-megamenu-<?php echo $item_id; ?>" class="edit-menu-item-custom" id="menu-is-megamenu[<?php echo $item_id; ?>]" name="menu-is-megamenu[<?php echo $item_id; ?>]" value="1" <?php echo checked( !empty( $item->ismegamenu ), 1, false ); ?> />
	                </label>
	            </p>
	            -->
	            <div class="sf-menu-options">
		            <h4>Custom Menu Options</h4>
		            
		            <?php if ($depth == 0) { ?>
		            
		            <p class="field-custom description description-wide">
		                <label for="edit-menu-is-naturalwidth-<?php echo $item_id; ?>"><?php _e( 'Natural Width Mega Menu', 'swift-framework-admin' ); ?><input type="checkbox" id="edit-menu-is-naturalwidth-<?php echo $item_id; ?>" class="edit-menu-item-custom" id="menu-is-naturalwidth[<?php echo $item_id; ?>]" name="menu-is-naturalwidth[<?php echo $item_id; ?>]" value="1" <?php echo checked( !empty( $item->isnaturalwidth ), 1, false ); ?> />
		                </label>
		            </p>
		            <p class="field-custom description description-wide">
		                <label for="edit-menu-is-altstyle-<?php echo $item_id; ?>"><?php _e( 'Alternative Style Mega Menu', 'swift-framework-admin' ); ?><input type="checkbox" id="edit-menu-is-altstyle-<?php echo $item_id; ?>" class="edit-menu-item-custom" id="menu-is-altstyle[<?php echo $item_id; ?>]" name="menu-is-altstyle[<?php echo $item_id; ?>]" value="1" <?php echo checked( !empty( $item->altstyle ), 1, false ); ?> />
		                </label>
		            </p>
		            <p class="field-custom description description-wide">
		                <label for="edit-menu-hideheadings-<?php echo $item_id; ?>"><?php _e( 'Hide Mega Menu Headings', 'swift-framework-admin' ); ?><input type="checkbox" id="edit-menu-hideheadings-<?php echo $item_id; ?>" class="edit-menu-item-custom" id="menu-hideheadings[<?php echo $item_id; ?>]" name="menu-hideheadings[<?php echo $item_id; ?>]" value="1" <?php echo checked( !empty( $item->hideheadings ), 1, false ); ?> />
		                </label>
		            </p>
		            
		            <h4>Custom Menu Options</h4>
    
                    <p class="field-custom description description-wide">
                        <label
                            for="edit-menu-loggedinvis-<?php echo $item_id; ?>"><?php _e( 'Visible only when logged in', 'swift-framework-admin' ); ?>
                            <input type="checkbox" id="edit-menu-loggedinvis-<?php echo $item_id; ?>"
                                   class="edit-menu-item-custom" id="menu-loggedinvis[<?php echo $item_id; ?>]"
                                   name="menu-loggedinvis[<?php echo $item_id; ?>]"
                                   value="1" <?php echo checked( ! empty( $item->loggedinvis ), 1, false ); ?> />
                        </label>
                    </p>
    
                    <p class="field-custom description description-wide">
                        <label
                            for="edit-menu-loggedoutvis-<?php echo $item_id; ?>"><?php _e( 'Visible only when logged out', 'swift-framework-admin' ); ?>
                            <input type="checkbox" id="edit-menu-loggedoutvis-<?php echo $item_id; ?>"
                                   class="edit-menu-item-custom" id="menu-loggedoutvis[<?php echo $item_id; ?>]"
                                   name="menu-loggedoutvis[<?php echo $item_id; ?>]"
                                   value="1" <?php echo checked( ! empty( $item->loggedoutvis ), 1, false ); ?> />
                        </label>
                    </p>
    
                    <?php if ( $depth == 0 ) { ?>
    
                        <p class="field-custom description description-wide">
                            <label
                                for="edit-menu-menuitembtn-<?php echo $item_id; ?>"><?php _e( 'Button Style Menu Item', 'swift-framework-admin' ); ?>
                                <input type="checkbox" id="edit-menu-menuitembtn-<?php echo $item_id; ?>"
                                       class="edit-menu-item-custom" id="menu-menuitembtn[<?php echo $item_id; ?>]"
                                       name="menu-menuitembtn[<?php echo $item_id; ?>]"
                                       value="1" <?php echo checked( ! empty( $item->menuitembtn ), 1, false ); ?> />
                            </label>
                        </p>
    
                    <?php } ?>
		            
		            <?php } ?>
		            
		            <p class="field-custom description description-wide">
		                 <label for="edit-menu-item-icon-<?php echo $item_id; ?>"><?php _e( 'Menu Icon (Gizmo / Font Awesome)', 'swift-framework-admin' ); ?><input type="text" id="edit-menu-item-icon-<?php echo $item_id; ?>" class="widefat edit-menu-item-custom" name="menu-item-icon[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menuicon ); ?>" />
		                 </label>
		             </p>
		             
		             <?php if ($depth == 1) { ?>
		             
		             <p class="field-custom description description-wide">
		                 <label for="edit-menu-megatitle-<?php echo $item_id; ?>"><?php _e( 'Mega Menu No Link Title', 'swift-framework-admin' ); ?><input type="checkbox" id="edit-menu-megatitle-<?php echo $item_id; ?>" class="edit-menu-item-custom" id="menu-megatitle[<?php echo $item_id; ?>]" name="menu-megatitle[<?php echo $item_id; ?>]" value="1" <?php echo checked( !empty( $item->megatitle ), 1, false ); ?> />
		                 </label>
		             </p>
		             
		             <p class="field-custom description description-wide">
		                  <label for="edit-menu-item-htmlcontent-<?php echo $item_id; ?>"><?php _e( 'Custom HTML Column (within Mega Menu)', 'swift-framework-admin' ); ?><textarea id="edit-menu-item-htmlcontent-<?php echo $item_id; ?>" name="menu-item-htmlcontent[<?php echo $item_id; ?>]" cols="30" rows="4"><?php echo esc_attr( $item->htmlcontent ); ?></textarea>
		                  </label>
		              </p>
		              <p class="field-custom description description-wide">
		                  <label for="edit-menu-nocolumnspacing-<?php echo $item_id; ?>"><?php _e( 'No Menu Column Spacing (for custom html column)', 'swift-framework-admin' ); ?><input type="checkbox" id="edit-menu-nocolumnspacing-<?php echo $item_id; ?>" class="edit-menu-item-custom" id="menu-nocolumnspacing[<?php echo $item_id; ?>]" name="menu-nocolumnspacing[<?php echo $item_id; ?>]" value="1" <?php echo checked( !empty( $item->nocolumnspacing ), 1, false ); ?> />
		                  </label>
		              </p>
		              <p class="field-custom description description-wide">
		                   <label for="edit-menu-item-icon-<?php echo $item_id; ?>"><?php _e( 'Custom HTML Column Width (optional)', 'swift-framework-admin' ); ?><input type="text" id="edit-menu-item-width-<?php echo $item_id; ?>" class="widefat edit-menu-item-custom" name="menu-item-width[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menuwidth ); ?>" />
		                   </label>
		                   <p><?php _e('Optionally set a width here for the menu column, ideal if you want to make it wider. Numeric value (no px).', 'swift-framework-admin'); ?></p>
		               </p>
		              
		              <?php } ?>
	            </div>
	            
	            <?php
	            /* New fields insertion ends here */
	            ?>
	            <div class="menu-item-actions description-wide submitbox">
	                <?php if( 'custom' != $item->type && $original_title !== false ) : ?>
	                    <p class="link-to-original">
	                        <?php printf( __('Original: %s', 'swift-framework-admin'), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
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
	                ); ?>"><?php _e('Remove', 'swift-framework-admin'); ?></a> <span class="meta-sep"> | </span> <a class="item-cancel submitcancel" id="cancel-<?php echo $item_id; ?>" href="<?php echo esc_url( add_query_arg( array('edit-menu-item' => $item_id, 'cancel' => time()), remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) ) ) );
	                    ?>#menu-item-settings-<?php echo $item_id; ?>"><?php _e('Cancel', 'swift-framework-admin'); ?></a>
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
} ?>
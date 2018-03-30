<?php

// Adds additional language fields in the menu creator
add_filter('wp_edit_nav_menu_walker', 'bfi_wp_edit_nav_menu_walker', 10, 2);
function bfi_wp_edit_nav_menu_walker($className, $menu_id) {
    return 'BFI_Walker_Nav_Menu_Edit';
}

// from wp-admin/includes/nav-menu.php
class BFI_Walker_Nav_Menu_Edit extends Walker_Nav_Menu  {
    /**
     * @see Walker_Nav_Menu::start_lvl()
     * @since 3.0.0
     *
     * @param string $output Passed by reference.
     */
    function start_lvl( &$output, $depth = 0, $args = array() ) {}

    /**
     * @see Walker_Nav_Menu::end_lvl()
     * @since 3.0.0
     *
     * @param string $output Passed by reference.
     */
    function end_lvl( &$output, $depth = 0, $args = array() ) {}

    /**
     * @see Walker::start_el()
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item Menu item data object.
     * @param int $depth Depth of menu item. Used for padding.
     * @param object $args
     */
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
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
            $title = sprintf( __( '%s (Invalid)', BFI_I18NDOMAIN ), $item->title );
        } elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
            $classes[] = 'pending';
            /* translators: %s: title of menu item in draft status */
            $title = sprintf( __('%s (Pending)', BFI_I18NDOMAIN ), $item->title );
        }

	$title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;

	$submenu_text = '';
	if ( 0 == $depth )
		$submenu_text = 'style="display: none;"';
        
        
        
        
        /* PROCESS (IF MULTILANG IS ENABLED):
         * LANG TERMS: <title>|||<lang2>|||<title2>|||<lang3>|||<title3>...
         * ON LOAD: 
         * 1. split terms from the title input
         * 2. distribute to proper inputs
         * ON SUBMIT:
         * 1. combine terms from all the title inputs
         * IF MULTILANG IS DISABLED, LOOK FOR DELIMITERS THEN REMOVE THEM
         * IF MULTILANG IS JUST ENABLED, CREATE DELIMITERS AND DEFAULT VALUES
         */ 
         // check if multilang is enabled
         
        $languages = bfi_get_option(BFI_SHORTNAME."_multilanguages");
        $langEnabled = false;
        $descs = array();
        $titles = array();
        $langs = array();
        $delim = '|||';
        $defaultTitle = $item->title;
        if ($languages != "") {
            $languages = unserialize($languages);
            $languageNames = bfi_list_languages();
            $existingTitles = array();
            if (stripos($item->title, $delim) !== false) {
                $existingTitles = explode($delim, $item->title);
                $defaultTitle = array_shift($existingTitles);
            }
            if (count($languages)) {
                foreach ($languages as $language => $locale) {
                    $languageName = $languageNames[$language];
                    $descs[$language] = __( 'Navigation Label', BFI_I18NDOMAIN ) . ' ' . $languageName . ' ('.$language.')';
                    $titles[$language] = $defaultTitle;
                }
                $langEnabled = true;
            }
            for ($i = 0; $i < count($existingTitles); $i+=2) {
                if (array_key_exists($existingTitles[$i], $descs)) {
                    $titles[$existingTitles[$i]] = $existingTitles[$i+1];
                }
            }
        }
        // if no multilang, check if there is a delimiter preset (means we had a multilang before)
        if (!$langEnabled && stripos($item->title, $delim) !== false) {
            $item->title = explode($delim, $item->title);
            $item->title = $item->title[0];
        }
        

        ?>
        <li id="menu-item-<?php echo $item_id; ?>" class="<?php echo implode(' ', $classes ); ?>">
            <dl class="menu-item-bar">
                <dt class="menu-item-handle">
                    <span class="item-title"><span class="menu-item-title"><?php echo esc_html( $defaultTitle ); ?></span> <span class="is-submenu" <?php echo $submenu_text; ?>><?php _e( 'sub item', BFI_I18NDOMAIN ); ?></span></span>
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
                        <a class="item-edit" id="edit-<?php echo $item_id; ?>" title="<?php esc_attr_e('Edit Menu Item', BFI_I18NDOMAIN); ?>" href="<?php
                            echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
                        ?>"><?php _e( 'Edit Menu Item', BFI_I18NDOMAIN ); ?></a>
                    </span>
                </dt>
            </dl>

            <div class="menu-item-settings" id="menu-item-settings-<?php echo $item_id; ?>">
                <?php if( 'custom' == $item->type ) : ?>
                    <p class="field-url description description-wide">
                        <label for="edit-menu-item-url-<?php echo $item_id; ?>">
                            <?php _e( 'URL', BFI_I18NDOMAIN ); ?><br />
                            <input type="text" id="edit-menu-item-url-<?php echo $item_id; ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
                        </label>
                    </p>
                <?php endif; ?>
                <?php
                // OVERRIDE THE TITLE HERE
                ?>
                <p class="description description-thin">
                    <label for="edit-menu-item-title-<?php echo $item_id; ?>">
                        <?php _e( 'Navigation Label', BFI_I18NDOMAIN ); ?><br />
                        <input type="text" id="edit-menu-item-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $defaultTitle ); ?>" />
                    </label>
                </p>
                <p class="description description-thin">
                    <label for="edit-menu-item-attr-title-<?php echo $item_id; ?>">
                        <?php _e( 'Title Attribute', BFI_I18NDOMAIN ); ?><br />
                        <input type="text" id="edit-menu-item-attr-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
                    </label>
                </p>
                <?php
                // create the other language titles
                foreach ($titles as $language => $title) {
                    ?>
                    <p class="description description-wide">
                        <label for="edit-menu-item-title-<?php echo $item_id; ?>-<?php echo $language ?>">
                            <?php echo $descs[$language] ?><br />
                            <input type="text" id="edit-menu-item-title-<?php echo $item_id; ?>-<?php echo $language ?>" class="widefat edit-menu-item-title" name="" value="<?php echo esc_attr( $title ); ?>" />
                        </label>
                    </p>
                    <?php
                }
                if (count($titles)) {
                    ?>
                    <script>
                        jQuery('#update-nav-menu').submit(function(){
                            val = jQuery("#edit-menu-item-title-<?php echo $item_id; ?>").val();
                            jQuery("#edit-menu-item-title-<?php echo $item_id; ?>").val(val
                            <?php
                            foreach ($titles as $language => $title) {
                                echo "+ '|||$language|||' + jQuery('#edit-menu-item-title-{$item_id}-{$language}').val()";
                            }
                            ?>
                            );
                        });
                    </script>
                    <?php 
                } 
                ?>
                <p class="field-link-target description">
                    <label for="edit-menu-item-target-<?php echo $item_id; ?>">
			<input type="checkbox" id="edit-menu-item-target-<?php echo $item_id; ?>" value="_blank" name="menu-item-target[<?php echo $item_id; ?>]"<?php checked( $item->target, '_blank' ); ?> />
			<?php _e( 'Open link in a new window/tab',  BFI_I18NDOMAIN ); ?>
                    </label>
                </p>
                <p class="field-css-classes description description-thin">
                    <label for="edit-menu-item-classes-<?php echo $item_id; ?>">
                        <?php _e( 'CSS Classes (optional)', BFI_I18NDOMAIN ); ?><br />
                        <input type="text" id="edit-menu-item-classes-<?php echo $item_id; ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo $item_id; ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
                    </label>
                </p>
                <p class="field-xfn description description-thin">
                    <label for="edit-menu-item-xfn-<?php echo $item_id; ?>">
                        <?php _e( 'Link Relationship (XFN)', BFI_I18NDOMAIN ); ?><br />
                        <input type="text" id="edit-menu-item-xfn-<?php echo $item_id; ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
                    </label>
                </p>
                <p class="field-description description description-wide">
                    <label for="edit-menu-item-description-<?php echo $item_id; ?>">
                        <?php _e( 'Description', BFI_I18NDOMAIN ); ?><br />
                        <textarea id="edit-menu-item-description-<?php echo $item_id; ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo $item_id; ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
                        <span class="description"><?php _e('The description will be displayed in the menu if the current theme supports it.', BFI_I18NDOMAIN); ?></span>
                    </label>
                </p>

		<p class="field-move hide-if-no-js description description-wide">
			<label>
				<span><?php _e( 'Move', 'default' ); ?></span>
				<a href="#" class="menus-move-up"><?php _e( 'Up one', 'default' ); ?></a>
				<a href="#" class="menus-move-down"><?php _e( 'Down one', 'default' ); ?></a>
				<a href="#" class="menus-move-left"></a>
				<a href="#" class="menus-move-right"></a>
				<a href="#" class="menus-move-top"><?php _e( 'To the top', 'default' ); ?></a>
			</label>
		</p>

                <div class="menu-item-actions description-wide submitbox">
                    <?php if( 'custom' != $item->type && $original_title !== false ) : ?>
                        <p class="link-to-original">
                            <?php printf( __('Original: %s', BFI_I18NDOMAIN), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
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
                    ); ?>"><?php _e('Remove', BFI_I18NDOMAIN); ?></a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo $item_id; ?>" href="<?php echo esc_url( add_query_arg( array('edit-menu-item' => $item_id, 'cancel' => time() ), admin_url( 'nav-menus.php' ) ) );
                        ?>#menu-item-settings-<?php echo $item_id; ?>"><?php _e('Cancel', BFI_I18NDOMAIN); ?></a>
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
 * Replaces the correct translation on menus
 */
add_filter('wp_nav_menu_items', 'bfi_wp_nav_menu_items', 10, 2);
function bfi_wp_nav_menu_items($items, $args) {
    $arr = explode('</a>', $items);
    // put back </a>
    foreach ($arr as $i => $item) {
        if ($i+1 == count($arr)) continue;
        $arr[$i] .= '</a>';
    }
    
    $delim = '|||';
    foreach ($arr as $i => $item) {
        if (!preg_match('/\|\|\|/', $item)) continue;
        preg_match_all('/<a\s[^\>]+>([^<]+)/i', $item, $matches);
        if (count($matches) <= 1 && !count($matches[1])) continue;
        
        $text = $matches[1][0];
        $defaultText = $text;
        if (stripos($text, $delim) !== false) {
            $temp = explode($delim, $text);
            $defaultText = array_shift($temp);
            
            if (array_key_exists('l', $_SESSION)) {
                $lang = $_SESSION['l'];
                for ($k = 0; $k < count($temp); $k+=2) {
                    if ($lang == $temp[$k]) {
                        $defaultText = $temp[$k+1];
                        break;
                    }
                }
            }
        }

        $arr[$i] = preg_replace('/<a(.+?)>.+?<\/a>/i',"<a\$1>$defaultText</a>",$item);
    }
    
    $tempItems = '';
    foreach ($arr as $item) {
        $tempItems .= $item;
    }
    return $tempItems;
}

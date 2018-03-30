<?php
/**
 * Copied from Walker_Nav_Menu_Edit class in core
 * 
 * Create HTML list of nav menu input items.
 *
 * @package WordPress
 * @since 3.0.0
 * @uses Walker_Nav_Menu
 */
class Walker_Nav_Menu_Edit_Custom extends Walker_Nav_Menu  {

	public $menu_config;
	
	function __construct() {
		//parent dunt have contruct method
		//parent::__construct();
		$wd_mega_menu_config = get_option(THEME_SLUG.'wd_mega_menu_config','');
		$wd_mega_menu_config_arr = unserialize($wd_mega_menu_config);

		if( is_array($wd_mega_menu_config_arr) && count($wd_mega_menu_config_arr) > 0 ){
			if ( !array_key_exists('area_number', $wd_mega_menu_config_arr) ) {
				$wd_mega_menu_config_arr['area_number'] = 1;
			}
			if ( !array_key_exists('thumbnail_width', $wd_mega_menu_config_arr) ) {
				$wd_mega_menu_config_arr['thumbnail_width'] = 16;
			}
			if ( !array_key_exists('thumbnail_height', $wd_mega_menu_config_arr) ) {
				$wd_mega_menu_config_arr['thumbnail_height'] = 16;
			}		
		}else{
			$wd_mega_menu_config_arr = array(
				'area_number' => 1
				,'thumbnail_width' => 16
				,'thumbnail_height' => 16
			);
		}
		
		$this->menu_config = $wd_mega_menu_config_arr;
    }	


/**
 * @see Walker_Nav_Menu::start_lvl()
 * @since 3.0.0
 *
 * @param string $output Passed by reference.
 */
function start_lvl(&$output, $depth = 0, $args = array()) {}

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
        $title = sprintf( __( '%s (Invalid)','wpdance' ), $item->title );
    } elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
        $classes[] = 'pending';
        /* translators: %s: title of menu item in draft status */
        $title = sprintf( __('%s (Pending)','wpdance'), $item->title );
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
                                esc_url( add_query_arg(
                                    array(
                                        'action' => 'move-up-menu-item',
                                        'menu-item' => $item_id,
                                    ),
                                    remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                                ) ),
                                'move-menu_item'
                            );
                        ?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up','wpdance'); ?>">&#8593;</abbr></a>
                        |
                        <a href="<?php
                            echo wp_nonce_url(
                                esc_url( add_query_arg(
                                    array(
                                        'action' => 'move-down-menu-item',
                                        'menu-item' => $item_id,
                                    ),
                                    remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                                ) ),
                                'move-menu_item'
                            );
                        ?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down','wpdance'); ?>">&#8595;</abbr></a>
                    </span>
                    <a class="item-edit" id="edit-<?php echo $item_id; ?>" title="<?php esc_attr_e('Edit Menu Item','wpdance'); ?>" href="<?php
                        echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : esc_url( add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) ) );
                    ?>"><?php _e( 'Edit Menu Item','wpdance' ); ?></a>
                </span>
            </dt>
        </dl>

        <div class="menu-item-settings" id="menu-item-settings-<?php echo $item_id; ?>">
            <?php if( 'custom' == $item->type ) : ?>
                <p class="field-url description description-wide">
                    <label for="edit-menu-item-url-<?php echo $item_id; ?>">
                        <?php _e( 'URL','wpdance' ); ?><br />
                        <input type="text" id="edit-menu-item-url-<?php echo $item_id; ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
                    </label>
                </p>
            <?php endif; ?>
            <p class="description description-thin">
                <label for="edit-menu-item-title-<?php echo $item_id; ?>">
                    <?php _e( 'Navigation Label','wpdance' ); ?><br />
                    <input type="text" id="edit-menu-item-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
                </label>
            </p>
            <p class="description description-thin">
                <label for="edit-menu-item-attr-title-<?php echo $item_id; ?>">
                    <?php _e( 'Title Attribute','wpdance' ); ?><br />
                    <input type="text" id="edit-menu-item-attr-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
                </label>
            </p>
            <p class="field-link-target description">
                <label for="edit-menu-item-target-<?php echo $item_id; ?>">
                    <input type="checkbox" id="edit-menu-item-target-<?php echo $item_id; ?>" value="_blank" name="menu-item-target[<?php echo $item_id; ?>]"<?php checked( $item->target, '_blank' ); ?> />
                    <?php _e( 'Open link in a new window/tab','wpdance' ); ?>
                </label>
            </p>
            <p class="field-css-classes description description-thin">
                <label for="edit-menu-item-classes-<?php echo $item_id; ?>">
                    <?php _e( 'CSS Classes (optional)','wpdance' ); ?><br />
                    <input type="text" id="edit-menu-item-classes-<?php echo $item_id; ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo $item_id; ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
                </label>
            </p>
            <p class="field-xfn description description-thin">
                <label for="edit-menu-item-xfn-<?php echo $item_id; ?>">
                    <?php _e( 'Link Relationship (XFN)','wpdance' ); ?><br />
                    <input type="text" id="edit-menu-item-xfn-<?php echo $item_id; ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
                </label>
            </p>
            <p class="field-description description description-wide">
                <label for="edit-menu-item-description-<?php echo $item_id; ?>">
                    <?php _e( 'Description','wpdance' ); ?><br />
                    <textarea id="edit-menu-item-description-<?php echo $item_id; ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo $item_id; ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
                    <span class="description"><?php _e('The description will be displayed in the menu if the current theme supports it.','wpdance'); ?></span>
                </label>
            </p>        
            <?php
            /*
             * This is the added field
             */
            ?>      
            <p class="field-wide-style description description-thin wd-custom-menu wd-add-on-lv0">
                <label for="edit-menu-item-wide-style-<?php echo $item_id; ?>">
					<?php $wide_style = esc_attr( $item->wide_style );?>
                    <?php _e( 'Mega Menu','wpdance' ); ?><br />
                    <!--<input type="text" id="edit-menu-item-wide-style-<?php echo $item_id; ?>" class="widefat code edit-menu-item-wide-style" name="menu-item-wide-style[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->wide_style ); ?>" />-->
					<select id="edit-menu-item-wide-style-<?php echo $item_id; ?>" class="widefat code edit-menu-item-wide-style" name="menu-item-wide-style[<?php echo $item_id; ?>]">
					  <option value="0" <?php if($wide_style == 0) echo "selected";?> >No</option>
					  <option value="1" <?php if($wide_style == 1) echo "selected";?> >Yes</option>
					</select> 					
                </label>
            </p>
			
			<p class="field-wide-column description description-thin wd-custom-menu wd-add-on-lv0 mega-active ">
                <label for="edit-menu-item-wide-column-<?php echo $item_id; ?>">
					<?php $wide_column = esc_attr( $item->wide_column );?>
                    <?php _e( 'Columns','wpdance' ); ?><br />
					<select id="edit-menu-item-wide-column-<?php echo $item_id; ?>" class="widefat code edit-menu-item-wide-column" name="menu-item-wide-column[<?php echo $item_id; ?>]">
					   <option value="0" <?php if($wide_column == 0) echo "selected";?> >Fullwidth</option>
					   <option value="1" <?php if($wide_column == 1) echo "selected";?> >1 column</option>
					   <option value="2" <?php if($wide_column == 2) echo "selected";?> >2 columns</option>
					   <option value="3" <?php if($wide_column == 3) echo "selected";?> >3 columns</option>
					   <option value="4" <?php if($wide_column == 4) echo "selected";?> >4 columns</option>
					   <option value="5" <?php if($wide_column == 5) echo "selected";?> >5 columns</option>
					   <!--<option value="6" <?php if($wide_column == 6) echo "selected";?> >6 columns</option>-->
					   <!--<option value="7" <?php if($wide_column == 7) echo "selected";?> >7 columns</option>
					   <option value="8" <?php if($wide_column == 8) echo "selected";?> >8 columns</option>
					   <option value="9" <?php if($wide_column == 9) echo "selected";?> >9 columns</option>
					   <option value="10" <?php if($wide_column == 10) echo "selected";?> >10 columns</option>
					   <option value="11" <?php if($wide_column == 11) echo "selected";?> >11 columns</option>
					   <option value="12" <?php if($wide_column == 12) echo "selected";?> >12 columns</option>-->
					</select> 
                </label>
            </p>
		
			<p class="field-sub-column description description-thin wd-custom-menu wd-add-on-lv1 parrent-active depend-field-wide-column">
                <label for="edit-menu-item-sub-column-<?php echo $item_id; ?>">
					<?php $sub_column = esc_attr( $item->sub_column );?>
                    <?php _e( 'Sub Columns','wpdance' ); ?><br />
					<select id="edit-menu-item-sub-column-<?php echo $item_id; ?>" class="widefat code edit-menu-item-sub-column" name="menu-item-sub-column[<?php echo $item_id; ?>]">
					   <option value="1" <?php if($sub_column == 1) echo "selected";?> >1 column</option>
					   <option value="2" <?php if($sub_column == 2) echo "selected";?> >2 columns</option>
					   <option value="3" <?php if($sub_column == 3) echo "selected";?> >3 columns</option>
					   <option value="4" <?php if($sub_column == 4) echo "selected";?> >4 columns</option>
					   <option value="5" <?php if($sub_column == 5) echo "selected";?> >5 columns</option>
					   <option value="6" <?php if($sub_column == 6) echo "selected";?> >6 columns</option>
					   <option value="7" <?php if($sub_column == 7) echo "selected";?> >7 columns</option>
					   <option value="8" <?php if($sub_column == 8) echo "selected";?> >8 columns</option>
					   <option value="9" <?php if($sub_column == 9) echo "selected";?> >9 columns</option>
					   <option value="10" <?php if($sub_column == 10) echo "selected";?> >10 columns</option>
					   <option value="11" <?php if($sub_column == 11) echo "selected";?> >11 columns</option>
					   <option value="12" <?php if($sub_column == 12) echo "selected";?> >12 columns</option>
					</select> 
                </label>
            </p>		
		
			
            <p class="field-wide-custom-color description description-thin wd-custom-menu wd-custom-color-menu wd-add-on-lv1 wd-add-on-lv2 parrent-active" >
                <label for="edit-menu-item-wide-custom-color-<?php echo $item_id; ?>">
                    <?php _e( 'Text Color','wpdance' ); ?><br />
					<p class="input-append color colorpicker-menu" data-color="<?php echo esc_attr( $item->wide_custom_color ); ?>" data-color-format="hex">
						<input id="edit-menu-item-wide-custom-color-<?php echo $item_id; ?>" name="menu-item-wide-custom-color[<?php echo $item_id; ?>]" id="theme-color" type="text" class="span2 widefat code edit-menu-item-wide-custom-color" value="<?php echo esc_attr( $item->wide_custom_color ); ?>" >
						<span class="add-on"><i style="color: <?php echo esc_attr( $item->wide_custom_color ); ?>"></i></span>
					</p>					
                </label>
            </p>

			<?php $numSideBar =  $this->menu_config['area_number'];?>
			<?php if( $numSideBar > 0):?>
					<p class="field-wide-widget description description-thin wd-custom-menu wd-add-on-lv0 wd-add-on-lv1 mega-active parrent-active ">
						<label for="edit-menu-item-sidebars-<?php echo $item_id; ?>">
							<span class="description"><?php _e('Display a Widget Area','wpdance'); ?></span>
							<?php echo wd_mega_select_sidebar($item_id,$numSideBar); ?>
						</label>
					</p>
			<?php endif ?>	

            <p class="field-thumbnail description description-thin wd-custom-menu wd-add-on-lv1 wd-add-on-lv2 wd-add-on-lv0 parrent-active ">
                <label>
					<?php 
						$menu_thumbnail = esc_attr( $item->thumbnail );
						$have_thumb = ( strlen($menu_thumbnail) > 0 ? true : false );
					?>
                    <?php _e( 'Set Image','wpdance' ); ?><br />
				
					<a id="<?php echo $item_id; ?>" class="custom_upload_image_button_mega" href="javascript:void(0)" style="display:<?php echo $style = ($have_thumb ? 'none' : 'inline'); ?>;">Select Image</a>
           			<span class="edit-menu-item-thumbnail-wrapper">
						<?php if($have_thumb):?>
							<img src="<?php echo $menu_thumbnail;?>" width="32" height="32" id="thumbnail-menu-item-<?php echo $item_id; ?>" title="menu-item-<?php echo $item_id; ?>-thumbnail" alt="menu-item-<?php echo $item_id; ?>-thumbnail">
						<?php endif?>
					</span>
					<a id="<?php echo $item_id; ?>" class="custom_clear_image_button_mega" href="javascript:void(0)" style="display:<?php echo $style = ($have_thumb ? 'inline' : 'none'); ?>;">Remove Image</a>
					<input type="hidden" id="edit-menu-item-thumbnail-<?php echo $item_id; ?>" class="widefat edit-menu-item-thumbnail" name="menu-item-thumbnail[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->thumbnail ); ?>" />
					<input type="hidden" id="edit-menu-item-thumbnail-id-<?php echo $item_id; ?>" class="widefat edit-menu-item-thumbnail-id" name="menu-item-thumbnail-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->thumbnail_id ); ?>" />
				 </label>	
               
            </p>	

            <p class="field-wide-column description description-thin wd-custom-menu wd-add-on-lv0 mega-active" >
                <label for="edit-menu-item-wide-align-right-<?php echo $item_id; ?>">
					<?php 
						$aligh_right = (int) $item->aligh_right;
					?>
                    <?php _e( 'Align Right','wpdance' ); ?><br />
					<select id="edit-menu-item-align-right-<?php echo $item_id; ?>" class="widefat code edit-menu-item-align-right" name="menu-item-align-right[<?php echo $item_id; ?>]">
					   <option value="0" <?php if($aligh_right == 0) echo "selected";?> >No</option>
					   <option value="1" <?php if($aligh_right == 1) echo "selected";?> >Yes</option>
					</select> 
					
                </label>
            </p>
			
            <?php
            /*
             * end added field
             */
            ?>
            <div class="menu-item-actions description-wide submitbox">
                <?php if( 'custom' != $item->type && $original_title !== false ) : ?>
                    <p class="link-to-original">
                        <?php printf( __('Original: %s','wpdance'), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
                    </p>
                <?php endif; ?>
                <a class="item-delete submitdelete deletion" id="delete-<?php echo $item_id; ?>" href="<?php
                echo wp_nonce_url(
                    esc_url( add_query_arg(
                        array(
                            'action' => 'delete-menu-item',
                            'menu-item' => $item_id,
                        ),
                        remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                    ) ),
                    'delete-menu_item_' . $item_id
                ); ?>"><?php _e('Remove','wpdance'); ?></a> <span class="meta-sep"> | </span> <a class="item-cancel submitcancel" id="cancel-<?php echo $item_id; ?>" href="<?php echo esc_url( add_query_arg( array('edit-menu-item' => $item_id, 'cancel' => time()), remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) ) ) );
                    ?>#menu-item-settings-<?php echo $item_id; ?>"><?php _e('Cancel','wpdance'); ?></a>
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
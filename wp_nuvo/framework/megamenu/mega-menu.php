<?php
/*
 * Saves new field to postmeta for navigation
 */
add_filter( 'wp_nav_menu_args', 'modify_arguments', 100 );
function modify_arguments( $arguments ) {
    $arguments['walker']          = new HeroMenuWalker();
    return $arguments;
}
add_action('wp_update_nav_menu_item', 'custom_nav_update',10, 3);
function custom_nav_update($menu_id, $menu_item_db_id, $args ) {
    $fields = array('submenu_type','dropdown','widget_area','column_width','group','hide_link','bg_image','bg_image_attachment','bg_image_size','bg_image_position','bg_image_repeat','bg_color','menu_icon');
    foreach($fields as $i=>$field){
        if (isset($_REQUEST['menu-item-'.$field][$menu_item_db_id])) {
            $mega_value = $_REQUEST['menu-item-'.$field][$menu_item_db_id];
            update_post_meta( $menu_item_db_id, '_menu_item_'.$field, $mega_value );
        }else{
			update_post_meta( $menu_item_db_id, '_menu_item_'.$field, '');
		}
    }
}

/*
 * Adds value of new field to $item object that will be passed to     Walker_Nav_Menu_Edit_Custom
 */
add_filter( 'wp_setup_nav_menu_item','custom_nav_item' );
function custom_nav_item($menu_item) {
    $fields = array('submenu_type','dropdown','widget_area','column_width','group','hide_link','bg_image','bg_image_attachment','bg_image_size','bg_image_position','bg_image_repeat','bg_color','menu_icon');
    foreach($fields as $i=>$field){
        $menu_item->$field = get_post_meta( $menu_item->ID, '_menu_item_'.$field, true );
    }
    return $menu_item;
}
add_action( 'admin_enqueue_scripts','add_js_mega_menu');
function add_js_mega_menu(){
    wp_enqueue_script( 'set_background', trailingslashit( get_template_directory_uri() ) . '/framework/megamenu/js/set_background.js', array( 'jquery', 'jquery-ui-sortable' ), false, true );
    wp_enqueue_style( 'css_backend_megamenu', trailingslashit( get_template_directory_uri() ) . '/framework/megamenu/css/backend.css' );
    wp_enqueue_style( 'font-awesome');
    wp_enqueue_media();
    add_thickbox();
}

add_filter( 'wp_edit_nav_menu_walker', 'custom_nav_edit_walker',10,2 );
function custom_nav_edit_walker($walker,$menu_id) {
    return 'Walker_Nav_Menu_Edit_Custom';
}

/**
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
function start_el( &$output, $item, $depth = 0, $args = array(), $current_object_id = 0 ) {
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
        $title = sprintf( esc_html__( '%s (Invalid)', 'wp_nuvo'), $item->title );
    } elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
        $classes[] = 'pending';
        /* translators: %s: title of menu item in draft status */
        $title = sprintf( esc_html__('%s (Pending)', 'wp_nuvo'), $item->title );
    }

    $title = empty( $item->label ) ? $title : $item->label;

    ?>
    <li data-menuanchor="" id="menu-item-<?php echo $item_id; ?>" class="<?php echo implode(' ', $classes ); ?>">
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
                        ?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up','wp_nuvo'); ?>">&#8593;</abbr></a>
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
                        ?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down','wp_nuvo'); ?>">&#8595;</abbr></a>
                    </span>
                    <a class="item-edit" id="edit-<?php echo $item_id; ?>" title="<?php esc_attr_e('Edit Menu Item','wp_nuvo'); ?>" href="<?php
                        echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
                    ?>"><?php esc_html_e( 'Edit Menu Item' ,'wp_nuvo'); ?></a>
                </span>
            </dt>
        </dl>

        <div class="menu-item-settings" id="menu-item-settings-<?php echo $item_id; ?>">
            <?php if( 'custom' == $item->type ) : ?>
                <p class="field-url description description-wide">
                    <label for="edit-menu-item-url-<?php echo $item_id; ?>">
                        <?php esc_html_e( 'URL' ,'wp_nuvo'); ?><br />
                        <input type="text" id="edit-menu-item-url-<?php echo $item_id; ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
                    </label>
                </p>
            <?php endif; ?>
            <p class="description description-thin">
                <label for="edit-menu-item-title-<?php echo $item_id; ?>">
                    <?php esc_html_e( 'Navigation Label' ,'wp_nuvo'); ?><br />
                    <input type="text" id="edit-menu-item-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
                </label>
            </p>
            <p class="description description-thin">
                <label for="edit-menu-item-attr-title-<?php echo $item_id; ?>">
                    <?php esc_html_e( 'Title Attribute','wp_nuvo' ); ?><br />
                    <input type="text" id="edit-menu-item-attr-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
                </label>
            </p>
            <p class="field-link-target description">
                <label for="edit-menu-item-target-<?php echo $item_id; ?>">
                    <input type="checkbox" id="edit-menu-item-target-<?php echo $item_id; ?>" value="_blank" name="menu-item-target[<?php echo $item_id; ?>]"<?php checked( $item->target, '_blank' ); ?> />
                    <?php esc_html_e( 'Open link in a new window/tab' ,'wp_nuvo'); ?>
                </label>
            </p>
            <p class="field-css-classes description description-thin">
                <label for="edit-menu-item-classes-<?php echo $item_id; ?>">
                    <?php esc_html_e( 'CSS Classes (optional)' ,'wp_nuvo'); ?><br />
                    <input type="text" id="edit-menu-item-classes-<?php echo $item_id; ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo $item_id; ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
                </label>
            </p>
            <p class="field-xfn description description-thin">
                <label for="edit-menu-item-xfn-<?php echo $item_id; ?>">
                    <?php esc_html_e( 'Link Relationship (XFN)' ,'wp_nuvo'); ?><br />
                    <input type="text" id="edit-menu-item-xfn-<?php echo $item_id; ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
                </label>
            </p>
            <p class="field-description description description-wide">
                <label for="edit-menu-item-description-<?php echo $item_id; ?>">
                    <?php esc_html_e( 'Description' ,'wp_nuvo'); ?><br />
                    <textarea id="edit-menu-item-description-<?php echo $item_id; ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo $item_id; ?>]"><?php echo esc_html( $item->description ); ?></textarea>
                    <span class="description"><?php esc_html_e('The description will be displayed in the menu if the current theme supports it.','wp_nuvo'); ?></span>
                </label>
            </p>
            <?php
            /*
             * This is the added field
             */
			if ( ! $depth ) {
			$title              = 'Submenu Type';
			$key = "menu-item-submenu_type";
			$value = $item->submenu_type;
			?>
			<p class="description description-wide description_width_100">
				<?php echo esc_html($title); ?><br />
				<label for="edit-<?php echo $key . '-' . $item_id; ?>">
					<select id="edit-<?php echo $key . '-' . $item_id; ?>" class=" <?php echo $key; ?>" name="<?php echo $key . "[" . $item_id . "]"; ?>">
						<option value="standard" <?php echo ( $value == 'standard' ) ? ' selected="selected" ' : ''; ?>><?php esc_html_e( 'Standard Dropdown', 'wp_nuvo' ); ?></option>
						<option value="columns2" <?php echo ( $value == 'columns2' ) ? ' selected="selected" ' : ''; ?>><?php esc_html_e( '2 columns dropdown', 'wp_nuvo' ); ?></option>
						<option value="columns3" <?php echo ( $value == 'columns3' ) ? ' selected="selected" ' : ''; ?>><?php esc_html_e( '3 columns dropdown', 'wp_nuvo' ); ?>
						</option>
						<option value="columns4" <?php echo ( $value == 'columns4' ) ? ' selected="selected" ' : ''; ?>><?php esc_html_e( '4 columns dropdown', 'wp_nuvo' ); ?></option>
						<option value="columns5" <?php echo ( $value == 'columns5' ) ? ' selected="selected" ' : ''; ?>><?php esc_html_e( '5 columns dropdown', 'wp_nuvo' ); ?></option>
					</select>
				</label>
			</p>
			<?php
			$title = 'Sub menu column width ( Example: 200)';
			$key = "menu-item-column_width";
			$value = $item->column_width;
			?>            
            <p class="description description-wide obtheme_checkbox obtheme_mega_menu obtheme_mega_menu_d2">
                <label for="edit-<?php echo $key . '-' . $item_id; ?>">
                    <span class='obtheme_long_desc'><?php echo esc_html($title); ?></span><br />
                    <input type="text" value="<?php echo $value; ?>" id="edit-<?php echo $key . '-' . $item_id; ?>" class=" <?php echo $key; ?>" name="<?php echo $key . "[" . $item_id . "]"; ?>" />					
                </label>
            </p>
			<?php
			$title = 'Side of Dropdown Elements';
			$key = "menu-item-dropdown";
			$value = $item->dropdown;
			?>
			<p class="description description-wide description_width_100">
				<?php echo esc_html($title); ?><br />
				<label for="edit-<?php echo $key . '-' . $item_id; ?>">
					<select id="edit-<?php echo $key . '-' . $item_id; ?>" class=" <?php echo $key; ?>" name="<?php echo $key . "[" . $item_id . "]"; ?>">
						<option value="autodrop_submenu" <?php echo ( $value == 'autodrop_submenu' ) ? ' selected="selected" ' : ''; ?>><?php esc_html_e( 'Auto drop', 'wp_nuvo' ); ?></option>
						<option value="drop_to_left" <?php echo ( $value == 'drop_to_left' ) ? ' selected="selected" ' : ''; ?>><?php esc_html_e( 'Drop To Left Side', 'wp_nuvo' ); ?></option>
						<option value="drop_to_right" <?php echo ( $value == 'drop_to_right' ) ? ' selected="selected" ' : ''; ?>><?php esc_html_e( 'Drop To Right Side', 'wp_nuvo' ); ?></option>
						<option value="drop_to_center" <?php echo ( $value == 'drop_to_center' ) ? ' selected="selected" ' : ''; ?>><?php esc_html_e( 'Drop To Center', 'wp_nuvo' ); ?></option>
						<option value="drop_full_width" <?php echo ( $value == 'drop_full_width' ) ? ' selected="selected" ' : ''; ?>><?php esc_html_e( 'Full width', 'wp_nuvo' ); ?></option>
					</select>
				</label>
			</p>
            <?php
			}
			if($depth){
			$title = 'Widget Area';
			$key = "menu-item-widget_area";
			$value = $item->widget_area;
			$sidebars = $GLOBALS['wp_registered_sidebars'];
			?>
			<p class="description description-wide description_width_100 el_widget_area">
				<?php echo esc_html($title); ?><br />
				<label for="edit-<?php echo $key . '-' . $item_id; ?>">
					<select id="edit-<?php echo $key . '-' . $item_id; ?>" class=" <?php echo $key; ?>" name="<?php echo $key . "[" . $item_id . "]"; ?>">
						<option value="" <?php echo ( $value == '' ) ? ' selected="selected" ' : ''; ?>><?php esc_html_e( 'Select Widget Area', 'wp_nuvo' ); ?></option>
						<?php
						foreach ( $sidebars as $sidebar ) {
							echo '<option value="' . $sidebar['id'] . '" ' . ( ( $value == $sidebar['id'] ) ? ' selected="selected" ' : '' ) . '>[' . $sidebar['id'] . '] - ' . $sidebar['name'] . '</option>';
						}
						?>
					</select>
				</label>
			</p>
			<?php }
			$title = 'Group';
			$key = "menu-item-group";
			$value = $item->group;
			?>
			<p class="description description-wide description_width_100">
				<?php echo esc_html($title); ?><br />
				<label for="edit-<?php echo $key . '-' . $item_id; ?>">
					<select id="edit-<?php echo $key . '-' . $item_id; ?>" class=" <?php echo $key; ?>" name="<?php echo $key . "[" . $item_id . "]"; ?>">
						<option value="no_group" <?php echo ( $value == 'no_group' ) ? ' selected="selected" ' : ''; ?>><?php esc_html_e( 'No', 'wp_nuvo' ); ?></option>
						<option value="group" <?php echo ( $value == 'group' ) ? ' selected="selected" ' : ''; ?>><?php esc_html_e( 'Yes', 'wp_nuvo' ); ?></option>
					</select>
				</label>
			</p>
			<?php
			if($depth){
			$title = 'Hide title';
			$key = "menu-item-hide_link";
			$value = $item->hide_link;
			?>
			<p class="description description-wide description_width_100">
				<?php echo esc_html($title); ?><br />
				<label for="edit-<?php echo $key . '-' . $item_id; ?>">
					<select id="edit-<?php echo $key . '-' . $item_id; ?>" class=" <?php echo $key; ?>" name="<?php echo $key . "[" . $item_id . "]"; ?>">
						<option value="0" <?php echo ( $value == '0' ) ? ' selected="selected" ' : ''; ?>><?php esc_html_e( 'No', 'wp_nuvo' ); ?></option>
						<option value="1" <?php echo ( $value == '1' ) ? ' selected="selected" ' : ''; ?>><?php esc_html_e( 'Yes', 'wp_nuvo' ); ?></option>
					</select>
				</label>
			</p>
		<?php }
        $title = 'Menu Icon';
        $key = "menu-item-menu_icon";
        $value = $item->menu_icon;
        ?>
        <div id="<?php echo $key . '-' . $item_id . '-popup'; ?>" data-item_id="<?php echo $item_id;?>" class="menu_icon_wrap" style="display:none;">
            <?php
            $icons = array( 'adjust', 'adn', 'align-center', 'align-justify', 'align-left', 'align-right', 'ambulance', 'anchor', 'android', 'angle-double-down', 'angle-double-left', 'angle-double-right', 'angle-double-up', 'angle-down', 'angle-left', 'angle-right', 'angle-up', 'apple', 'archive', 'arrow-circle-down', 'arrow-circle-left', 'arrow-circle-o-down', 'arrow-circle-o-left', 'arrow-circle-o-right', 'arrow-circle-o-up', 'arrow-circle-right', 'arrow-circle-up', 'arrow-down', 'arrow-left', 'arrow-right', 'arrow-up', 'arrows', 'arrows-alt', 'arrows-h', 'arrows-v', 'asterisk', 'automobile', 'backward', 'ban', 'bank', 'bar-chart-o', 'barcode', 'bars', 'beer', 'behance', 'behance-square', 'bell', 'bell-o', 'bitbucket', 'bitbucket-square', 'bitcoin', 'bold', 'bolt', 'bomb', 'book', 'bookmark', 'bookmark-o', 'briefcase', 'btc', 'bug', 'building', 'building-o', 'bullhorn', 'bullseye', 'cab', 'calendar', 'calendar-o', 'camera', 'camera-retro', 'car', 'caret-down', 'caret-left', 'caret-right', 'caret-square-o-down', 'caret-square-o-left', 'caret-square-o-right', 'caret-square-o-up', 'caret-up', 'certificate', 'chain', 'chain-broken', 'check', 'check-circle', 'check-circle-o', 'check-square', 'check-square-o', 'chevron-circle-down', 'chevron-circle-left', 'chevron-circle-right', 'chevron-circle-up', 'chevron-down', 'chevron-left', 'chevron-right', 'chevron-up', 'child', 'circle', 'circle-o', 'circle-o-notch', 'circle-thin', 'clipboard', 'clock-o', 'cloud', 'cloud-download', 'cloud-upload', 'cny', 'code', 'code-fork', 'codepen', 'coffee', 'cog', 'cogs', 'columns', 'comment', 'comment-o', 'comments', 'comments-o', 'compass', 'compress', 'copy', 'credit-card', 'crop', 'crosshairs', 'css3', 'cube', 'cubes', 'cut', 'cutlery', 'dashboard', 'database', 'dedent', 'delicious', 'desktop', 'deviantart', 'digg', 'dollar', 'dot-circle-o', 'download', 'dribbble', 'dropbox', 'drupal', 'edit', 'eject', 'ellipsis-h', 'ellipsis-v', 'empire', 'envelope', 'envelope-o', 'envelope-square', 'eraser', 'eur', 'euro', 'exchange', 'exclamation', 'exclamation-circle', 'exclamation-triangle', 'expand', 'external-link', 'external-link-square', 'eye', 'eye-slash', 'facebook', 'facebook-square', 'fast-backward', 'fast-forward', 'fax', 'female', 'fighter-jet', 'file', 'file-archive-o', 'file-audio-o', 'file-code-o', 'file-excel-o', 'file-image-o', 'file-movie-o', 'file-o', 'file-pdf-o', 'file-photo-o', 'file-picture-o', 'file-powerpoint-o', 'file-sound-o', 'file-text', 'file-text-o', 'file-video-o', 'file-word-o', 'file-zip-o', 'files-o', 'film', 'filter', 'fire', 'fire-extinguisher', 'flag', 'flag-checkered', 'flag-o', 'flash', 'flask', 'flickr', 'floppy-o', 'folder', 'folder-o', 'folder-open', 'folder-open-o', 'font', 'forward', 'foursquare', 'frown-o', 'gamepad', 'gavel', 'gbp', 'ge', 'gear', 'gears', 'gift', 'git', 'git-square', 'github', 'github-alt', 'github-square', 'gittip', 'glass', 'globe', 'google', 'google-plus', 'google-plus-square', 'graduation-cap', 'group', 'h-square', 'hacker-news', 'hand-o-down', 'hand-o-left', 'hand-o-right', 'hand-o-up', 'hdd-o', 'header', 'headphones', 'heart', 'heart-o', 'history', 'home', 'hospital-o', 'html5', 'image', 'inbox', 'indent', 'info', 'info-circle', 'inr', 'instagram', 'institution', 'italic', 'joomla', 'jpy', 'jsfiddle', 'key', 'keyboard-o', 'krw', 'language', 'laptop', 'leaf', 'legal', 'lemon-o', 'level-down', 'level-up', 'life-bouy', 'life-ring', 'life-saver', 'lightbulb-o', 'link', 'linkedin', 'linkedin-square', 'linux', 'list', 'list-alt', 'list-ol', 'list-ul', 'location-arrow', 'lock', 'long-arrow-down', 'long-arrow-left', 'long-arrow-right', 'long-arrow-up', 'magic', 'magnet', 'mail-forward', 'mail-reply', 'mail-reply-all', 'male', 'map-marker', 'maxcdn', 'medkit', 'meh-o', 'microphone', 'microphone-slash', 'minus', 'minus-circle', 'minus-square', 'minus-square-o', 'mobile', 'mobile-phone', 'money', 'moon-o', 'mortar-board', 'music', 'navicon', 'openid', 'outdent', 'pagelines', 'paper-plane', 'paper-plane-o', 'paperclip', 'paragraph', 'paste', 'pause', 'paw', 'pencil', 'pencil-square', 'pencil-square-o', 'phone', 'phone-square', 'photo', 'picture-o', 'pied-piper', 'pied-piper-alt', 'pied-piper-square', 'pinterest', 'pinterest-square', 'plane', 'play', 'play-circle', 'play-circle-o', 'plus', 'plus-circle', 'plus-square', 'plus-square-o', 'power-off', 'print', 'puzzle-piece', 'qq', 'qrcode', 'question', 'question-circle', 'quote-left', 'quote-right', 'ra', 'random', 'rebel', 'recycle', 'reddit', 'reddit-square', 'refresh', 'renren', 'reorder', 'repeat', 'reply', 'reply-all', 'retweet', 'rmb', 'road', 'rocket', 'rotate-left', 'rotate-right', 'rouble', 'rss', 'rss-square', 'rub', 'ruble', 'rupee', 'save', 'scissors', 'search', 'search-minus', 'search-plus', 'send', 'send-o', 'share', 'share-alt', 'share-alt-square', 'share-square', 'share-square-o', 'shield', 'shopping-cart', 'sign-in', 'sign-out', 'signal', 'sitemap', 'skype', 'slack', 'sliders', 'smile-o', 'sort', 'sort-alpha-asc', 'sort-alpha-desc', 'sort-amount-asc', 'sort-amount-desc', 'sort-asc', 'sort-desc', 'sort-down', 'sort-numeric-asc', 'sort-numeric-desc', 'sort-up', 'soundcloud', 'space-shuttle', 'spinner', 'spoon', 'spotify', 'square', 'square-o', 'stack-exchange', 'stack-overflow', 'star', 'star-half', 'star-half-empty', 'star-half-full', 'star-half-o', 'star-o', 'steam', 'steam-square', 'step-backward', 'step-forward', 'stethoscope', 'stop', 'strikethrough', 'stumbleupon', 'stumbleupon-circle', 'subscript', 'suitcase', 'sun-o', 'superscript', 'support', 'table', 'tablet', 'tachometer', 'tag', 'tags', 'tasks', 'taxi', 'tencent-weibo', 'terminal', 'text-height', 'text-width', 'th', 'th-large', 'th-list', 'thumb-tack', 'thumbs-down', 'thumbs-o-down', 'thumbs-o-up', 'thumbs-up', 'ticket', 'times', 'times-circle', 'times-circle-o', 'tint', 'toggle-down', 'toggle-left', 'toggle-right', 'toggle-up', 'trash-o', 'tree', 'trello', 'trophy', 'truck', 'try', 'tumblr', 'tumblr-square', 'turkish-lira', 'twitter', 'twitter-square', 'umbrella', 'underline', 'undo', 'university', 'unlink', 'unlock', 'unlock-alt', 'unsorted', 'upload', 'usd', 'user', 'user-md', 'users', 'video-camera', 'vimeo-square', 'vine', 'vk', 'volume-down', 'volume-off', 'volume-up', 'warning', 'wechat', 'weibo', 'weixin', 'wheelchair', 'windows', 'won', 'wordpress', 'wrench', 'xing', 'xing-square', 'yahoo', 'yen', 'youtube', 'youtube-play', 'youtube-square' );
            $html = '<input type="hidden" name="" class="wpb_vc_param_value" value="' . $value . '" id="trace"/> ';
            $html .= '<div class="icon-preview icon-preview-' . $item_id . '"><i class=" fa fa-' . $value . '"></i></div>';
            $html .= '<div id="' . $key . '-' . $item_id . '-icon-dropdown" >';
            $html .= '<ul class="icon-list">';
            $n = 1;
            foreach ( $icons as $icon ) {
                $selected = ( $icon == $value ) ? 'class="selected"' : '';
                $id       = 'icon-' . $n;
                $html .= '<li ' . $selected . ' data-icon="' . $icon . '"><i class="icon fa fa-' . $icon . '"></i></li>';
                $n ++;
            }
            $html .= '</ul>';
            $html .= '</div>';
            echo $html;
            ?>
        </div>
        <p class="description description-wide obtheme_checkbox obtheme_mega_menu obtheme_mega_menu_d1">
            <label for="edit-<?php echo $key . '-' . $item_id; ?>">
                <?php echo esc_html($title); ?><br />
                <input type="text" value="<?php echo $value; ?>" id="edit-<?php echo $key . '-' . $item_id; ?>" class=" <?php echo $key; ?>" name="<?php echo $key . "[" . $item_id . "]"; ?>" />
                <input alt="#TB_inline?height=400&width=500&inlineId=<?php echo $key . '-' . $item_id . '-popup'; ?>" title="<?php esc_html_e( 'Click to browse icon', 'wp_nuvo' ) ?>" class="thickbox button-secondary submit-add-to-menu" type="button" value="<?php esc_html_e( 'Browse Icon', 'wp_nuvo' ) ?>" />
				<a class="button btn_clear button-primary" href="javascript: void(0);">Clear</a>
                <span class="icon-preview  icon-preview<?php echo '-' . $item_id; ?>"><i class=" fa fa-<?php echo $value; ?>"></i></span>
            </label>
        </p>
			<!-- Start background menu -->
            <?php
			if ( ! $depth ) {
            $title = 'DropDown Background Image';
            $key = "menu-item-bg_image";
            $value = $item->bg_image;
            ?>
            
            <p class="description description-wide obtheme_checkbox obtheme_mega_menu obtheme_mega_menu_d2">
                <label for="edit-<?php echo $key . '-' . $item_id; ?>">
                    <span class='obtheme_long_desc'><?php echo esc_html($title); ?></span><br />
                    <input type="text" value="<?php echo $value; ?>" id="edit-<?php echo $key . '-' . $item_id; ?>" class=" <?php echo $key; ?>" name="<?php echo $key . "[" . $item_id . "]"; ?>" />
                    <button id="browse-edit-<?php echo $key . '-' . $item_id; ?>" class="set_custom_images button button-secondary submit-add-to-menu"><?php esc_html_e( 'Browse Image', 'wp_nuvo' ); ?></button>
					<a class="button btn_clear button-primary" href="javascript: void(0);">Clear</a>
                </label>
            </p>
            <p class="description description-wide description_width_25">
                <?php
                $key = "menu-item-bg_image_repeat";
                $value = $item->bg_image_repeat;
                $options = array( 'repeat', 'no-repeat', 'repeat-x', 'repeat-y' );
                ?>
                <label for="edit-<?php echo $key . '-' . $item_id; ?>">
                    <select id="edit-<?php echo $key . '-' . $item_id; ?>" class=" <?php echo $key; ?>" name="<?php echo $key . "[" . $item_id . "]"; ?>">
                        <?php
                        foreach ( $options as $option ) {
                            ?>
                            <option value="<?php echo $option; ?>" <?php echo ( $value == $option ) ? ' selected="selected" ' : ''; ?>><?php echo $option; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </label>
                <?php
                $key = "menu-item-bg_image_attachment";
                $value = $item->bg_image_attachment;
                $options = array( 'scroll', 'fixed' );
                ?>
                <label for="edit-<?php echo $key . '-' . $item_id; ?>">
                    <select id="edit-<?php echo $key . '-' . $item_id; ?>" class=" <?php echo $key; ?>" name="<?php echo $key . "[" . $item_id . "]"; ?>">
                        <?php
                        foreach ( $options as $option ) {
                            ?>
                            <option value="<?php echo $option; ?>" <?php echo ( $value == $option ) ? ' selected="selected" ' : ''; ?>><?php echo $option; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </label>

                <?php
                $key = "menu-item-bg_image_position";
                $value = $item->bg_image_position;
                $options = array( 'center', 'center left', 'center right', 'top left', 'top center', 'top right', 'bottom left', 'bottom center', 'bottom right' );
                ?>
                <label for="edit-<?php echo $key . '-' . $item_id; ?>">
                    <select id="edit-<?php echo $key . '-' . $item_id; ?>" class=" <?php echo $key; ?>" name="<?php echo $key . "[" . $item_id . "]"; ?>">
                        <?php
                        foreach ( $options as $option ) {
                            ?>
                            <option value="<?php echo $option; ?>" <?php echo ( $value == $option ) ? ' selected="selected" ' : ''; ?>><?php echo $option; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </label>

                <?php
                $key = "menu-item-bg_image_size";
                $value = $item->bg_image_size;
                $options = array( "auto"      => "Keep original",
                                  "100% auto" => "Stretch to width",
                                  "auto 100%" => "Stretch to height",
                                  "cover"     => "cover",
                                  "contain"   => "contain" );
                ?>
                <label for="edit-<?php echo $key . '-' . $item_id; ?>">
                    <select id="edit-<?php echo $key . '-' . $item_id; ?>" class=" <?php echo $key; ?>" name="<?php echo $key . "[" . $item_id . "]"; ?>">
                        <?php
                        foreach ( $options as $op_value => $op_text ) {
                            ?>
                            <option value="<?php echo $op_value; ?>" <?php echo ( $value == $op_value ) ? ' selected="selected" ' : ''; ?>><?php echo $op_text; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </label>
            </p>
            <?php
            $title = 'Background Color';
            $key = "menu-item-bg_color";
            $value = $item->bg_color;
            ?>

            <p class="description description-wide">
                <label for="edit-<?php echo $key . '-' . $item_id; ?>">
                    <span class='obtheme_long_desc'><?php echo esc_html($title); ?></span><br />
                    <input type="text" value="<?php echo $value; ?>" id="edit-<?php echo $key . '-' . $item_id; ?>" class=" <?php echo $key; ?>" name="<?php echo $key . "[" . $item_id . "]"; ?>" />
                </label>
            </p>
			<?php } ?>
			<!-- End background menu -->
            <div class="menu-item-actions description-wide submitbox">
                <?php if( 'custom' != $item->type && $original_title !== false ) : ?>
                    <p class="link-to-original">
                        <?php printf( esc_html__('Original: %s', 'wp_nuvo'), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
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
                ); ?>"><?php esc_html_e('Remove','wp_nuvo'); ?></a> <span class="meta-sep"> | </span> <a class="item-cancel submitcancel" id="cancel-<?php echo $item_id; ?>" href="<?php echo esc_url( add_query_arg( array('edit-menu-item' => $item_id, 'cancel' => time()), remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) ) ) );
                    ?>#menu-item-settings-<?php echo $item_id; ?>"><?php esc_html_e('Cancel','wp_nuvo'); ?></a>
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
class HeroMenuWalker extends Walker_Nav_Menu {
    function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( ! $element ) {
            return;
        }
        $id_field = $this->db_fields['id'];
        //display this element
        if ( isset( $args[0] ) && is_array( $args[0] ) ) {
            $args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );
        }
        $cb_args = array_merge( array( &$output, $element, $depth ), $args );
        call_user_func_array( array( $this, 'start_el' ), $cb_args );

        $id = $element->$id_field;

        // descend only when the depth is right and there are childrens for this element
        if ( ( $max_depth == 0 || $max_depth > $depth + 1 ) && isset( $children_elements[$id] ) ) {
            $b          = $args[0];
            $b->element = $element;
            $b->count_child = count($children_elements[$id]);
			//$b->mega_child = $element->mega;
            $args[0]    = $b;
            foreach ( $children_elements[$id] as $child ) {
                if ( ! isset( $newlevel ) ) {
                    $newlevel = true;
                    //start the child delimiter
					$cb_args = array_merge( array( &$output, $depth ), $args );
					$cb_args = array_merge( array( &$output, $depth ), $args );
                    call_user_func_array( array( $this, 'start_lvl' ), $cb_args );
                }
                $this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
            }
            unset( $children_elements[$id] );
        }

        if ( isset( $newlevel ) && $newlevel ) {
            //end the child delimiter
            $cb_args = array_merge( array( &$output, $depth ), $args );
            call_user_func_array( array( $this, 'end_lvl' ), $cb_args );
        }

        //end this element
        $cb_args = array_merge( array( &$output, $element, $depth ), $args );
        call_user_func_array( array( $this, 'end_el' ), $cb_args );
    }

    function start_lvl( &$output, $depth = 0, $args = array() )  {
        $bg_image        = isset($args->element->bg_image)?$args->element->bg_image:'';
        $column_width        = isset($args->element->column_width)?(!empty($args->element->column_width)?$args->element->column_width:200):200;
        $bg_color        = isset($args->element->bg_color)?$args->element->bg_color:'';
        $pos_left        = isset($args->element->pos_left)?$args->element->pos_left:'';
        $pos_right        = isset($args->element->pos_right)?$args->element->pos_right:'';
        $submenu_type        = isset($args->element->submenu_type)?$args->element->submenu_type:'standard';
        $dropdown        = isset($args->element->dropdown)?$args->element->dropdown:'drop_to_left';
		$class = null;
		$style = 'style="';
		$columns = array('columns2'=>2,'columns3'=>3,'columns4'=>4,'columns5'=>5);
		if($submenu_type != 'standard' && $depth == 0){
			if(isset($columns[$submenu_type])){				
				$style = 'style="width:'.($column_width*$columns[$submenu_type]).'px;';				
				$class = 'multicolumn mega-columns-'.$columns[$submenu_type];
			}
			$class = 'multicolumn';
		}else if($depth == 0){
			$style = 'style="width:'.($column_width).'px;';
			$class = 'standar-dropdown';
		}
		$class .= ' '.$submenu_type;
		$class .= ' '.$dropdown;
        $class = $bg_image?$class .= ' sub-menu mega-bg-image':$class .= ' sub-menu';
        if ( $bg_image ) {
            $bg_image_repeat     = $args->element->bg_image_repeat;
            $bg_image_attachment = $args->element->bg_image_attachment;
            $bg_image_position   = $args->element->bg_image_position;
            $bg_image_size       = $args->element->bg_image_size;
            $style               .= 'background-image:url(' . $bg_image . ');background-repeat:' . $bg_image_repeat . ';background-attachment:' . $bg_image_attachment . ';background-position:' . $bg_image_position . ';background-size:' . $bg_image_size . ';';
        }
        if ( $bg_color ) {
            $style               .= 'background-color:'.$bg_color.';';
        }
        if ( $pos_left ) {
            $style               .= 'left:'.$pos_left.';';
        }
        if ( $pos_right ) {
            $style               .= 'right:'.$pos_right.';';
        }
        $style .='"';
        $indent = str_repeat( "\t", $depth );

        $output .= "\n$indent<ul class='$class' $style>\n";
    }

    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        $class_names = '';
        $menu_icon = isset($item->menu_icon)?$item->menu_icon:'';
        $dropdown = isset($item->dropdown)?$item->dropdown:'';
        $hide_link = isset($item->hide_link)?$item->hide_link:0;
        $group = isset($item->group)?$item->group:'';
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
		if($dropdown == "drop_full_width"){
			$classes[]= 'has_full_width';
		}
		$classes[]= $group;
        $classes[] = 'menu-item-' . $item->ID;
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
        $output .= $indent . '<li' . $id . $class_names .' data-depth="'.$depth.'">';
        $atts = array();        
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
		$attr_title  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $item_output = isset($args->before)?$args->before:'';
        $link_before = isset($args->link_before)?$args->link_before:'';
        $link_after = isset($args->link_after)?$args->link_after:'';
        $after = isset($args->after)?$args->after:'';
		if(!$hide_link || $hide_link=="0"){
        $item_output .= '<a'. $attributes .'>';
		$item_output.='<span class="menu-title">';
        if ( $menu_icon ) {
            $item_output .= '<i class="fa fa-fw fa-' . $menu_icon . '"></i> ';
        }
        $item_output .= $link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $link_after;
		if ( $attr_title ) {
            $item_output .= '<span class="title-attribute">'.$attr_title.'</span> ';
        }
        $item_output .= '</span></a>';	
		}
		$widget_area = $item->widget_area;
		if ($widget_area && $depth != 0) {
			ob_start();
			dynamic_sidebar($widget_area);
			$content         = ob_get_clean();
			if ( $content ) {
				$item_output .= $content;
			}
		}
        $item_output .= $after;
		
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

}



if(!function_exists('hero_get_main_menu_parent_items')){
    function hero_get_main_menu_parent_items(){
        $menu_name = 'cs_main_menu';
        $locations = get_nav_menu_locations();
        $items = array();

        if ( isset( $locations[ $menu_name ] ) && $locations[ $menu_name ] != 0) {
            $menu_id = $locations[ $menu_name ];

            $items = hero_get_menu_parent_items($menu_id);


            //get the WPML translated items
            $trans_items = hero_get_translation_items($menu_id);
            if(!empty($trans_items)){
                $items = array_merge($items, $trans_items);
            }

        }

        return $items;
    }
}

if(!function_exists('hero_get_menu_parent_items')){
    function hero_get_menu_parent_items($menu_id){
        $menu = wp_get_nav_menu_object( $menu_id );

        $menu_items = wp_get_nav_menu_items($menu->term_id);
        $items = array();

        if(sizeof($menu_items)){
            foreach ($menu_items as $item) {
                if($item->menu_item_parent==0){
                    $items[]= array('id'=>$item->ID, 'name'=>$item->title);
                }
            }
        }

        return $items;
    }
}

if(!function_exists('hero_get_translation_items')){
    function hero_get_translation_items($main_id){
        $items = array();
        if(function_exists('icl_object_id') && function_exists('icl_get_languages')){
            //get the WPML languages
            $languages = icl_get_languages('skip_missing=0');
            foreach ($languages as $lang) {
                $code = $lang['language_code'];
                if(!empty($code)){
                    $menu_id_str = icl_object_id($main_id, 'nav_menu', false, $code);
                    if(!empty($menu_id_str)){
                        $menu_id = intval($menu_id_str);

                        if($menu_id!=$main_id){
                            $menu_items = hero_get_menu_parent_items($menu_id);

                            if(!empty($menu_items)){
                                $items = array_merge($items, $menu_items);
                            }
                        }

                    }
                }
            }
        }

        return $items;
    }
}
<?php
register_nav_menus(array(
    'main_menu' => __( 'Main Navigation', 'mango' ),
    'mobile_menu' => __( 'Mobile Menu', 'mango' ),
    'header_14_menu' => __( 'Header 14 Side Menu', 'mango' ),
    'footer_menu' =>  __( 'Footer Menu', 'mango' ),
	'primary_menu'		=> __( 'Demo21 Primary Menu', 'mango' ),
));

// add custom menu fields to menu
add_filter( 'wp_setup_nav_menu_item', 'mango_add_custom_nav_fields' );

function mango_add_custom_nav_fields( $menu_item ) {
    $menu_item->icon = get_post_meta( $menu_item->ID, '_menu_item_icon', true );
    $menu_item->icon_pos = get_post_meta( $menu_item->ID, '_menu_item_icon_pos', true );
    $menu_item->nolink = get_post_meta( $menu_item->ID, '_menu_item_nolink', true );
    $menu_item->hide = get_post_meta( $menu_item->ID, '_menu_item_hide', true );
    $menu_item->mobile_hide = get_post_meta( $menu_item->ID, '_menu_item_mobile_hide', true );
    $menu_item->hide_cat_image = get_post_meta( $menu_item->ID, '_menu_item_hide_cat_image', true );
    $menu_item->hide_subcats_list = get_post_meta( $menu_item->ID, '_menu_item_hide_subcats_list', true );
    $menu_item->hide_empty_subcats = get_post_meta( $menu_item->ID, '_menu_item_hide_empty_subcats', true );
    $menu_item->cols = get_post_meta( $menu_item->ID, '_menu_item_cols', true );
    $menu_item->tip_label = get_post_meta( $menu_item->ID, '_menu_item_tip_label', true );
    $menu_item->tip_color = get_post_meta( $menu_item->ID, '_menu_item_tip_color', true );
    $menu_item->tip_bg = get_post_meta( $menu_item->ID, '_menu_item_tip_bg', true );
    $menu_item->popup_type = get_post_meta( $menu_item->ID, '_menu_item_popup_type', true );
    $menu_item->popup_pos = get_post_meta( $menu_item->ID, '_menu_item_popup_pos', true );
    $menu_item->popup_cols = get_post_meta( $menu_item->ID, '_menu_item_popup_cols', true );
    $menu_item->popup_bg_image = get_post_meta( $menu_item->ID, '_menu_item_popup_bg_image', true );
    $menu_item->popup_bg_pos = get_post_meta( $menu_item->ID, '_menu_item_popup_bg_pos', true );
    $menu_item->popup_bg_repeat = get_post_meta( $menu_item->ID, '_menu_item_popup_bg_repeat', true );
    $menu_item->popup_bg_size = get_post_meta( $menu_item->ID, '_menu_item_popup_bg_size', true );
    $menu_item->popup_style = get_post_meta( $menu_item->ID, '_menu_item_popup_style', true );
    $menu_item->subpopup_bg_image = get_post_meta( $menu_item->ID, '_menu_item_subpopup_bg_image', true );
    $menu_item->subpopup_bg_pos = get_post_meta( $menu_item->ID, '_menu_item_subpopup_bg_pos', true );
    $menu_item->subpopup_bg_repeat = get_post_meta( $menu_item->ID, '_menu_item_subpopup_bg_repeat', true );
    $menu_item->subpopup_bg_size = get_post_meta( $menu_item->ID, '_menu_item_subpopup_bg_size', true );
    $menu_item->subpopup_style = get_post_meta( $menu_item->ID, '_menu_item_subpopup_style', true );
    $menu_item->block = get_post_meta( $menu_item->ID, '_menu_item_block', true );
    $menu_item->show_category_img = get_post_meta( $menu_item->ID, '_menu_item_show_category_img', true );
    return $menu_item;
}

// save menu custom fields
add_action( 'wp_update_nav_menu_item', 'mango_update_custom_nav_fields', 10, 3 );
function mango_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {
    $check = array('icon', 'icon_pos', 'nolink', 'hide', 'mobile_hide', 'hide_cat_image', 'hide_subcats_list', 'hide_empty_subcats',  'cols', 'popup_type', 'popup_pos', 'popup_cols', 'popup_bg_image', 'popup_bg_pos', 'popup_bg_repeat', 'popup_bg_size', 'popup_style', 'subpopup_bg_image', 'subpopup_bg_pos', 'subpopup_bg_repeat', 'subpopup_bg_size', 'subpopup_style', 'block', 'tip_label', 'tip_color', 'tip_bg', 'show_category_img');

    foreach ( $check as $key ) {
        if (!isset($_POST['menu-item-'.$key][$menu_item_db_id])){
            if (!isset($args['menu-item-'.$key]))
                $value = "";
            else
                $value = $args['menu-item-'.$key];

        } else {
            $value = $_POST['menu-item-'.$key][$menu_item_db_id];
        }
        update_post_meta( $menu_item_db_id, '_menu_item_'.$key, $value );
    }
}

// edit menu walker
add_filter( 'wp_edit_nav_menu_walker', 'mango_edit_walker', 10, 2 );
function mango_edit_walker($walker,$menu_id) {
    return 'Walker_Nav_Menu_Edit_Custom';
}

// Create HTML list of nav menu input items.
// Extend from Walker_Nav_Menu class
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
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
	
        global $_wp_nav_menu_max_depth;
		if($item->icon_pos == ""){
		$item->icon_pos = "Left";
		}
        $_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        $item_id = esc_attr( $item->ID );
        $removed_args = array(
            'action',
            'customlink-tab',
            'edit-menu-item',
            'menu-item',
            'page-tab',
            '_wpnonce',
        );
        ob_start();
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
            $title = sprintf( '%s (Invalid)', $item->title );
        } elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
            $classes[] = 'pending';
            /* translators: %s: title of menu item in draft status */
            $title = sprintf( '%s (Pending)', $item->title );
        }

        $title = empty( $item->label ) ? $title : $item->label;
        ?>
        <li id="menu-item-<?php echo esc_attr($item_id); ?>" class="<?php echo implode(' ', $classes ); ?>">
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
                    ?>" class="item-move-up"><abbr title="Move up">&#8593;</abbr></a>
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
                    ?>" class="item-move-down"><abbr title="Move down">&#8595;</abbr></a>
                </span>
                <a class="item-edit" id="edit-<?php echo esc_attr($item_id); ?>" title="Edit Menu Item" href="<?php
                echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] )
                    ? admin_url( 'nav-menus.php' )
                    : add_query_arg( 'edit-menu-item', $item_id,
                        remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
                ?>"><?php echo 'Edit Menu Item'; ?></a>
            </span>
                </dt>
            </dl>
            <div class="menu-item-settings" id="menu-item-settings-<?php echo esc_attr($item_id); ?>">
                <?php if( 'custom' == $item->type ) : ?>
                    <p class="description description-wide">
                        <label for="edit-menu-item-url-<?php echo esc_attr($item_id); ?>">
                            <?php echo 'URL'; ?><br />
                            <input type="text" id="edit-menu-item-url-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-url"
                                <?php if (esc_attr( $item->url )) : ?>
                                    name="menu-item-url[<?php echo esc_attr($item_id); ?>]"
                                <?php endif; ?>
                                   data-name="menu-item-url[<?php echo esc_attr($item_id); ?>]"
                                   value="<?php echo esc_attr( $item->url ); ?>" />
                        </label>
                    </p>
                <?php endif; ?>
                <?php //echo "<pre>"; print_r($item); echo "</pre>"; ?>
                <p class="description description-wide">
                    <label for="edit-menu-item-title-<?php echo esc_attr($item_id); ?>">
                        <?php echo 'Navigation Label'; ?><br />
                        <input type="text" id="edit-menu-item-title-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-title"
                            <?php if (esc_attr( $item->title )) : ?>
                                name="menu-item-title[<?php echo esc_attr($item_id); ?>]"
                            <?php endif; ?>
                               data-name="menu-item-title[<?php echo esc_attr($item_id); ?>]"
                               value="<?php echo esc_attr( $item->title ); ?>" />
                    </label>
                </p>
                <p class="description">
                    <label for="edit-menu-item-target-<?php echo esc_attr($item_id); ?>">
                        <input type="checkbox" id="edit-menu-item-target-<?php echo esc_attr($item_id); ?>" value="_blank"
                            <?php if ($item->target == '_blank') : ?>
                                name="menu-item-target[<?php echo esc_attr($item_id); ?>]"
                            <?php endif; ?>
                               data-name="menu-item-target[<?php echo esc_attr($item_id); ?>]"
                            <?php checked( $item->target, '_blank' ); ?> />
                        <?php echo 'Open link in a new window/tab'; ?>
                    </label>
                </p>
                <?php
                /* New fields insertion starts here */
                $arr_font = array('select','fa-adjust','fa-adn','fa-align-center','fa-align-justify','fa-align-left','fa-align-right','fa-ambulance','fa-anchor','fa-android','fa-angellist','fa-angle-double-down','fa-angle-double-left','fa-angle-double-right','fa-angle-double-up','fa-angle-down','fa-angle-left','fa-angle-right','fa-angle-up','fa-apple','fa-archive','fa-area-chart','fa-arrow-circle-down','fa-arrow-circle-left','fa-arrow-circle-o-down','fa-arrow-circle-o-left','fa-arrow-circle-o-right','fa-arrow-circle-o-up','fa-arrow-circle-right','fa-arrow-circle-up','fa-arrow-down','fa-arrow-left','fa-arrow-right','fa-arrow-up','fa-arrows','fa-arrows-alt','fa-arrows-h','fa-arrows-v','fa-asterisk','fa-at','fa-automobile','fa-backward','fa-ban','fa-bank','fa-bar-chart','fa-bar-chart-o','fa-barcode','fa-bars','fa-bed','fa-beer','fa-behance','fa-behance-square','fa-bell','fa-bell-o','fa-bell-slash','fa-bell-slash-o','fa-bicycle','fa-binoculars','fa-birthday-cake','fa-bitbucket','fa-bitbucket-square','fa-bitcoin','fa-bold','fa-bomb','fa-book','fa-bookmark','fa-bookmark-o','fa-briefcase','fa-btc','fa-bug','fa-building','fa-building-o','fa-bullhorn','fa-bullseye','fa-bus','fa-buysellads','fa-cab','fa-calculator','fa-calendar','fa-calendar-o','fa-camera','fa-camera-retro','fa-car','fa-caret-down','fa-caret-left','fa-caret-right','fa-caret-square-o-down','fa-caret-square-o-left','fa-caret-square-o-right','fa-caret-square-o-up','fa-caret-up','fa-cart-arrow-down','fa-cart-plus','fa-cc','fa-cc-amex','fa-cc-discover','fa-cc-mastercard','fa-cc-paypal','fa-cc-stripe','fa-cc-visa','fa-certificate','fa-chain','fa-chain-broken','fa-check','fa-check-circle','fa-check-circle-o','fa-check-square','fa-check-square-o','fa-chevron-circle-down','fa-chevron-circle-left','fa-chevron-circle-right','fa-chevron-circle-up','fa-chevron-down','fa-chevron-left','fa-chevron-right','fa-chevron-up','fa-child','fa-circle','fa-circle-o','fa-circle-o-notch','fa-circle-thin','fa-clipboard','fa-clock-o','fa-close','fa-cloud','fa-cloud-download','fa-cloud-upload','fa-cny','fa-code','fa-code-fork','fa-codepen','fa-coffee','fa-cog','fa-cogs','fa-columns','fa-comment','fa-comment-o','fa-comments','fa-comments-o','fa-compass','fa-compress','fa-compress','fa-connectdevelop','fa-copy','fa-copyright','fa-credit-card','fa-crop','fa-crosshairs','fa-css','fa-cube','fa-cubes','fa-cut','fa-cutlery','fa-dashboard','fa-dashcube','fa-database','fa-dedent','fa-delicious','fa-desktop','fa-deviantart','fa-diamond','fa-digg','fa-dollar','fa-dot-circle-o','fa-download','fa-dribbble','fa-dropbox','fa-drupal','fa-edit','fa-eject','fa-ellipsis-h','fa-ellipsis-v','fa-empire','fa-envelope','fa-envelope-o','fa-envelope-square','fa-eraser','fa-eur','fa-euro','fa-exchange','fa-exclamation','fa-exclamation-circle','fa-exclamation-triangle','fa-expand','fa-external-link','fa-external-link-square','fa-eye','fa-eye-slash','fa-eyedropper','fa-facebook','fa-facebook-f','fa-facebook-official','fa-facebook-square','fa-fast-backward','fa-fast-forward','fa-fax','fa-female','fa-fighter-jet','fa-file','fa-file-archive-o','fa-file-audio-o','fa-file-code-o','fa-file-excel-o','fa-file-image-o','fa-file-movie-o','fa-file-o','fa-file-pdf-o','fa-file-pdf-o','fa-file-picture-o','fa-file-powerpoint-o','fa-file-sound-o','fa-file-text','fa-file-text-o','fa-file-video-o','fa-file-word-o','fa-file-zip-o','fa-files-o','fa-film','fa-filter','fa-fire','fa-fire-extinguisher','fa-flag','fa-flag-checkered','fa-flag-o','fa-flash','fa-flask','fa-flickr','fa-floppy-o','fa-folder','fa-folder-o','fa-folder-open','fa-folder-open-o','fa-font','fa-forumbee','fa-forward','fa-foursquare','fa-frown-o','fa-futbol-o','fa-gamepad','fa-gavel','fa-gbp','fa-ge','fa-gear','fa-gears','fa-genderless','fa-gift','fa-git','fa-git-square','fa-github','fa-github-alt','fa-github-square','fa-gittip','fa-glass','fa-globe','fa-google','fa-google-plus','fa-google-plus-square','fa-google-wallet','fa-graduation-cap','fa-gratipay','fa-group','fa-h-square','fa-hacker-news','fa-hand-o-down','fa-hand-o-left','fa-hand-o-right','fa-hand-o-up','fa-hdd-o','fa-header','fa-headphones','fa-heart','fa-heart-o','fa-heartbeat','fa-history','fa-home','fa-hospital-o','fa-hotel','fa-html','fa-ils','fa-image','fa-inbox','fa-indent','fa-info','fa-circle','fa-inr','fa-instagram','fa-institution','fa-ioxhost','fa-italic','fa-joomla','fa-jpy','fa-jsfiddle','fa-key','fa-keyboard-o','fa-krw','fa-language','fa-laptop','fa-lastfm','fa-lastfm-square','fa-leaf','fa-leanpub','fa-legal','fa-level-down','fa-level-up','fa-life-bouy','fa-life-ring','fa-life-saver','fa-lightbulb-o','fa-line-chart','fa-link','fa-linkedin','fa-linkedin-square','fa-linux','fa-list','fa-list-alt','fa-list-ol','fa-list-ul','fa-location-arrow','fa-lock','fa-long-arrow-down','fa-long-arrow-left','fa-long-arrow-right','fa-long-arrow-up','fa-magic','fa-magnet','fa-mail-forward','fa-mail-reply','fa-mail-reply-all','fa-male','fa-map-marker','fa-map','fa-map-double','fa-map-stroke','fa-map-stroke-h','fa-map-stroke-v','fa-maxcdn','fa-meanpath','fa-medium','fa-medkit','fa-meh-o','fa-mercury','fa-microphone','fa-microphone-slash','fa-minus','fa-minus-circle','fa-minus-square','fa-minus-square-o','fa-mobile','fa-mobile-phone','fa-money','fa-moon-o','fa-mortar-board','fa-motorcycle','fa-music','fa-navicon','fa-neuter','fa-newspaper-o','fa-openid','fa-outdents','fa-pagelines','fa-paint-brush','fa-paper-plane','fa-paper-plane-o','fa-paperclip','fa-paragraph','fa-paste','fa-pause','fa-paw','fa-paypal','fa-pencil','fa-pencil-square','fa-pencil-square-o','fa-phone','fa-phone-square','fa-photo','fa-picture-o','fa-pie-chart','fa-pied-piper','fa-pied-piper-alt','fa-pinterest','fa-pinterest-p','fa-pinterest-square','fa-plane','fa-play','fa-play-circle','fa-play-circle-o','fa-plug','fa-plus','fa-plus-circle','fa-plus-square','fa-plus-square-o','fa-power-off','fa-print','fa-puzzle-piece','fa-qq','fa-qrcode','fa-question','fa-question-circle','fa-quote-left','fa-quote-right','fa-ra','fa-random','fa-rebel','fa-recycle','fa-reddit','fa-reddit-square','fa-refresh','fa-remove','fa-renren','fa-reorder','fa-repeat','fa-reply','fa-reply-all','fa-retweet','fa-rmb','fa-road','fa-rocket','fa-rotate-left','fa-rotate-right','fa-rouble','fa-rss','fa-rss-square','fa-rub','fa-ruble','fa-rupee','fa-save','fa-scissors','fa-search','fa-search-minus','fa-search-plus','fa-sellsy','fa-send-o','fa-server','fa-share','fa-share-alt','fa-share-alt-square','fa-share-square','fa-share-square-o','fa-shekel','fa-sheqel','fa-shield','fa-ship','fa-shirtsinbulk','fa-shopping-cart','fa-sign-in','fa-sign-out','fa-signal','fa-simplybuilt','fa-sitemap','fa-skyatlas','fa-skype','fa-slack','fa-sliders','fa-slideshare','fa-smile-o','fa-soccer-ball-o','fa-sort','fa-sort-alpha-asc','fa-sort-alpha-desc','fa-sort-amount-asc','fa-sort-amount-desc','fa-sort-asc','fa-sort-desc','fa-sort-down','fa-sort-numeric-asc','fa-sort-numeric-desc','fa-sort-up','fa-soundcloud','fa-space-shuttle','fa-spinner','fa-spoon','fa-spotify','fa-square','fa-square-o','fa-stack-exchange','fa-stack-overflow','fa-star','fa-star-half','fa-star-half-empty','fa-star-half-full','fa-star-half-o','fa-star-o','fa-steam','fa-steam-square','fa-step-backward','fa-step-forward','fa-stethoscope','fa-stop','fa-street-view','fa-strikethrough','fa-stumbleupon','fa-stumbleupon-circle','fa-subscript','fa-subway','fa-suitcase','fa-sun-o','fa-superscript','fa-support','fa-table','fa-tablet','fa-tachometer','fa-tag','fa-tags','fa-tasks','fa-taxi','fa-tencent-weibo','fa-terminal','fa-text-height','fa-text-width','fa-th','fa-th-large','fa-th-list','fa-thumb-tack','fa-thumbs-down','fa-thumbs-o-down','fa-thumbs-o-up','fa-thumbs-up','fa-ticket','fa-times','fa-times-circle-o','fa-tint','fa-toggle-down','fa-toggle-down','fa-toggle-off','fa-toggle-on','fa-toggle-right','fa-toggle-up','fa-train','fa-train','fa-transgender','fa-transgender-alt','fa-trash','fa-trash-o','fa-tree','fa-trello','fa-trophy','fa-truck','fa-try','fa-tty','fa-tumblr','fa-tumblr-square','fa-turkish-lira','fa-twitch','fa-twitter-square','fa-umbrella','fa-underline','fa-undo','fa-university','fa-unlink','fa-unlock','fa-unlock-alt','fa-unsorted','fa-upload','fa-usd','fa-user','fa-user-md','fa-user-plus','fa-user-secret','fa-user-times','fa-users','fa-venus','fa-venus-double','fa-venus-mars','fa-viacoin','fa-video-camera','fa-vimeo-square','fa-vine','fa-vk','fa-volume-down','fa-volume-off','fa-volume-up','fa-warning','fa-wechat','fa-weibo','fa-weixin','fa-whatsapp','fa-wheelchair','fa-wifi','fa-windows','fa-won','fa-wordpress','fa-wrench','fa-xing','fa-xing-square','fa-yahoo','fa-yelp','fa-yen','fa-youtube','fa-youtube-play','fa-youtube-square');
                ?>
                <p class="description description-wide">
                    <label for="edit-menu-item-icon-<?php echo esc_attr($item_id); ?>">
                        <?php echo 'Font Awesome Icon Class'; ?><br />
                        <select id="edit-menu-item-icon-<?php echo esc_attr($item_id); ?>"
                                class="widefat code edit-menu-item-icon mango-chosen-select"
                            <?php if (esc_attr( $item->icon )) : ?>
                                name="menu-item-icon[<?php echo esc_attr($item_id); ?>]"
                            <?php endif; ?>
                                data-name="menu-item-icon[<?php echo esc_attr($item_id); ?>]"
                            >
                            <option value=""></option>
                            <?php
                            for($i=0;$i<count($arr_font);$i++){
                                echo '<option value="'.esc_attr($arr_font[$i]).'"';
                                if($arr_font[$i] == $item->icon)
                                    echo ' selected="selected" ';
                                echo ' >'.esc_attr($arr_font[$i]).'</option>';
                            }
                            ?>
                        </select>
                    </label>
                </p>
                <?php //if ($depth != 1) { ?>
                    <p class="description description-wide">
                        <label for="edit-menu-item-icon-<?php echo esc_attr($item_id); ?>">
                            <?php echo 'Font Awesome Icon Postion'; ?><br />
                            <select id="edit-menu-item-icon-postion-<?php echo esc_attr($item_id); ?>"
                                <?php if (esc_attr($item->icon_pos)) : ?>
                                    name="menu-item-icon_pos[<?php echo esc_attr($item_id); ?>]"
                                <?php endif; ?>
                                    data-name="menu-item-icon_pos[<?php echo esc_attr($item_id); ?>]"
                                >
								 <option value="Left" <?php if(esc_attr($item->icon_pos) == "Left"){echo 'selected="selected"';} ?>><?php echo 'Left' ?></option>
								 <option value="Right" <?php if(esc_attr($item->icon_pos) == "Right"){echo 'selected="selected"';} ?>><?php echo 'Right' ?></option>
								
                               
                            </select>
                        </label>
                    </p>
                <?php //} ?>
                <p class="description">
                    <label for="edit-menu-item-nolink-<?php echo esc_attr($item_id); ?>">
                        <input type="checkbox" id="edit-menu-item-nolink-<?php echo esc_attr($item_id); ?>" class="code edit-menu-item-custom" value="nolink"
                            <?php if ($item->nolink == 'nolink') : ?>
                                name="menu-item-nolink[<?php echo esc_attr($item_id); ?>]"
                            <?php endif; ?>
                               data-name="menu-item-nolink[<?php echo esc_attr($item_id); ?>]"
                            <?php checked( $item->nolink, 'nolink' ); ?> />
                        <?php echo "Don't link"; ?>
                    </label>
                </p>
                <p class="description">
                    <label for="edit-menu-item-hide-<?php echo esc_attr($item_id); ?>">
                        <input type="checkbox" id="edit-menu-item-hide-<?php echo esc_attr($item_id); ?>" class="code edit-menu-item-custom" value="hide"
                            <?php if ($item->hide == 'hide') : ?>
                                name="menu-item-hide[<?php echo esc_attr($item_id); ?>]"
                            <?php endif; ?>
                               data-name="menu-item-hide[<?php echo esc_attr($item_id); ?>]"
                            <?php checked( $item->hide, 'hide' ); ?> />
                        <?php echo "Don't show a link"; ?>
                    </label>
                </p>
                <p class="description">
                    <label for="edit-menu-item-mobile_hide-<?php echo esc_attr($item_id); ?>">
                        <input type="checkbox" id="edit-menu-item-mobile_hide-<?php echo esc_attr($item_id); ?>" class="code edit-menu-item-custom" value="hide"
                            <?php if ($item->mobile_hide == 'hide') : ?>
                                name="menu-item-mobile_hide[<?php echo esc_attr($item_id); ?>]"
                            <?php endif; ?>
                               data-name="menu-item-mobile_hide[<?php echo esc_attr($item_id); ?>]"
                            <?php checked( $item->mobile_hide, 'hide' ); ?> />
                        <?php echo "Don't show a link on mobile panel"; ?>
                    </label>
                </p>
                <div class="edit-menu-item-popup-<?php echo esc_attr($item_id); ?>" style="<?php if ($depth == 0) echo 'display:block;'; else echo 'display:none;' ?>">
                    <div style="clear:both;"></div>
                    <p class="description description-thin description-thin-custom">
                        <label for="edit-menu-item-type-menu-<?php echo esc_attr($item_id); ?>">
                            <?php echo 'Menu Type'; ?><br />
                            <select id="edit-menu-item-type-menu-<?php echo esc_attr($item_id); ?>"
                                <?php if (esc_attr($item->popup_type)) : ?>
                                    name="menu-item-popup_type[<?php echo esc_attr($item_id); ?>]"
                                <?php endif; ?>
                                    data-name="menu-item-popup_type[<?php echo esc_attr($item_id); ?>]"
                                >
                                <option value="" <?php if(esc_attr($item->popup_type) == ""){echo 'selected="selected"';} ?>><?php echo 'Narrow' ?></option>
                                <option value="megamenu-v1" <?php if(esc_attr($item->popup_type) == "megamenu-v1"){echo 'selected="selected"';} ?>><?php echo 'Mega Menu V1' ?></option>
                                <option value="megamenu-v2" <?php if(esc_attr($item->popup_type) == "megamenu-v2"){echo 'selected="selected"';} ?>><?php echo 'Mega Menu V2' ?></option>
                                <option value="wide" <?php if(esc_attr($item->popup_type) == "wide"){echo 'selected="selected"';} ?>><?php echo 'Wide' ?></option>
                            </select>
                        </label>
                    </p>
                    <p class="description description-thin description-thin-custom">
                        <label for="edit-menu-item-popup_pos-<?php echo esc_attr($item_id); ?>">
                            <?php echo 'Popup Position'; ?><br />
                            <select id="edit-menu-item-popup_pos-<?php echo esc_attr($item_id); ?>"
                                <?php if (esc_attr($item->popup_pos)) : ?>
                                    name="menu-item-popup_pos[<?php echo esc_attr($item_id); ?>]"
                                <?php endif; ?>
                                    data-name="menu-item-popup_pos[<?php echo esc_attr($item_id); ?>]"
                                >
                                <option value="popup_left_align" <?php if(esc_attr($item->popup_pos) == ""){echo 'selected="selected"';} ?>><?php echo 'Left' ?></option>
                                <option value="popup_right_align" <?php if(esc_attr($item->popup_pos) == "popup_right_align"){echo 'selected="selected"';} ?>><?php echo 'Right' ?></option>
                                <!--<option value="" <?php //if(esc_attr($item->popup_pos) == ""){echo 'selected="selected"';} ?>><?php //echo 'Justify (only wide)' ?></option>
                    <option value="pos-center" <?php //if(esc_attr($item->popup_pos) == "pos-center"){echo 'selected="selected"';} ?>><?php //echo 'Center (only wide)' ?></option>-->
                            </select>
                        </label>
                    </p>
                    <div style="clear:both;"></div>
                    <p class="description description-wide">
                        <label for="edit-menu-item-popup_cols-<?php echo esc_attr($item_id); ?>">
                            <br/><?php echo 'Popup Columns (only wide)'; ?><br />
                            <select id="edit-menu-item-popup_cols-<?php echo esc_attr($item_id); ?>"
                                <?php if ($item->popup_cols) : ?>
                                    name="menu-item-popup_cols[<?php echo esc_attr($item_id); ?>]"
                                <?php endif; ?>
                                    data-name="menu-item-popup_cols[<?php echo esc_attr($item_id); ?>]"
                                >
                                <option value="col-4" <?php if(esc_attr($item->popup_cols) == "col-4"){echo 'selected="selected"';} ?>><?php echo '4 Columns' ?></option>
                                <option value="col-3" <?php if(esc_attr($item->popup_cols) == "col-3"){echo 'selected="selected"';} ?>><?php echo '3 Columns' ?></option>
                                <option value="col-2" <?php if(esc_attr($item->popup_cols) == "col-2"){echo 'selected="selected"';} ?>><?php echo '2 Columns' ?></option>
                                <option value="col-5" <?php if(esc_attr($item->popup_cols) == "col-5"){echo 'selected="selected"';} ?>><?php echo '5 Columns' ?></option>
                                <option value="col-6" <?php if(esc_attr($item->popup_cols) == "col-6"){echo 'selected="selected"';} ?>><?php echo '6 Columns' ?></option>
                            </select>
                        </label>
                    </p>
                    <p class="description description-wide">
                        <label for="edit-menu-item-popup_bg_image-<?php echo esc_attr($item_id); ?>">
                            <?php echo 'Popup Background Image (only wide)'; ?><br />
                            <input type="text" id="edit-menu-item-popup_bg_image-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-popup_bg_image"
                                <?php if (esc_attr( $item->popup_bg_image )) : ?>
                                    name="menu-item-popup_bg_image[<?php echo esc_attr($item_id); ?>]"
                                <?php endif; ?>
                                   data-name="menu-item-popup_bg_image[<?php echo esc_attr($item_id); ?>]"
                                   value="<?php echo esc_attr( $item->popup_bg_image ); ?>" />
                            <br/>
                            <input class="button_upload_image button" id="edit-menu-item-popup_bg_image-<?php echo esc_attr($item_id); ?>" type="button" value="Upload Image" />&nbsp;
                            <input class="button_remove_image button" id="edit-menu-item-popup_bg_image-<?php echo esc_attr($item_id); ?>" type="button" value="Remove Image" />
                        </label>
                    </p>
                    <p class="description description-wide">
                        <label for="edit-menu-item-popup_bg_pos-<?php echo esc_attr($item_id); ?>">
                            <br/><?php echo 'Popup Background Position (only wide)'; ?><br />
                            <select id="edit-menu-item-popup_bg_pos-<?php echo esc_attr($item_id); ?>"
                                <?php if ($item->popup_bg_pos) : ?>
                                    name="menu-item-popup_bg_pos[<?php echo esc_attr($item_id); ?>]"
                                <?php endif; ?>
                                    data-name="menu-item-popup_bg_pos[<?php echo esc_attr($item_id); ?>]"
                                >
                                <option value="" <?php if(esc_attr($item->popup_bg_pos) == ""){echo 'selected="selected"';} ?>><?php echo 'Select' ?></option>
                                <option value="left top" <?php if(esc_attr($item->popup_bg_pos) == "left top"){echo 'selected="selected"';} ?>><?php echo 'Left Top' ?></option>
                                <option value="left center" <?php if(esc_attr($item->popup_bg_pos) == "left center"){echo 'selected="selected"';} ?>><?php echo 'Left Center' ?></option>
                                <option value="left center" <?php if(esc_attr($item->popup_bg_pos) == "left center"){echo 'selected="selected"';} ?>><?php echo 'Left Center' ?></option>
                                <option value="left bottom" <?php if(esc_attr($item->popup_bg_pos) == "left bottom"){echo 'selected="selected"';} ?>><?php echo 'Left Bottom' ?></option>
                                <option value="center top" <?php if(esc_attr($item->popup_bg_pos) == "center top"){echo 'selected="selected"';} ?>><?php echo 'Center Top' ?></option>
                                <option value="center center" <?php if(esc_attr($item->popup_bg_pos) == "center center"){echo 'selected="selected"';} ?>><?php echo 'Center Center' ?></option>
                                <option value="center bottom" <?php if(esc_attr($item->popup_bg_pos) == "center bottom"){echo 'selected="selected"';} ?>><?php echo 'Center Bottom' ?></option>
                                <option value="right top" <?php if(esc_attr($item->popup_bg_pos) == "right top"){echo 'selected="selected"';} ?>><?php echo 'Right Top' ?></option>
                                <option value="right center" <?php if(esc_attr($item->popup_bg_pos) == "right center"){echo 'selected="selected"';} ?>><?php echo 'Right Center' ?></option>
                                <option value="right bottom" <?php if(esc_attr($item->popup_bg_pos) == "right bottom"){echo 'selected="selected"';} ?>><?php echo 'Right Bottom' ?></option>
                                );
                            </select>
                        </label>
                    </p>
                    <p class="description description-wide">
                        <label for="edit-menu-item-popup_bg_repeat-<?php echo esc_attr($item_id); ?>">
                            <br/><?php echo 'Popup Background Repeat (only wide)'; ?><br />
                            <select id="edit-menu-item-popup_bg_repeat-<?php echo esc_attr($item_id); ?>"
                                <?php if ($item->popup_bg_repeat) : ?>
                                    name="menu-item-popup_bg_repeat[<?php echo esc_attr($item_id); ?>]"
                                <?php endif; ?>
                                    data-name="menu-item-popup_bg_repeat[<?php echo esc_attr($item_id); ?>]"
                                >
                                <option value="" <?php if(esc_attr($item->popup_bg_repeat) == ""){echo 'selected="selected"';} ?>><?php echo 'Select' ?></option>
                                <option value="no-repeat" <?php if(esc_attr($item->popup_bg_repeat) == "no-repeat"){echo 'selected="selected"';} ?>><?php echo 'No Repeat' ?></option>
                                <option value="repeat" <?php if(esc_attr($item->popup_bg_repeat) == "repeat"){echo 'selected="selected"';} ?>><?php echo 'Repeat All' ?></option>
                                <option value="repeat-x" <?php if(esc_attr($item->popup_bg_repeat) == "repeat-x"){echo 'selected="selected"';} ?>><?php echo 'Repeat Horizontally' ?></option>
                                <option value="repeat-y" <?php if(esc_attr($item->popup_bg_repeat) == "repeat-y"){echo 'selected="selected"';} ?>><?php echo 'Repeat Vertically' ?></option>
                                <option value="inherit" <?php if(esc_attr($item->popup_bg_repeat) == "inherit"){echo 'selected="selected"';} ?>><?php echo 'Inherit' ?></option>
                            </select>
                        </label>
                    </p>
                    <p class="description description-wide">
                        <label for="edit-menu-item-popup_bg_size-<?php echo esc_attr($item_id); ?>">
                            <br/><?php echo 'Popup Background Size (only wide)'; ?><br />
                            <select id="edit-menu-item-popup_bg_size-<?php echo esc_attr($item_id); ?>"
                                <?php if ($item->popup_bg_size) : ?>
                                    name="menu-item-popup_bg_size[<?php echo esc_attr($item_id); ?>]"
                                <?php endif; ?>
                                    data-name="menu-item-popup_bg_size[<?php echo esc_attr($item_id); ?>]"
                                >
                                <option value="" <?php if(esc_attr($item->popup_bg_size) == ""){echo 'selected="selected"';} ?>><?php echo 'Select' ?></option>
                                <option value="inherit" <?php if(esc_attr($item->popup_bg_size) == "inherit"){echo 'selected="selected"';} ?>><?php echo 'Inherit' ?></option>
                                <option value="cover" <?php if(esc_attr($item->popup_bg_size) == "cover"){echo 'selected="selected"';} ?>><?php echo 'Cover' ?></option>
                                <option value="contain" <?php if(esc_attr($item->popup_bg_size) == "contain"){echo 'selected="selected"';} ?>><?php echo 'Contain' ?></option>
                            </select>
                        </label>
                    </p>
                    <p class="description description-wide">
                        <label for="edit-menu-item-popup_style-<?php echo esc_attr($item_id); ?>">
                            <?php echo 'Popup Styles (only wide)'; ?><br />
                <textarea id="edit-menu-item-popup_style-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-popup_style" rows="3" cols="20"
                    <?php if (esc_html( $item->popup_style )) : ?>
                        name="menu-item-popup_style[<?php echo esc_attr($item_id); ?>]"
                    <?php endif; ?>
                          data-name="menu-item-popup_style[<?php echo esc_attr($item_id); ?>]"
                    ><?php echo esc_html( $item->popup_style ); // textarea_escaped ?></textarea>
                        </label>
                    </p>
                    <br/>
                </div>
                <div class="edit-menu-item-block-<?php echo esc_attr($item_id); ?>" style="<?php if ($depth == 1) echo 'display:block;'; else echo 'display:none;' ?>">
                    <div style="clear:both;"></div>
                    <p class="description">
                        <label for="edit-menu-item-hide_cat_image-<?php echo esc_attr($item_id); ?>">
                            <input type="checkbox" id="edit-menu-item-hide_cat_image-<?php echo esc_attr($item_id); ?>" class="code edit-menu-item-custom" value="true"
                                <?php if ($item->hide_cat_image == 'true') : ?>
                                    name="menu-item-hide_cat_image[<?php echo esc_attr($item_id); ?>]"
                                <?php endif; ?>
                                   data-name="menu-item-hide_cat_image[<?php echo esc_attr($item_id); ?>]"
                                <?php checked( $item->hide_cat_image, 'true' ); ?> />
                            <?php echo "Hide Category Image (only Mega Menu V2)"; ?>
                        </label>
                    </p>
                    <p class="description">
                        <label for="edit-menu-item-hide_subcats_list-<?php echo esc_attr($item_id); ?>">
                            <input type="checkbox" id="edit-menu-item-hide_subcats_list-<?php echo esc_attr($item_id); ?>" class="code edit-menu-item-custom" value="true"
                                <?php if ($item->hide_subcats_list == 'true') : ?>
                                    name="menu-item-hide_subcats_list[<?php echo esc_attr($item_id); ?>]"
                                <?php endif; ?>
                                   data-name="menu-item-hide_subcats_list[<?php echo esc_attr($item_id); ?>]"
                                <?php checked( $item->hide_subcats_list, 'true' ); ?> />
                            <?php echo "Hide Sub-Categories List (only Mega Menu V2)"; ?>
                        </label>
                    </p>
                    <p class="description">
                        <label for="edit-menu-item-hide_empty_subcats-<?php echo esc_attr($item_id); ?>">
                            <input type="checkbox" id="edit-menu-item-hide_empty_subcats-<?php echo esc_attr($item_id); ?>" class="code edit-menu-item-custom" value="true"
                                <?php if ($item->hide_empty_subcats == 'true') : ?>
                                    name="menu-item-hide_empty_subcats[<?php echo esc_attr($item_id); ?>]"
                                <?php endif; ?>
                                   data-name="menu-item-hide_empty_subcats[<?php echo esc_attr($item_id); ?>]"
                                <?php checked( $item->hide_empty_subcats, 'true' ); ?> />
                            <?php echo "Hide Empty Sub-Categories (only Mega Menu V2)"; ?>
                        </label>
                    </p>
                    <p class="description description-wide">
                        <label for="edit-menu-item-cols-<?php echo esc_attr($item_id); ?>">
                            <?php echo 'Columns (only wide)'; ?><br />
                            <input type="text" id="edit-menu-item-cols-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-cols"
                                <?php if (esc_attr( $item->cols )) : ?>
                                    name="menu-item-cols[<?php echo esc_attr($item_id); ?>]"
                                <?php endif; ?>
                                   data-name="menu-item-cols[<?php echo esc_attr($item_id); ?>]"
                                   value="<?php echo esc_attr( $item->cols?$item->cols:1 ); ?>" />
                            <span class="description"><?php echo 'will occupy x columns of parent popup columns' ?></span>
                        </label>
                    </p>
                    <p class="description description-wide">
                        <label for="edit-menu-item-subpopup_bg_image-<?php echo esc_attr($item_id); ?>">
                            <?php echo 'Background Image (only wide)'; ?><br />
                            <input type="text" id="edit-menu-item-subpopup_bg_image-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-subpopup_bg_image"
                                <?php if (esc_attr( $item->subpopup_bg_image )) : ?>
                                    name="menu-item-subpopup_bg_image[<?php echo esc_attr($item_id); ?>]"
                                <?php endif; ?>
                                   data-name="menu-item-subpopup_bg_image[<?php echo esc_attr($item_id); ?>]"
                                   value="<?php echo esc_attr( $item->subpopup_bg_image ); ?>" />
                            <br/>
                            <input class="button_upload_image button" id="edit-menu-item-subpopup_bg_image-<?php echo esc_attr($item_id); ?>" type="button" value="Upload Image" />&nbsp;
                            <input class="button_remove_image button" id="edit-menu-item-subpopup_bg_image-<?php echo esc_attr($item_id); ?>" type="button" value="Remove Image" />
                        </label>
                    </p>
                    <?php if( 'custom' == $item->type && $depth == 1 ) : ?>
                        <p class="description">
                            <label for="edit-menu-item-show_category_img-<?php echo esc_attr($item_id); ?>">
                                <input type="checkbox" id="edit-menu-item-show_category_img-<?php echo esc_attr($item_id); ?>" class="code edit-menu-item-custom" value="true"
                                    <?php if ($item->show_category_img == 'true') : ?>
                                        name="menu-item-show_category_img[<?php echo esc_attr($item_id); ?>]"
                                    <?php endif; ?>
                                       data-name="menu-item-show_category_img[<?php echo esc_attr($item_id); ?>]"
                                    <?php checked( $item->show_category_img, 'true' ); ?> />
                                <?php echo "show Category Images"; ?>
                            </label>
                        </p>
                    <?php endif; ?>
                    <p class="description description-wide">
                        <label for="edit-menu-item-subpopup_bg_pos-<?php echo esc_attr($item_id); ?>">
                            <br/><?php echo 'Background Position (only wide)'; ?><br />
                            <select id="edit-menu-item-subpopup_bg_pos-<?php echo esc_attr($item_id); ?>"
                                <?php if ($item->subpopup_bg_pos) : ?>
                                    name="menu-item-subpopup_bg_pos[<?php echo esc_attr($item_id); ?>]"
                                <?php endif; ?>
                                    data-name="menu-item-subpopup_bg_pos[<?php echo esc_attr($item_id); ?>]"
                                >
                                <option value="" <?php if(esc_attr($item->subpopup_bg_pos) == ""){echo 'selected="selected"';} ?>><?php echo 'Select' ?></option>
                                <option value="left top" <?php if(esc_attr($item->subpopup_bg_pos) == "left top"){echo 'selected="selected"';} ?>><?php echo 'Left Top' ?></option>
                                <option value="left center" <?php if(esc_attr($item->subpopup_bg_pos) == "left center"){echo 'selected="selected"';} ?>><?php echo 'Left Center' ?></option>
                                <option value="left center" <?php if(esc_attr($item->subpopup_bg_pos) == "left center"){echo 'selected="selected"';} ?>><?php echo 'Left Center' ?></option>
                                <option value="left bottom" <?php if(esc_attr($item->subpopup_bg_pos) == "left bottom"){echo 'selected="selected"';} ?>><?php echo 'Left Bottom' ?></option>
                                <option value="center top" <?php if(esc_attr($item->subpopup_bg_pos) == "center top"){echo 'selected="selected"';} ?>><?php echo 'Center Top' ?></option>
                                <option value="center center" <?php if(esc_attr($item->subpopup_bg_pos) == "center center"){echo 'selected="selected"';} ?>><?php echo 'Center Center' ?></option>
                                <option value="center bottom" <?php if(esc_attr($item->subpopup_bg_pos) == "center bottom"){echo 'selected="selected"';} ?>><?php echo 'Center Bottom' ?></option>
                                <option value="right top" <?php if(esc_attr($item->subpopup_bg_pos) == "right top"){echo 'selected="selected"';} ?>><?php echo 'Right Top' ?></option>
                                <option value="right center" <?php if(esc_attr($item->subpopup_bg_pos) == "right center"){echo 'selected="selected"';} ?>><?php echo 'Right Center' ?></option>
                                <option value="right bottom" <?php if(esc_attr($item->subpopup_bg_pos) == "right bottom"){echo 'selected="selected"';} ?>><?php echo 'Right Bottom' ?></option>
                                );
                            </select>
                        </label>
                    </p>
                    <p class="description description-wide">
                        <label for="edit-menu-item-subpopup_bg_repeat-<?php echo esc_attr($item_id); ?>">
                            <br/><?php echo 'Background Repeat (only wide)'; ?><br />
                            <select id="edit-menu-item-subpopup_bg_repeat-<?php echo esc_attr($item_id); ?>"
                                <?php if ($item->popup_bg_repeat) : ?>
                                    name="menu-item-subpopup_bg_repeat[<?php echo esc_attr($item_id); ?>]"
                                <?php endif; ?>
                                    data-name="menu-item-subpopup_bg_repeat[<?php echo esc_attr($item_id); ?>]"
                                >
                                <option value="" <?php if(esc_attr($item->subpopup_bg_repeat) == ""){echo 'selected="selected"';} ?>><?php echo 'Select' ?></option>
                                <option value="no-repeat" <?php if(esc_attr($item->subpopup_bg_repeat) == "no-repeat"){echo 'selected="selected"';} ?>><?php echo 'No Repeat' ?></option>
                                <option value="repeat" <?php if(esc_attr($item->subpopup_bg_repeat) == "repeat"){echo 'selected="selected"';} ?>><?php echo 'Repeat All' ?></option>
                                <option value="repeat-x" <?php if(esc_attr($item->subpopup_bg_repeat) == "repeat-x"){echo 'selected="selected"';} ?>><?php echo 'Repeat Horizontally' ?></option>
                                <option value="repeat-y" <?php if(esc_attr($item->subpopup_bg_repeat) == "repeat-y"){echo 'selected="selected"';} ?>><?php echo 'Repeat Vertically' ?></option>
                                <option value="inherit" <?php if(esc_attr($item->subpopup_bg_repeat) == "inherit"){echo 'selected="selected"';} ?>><?php echo 'Inherit' ?></option>
                            </select>
                        </label>
                    </p>
                    <p class="description description-wide">
                        <label for="edit-menu-item-subpopup_bg_size-<?php echo esc_attr($item_id); ?>">
                            <br/><?php echo 'Background Size (only wide)'; ?><br />
                            <select id="edit-menu-item-subpopup_bg_size-<?php echo esc_attr($item_id); ?>"
                                <?php if ($item->popup_bg_size) : ?>
                                    name="menu-item-subpopup_bg_size[<?php echo esc_attr($item_id); ?>]"
                                <?php endif; ?>
                                    data-name="menu-item-subpopup_bg_size[<?php echo esc_attr($item_id); ?>]"
                                >
                                <option value="" <?php if(esc_attr($item->subpopup_bg_size) == ""){echo 'selected="selected"';} ?>><?php echo 'Select' ?></option>
                                <option value="inherit" <?php if(esc_attr($item->subpopup_bg_size) == "inherit"){echo 'selected="selected"';} ?>><?php echo 'Inherit' ?></option>
                                <option value="cover" <?php if(esc_attr($item->subpopup_bg_size) == "cover"){echo 'selected="selected"';} ?>><?php echo 'Cover' ?></option>
                                <option value="contain" <?php if(esc_attr($item->subpopup_bg_size) == "contain"){echo 'selected="selected"';} ?>><?php echo 'Contain' ?></option>
                            </select>
                        </label>
                    </p>
                    <p class="description description-wide">
                        <label for="edit-menu-item-subpopup_style-<?php echo esc_attr($item_id); ?>">
                            <?php echo 'Custom Styles (only wide)'; ?><br />
                <textarea id="edit-menu-item-subpopup_style-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-popup_style" rows="3" cols="20"
                    <?php if (esc_html( $item->subpopup_style )) : ?>
                        name="menu-item-subpopup_style[<?php echo esc_attr($item_id); ?>]"
                    <?php endif; ?>
                          data-name="menu-item-subpopup_style[<?php echo esc_attr($item_id); ?>]"
                    ><?php echo esc_html( $item->subpopup_style ); // textarea_escaped ?></textarea>
                        </label>
                    </p>
                    <p class="description description-wide">
                        <label for="edit-menu-item-block-<?php echo esc_attr($item_id); ?>">
                            <?php echo 'Block Slug'; ?><br />
                            <input type="text" id="edit-menu-item-poup_block-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-block"
                                <?php if (esc_attr( $item->block )) : ?>
                                    name="menu-item-block[<?php echo esc_attr($item_id); ?>]"
                                <?php endif; ?>
                                   data-name="menu-item-block[<?php echo esc_attr($item_id); ?>]"
                                   value="<?php echo esc_attr( $item->block ); // textarea_escaped ?>"/>
                        </label>
                    </p>
                </div>
                <p class="description description-thin">
                    <label for="edit-menu-item-tip_label-<?php echo esc_attr($item_id); ?>">
                        <?php echo 'Tip Label'; ?><br />
                        <input type="text" id="edit-menu-item-tip_label-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-tip_label"
                            <?php if (esc_attr( $item->tip_label )) : ?>
                                name="menu-item-tip_label[<?php echo esc_attr($item_id); ?>]"
                            <?php endif; ?>
                               data-name="menu-item-tip_label[<?php echo esc_attr($item_id); ?>]"
                               value="<?php echo esc_attr( $item->tip_label ); ?>" />
                    </label>
                </p>
                <p class="description description-thin">
                    <label for="edit-menu-item-tip_color-<?php echo esc_attr($item_id); ?>">
                        <?php echo 'Tip Text Color'; ?><br />
                        <input type="text" id="edit-menu-item-tip_color-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-tip_color"
                            <?php if (esc_attr( $item->tip_color )) : ?>
                                name="menu-item-tip_color[<?php echo esc_attr($item_id); ?>]"
                            <?php endif; ?>
                               data-name="menu-item-tip_color[<?php echo esc_attr($item_id); ?>]"
                               value="<?php echo esc_attr( $item->tip_color ); ?>" />
                    </label>
                </p>
                <p class="description description-thin">
                    <label for="edit-menu-item-tip_bg-<?php echo esc_attr($item_id); ?>">
                        <?php echo 'Tip BG Color'; ?><br />
                        <input type="text" id="edit-menu-item-tip_bg-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-tip_bg"
                            <?php if (esc_attr( $item->tip_bg )) : ?>
                                name="menu-item-tip_bg[<?php echo esc_attr($item_id); ?>]"
                            <?php endif; ?>
                               data-name="menu-item-tip_bg[<?php echo esc_attr($item_id); ?>]"
                               value="<?php echo esc_attr( $item->tip_bg ); ?>" />
                    </label>
                </p><br/>
                <?php
                /* New fields insertion ends here */
                ?><div style="clear:both;"></div><br/>
                <p class="description description-wide">
                    <label for="edit-menu-item-attr-title-<?php echo esc_attr($item_id); ?>">
                        <?php echo 'Title Attribute'; ?><br />
                        <input type="text" id="edit-menu-item-attr-title-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-attr-title"
                            <?php if (esc_attr( $item->post_excerpt )) : ?>
                                name="menu-item-attr-title[<?php echo esc_attr($item_id); ?>]"
                            <?php endif; ?>
                               data-name="menu-item-attr-title[<?php echo esc_attr($item_id); ?>]"
                               value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
                    </label>
                </p>
                <p class="description description-thin">
                    <label for="edit-menu-item-classes-<?php echo esc_attr($item_id); ?>">
                        <?php echo 'CSS Classes (optional)'; ?><br />
                        <input type="text" id="edit-menu-item-classes-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-classes"
                            <?php if (esc_attr( implode(' ', $item->classes ) )) : ?>
                                name="menu-item-classes[<?php echo esc_attr($item_id); ?>]"
                            <?php endif; ?>
                               data-name="menu-item-classes[<?php echo esc_attr($item_id); ?>]"
                               value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
                    </label>
                </p>
                <p class="description description-thin">
                    <label for="edit-menu-item-xfn-<?php echo esc_attr($item_id); ?>">
                        <?php echo 'Link Relationship (XFN)'; ?><br />
                        <input type="text" id="edit-menu-item-xfn-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-xfn"
                            <?php if (esc_attr( $item->xfn )) : ?>
                                name="menu-item-xfn[<?php echo esc_attr($item_id); ?>]"
                            <?php endif; ?>
                               data-name="menu-item-xfn[<?php echo esc_attr($item_id); ?>]"
                               value="<?php echo esc_attr( $item->xfn ); ?>" />
                    </label>
                </p>
                <p class="description description-wide">
                    <label for="edit-menu-item-description-<?php echo esc_attr($item_id); ?>">
                        <?php echo 'Description'; ?><br />
            <textarea id="edit-menu-item-description-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-description" rows="3" cols="20"
                <?php if (esc_html( $item->description )) : ?>
                    name="menu-item-description[<?php echo esc_attr($item_id); ?>]"
                <?php endif; ?>
                      data-name="menu-item-description[<?php echo esc_attr($item_id); ?>]"
                ><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
                        <span class="description"><?php echo 'The description will be displayed in the menu if the current theme supports it.'; ?></span>
                    </label>
                </p>
                <div class="menu-item-actions description-wide submitbox">
                    <?php if( 'custom' != $item->type && $original_title !== false ) : ?>
                        <p class="link-to-original">
                            <?php printf( 'Original: %s', '<a href="' . esc_url( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
                        </p>
                    <?php endif; ?>
                    <a class="item-delete submitdelete deletion" id="delete-<?php echo esc_attr($item_id); ?>" href="<?php
                    echo wp_nonce_url(
                        add_query_arg(
                            array(
                                'action' => 'delete-menu-item',
                                'menu-item' => $item_id,
                            ),
                            remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                        ),
                        'delete-menu_item_' . $item_id
                    ); ?>"><?php echo 'Remove'; ?></a> <span class="meta-sep"> | </span> <a class="item-cancel submitcancel" id="cancel-<?php echo esc_attr($item_id); ?>" href="<?php echo esc_url( add_query_arg( array('edit-menu-item' => $item_id, 'cancel' => time()), remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) ) ) );
                    ?>#menu-item-settings-<?php echo esc_attr($item_id); ?>"><?php echo 'Cancel'; ?></a>
                </div>
                <input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr($item_id); ?>" />
                <input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
                <input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
                <input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
                <input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
                <input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
            </div><!-- .menu-item-settings-->
            <ul class="menu-item-transport"></ul>
        </li>
        <?php
        $output .= ob_get_clean();
    }
}
/* Top Navigation Menu */
if (!class_exists('mango_top_navwalker')) {
    class mango_top_navwalker extends Walker_Nav_Menu {
        var $megamenu_v1 = false;
        var $block_post = false;
        var $megamenu_v2 = false;
        var $show_category_img = false;
        var $widemenu = false;
        var $megamenu_v1_arr = array( 'count' => 1 );
        var $widemenu_arr = array( 'count' => 1 );
        var $megamenu_v2_arr = array( );
        var $iteration = '';
		var $wide_menu=false;
        // add classes to ul sub menus
        function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
           
            $menutype = $element->popup_type;
            if($depth == 0){
                $this->megamenu_v1_arr = array( 'count' => 1);
                $this->iteration = '';
                if($menutype == 'megamenu-v1'){
                    $this->megamenu_v1 = true;
                    $this->megamenu_v2 = false;
                    $this->widemenu = false;
                }else if($menutype == 'megamenu-v2'){
                    $this->megamenu_v2 = true;
                    $this->megamenu_v1 = false;
                    $this->widemenu = false;
                }else if($menutype == 'wide'){
                    $this->widemenu = true;
                    $this->megamenu_v1 = false;
                    $this->megamenu_v2 = false;
                }else{
                    $this->megamenu_v1 = false;
                    $this->megamenu_v2 = false;
                    $this->widemenu = false;
                }
            }

            if( $this->megamenu_v1 || $menutype == 'wide' ){
                if( $depth == 0 ){
                    $count = 0;
                    foreach( $children_elements[$element->ID] as $key => $val ){
                        if( ! $val->block ){
                            $count++;
                        }
                    }
                    if( $this->megamenu_v1 ){
                        $this->megamenu_v1_arr['total_child'] = $count;
                        $this->megamenu_v1_arr['megamenu_childrens'] = $children_elements[$element->ID];
                        $this->megamenu_v1_arr['parent_id'] = $element->ID;
                    }else{
                        $this->widemenu_arr['total_child'] = $count;
                        $this->widemenu_arr['widemenu_childrens'] = $children_elements[$element->ID];
                        $this->widemenu_arr['parent_id'] = $element->ID;
                    }
                }
                if( $depth == 1 ){
                   
                    if( $this->megamenu_v1 ){
                        $children_elements[$this->megamenu_v1_arr['parent_id']][$this->megamenu_v1_arr['count'] - 1]->iteration = $this->megamenu_v1_arr['count'];
                        $this->megamenu_v1_arr['count'] += 1;
                    }else{
                        $children_elements[$this->widemenu_arr['parent_id']][$this->widemenu_arr['count'] - 1]->iteration = $this->widemenu_arr['count'];
                        $this->widemenu_arr['count'] += 1;
                    }
                }
            }
            $id_field = $this->db_fields['id'];
            if ( is_object( $args[0] ) ) {
                $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
            }
            return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
        }
        // add megamenu class to ul sub-menus
        function start_lvl( &$output, $depth = 0, $args = array() ) {
            $indent = str_repeat("\t", $depth);
            $out_div = '';
            if ( $depth == 0 ) {
                $out_div = '';
            } else {
                $out_div = '';
            }
            if( $depth == 1 && $this->megamenu_v1 ){
                $output .= "\n$indent$out_div<ul class=\"megamenu-list\">\n";
            } else if( $depth == 0 && $this->megamenu_v2 ){
                $output .= "\n$indent$out_div";
            }else if($depth == 1 && $this->show_category_img){
                $output .= "\n$indent$out_div<ul class=\"megamenu-list\">\n".$this->show_category_img;
            }else if($depth == 0 && $this->megamenu_v1){
                $output .= "\n$indent$out_div";
            }else{
                $output .= "\n$indent$out_div<ul class=\"sub-menu\">\n";
            }
        }
        function end_lvl( &$output, $depth = 0, $args = array() ) {
            $indent = str_repeat("\t", $depth);
            if ( $depth == 0 ) {
                $out_div = '';
            } else {
                $out_div = '';
            }
            if( $depth == 0 && $this->megamenu_v2 ){
                $output .= "\n$indent$out_div";
            }else if($depth == 1 && $this->show_category_img){
                $output .= "$indent</ul>$out_div\n";
            }else if($depth == 0 && $this->megamenu_v1){
                $output .= "\n$indent$out_div";
            }else{
                $output .= "$indent</ul>$out_div\n";
            }
        }
        // add main/sub classes to li's and links
        function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
            global $wp_query;
            
            $sub = "";
            $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
            if ( $depth == 0 && $args->has_children )
                $sub = ' has-sub';
            if ( $depth == 1 && $args->has_children )
                $sub = ' sub';
            $active = "";
            // depth dependent classes
            if ( $item->current || $item->current_item_ancestor || $item->current_item_parent )
                $active = 'active';
            // passed classes
            $classes = empty( $item->classes ) ? array() : (array)$item->classes;
            $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
            // menu type, type, column class, popup style
            $menu_type = "";
            $popup_pos = "";
            $popup_cols = "";
            $popup_style = "";
            $cols = 1;
            if($depth == 0){
                $menutype = $item->popup_type;
                if($menutype == 'megamenu-v1'){
                    $this->megamenu_v1 = true;
                    $this->megamenu_v1_arr['megamenu_info'] = $item;
                }else if($menutype == 'megamenu-v2'){
                    $this->megamenu_v2 = true;
                    $this->megamenu_v2_arr['megamenu_info'] = $item;
                }else if($menutype == 'wide'){
					
                    $this->widemenu_arr['widemenu_info'] = $item;
                }else{
                    $this->megamenu_v1 = false;
                    $this->megamenu_v2 = false;
                }
            }
            if( empty( $item_output ) ){
                $item_output = $args->before;
            }
            if ($depth == 0) {
                $popup_cols = " ". $item->popup_cols;
                $menutype = $item->popup_type;
                if ( $menutype == "wide" || $this->megamenu_v1 ) {
                    $menu_type = " wide";
                    $popup_bg_image = $item->popup_bg_image ? 'background-image:url('.str_replace(array('http://', 'https://'), array('//', '//'), $item->popup_bg_image).');' : '';
                    $popup_bg_pos = $item->popup_bg_pos ? ';background-position:'.$item->popup_bg_pos.';' : '';
                    $popup_bg_repeat = $item->popup_bg_repeat ? ';background-repeat:'.$item->popup_bg_repeat.';' : '';
                    $popup_bg_size = $item->popup_bg_size ? ';background-size:'.$item->popup_bg_size.';' : '';
                    $popup_style = str_replace('"', '\'', $item->popup_style . $popup_bg_image . $popup_bg_pos . $popup_bg_repeat . $popup_bg_size);
                }else {
                    $menu_type = " narrow";
                }
                $popup_pos = " ". $item->popup_pos;
                if ( $this->megamenu_v2 || $this->widemenu ){
                    $class_names .= ' megamenu-container ';
                }
            }
            // build html
            if ($depth == 1) {
                $menutype = $item->popup_type;
                $sub_popup_style = '';
                if ($item->subpopup_style || $item->subpopup_bg_image || $item->subpopup_bg_pos || $item->subpopup_bg_repeat || $item->subpopup_bg_size) {
                    if(!$item->show_category_img){
                        $sub_popup_image = $item->subpopup_bg_image ? 'background-image:url('.str_replace(array('http://', 'https://'), array('//', '//'), $item->subpopup_bg_image).');' : '';
                        $sub_popup_pos = $item->subpopup_bg_pos ? ';background-position:'.$item->subpopup_bg_pos.';' : '';;
                        $sub_popup_repeat = $item->subpopup_bg_repeat ? ';background-repeat:'.$item->subpopup_bg_repeat.';' : '';;
                        $sub_popup_size = $item->subpopup_bg_size ? ';background-size:'.$item->subpopup_bg_size.';' : '';;
                        $sub_popup_style = ' style="'.str_replace('"', '\'', $item->subpopup_style).$sub_popup_image.$sub_popup_pos.$sub_popup_repeat.$sub_popup_size.'"';
                    }else{
                        $this->show_category_img = true;
                    }
                }
                if ( $item->cols > 1 ) {
                    $cols = (int)$item->cols;
                }
                if ( $item->block )
                    $class_names .= ' menu-block-item ';
                /* @todo - ahsan */
                // depth 1
                if ( $this->megamenu_v1 ){
                    $total =  $this->megamenu_v1_arr['total_child'];
                    $iteration = $item->iteration;
                    if( $iteration == 1){
                        $output .= '<div class="megamenu-col" '.$sub_popup_style.'>';
                    }
                    if( $item->block ){
                        $this->block_post = true;
                        $output .= '</div></div><div class="megamenu-footer clearfix">';
                    }else{
                        $output .= '<div class="megamenu-col-section">';
                    }
                }else if ( $this->megamenu_v2 ){
                    if( ! $item->block ){
                        $megamenu_v2_info_popup_cols = $this->megamenu_v2_arr['megamenu_info']->popup_cols;
                        if( $megamenu_v2_info_popup_cols == 'col-2'){
                            $class_names .= ' col-md-6 ';
                        }else if( $megamenu_v2_info_popup_cols == 'col-3'){
                            $class_names .= ' col-md-4 ';
                        }else if( $megamenu_v2_info_popup_cols == 'col-4'){
                            $class_names .= ' col-md-3 ';
                        }else if( $megamenu_v2_info_popup_cols == 'col-5'){
                            $class_names .= ' col-md-5col ';
                        }else if( $megamenu_v2_info_popup_cols == 'col-6'){
                            $class_names .= ' col-md-2 ';
                        }
                    }
                    if( $item->block ){
                        $class_names .= ' megamenu-footer clearfix ';
                    }
                }/*else if( isset($this->widemenu_arr['widemenu_info']->popup_type) && $this->widemenu_arr['widemenu_info']->popup_type == 'wide' ){
                    $total_child = $this->widemenu_arr['total_child'];
                    if($total_child == 2){
                        $class_names .= ' col-md-6 ';
                    }else if($total_child == 3){
                        $class_names .= ' col-md-4 ';
                    }else if($total_child == 4){
                        $class_names .= ' col-md-3 ';
                    }else if($total_child == 5){
                        $class_names .= ' col-md-5col ';
                    }else if($total_child == 6){
                        $class_names .= ' col-md-2 ';
                    }else{
                        $class_names .= ' col-md-5col ';
                    }
                }*/
				else if ( $this->widemenu){
                    if( ! $item->block ){
                        $widemenu_info_popup_cols =  $this->widemenu_arr['widemenu_info']->popup_cols;
                        if( $widemenu_info_popup_cols == 'col-2'){
                            $class_names .= ' col-md-6 ';
                        }else if( $widemenu_info_popup_cols == 'col-3'){
                            $class_names .= ' col-md-4 ';
                        }else if( $widemenu_info_popup_cols == 'col-4'){
                            $class_names .= ' col-md-3 ';
                        }else if( $widemenu_info_popup_cols == 'col-5'){
                            $class_names .= ' col-md-5col ';
                        }else if( $widemenu_info_popup_cols == 'col-6'){
                            $class_names .= ' col-md-2 ';
                        }
                    }
                    if( $item->block ){
                        $class_names .= ' megamenu-footer clearfix ';
                    }
                }
                /* end */
                if( ! $this->megamenu_v1 && ! $this->megamenu_v2 ){
                    $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $class_names . ' ' . $active . $sub . $menu_type . $popup_pos . $popup_cols . '" data-cols="'.$cols.'"'.$sub_popup_style.'>';
                }
                if( $this->megamenu_v2 ){
                    if( $item->block ){
                        $this->block_post = true;
                        $output .= '</div>';
                    }
                    $output .= $indent . '<div id="nav-menu-item-'. $item->ID . '" class="' . $class_names . ' ' . $active . $sub . $menu_type . $popup_pos . $popup_cols . '" data-cols="'.$cols.'"'.$sub_popup_style.'>';
                }
				
				if( $this->widemenu ){
                    if( $item->block ){
                        $this->block_post = true;
                        $output .= '</div>';
                    }
                    $output .= $indent . '<div id="nav-menu-item-'. $item->ID . '" class="' . $class_names . ' ' . $active . $sub . $menu_type . $popup_pos . $popup_cols . '" data-cols="'.$cols.'"'.$sub_popup_style.'>';
                }
            } else {
                $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $class_names . ' ' . $active . $sub . $menu_type . $popup_pos . $popup_cols . '">';
				//$output .= $indent . '<div id="nav-menu-item-'. $item->ID . '" class="' . $class_names . ' ' . $active . $sub . $menu_type . //$popup_pos . $popup_cols . '" data-cols="'.$cols.'"'.$sub_popup_style.'>';
            }
            $current_a = "";
            // link attributes
            $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
            $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
            $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
            $attributes .= ! empty( $item->url )        ? ' href="'   . esc_url( $item->url        ) .'"' : '';
            if ( ( $item->current && $depth == 0 ) ||  ( $item->current_item_ancestor && $depth == 0 ) )
                $current_a .= ' current ';
			$r_cls = '';
            if($item->icon_pos != 'Left'){
                $r_cls = 'mango_alignright_font';
            }
            $attributes .= ' class="'. $current_a . $r_cls. '"';
            if( $depth == 1 && $this->megamenu_v2 ){
                if ($item->tip_label) {
                    $item_style = '';
                    if ($item->tip_color) {
                        $item_style .= 'color:'.$item->tip_color.';';
                    }
                    if ($item->tip_bg) {
                        $item_style .= 'background:'.$item->tip_bg.';';
                    }
                    $item_output .= '<span class="label rotated" style="'.$item_style.'">'.$item->tip_label.'</span>';
                }
                if( $item->type == 'taxonomy' && $item->object == 'product_cat' ){
                    if( ! $item->hide_cat_image ){
                        $thumbnail_id = get_woocommerce_term_meta( $item->object_id, 'thumbnail_id', true );
                        $image = wp_get_attachment_url( $thumbnail_id );
                        $item_output .= '<figure><a href="' . esc_url( $item->url ) . '"><img class="m_auto" src="'.esc_url($image).'" alt="" /></a></figure>';
                    }
                }elseif($item->type == 'taxonomy' && $item->object == 'category'){
                    $image = get_option('mango_taxonomy_image'.$item->object_id);
                    $item_output .= '<figure><a href="' . esc_url( $item->url ) . '"><img class="m_auto" src="'.esc_url($image).'" alt="" /></a></figure>';
                }elseif($item->show_category_img){
                    $image = str_replace(array('http://', 'https://'), array('//', '//'), $item->subpopup_bg_image);
                    $item_output .= '<figure><a href="' . esc_url( $item->url ) . '"><img class="m_auto" src="'.esc_url($image).'" alt="" /></a></figure>';
                }
                if ( $item->hide == "" && ! $item->block) {
                    if ( $item->nolink == "" ) {
                        $item_output .= '<a'. $attributes .'>';
                    } else{
                        $item_output .= '<div class="megamenu-title"><span>';
                    }
                    $item_output .= $args->link_before . ( $item->icon_pos == 'Right' ? ($item->icon != 'select' ? '<i class="fa fa-' . str_replace('fa-', '', $item->icon) . '"></i>' : '') . apply_filters( 'the_title', $item->title, $item->ID ) : apply_filters( 'the_title', $item->title, $item->ID ) . ($item->icon != 'select'  ? '<i class="fa fa-' . str_replace('fa-', '', $item->icon) . '"></i>' : '') );
                    $item_output .= $args->link_after;
                    if ( $item->nolink == "" ) {
                        $item_output .= '</a>';
                    } else {
                        $item_output .= '</span></div>';
                    }
                }
                if( $item->type == 'taxonomy' ){
                    if( ! $item->hide_subcats_list ){
                        $args_ = array(
                            'hierarchical' => 1,
                            'show_option_none' => '',
                            'hide_empty' => $item->hide_empty_subcats,
                            'parent' => $item->object_id,
                            'taxonomy' => $item->object
                        );
                        $subcats = get_categories( $args_ );
                        $item_output .= '<ul class="megamenu-list">';
                        foreach ($subcats as $sc) {
                            $link = get_term_link( $sc->slug, $sc->taxonomy );
                            $item_output .= '<li><a href="'. esc_url( $link ) .'"><i class="fa fa-angle-right"></i> '.$sc->name.'</a></li>';
                        }
                        $item_output .= '</ul>';
                        wp_reset_postdata();
                    }
                }
            }else{
                if ( $item->hide == "" && ! $item->block ) {
                    if ( $item->nolink == "" ) {
                        $item_output .= '<a'. $attributes .'>';
                    } else{
                        $item_output .= '<div class="megamenu-title"><span>';
                    }
                    $item_output .= $args->link_before .( $item->icon_pos == 'Left' ? ($item->icon != 'select'  ? '<i class="fa fa-' . str_replace('fa-', '', $item->icon) . '"></i>' : '') . apply_filters( 'the_title', $item->title, $item->ID ) : apply_filters( 'the_title', $item->title, $item->ID ) . ($item->icon != 'select'  ? '<i class="fa fa-' . str_replace('fa-', '', $item->icon) . '"></i>' : '') );
                    $item_output .= $args->link_after;
                    if ($item->tip_label) {
                        $item_style = '';
                        $item_arrow_style = '';
                        if ($item->tip_color) {
                            $item_style .= 'color:'.$item->tip_color.';';
                        }
                        if ($item->tip_bg) {
                            $item_style .= 'background:'.$item->tip_bg.';';
                            $item_arrow_style .= 'border-top-color:'.$item->tip_bg.';';
                            $item_arrow_style .= 'color:'.$item->tip_bg.';';
                            $item_arrow_style .= 'border-color:'.$item->tip_bg.'  transparent transparent transparent;';
                        }
                        $item_output .= '<span class="tip" style="'.$item_style.'"><span class="tip-arrow" style="'.$item_arrow_style.'"></span>'.$item->tip_label.'</span>';
                    }
                    if ( $item->nolink == "" ) {
                        $item_output .= '</a>';
                    } else {
                        $item_output .= '</span></div>';
                    }
                }
            }
            if ( $item->block ){
                $output .= do_shortcode('[mango_block name="'.$item->block.'"]');
            }
            $item_output .= $args->after;
            //$args->popup_style = $popup_style;
            if($depth == 0){
                if( $this->megamenu_v1 ){
                    //echo "<pre>"; print_r($item); echo "</pre>";
                    $item_output .= '<div class="megamenu megamenu-half megamenu-v1">';
                    $item_output .= '<div class="megamenu-wrapper" style="'.$popup_style.'">';
                    $item_output .= '<div class="row">';
                }else if ( $this->megamenu_v2 || $menutype == 'wide' ){
                    $item_output .= '<div class="megamenu '.$menutype.'">';
                    $item_output .= '<div class="row">';
                }
            }
            // build html
            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        }
        function has_next($array) {
            if (is_array($array)) {
                if (next($array) === false) {
                    return false;
                } else {
                    return true;
                }
            } else {
                return false;
            }
        }
        function end_el( &$output, $item, $depth = 0, $args = array() ) {
            if($depth == 0){
                $menutype = $item->popup_type;
                if($menutype == 'megamenu-v1'){
                    $this->megamenu_v1 = true;
                }else if($menutype == 'megamenu-v2'){
                    $this->megamenu_v2 = true;
                }
            }
            if( empty( $item_output) ){
                $item_output = $args->before;
            }
            if ($depth == 0) {
                if( $this->megamenu_v1 ){
                    if($this->block_post){
                        $item_output .= '</div>';
                        $this->block_post = false;
                    }else{
                        $item_output .= '</div></div></div>';
                    }
                }else if ( $this->megamenu_v2 ){
                    if($this->block_post){
                        $item_output .= '</div>';
                        $this->block_post = false;
                    }else{
                        $item_output .= '</div></div>';
                    }
                }
            }
            if($depth == 1){
                if ( $this->megamenu_v1 ){
                    $total =  $this->megamenu_v1_arr['total_child'];
                    $iteration = $item->iteration;
                    $output .= '</div>';
                    //$columns = $this->megamenu_v1_arr['megamenu_info']->popup_cols;
                    //$columns = str_replace('col-','',$columns);
                    $columns = 2;
                    $ceil = ceil( $total / $columns ); //7/2 = 4
                    if( $total == $iteration ){
                        //$output .= "<span>last iteration: $iteration</span>";
                        $output .= '</div>';
                    }else if( $iteration == $ceil ){
                        $megamenu_childrens = $this->megamenu_v1_arr['megamenu_childrens'];
                        $item = next($megamenu_childrens);
                        if( $this->has_next($megamenu_childrens) ){
                            $item = next($megamenu_childrens);
                        }
                        $sub_popup_style = '';
                        if ($item->subpopup_style || $item->subpopup_bg_image || $item->subpopup_bg_pos || $item->subpopup_bg_repeat || $item->subpopup_bg_size) {
                            $sub_popup_image = $item->subpopup_bg_image ? 'background-image:url('.str_replace(array('http://', 'https://'), array('//', '//'), $item->subpopup_bg_image).');' : '';
                            $sub_popup_pos = $item->subpopup_bg_pos ? ';background-position:'.$item->subpopup_bg_pos.';' : '';;
                            $sub_popup_repeat = $item->subpopup_bg_repeat ? ';background-repeat:'.$item->subpopup_bg_repeat.';' : '';;
                            $sub_popup_size = $item->subpopup_bg_size ? ';background-size:'.$item->subpopup_bg_size.';' : '';;
                            $sub_popup_style = ' style="'.str_replace('"', '\'', $item->subpopup_style).$sub_popup_image.$sub_popup_pos.$sub_popup_repeat.$sub_popup_size.'"';
                        }
                        //$output .= "<span>close $iteration</span>";
                        $output .= '</div><div class="megamenu-col" '.$sub_popup_style.'>';
                    }
                }else if( $this->megamenu_v2 ){
                    $output .= '</div>';
                }
            }
            // build html
            $output .= apply_filters( 'walker_nav_menu_end_el', $item_output, $item, $depth, $args );
        }
    }
}
if (!class_exists('mango_top_navwalker_mobile')) {
    class mango_top_navwalker_mobile extends Walker_Nav_Menu {
		function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output )
		{
			$id_field = $this->db_fields['id'];
			if ( is_object( $args[0] ) ) {
				$args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
			}
			return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		}
		function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			if($item->mobile_hide == ''){
				$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
				$classes = empty( $item->classes ) ? array() : (array) $item->classes;			
				$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
				$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
				$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
				$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
				$output .= $indent . '<li' . $id . $class_names .'>';
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
				$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
				$item_output .= '</a>';
				$item_output .= $args->after;
				$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );	
			}
		}
		function end_el( &$output, $item, $depth = 0, $args = array() ) {
			if($item->mobile_hide == ''){
				$output .= '</li>';
			}
		}
	}
}
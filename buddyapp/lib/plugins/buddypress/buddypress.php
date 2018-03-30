<?php
/**
 * @package WordPress
 * @subpackage KLEO
 * @author SeventhQueen <themesupport@seventhqueen.com>
 * @since 1.6
 */


/* Remove BuddyPress loaded style */
add_action( 'wp_enqueue_scripts', 'kleo_bp_dequeue' );

function kleo_bp_dequeue() {
    wp_dequeue_style( 'bp-legacy-css' );
    wp_deregister_style( 'bp-legacy-css' );
}

add_action( 'body_class', 'kleo_bp_classes' );

function kleo_bp_classes( $classes ) {
    if ( ! bp_is_directory() && ( bp_is_group() || ( bp_is_user() && ! bp_is_single_activity()) ) ) {
        $classes[] = 'bp-is-single';
    }
    if (bp_is_current_component( 'buddydrive' )) {
        $classes[] = 'buddydrive';
    }

    return $classes;
}


/***************************************************
:: Online users functionality
 ***************************************************/

add_filter( 'kleo_theme_settings', 'kleo_bp_online_settings' );

function kleo_bp_online_settings( $kleo )
{
    //
    // Settings Sections
    //

    $kleo['panels']['kleo_panel_bp'] = array(
        'title' => esc_html__( 'BuddyPress', 'buddyapp' ),
        'priority' => 16
    );

    $kleo['sec']['kleo_section_bp'] = array(
        'title' => esc_html__( 'General Settings', 'buddyapp' ),
        'panel' => 'kleo_panel_bp',
        'priority' => 16
    );

    $kleo['sec']['kleo_section_bp_styling'] = array(
        'title' => esc_html__( 'Profile side-menu styling', 'buddyapp' ),
        'panel' => 'kleo_panel_bp',
        'priority' => 17
    );

    // Buddy Side-menu
    foreach (Kleo::get_config('styling_variables') as $slug => $name) {

        $kleo['set'][] = array(
            'id' => 'bp_side_main_style_' . str_replace('-', '_', $slug),
            'title' => 'Buddypress Menu ' . $name,
            'type' => 'color',
            'default' => '',
            'section' => 'kleo_section_bp_styling',
            'customizer' => true,
            'transport' => 'refresh'
        );

    }

    $kleo['set'][] = array(
        'id' => 'bp_online_status',
        'title' => esc_html__('Enable members online status', 'buddyapp'),
        'type' => 'switch',
        'default' => '1',
        'section' => 'kleo_section_bp',
        'description' => esc_html__('A graphical representation next to member avatar if a member is online.', 'buddyapp'),
        'customizer' => true,
        'transport' => 'refresh'
    );


    return $kleo;

}


add_filter( 'kleo_get_dynamic_variables', 'kleo_bp_dynamic_variables' );
function kleo_bp_dynamic_variables( $variables ) {

    foreach (Kleo::get_config('styling_variables') as $slug => $name) {

        if (sq_option('bp_side_main_style_' . str_replace('-', '_', $slug))) {
            $variables['bp-side-main-' . $slug] = sq_option('bp_side_main_style_' . str_replace('-', '_', $slug));
        }
    }

    return $variables;
}


/* Load our Less file */
add_filter('kleo_less_files', 'kleo_bp_add_less_file');

function kleo_bp_add_less_file( $less_files ) {
    if (! defined('LOCAL_DEVELOPMENT') ) {
        $less_files[THEME_DIR . "/buddypress/css/dynamic/buddypress.less"] = '';
    }

    return $less_files;
}

/* Regenerate theme css on plugin activate/deactivate */
function kleo_bp_detect_plugin_change( $plugin, $network_activation ) {
    if ( $plugin == 'buddypress/bp-loader.php' ) {
        kleo_unlink_dynamic_css();
    }
}
add_action( 'activated_plugin', 'kleo_bp_detect_plugin_change', 10, 2 );
add_action( 'deactivated_plugin', 'kleo_bp_detect_plugin_change', 10, 2 );



/* Get User online */
if ( ! function_exists( 'kleo_is_user_online' ) ):
    /**
     * Check if a Buddypress member is online or not
     * @global object $wpdb
     * @param integer $user_id
     * @param integer $time
     * @return boolean
     */
    function kleo_is_user_online( $user_id, $time = 5 )
    {
        global $wpdb;
        $sql = $wpdb->prepare( "SELECT u.user_login FROM $wpdb->users u JOIN $wpdb->usermeta um ON um.user_id = u.ID
			WHERE u.ID = %d
			AND um.meta_key = 'last_activity'
			AND DATE_ADD( um.meta_value, INTERVAL %d MINUTE ) >= UTC_TIMESTAMP()", $user_id, $time);
        $user_login = $wpdb->get_var( $sql );
        if( isset( $user_login ) && $user_login != "" ) {
            return true;
        }
        else { return false; }
    }
endif;


if ( ! function_exists( 'kleo_get_online_status' ) ):
    function kleo_get_online_status( $user_id ) {
        $output = '';
        if ( kleo_is_user_online( $user_id ) ) {
            $output .= '<span class="kleo-online-status user-online"></span>';
        } else {
            $output .= '<span class="kleo-online-status"></span>';
        }
        return $output;
    }
endif;


/**
 * Render the html to show if a user is online or not
 */
if( ! function_exists( 'kleo_online_status' ) ) {
    function kleo_online_status( $user_id ) {
        echo kleo_get_online_status( $user_id );
    }
}

if ( sq_option( 'bp_online_status', 1 ) == 1 ) {
    add_action( 'bp_member_online_status', 'kleo_online_status' );
}



/***************************************************
:: Catch AJAX requests
 ***************************************************/

add_action( 'wp_ajax_kleo_bp_ajax_call', 'kleo_bp_ajax_call' );

function kleo_bp_ajax_call() {

    $response = array();
    $response = apply_filters( 'kleo_bp_ajax_call', $response );

    if ( ! empty( $response ) ) {
        echo json_encode( $response );
    }
    exit;
}



/***************************************************
:: Menu Notifications
 ***************************************************/

if ( bp_is_active('notifications') ) {
    require_once( KLEO_LIB_DIR . '/plugins/buddypress/menu-notifications.php' );
}


/***************************************************
:: Menu Messages
 ***************************************************/

if ( bp_is_active('messages') ) {
    require_once( KLEO_LIB_DIR . '/plugins/buddypress/menu-messages.php' );
}


/***************************************************
:: Navigation icons
 ***************************************************/

require_once( KLEO_LIB_DIR . '/plugins/buddypress/navigation-icons.php' );



/***************************************************
:: BuddyPress Cover Photo
 ***************************************************/

require_once( KLEO_LIB_DIR . '/plugins/buddypress/cover-photo.php' );



/* Fallback functions */
if ( ! function_exists( 'kleo_bp_get_member_cover_attr' ) ) {
    function kleo_bp_get_member_cover_attr() {
        return 'class="item-cover"';
    }
}

if ( ! function_exists( 'kleo_bp_get_group_cover_attr' ) ) {
    function kleo_bp_get_group_cover_attr() {
        return 'class="item-cover"';
    }
}



/***************************************************
:: Member Types
 ***************************************************/

add_action( 'bp_members_directory_member_types', 'kleo_bp_member_types_tabs' );
function kleo_bp_member_types_tabs() {
    if( ! bp_get_current_member_type() ){
        $member_types = bp_get_member_types( array(), 'objects' );
        if( $member_types ) {
            foreach ( $member_types as $member_type ) {
                if ( $member_type->has_directory == 1 ) {
                    echo '<li id="members-' . esc_attr($member_type->name) . '" class="bp-member-type-filter">';
                    echo '<a href="' . bp_get_members_directory_permalink() . 'type/' . $member_type->directory_slug . '/">' . sprintf('%s <span>%d</span>', $member_type->labels['name'], kleo_bp_count_member_types($member_type->name)) . '</a>';
                    echo '</li>';
                }
            }
        }
    }
}



add_filter( 'bp_modify_page_title', 'kleo_bp_members_type_directory_page_title', 9, 4 );
function kleo_bp_members_type_directory_page_title( $title, $original_title, $sep, $seplocation  ) {
    $member_type= bp_get_current_member_type();
    if( bp_is_directory() && $member_type ){
        $member_type = bp_get_member_type_object( $member_type );
        if( $member_type ) {
            global $post;
            $post->post_title = $member_type->labels['name'];
            $title = $member_type->labels['name'] . " " . $sep . " " . $original_title;
        }
    }
    return $title;
}



add_filter( 'bp_get_total_member_count', 'kleo_bp_get_total_member_count_member_type' );
function kleo_bp_get_total_member_count_member_type(){
    $count = bp_core_get_active_member_count();
    $member_type = bp_get_current_member_type();
    if( bp_is_directory() && $member_type ){
        $count = kleo_bp_count_member_types( $member_type );
    }
    return $count;
}



add_filter( 'bp_get_total_friend_count', 'kleo_bp_get_total_friend_count_member_type' );
function kleo_bp_get_total_friend_count_member_type(){
    $user_id = get_current_user_id();
    $count = friends_get_total_friend_count( $user_id );
    $member_type = bp_get_current_member_type();
    if( bp_is_directory() && $member_type ){
        global $bp, $wpdb;
        $friends =  $wpdb->get_results("SELECT count(1) as count FROM {$bp->friends->table_name} bpf
        LEFT JOIN {$wpdb->term_relationships} tr ON (bpf.initiator_user_id = tr.object_id || bpf.friend_user_id = tr.object_id )
        LEFT JOIN {$wpdb->terms} t ON t.term_id = tr.term_taxonomy_id
        WHERE t.slug = '" . $member_type . "' AND (bpf.initiator_user_id = $user_id || bpf.friend_user_id = $user_id ) AND tr.object_id != $user_id AND bpf.is_confirmed = 1", ARRAY_A);
        $count = 0;
        if( isset( $friends['0']['count'] ) && is_numeric( $friends['0']['count'] ) ){
            $count = $friends['0']['count'];
        }
    }
    return $count;
}



function kleo_bp_count_member_types( $member_type = '' ) {
    if ( ! bp_is_root_blog() ) {
        switch_to_blog( bp_get_root_blog_id() );
    }
    global $wpdb;
    $sql = array(
        'select' => "SELECT t.slug, tt.count FROM {$wpdb->term_taxonomy} tt LEFT JOIN {$wpdb->terms} t",
        'on'     => 'ON tt.term_id = t.term_id',
        'where'  => $wpdb->prepare( 'WHERE tt.taxonomy = %s', 'bp_member_type' ),
    );
    $members_count = $wpdb->get_results( join( ' ', $sql ) );
    $members_count = wp_filter_object_list( $members_count, array( 'slug' => $member_type ), 'and', 'count' );
    $members_count = array_values( $members_count );
    if( isset( $members_count[0] ) && is_numeric( $members_count[0] ) ) {
        $members_count = $members_count[0];
    }else{
        $members_count = 0;
    }
    restore_current_blog();
    return $members_count;
}



add_filter( 'bp_before_has_members_parse_args', 'kleo_bp_set_has_members_type_arg', 10, 1 );
function kleo_bp_set_has_members_type_arg( $args ) {
    $member_type = bp_get_current_member_type();
    $member_types = bp_get_member_types(array(), 'names');
    if ( isset( $args['scope'] ) && !isset( $args['member_type'] ) && in_array( $args['scope'], $member_types ) ) {
        if( $member_type ) {
            unset( $args['scope'] );
        }else{
            $args['member_type'] = $args['scope'];
        }
    }
    return $args;
}



/* Template functions */

add_action( 'bp_before_member_body','kleo_bp_member_title', 1 );
add_action( 'bp_before_group_body','kleo_bp_group_title', 1 );

function kleo_bp_member_title() {
?>
    <div class="bp-title-section">
        <h1 class="bp-page-title"><?php echo kleo_bp_get_member_page_title() ;?></h1>
        <?php kleo_breadcrumb( array( 'container' => 'ol', 'separator' => '', 'show_browse' => false ) ); ?>
    </div>
<?php
}

function kleo_bp_group_title() {
?>
    <div class="bp-title-section">
        <h1 class="bp-page-title"><?php echo kleo_bp_get_group_page_title();?></h1>
        <?php kleo_breadcrumb( array( 'container' => 'ol', 'separator' => '', 'show_browse' => false ) ); ?>
    </div>
<?php
}



add_action( 'wp', 'sq_bp_check_page_template' );

function sq_bp_check_page_template() {
    if ( bp_is_register_page() || bp_is_activation_page()) {
        /* remove admin bar */
        remove_action( 'wp_footer', 'wp_admin_bar_render', 1000 );
        add_filter( 'show_admin_bar', '__return_false' );

    }
}


/* BuddyPress 2.4 compat */

if ( ! function_exists( 'bp_groups_front_template_part' ) ) {
    /**
     * Output the contents of the current group's home page.
     *
     * You should only use this when on a single group page.
     *
     * @since 2.4.0
     */
    function bp_groups_front_template_part()
    {
        $located = bp_groups_get_front_template();

        if (false !== $located) {
            $slug = str_replace('.php', '', $located);

            /**
             * Let plugins adding an action to bp_get_template_part get it from here
             *
             * @param string $slug Template part slug requested.
             * @param string $name Template part name requested.
             */
            do_action('get_template_part_' . $slug, $slug, false);

            load_template($located, true);

        } else if (bp_is_active('activity')) {
            bp_get_template_part('groups/single/activity');

        } else if (bp_is_active('members')) {
            bp_groups_members_template_part();
        }

        return $located;
    }
}



/***************************************************
:: BuddyPress Avatar in menu item
 ***************************************************/

add_filter('kleo_nav_menu_items', 'kleo_add_user_avatar_nav_item' );
function kleo_add_user_avatar_nav_item( $menu_items ) {
    $menu_items[] = array(
        'name' => __( 'My Account', 'buddyapp' ),
        'slug' => 'user_avatar',
        'link' => '#',
    );

    return $menu_items;
}

add_filter('kleo_setup_nav_item_user_avatar' , 'kleo_setup_user_avatar_nav');
function kleo_setup_user_avatar_nav( $menu_item ) {

    add_filter( 'walker_nav_menu_start_el_user_avatar', 'kleo_menu_user_avatar', 10, 4 );
    add_filter( 'walker_nav_menu_start_el_li_user_avatar', 'kleo_menu_user_avatar_li', 10, 4 );

    return $menu_item;
}
if ( ! function_exists( 'kleo_menu_user_avatar' ) ) {
    /**
     * Render user avatar menu item
     *
     * @param string $item_output
     * @param  array $item
     * @param  integer $depth
     * @param  object $args
     * @return string
     */
    function kleo_menu_user_avatar( $item_output, $item, $depth, $args ) {

        $output = '';

        if ( is_user_logged_in() ) {

            $url = bp_loggedin_user_domain();

            $current_user = wp_get_current_user();
            $title = $item->attr_title != '' ? strip_tags( $item->attr_title ) : esc_html( $current_user->display_name );
            $attr_title = '<span>' . $title . '</span>';

            $output .= '<a title="' . bp_get_loggedin_user_fullname() . '" class="kleo-bp-user-avatar' . ( $args->has_children && in_array($depth, array(0,1)) ? ' open-submenu' : '' ) . '" href="' . $url . '" title="' . $attr_title .'">'
                       .  '<img src="' . esc_attr( bp_get_loggedin_user_avatar(array('width' => 25, 'height' => 25, 'html' => false)) ) . '" alt="">' . $attr_title;

            $output .= ( $args->has_children && in_array($depth, array(0,1))) ? '</a><span class="menu-arrow"></span>' : '</a>';

            return $output;
        } elseif ( $args->has_children && in_array( $depth, array( 0, 1 ) ) ) {
            return $item_output;
        } else {
            return '';
        }
    }
}

function kleo_menu_user_avatar_li( $item_output, $item, $depth, $args ) {
    $output = '';
    if ( is_user_logged_in() || ($args->has_children && in_array( $depth, array( 0, 1 ) )) ) {
        $output = $item_output;
    }
    return $output;
}


/**
 * Get current component title translated
 * @return string
 */
function kleo_bp_get_member_page_title() {

    $bp = buddypress();
    $current_component = bp_current_component();

    if ($current_component === false ) {
        return '';
    }

    $output = '';
    $bp_nav = $bp->bp_nav;
    foreach ( $bp_nav as $nav ) {
        if ( isset($nav['slug']) && $nav['slug'] == $current_component ) {
            $output = preg_replace( '@<(\w+)\b.*?>.*?</\1>@si', '', $nav['name'] );
            break;
        }
    }
    return $output;
}

/**
 * Get current component title translated
 * @return string
 */
function kleo_bp_get_group_page_title() {

    $bp = buddypress();

    $current_item = bp_current_item();
    $single_item_component = bp_current_component();
    $action = bp_current_action();
    $output = '';

    if ($current_item === false || ! isset( $bp->{$single_item_component}->nav ) ) {
        return '';
    }

    if (version_compare(BP_VERSION, '2.6', '>=')) {
        $nav_items = $bp->groups->nav->get_secondary( array( 'parent_slug' => $current_item ) );
        foreach ($nav_items as $nav ) {
            if ( isset( $nav['slug'] ) && $nav['slug'] == $action ) {
                $output = preg_replace( '@<(\w+)\b.*?>.*?</\1>@si', '', $nav['name'] );
                break;
            }
        }
    } else {
        $bp_nav = $bp->bp_options_nav;
        if ( isset($bp_nav[$current_item]) && ! empty( $bp_nav[$current_item] ) ) {
            foreach ( $bp_nav[$current_item] as $nav ) {
                if ( isset( $nav['slug'] ) && $nav['slug'] == $action ) {
                    $output = preg_replace( '@<(\w+)\b.*?>.*?</\1>@si', '', $nav['name'] );
                    break;
                }
            }
        }
    }


    return $output;
}
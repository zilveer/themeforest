<?php

add_filter( 'kleo_theme_settings', 'kleo_bp_messages_settings' );

function kleo_bp_messages_settings( $kleo )
{
    //
    // Settings Sections
    //

    $kleo['set'][] = array(
        'id' => 'bp_notif_interval',
        'title' => esc_html__('AJAX refresh interval', 'buddyapp'),
        'type' => 'text',
        'default' => '30000',
        'section' => 'kleo_section_bp',
        'description' => esc_html__('Set to 0(zero) if you want to disable AJAX checks. Expressed in millisecond, 30000 is 30 seconds', 'buddyapp'),
        'customizer' => true,
        'transport' => 'postMessage'
    );

    return $kleo;
}


/* Buddypress Notifications in menu item */
add_filter('kleo_nav_menu_items', 'kleo_add_messages_nav_item' );
function kleo_add_messages_nav_item( $menu_items ) {
  $menu_items[] = array(
    'name' => esc_html__( 'Live Messages', 'buddyapp' ),
    'slug' => 'messages',
    'link' => '#',
  );

  return $menu_items;
}



add_filter( 'kleo_setup_nav_item_messages' , 'kleo_setup_messages_nav' );
function kleo_setup_messages_nav( $menu_item ) {
    $menu_item->classes[] = 'has-submenu kleo-messages';
    if ( ! is_user_logged_in() ) {
        $menu_item->_invalid = true;
    } else {
        add_filter( 'walker_nav_menu_start_el_messages', 'kleo_menu_messages', 10, 4 );
    }

    return $menu_item;
}

function kleo_menu_messages( $item_output = '', $item = null, $depth = 1, $args = null ) {

    if( ! isset( $item ) ) {
        $item = new stdClass();
        $item->title = esc_html__( 'Messages', 'buddyapp' );
        $item->attr_title = esc_html__( 'Messages', 'buddyapp' );
        $item->icon = 'messages-line';
    }
    if ( ! isset( $args ) ) {
        $args = new stdClass();
        $args->theme_location = 'top-left';
    }
    $output = '';
    $url = bp_loggedin_user_domain() . bp_get_messages_slug();
    $count = bp_get_total_unread_messages_count();

    if ( $count > 0 ) {
      $alert = 'new-alert';
      $status = ' has-notif';
    } else {
      $alert = 'no-alert';
      $status = '';
    }
    $attr_title = strip_tags( $item->attr_title );

    $title_icon = kleo_get_menu_icon( $item->icon, $depth, $args, 'messages-line' );
    $title_icon = '<i class="icon-' . $title_icon . '"></i> ';

    $output .= '<a href="' . $url . '" title="' . $attr_title .'">'
        . $title_icon
        . '<span>'. $item->title .'</span>'
        . ' <b class="bubble ' . $alert . '">' . $count . '</b>'
        . '</a>'
        . '<em class="menu-arrow"></em>';

    $output .= '<ul class="submenu' . $status . '">';

    $message_list = kleo_bp_messages_get_list();

    if ( $message_list ) {
        $output .= $message_list;
        $style = '';
    } else {
        $output .= '<li class="kleo-submenu-item"><span>' . esc_html__( 'There are no new messages.', 'buddyapp' ) . '</span></li>';
        $style = ' style="display: none;"';
    }

    $output .= '<li class="footer-item"' . $style . '><a class="btn btn-link see-all-messages" href="' . $url . '">' . esc_html__( 'See all', 'buddyapp' ) . '</a></li>';

    $output .= '</ul>';

    return $output;
}



add_filter( 'kleo_bp_ajax_call', 'kleo_bp_messages_refresh' );
function kleo_bp_messages_refresh( $response ) {

    if ( ! isset( $_GET['current_messages'] ) ) {
        $response['statusMessages'] = 'failure';
        return $response;
    }

    $old_count = (int) $_GET['current_messages'];
    $count = bp_get_total_unread_messages_count();

    if ( $count == $old_count ) {
        $response['statusMessages'] = 'no_change';
        return $response;
    }

    $message_list = kleo_bp_messages_get_list();
    if ( $message_list ) {
        $output = $message_list;
    } else {
        $output = '<li class="kleo-submenu-item">' . esc_html__( 'There are no new messages.', 'buddyapp' ) . '</li>';
    }

    $response['dataMessages'] = $output;
    $response['countMessages']  = $count;
    $response['statusMessages']  = 'success';

    return $response;
}


function kleo_bp_messages_get_list() {

    $output = '';
    ?>

    <?php if ( bp_has_message_threads( array('user_id' => bp_loggedin_user_id(), 'type' => 'unread', 'max' => 5, 'per_page ' => 5, 'box' => 'inbox') ) ) : ob_start(); ?>

        <?php while ( bp_message_threads() ) : bp_message_thread(); ?>

            <li class="kleo-submenu-item <?php echo bp_message_thread_has_unread() ? 'unread' : 'read'; ?>" id="kleo-message-<?php bp_message_thread_id() ?>">

                <div class="message-thumb"><?php bp_message_thread_avatar() ?></div>
                <em class="message-from-wrap">
                    <em class="message-from"><?php bp_message_thread_from() ?></em>
                    <em class="message-date"><?php bp_message_thread_last_post_date() ?></em>
                </em>
                <div class="message-body">
                    <a href="<?php bp_message_thread_view_link();?>">
                        <?php bp_message_thread_excerpt() ?>
                    </a>
                </div>
            </li>
        <?php endwhile; ?>

        <?php $output .= ob_get_clean(); ?>

    <?php endif; ?>

    <?php

    return $output;
}
<?php

add_filter( 'kleo_theme_settings', 'kleo_bp_notif_settings' );

function kleo_bp_notif_settings( $kleo )
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
add_filter('kleo_nav_menu_items', 'kleo_add_notifications_nav_item' );
function kleo_add_notifications_nav_item( $menu_items ) {
  $menu_items[] = array(
    'name' => esc_html__( 'Live Notifications', 'buddyapp' ),
    'slug' => 'notifications',
    'link' => '#',
  );

  return $menu_items;
}

/* Localize refresh interval to JavaScript app.js */
add_filter( 'kleo_localize_app', 'kleo_bp_notif_refresh_int' );
function kleo_bp_notif_refresh_int( $data ) {
    $data['bpAjaxRefresh'] = sq_option( 'bp_notif_interval', 30000 );

    return $data;
}


add_filter('kleo_setup_nav_item_notifications' , 'kleo_setup_notifications_nav');
function kleo_setup_notifications_nav( $menu_item ) {
    $menu_item->classes[] = 'has-submenu kleo-notifications';
    if ( ! is_user_logged_in() ) {
        $menu_item->_invalid = true;
    } else {
        add_filter( 'walker_nav_menu_start_el_notifications', 'kleo_menu_notifications', 10, 4 );
    }

    return $menu_item;
}

function kleo_menu_notifications( $item_output = '', $item = null, $depth = 1, $args = null ) {

    if( ! isset( $item ) ) {
        $item = new stdClass();
        $item->title = esc_html__( 'Notifications', 'buddyapp' );
        $item->attr_title = esc_html__( 'Notifications', 'buddyapp' );
        $item->icon = 'notification-line';
    }
    if ( ! isset( $args ) ) {
        $args = new stdClass();
        $args->theme_location = 'top-left';
    }
    $output = '';
    $url = bp_loggedin_user_domain() . BP_NOTIFICATIONS_SLUG;
    $notifications = bp_notifications_get_notifications_for_user( bp_loggedin_user_id(), 'object' );
    $count         = ! empty( $notifications ) ? count( $notifications ) : 0;

    if ( $count > 0 ) {
      $alert = 'new-alert';
      $status = ' has-notif';
    } else {
      $alert = 'no-alert';
      $status = '';
    }
    $attr_title = strip_tags( $item->attr_title );

    $title_icon = kleo_get_menu_icon( $item->icon, $depth, $args, 'notification-line' );

    $title_icon = '<i class="icon-' . $title_icon . '"></i> ';

    $output .= '<a href="' . $url . '" title="' . $attr_title .'">'
        . $title_icon
        . '<span>'. $item->title .'</span>'
        . ' <b class="bubble ' . $alert . '">' . $count . '</b>'
        . '</a>'
        . '<em class="menu-arrow"></em>';

    $output .= '<ul class="submenu' . $status . '">';

    if ( ! empty( $notifications ) ) {
        foreach ( (array)$notifications as $notification ) {
          $output .='<li class="kleo-submenu-item" id="kleo-notification-' . $notification->id . '">';
          $output .='<a href="' . $notification->href . '">' . $notification->content . '</a>';
          $output .='</li>';
        }
    }
    else {
        $output .= '<li class="kleo-submenu-item"><span>' . esc_html__( 'No new notifications' , 'buddyapp' ) . '</span></li>';
    }

    if ( ! empty( $notifications ) ) {
        $style = '';
    } else {
        $style = ' style="display: none;"';
    }
    $output .= '<li class="footer-item"' . $style . '><a class="btn btn-link mark-as-read" href="#">' . esc_html__( 'Mark all as read', 'buddyapp' ) . '</a></li>';

    $output .= '</ul>';

    return $output;
}


/* Mark notifications as read by AJAX */
add_action('wp_ajax_kleo_bp_notification_mark_read', 'kleo_bp_notification_mark_read');

function kleo_bp_notification_mark_read() {
  $response = array();

  if ( BP_Notifications_Notification::mark_all_for_user( bp_loggedin_user_id() ) ) {
    $response['status'] = 'success';
  }
  else {
    $response['status'] = 'failure';
  }

  $notifications = bp_notifications_get_notifications_for_user( bp_loggedin_user_id(), 'object' );
  $count         = ! empty( $notifications ) ? count( $notifications ) : 0;
  $response['count']  = $count;
  $response['empty']  = '<li class="kleo-submenu-item">' . esc_html__( 'No new notifications' , 'buddyapp' ) . '</li>';

  echo json_encode( $response );
  exit;
}

add_filter( 'kleo_bp_ajax_call','kleo_bp_notifications_refresh' );
function kleo_bp_notifications_refresh( $response ) {

    if ( ! isset( $_GET['current_notifications'] ) ) {
        $response['statusNotif'] = 'failure';
        return $response;
    }

    $old_count = (int) $_GET['current_notifications'];

    $notifications = bp_notifications_get_notifications_for_user( bp_loggedin_user_id(), 'object' );
    $count         = ! empty( $notifications ) ? count( $notifications ) : 0;

    if ( $count == $old_count ) {
        $response['statusNotif'] = 'no_change';
        return $response;
    }

    $output = '';

    if ( !empty( $notifications ) ) {
        foreach ( (array)$notifications as $notification ) {
            $output .='<li class="kleo-submenu-item" id="kleo-notification-' . $notification->id . '">';
            $output .='<a href="' . $notification->href . '">' . $notification->content . '</a>';
            $output .='</li>';
        }
    } else {
        $output .= '<li class="kleo-submenu-item">' . esc_html__( 'No new notifications' , 'buddyapp' ) . '</li>';
    }
    $response['dataNotif'] = $output;
    $response['countNotif']  = $count;
    $response['statusNotif']  = 'success';

    return $response;
}

<?php
add_action('init', 'event_type');
add_action('init', 'event_taxonomies', 0);
add_action('admin_menu', 'event_settings');
add_action('save_post', 'event_settings_update');
add_action('admin_init', 'event_status');
add_action('save_post', 'event_status_update');
add_filter('manage_edit-event_columns', 'add_new_event_columns');
add_action('manage_event_posts_custom_column', 'manage_event_columns', 10, 2);
function event_type() {
    $imagepath = get_stylesheet_directory_uri() . '/images/posticon/';
    $labels    = array(
        'name' => __('Events', 'clubber'),
        'singular_name' => __('Event', 'clubber'),
        'add_new' => __('Add New', 'clubber'),
        'add_new_item' => __('Add New Event', 'clubber'),
        'edit' => __('Edit', 'clubber'),
        'edit_item' => __('Edit Event', 'clubber'),
        'new_item' => __('New Event', 'clubber'),
        'view' => __('View Event', 'clubber'),
        'view_item' => __('View Event', 'clubber'),
        'search_items' => __('Search Events', 'clubber'),
        'not_found' => __('No events found', 'clubber'),
        'not_found_in_trash' => __('No events found in Trash', 'clubber'),
        'parent_item_colon' => ''
    );
    $args      = array(
        'labels' => $labels,
        'description' => 'This is the holding location for all Events',
        'public' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'show_ui' => true,
        'query_var' => true,
        'capability_type' => 'post',
        'rewrite' => true,
        'hierarchical' => false,
        'menu_position' => 5,
        'menu_icon' => $imagepath . '/event.png',
        'supports' => array(
            'title',
            'editor',
            'thumbnail'
        )
    );
    register_post_type('event', $args);
}
function event_taxonomies() {
    register_taxonomy('events', 'event', array(
        'hierarchical' => true,
        'slug' => 'events',
        'label' => __('Category', 'clubber'),
        'query_var' => true,
        'rewrite' => true
    ));
}
function add_new_event_columns() {
    $new_columns['cb']     = '<input type="checkbox" />';
    $new_columns['title']  = __('Title', 'clubber');
    $new_columns['author'] = __('Author', 'clubber');
    $new_columns['id']     = __('ID', 'clubber');
    $new_columns['date']   = __('Date', 'clubber');
    return $new_columns;
}
function manage_event_columns($column_name, $id) {
    global $wpdb;
    switch ($column_name) {
        case 'id':
            echo $id;
            break;
        case 'images':
            // Get number of images in gallery
            $num_images = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $wpdb->posts WHERE post_parent = {$id};"));
            echo $num_images;
            break;
        default:
            break;
    } // end switch
}
function event_settings() {
    add_meta_box('event_settings', __('Event settings', 'clubber'), 'event_settings_meta_source', 'event', 'normal', 'high');
}
function event_settings_update($post_ID = 0) {
    $post_ID = (int) $post_ID;  
    $post_type = get_post_type( $post_ID );
    $post_status = get_post_status( $post_ID );
    if ( "event" == $post_type && "auto-draft" != $post_status ) { 
    update_post_meta($post_ID, "event_date_day", $_POST["event_date_day"]);
    update_post_meta($post_ID, "event_date_month", $_POST["event_date_month"]);
    update_post_meta($post_ID, "event_date_year", $_POST["event_date_year"]);
    update_post_meta($post_ID, "event_date_interval", $_POST["event_date_interval"]);
	update_post_meta($post_ID, "event_date_interval_finish", $_POST["event_date_interval_finish"]);
    update_post_meta($post_ID, "event_tstart", $_POST["event_tstart"]);
    update_post_meta($post_ID, "event_tend", $_POST["event_tend"]);
    update_post_meta($post_ID, "event_venue", $_POST["event_venue"]);
    update_post_meta($post_ID, "event_location", $_POST["event_location"]);
    update_post_meta($post_ID, "event_zoom", $_POST["event_zoom"]);
	update_post_meta($post_ID, "ev_text", $_POST["ev_text"]);
    update_post_meta($post_ID, "event_ticket", $_POST["event_ticket"]);
    update_post_meta($post_ID, "event_coordinated", $_POST["event_coordinated"]);  
    update_post_meta($post_id, 'Date', $date); 
    }
}
function event_settings_meta_source() {
    global $post;    
    $event_day      = get_post_meta($post->ID, 'event_date_day', true);
    $event_month    = get_post_meta($post->ID, 'event_date_month', true);
    $event_year     = get_post_meta($post->ID, 'event_date_year', true);
    $event_venue    = get_post_meta($post->ID, 'event_venue', true);
    $event_location = get_post_meta($post->ID, 'event_location', true);
    $date           = get_post_meta($post->ID, 'event_date_interval', true);
	$date_finish    = get_post_meta($post->ID, 'event_date_interval_finish', true);
    $tstart         = get_post_meta($post->ID, 'event_tstart', true);
    $tend           = get_post_meta($post->ID, 'event_tend', true);
    $coordinated    = get_post_meta($post->ID, 'event_coordinated', true);
    $event_zoom     = get_post_meta($post->ID, 'event_zoom', true); 
    $allday         = get_post_meta($post->ID, 'event_allday', true);    
    echo '		
<div style="padding-top:10px;">
   <label style="display:block;padding:2px;">' . __('Event Venue', 'clubber') . ': </label>
   <input style="width:220px;" name="event_venue" value="' . $event_venue . '" />
   Example: Kristal Glam Club
</div>
<div style="padding-top:10px;">
   <label style="display:block;padding:2px;">' . __('Event Location', 'clubber') . ': </label>
   <input style="width:220px;" name="event_location" value="' . $event_location . '" />
   Example: Bucharest, Romania
</div>
<div style="padding-top:10px;">
   <label style="display:block;padding:2px;">' . __('Event Date (yyyy/mm/dd)', 'clubber') . ': </label>
   Start Event:
   <input style="width:90px;" name="event_date_interval" id="event-date" value="' . $date . '" />
   End Event:
   <input style="width:90px;" name="event_date_interval_finish" id="event-date-finish" value="' . $date_finish . '" />
   Click inside the field, Data Picker.
</div>
<div style="padding-top:10px;">
   <label style="display:block;padding:2px;">' . __('Event Time (hh:mm tt)', 'clubber') . ': </label>
    Start Event:
   <input style="width:90px; margin-right:10px;" name="event_tstart" id="time-start" value="' . $tstart . '" />
   End Event:
   <input style="width:90px; margin-right:10px;" name="event_tend" id="time-end" value="' . $tend . '" />
   All day:
   <input type="hidden" name="my_allday" value="' . wp_create_nonce('my_allday') . '" />';
?>   
   <input type="checkbox" name="event_allday" id="event_allday" <?php checked($allday, 'yes') ?> />
<?php   
   echo '
</div>
<div style="padding-top:10px;">
   <label style="display:block;padding:2px;">' . __('Map', 'clubber') . ': </label>
    Coordinated:
   <input style="width:150px; margin-right:10px;" name="event_coordinated" value="' . $coordinated . '" />
    Zoom Map:
   <input style="width:90px;" name="event_zoom" value="' . $event_zoom . '" />
</div>';
}
function event_status() {
    add_meta_box('event_status', 'Event Status', 'event_status_meta', 'event', 'normal', 'core');
}
function event_status_meta() {
    global $post;
    $out          = get_post_meta($post->ID, 'event_out', true);
    $cancel       = get_post_meta($post->ID, 'event_cancel', true);
	$disable      = get_post_meta($post->ID, 'event_disable', true);
    $free         = get_post_meta($post->ID, 'event_free', true);
    $event_ticket = get_post_meta($post->ID, 'event_ticket', true);
	$ev_text      = get_post_meta($post->ID, 'ev_text', true);
    echo '
<div style="padding-top:10px;">
   <label style="display:block;padding:2px;">' . __('Ticket URL', 'clubber') . ': </label>
   <input style="width:220px;" name="event_ticket" value="' . $event_ticket . '" />
   Example: http://ticket.com
</div>
<div style="padding-top:10px;">
   <label style="display:block;padding:2px;">' . __('Text Button', 'clubber') . ': </label>
   <input style="width:220px;" name="ev_text" value="' . $ev_text . '" />
   Enter custom text for the ticket button 
</div>
';
?>
<div style="padding-top:10px;">
   <input type="hidden" name="my_out" value="<?php
    echo wp_create_nonce('my_out');
?>" />
   <label for="event_out">Check if show is sold out: </label>
   <input type="checkbox" name="event_out" id="event_out" <?php
    checked($out, 'yes');
?> />
</div>
<div style="padding-top:10px;">
   <input type="hidden" name="my_cancel" value="<?php
    echo wp_create_nonce('my_cancel');
?>" />
   <label for="event_cancel">Check if show is canceled: </label>
   <input type="checkbox" name="event_cancel" id="event_cancel" <?php
    checked($cancel, 'yes');
?> />
</div>
<div style="padding-top:10px;">
   <input type="hidden" name="my_free" value="<?php
    echo wp_create_nonce('my_free');
?>" />
   <label for="event_cancel">Check if show is free: </label>
   <input type="checkbox" name="event_free" id="event_free" <?php
    checked($free, 'yes');
?> />
</div>
<div style="padding-top:10px;">
   <input type="hidden" name="disable_buttons" value="<?php
    echo wp_create_nonce('disable_buttons');
?>" />
   <label for="event_disable">Disable buttons: </label>
   <input type="checkbox" name="event_disable" id="event_disable" <?php
    checked($disable, 'yes');
?> />
</div>
<?php
}
function event_status_update($post_id) {
    if (!isset($_POST['my_out'])){
    $_POST['my_out'] = "undefine";
    } 
    if (!wp_verify_nonce($_POST['my_out'], 'my_out') || !current_user_can('edit_posts'))
        return;
    $value = isset($_POST['event_out']) ? 'yes' : 'no';
        update_post_meta($post_id, 'event_out', $value);
    
    if (!wp_verify_nonce($_POST['my_cancel'], 'my_cancel') || !current_user_can('edit_posts'))
        return;
    $value = isset($_POST['event_cancel']) ? 'yes' : 'no';
        update_post_meta($post_id, 'event_cancel', $value);
        
    if (!wp_verify_nonce($_POST['my_free'], 'my_free') || !current_user_can('edit_posts'))
        return;
    $value = isset($_POST['event_free']) ? 'yes' : 'no';
        update_post_meta($post_id, 'event_free', $value);
		
	if (!wp_verify_nonce($_POST['disable_buttons'], 'disable_buttons') || !current_user_can('edit_posts'))
        return;
    $value = isset($_POST['event_disable']) ? 'yes' : 'no';
        update_post_meta($post_id, 'event_disable', $value);	
       
    if (!wp_verify_nonce($_POST['my_allday'], 'my_allday') || !current_user_can('edit_posts'))
        return; 
    $value = isset($_POST['event_allday']) ? 'yes' : 'no';
        update_post_meta($post_id, 'event_allday', $value);  
}
?>
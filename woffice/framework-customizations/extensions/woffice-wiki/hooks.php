<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/*---------------------------------------------------------
** 
** TRICK TO CHECK IF THE EXTENSIONS IS ENABLED
**
----------------------------------------------------------*/
function woffice_wiki_extension_on(){
	return;
}
/*---------------------------------------------------------
** 
** LIKE BUTTON JQUERY
**
----------------------------------------------------------*/	
function woffice_wiki_buttons_js(){
	
	if (is_singular("wiki")){
		/*Ajax URL*/
		$ajax_url = admin_url('admin-ajax.php');
		/*Ajax Nonce*/
		$ajax_nonce = wp_create_nonce('ajax-nonce');
		
		echo'<script type="text/javascript">
			jQuery(function () {
			
				jQuery(".wiki-like a").click(function(){
	     
			        like = jQuery(this);
			        post_id = like.data("post_id");
			         
			        // Ajax call
			        jQuery.ajax({
			            type: "post",
			            url: "'.$ajax_url.'",
			            data: "action=post-like&nonce='.$ajax_nonce.'&post_like=&post_id="+post_id,
			            success: function(count){
			                if(count != "already")
			                {
			                    like.closest(".wiki-like").addClass("voted");
			                    like.siblings(".count").text(count);
			                }
			            }
			        });
			         
			        return false;
			        
			    });
			
			});
		</script>';
	}
	
}
add_action('wp_footer', 'woffice_wiki_buttons_js');

/*---------------------------------------------------------
** 
** LIKE BUTTON FUNCTION
**
----------------------------------------------------------*/	
function post_like(){
	
	$ext_instance = fw()->extensions->get( 'woffice-wiki' );
	
    // Check for nonce security
    $nonce = $_POST['nonce'];
  
    if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
        die ( 'Busted!');
     
    if(isset($_POST['post_like']))
    {
        // Retrieve user IP address
        $ip = $_SERVER['REMOTE_ADDR'];
        $post_id = $_POST['post_id'];

        // We get the Wiki Likes "Engine" :
        $wiki_like_engine = ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('wiki_like_engine') : '';
        if($wiki_like_engine == 'members') {



        } else {

            // Get voters'IPs for the current post
            $meta_IP = get_post_meta($post_id, "voted_IP");
            $voted_IP = (empty($meta_IP)) ? 0 : $meta_IP[0];
            if(!is_array($voted_IP))
                $voted_IP = array();

        }

        // Get votes count for the current post
        $meta_count = get_post_meta($post_id, "votes_count", true);

        // Use has already voted ?
        if(!$ext_instance->woffice_user_has_already_voted($post_id))
        {

            if($wiki_like_engine == 'members') {

                $voted_IDs = get_post_meta($post_id, "voted_IDs", true);
                $user_id = (is_user_logged_in()) ? get_current_user_id() : 0;
                if(empty($voted_IDs))
                    $voted_IDs = array();
                $voted_IDs[$user_id] = $user_id;
                // Save it :
                update_post_meta($post_id, "voted_IDs", $voted_IDs);

            } else {
                $voted_IP[$ip] = time();
                // Save IP and increase votes count
                update_post_meta($post_id, "voted_IP", $voted_IP);
            }

            update_post_meta($post_id, "votes_count", ++$meta_count);
             
            // Display count (ie jQuery return value)
            echo $meta_count;

	        //Add notification
	        $post_object = get_post($post_id);
	        
	        if(woffice_is_wiki_like_notification_enabled()) {
		        bp_notifications_add_notification( array(
			        'user_id'           => $post_object->post_author,
			        'item_id'           => $post_id,
			        'secondary_item_id' => get_current_user_id(),
			        'component_name'    => 'woffice_wiki',
			        'component_action'  => 'woffice_wiki_like',
			        'date_notified'     => bp_core_current_time(),
			        'is_new'            => 1,
		        ) );
	        }


        }
        else
            echo "already";
    }
    exit;
}
add_action('wp_ajax_nopriv_post-like', 'post_like');
add_action('wp_ajax_post-like', 'post_like');


/*---------------------------------------------------------
**
** LIKE BUTTON FUNCTION
**
----------------------------------------------------------*/

function woffice_is_wiki_like_notification_enabled() {
	return (! ( defined( 'WOFFICE_DISABLE_WIKI_LIE_NOTIFICATION' ) && ( true == WOFFICE_DISABLE_WIKI_LIE_NOTIFICATION ) ) );

}

add_action( 'bp_setup_globals', 'woffice_register_wiki_notification' );

if(!function_exists('woffice_register_wiki_notification')) {
	function woffice_register_wiki_notification() {
		// Register component manually into buddypress() singleton
		buddypress()->woffice_wiki = new stdClass;
		// Add notification callback function
		buddypress()->woffice_wiki->notification_callback = 'woffice_wiki_like_format_notifications';

		// Now register components into active components array
		buddypress()->active_components['woffice_wiki'] = 1;
	}
};

if(!function_exists('woffice_wiki_like_format_notifications')) {
	function woffice_wiki_like_format_notifications( $action, $item_id, $secondary_item_id, $total_items, $format = 'string' ) {

		// New custom notifications
		if ( 'woffice_wiki_like' === $action ) {

			$wiki_post = get_post( $item_id );
			//$who_user = get_userdata($secondary_item_id);

			//$who_user_name = woffice_get_name_to_display($who_user);
			$post_title = get_the_title( $item_id );

			//$custom_title = sprintf( esc_html__( '%1$s liked your post "%2$s"', 'woffice' ), $who_user_name, $post_title );
			//$custom_text = sprintf( esc_html__( '%1$s liked your post "%2$s"', 'woffice' ), $who_user_name, $post_title );

			$custom_title = sprintf( esc_html__( 'Your post "%1$s" received a like', 'woffice' ), $post_title );
			$custom_text  = sprintf( esc_html__( 'Your post "%1$s" received a like', 'woffice' ), $post_title );
			$custom_link  = get_permalink( $item_id );

			// WordPress Toolbar
			if ( 'string' === $format ) {
				$return = apply_filters( 'woffice_wiki_like_format', '<a href="' . esc_url( $custom_link ) . '" title="' . esc_attr( $custom_title ) . '">' . esc_html( $custom_text ) . '</a>', $custom_text, $custom_link );

				// Deprecated BuddyBar
			} else {
				$return = apply_filters( 'woffice_wiki_like_format', array(
					'text' => $custom_text,
					'link' => $custom_link
				), $custom_link, (int) $total_items, $custom_text, $custom_title );
			}

			return $return;

		}

		return $action;

	}
}

if(!function_exists('woffice_clear_wiki_like_notification')) {
	function woffice_clear_wiki_like_notification() {
		if ( is_singular( 'wiki' ) && is_user_logged_in() ) {
			global $post;
			$current_user_id = get_current_user_id();
			if ( $post->post_author == $current_user_id ) {
				bp_notifications_mark_notifications_by_item_id( $current_user_id, $post->ID, 'woffice_wiki', 'Woffice_wiki_like', false, 0 );
			}
		}

	}
}
add_action('wp', 'woffice_clear_wiki_like_notification');
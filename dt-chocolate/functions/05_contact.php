<?php
add_action( 'add_meta_boxes', 'dt_contact_layout_register_mboxes' );
add_action( 'save_post', 'dt_contact_options_save' );

function dt_contact_layout_register_mboxes() {
    global $post;
    if( isset($_GET['post']) ) {
        $post_id = $_GET['post'];
    }elseif( isset($_POST['post_ID']) ) {
        $post_id = $_POST['post_ID'];
    }elseif( isset($post->ID) ) {
        $post_id = $post->ID;
	}

	if( isset($post_id) )
		$template = get_post_meta($post_id, '_wp_page_template', true);
	else
		$template = '';

	if( 'contact.php' == $template ) {
    	add_meta_box(
        	'contact-admin',
        	_x( 'Page options', 'backend contact layout', LANGUAGE_ZONE ),
        	'dt_contact_layout_options',
        	'page',
			'side'
    	);
	}
}

function dt_contact_layout_options( $post ) {
	$box_name = 'dt_contact_layout_options';

	$opts = get_post_meta( $post->ID, '_'.$box_name, true );
	$defaults = array(
		'en_captcha'	=> false,
	);
	$opts = wp_parse_args( $opts, $defaults );

	// Use nonce for verification
	wp_nonce_field( plugin_basename( __FILE__ ), $box_name.'_noncename' );
	?>
	<p>
		<label><?php _e('Enable captcha: ', LANGUAGE_ZONE); ?><input type="checkbox" name="<?php echo $box_name; ?>-en_captcha"<?php checked($opts['en_captcha']); ?> /></label>
	</p>
	<?php
}

function dt_contact_options_save( $post_id ) {
	$box_name = 'dt_contact_layout_options';
	
	// verify if this is an auto save routine. 
	// If it is our form has not been submitted, so we dont want to do anything
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		return;

	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times

	if ( !isset( $_POST[$box_name.'_noncename'] ) || !wp_verify_nonce( $_POST[$box_name.'_noncename'], plugin_basename( __FILE__ ) ) )
		return;

	if ( !current_user_can( 'edit_post', $post_id ) )
		return;
	
	// OK, we're authenticated: we need to find and save the data
	$mydata = array();

	$mydata['en_captcha'] = isset($_POST[$box_name.'-en_captcha']);

	update_post_meta( $post_id, '_'.$box_name, $mydata );
}

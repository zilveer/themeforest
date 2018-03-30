<?php
// Add the Skill Meta Boxes

function mukam_add_portfolio_metaboxes() {
	add_meta_box('mukam_portfolio_project', 'Project', 'mukam_portfolio_project', 'portfolio', 'side', 'default');
}
// The Skill Metabox

function mukam_portfolio_project() {
	global $post;
	
	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="portfoliometa_noncename" id="portfoliometa_noncename" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	// Get the skill data if its already been entered
	$client = get_post_meta($post->ID, '_client', true);
	$website = get_post_meta($post->ID, '_website', true);
	
	// Echo out the field
	echo '<p>Client:</p>';
	echo '<input type="text" name="_client" value="' . $client  . '" class="widefat" />';
	echo '<p>Website:</p>';
	echo '<input type="text" name="_website" value="' . $website  . '" class="widefat" />';
}

// Save the Metabox Data

function mukam_save_portfolio_meta($post_id, $post) {
	
	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times
	if ( isset($_POST['portfoliometa_noncename']) && !wp_verify_nonce( $_POST['portfoliometa_noncename'], plugin_basename(__FILE__) )) {
	return $post->ID;
	}

	// Is the user allowed to edit the post or page?
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;

	// OK, we're authenticated: we need to find and save the data
	// We'll put it into an array to make it easier to loop though.
	$portfolio_meta = array();
	if ( isset($_POST['_client'])) {
	$portfolio_meta['_client'] = $_POST['_client']; }
	if ( isset($_POST['_website'])) {
	$portfolio_meta['_website'] = $_POST['_website'];}
	// Add values of $portfolio_meta as custom fields
	
	foreach ($portfolio_meta as $key => $value) { // Cycle through the $events_meta array!
		if( $post->post_type == 'revision' ) return; // Don't store custom data twice
		$value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
		if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
			update_post_meta($post->ID, $key, $value);
		} else { // If the custom field doesn't have a value
			add_post_meta($post->ID, $key, $value);
		}
		if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
	}

}

add_action('save_post', 'mukam_save_portfolio_meta', 1, 2); // save the custom fields
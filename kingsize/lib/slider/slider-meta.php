<?php
/**
 * @KingSize 2013
 * The PHP code for setup Theme slider custom fields.
 * OurWebMedia http://www.ourwebmedia.com
 **/

#-----------------------------------------------------------------#
#####################  Define Metabox Fields  #####################
#-----------------------------------------------------------------#

include_once(get_template_directory() . "/lib/meta-fields.php");

$slider_meta_box_settings = array(
		array('type' => 'start'),	
		/* Slider background options V4 */
		array( "name" => "Disable the Learn More link",
		  "title" => "Read More Button",
		  "id" => "kingsize_disable_learn_more_link",
		  "type" => "select",
		  "items" => array("enable_button"=>"Enabled Slider Button","disable_button"=>"Disable Slider Button"),
		  "std" => "enable_button",
		  "desc" => "Choose to enable or disable the read more button on this slide.",'show_default_title'=>"false"
		),
		array("title" => "Read More Link", "name" => "Custom 'Learn More' Link", "id" => "kingsize_slider_link",  'type' => 'text', 'desc'=>'Insert the URL you want to be used as the <b>Learn More</b> link.'),
		array('type' => 'close'),

		array('type' => 'start'),	
		array("title" => "Custom Button Text", "name" => "Custom 'Learn More' Text", "id" => "kingsize_slider_link_text",  'type' => 'text', 'desc'=>'Insert the text you want to use instead of default Learn More.'),
		array('title' => 'Link Target','name' => 'Open in new window','desc' => 'If selected this will open the slider links in a new tab instead.','id' => 'kingsize_slider_link_open','type' => 'checkbox','std' => ''),	
		array('type' => 'close'),

		array('type' => 'start'),	
		array( "name" => "Show Title and Description","title" => "Title / Description",
		  "id" => "kingsize_show_title_and_discription",
		  "type" => "select",
		  "items" => array("show_title_discription"=>"Show Title and Description","show_title"=>"Show Title Only", "show_discription"=>"Show Description  Only"),
		  "std" => "show_title_discription",
		  "desc" => "Show Title and Description of slider.",'show_default_title'=>"false"
		),
		array('type' => 'close'),
);

###### Generating Meta boxes #######
function slider_meta_box() {

	global $slider_meta_box_settings,$post;

	echo '<p style="padding:10px 0 0 0;">'.__('Manage your Background Slider options here and override those defined globally in the Theme Options.', 'framework').'</p>';
	// Use nonce for verification
	echo '<input type="hidden" name="myplugin_noncename" id="myplugin_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
 
	echo '<table class="form-table">';

	foreach ($slider_meta_box_settings as $meta) :

		if(isset($meta['name'])) { $value = get_post_meta($post->ID, $meta['name'], true); }

		if ($meta['type'] == 'text')
			meta_inputbox($meta, $value);	
		elseif($meta['type'] == 'select')
			meta_selectbox($meta, $value);	
		elseif($meta['type'] == 'checkbox')
			meta_checkbox($meta, $value);
		elseif($meta['type'] == 'button')
			meta_button($meta, $value);
		elseif($meta['type'] == 'start')
			get_meta_divider_start($meta, $value);
		elseif($meta['type'] == 'close')
			get_meta_divider_end($meta, $value);
		elseif($meta['type'] == 'clear')
			get_meta_clear($meta, $value);

	endforeach;

	echo '</table>';
}
###### End of Meta boxes ###### 



function slider_save_postdata( $post_id,$portfolio_postmetas=array()  ) {

	//global $page_postmetas;

	// verify this came from the our screen and with proper authorization, because save_post can be triggered at other times

	if ( isset($_POST['myplugin_noncename']) && !wp_verify_nonce( $_POST['myplugin_noncename'], plugin_basename(__FILE__) )) {
		return $post_id;
	}

	// verify if this is an auto save routine. If it is our form has not been submitted, so we dont want to do anything
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;

	if ( 'slider' != $_POST['post_type'] || !isset($_POST['post_type'])) return $post_id; //Fix for quick edit mode.

	// Check permissions
	if ( isset($_POST['post_type']) && 'slider' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) )
			return $post_id;
		} else {
		if ( !current_user_can( 'edit_post', $post_id ) )
			return $post_id;
	}

	// OK, we're authenticated

	if ( $parent_id = wp_is_post_revision($post_id) )
	{
		$post_id = $parent_id;
	}

	foreach ( $portfolio_postmetas as $postmeta ) {
	
		if ($_POST[$postmeta['id']]) {
			slider_update_custom_meta($post_id, $_POST[$postmeta['id']], $postmeta['id']);
		}

		if ($_POST[$postmeta['id']] == "") {
			delete_post_meta($post_id, $postmeta['id']);
		}
	}
}

function slider_update_custom_meta($postID, $newvalue, $field_name) {

	if (!get_post_meta($postID, $field_name)) {
		add_post_meta($postID, $field_name, $newvalue);
	} else {
		update_post_meta($postID, $field_name, $newvalue);
	}

}



//Add all meta fields to write up panel
function slider_create_meta_box() {
	if ( function_exists('add_meta_box') ) {  
		add_meta_box( 'slider_metabox', 'Kingsize Background Slider Options', 'slider_meta_box', 'slider', 'normal', 'high' );
	}
}  

//Saving all data
function slider_save($post_id)
{
	// don't run this for quickedit
	if ( defined('DOING_AJAX') )
		return;

	global $slider_meta_box_settings;
	slider_save_postdata( $post_id,$slider_meta_box_settings);
}

//init
add_action('admin_menu', 'slider_create_meta_box'); 
add_action('save_post', 'slider_save'); 
/*
	End creating custom fields
*/

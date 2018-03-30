<?php

/* Define the custom box */
add_action('add_meta_boxes', 'themeteam_add_custom_box');

/* Do something with the data entered */
add_action('save_post', 'themeteam_save_postdata');

/* Adds a box to the main column on the Post and Page edit screens */
function themeteam_add_custom_box() {
    add_meta_box( 'themeteam_sectionid', __( 'ThemeTeam Custom Post Options', 'themeteam_textdomain' ), 
                'themeteam_inner_custom_box_post', 'post','normal','high' );
    add_meta_box( 'themeteam_sectionid', __( 'ThemeTeam Custom Page Options', 'themeteam_textdomain' ), 
                'themeteam_inner_custom_box', 'page', 'normal','high');
}

/* Prints the box content */
function themeteam_inner_custom_box() {
  global $post;
  // Use nonce for verification
  wp_nonce_field( plugin_basename(__FILE__), 'themeteam_noncename' );
  
  //add the header info
?>  
  	
  	<style type="text/css">
		.input_text { margin:0 0 10px 0; background:#f4f4f4; color:#444; width:80%; font-size:11px; padding: 5px;}
		.input_select { margin:0 0 10px 0; background:#f4f4f4; color:#444; width:60%; font-size:11px; padding: 5px;}
		.input_checkbox { margin:0 10px 0 0; }
		.spacer { display: block; height:5px}
		.metabox_desc { font-size:10px; color:#aaa; display:block}
		.metaboxes{ border-collapse:collapse; width:100%}
		.metaboxes tr:hover th,
		.metaboxes tr:hover td { background:#f8f8f8}
		.metaboxes th,
		.metaboxes td{ border-bottom:1px solid #ddd; padding:10px 10px;text-align: left; vertical-align:top}
		.metabox_th { width:20%}
		.input_textarea { width:80%; height:120px;margin:0 0 10px 0; background:#f0f0f0; color:#444;font-size:11px;padding: 5px;}

	</style>
<?php
	// The actual fields for data entry
	$output = '';
	$output .= '<table class="metaboxes">'."\n";
	
	//add custom link
    $output .= "\t".'<tr>';
    $output .= "\t\t".'<th class="metabox_th"><label for="themeteam_custom_link">Custom Link</label></th>'."\n";
    $output .= "\t\t".'<td><input class="input_text" type="text" value="'.get_post_meta($post->ID,'themeteam_custom_link',true).'" name="themeteam_custom_link" id="themeteam_custom_link"/>';
    $output .= '<span class="metabox_desc">Place custom slider link here.</span></td>'."\n";
    $output .= "\t".'<td></td></tr>'."\n";
    
    //add custom slider text
    $output .= "\t".'<tr>';
    $output .= "\t\t".'<th class="metabox_th"><label for="themeteam_slider_text">Custom Slider text</label></th>'."\n";
    $output .= "\t\t".'<td><input class="input_text" type="text" value="'.get_post_meta($post->ID,'themeteam_slider_text',true).'" name="themeteam_slider_text" id="themeteam_slider_text"/>';
    $output .= '<span class="metabox_desc">Place custom slider text here if this page is used for homepage slider.</span></td>'."\n";
    $output .= "\t".'<td></td></tr>'."\n";
    
	//text input for image field
	$output .= "\t".'<tr>';
    $output .= "\t\t".'<th class="metabox_th"><label for="themeteam_image_upload">Slider Image</label></th>'."\n";
    $output .= "\t\t".'<td><input class="input_text" type="text" value="'.get_post_meta($post->ID,'themeteam_image_upload',true).'" name="themeteam_image_upload" id="themeteam_image_upload"/><input id="upload_image_button" type="button" value="Upload Image" />';
    $output .= '<span class="metabox_desc">Enter an URL or upload an image for the Slider/Banner Image.</span></td>'."\n";
    $output .= "\t".'<td></td></tr>'."\n";
    
    //add custom header text
    //$output .= "\t".'<tr>';
    //$output .= "\t\t".'<th class="metabox_th"><label for="themeteam_header_text">Custom header text</label></th>'."\n";
    //$output .= "\t\t".'<td><textarea class="input_textarea" name="themeteam_header_text" id="themeteam_header_text">'.get_post_meta($post->ID,'themeteam_header_text',true).'</textarea>';
    //$output .= '<span class="metabox_desc">Place custom header text here.</span></td>'."\n";
    //$output .= "\t".'<td></td></tr>'."\n";
    
    //add video embed code
    $output .= "\t".'<tr>';
    $output .= "\t\t".'<th class="metabox_th"><label for="themeteam_video_embed">Embed Video</label></th>'."\n";
    $output .= "\t\t".'<td><textarea class="input_textarea" name="themeteam_video_embed" id="themeteam_video_embed">'.get_post_meta($post->ID,'themeteam_video_embed',true).'</textarea>';
    $output .= '<span class="metabox_desc">Place the embed code for your video.</span></td>'."\n";
    $output .= "\t".'<td></td></tr>'."\n"; 

  	//text input for video width field
	$output .= "\t".'<tr>';
    $output .= "\t\t".'<th class="metabox_th"><label for="themeteam_video_width">Video Width</label></th>'."\n";
    $output .= "\t\t".'<td><input class="input_text" type="text" value="'.get_post_meta($post->ID,'themeteam_video_width',true).'" name="themeteam_video_width" id="themeteam_video_width"/>';
    $output .= '<span class="metabox_desc">Enter the video width for the embedded video</span></td>'."\n";
    $output .= "\t".'<td></td></tr>'."\n";
    //text input for video height field
	$output .= "\t".'<tr>';
    $output .= "\t\t".'<th class="metabox_th"><label for="themeteam_video_height">Video Height</label></th>'."\n";
    $output .= "\t\t".'<td><input class="input_text" type="text" value="'.get_post_meta($post->ID,'themeteam_video_height',true).'" name="themeteam_video_height" id="themeteam_video_height"/>';
    $output .= '<span class="metabox_desc">Enter the video height for the embedded video</span></td>'."\n";
    $output .= "\t".'<td></td></tr>'."\n";
    
    $output .= '</table>';
  	echo $output;

}

/* Prints the box content */
function themeteam_inner_custom_box_post() {
  global $post;
  // Use nonce for verification
  wp_nonce_field( plugin_basename(__FILE__), 'themeteam_noncename' );
  
  //add the header info
?>  
  	
  	<style type="text/css">
		.input_text { margin:0 0 10px 0; background:#f4f4f4; color:#444; width:80%; font-size:11px; padding: 5px;}
		.input_select { margin:0 0 10px 0; background:#f4f4f4; color:#444; width:60%; font-size:11px; padding: 5px;}
		.input_checkbox { margin:0 10px 0 0; }
		.spacer { display: block; height:5px}
		.metabox_desc { font-size:10px; color:#aaa; display:block}
		.metaboxes{ border-collapse:collapse; width:100%}
		.metaboxes tr:hover th,
		.metaboxes tr:hover td { background:#f8f8f8}
		.metaboxes th,
		.metaboxes td{ border-bottom:1px solid #ddd; padding:10px 10px;text-align: left; vertical-align:top}
		.metabox_th { width:20%}
		.input_textarea { width:80%; height:120px;margin:0 0 10px 0; background:#f0f0f0; color:#444;font-size:11px;padding: 5px;}

	</style>
<?php
	// The actual fields for data entry
	$output = '';
	$output .= '<table class="metaboxes">'."\n";
	
    //add video embed code
    $output .= "\t".'<tr>';
    $output .= "\t\t".'<th class="metabox_th"><label for="themeteam_video_embed">Embed Video</label></th>'."\n";
    $output .= "\t\t".'<td><textarea class="input_textarea" name="themeteam_video_embed" id="themeteam_video_embed">'.get_post_meta($post->ID,'themeteam_video_embed',true).'</textarea>';
    $output .= '<span class="metabox_desc">Place the embed code for your video.</span></td>'."\n";
    $output .= "\t".'<td></td></tr>'."\n"; 

  	//text input for video width field
	$output .= "\t".'<tr>';
    $output .= "\t\t".'<th class="metabox_th"><label for="themeteam_video_width">Video Width</label></th>'."\n";
    $output .= "\t\t".'<td><input class="input_text" type="text" value="'.get_post_meta($post->ID,'themeteam_video_width',true).'" name="themeteam_video_width" id="themeteam_video_width"/>';
    $output .= '<span class="metabox_desc">Enter the video width for the embedded video</span></td>'."\n";
    $output .= "\t".'<td></td></tr>'."\n";
    //text input for video height field
	$output .= "\t".'<tr>';
    $output .= "\t\t".'<th class="metabox_th"><label for="themeteam_video_height">Video Height</label></th>'."\n";
    $output .= "\t\t".'<td><input class="input_text" type="text" value="'.get_post_meta($post->ID,'themeteam_video_height',true).'" name="themeteam_video_height" id="themeteam_video_height"/>';
    $output .= '<span class="metabox_desc">Enter the video height for the embedded video</span></td>'."\n";
    $output .= "\t".'<td></td></tr>'."\n";
    
    $output .= '</table>';
  	echo $output;

}


/* When the post is saved, saves our custom data */
function themeteam_save_postdata( $post_id ) {

  // verify this came from the our screen and with proper authorization,
  // because save_post can be triggered at other times

  if ( !wp_verify_nonce( $_POST['themeteam_noncename'], plugin_basename(__FILE__) )) {
    return $post_id;
  }

  // verify if this is an auto save routine. If it is our form has not been submitted, so we dont want
  // to do anything
  if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
    return $post_id;

  
  // Check permissions
  if ( 'page' == $_POST['post_type'] ) {
    if ( !current_user_can( 'edit_page', $post_id ) )
      return $post_id;
  } else {
    if ( !current_user_can( 'edit_post', $post_id ) )
      return $post_id;
  }

  // OK, we're authenticated: we need to find and save the data
  // Do something with $mydata 
  // probably using add_post_meta(), update_post_meta(), or 
  // a custom table (see Further Reading section below)
   if ( 'page' == $_POST['post_type'] ) {
   	update_post_meta($post_id, "themeteam_custom_link", $_POST["themeteam_custom_link"]);
   	update_post_meta($post_id, "themeteam_slider_text", $_POST["themeteam_slider_text"]);
   	update_post_meta($post_id, "themeteam_image_upload", $_POST["themeteam_image_upload"]);
   	//update_post_meta($post_id, "themeteam_header_text", $_POST["themeteam_header_text"]);
   	update_post_meta($post_id, "themeteam_video_embed", $_POST["themeteam_video_embed"]);
   	update_post_meta($post_id, "themeteam_video_width", $_POST["themeteam_video_width"]);
   	update_post_meta($post_id, "themeteam_video_height", $_POST["themeteam_video_height"]);
   }else{
   	update_post_meta($post_id, "themeteam_video_embed", $_POST["themeteam_video_embed"]);
   	update_post_meta($post_id, "themeteam_video_width", $_POST["themeteam_video_width"]);
   	update_post_meta($post_id, "themeteam_video_height", $_POST["themeteam_video_height"]);
   }

}

//for uplaod
  function my_admin_scripts() {
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_register_script('upload_tt', get_bloginfo('template_directory').'/js/admin/upload_tt.js', array('jquery','media-upload','thickbox'));
		wp_enqueue_script('upload_tt');
	}

	function my_admin_styles() {
		wp_enqueue_style('thickbox');
	}


	add_action('admin_print_scripts', 'my_admin_scripts');
	add_action('admin_print_styles', 'my_admin_styles');

?>
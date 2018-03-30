<?php 
add_action('add_meta_boxes', 'multipurpose_page_metaboxes', 10, 2);
add_action('save_post', 'multipurpose_save_display_metabox');

function multipurpose_page_metaboxes() {
	$post_types = array('page', 'post', 'project');
	foreach($post_types as $type) add_meta_box('display-options', 'Display options', 'multipurpose_draw_display_metabox', $type, 'side', 'default');
}

function multipurpose_draw_display_metabox($post) {
	global $post; 
	$data = get_post_custom($post->ID);
	$hide_title = isset($data['hide_title']) ? esc_attr($data['hide_title'][0]) : 0;
	$hide_breadcrumb = isset($data['hide_breadcrumb']) ? esc_attr($data['hide_breadcrumb'][0]) : 0;
	$sidebar_position = isset($data['sidebar_position']) ? esc_attr($data['sidebar_position'][0]) : 0;
	
	//Revolution Slider
	if ( is_plugin_active( 'revslider/revslider.php' ) ) {
		$revolution_slider = isset($data['revolution_slider']) ? esc_attr($data['revolution_slider'][0]) : '';
	}

	wp_nonce_field('multipurpose_display_metabox_nonce', 'display_metabox_nonce'); 
	?>
	<p><label for="hide_title"><?php esc_attr_e('Show title?', 'multipurpose'); ?></label> <select name="hide_title" id="hide_title">
		<option value="0" <?php if($hide_title == 0) echo 'selected="selected"'; ?>>Show</option>
		<option value="1" <?php if($hide_title == 1) echo 'selected="selected"'; ?>>Don't show</option>
	</select></p>
	<p><label for="hide_breadcrumb"><?php esc_attr_e('Show breadcrumb?', 'multipurpose'); ?></label> <select name="hide_breadcrumb" id="hide_breadcrumb">
		<option value="0" <?php if($hide_breadcrumb == 0) echo 'selected="selected"'; ?>>Show</option>
		<option value="1" <?php if($hide_breadcrumb == 1) echo 'selected="selected"'; ?>>Don't show</option>
	</select></p>
	<p><label for="sidebar_position"><?php esc_attr_e('Sidebar position', 'multipurpose'); ?></label> <select name="sidebar_position" id="sidebar_position">
		<option value="0" <?php if($sidebar_position == 0) echo 'selected="selected"'; ?>>Right (default)</option>
		<option value="1" <?php if($sidebar_position == 1) echo 'selected="selected"'; ?>>Left</option>
		<option value="2" <?php if($sidebar_position == 2) echo 'selected="selected"'; ?>>Don't show</option>
		<option value="3" <?php if($sidebar_position == 3) echo 'selected="selected"'; ?>>As set in Theme Customizer</option>
	</select></p>

	<?php
	//Revolution Slider
	if ( is_plugin_active( 'revslider/revslider.php' ) ) {
		$slider = new RevSlider();
		// Array of current slider "alias" names
		$arrSliders = $slider->getArrSlidersShort();
?>
		<p><label for="revolution_slider"><?php esc_attr_e('Revolution Slider', 'multipurpose'); ?></label> <select name="revolution_slider" id="revolution_slider">
			<option value="" <?php if($revolution_slider == '') echo 'selected="selected"'; ?>>None</option>
			<?php foreach($arrSliders as $rev_id => $rev_slider) { ?>
    		<option value="<?php echo esc_attr( $rev_id );?>" <?php if($revolution_slider == $rev_id) echo 'selected="selected"'; ?>><?php echo esc_attr($rev_slider);?></option>
			<?php } ?>
		</select></p>
	<?php
	}//end of Revolution Slider	
}

function multipurpose_save_display_metabox($page_id) {
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
	if(!isset($_POST['display_metabox_nonce']) || !wp_verify_nonce($_POST['display_metabox_nonce'], 'multipurpose_display_metabox_nonce' )) return; 
	if(!current_user_can('edit_pages', $page_id)) return; 

	if(isset($_POST['hide_title'])) {
		update_post_meta($page_id, 'hide_title', strip_tags($_POST['hide_title']));
	}
	if(isset($_POST['hide_breadcrumb'])) {
		update_post_meta($page_id, 'hide_breadcrumb', strip_tags($_POST['hide_breadcrumb']));
	}
	if(isset($_POST['sidebar_position'])) {
		update_post_meta($page_id, 'sidebar_position', strip_tags($_POST['sidebar_position']));
	}
	//Revolution Slider
	if ( is_plugin_active( 'revslider/revslider.php' ) ) {
		if(isset($_POST['revolution_slider'])) {
			update_post_meta($page_id, 'revolution_slider', strip_tags($_POST['revolution_slider']));
		}
	}//end of Revolution Slider
}

// video field


add_action('add_meta_boxes', 'multipurpose_post_metaboxes', 1, 2);
add_action('save_post', 'multipurpose_save_display_post_metabox');

function multipurpose_post_metaboxes() {
    $post_types = array('post');
    foreach($post_types as $type) add_meta_box('video-embed-code', 'Video embed code', 'multipurpose_draw_display_post_metabox', $type, 'normal', 'default');
}

function multipurpose_draw_display_post_metabox($post) {
    global $post; 
    $data = get_post_custom($post->ID);
    $video_iframe = isset($data['single_meta_video_iframe']) ?  $data['single_meta_video_iframe'][0] : '';

    wp_nonce_field('multipurpose_video_nonce', 'video_nonce'); 
    ?>    

  <p><label for="single_video_iframe"><?php esc_attr_e('Video iframe (YouTube, Vimeo)', 'multipurpose'); ?></label><textarea name="single_video_iframe" id="single_video_iframe" rows="5" cols="30" class="widefat"><?php echo $video_iframe;?></textarea></p>


<?php    
    } 

    function multipurpose_save_display_post_metabox($page_id) {
    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if(!isset($_POST['video_nonce']) || !wp_verify_nonce($_POST['video_nonce'], 'multipurpose_video_nonce' )) return; 
    if(!current_user_can('edit_pages', $page_id)) return; 

    if(isset($_POST['single_video_iframe'])) {
    	update_post_meta($page_id, 'single_meta_video_iframe', $_POST['single_video_iframe']);
    }
}

?>
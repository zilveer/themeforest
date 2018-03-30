<?php
/* ------------------------------------------------------------------------ */
/* Extra Fields.  */
/* ------------------------------------------------------------------------ */
add_action('admin_init', 'extra_fields', 1);
function extra_fields() {
	add_meta_box( 'extra_fields', 'Additional Settings', 'extra_fields_for_blog', 'post', 'normal', 'high'  );
	add_meta_box( 'extra_fields', 'Additional settings', 'extra_fields_for_pages', 'page', 'normal', 'high'  );
}
@the_post_thumbnail();
@wp_link_pages( $args );
@comments_template( $file, $separate_comments );
@add_theme_support( 'automatic-feed-links' );
@add_theme_support( 'custom-header', $args );
@add_theme_support( 'custom-background', $args );



//Extra Field for Blog
function extra_fields_for_blog( $post ){
	?>
    
	<div id="oi_admin_for_video">
    <h4><?php _e('Video code','orangeidea')?></h4>
    <div>
        <p>
        <textarea rows="10" style="width:600px;" type="text" name="extra[video]" value="<?php echo esc_textarea(get_post_meta($post->ID, 'video', true)); ?>" ><?php echo esc_textarea(get_post_meta($post->ID, 'video', true)); ?></textarea>
        </p>
    </div>
    </div>
    
    <div id="oi_admin_for_audio">
    <h4><?php _e('Past here your audio iframe','orangeidea')?></h4>
    <div>
    <p>
    <textarea rows="10" style="width:600px;" type="text" name="extra[audio]" value="<?php echo esc_textarea(get_post_meta($post->ID, 'audio', true)); ?>" ><?php echo esc_textarea(get_post_meta($post->ID, 'audio', true)); ?></textarea>
	</p>
    </div>
    </div>
    <div id="oi_admin_for_gallery">
        <h4><?php _e('Gallery Type?','orangeidea')?></h4>
 		<select name="extra[oi_gallery_type]">
			<?php $oi_gallery_type_array = array(
                '1' => 'Grid',
                '2' => 'Slider',
                );?>
            <?php foreach ($oi_gallery_type_array as $val){ ?>
            <option <?php if ($val == get_post_meta($post->ID, 'oi_gallery_type', 1)) { echo 'selected';} ?> value="<?php echo $val ?>"><?php echo $val ?></option>
            <?php } ?>
    	</select>
         <h4><?php _e('Images per Row?','orangeidea')?></h4>
        <select name="extra[oi_gallery_per_row]">
			<?php $oi_gallery_per_row = array(
                'col-md-6' => '2 Images',
				'col-md-4' => '3 Images',
                'col-md-3' => '4 Images',
                );?>
            <?php foreach ($oi_gallery_per_row as $val){ ?>
            <option <?php if ($val == get_post_meta($post->ID, 'oi_gallery_per_row', 1)) { echo 'selected';} ?> value="<?php echo $val ?>"><?php echo $val ?></option>
            <?php } ?>
    	</select>
        <h4><?php _e('Upload Images','orangeidea')?></h4>
        <div>
            <p>
                <input id="upload_image" type="hidden" style="width:70%;" name="extra[image]" value="<?php echo get_post_meta($post->ID, 'image', true); ?>" />
                <input id="upload_image_url" type="hidden" style="width:70%;" name="extra[image_url]" value="<?php echo get_post_meta($post->ID, 'image_url', true); ?>" />
                <input class="upload_image_button" type="button" value="Add Image" /><br/>
            </p>
            <p id="upload_images">
            </p>
        </div>
    </div>
    
     <?php };

    




//Extra Field for Pages
function extra_fields_for_pages( $post ){
?>
    <div style="padding:20px; border:1px solid #eaeaea; background:#f6f6f6; margin:20px;">
    <h4><?php _e('You can use any sidebar, just choose it','orangeidea')?></h4>
    <?php global $wp_registered_sidebars;
	?>
    <select name="extra[sidebarss]">
    <?php foreach ($wp_registered_sidebars as $val){ ?>
    <option <?php if ($val['id'] == get_post_meta($post->ID, 'sidebarss', 1)) { echo 'selected';} ?> value="<?php echo $val['id'] ?>"><?php echo $val['name'] ?></option>
	<?php } ?>
    </select>
    <br>
  <h4><?php _e('SideBar Position','orangeidea')?></h4>
  <select name="extra[sidebarss_position]">
  	<?php
	$oi_sidebars_position = array (
		"rs"  => array("name" => "Right Sidebar"),
		"ls"  => array("name" => "Left Sidebar"),
	);
	?>
    <?php foreach ($oi_sidebars_position as $val){ ?>
    <option <?php if ($val['name'] == get_post_meta($post->ID, 'sidebarss_position', 1)) { echo 'selected';} ?> value="<?php echo $val['name'] ?>"><?php echo $val['name'] ?></option>
	<?php } ?>
   </select>
    <h4><?php _e('Show TagLine on this page?','orangeidea')?></h4>
    <select name="extra[oi_tagline]">
    <?php $oi_tagline_array = array(
		'yes' => 'yes',
		'no' => 'no',
		);?>
    <?php foreach ($oi_tagline_array as $val){ ?>
    <option <?php if ($val == get_post_meta($post->ID, 'oi_tagline', 1)) { echo 'selected';} ?> value="<?php echo esc_attr($val) ?>"><?php echo esc_attr($val) ?></option>
	<?php } ?>
    </select>
    </div>
<?php }



//Save Extra Fields
add_action('save_post', 'extra_fields_update', 0);


function extra_fields_update( $post_id ){
	
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE  ) return false; 
	if ( !current_user_can('edit_post', $post_id) ) return false; 
	if( !isset($_POST['extra']) ) return false;	

	
	$_POST['extra'] = array_map('trim', $_POST['extra']);
	foreach( $_POST['extra'] as $key=>$value ){
		if( empty($value) )	delete_post_meta($post_id, $key);
		update_post_meta($post_id, $key, $value);
	}
	return $post_id;
}


function upload_scripts() {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_register_script('my-upload', get_template_directory_uri().'/framework/js/custom_uploader.js', array('jquery','media-upload','thickbox'));
	wp_enqueue_script('my-upload');
}



function upload_styles() {
	wp_enqueue_style('thickbox');
}
add_action('admin_enqueue_scripts', 'upload_scripts'); 
add_action('admin_enqueue_scripts', 'upload_styles');





// Customize the search form
function style_search_form($form) {
    $form = '<form method="get" id="searchform" action="' . home_url() . '/" >
            <div class="row">';
    if (is_search()) {
        $form .='<div class="col-md-12"><input type="hidden" name="post_type" value="post" /><input type="text" value="' . apply_filters('the_search_query', get_search_query()) . '" name="s" id="s" /></div>';
    } else {
        $form .='<div class="col-md-12"><input type="hidden" name="post_type" value="post" /><input type="text" value="'.__('Search','orangeidea').' " name="s" id="s"  onfocus="if(this.value==this.defaultValue)this.value=\'\';" onblur="if(this.value==\'\')this.value=this.defaultValue;"/></div>';
    }
    $form .= '</div></form>';
    return $form;
}
add_filter('get_search_form', 'style_search_form');

function remove_more_jump_link($link) { 
	$offset = strpos($link, '#more-');
	if ($offset) { $end = strpos($link, '"',$offset); }
	if ($end) { $link = substr_replace($link, '', $offset, $end-$offset); }
	return $link;
}
add_filter('the_content_more_link', 'remove_more_jump_link');



/**
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 */
if ( is_singular() ) wp_enqueue_script( "comment-reply" );
add_theme_support( "title-tag" );


?>
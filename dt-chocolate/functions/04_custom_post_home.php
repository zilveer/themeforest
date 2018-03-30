<?php
/* post type for main slider */
$labels = array(
	'name'					=>_x('Sliders', 'post type general name', LANGUAGE_ZONE),
	'singular_name'			=>_x('Slider', 'post type singular name', LANGUAGE_ZONE),
	'add_new'				=>_x('Add New', 'post type new', LANGUAGE_ZONE),
	'add_new_item'			=>__('Add New Item', LANGUAGE_ZONE),
	'edit_item'				=>__('Edit Item', LANGUAGE_ZONE),
	'new_item'				=>__('New Item', LANGUAGE_ZONE),
	'view_item'				=>__('View Item', LANGUAGE_ZONE),
	'search_items'			=>__('Search Items', LANGUAGE_ZONE),
	'not_found'				=>__('No Items found', LANGUAGE_ZONE),
	'not_found_in_trash'	=>__('No Items found in Trash', LANGUAGE_ZONE), 
	'parent_item_colon'		=>'',
	'menu_name'				=>'Sliders'
);
$args = array(
	'labels'				=>$labels,
	'public'				=>false,
	'publicly_queryable'	=>false,
	'show_ui'				=>true, 
	'show_in_menu'			=>true, 
	'query_var'				=>true,
	'rewrite'				=>false,
	'capability_type' 		=>'post',
	'has_archive'			=>false, 
	'hierarchical'			=>false,
	'menu_position'			=>30,
	'menu_icon'				=>get_template_directory_uri().'/images/admin_ico_slides.png',
	'supports'				=>array( 'thumbnail', 'title' )
);
register_post_type( 'main_slider', $args);

/* Define the custom box */

// WP 3.0+
add_action( 'add_meta_boxes', 'slider_meta_box' );
//add_action( 'save_post', 'slider_save_postdata' );
add_action( 'save_post', 'dt_home_slider_save' );
add_action( 'save_post', 'dt_home_slider_new_save' );
add_action( 'save_post', 'dt_home_slider_3d_save' );
add_action( 'save_post', 'dt_home_static_save' );
add_action( 'save_post', 'dt_home_video_save' );

/* Adds a box to the main column on the Post and Page edit screens */
function slider_meta_box() {
/*	add_meta_box ( 
		'Slider link',
		__( 'Slider options', LANGUAGE_ZONE ),
		'slider_meta_block',
		'main_slider',
		'side'
	);
*/
		add_meta_box(
			'dt_page_box-homeslider',
			__( 'Options for Classical Chocolate Slider', LANGUAGE_ZONE ),
			'dt_home_slider_options',
			'page',
			'side',
			'low'
		);
		
		add_meta_box(
			'dt_page_box-homeslider_new',
			__( 'Options for Supersized Slider', LANGUAGE_ZONE ),
			'dt_home_slider_new_options',
			'page',
			'side',
			'low'
		);
		
		add_meta_box(
			'dt_page_box-homeslider_3d',
			__( 'Options for 3D Slider', LANGUAGE_ZONE ),
			'dt_home_slider_3d_options',
			'page',
			'side',
			'low'
		);

		add_meta_box( 
			'dt_page_box-homestatic',
			__( 'Options for Static', LANGUAGE_ZONE ),
			'dt_home_slider_static_options',
			'page',
			'side'
		);

		add_meta_box(
			'dt_page_box-homevideo',
			__( 'Options for Video', LANGUAGE_ZONE ),
			'dt_home_slider_video_options',
			'page',
			'side'
		);

    add_meta_box(
        'dt_slider-uploader',
        _x( 'Slides', 'backend slider', LANGUAGE_ZONE ),
        'dt_metabox_slider_uploader',
        'main_slider',
        'normal',
        'high'
    );
		
		add_action('admin_enqueue_scripts', 'my_admin_scripts');
		add_action('admin_print_styles', 'my_admin_styles');
}

/* Prints the box content */
/*			function slider_meta_block( $post ) {
	// Use nonce for verification
	wp_nonce_field( plugin_basename( __FILE__ ), 'slider_noncename' );

	// serialized array returned and userialized...
	$value = get_post_meta( $post->ID, 'slider_meta', true );
	
	$s_link = isset( $value['link'] )?trim( $value['link'] ):'';
	$s_hide_text = '';
	if( isset( $value['hide_text'] ) )
		$s_hide_text = !empty( $value['hide_text'] )?' checked':'';
	
	echo '<input type="text" id="slider_link" name="slider_link" value="' . $s_link . '" size="43" />';
	echo '<label for="slider_link">'. __('Slider link', LANGUAGE_ZONE). '</label>';
	echo '<p>';
	echo '<input type="checkbox" id="slider_hide_text" name="slider_hide_text"' . $s_hide_text . '/>' . __( 'Hide post text in the side box of slide', LANGUAGE_ZONE );
	echo '</p>';
}
*/

/* When the post is saved, saves our custom data */
/*	function slider_save_postdata( $post_id ) {
	// verify if this is an auto save routine. 
	// If it is our form has not been submitted, so we dont want to do anything
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		return;

	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times

	if ( !isset( $_POST['slider_noncename'] ) || !wp_verify_nonce( $_POST['slider_noncename'], plugin_basename( __FILE__ ) ) )
		return;

	// Check permissions
	if ( !current_user_can( 'edit_post', $post_id ) )
		return;

	// OK, we're authenticated: we need to find and save the data
	$mydata = array();
	$mydata['link'] = esc_url_raw( $_POST['slider_link'] );
	$mydata['hide_text'] = isset( $_POST['slider_hide_text'] );

	update_post_meta( $post_id, 'slider_meta', $mydata );
}
*/

// SLIDER METABOX
function dt_home_slider_options( $post ) {
	// NAME OF THE BOX !
	$box_name = 'homeslider';
	
	$img_h = $img_w = 107;

	$filter = get_post_meta( $post->ID, 'dt_'.$box_name.'_options', true );
	$filter = wp_parse_args(
		$filter,
		array(
			'dt_hide_over_mask'		=> false,
			'dt_interval'			=> 5000
		)
	);

	$result = dt_get_sliders_info();
	$posts = $result['posts'];
	$counts = $result['counts'];
	
	$sel = isset($filter['show'])?$filter['show']:'all';
	
	// Use nonce for verification
	wp_nonce_field( plugin_basename( __FILE__ ), $box_name.'_noncename' );

	// The actual fields for data entry
	?>
	<p>
		<input type="text" id="dt_interval_<?php echo $box_name; ?>" name="dt_interval_<?php echo $box_name; ?>" value="<?php echo esc_attr($filter['dt_interval']); ?>"/>
		<label for="dt_interval_<?php echo $box_name; ?>"><?php _e("Interval (msec)", LANGUAGE_ZONE ); ?></label>
	</p>
	<p>
		<input type="checkbox" id="dt_hide_over_mask_<?php echo $box_name; ?>" name="dt_hide_over_mask_<?php echo $box_name; ?>"<?php checked($filter['dt_hide_over_mask']); ?>/>
		<label for="dt_hide_over_mask_<?php echo $box_name; ?>"><?php _e("Hide overlay mask", LANGUAGE_ZONE ); ?></label>
	</p>
	<p>
		<?php _e( 'Show:', LANGUAGE_ZONE ); ?>
	</p>
	<div class="showhide">
		<label>
			<input name="show_type_<?php echo $box_name; ?>" value="all"<?php checked('all' == $sel); ?> type="radio">
			<?php _e( 'All', LANGUAGE_ZONE ); ?>
		</label>
		<br/>
	</div>
	<div class="showhide">
		<label>
			<input name="show_type_<?php echo $box_name; ?>"<?php checked('only' == $sel); ?> value="only" type="radio">
			<?php _e( 'Only...', LANGUAGE_ZONE ); ?>
		</label>
		<br/>
		<div style="margin-left: 20px; margin-bottom: 8px; display: none;" class="list">
		<?php
		if( $posts ):	foreach( $posts as $p ):
			$checked = isset($filter['show_'. $box_name. '_only']) && isset($filter['show_'. $box_name. '_only'][$p->ID]);
		?>
			<label style="width: <?php echo $img_w; ?>px;display: inline-block;margin-bottom: 3px;">
				<img width="<?php echo $img_w; ?>" height="<?php echo $img_h; ?>" src="<?php echo esc_url($p->dt_thumbnail); ?>" title="<?php echo $p->dt_info; echo isset($counts[$p->ID])?$counts[$p->ID]:''; ?>"/><br/>
				<div style="height: 30px;overflow: hidden;background-color: #D7D7D7;">
					<input name="show_<?php echo $box_name; ?>_only[<?php echo $p->ID; ?>]" value="<?php echo $p->ID; ?>" type="checkbox"<?php checked($checked); ?>>
					<?php echo apply_filters('the_title', $p->post_title); ?>
				</div>
			</label>
		<?php endforeach; endif; ?>
		</div>
	</div>
	<div class="showhide">
		<label>
			<input name="show_type_<?php echo $box_name; ?>"<?php checked('except' == $sel); ?> value="except" type="radio">
			<?php _e( 'Except...', LANGUAGE_ZONE ); ?>
		</label>
		<br/>
		<div style="margin-left: 20px; margin-bottom: 8px; display: none;" class="list">
		<?php
		if( $posts ):	foreach( $posts as $p ):
			$checked = isset($filter['show_'. $box_name. '_except']) && isset($filter['show_'. $box_name. '_except'][$p->ID]);
		?>
			<label style="width: <?php echo $img_w; ?>px;display: inline-block;">
				<img width="<?php echo $img_w; ?>" height="<?php echo $img_h; ?>" src="<?php echo $p->dt_thumbnail; ?>" title="<?php echo $p->dt_info; echo isset($counts[$p->ID])?$counts[$p->ID]:''; ?>"/><br/>
				<div style="height: 30px;overflow: hidden;background-color: #D7D7D7;">
					<input name="show_<?php echo $box_name; ?>_except[<?php echo $p->ID; ?>]" value="<?php echo $p->ID; ?>" type="checkbox"<?php checked($checked); ?>>
					<?php echo apply_filters('the_title', $p->post_title); ?>
				</div>
			</label>
		<?php endforeach; endif; ?>
		</div>
	</div>
<?php
}

// SLIDER SAVE
function dt_home_slider_save( $post_id ) {
	// NAME OF THE BOX !
	$box_name = 'homeslider';
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
	$mydata['dt_hide_over_mask'] = isset($_POST['dt_hide_over_mask_'.$box_name]);
	$mydata['show'] = strip_tags($_POST['show_type_'.$box_name]);
	if( 'all' != $mydata['show'] && isset($_POST['show_'. $box_name. '_'. $mydata['show']]) ) {
		$mydata['show_'. $box_name. '_'. $mydata['show']] = $_POST['show_'. $box_name. '_'. $mydata['show']];
	}elseif( 'all' != $mydata['show'] ) {
		$mydata['show'] = 'all';
	}
	$mydata['dt_interval'] = intval($_POST['dt_interval_'.$box_name]);
//	$mydata['dt_autoplay'] = isset($_POST['dt_autoplay']);
	
	update_post_meta( $post_id, 'dt_'.$box_name.'_options', $mydata );
}

// NEW SLIDER METABOX
function dt_home_slider_new_options( $post ) {
	// NAME OF THE BOX !
	$box_name = 'homeslider_new';
	
	$img_h = $img_w = 107;
	$transitions = array(
		0	=>'None',
		1	=>'Fade',
		2	=>'Slide Top',
		3	=>'Slide Right',
		4	=>'Slide Bottom',
		5	=>'Slide Left',
		6	=>'Carousel Right',
		7	=>'Carousel Left'
	);
	
	$filter = get_post_meta( $post->ID, 'dt_'.$box_name.'_options', true );
	$filter = wp_parse_args(
		$filter,
		array(
			'dt_hide_over_mask'		=>false,
			'dt_interval'			=>5000,
			'dt_autoplay'			=>true,
			'portrait'				=>true,
			'landscape'				=>false,
			'dt_transition'			=>3
		)
	);
	
	$result = dt_get_sliders_info();
	$posts = $result['posts'];
	$counts = $result['counts'];
	
	$sel = isset($filter['show'])?$filter['show']:'all';
	
	// Use nonce for verification
	wp_nonce_field( plugin_basename( __FILE__ ), $box_name.'_noncename' );

	// The actual fields for data entry
	?>
	<p>
		<?php _e("Transition", LANGUAGE_ZONE ); ?><br/>
		<select id="dt_transition_<?php echo $box_name; ?>" name="dt_transition_<?php echo $box_name; ?>">
			<?php foreach( $transitions as $val=>$name ): ?>
				<option value="<?php echo esc_attr($val); ?>"<?php selected($val, $filter['dt_transition']); ?>>
					<?php echo $name; ?>
				</option>
			<?php endforeach;?>
		</select>
	</p>
	
	<p>
		<input type="text" id="dt_interval_<?php echo $box_name; ?>" name="dt_interval_<?php echo $box_name; ?>" value="<?php echo esc_attr($filter['dt_interval']); ?>"/>
		<label for="dt_interval_<?php echo $box_name; ?>"><?php _e("Interval (msec)", LANGUAGE_ZONE ); ?></label>
	</p>
	
	<p>
		<input type="checkbox" id="dt_autoplay_<?php echo $box_name; ?>" name="dt_autoplay_<?php echo $box_name; ?>"<?php checked($filter['dt_autoplay']); ?>/>
		<label for="dt_autoplay_<?php echo $box_name; ?>"><?php _e("Autoplay", LANGUAGE_ZONE ); ?></label>
	</p>
	
	<p>
		<input type="checkbox" id="dt_hide_over_mask_<?php echo $box_name; ?>" name="dt_hide_over_mask_<?php echo $box_name; ?>"<?php checked($filter['dt_hide_over_mask']); ?>/>
		<label for="dt_hide_over_mask_<?php echo $box_name; ?>"><?php _e("Hide overlay mask", LANGUAGE_ZONE ); ?></label>
	</p>
	
	<p>
		<input type="checkbox" id="portrait_<?php echo $box_name; ?>" name="portrait_<?php echo $box_name; ?>"<?php checked($filter['portrait']); ?>/>
		<label for="portrait_<?php echo $box_name; ?>"><?php _e("Portrait images will not exceed browser height", LANGUAGE_ZONE ); ?></label>
	</p>
	
	<p>
		<input type="checkbox" id="landscape_<?php echo $box_name; ?>" name="landscape_<?php echo $box_name; ?>"<?php checked($filter['landscape']); ?>/>
		<label for="landscape_<?php echo $box_name; ?>"><?php _e("Landscape images will not exceed browser width", LANGUAGE_ZONE ); ?></label>
	</p>
	
	<p>
		<?php _e( 'Show:', LANGUAGE_ZONE ); ?>
	</p>
	
	<div class="showhide">
		<label>
			<input name="show_type_<?php echo $box_name; ?>" value="all"<?php checked('all' == $sel); ?> type="radio">
			<?php _e( 'All', LANGUAGE_ZONE ); ?>
		</label>
		<br/>
	</div>
	<div class="showhide">
		<label>
			<input name="show_type_<?php echo $box_name; ?>"<?php checked('only' == $sel); ?> value="only" type="radio">
			<?php _e( 'Only...', LANGUAGE_ZONE ); ?>
		</label>
		<br/>
		<div style="margin-left: 20px; margin-bottom: 8px; display: none;" class="list">
		<?php
		if( $posts ):	foreach( $posts as $p ):
			$checked = isset($filter['show_'. $box_name. '_only']) && isset($filter['show_'. $box_name. '_only'][$p->ID]);
		?>
			<label style="width: <?php echo $img_w; ?>px;display: inline-block;margin-bottom: 3px;">
				<img width="<?php echo $img_w; ?>" height="<?php echo $img_h; ?>" src="<?php echo esc_url($p->dt_thumbnail); ?>" title="<?php echo $p->dt_info;echo isset($counts[$p->ID])?$counts[$p->ID]:''; ?>"/><br/>
				<div style="height: 30px;overflow: hidden;background-color: #D7D7D7;">
					<input name="show_<?php echo $box_name; ?>_only[<?php echo $p->ID; ?>]" value="<?php echo $p->ID; ?>" type="checkbox"<?php checked($checked); ?>>
					<?php echo apply_filters('the_title', $p->post_title); ?>
				</div>
			</label>
		<?php endforeach; endif; ?>
		</div>
	</div>
	<div class="showhide">
		<label>
			<input name="show_type_<?php echo $box_name; ?>"<?php checked('except' == $sel); ?> value="except" type="radio">
			<?php _e( 'Except...', LANGUAGE_ZONE ); ?>
		</label>
		<br/>
		<div style="margin-left: 20px; margin-bottom: 8px; display: none;" class="list">
		<?php
		if( $posts ):	foreach( $posts as $p ):
			$checked = isset($filter['show_'. $box_name. '_except']) && isset($filter['show_'. $box_name. '_except'][$p->ID]);
		?>
			<label style="width: <?php echo $img_w; ?>px;display: inline-block;">
				<img width="<?php echo $img_w; ?>" height="<?php echo $img_h; ?>" src="<?php echo $p->dt_thumbnail; ?>" title="<?php echo $p->dt_info;echo isset($counts[$p->ID])?$counts[$p->ID]:''; ?>"/><br/>
				<div style="height: 30px;overflow: hidden;background-color: #D7D7D7;">
					<input name="show_<?php echo $box_name; ?>_except[<?php echo $p->ID; ?>]" value="<?php echo $p->ID; ?>" type="checkbox"<?php checked($checked); ?>>
					<?php echo apply_filters('the_title', $p->post_title); ?>
				</div>
			</label>
		<?php endforeach; endif; ?>
		</div>
	</div>
<?php
}

// NEW SLIDER SAVE
function dt_home_slider_new_save( $post_id ) {
	// NAME OF THE BOX !
	$box_name = 'homeslider_new';
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
	$mydata['dt_hide_over_mask'] = isset($_POST['dt_hide_over_mask_'.$box_name]);
	$mydata['show'] = strip_tags($_POST['show_type_'.$box_name]);
	if( 'all' != $mydata['show'] && isset($_POST['show_'. $box_name. '_'. $mydata['show']]) ) {
		$mydata['show_'. $box_name. '_'. $mydata['show']] = $_POST['show_'. $box_name. '_'. $mydata['show']];
	}elseif( 'all' != $mydata['show'] ) {
		$mydata['show'] = 'all';
	}
	$mydata['dt_interval'] = intval($_POST['dt_interval_'.$box_name]);
	$mydata['dt_autoplay'] = isset($_POST['dt_autoplay_'.$box_name]);
	$mydata['dt_transition'] = intval($_POST['dt_transition_'.$box_name]);
	$mydata['portrait'] = isset($_POST['portrait_'.$box_name]);
	$mydata['landscape'] = isset($_POST['landscape_'.$box_name]);
	
	update_post_meta( $post_id, 'dt_'.$box_name.'_options', $mydata );
}

// 3D SLIDER METABOX
function dt_home_slider_3d_options( $post ) {
	// NAME OF THE BOX !
	$box_name = 'homeslider_3d';
	
	$img_h = $img_w = 107;
	
	$result = dt_get_sliders_info();
	$posts = $result['posts'];
	$counts = $result['counts'];
	
	$sel = isset($filter['show'])?$filter['show']:'all';
	
	// Use nonce for verification
	wp_nonce_field( plugin_basename( __FILE__ ), $box_name.'_noncename' );

	// The actual fields for data entry
	?>

	<p>
		<?php _e( 'Show:', LANGUAGE_ZONE ); ?>
	</p>
	
	<div class="showhide">
		<label>
			<input name="show_type_<?php echo $box_name; ?>" value="all"<?php checked('all' == $sel); ?> type="radio">
			<?php _e( 'All', LANGUAGE_ZONE ); ?>
		</label>
		<br/>
	</div>
	<div class="showhide">
		<label>
			<input name="show_type_<?php echo $box_name; ?>"<?php checked('only' == $sel); ?> value="only" type="radio">
			<?php _e( 'Only...', LANGUAGE_ZONE ); ?>
		</label>
		<br/>
		<div style="margin-left: 20px; margin-bottom: 8px; display: none;" class="list">
		<?php
		if( $posts ):	foreach( $posts as $p ):
			$checked = isset($filter['show_'. $box_name. '_only']) && isset($filter['show_'. $box_name. '_only'][$p->ID]);
		?>
			<label style="width: <?php echo $img_w; ?>px;display: inline-block;margin-bottom: 3px;">
				<img width="<?php echo $img_w; ?>" height="<?php echo $img_h; ?>" src="<?php echo esc_url($p->dt_thumbnail); ?>" title="<?php echo $p->dt_info;echo isset($counts[$p->ID])?$counts[$p->ID]:''; ?>"/><br/>
				<div style="height: 30px;overflow: hidden;background-color: #D7D7D7;">
					<input name="show_<?php echo $box_name; ?>_only[<?php echo $p->ID; ?>]" value="<?php echo $p->ID; ?>" type="checkbox"<?php checked($checked); ?>>
					<?php echo apply_filters('the_title', $p->post_title); ?>
				</div>
			</label>
		<?php endforeach; endif; ?>
		</div>
	</div>
	<div class="showhide">
		<label>
			<input name="show_type_<?php echo $box_name; ?>"<?php checked('except' == $sel); ?> value="except" type="radio">
			<?php _e( 'Except...', LANGUAGE_ZONE ); ?>
		</label>
		<br/>
		<div style="margin-left: 20px; margin-bottom: 8px; display: none;" class="list">
		<?php
		if( $posts ):	foreach( $posts as $p ):
			$checked = isset($filter['show_'. $box_name. '_except']) && isset($filter['show_'. $box_name. '_except'][$p->ID]);
		?>
			<label style="width: <?php echo $img_w; ?>px;display: inline-block;">
				<img width="<?php echo $img_w; ?>" height="<?php echo $img_h; ?>" src="<?php echo $p->dt_thumbnail; ?>" title="<?php echo $p->dt_info;echo isset($counts[$p->ID])?$counts[$p->ID]:''; ?>"/><br/>
				<div style="height: 30px;overflow: hidden;background-color: #D7D7D7;">
					<input name="show_<?php echo $box_name; ?>_except[<?php echo $p->ID; ?>]" value="<?php echo $p->ID; ?>" type="checkbox"<?php checked($checked); ?>>
					<?php echo apply_filters('the_title', $p->post_title); ?>
				</div>
			</label>
		<?php endforeach; endif; ?>
		</div>
	</div>
<?php
}

// 3D SLIDER SAVE
function dt_home_slider_3d_save( $post_id ) {
	// NAME OF THE BOX !
	$box_name = 'homeslider_3d';
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

	$mydata['show'] = strip_tags($_POST['show_type_'.$box_name]);
	if( 'all' != $mydata['show'] && isset($_POST['show_'. $box_name. '_'. $mydata['show']]) ) {
		$mydata['show_'. $box_name. '_'. $mydata['show']] = $_POST['show_'. $box_name. '_'. $mydata['show']];
	}elseif( 'all' != $mydata['show'] ) {
		$mydata['show'] = 'all';
	}
	
	update_post_meta( $post_id, 'dt_'.$box_name.'_options', $mydata );
}

// VIDEO METABOX
function dt_home_slider_video_options( $post ) {
	// NAME OF THE BOX !
	$box_name = 'homevideo';
	
	$data = get_post_meta( $post->ID, 'dt_'. $box_name. '_options', true );
	$data = wp_parse_args(
		$data,
		array(
			'dt_vid_autoplay'	=>false,
			'dt_vid_loop'		=>false,
			'dt_hide_desc'		=>false,
//			'dt_hide_over_mask'	=>false			
		)
	);
	$dt_video = isset( $data['dt_video'] )?$data['dt_video']:'';
	$dt_link = isset( $data['dt_link'] )?trim( $data['dt_link'] ):'';

	$u_href = get_admin_url();
	$u_href .= '/media-upload.php?post_id='. $post->ID;
	$u_href .= '&type=image&amp;TB_iframe=true';
	
	// Use nonce for verification
	wp_nonce_field( plugin_basename( __FILE__ ), $box_name.'_noncename' );

	// The actual fields for data entry
	?>
	<p>
		<label for="dt_video">
			<?php _e("Video url", LANGUAGE_ZONE ); ?>
		</label>
		<input id="dt_video" type="text" name="dt_video_<?php echo $box_name; ?>" value="<?php echo esc_attr($dt_video); ?>" size="46"/>
	</p>
		<a id="upload_image_button" class="upload_button button" href="<?php echo esc_url( $u_href ); ?>"><?php _e('Upload', LANGUAGE_ZONE); ?></a>
		<a id="remove_image_button" class="upload_button button" href="#"><?php _e( 'Remove', LANGUAGE_ZONE ); ?></a>
		<hr>
	<p>
		<label for="dt_vid_autoplay_<?php echo $box_name; ?>">
			<input type="checkbox" id="dt_vid_autoplay_<?php echo $box_name; ?>" name="dt_vid_autoplay_<?php echo $box_name; ?>"<?php checked($data['dt_vid_autoplay']); ?>/>
			<?php _e("Autoplay", LANGUAGE_ZONE ); ?>
		</label>
	</p>
	<p>
		<label for="dt_vid_loop_<?php echo $box_name; ?>">
			<input type="checkbox" id="dt_vid_loop_<?php echo $box_name; ?>" name="dt_vid_loop_<?php echo $box_name; ?>"<?php checked($data['dt_vid_loop']); ?>/>
			<?php _e("Repeat", LANGUAGE_ZONE ); ?>
		</label>
	</p>
	<p>
		<label for="dt_hide_desc_<?php echo $box_name; ?>">
			<input type="checkbox" id="dt_hide_desc_<?php echo $box_name; ?>" name="dt_hide_desc_<?php echo $box_name; ?>"<?php checked($data['dt_hide_desc']); ?>/>
			<?php _e("Hide description", LANGUAGE_ZONE ); ?>
		</label>
	</p>
	<?php
/*
	<p>
		<label for="dt_hide_over_mask_<?php echo $box_name; ?>">
			<input type="checkbox" id="dt_hide_over_mask_<?php echo $box_name; ?>" name="dt_hide_over_mask_<?php echo $box_name; ?>"<?php checked($data['dt_hide_over_mask']); ?>/>
			<?php _e("Hide overlay mask", LANGUAGE_ZONE ); ?>
		</label>
	</p>
*/
	?>
	<p>
		<label for="dt_link_<?php echo $box_name; ?>"><?php _e('Details link', LANGUAGE_ZONE ); ?></label>
		<input type="text" id="dt_link_<?php echo $box_name; ?>" name="dt_link_<?php echo $box_name; ?>" value="<?php echo esc_attr($dt_link); ?>" size="46" />
	</p>
	<?php
}

// VIDEO SAVE FUNK
function dt_home_video_save( $post_id ) {
	// NAME OF THE BOX !
	$box_name = 'homevideo';
	
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
	$mydata['dt_video'] = isset($_POST['dt_video_'.$box_name])?esc_url_raw($_POST['dt_video_'.$box_name]):null;
	$mydata['dt_hide_desc'] = isset($_POST['dt_hide_desc_'.$box_name]);
//	$mydata['dt_hide_over_mask'] = isset($_POST['dt_hide_over_mask_'.$box_name]);
	$mydata['dt_vid_autoplay'] = isset($_POST['dt_vid_autoplay_'.$box_name]);
	$mydata['dt_vid_loop'] = isset($_POST['dt_vid_loop_'.$box_name]);
	$mydata['dt_link'] = esc_url_raw( $_POST['dt_link_'.$box_name] );
	
	update_post_meta( $post_id, 'dt_'. $box_name. '_options', $mydata );
}

// STATIC METABOX
function dt_home_slider_static_options( $post ) {
	// NAME OF THE BOX !
	$box_name = 'homestatic';

	$data = get_post_meta( $post->ID, 'dt_'. $box_name. '_options', true );
	
	$dt_link = isset( $data['dt_link'] )?trim( $data['dt_link'] ):'';
	
	// Use nonce for verification
	wp_nonce_field( plugin_basename( __FILE__ ), $box_name.'_noncename' );

	// The actual fields for data entry
	?>
	<p>
		<input type="checkbox" id="dt_hide_desc_<?php echo $box_name; ?>" name="dt_hide_desc_<?php echo $box_name; ?>"<?php checked(!empty($data['dt_hide_desc'])); ?>/>
		<label for="dt_hide_desc_<?php echo $box_name; ?>"><?php _e("Hide description", LANGUAGE_ZONE ); ?></label>
	</p>
	<p>
		<input type="checkbox" id="dt_hide_over_mask_<?php echo $box_name; ?>" name="dt_hide_over_mask_<?php echo $box_name; ?>"<?php checked(!empty($data['dt_hide_over_mask'])); ?>/>
		<label for="dt_hide_over_mask_<?php echo $box_name; ?>"><?php _e("Hide overlay mask", LANGUAGE_ZONE ); ?></label>
	</p>
	<p>
		<input type="text" id="dt_link_<?php echo $box_name; ?>" name="dt_link_<?php echo $box_name; ?>" value="<?php echo $dt_link ?>" size="43" />
		<label for="dt_link_<?php echo $box_name; ?>"><?php _e('Details link', LANGUAGE_ZONE); ?></label>
	</p>
	<?php
}

// STATIC SAVE FUNK
function dt_home_static_save( $post_id ) {
	// NAME OF THE BOX !
	$box_name = 'homestatic';
	
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
	$mydata['dt_hide_desc'] = isset($_POST['dt_hide_desc_'.$box_name]);
	$mydata['dt_hide_over_mask'] = isset($_POST['dt_hide_over_mask_'.$box_name]);
	$mydata['dt_link'] = isset($_POST['dt_link_'.$box_name])?esc_url_raw( $_POST['dt_link_'.$box_name] ):'';
	
	update_post_meta( $post_id, 'dt_'. $box_name. '_options', $mydata );
}

function dt_metabox_slider_uploader( $post ) {
	$tab = 'type';
    $args = array(
        'post_type'			=>'attachment',
        'post_status'		=>'inherit',
        'post_parent'		=>$post->ID,
        'posts_per_page'	=>1
    );
    $attachments = new Wp_Query( $args );

    if( !empty($attachments->posts) ) {
        $tab = 'dt_slider_media';
    }
    
    $u_href = get_admin_url();
    $u_href .= '/media-upload.php?post_id='. $post->ID;
    $u_href .= '&width=670&height=400&tab='.$tab;
?>
    <iframe src="<?php echo esc_url($u_href); ?>" width="100%" height="560">The Error!!!</iframe>
<?php
}

function dt_slider_media_form( $errors ) {
    global $redir_tab, $type;

    $redir_tab = 'dt_slider_media';
    media_upload_header();
    
    $post_id = intval($_REQUEST['post_id']);
    $form_action_url = admin_url("media-upload.php?type=$type&tab=dt_slider_media&post_id=$post_id");
    $form_action_url = apply_filters('media_upload_form_url', $form_action_url, $type);
    $form_class = 'media-upload-form validate';
    
    if ( get_user_setting('uploader') )
        $form_class .= ' html-uploader';
?>	
    <script type="text/javascript">
    <!--
    jQuery(function($){
        var preloaded = $(".media-item.preloaded");
        if ( preloaded.length > 0 ) {
            preloaded.each(function(){prepareMediaItem({id:this.id.replace(/[^0-9]/g, '')},'');});
            updateMediaForm();
        }
    });
    -->
    </script>
    <div id="sort-buttons" class="hide-if-no-js">
    <span>
    <?php _e('All Tabs:', LANGUAGE_ZONE); ?>
    <a href="#" id="showall"><?php _e('Show', LANGUAGE_ZONE); ?></a>
    <a href="#" id="hideall" style="display:none;"><?php _e('Hide', LANGUAGE_ZONE); ?></a>
    </span>
    <?php _e('Sort Order:', LANGUAGE_ZONE); ?>
    <a href="#" id="asc"><?php _e('Ascending', LANGUAGE_ZONE); ?></a> |
    <a href="#" id="desc"><?php _e('Descending', LANGUAGE_ZONE); ?></a> |
    <a href="#" id="clear"><?php _ex('Clear', 'verb', LANGUAGE_ZONE); ?></a>
    </div>
    <form enctype="multipart/form-data" method="post" action="<?php echo esc_attr($form_action_url); ?>" class="<?php echo $form_class; ?>" id="gallery-form">
    <?php wp_nonce_field('media-form'); ?>
    <?php //media_upload_form( $errors ); ?>
    <table class="widefat" cellspacing="0">
    <thead><tr>
    <th><?php _e('Media', LANGUAGE_ZONE); ?></th>
    <th class="order-head"><?php _e('Order', LANGUAGE_ZONE); ?></th>
    <th class="actions-head"><?php _e('Actions', LANGUAGE_ZONE); ?></th>
    </tr></thead>
    </table>
    <div id="media-items">
    <?php add_filter('attachment_fields_to_edit', 'media_post_single_attachment_fields_to_edit', 10, 2); ?>
    <?php $_REQUEST['tab'] = 'gallery'; ?>
    <?php echo get_media_items($post_id, $errors); ?>
    <?php $_REQUEST['tab'] = 'dt_slider_media';?>
    </div>

    <p class="ml-submit">
    <?php submit_button( __( 'Save all changes', LANGUAGE_ZONE ), 'button savebutton', 'save', false, array( 'id' => 'save-all', 'style' => 'display: none;' ) ); ?>
    <input type="hidden" name="post_id" id="post_id" value="<?php echo (int) $post_id; ?>" />
    <input type="hidden" name="type" value="<?php echo esc_attr( $GLOBALS['type'] ); ?>" />
    <input type="hidden" name="tab" value="<?php echo esc_attr( $GLOBALS['tab'] ); ?>" />
    </p>
    </form>
	<div style="display: none;">
    <input type="radio" name="linkto" id="linkto-file" value="file" />
    <input type="radio" checked="checked" name="linkto" id="linkto-post" value="post" />
    <select id="orderby" name="orderby">
    	<option value="menu_order" selected="selected"><?php _e('Menu order', LANGUAGE_ZONE); ?></option>
        <option value="title"><?php _e('Title', LANGUAGE_ZONE); ?></option>
        <option value="post_date"><?php _e('Date/Time', LANGUAGE_ZONE); ?></option>
        <option value="rand"><?php _e('Random', LANGUAGE_ZONE); ?></option>
    </select>
    <input type="radio" checked="checked" name="order" id="order-asc" value="asc" />
    <input type="radio" name="order" id="order-desc" value="desc" />
    <select id="columns" name="columns">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3" selected="selected">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
   	</select>
	</div>
<?php
}

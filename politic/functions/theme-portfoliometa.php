<?php

/* Adding Image upload to Portfolio MetaBoxes */

// Defining MetaBox fields

$prefix = "icy_";

$meta_box_portfolio = array(
	'id' => 'icy-meta-box-portfolio',
	'title' =>  __('Portfolio Detail Settings: ', 'framework'),
	'page' => 'portfolios',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
    	
    	array(
    		'id' => $prefix . 'portfolio_type',
			'name' =>  __('Portfolio Type', 'framework'),
			'desc' => __('Choose the portfolio type you wish to display:', 'framework'),
			"type" => "select",
			'std' => 'Image',
			'options' => array('Image', 'Slideshow', 'Video')
		),
    	array(
    	   'id' => $prefix . 'portfolio_date',
    	   'name' => __('Portfolio Date', 'framework'),
    	   'desc' => __('Whhat was the date when the portfolio was completed', 'framework'),
    	   'type' => 'text',
    	   'std' => ''
    	),
    	array(
    	   'id' => $prefix . 'portfolio_client',
    	   'name' => __('Portfolio Client', 'framework'),
    	   'desc' => __('For whom was the portfolio completed', 'framework'),
    	   'type' => 'text',
    	   'std' => ''
    	),
    	array(
    	   'id' => $prefix . 'portfolio_url',
    	   'name' => __('Portfolio URL', 'framework'),
    	   'desc' => __('What is the URL for the Portfolio?', 'framework'),
    	   'type' => 'text',
    	   'std' => ''
    	)
	)
);

$meta_box_portfolio_image = array(
	'id' => 'icy-meta-box-portfolio-image',
	'title' => __('Image Settings', 'framework'),
	'page' => 'portfolios',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array( "name" => '',
				"desc" => '',
				"id" => $prefix . "portfolio_upload_images",
				"type" => 'button',
				'std' => 'Upload Images'
			)
    )
);

$meta_box_portfolio_video = array(
	'id' => 'icy-meta-box-portfolio-video',
	'title' => __('Video Settings', 'framework'),
	'page' => 'portfolios',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => __('Embedded Code', 'framework'),
			'desc' => __('If you are using something other than self hosted video such as Youtube or Vimeo, paste the embed code here. Width is best at 700px with any height.<br><br> This field will override the above.', 'framework'),
			'id' => $prefix . 'portfolio_embed_code',
			'type' => 'textarea',
			'std' => ''
		)
	),
	
);

add_action('admin_menu', 'icy_add_box_portfolio');

// Adding the Metabox to the edit page
function icy_add_box_portfolio() {
	global $meta_box_portfolio, $meta_box_portfolio_video, $meta_box_portfolio_image;

	add_meta_box($meta_box_portfolio['id'], $meta_box_portfolio['title'], 'icy_show_box_portfolio',  $meta_box_portfolio['page'], $meta_box_portfolio['context'], $meta_box_portfolio['priority']);

	add_meta_box($meta_box_portfolio_image['id'], $meta_box_portfolio_image['title'], 'icy_show_box_portfolio_image', $meta_box_portfolio_image['page'], $meta_box_portfolio_image['context'], $meta_box_portfolio_image['priority']);

	add_meta_box($meta_box_portfolio_video['id'], $meta_box_portfolio_video['title'], 'icy_show_box_portfolio_video', $meta_box_portfolio_video['page'], $meta_box_portfolio_video['context'], $meta_box_portfolio_video['priority']);
	
}



// Callback to show fields in the meta box
function icy_show_box_portfolio() {
	global $meta_box_portfolio, $post;
 	
	echo '<p style="padding:10px 0 0 0;">'.__('Select your preferred Portfolio Type and fill out any additional information fields.', 'framework').'</p>';

	echo '<input type="hidden" name="icy_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 
	echo '<table class="form-table">';
 
	foreach ($meta_box_portfolio['fields'] as $field) {
		// Get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {
 
			
			// If Text		
			case 'text':
			
			echo '<tr style="border-top:1px solid #eeeeee;">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" size="30" style="width:75%; margin-right: 20px; float:left;" />';
			
			break;
 
			// If Button	
			case 'button':
				echo '<input style="float: left;" type="button" class="button" name="', $field['id'], '" id="', $field['id'], '"value="', $meta ? $meta : $field['std'], '" />';
				echo 	'</td>',
			'</tr>';
			
			break;
			
			// If Select	
			case 'select':
			
				echo '<tr>',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">'. $field['desc'].'</span></label></th>',
				'<td>';
			
				echo'<select id="' . $field['id'] . '" name="'.$field['id'].'">';
			
				foreach ($field['options'] as $option) {
					
					echo'<option';
					if ($meta == $option ) { 
						echo ' selected="selected"'; 
					}
					echo'>'. $option .'</option>';
				
				} 
				
				echo'</select>';
			
			break;
			
            case 'color':

                echo '<tr>',
    			'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">'. $field['desc'].'</span></label></th>',
    			'<td>';

                echo '<div id="' . $field['id'] . '_picker" class="colorSelector"><div></div></div>';
    			echo '<input style="width:75px; margin-left: 5px;" class="icy-color" name="'. $field['id'] .'" id="'. $field['id'] .'" type="text" value="'. $meta .'" />';
?>   			
    			<script type="text/javascript" language="javascript">
            		jQuery(document).ready(function(){
            	
            			//Color Picker
    				    jQuery('#<?php echo $field['id']; ?>_picker').children('div').css('backgroundColor', '<?php echo $meta; ?>');    
            			jQuery('#<?php echo $field['id']; ?>_picker').ColorPicker({
            				color: '<?php echo $meta; ?>',
            				onShow: function (colpkr) {
            					jQuery(colpkr).fadeIn(500);
            					return false;
            				},
            				onHide: function (colpkr) {
            					jQuery(colpkr).fadeOut(500);
            					return false;
            				},
            				onChange: function (hsb, hex, rgb) {
            					jQuery('#<?php echo $field['id']; ?>_picker').children('div').css('backgroundColor', '#' + hex);
            					jQuery('#<?php echo $field['id']; ?>_picker').next('input').attr('value','#' + hex);
        					}
    				    });
                    });
        		</script>
<?php       break;             
			
		}

	}
 
	echo '</table>';
}

function icy_show_box_portfolio_image() {
	global $meta_box_portfolio_image, $post;
 	
	echo '<p style="padding:10px 0 0 0;">'.__('Upload images to be used for this portfolio (images should be at least 700px wide). Set a featured image that will be displayed on the main portfolio page. The featured image will not be included in the single portfolio page so it can be smaller than 700px wide.', 'framework').'</p>';
	
	echo '<input type="hidden" name="icy_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 
	echo '<table class="form-table">';
 
	foreach ($meta_box_portfolio_image['fields'] as $field) {
		// Get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {
 
			
			// If Text		
			case 'text':
			
			echo '<tr style="border-top:1px solid #eeeeee;">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" size="30" style="width:75%; margin-right: 20px; float:left;" />';
			
			break;
 
			// If Button	
			case 'button':
					echo '<tr><td><input style="float: left;" type="button" class="button" name="', $field['id'], '" id="', $field['id'], '"value="', $meta ? $meta : $field['std'], '" />';
				echo 	'</td>',
			'</tr>';
			
			break;
			
			// If Select	
			case 'select':
			
				echo '<tr>',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			
				echo'<select name="'.$field['id'].'">';
			
				foreach ($field['options'] as $option) {
					
					echo'<option';
					if ($meta == $option ) { 
						echo ' selected="selected"'; 
					}
					echo'>'. $option .'</option>';
				
				} 
				
				echo'</select>';
			
			break;
		}

	}
 
	echo '</table>';
}

function icy_show_box_portfolio_video() {
	global $meta_box_portfolio_video, $post;
 	
	echo '<p style="padding:10px 0 0 0;">'.__('These settings enable you to embed videos into your portfolio pages.', 'framework').'</p>';
	
	echo '<input type="hidden" name="icy_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 
	echo '<table class="form-table">';
 
	foreach ($meta_box_portfolio_video['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {
 
			
			// If Text		
			case 'text':
			
			echo '<tr style="border-top:1px solid #eeeeee;">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="line-height:20px; display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'],'" size="30" style="width:75%; margin-right: 20px; float:left;" />';
			
			break;
			
			// If textarea		
			case 'textarea':
			
			echo '<tr style="border-top:1px solid #eeeeee;">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="line-height:18px; display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<textarea name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" rows="8" cols="5" style="width:100%; margin-right: 20px; float:left;">', $meta ? $meta : $field['std'], '</textarea>';
			
			break;
 
			// If Button	
			case 'button':
				echo '<input style="float: left;" type="button" class="button" name="', $field['id'], '" id="', $field['id'], '"value="', $meta ? $meta : $field['std'], '" />';
				echo 	'</td>',
			'</tr>';
			
			break;
		}

	}
 
	echo '</table>';
}

add_action('save_post', 'icy_save_data_portfolio');


// Save data when post is edited
 
function icy_save_data_portfolio($post_id) {
	global $meta_box_portfolio, $meta_box_portfolio_video, $meta_box_portfolio_image;
 
	// verify nonce
	if (!wp_verify_nonce($_POST['icy_meta_box_nonce'], basename(__FILE__))) {
		return $post_id;
	}
 
	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}
 
	// check permissions
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}
 
	foreach ($meta_box_portfolio['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
 
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}

	foreach ($meta_box_portfolio_image['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
 
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
	
	foreach ($meta_box_portfolio_video['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
 
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
	
}


/*-----------------------------------------------------------------------------------*/
/*	Queue Scripts
/*-----------------------------------------------------------------------------------*/
 
function icy_admin_scripts_portfolio() {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_register_script('icy-upload', get_template_directory_uri() . '/functions/js/upload-button.js', array('jquery','media-upload','thickbox'));
	wp_enqueue_script('icy-upload');
	wp_enqueue_script('color-picker', ICY_DIRECTORY.'/admin/js/colorpicker.js', array('jquery'));
}
function icy_admin_styles_portfolio() {
	wp_enqueue_style('thickbox');
	wp_enqueue_style('color-picker', ICY_DIRECTORY.'/admin/css/colorpicker.css');
}
add_action('admin_print_scripts', 'icy_admin_scripts_portfolio');
add_action('admin_print_styles', 'icy_admin_styles_portfolio');

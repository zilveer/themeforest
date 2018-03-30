<?php

function xxxx_add_edit_form_multipart_encoding() {

    echo ' enctype="multipart/form-data"';

}
add_action('post_edit_form_tag', 'xxxx_add_edit_form_multipart_encoding');

$prefix = 'ag_';
$url =  get_template_directory_uri() .'/admin/images/';
 
$meta_box_homepage = array(
	'id' => 'ag-meta-box-homepage',
	'title' => __('Homepage Slide Options', 'framework'),
	'page' => 'portfolio',
	'context' => 'normal',
	'priority' => 'core',
	'fields' => array(
		array(
			'name' => __('Display on Homepage', 'framework'),
			'desc' => __('Display this portfolio item as a slide on the homepage?', 'framework'),
			'id' => $prefix . 'home_page_display',
			'type' => 'radiohide',
			'std' => 'Yes',
			'options' => array('Yes','No'),
		),
	array(
			'name' => __('Homepage Subtitle (Optional)', 'framework'),
			'desc' => __('Enter an optional subtitle for your project.', 'framework'),
			'id' => $prefix . 'sub_title',
			'type' => 'text',
			'std' => ''
		),
	array(
			'name' => __('Homepage Title (Optional)', 'framework'),
			'desc' => __('Enter an optional title for your project.', 'framework'),
			'id' => $prefix . 'title',
			'type' => 'text',
			'std' => ''
		),
	array(
			'name' => __('Exclude from Project Page', 'framework'),
			'desc' => __('Select this to exclude your slide from the projects page.', 'framework'),
			'id' => $prefix . 'portfolio_page_display',
			'type' => 'select',
			'std' => 'No',
			'options' => array('No','Yes'),
		),
    array(
			'name' => __('Caption Title Placement', 'framework'),
			'desc' => __('Select the placement of your homepage slide caption.', 'framework'),
			'id' => $prefix . 'title_place',
			'type' => 'select',
			'std' => '',
			'options' =>   array('Center','Left','Right','Left Bottom', 'Right Bottom', 'Left Top', 'Right Top'
						),
		),
	array(
			'name' => __('Caption Title Color', 'framework'),
			'desc' => __('Select your caption title color.', 'framework'),
			'id' => $prefix . 'title_color',
			'type' => 'select',
			'std' => 'White',
			'options' => array('White','Black'),
		),
	array(
			'name' => __('Caption Title Background', 'framework'),
			'desc' => __('Select your caption title background. This will overwrite the caption color.', 'framework'),
			'id' => $prefix . 'title_bg',
			'type' => 'select',
			'std' => 'None',
			'options' => array('None','Dark','Light'),
		),
	array(
			'name' => __('Read More Button Text', 'framework'),
			'desc' => __('Enter the text for your "Read More" button.', 'framework'),
			'id' => $prefix . 'more_text',
			'type' => 'text',
			'std' => ''
		),
	array(
			'name' => __('Optional Link URL', 'framework'),
			'desc' => __('Enter a Button Link. If blank, it will direct to the individual project page.', 'framework'),
			'id' => $prefix . 'optional_link',
			'type' => 'text',
			'std' => ''
		),
	),
	
);

$meta_box_video = array(
	'id' => 'ag-meta-box-video',
	'title' => __('Optional Video', 'framework'),
	'page' => 'portfolio',
	'context' => 'normal',
	'priority' => 'core',
	'fields' => array(

		    array(
			'name' => __('YouTube or Vimeo Video URL', 'framework'),
			'desc' => __('If you want to use a YouTube or Vimeo video, please enter in the URL here.', 'framework'),
			'id' => $prefix . 'video_url',
			'type' => 'textvisible',
			'std' => ''
		),
	),
	
);

$meta_box_video_home = array(
	'id' => 'ag-meta-box-video-home',
	'title' => __('Homepage Video', 'framework'),
	'page' => 'page',
	'context' => 'normal',
	'priority' => 'core',
	'fields' => array(

		array(
			'name' => __('YouTube or Vimeo Video URL', 'framework'),
			'desc' => __('If you want to use a YouTube or Vimeo video, please enter in the URL here.', 'framework'),
			'id' => $prefix . 'video_url_home',
			'type' => 'textvisible',
			'std' => ''
		),
		array(
			'name' => __('Read More Button Text', 'framework'),
			'desc' => __('Enter the text for your "Read More" button.', 'framework'),
			'id' => $prefix . 'more_text_home',
			'type' => 'textvisible',
			'std' => ''
		),
		array(
			'name' => __('Read More Button Link', 'framework'),
			'desc' => __('Enter the link url for your "Read More" button.', 'framework'),
			'id' => $prefix . 'more_link_home',
			'type' => 'textvisible',
			'std' => ''
		),
	),
	
);

$meta_box_options = array(
	'id' => 'ag-meta-box-options',
	'title' => __('Additional Options', 'framework'),
	'page' => 'portfolio',
	'context' => 'normal',
	'priority' => 'core',
	'fields' => array(
	array(
			'name' => __('Fit Images', 'framework'),
			'desc' => __('Select whether you want the slide images to never exceed browser width or height.', 'framework'),
			'id' => $prefix . 'fit',
			'type' => 'select',
			'std' => 'None',
			'options' => array('None','Fit Portrait','Fit Landscape', 'Fit Always'),
		),
	),
	
);

add_action('admin_menu', 'mytheme_add_box');

 
// Add meta box
function mytheme_add_box() {
	global $meta_box_homepage;
	global $meta_box_video;
	global $meta_box_video_home;
	global $meta_box_options;
 
	add_meta_box($meta_box_homepage['id'], $meta_box_homepage['title'], 'mytheme_show_homepage_box', $meta_box_homepage['page'], $meta_box_homepage['context'], $meta_box_homepage['priority']);
	add_meta_box($meta_box_video['id'], $meta_box_video['title'], 'mytheme_show_video_box', $meta_box_video['page'], $meta_box_video['context'], $meta_box_video['priority']);
	add_meta_box($meta_box_options['id'], $meta_box_options['title'], 'mytheme_show_options_box', $meta_box_options['page'], $meta_box_options['context'], $meta_box_options['priority']);
	
	if(isset($_GET['post'])) {
	$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
    $template_file = get_post_meta($post_id,'_wp_page_template',TRUE);
   
  // check for a template type
  if ($template_file == 'template-home-video.php') {
	add_meta_box($meta_box_video_home['id'], $meta_box_video_home['title'], 'mytheme_show_videohome_box', "page", $meta_box_video_home['context'], $meta_box_video_home['priority']);
  }
   }
}
 
// Callback function to show fields in meta box
function mytheme_show_video_box() {
	global $meta_box_video, $post;
	
		// Use nonce for verification
	echo '<input type="hidden" name="mytheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 	
	echo '<p style="padding:10px 0 0 0;">'.__('This will overwrite your slideshow, except for the featured image displayed on the homepage and project pages.', 'framework').'</p>';
 
	echo '<table class="form-table">';
 
	foreach ($meta_box_video['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {
 
			
			//If Text		
			case 'text':
			
			echo '<tr style="border-top:1px solid #eeeeee;" class="hidden">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="line-height:20px; display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'],'" size="30" style="width:75%; margin-right: 20px; float:left;" />';
			
			break;
			
			//If Text Visible	
			case 'textvisible':
			
			echo '<tr style="border-top:1px solid #eeeeee;" class="visible">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="line-height:20px; display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'],'" size="30" style="width:75%; margin-right: 20px; float:left;" />';
			
			break;
			
			//If textarea		
			case 'textarea':
			
			echo '<tr style="border-top:1px solid #eeeeee;" class="hidden">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="line-height:18px; display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<textarea name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" rows="8" cols="5" style="width:100%; margin-right: 20px; float:left;">', $meta ? $meta : $field['std'], '</textarea>';
			
			break;
 
			//If Button	
			case 'button':
				echo '<input style="float: left;" type="button" class="button" name="', $field['id'], '" id="', $field['id'], '"value="', $meta ? $meta : $field['std'], '" />';
				echo 	'</td>',
			'</tr>';
			
			break;
			
			
			//If Select	
			case 'select':
			
				echo '<tr style="border-top:1px solid #eeeeee;" class="hidden">',
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
			
			//If Radio Hide Button
			case 'radiohide':
			
				echo '<tr style="border-top:1px solid #eeeeee;" class="visible">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			
				foreach ($field['options'] as $option) {
					if ($option == 'Yes') {
					echo'<input type="radio"';
						if ($meta == $option ) { 
					echo 'checked ';
					}	
					echo 'name="'.$field['id'].'" class="nohide" value="'.$option .'">' . $option .' <br />';
					} else {
					echo'<input type="radio"';
					if ($meta == $option ) { 
					echo 'checked ';
					}	
					echo 'name="'.$field['id'].'" class="hide" value="'.$option .'">' . $option .' <br />';	
					}
				} 
			
			break;
			
				
			//If Radio Button
			case 'radio':
			
				echo '<tr style="border-top:1px solid #eeeeee;" class="hidden">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			
				foreach ($field['options'] as $option) {
					echo'<input type="radio"';
						if ($meta == $option ) { 
					echo 'checked ';
					}	
					echo 'name="'.$field['name'].'" value="'.$option .'">' . $option .' <br />';
						
					
				} 
			
			break;
		}

	}
 
	echo '</table>';
}

// Callback function to show fields in meta box
function mytheme_show_videohome_box() {
	global $meta_box_video_home, $post;
	
		// Use nonce for verification
	echo '<input type="hidden" name="mytheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 
	echo '<table class="form-table">';
 
	foreach ($meta_box_video_home['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {
 
			
			//If Text		
			case 'text':
			
			echo '<tr style="border-top:1px solid #eeeeee;" class="hidden">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="line-height:20px; display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'],'" size="30" style="width:75%; margin-right: 20px; float:left;" />';
			
			break;
			
			//If Text Visible	
			case 'textvisible':
			
			echo '<tr style="border-top:1px solid #eeeeee;" class="visible">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="line-height:20px; display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'],'" size="30" style="width:75%; margin-right: 20px; float:left;" />';
			
			break;
			
			//If textarea		
			case 'textarea':
			
			echo '<tr style="border-top:1px solid #eeeeee;" class="hidden">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="line-height:18px; display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<textarea name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" rows="8" cols="5" style="width:100%; margin-right: 20px; float:left;">', $meta ? $meta : $field['std'], '</textarea>';
			
			break;
 
			//If Button	
			case 'button':
				echo '<input style="float: left;" type="button" class="button" name="', $field['id'], '" id="', $field['id'], '"value="', $meta ? $meta : $field['std'], '" />';
				echo 	'</td>',
			'</tr>';
			
			break;
			
			
			//If Select	
			case 'select':
			
				echo '<tr style="border-top:1px solid #eeeeee;" class="hidden">',
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
			
			//If Radio Hide Button
			case 'radiohide':
			
				echo '<tr style="border-top:1px solid #eeeeee;" class="visible">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			
				foreach ($field['options'] as $option) {
					if ($option == 'Yes') {
					echo'<input type="radio"';
						if ($meta == $option ) { 
					echo 'checked ';
					}	
					echo 'name="'.$field['id'].'" class="nohide" value="'.$option .'">' . $option .' <br />';
					} else {
					echo'<input type="radio"';
					if ($meta == $option ) { 
					echo 'checked ';
					}	
					echo 'name="'.$field['id'].'" class="hide" value="'.$option .'">' . $option .' <br />';	
					}
				} 
			
			break;
			
				
			//If Radio Button
			case 'radio':
			
				echo '<tr style="border-top:1px solid #eeeeee;" class="hidden">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			
				foreach ($field['options'] as $option) {
					echo'<input type="radio"';
						if ($meta == $option ) { 
					echo 'checked ';
					}	
					echo 'name="'.$field['name'].'" value="'.$option .'">' . $option .' <br />';
						
					
				} 
			
			break;
		}

	}
 
	echo '</table>';
}



// Callback function to show fields in meta box
function mytheme_show_options_box() {
	global $meta_box_options, $post;
	
		// Use nonce for verification
	echo '<input type="hidden" name="mytheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 
	echo '<table class="form-table">';
 
	foreach ($meta_box_options['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {
 
			
			//If Text		
			case 'text':
			
			echo '<tr style="border-top:1px solid #eeeeee;" class="visible">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="line-height:20px; display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'],'" size="30" style="width:75%; margin-right: 20px; float:left;" />';
			
			break;
			
			//If Text Visible	
			case 'textvisible':
			
			echo '<tr style="border-top:1px solid #eeeeee;" class="visible">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="line-height:20px; display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'],'" size="30" style="width:75%; margin-right: 20px; float:left;" />';
			
			break;
			
			//If textarea		
			case 'textarea':
			
			echo '<tr style="border-top:1px solid #eeeeee;" class="visible">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="line-height:18px; display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<textarea name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" rows="8" cols="5" style="width:100%; margin-right: 20px; float:left;">', $meta ? $meta : $field['std'], '</textarea>';
			
			break;
 
			//If Button	
			case 'button':
				echo '<input style="float: left;" type="button" class="button" name="', $field['id'], '" id="', $field['id'], '"value="', $meta ? $meta : $field['std'], '" />';
				echo 	'</td>',
			'</tr>';
			
			break;
			
			
			//If Select	
			case 'select':
			
				echo '<tr style="border-top:1px solid #eeeeee;" class="visible">',
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
			
				
			//If Radio Button
			case 'radio':
			
				echo '<tr style="border-top:1px solid #eeeeee;" class="visible">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			
				foreach ($field['options'] as $option) {
					echo'<input type="radio"';
						if ($meta == $option ) { 
					echo 'checked ';
					}	
					echo 'name="'.$field['name'].'" value="'.$option .'">' . $option .' <br />';
						
					
				} 
			
			break;
		}

	}
 
	echo '</table>';
}
 
 
// Callback function to show fields in meta box
function mytheme_show_homepage_box() {
	global $meta_box_homepage, $post;
	
		// Use nonce for verification
	echo '<input type="hidden" name="mytheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 	
	echo '<p style="padding:10px 0 0 0;">'.__('These settings enable you to display projects on your homepage with optional custom titling. Only the Featured Image will be shown as a slide.', 'framework').'</p>';
 
	echo '<table class="form-table">';
 
	foreach ($meta_box_homepage['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {
 
			
			//If Text		
			case 'text':
			
			echo '<tr style="border-top:1px solid #eeeeee;" class="hidden">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="line-height:20px; display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'],'" size="30" style="width:75%; margin-right: 20px; float:left;" />';
			
			break;
			
			//If Text Visible	
			case 'textvisible':
			
			echo '<tr style="border-top:1px solid #eeeeee;" class="visible">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="line-height:20px; display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'],'" size="30" style="width:75%; margin-right: 20px; float:left;" />';
			
			break;
			
			//If textarea		
			case 'textarea':
			
			echo '<tr style="border-top:1px solid #eeeeee;" class="hidden">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="line-height:18px; display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<textarea name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" rows="8" cols="5" style="width:100%; margin-right: 20px; float:left;">', $meta ? $meta : $field['std'], '</textarea>';
			
			break;
 
			//If Button	
			case 'button':
				echo '<input style="float: left;" type="button" class="button" name="', $field['id'], '" id="', $field['id'], '"value="', $meta ? $meta : $field['std'], '" />';
				echo 	'</td>',
			'</tr>';
			
			break;
			
			
			//If Select	
			case 'select':
			
				echo '<tr style="border-top:1px solid #eeeeee;" class="hidden">',
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
			
			//If Radio Hide Button
			case 'radiohide':
			
				echo '<tr style="border-top:1px solid #eeeeee;" class="visible">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			
				foreach ($field['options'] as $option) {
					if ($option == 'Yes') {
					echo'<input type="radio"';
						if ($meta == $option ) { 
					echo 'checked ';
					}	
					echo 'name="'.$field['id'].'" class="nohide" value="'.$option .'">' . $option .' <br />';
					} else {
					echo'<input type="radio"';
					if ($meta == $option ) { 
					echo 'checked ';
					}	
					echo 'name="'.$field['id'].'" class="hide" value="'.$option .'">' . $option .' <br />';	
					}
				} 
			
			break;
			
				
			//If Radio Button
			case 'radio':
			
				echo '<tr style="border-top:1px solid #eeeeee;" class="hidden">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			
				foreach ($field['options'] as $option) {
					echo'<input type="radio"';
						if ($meta == $option ) { 
					echo 'checked ';
					}	
					echo 'name="'.$field['name'].'" value="'.$option .'">' . $option .' <br />';
						
					
				} 
			
			break;
		}

	}
 
	echo '</table>';
}
 
add_action('save_post', 'mytheme_save_data');
 
// Save data from meta box
function mytheme_save_data($post_id) {
	global $meta_box_homepage, $meta_box_video, $meta_box_video_home, $meta_box_options;
 	
	if ( isset($_POST['mytheme_meta_box_nonce'])) {
	// verify nonce
	if (!wp_verify_nonce($_POST['mytheme_meta_box_nonce'], basename(__FILE__))) {
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
	
foreach ($meta_box_homepage['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
 
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
	
foreach ($meta_box_options['fields'] as $field) {
	$old = get_post_meta($post_id, $field['id'], true);
	$new = $_POST[$field['id']];

	if ($new && $new != $old) {
		update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
	} elseif ('' == $new && $old) {
		delete_post_meta($post_id, $field['id'], $old);
	}
}

foreach ($meta_box_video_home['fields'] as $field) {
	$old = get_post_meta($post_id, $field['id'], true);
	$new = $_POST[$field['id']];

	if ($new && $new != $old) {
		update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
	} elseif ('' == $new && $old) {
		delete_post_meta($post_id, $field['id'], $old);
	}
} 

foreach ($meta_box_video['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
 
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
}
}

function my_enqueue($hook) {
    if( 'post.php' != $hook )
        return;
	wp_register_script('adminjquery', get_template_directory_uri() . '/js/admin-jquery.js', 'jquery');
    wp_enqueue_script( 'adminjquery');
}
add_action( 'admin_enqueue_scripts', 'my_enqueue' );


function my_admin_scripts() {
wp_enqueue_script('media-upload');
wp_enqueue_script('thickbox');
wp_register_script('my-upload', get_template_directory_uri() . '/functions/js/portfolio-upload.js', array('jquery','media-upload','thickbox'));
wp_enqueue_script('my-upload');
}
function my_admin_styles() {
wp_enqueue_style('thickbox');
}
add_action('admin_print_scripts', 'my_admin_scripts');
add_action('admin_print_styles', 'my_admin_styles');
?>
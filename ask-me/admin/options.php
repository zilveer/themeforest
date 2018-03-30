<?php
/* Save default options */
$options_framework_admin = new Options_Framework_Admin;
$default_options = $options_framework_admin->get_default_values();
if (!get_option(vpanel_options)) {
	add_option(vpanel_options,$default_options);
}
function optionsframework_options() {

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Pull all the categories into an array
	$options_categories = array();
	$args = array(
		'type'                     => 'post',
		'child_of'                 => 0,
		'parent'                   => '',
		'orderby'                  => 'name',
		'order'                    => 'ASC',
		'hide_empty'               => 0,
		'hierarchical'             => 1,
		'exclude'                  => '',
		'include'                  => '',
		'number'                   => '',
		'taxonomy'                 => 'category',
		'pad_counts'               => false
	);
		
	$options_categories_obj = get_categories($args);
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all the question category into an array
	$options_categories_q = array();
	$args = array(
		'type'                     => 'question',
		'child_of'                 => 0,
		'parent'                   => '',
		'orderby'                  => 'name',
		'order'                    => 'ASC',
		'hide_empty'               => 0,
		'hierarchical'             => 1,
		'exclude'                  => '',
		'include'                  => '',
		'number'                   => '',
		'taxonomy'                 => 'question-category',
		'pad_counts'               => false
	);
	
	$options_categories_obj_q = get_categories($args);
	$options_categories_q = array();
	foreach ($options_categories_obj_q as $category_q) {
		$options_categories_q[$category_q->term_id] = $category_q->name;
	}
	
	// Pull all the groups into an array
	$options_groups = array();
	global $wp_roles;
	$options_groups_obj = $wp_roles->roles;
	foreach ($options_groups_obj as $key_r => $value_r) {
		$options_groups[$key_r] = $value_r['name'];
	}
	
	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}

	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}
	
	// Pull all the sidebars into an array
	$sidebars = get_option('sidebars');
	$new_sidebars = array('default'=> 'Default');
	foreach ($GLOBALS['wp_registered_sidebars'] as $sidebar) {
		$new_sidebars[$sidebar['id']] = $sidebar['name'];
	}
	
	// Pull all the roles into an array
	global $wp_roles;
	$new_roles = array();
	foreach ($wp_roles->roles as $key => $value) {
		$new_roles[$key] = $value['name'];
	}
	
	$export = array(vpanel_options,"sidebars","badges","coupons","roles");
	$current_options = array();
	foreach ($export as $options) {
		if (get_option($options)) {
			$current_options[$options] = get_option($options);
		}else {
			$current_options[$options] = array();
		}
	}
	$current_options_e = base64_encode(serialize($current_options));
	
	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/admin/images/';
	
	$options = array();
	
	$options[] = array(
		'name' => 'General settings',
		'type' => 'heading');
	
	$options[] = array(
		'name' => 'Hide the top bar for WordPress',
		'desc' => 'Select ON if you want to hide the top bar for WordPress.',
		'id' => 'top_bar_wordpress',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Enable loader',
		'desc' => 'Select ON to enable loader.',
		'id' => 'loader',
		'std' => 1,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Enable nicescroll',
		'desc' => 'Select ON to enable nicescroll.',
		'id' => 'nicescroll',
		'std' => 1,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => "Custom logo for email template",
		'desc' => "Upload your custom logo for email template",
		'id' => 'logo_email_template',
		'type' => 'upload');
	
	$options[] = array(
		'name' => "Add your email for email template",
		'desc' => "Add your email for email template",
		'id' => 'email_template',
		'std' => get_bloginfo("admin_email"),
		'type' => 'text');
	
	$options[] = array(
		'name' => "Header code",
		'desc' => "Past your Google analytics code in the box",
		'id' => 'head_code',
		'std' => '',
		'type' => 'textarea');

	$options[] = array(
		'name' => "Footer code",
		'desc' => "Paste footer code in the box",
		'id' => 'footer_code',
		'std' => '',
		'type' => 'textarea');

	$options[] = array(
		'name' => "Custom CSS code",
		'desc' => "Advanced CSS options , Paste your CSS code in the box",
		'id' => 'custom_css',
		'std' => '',
		'type' => 'textarea');
	
	$options[] = array(
		'name' => 'Enable SEO options',
		'desc' => 'Select ON to enable SEO options.',
		'id' => 'seo_active',
		'std' => 1,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => "SEO keywords",
		'desc' => "Paste your keywords in the box",
		'id' => 'the_keywords',
		'std' => '',
		'type' => 'textarea');
	
	$options[] = array(
		'name' => "FaceBook share image",
		'desc' => "This is the FaceBook share image",
		'id' => 'fb_share_image',
		'type' => 'upload');
	
	$options[] = array(
		'name' => "WordPress login logo",
		'desc' => "This is the logo that appears on the default WordPress login page",
		'id' => 'login_logo',
		'type' => 'upload');
	
	$options[] = array(
		"name" => "WordPress login logo height",
		"id" => "login_logo_height",
		"type" => "sliderui",
		"step" => "1",
		"min" => "0",
		"max" => "300");
	
	$options[] = array(
		"name" => "WordPress login logo width",
		"id" => "login_logo_width",
		"type" => "sliderui",
		"step" => "1",
		"min" => "0",
		"max" => "300");
	
	$options[] = array(
		'name' => "Custom favicon",
		'desc' => "Upload the site’s favicon here , You can create new favicon here favicon.cc",
		'id' => 'favicon',
		'type' => 'upload');
	
	$options[] = array(
		'name' => "Custom favicon for iPhone",
		'desc' => "Upload your custom iPhone favicon",
		'id' => 'iphone_icon',
		'type' => 'upload');
	
	$options[] = array(
		'name' => "Custom iPhone retina favicon",
		'desc' => "Upload your custom iPhone retina favicon",
		'id' => 'iphone_icon_retina',
		'type' => 'upload');
	
	$options[] = array(
		'name' => "Custom favicon for iPad",
		'desc' => "Upload your custom iPad favicon",
		'id' => 'ipad_icon',
		'type' => 'upload');
	
	$options[] = array(
		'name' => "Custom iPad retina favicon",
		'desc' => "Upload your custom iPad retina favicon",
		'id' => 'ipad_icon_retina',
		'type' => 'upload');
	
	$options[] = array(
		'name' => 'Header settings',
		'type' => 'heading');
	
	$options[] = array(
		'name' => 'Top panel settings',
		'desc' => 'Select ON to enable the top panel.',
		'id' => 'login_panel',
		'std' => 1,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => "Select top panel skin",
		'desc' => "Select your preferred skin for the top panel.",
		'id' => "top_panel_skin",
		'std' => "panel_dark",
		'type' => "images",
		'options' => array(
			'panel_dark' => $imagepath . 'panel_dark.jpg',
			'panel_light' => $imagepath . 'panel_light.jpg'
		)
	);
	
	$options[] = array(
		'name' => 'Header top menu settings',
		'desc' => 'Select ON to enable the top menu in the header.',
		'id' => 'top_menu',
		'std' => 1,
		'type' => 'checkbox');
	
	if (is_rtl()) {
		$options[] = array(
			'name' => "Logo position",
			'desc' => "Select where you would like your logo to appear.",
			'id' => "logo_position",
			'std' => "left_logo",
			'type' => "images",
			'options' => array(
				'left_logo' => $imagepath . 'right_logo.jpg',
				'right_logo' => $imagepath . 'left_logo.jpg',
				'center_logo' => $imagepath . 'center_logo.jpg'
			)
		);
	}else {
		$options[] = array(
			'name' => "Logo position",
			'desc' => "Select where you would like your logo to appear.",
			'id' => "logo_position",
			'std' => "left_logo",
			'type' => "images",
			'options' => array(
				'left_logo' => $imagepath . 'left_logo.jpg',
				'right_logo' => $imagepath . 'right_logo.jpg',
				'center_logo' => $imagepath . 'center_logo.jpg'
			)
		);
	}
	
	$options[] = array(
		'name' => "Header skin",
		'desc' => "Select your preferred header skin.",
		'id' => "header_skin",
		'std' => "header_dark",
		'type' => "images",
		'options' => array(
			'header_dark' => $imagepath . 'left_logo.jpg',
			'header_light' => $imagepath . 'header_light.jpg'
		)
	);
	
	$options[] = array(
		'name' => 'Fixed header option',
		'desc' => 'Select ON to enable fixed header.',
		'id' => 'header_fixed',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Header search settings',
		'desc' => 'Select ON to enable the search in the header.',
		'id' => 'header_search',
		'std' => 'on',
		'type' => 'checkbox');
	
	if ( class_exists( 'woocommerce' ) ) {
		$options[] = array(
			'name' => 'Header cart settings',
			'desc' => 'Select ON to enable the cart in the header.',
			'id' => 'header_cart',
			'std' => 'on',
			'type' => 'checkbox');
	}
	
	$options[] = array(
		'name' => 'Logo display',
		'desc' => 'choose Logo display.',
		'id' => 'logo_display',
		'std' => 'display_title',
		'type' => 'radio',
		'options' => array("display_title" => "Display site title","custom_image" => "Custom Image"));
	
	$options[] = array(
		'name' => 'Logo upload',
		'desc' => 'Upload your custom logo. ',
		'id' => 'logo_img',
		'std' => '',
		'type' => 'upload');
	
	$options[] = array(
		'name' => 'Logo retina upload',
		'desc' => 'Upload your custom logo retina. ',
		'id' => 'retina_logo',
		'std' => '',
		'type' => 'upload');
	
	$options[] = array(
		'name' => 'Breadcrumbs settings',
		'desc' => 'Select ON to enable breadcrumbs.',
		'id' => 'breadcrumbs',
		'std' => 1,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Home page',
		'type' => 'heading');
	
	$options[] = array(
		'name' => 'Note: this options work in the home page only and if you don\'t choose the Front page.',
		'class' => 'home_page_display',
		'type' => 'info');
	
	$options[] = array(
		'name' => 'Home top box settings',
		'desc' => 'Select ON if you want to enable the home top box.',
		'id' => 'index_top_box',
		'std' => 1,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Home top box layout',
		'desc' => 'Home top box layout.',
		'id' => 'index_top_box_layout',
		'std' => '1',
		'type' => 'radio',
		'options' => array("1" => "Style 1","2" => "Style 2"));
	
	$options[] = array(
		'name' => 'Remove the content ?',
		'desc' => 'Remove the content ( Title, content, buttons and ask question ) ?',
		'id'   => 'remove_index_content',
		'type' => 'checkbox'
	);
	
	$options[] = array(
		'name'    => 'Home top box background',
		'desc'    => 'Home top box background.',
		'id'      => 'index_top_box_background',
		'std'     => 'background',
		'type'    => 'hidden',
	);
	
	$options[] = array(
		'name' =>  "Background",
		'desc' => "Upload a image, or enter URL to an image if it is already uploaded.",
		'id' => 'background_home',
		'std' => $background_defaults,
		'type' => 'background' );
	
	$options[] = array(
		'name' => "Full Screen Background",
		'id'   => "background_full_home",
		'type' => 'checkbox',
		'std'  => 0,
	);
	
	$options[] = array(
		'name' => 'Home top box title',
		'desc' => 'Put the Home top box title.',
		'id' => 'index_title',
		'std' => 'Welcome to Ask me',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Home top box content',
		'desc' => 'Put the Home top box content.',
		'id' => 'index_content',
		'std' => 'Duis dapibus aliquam mi, eget euismod sem scelerisque ut. Vivamus at elit quis urna adipiscing iaculis. Curabitur vitae velit in neque dictum blandit. Proin in iaculis neque.',
		'type' => 'textarea');
	
	$options[] = array(
		'name' => 'About Us title',
		'desc' => 'Put the About Us title.',
		'id' => 'index_about',
		'std' => 'About Us',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'About Us link',
		'desc' => 'Put the About Us link.',
		'id' => 'index_about_h',
		'std' => '#',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Join Now title',
		'desc' => 'Put the Join Now title.',
		'id' => 'index_join',
		'std' => 'Join Now',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Join Now link',
		'desc' => 'Put the Join Now link.',
		'id' => 'index_join_h',
		'std' => '#',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'About Us title if logged in',
		'desc' => 'Put the About Us title if logged in.',
		'id' => 'index_about_login',
		'std' => 'About Us',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'About Us link if login',
		'desc' => 'Put the About Us link if logged in.',
		'id' => 'index_about_h_login',
		'std' => '#',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Ask question title if logged in',
		'desc' => 'Put the Ask question title if logged in.',
		'id' => 'index_join_login',
		'std' => 'Ask question',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Ask question link if logged in',
		'desc' => 'Put the Ask question link if logged in.',
		'id' => 'index_join_h_login',
		'std' => '#',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Go to the page and add new page template <a href="post-new.php?post_type=page">from here</a> , choose the template page ( Home ) set it a static page <a href="options-reading.php">from here</a>.',
		'class' => 'home_page_display',
		'type' => 'info');
	
	$options[] = array(
		'name' => 'Questions',
		'type' => 'heading');
	
	$options[] = array(
		'name' => 'Questions slug',
		'desc' => 'Add your questions slug.',
		'id' => 'questions_slug',
		'std' => 'questions',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Questions category slug',
		'desc' => 'Add your questions category slug.',
		'id' => 'category_questions_slug',
		'std' => 'question-category',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Questions tag slug',
		'desc' => 'Add your questions tag slug.',
		'id' => 'tag_questions_slug',
		'std' => 'question-tag',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Display Like/disLike in main page',
		'desc' => 'Display Like/disLike in main page enable or disable.',
		'id' => 'question_vote_show',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Select ON to hide the dislike at questions',
		'desc' => 'If you put it ON the dislike will not show.',
		'id' => 'show_dislike_questions',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Select ON to hide the dislike at answers',
		'desc' => 'If you put it ON the dislike will not show.',
		'id' => 'show_dislike_answers',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Active the author image in the questions loop',
		'desc' => 'If you put it OFF the author name will add in the meta.',
		'id' => 'question_author',
		'std' => 1,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Click on to hide the excerpt in questions',
		'desc' => 'Click on to hide the excerpt in questions.',
		'id' => 'excerpt_questions',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Active the reports in site ?',
		'desc' => 'Active the reports enable or disable.',
		'id' => 'active_reports',
		'std' => 1,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Active the vote in site ?',
		'desc' => 'Active the vote enable or disable.',
		'id' => 'active_vote',
		'std' => 1,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Active the points system in site ?',
		'desc' => 'Active the points system enable or disable.',
		'id' => 'active_points',
		'std' => 1,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Any one can ask question without register',
		'desc' => 'Any one can ask question without register enable or disable.',
		'id' => 'ask_question_no_register',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => "Add question page",
		'desc' => "Create a page using the Add question template and select it here",
		'id' => 'add_question',
		'type' => 'select',
		'options' => $options_pages);
	
	$options[] = array(
		'name' => "Edit question page",
		'desc' => "Create a page using the Edit question template and select it here",
		'id' => 'edit_question',
		'type' => 'select',
		'options' => $options_pages);
	
	$options[] = array(
		'name' => 'After edit question approved auto or need to approved again?',
		'desc' => 'Press ON to approved auto',
		'id' => 'question_approved',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Details in ask question form is required',
		'desc' => 'Details in ask question form is required.',
		'id' => 'comment_question',
		'std' => 1,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Editor enable or disable for details in add question form',
		'desc' => 'Editor enable or disable for details in add question form.',
		'id' => 'editor_question_details',
		'std' => 1,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Tags enable or disable in add question form',
		'desc' => 'Select ON to enable the tags in add question form.',
		'id' => 'tags_question',
		'std' => 1,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Poll enable or disable in add question form',
		'desc' => 'Select ON to enable the poll in add question form.',
		'id' => 'poll_question',
		'std' => 1,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Attachment in add question form',
		'desc' => 'Select ON to enable the attachment in add question form.',
		'id' => 'attachment_question',
		'std' => 1,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Attachment in a new answer form',
		'desc' => 'Select ON to enable the attachment in a new answer form.',
		'id' => 'attachment_answer',
		'std' => 1,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Charge points for questions',
		'desc' => 'How many points should be taken from the user’s account for asking questions.',
		'id' => 'question_points',
		'std' => '5',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Charge points for questions settings',
		'desc' => 'Select ON if you want to charge points from users for asking questions.',
		'id' => 'question_points_active',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Point back to the user when he select the best answer',
		'desc' => 'Point back to the user when he select the best answer.',
		'id' => 'point_back',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Or type here the point want back',
		'desc' => 'Or type here the point want back, type 0 to back all the point.',
		'id' => 'point_back_number',
		'std' => '0',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Choose question status',
		'desc' => 'Choose question status after user publish the question.',
		'id' => 'question_publish',
		'options' => array("publish" => "Publish","draft" => "Draft"),
		'std' => 'publish',
		'type' => 'select');
	
	$options[] = array(
		'name' => 'Video description settings',
		'desc' => 'Select ON if you want to let users to add video with their question.',
		'id' => 'video_desc_active',
		'std' => 1,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'video description position',
		'desc' => 'Choose the video description position.',
		'id' => 'video_desc',
		'options' => array("before" => "Before content","after" => "After content"),
		'std' => 'after',
		'type' => 'select');
	
	$options[] = array(
		'name' => 'Send email for the user to notified a new question',
		'desc' => 'Send email enable or disable.',
		'id' => 'send_email_new_question',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Send email for custom groups to notified a new question',
		'desc' => 'Send email for custom groups to notified a new question.',
		'id' => 'send_email_question_groups',
		'type' => 'multicheck',
		'std' => array("editor" => 1,"administrator" => 1,"author" => 1,"contributor" => 1,"subscriber" => 1),
		'options' => $options_groups);
	
	$options[] = array(
		'name' => 'Active poll for user only ?',
		'desc' => 'Select ON if you want the poll allow to users only.',
		'id' => 'poll_user_only',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Select the question control style',
		'desc' => 'Select the question control style.',
		'id' => 'question_control_style',
		'std' => "style_1",
		'type' => 'select',
		'options' => array("style_1" => "Style 1","style_2" => "Style 2"));
	
	$options[] = array(
		'name' => 'Active user can edit the questions',
		'desc' => 'Select ON if you want the user can edit the questions.',
		'id' => 'question_edit',
		'std' => 1,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Active user can delete the questions',
		'desc' => 'Select ON if you want the user can delete the questions.',
		'id' => 'question_delete',
		'std' => 1,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Active user can follow the questions',
		'desc' => 'Select ON if you want the user can follow the questions.',
		'id' => 'question_follow',
		'std' => 1,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Active close and open questions',
		'desc' => 'Select ON if you want active close and open questions.',
		'id' => 'question_close',
		'std' => 1,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Active the question bump',
		'desc' => 'Select ON if you want the question bump.',
		'id' => 'question_bump',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Active the admin select or remove the best answer',
		'desc' => 'Select ON if you want the admin select or remove the best answer.',
		'id' => 'admin_best_answer',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Active the page terms ?',
		'desc' => 'Select ON if you want active the page terms.',
		'id' => 'terms_avtive',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Open the page in same page or a new page ?',
		'desc' => 'Open the page in same page or a new page.',
		'id' => 'terms_avtive_target',
		'std' => "new_page",
		'type' => 'select',
		'options' => array("same_page" => "Same page","new_page" => "New page"));
	
	$options[] = array(
		'name' => "Terms page",
		'desc' => "Select the terms page",
		'id' => 'terms_page',
		'type' => 'select',
		'options' => $options_pages);
	
	$options[] = array(
		'name' => "Type the terms links if you don't like a page",
		'desc' => "Type the terms links if you don't like a page",
		'id' => 'terms_link',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Payment setting',
		'type' => 'heading');
	
	$options[] = array(
		'name' => 'Pay to ask question',
		'desc' => 'Select ON to active the pay to ask question.',
		'id' => 'pay_ask',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Enable PayPal sandbox',
		'desc' => 'PayPal sandbox can be used to test payments.',
		'id' => 'paypal_sandbox',
		'std' => 0,
		'type' => 'checkbox');
	   
	$options[] = array(
		'name' => "Choose the groups add a question without pay",
		'desc' => "Choose the groups add a question without pay",
		'id' => 'payment_group',
		'type' => 'multicheck',
		'options' => $new_roles);
	
	$options[] = array(
		"name" => "What's the price to ask a new question?",
		"desc" => "Type here the price of the payment to ask a new question",
		"id" => "pay_ask_payment",
		"type" => "sliderui",
		'std' => 10,
		"step" => "5",
		"min" => "0",
		"max" => "200");
	
	$options[] = array(
		'name' => 'Currency code',
		'desc' => 'Choose form here the currency code.',
		'id' => 'currency_code',
		'std' => 'USD',
		'type' => "select",
		'options' => array(
			'USD' => 'USD',
			'EUR' => 'EUR',
			'GBP' => 'GBP')
		);
	
	$options[] = array(
		'name' => "PayPal email",
		'desc' => "put your PayPal email",
		'id' => 'paypal_email',
		'type' => 'text');
	
	$options[] = array(
		'name' => "Coupons setting",
		'class' => 'home_page_display',
		'type' => 'info');
	
	$options[] = array(
		'name' => 'Active the Coupons',
		'desc' => 'Select ON to active the Coupons.',
		'id' => 'active_coupons',
		'std' => 1,
		'type' => 'checkbox');
	
	$options[] = array(
		'desc' => "Add your Coupons.",
		'id' => "coupons",
		'std' => '',
		'type' => 'coupons');
	
	$options[] = array(
		'name' => 'Captcha setting',
		'type' => 'heading');
	
	$options[] = array(
		'name' => 'Captcha enable or disable ( in ask question form )',
		'desc' => 'Captcha enable or disable ( in ask question form ).',
		'id' => 'the_captcha',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Captcha enable or disable ( in add post form )',
		'desc' => 'Captcha enable or disable ( in add post form ).',
		'id' => 'the_captcha_post',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Captcha enable or disable ( in register form )',
		'desc' => 'Captcha enable or disable ( in register form ).',
		'id' => 'the_captcha_register',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Captcha enable or disable ( in login form )',
		'desc' => 'Captcha enable or disable ( in login form ).',
		'id' => 'the_captcha_login',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Captcha enable or disable ( in answer form )',
		'desc' => 'Captcha enable or disable ( in answer form ).',
		'id' => 'the_captcha_answer',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Captcha enable or disable ( in comment form )',
		'desc' => 'Captcha enable or disable ( in comment form ).',
		'id' => 'the_captcha_comment',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => "Captcha style",
		'desc' => "Choose the captcha style",
		'id' => 'captcha_style',
		'std' => 'question_answer',
		'type' => 'radio',
		'options' => 
			array(
				"question_answer" => "Question and answer",
				"normal_captcha" => "Normal captcha"
		)
	);
	
	$options[] = array(
		'name' => 'Captcha answer enable or disable in form ( in ask question form and register form )',
		'desc' => 'Captcha answer enable or disable.',
		'id' => 'show_captcha_answer',
		'std' => 1,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => "Captcha question",
		'desc' => "put the Captcha question",
		'id' => 'captcha_question',
		'type' => 'text',
		'std' => "What is the capital of Egypt ?");
	
	$options[] = array(
		'name' => "Captcha answer",
		'desc' => "put the Captcha answer",
		'id' => 'captcha_answer',
		'type' => 'text',
		'std' => "Cairo");
	
	$options[] = array(
		'name' => 'User setting',
		'type' => 'heading');
	
	$options[] = array(
		'name' => 'All the site for the register users only ?',
		'desc' => 'Click ON to active the site for the register users only.',
		'id' => 'site_users_only',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Send default message after register',
		'desc' => 'Send default message after register enable or disable.',
		'id' => 'send_default_message',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Select the user links',
		'desc' => 'Select the user links.',
		'id' => 'user_links',
		'type' => 'multicheck',
		'std' => array(
			"profile" => 1,
			"questions" => 1,
			"answers" => 1,
			"favorite" => 1,
			"points" => 1,
			"i_follow" => 1,
			"followers" => 1,
			"posts" => 1,
			"follow_questions" => 1,
			"follow_answers" => 1,
			"follow_posts" => 1,
			"follow_comments" => 1,
			"edit_profile" => 1,
			"logout" => 1,
		),
		'options' => array(
			"profile" => "Profile page",
			"questions" => "Questions",
			"answers" => "Answers",
			"favorite" => "Favorite Questions",
			"points" => "Points",
			"i_follow" => "Authors I Follow",
			"followers" => "Followers",
			"posts" => "Posts",
			"follow_questions" => "Follow Questions",
			"follow_answers" => "Follow Answers",
			"follow_posts" => "Follow Posts",
			"follow_comments" => "Follow Comments",
			"edit_profile" => "Edit Profile",
			"logout" => "Logout",
		));
	
	$options[] = array(
		'name' => 'Select the columns in the user admin',
		'desc' => 'Select the columns in the user admin.',
		'id' => 'user_meta_admin',
		'type' => 'multicheck',
		'std' => array(
			"phone" => 0,
			"country" => 0,
			"age" => 0,
		),
		'options' => array(
			"phone" => "Phone",
			"country" => "Country",
			"age" => "Age",
		));
	
	$options[] = array(
		'name' => "Login and register page",
		'desc' => "Select the Login and register page",
		'id' => 'login_register_page',
		'type' => 'select',
		'options' => $options_pages);
	
	$options[] = array(
		'name' => "User edit profile page",
		'desc' => "Select the User edit profile page",
		'id' => 'user_edit_profile_page',
		'type' => 'select',
		'options' => $options_pages);
	
	$options[] = array(
		'name' => "User post page",
		'desc' => "Select User post page",
		'id' => 'post_user_page',
		'type' => 'select',
		'options' => $options_pages);
	
	$options[] = array(
		'name' => "User question page",
		'desc' => "Select User question page",
		'id' => 'question_user_page',
		'type' => 'select',
		'options' => $options_pages);
	
	$options[] = array(
		'name' => "User answer page",
		'desc' => "Select User answer page",
		'id' => 'answer_user_page',
		'type' => 'select',
		'options' => $options_pages);
	
	$options[] = array(
		'name' => "User favorite question page",
		'desc' => "Select User favorite question page",
		'id' => 'favorite_user_page',
		'type' => 'select',
		'options' => $options_pages);
	
	$options[] = array(
		'name' => "User point page",
		'desc' => "Select User point page",
		'id' => 'point_user_page',
		'type' => 'select',
		'options' => $options_pages);
	
	$options[] = array(
		'name' => "Authors I Follow page",
		'desc' => "Select Authors I Follow page",
		'id' => 'i_follow_user_page',
		'type' => 'select',
		'options' => $options_pages);
	
	$options[] = array(
		'name' => "User Followers page",
		'desc' => "Select User Followers page",
		'id' => 'followers_user_page',
		'type' => 'select',
		'options' => $options_pages);
	
	$options[] = array(
		'name' => "User follow question page",
		'desc' => "Select User follow question page",
		'id' => 'follow_question_page',
		'type' => 'select',
		'options' => $options_pages);
	
	$options[] = array(
		'name' => "User follow answer page",
		'desc' => "Select User follow answer page",
		'id' => 'follow_answer_page',
		'type' => 'select',
		'options' => $options_pages);
	
	$options[] = array(
		'name' => "User follow posts page",
		'desc' => "Select User follow posts page",
		'id' => 'follow_post_page',
		'type' => 'select',
		'options' => $options_pages);
	
	$options[] = array(
		'name' => "User follow comment page",
		'desc' => "Select User follow comment page",
		'id' => 'follow_comment_page',
		'type' => 'select',
		'options' => $options_pages);
	
	$options[] = array(
		'name' => 'Badges & Points setting',
		'type' => 'heading');
	
	$options[] = array(
		'desc' => "Add your badges.",
		'id' => "badges",
		'std' => '',
		'type' => 'badges');
	
	$options[] = array(
		'name' => "Points setting",
		'class' => 'home_page_display',
		'type' => 'info');
	
	$options[] = array(
		'name' => "Points for add a new question ( put it 0 for off the option )",
		'desc' => "put the Points choose for add a new question",
		'id' => 'point_add_question',
		'type' => 'text',
		'std' => 0);
	
	$options[] = array(
		'name' => "Points choose best answer",
		'desc' => "put the Points choose best answer",
		'id' => 'point_best_answer',
		'type' => 'text',
		'std' => 5);
	
	$options[] = array(
		'name' => "Points Rating question",
		'desc' => "put the Points Rating question",
		'id' => 'point_rating_question',
		'type' => 'text',
		'std' => 0);
	
	$options[] = array(
		'name' => "Points add comment",
		'desc' => "put the Points add comment",
		'id' => 'point_add_comment',
		'type' => 'text',
		'std' => 2);
	
	$options[] = array(
		'name' => "Points Rating answer",
		'desc' => "put the Points Rating answer",
		'id' => 'point_rating_answer',
		'type' => 'text',
		'std' => 1);
	
	$options[] = array(
		'name' => "Points following user",
		'desc' => "put the Points following user",
		'id' => 'point_following_me',
		'type' => 'text',
		'std' => 1);
	
	$options[] = array(
		'name' => "Points for a new user",
		'desc' => "put the Points for a new user",
		'id' => 'point_new_user',
		'type' => 'text',
		'std' => 20);
	
	$options[] = array(
		'name' => 'User group setting',
		'type' => 'heading');
	
	$options[] = array(
		'name' => 'Select ON to can add a custom permission.',
		'desc' => 'Select ON to can add a custom permission.',
		'id' => 'custom_permission',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => "Without login user",
		'class' => 'home_page_display',
		'type' => 'info');
	
	$options[] = array(
		'name' => 'Select ON to can add a question.',
		'desc' => 'Select ON to can add a question.',
		'id' => 'ask_question',
		'std' => 1,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Select ON to can show other questions.',
		'desc' => 'Select ON to can show other questions.',
		'id' => 'show_question',
		'std' => 1,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Select ON to can add a answer.',
		'desc' => 'Select ON to can add a answer.',
		'id' => 'add_answer',
		'std' => 1,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Select ON to can show other answers.',
		'desc' => 'Select ON to can show other answers.',
		'id' => 'show_answer',
		'std' => 1,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Select ON to can add a post.',
		'desc' => 'Select ON to can add a post.',
		'id' => 'add_post',
		'std' => 1,
		'type' => 'checkbox');
	
	$options[] = array(
		'desc' => "Add your groups.",
		'id' => "roles",
		'std' => '',
		'type' => 'roles');
	
	$options[] = array(
		'name' => 'Register setting',
		'type' => 'heading');
	
	$options[] = array(
		'name' => "Register in default group",
		'desc' => "Select the default group",
		'id' => 'default_group',
		'std' => 'subscriber',
		'type' => 'select',
		'options' => $new_roles);
	
	$options[] = array(
		'name' => 'Confirm with email enable or disable ( in register form )',
		'desc' => 'Confirm with email enable or disable.',
		'id' => 'confirm_email',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Add profile picture in register form',
		'desc' => 'Add profile picture in register form.',
		'id' => 'profile_picture',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Profile picture in register form is required',
		'desc' => 'Profile picture in register form is required.',
		'id' => 'profile_picture_required',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Add country in register form',
		'desc' => 'Add country in register form.',
		'id' => 'country_register',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Country in register form is required',
		'desc' => 'Country in register form is required.',
		'id' => 'country_required',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Add city in register form',
		'desc' => 'Add city in register form.',
		'id' => 'city_register',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'City in register form is required',
		'desc' => 'City in register form is required.',
		'id' => 'city_required',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Add age in register form',
		'desc' => 'Add age in register form.',
		'id' => 'age_register',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Age in register form is required',
		'desc' => 'Age in register form is required.',
		'id' => 'age_required',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Add phone in register form',
		'desc' => 'Add phone in register form.',
		'id' => 'phone_register',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Phone in register form is required',
		'desc' => 'Phone in register form is required.',
		'id' => 'phone_required',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Add sex in register form',
		'desc' => 'Add sex in register form.',
		'id' => 'sex_register',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Sex in register form is required',
		'desc' => 'Sex in register form is required.',
		'id' => 'sex_required',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Add names in register form',
		'desc' => 'Add names in register form.',
		'id' => 'names_register',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Names in register form is required',
		'desc' => 'Names in register form is required.',
		'id' => 'names_required',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Active the page terms ?',
		'desc' => 'Select ON if you want active the page terms.',
		'id' => 'terms_avtive_register',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Open the page in same page or a new page ?',
		'desc' => 'Open the page in same page or a new page.',
		'id' => 'terms_avtive_target_register',
		'std' => "new_page",
		'type' => 'select',
		'options' => array("same_page" => "Same page","new_page" => "New page"));
	
	$options[] = array(
		'name' => "Terms page",
		'desc' => "Select the terms page",
		'id' => 'terms_page_register',
		'type' => 'select',
		'options' => $options_pages);
	
	$options[] = array(
		'name' => "Type the terms links if you don't like a page",
		'desc' => "Type the terms links if you don't like a page",
		'id' => 'terms_link_register',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Register content',
		'desc' => 'Put the register content in top panel and register page.',
		'id' => 'register_content',
		'std' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravdio, sit amet suscipit risus ultrices eu. Fusce viverra neque at purus laoreet consequa. Vivamus vulputate posuere nisl quis consequat.',
		'type' => 'textarea');
	
	$options[] = array(
		'name' => 'New post setting',
		'type' => 'heading');
	
	$options[] = array(
		'name' => 'Any one can add post without register',
		'desc' => 'Any one can add post without register enable or disable.',
		'id' => 'add_post_no_register',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Choose post status',
		'desc' => 'Choose post status after user publish the post.',
		'id' => 'post_publish',
		'options' => array("publish" => "Publish","draft" => "Draft"),
		'std' => 'draft',
		'type' => 'select');
	
	$options[] = array(
		'name' => 'Tags enable or disable in add post form',
		'desc' => 'Select ON to enable the tags in add post form.',
		'id' => 'tags_post',
		'std' => 1,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Attachment in add post form',
		'desc' => 'Select ON to enable the attachment in add post form.',
		'id' => 'attachment_post',
		'std' => 1,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Details in add post form is required',
		'desc' => 'Details in add post form is required.',
		'id' => 'content_post',
		'std' => 1,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Editor enable or disable for details in add post form',
		'desc' => 'Editor enable or disable for details in add post form.',
		'id' => 'editor_post_details',
		'std' => 1,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'The users can edit the posts ?',
		'desc' => 'The users can edit the posts ?',
		'id' => 'can_edit_post',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => "Edit post page",
		'desc' => "Create a page using the Edit post template and select it here",
		'id' => 'edit_post',
		'type' => 'select',
		'options' => $options_pages);
	
	$options[] = array(
		'name' => 'After edit post approved auto or need to approved again?',
		'desc' => 'Press ON to approved auto',
		'id' => 'post_approved',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Active user can delete the posts',
		'desc' => 'Select ON if you want the user can delete the posts.',
		'id' => 'post_delete',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Author Page',
		'type' => 'heading');
	
	$options[] = array(
		'name' => 'Hide the user registered in profile page',
		'desc' => 'Select ON if you want to hide the user registered in profile page.',
		'id' => 'user_registered',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Hide the user country in profile page',
		'desc' => 'Select ON if you want to hide the user country in profile page.',
		'id' => 'user_country',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Hide the user city in profile page',
		'desc' => 'Select ON if you want to hide the user city in profile page.',
		'id' => 'user_city',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Hide the user phone in profile page',
		'desc' => 'Select ON if you want to hide the user phone in profile page.',
		'id' => 'user_phone',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Hide the user age in profile page',
		'desc' => 'Select ON if you want to hide the user age in profile page.',
		'id' => 'user_age',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Hide the user sex in profile page',
		'desc' => 'Select ON if you want to hide the user sex in profile page.',
		'id' => 'user_sex',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Hide the user url in profile page',
		'desc' => 'Select ON if you want to hide the user url in profile page.',
		'id' => 'user_url',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => "Author sidebar layout",
		'desc' => "Author sidebar layout.",
		'id' => "author_sidebar_layout",
		'std' => "default",
		'type' => "images",
		'options' => array(
			'default' => $imagepath . 'sidebar_default.jpg',
			'right' => $imagepath . 'sidebar_right.jpg',
			'full' => $imagepath . 'sidebar_no.jpg',
			'left' => $imagepath . 'sidebar_left.jpg',
		)
	);
	
	$options[] = array(
		'name' => "Author Page Sidebar",
		'desc' => "Author Page Sidebar.",
		'id' => "author_sidebar",
		'std' => '',
		'options' => $new_sidebars,
		'type' => 'select');
	
	$options[] = array(
		'name' => "Author page layout",
		'desc' => "Author page layout.",
		'id' => "author_layout",
		'std' => "full",
		'type' => "images",
		'options' => array(
			'default' => $imagepath . 'sidebar_default.jpg',
			'full' => $imagepath . 'full.jpg',
			'fixed' => $imagepath . 'fixed.jpg',
			'fixed_2' => $imagepath . 'fixed_2.jpg'
		)
	);
	
	$options[] = array(
		'name' => "Choose template",
		'desc' => "Choose template layout.",
		'id' => "author_template",
		'std' => "grid_1200",
		'type' => "images",
		'options' => array(
			'default' => $imagepath . 'sidebar_default.jpg',
			'grid_1200' => $imagepath . 'template_1200.jpg',
			'grid_970' => $imagepath . 'template_970.jpg'
		)
	);
	
	$options[] = array(
		'name' => "Site skin",
		'desc' => "Choose Site skin.",
		'id' => "author_skin_l",
		'std' => "site_light",
		'type' => "images",
		'options' => array(
			'default' => $imagepath . 'sidebar_default.jpg',
			'site_light' => $imagepath . 'light.jpg',
			'site_dark' => $imagepath . 'dark.jpg'
		)
	);
	
	$options[] = array(
		'name' => "Choose Your Skin",
		'desc' => "Choose Your Skin",
		'class' => "site_skin",
		'id' => "author_skin",
		'std' => "default",
		'type' => "images",
		'options' => array(
			'default'	    => $imagepath . 'default.jpg',
			'skins'		    => $imagepath . 'skin.jpg',
			'blue'			=> $imagepath . 'blue.jpg',
			'gray'			=> $imagepath . 'gray.jpg',
			'green'			=> $imagepath . 'green.jpg',
			'moderate_cyan' => $imagepath . 'moderate_cyan.jpg',
			'orange'		=> $imagepath . 'orange.jpg',
			'purple'	    => $imagepath . 'purple.jpg',
			'red'			=> $imagepath . 'red.jpg',
			'strong_cyan'	=> $imagepath . 'strong_cyan.jpg',
			'yellow'		=> $imagepath . 'yellow.jpg',
		)
	);
	
	$options[] = array(
		'name' => "Primary Color",
		'desc' => "Primary Color",
		'id' => 'author_primary_color',
		'type' => 'color' );
	
	$options[] = array(
		'name' => "Secondary Color ( it's darkness more than primary color )",
		'desc' => "Secondary Color ( it's darkness more than primary color )",
		'id' => 'author_secondary_color',
		'type' => 'color' );
	
	$options[] = array(
		'name' => "Background Type",
		'desc' => "Background Type",
		'id' => 'author_background_type',
		'std' => 'patterns',
		'type' => 'radio',
		'options' => 
			array(
				"patterns" => "Patterns",
				"custom_background" => "Custom Background"
			)
	);

	$options[] = array(
		'name' => "Background Color",
		'desc' => "Background Color",
		'id' => 'author_background_color',
		'std' => "#FFF",
		'type' => 'color' );
		
	$options[] = array(
		'name' => "Choose Pattern",
		'desc' => "Choose Pattern",
		'id' => "author_background_pattern",
		'std' => "bg13",
		'type' => "images",
		'options' => array(
			'bg1' => $imagepath . 'bg1.jpg',
			'bg2' => $imagepath . 'bg2.jpg',
			'bg3' => $imagepath . 'bg3.jpg',
			'bg4' => $imagepath . 'bg4.jpg',
			'bg5' => $imagepath . 'bg5.jpg',
			'bg6' => $imagepath . 'bg6.jpg',
			'bg7' => $imagepath . 'bg7.jpg',
			'bg8' => $imagepath . 'bg8.jpg',
			'bg9' => $imagepath . '../../images/patterns/bg9.png',
			'bg10' => $imagepath . '../../images/patterns/bg10.png',
			'bg11' => $imagepath . '../../images/patterns/bg11.png',
			'bg12' => $imagepath . '../../images/patterns/bg12.png',
			'bg13' => $imagepath . 'bg13.jpg',
			'bg14' => $imagepath . 'bg14.jpg',
			'bg15' => $imagepath . '../../images/patterns/bg15.png',
			'bg16' => $imagepath . '../../images/patterns/bg16.png',
			'bg17' => $imagepath . 'bg17.jpg',
			'bg18' => $imagepath . 'bg18.jpg',
			'bg19' => $imagepath . 'bg19.jpg',
			'bg20' => $imagepath . 'bg20.jpg',
			'bg21' => $imagepath . '../../images/patterns/bg21.png',
			'bg22' => $imagepath . 'bg22.jpg',
			'bg23' => $imagepath . '../../images/patterns/bg23.png',
			'bg24' => $imagepath . '../../images/patterns/bg24.png',
	));

	$options[] = array(
		'name' =>  "Custom Background",
		'desc' => "Custom Background",
		'id' => 'author_custom_background',
		'std' => $background_defaults,
		'type' => 'background' );
		
	$options[] = array(
		'name' => "Full Screen Background",
		'desc' => "Click on to Full Screen Background",
		'id' => 'author_full_screen_background',
		'std' => '0',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Blog & Article settings',
		'type' => 'heading');
	
	$options[] = array(
		'name' => "Blog display",
		'desc' => "Choose the Blog display",
		'id' => 'home_display',
		'std' => 'blog_1',
		'type' => 'radio',
		'options' => 
			array(
				"blog_1" => "Blog 1",
				"blog_2" => "Blog 2"
		)
	);
	
	$options[] = array(
		'name' => 'Type the date format see this link also : http://codex.wordpress.org/Formatting_Date_and_Time',
		'desc' => 'Type here your date format.',
		'id' => 'date_format',
		'std' => 'F j , Y',
		'type' => 'text');
	
	$options[] = array(
		'desc' => "Sort your sections.",
		'name' => "Sort your sections.",
		'id' => "order_sections_li",
		'std' => '',
		'type' => 'sections');
	
	$options[] = array(
		'name' => 'Hide the featured image in the single post',
		'desc' => 'Click on to hide the featured image in the single post.',
		'id' => 'featured_image',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Excerpt type ',
		'desc' => 'Choose form here the excerpt type.',
		'id' => 'excerpt_type',
		'std' => 5,
		'type' => "select",
		'options' => array(
			'words' => 'Words',
			'characters' => 'Characters')
		);
	
	$options[] = array(
		'name' => 'Excerpt post',
		'desc' => 'Put here the excerpt post.',
		'id' => 'post_excerpt',
		'std' => 40,
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Post meta enable or disable',
		'desc' => 'Post meta enable or disable.',
		'id' => 'post_meta',
		'std' => 1,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Share enable or disable',
		'desc' => 'Share enable or disable.',
		'id' => 'post_share',
		'std' => 1,
		'type' => 'checkbox');
		
	$options[] = array(
		'name' => 'Author info box enable or disable',
		'desc' => 'Author info box enable or disable.',
		'id' => 'post_author_box',
		'std' => 1,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Related post enable or disable',
		'desc' => 'Related post enable or disable.',
		'id' => 'related_post',
		'std' => 1,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Related post number',
		'desc' => 'Type related post number from here.',
		'id' => 'related_number',
		'std' => '5',
		'type' => 'text');
	
	$options[] = array(
		'name' => "Related post query",
		'desc' => "Select your related post query.",
		'id' => "related_query",
		'std' => "categories",
		'type' => "select",
		'options' => array(
			'categories' => 'Categories',
			'tags' => 'Tags',
		)
	);
	
	$options[] = array(
		'name' => 'Comments enable or disable',
		'desc' => 'Comments enable or disable.',
		'id' => 'post_comments',
		'std' => 1,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Enable the editor in the comment or disable',
		'desc' => 'Enable the editor in the comment or disable.',
		'id' => 'comment_editor',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Comments enable or disable for user only',
		'desc' => 'Comments enable or disable for user only.',
		'id' => 'post_comments_user',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'User can edit the comment or answer?',
		'desc' => 'User can edit the comment or answer?',
		'id' => 'can_edit_comment',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		"name" => "User can edit the comment or answer after -- hours",
		"desc" => "If you want the user edit it all the time leave it 0",
		"id" => "can_edit_comment_after",
		"type" => "sliderui",
		'std' => 1,
		"step" => "1",
		"min" => "0",
		"max" => "24");
	
	$options[] = array(
		'name' => "Edit comment page",
		'desc' => "Create a page using the Edit post template and select it here",
		'id' => 'edit_comment',
		'type' => 'select',
		'options' => $options_pages);
	
	$options[] = array(
		'name' => 'After edit comment or answer approved auto or need to approved again?',
		'desc' => 'Press ON to approved auto',
		'id' => 'comment_approved',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Navigation post enable or disable',
		'desc' => 'Navigation post ( next and previous posts) enable or disable.',
		'id' => 'post_navigation',
		'std' => 1,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Sidebar',
		'type' => 'heading');
	
	$options[] = array(
		'desc' => "Add your sidebars.",
		'id' => "sidebars",
		'std' => '',
		'type' => 'sidebar');
	
	$options[] = array(
		'name' => "Sidebar width",
		'desc' => "Sidebar width",
		'id' => 'sidebar_width',
		'std' => 'col-md-3',
		'type' => 'radio',
		'options' => 
			array(
				"col-md-3" => "1/4",
				"col-md-4" => "1/3"
			)
		);
	
	$options[] = array(
		'name' => "Sticky sidebar",
		'desc' => "Click on to active the sticky sidebar",
		'id' => 'sticky_sidebar',
		'std' => 1,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => "Sidebar layout",
		'desc' => "Sidebar layout.",
		'id' => "sidebar_layout",
		'std' => "default",
		'type' => "images",
		'options' => array(
			'default' => $imagepath . 'sidebar_default.jpg',
			'right' => $imagepath . 'sidebar_right.jpg',
			'full' => $imagepath . 'sidebar_no.jpg',
			'left' => $imagepath . 'sidebar_left.jpg',
		)
	);
	
	$options[] = array(
		'name' => "Home Page Sidebar",
		'desc' => "Home Page Sidebar.",
		'id' => "sidebar_home",
		'std' => '',
		'options' => $new_sidebars,
		'type' => 'select');
	
	$options[] = array(
		'name' => "Else home page , single and page",
		'desc' => "Else home page , single and page.",
		'id' => "else_sidebar",
		'std' => '',
		'options' => $new_sidebars,
		'type' => 'select');
	
	$options[] = array(
		'name' => 'Styling',
		'type' => 'heading');
	
	$options[] = array(
		'name' => "Home page layout",
		'desc' => "Home page layout.",
		'id' => "home_layout",
		'std' => "full",
		'type' => "images",
		'options' => array(
			'full' => $imagepath . 'full.jpg',
			'fixed' => $imagepath . 'fixed.jpg',
			'fixed_2' => $imagepath . 'fixed_2.jpg'
		)
	);
	
	$options[] = array(
		'name' => "Choose template",
		'desc' => "Choose template layout.",
		'id' => "home_template",
		'std' => "grid_1200",
		'type' => "images",
		'options' => array(
			'grid_1200' => $imagepath . 'template_1200.jpg',
			'grid_970' => $imagepath . 'template_970.jpg'
		)
	);
	
	$options[] = array(
		'name' => "Site skin",
		'desc' => "Choose Site skin.",
		'id' => "site_skin_l",
		'std' => "site_light",
		'type' => "images",
		'options' => array(
			'site_light' => $imagepath . 'light.jpg',
			'site_dark' => $imagepath . 'dark.jpg'
		)
	);
	
	$options[] = array(
		'name' => "Choose Your Skin",
		'desc' => "Choose Your Skin",
		'class' => "site_skin",
		'id' => "site_skin",
		'std' => "skins",
		'type' => "images",
		'options' => array(
			'skins'		    => $imagepath . 'skin.jpg',
			'blue'			=> $imagepath . 'blue.jpg',
			'gray'			=> $imagepath . 'gray.jpg',
			'green'			=> $imagepath . 'green.jpg',
			'moderate_cyan' => $imagepath . 'moderate_cyan.jpg',
			'orange'		=> $imagepath . 'orange.jpg',
			'purple'	    => $imagepath . 'purple.jpg',
			'red'			=> $imagepath . 'red.jpg',
			'strong_cyan'	=> $imagepath . 'strong_cyan.jpg',
			'yellow'		=> $imagepath . 'yellow.jpg',
		)
	);
	
	$options[] = array(
		'name' => "Primary Color",
		'desc' => "Primary Color",
		'id' => 'primary_color',
		'type' => 'color' );
	
	$options[] = array(
		'name' => "Secondary Color ( it's darkness more than primary color )",
		'desc' => "Secondary Color ( it's darkness more than primary color )",
		'id' => 'secondary_color',
		'type' => 'color' );
	
	$options[] = array(
		'name' => "Background Type",
		'desc' => "Background Type",
		'id' => 'background_type',
		'std' => 'patterns',
		'type' => 'radio',
		'options' => 
			array(
				"patterns" => "Patterns",
				"custom_background" => "Custom Background"
			)
		);

	$options[] = array(
		'name' => "Background Color",
		'desc' => "Background Color",
		'id' => 'background_color',
		'std' => "#FFF",
		'type' => 'color' );
		
	$options[] = array(
		'name' => "Choose Pattern",
		'desc' => "Choose Pattern",
		'id' => "background_pattern",
		'std' => "bg13",
		'type' => "images",
		'options' => array(
			'bg1' => $imagepath . 'bg1.jpg',
			'bg2' => $imagepath . 'bg2.jpg',
			'bg3' => $imagepath . 'bg3.jpg',
			'bg4' => $imagepath . 'bg4.jpg',
			'bg5' => $imagepath . 'bg5.jpg',
			'bg6' => $imagepath . 'bg6.jpg',
			'bg7' => $imagepath . 'bg7.jpg',
			'bg8' => $imagepath . 'bg8.jpg',
			'bg9' => $imagepath . '../../images/patterns/bg9.png',
			'bg10' => $imagepath . '../../images/patterns/bg10.png',
			'bg11' => $imagepath . '../../images/patterns/bg11.png',
			'bg12' => $imagepath . '../../images/patterns/bg12.png',
			'bg13' => $imagepath . 'bg13.jpg',
			'bg14' => $imagepath . 'bg14.jpg',
			'bg15' => $imagepath . '../../images/patterns/bg15.png',
			'bg16' => $imagepath . '../../images/patterns/bg16.png',
			'bg17' => $imagepath . 'bg17.jpg',
			'bg18' => $imagepath . 'bg18.jpg',
			'bg19' => $imagepath . 'bg19.jpg',
			'bg20' => $imagepath . 'bg20.jpg',
			'bg21' => $imagepath . '../../images/patterns/bg21.png',
			'bg22' => $imagepath . 'bg22.jpg',
			'bg23' => $imagepath . '../../images/patterns/bg23.png',
			'bg24' => $imagepath . '../../images/patterns/bg24.png',
	));

	$options[] = array(
		'name' =>  "Custom Background",
		'desc' => "Custom Background",
		'id' => 'custom_background',
		'std' => $background_defaults,
		'type' => 'background' );
		
	$options[] = array(
		'name' => "Full Screen Background",
		'desc' => "Click on to Full Screen Background",
		'id' => 'full_screen_background',
		'std' => '0',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Questions Styling',
		'type' => 'heading');
	
	$options[] = array(
		'name' => "Custom Logo position - Header skin - Logo display ?",
		'desc' => "Click on to make a Custom Logo position - Header skin - Logo display",
		'id' => 'questions_custom_header',
		'std' => '0',
		'type' => 'checkbox');
	
	if (is_rtl()) {
		$options[] = array(
			'name' => "Logo position for questions",
			'desc' => "Select where you would like your logo to appear for questions.",
			'id' => "questions_logo_position",
			'std' => "left_logo",
			'type' => "images",
			'options' => array(
				'left_logo' => $imagepath . 'right_logo.jpg',
				'right_logo' => $imagepath . 'left_logo.jpg',
				'center_logo' => $imagepath . 'center_logo.jpg'
			)
		);
	}else {
		$options[] = array(
			'name' => "Logo position for questions",
			'desc' => "Select where you would like your logo to appear for questions.",
			'id' => "questions_logo_position",
			'std' => "left_logo",
			'type' => "images",
			'options' => array(
				'left_logo' => $imagepath . 'left_logo.jpg',
				'right_logo' => $imagepath . 'right_logo.jpg',
				'center_logo' => $imagepath . 'center_logo.jpg'
			)
		);
	}
	
	$options[] = array(
		'name' => "Header skin for questions",
		'desc' => "Select your preferred header skin for questions.",
		'id' => "questions_header_skin",
		'std' => "header_dark",
		'type' => "images",
		'options' => array(
			'header_dark' => $imagepath . 'left_logo.jpg',
			'header_light' => $imagepath . 'header_light.jpg'
		)
	);
	
	$options[] = array(
		'name' => 'Logo display for questions',
		'desc' => 'choose Logo display for questions.',
		'id' => 'questions_logo_display',
		'std' => 'display_title',
		'type' => 'radio',
		'options' => array("display_title" => "Display site title","custom_image" => "Custom Image"));
	
	$options[] = array(
		'name' => 'Logo upload for questions',
		'desc' => 'Upload your custom logo for questions. ',
		'id' => 'questions_logo_img',
		'std' => '',
		'type' => 'upload');
	
	$options[] = array(
		'name' => 'Logo retina upload for questions',
		'desc' => 'Upload your custom logo retina for questions. ',
		'id' => 'questions_retina_logo',
		'std' => '',
		'type' => 'upload');
	
	$options[] = array(
		'name' => "Questions sidebar layout",
		'desc' => "Questions sidebar layout.",
		'id' => "questions_sidebar_layout",
		'std' => "default",
		'type' => "images",
		'options' => array(
			'default' => $imagepath . 'sidebar_default.jpg',
			'right' => $imagepath . 'sidebar_right.jpg',
			'full' => $imagepath . 'sidebar_no.jpg',
			'left' => $imagepath . 'sidebar_left.jpg',
		)
	);
	
	$options[] = array(
		'name' => "Questions Page Sidebar",
		'desc' => "Questions Page Sidebar.",
		'id' => "questions_sidebar",
		'std' => '',
		'options' => $new_sidebars,
		'type' => 'select');
	
	$options[] = array(
		'name' => "Questions page layout",
		'desc' => "Questions page layout.",
		'id' => "questions_layout",
		'std' => "full",
		'type' => "images",
		'options' => array(
			'default' => $imagepath . 'sidebar_default.jpg',
			'full' => $imagepath . 'full.jpg',
			'fixed' => $imagepath . 'fixed.jpg',
			'fixed_2' => $imagepath . 'fixed_2.jpg'
		)
	);
	
	$options[] = array(
		'name' => "Choose template",
		'desc' => "Choose template layout.",
		'id' => "questions_template",
		'std' => "grid_1200",
		'type' => "images",
		'options' => array(
			'default' => $imagepath . 'sidebar_default.jpg',
			'grid_1200' => $imagepath . 'template_1200.jpg',
			'grid_970' => $imagepath . 'template_970.jpg'
		)
	);
	
	$options[] = array(
		'name' => "Site skin",
		'desc' => "Choose Site skin.",
		'id' => "questions_skin_l",
		'std' => "site_light",
		'type' => "images",
		'options' => array(
			'default' => $imagepath . 'sidebar_default.jpg',
			'site_light' => $imagepath . 'light.jpg',
			'site_dark' => $imagepath . 'dark.jpg'
		)
	);
	
	$options[] = array(
		'name' => "Choose Your Skin",
		'desc' => "Choose Your Skin",
		'class' => "site_skin",
		'id' => "questions_skin",
		'std' => "default",
		'type' => "images",
		'options' => array(
			'default'	    => $imagepath . 'default.jpg',
			'skins'		    => $imagepath . 'skin.jpg',
			'blue'			=> $imagepath . 'blue.jpg',
			'gray'			=> $imagepath . 'gray.jpg',
			'green'			=> $imagepath . 'green.jpg',
			'moderate_cyan' => $imagepath . 'moderate_cyan.jpg',
			'orange'		=> $imagepath . 'orange.jpg',
			'purple'	    => $imagepath . 'purple.jpg',
			'red'			=> $imagepath . 'red.jpg',
			'strong_cyan'	=> $imagepath . 'strong_cyan.jpg',
			'yellow'		=> $imagepath . 'yellow.jpg',
		)
	);
	
	$options[] = array(
		'name' => "Primary Color",
		'desc' => "Primary Color",
		'id' => 'questions_primary_color',
		'type' => 'color' );
	
	$options[] = array(
		'name' => "Secondary Color ( it's darkness more than primary color )",
		'desc' => "Secondary Color ( it's darkness more than primary color )",
		'id' => 'questions_secondary_color',
		'type' => 'color' );
	
	$options[] = array(
		'name' => "Background Type",
		'desc' => "Background Type",
		'id' => 'questions_background_type',
		'std' => 'patterns',
		'type' => 'radio',
		'options' => 
			array(
				"patterns" => "Patterns",
				"custom_background" => "Custom Background"
			)
	);

	$options[] = array(
		'name' => "Background Color",
		'desc' => "Background Color",
		'id' => 'questions_background_color',
		'std' => "#FFF",
		'type' => 'color' );
		
	$options[] = array(
		'name' => "Choose Pattern",
		'desc' => "Choose Pattern",
		'id' => "questions_background_pattern",
		'std' => "bg13",
		'type' => "images",
		'options' => array(
			'bg1' => $imagepath . 'bg1.jpg',
			'bg2' => $imagepath . 'bg2.jpg',
			'bg3' => $imagepath . 'bg3.jpg',
			'bg4' => $imagepath . 'bg4.jpg',
			'bg5' => $imagepath . 'bg5.jpg',
			'bg6' => $imagepath . 'bg6.jpg',
			'bg7' => $imagepath . 'bg7.jpg',
			'bg8' => $imagepath . 'bg8.jpg',
			'bg9' => $imagepath . '../../images/patterns/bg9.png',
			'bg10' => $imagepath . '../../images/patterns/bg10.png',
			'bg11' => $imagepath . '../../images/patterns/bg11.png',
			'bg12' => $imagepath . '../../images/patterns/bg12.png',
			'bg13' => $imagepath . 'bg13.jpg',
			'bg14' => $imagepath . 'bg14.jpg',
			'bg15' => $imagepath . '../../images/patterns/bg15.png',
			'bg16' => $imagepath . '../../images/patterns/bg16.png',
			'bg17' => $imagepath . 'bg17.jpg',
			'bg18' => $imagepath . 'bg18.jpg',
			'bg19' => $imagepath . 'bg19.jpg',
			'bg20' => $imagepath . 'bg20.jpg',
			'bg21' => $imagepath . '../../images/patterns/bg21.png',
			'bg22' => $imagepath . 'bg22.jpg',
			'bg23' => $imagepath . '../../images/patterns/bg23.png',
			'bg24' => $imagepath . '../../images/patterns/bg24.png',
	));

	$options[] = array(
		'name' =>  "Custom Background",
		'desc' => "Custom Background",
		'id' => 'questions_custom_background',
		'std' => $background_defaults,
		'type' => 'background' );
		
	$options[] = array(
		'name' => "Full Screen Background",
		'desc' => "Click on to Full Screen Background",
		'id' => 'questions_full_screen_background',
		'std' => '0',
		'type' => 'checkbox');
	
	if ( class_exists( 'woocommerce' ) ) {
		$options[] = array(
			'name' => 'Products Setting',
			'type' => 'heading');
		
		$options[] = array(
			'name' => "Custom Logo position - Header skin - Logo display ?",
			'desc' => "Click on to make a Custom Logo position - Header skin - Logo display",
			'id' => 'products_custom_header',
			'std' => '0',
			'type' => 'checkbox');
		
		if (is_rtl()) {
			$options[] = array(
				'name' => "Logo position for products",
				'desc' => "Select where you would like your logo to appear for products.",
				'id' => "products_logo_position",
				'std' => "left_logo",
				'type' => "images",
				'options' => array(
					'left_logo' => $imagepath . 'right_logo.jpg',
					'right_logo' => $imagepath . 'left_logo.jpg',
					'center_logo' => $imagepath . 'center_logo.jpg'
				)
			);
		}else {
			$options[] = array(
				'name' => "Logo position for products",
				'desc' => "Select where you would like your logo to appear for products.",
				'id' => "products_logo_position",
				'std' => "left_logo",
				'type' => "images",
				'options' => array(
					'left_logo' => $imagepath . 'left_logo.jpg',
					'right_logo' => $imagepath . 'right_logo.jpg',
					'center_logo' => $imagepath . 'center_logo.jpg'
				)
			);
		}
		
		$options[] = array(
			'name' => "Header skin for products",
			'desc' => "Select your preferred header skin for products.",
			'id' => "products_header_skin",
			'std' => "header_dark",
			'type' => "images",
			'options' => array(
				'header_dark' => $imagepath . 'left_logo.jpg',
				'header_light' => $imagepath . 'header_light.jpg'
			)
		);
		
		$options[] = array(
			'name' => 'Logo display for products',
			'desc' => 'choose Logo display for products.',
			'id' => 'products_logo_display',
			'std' => 'display_title',
			'type' => 'radio',
			'options' => array("display_title" => "Display site title","custom_image" => "Custom Image"));
		
		$options[] = array(
			'name' => 'Logo upload for products',
			'desc' => 'Upload your custom logo for products. ',
			'id' => 'products_logo_img',
			'std' => '',
			'type' => 'upload');
		
		$options[] = array(
			'name' => 'Logo retina upload for products',
			'desc' => 'Upload your custom logo retina for products. ',
			'id' => 'products_retina_logo',
			'std' => '',
			'type' => 'upload');
		
		$options[] = array(
			'name' => 'Related products number',
			'desc' => 'Type related products number from here.',
			'id' => 'related_products_number',
			'std' => '3',
			'type' => 'text');
		
		$options[] = array(
			'name' => 'Related products number full width',
			'desc' => 'Type related products number full width from here.',
			'id' => 'related_products_number_full',
			'std' => '4',
			'type' => 'text');
		
		$options[] = array(
			'name' => 'Excerpt title in products pages',
			'desc' => 'Type excerpt title in products pages from here.',
			'id' => 'products_excerpt_title',
			'std' => '40',
			'type' => 'text');
		
		$options[] = array(
			'name' => "Products sidebar layout",
			'desc' => "Products sidebar layout.",
			'id' => "products_sidebar_layout",
			'std' => "default",
			'type' => "images",
			'options' => array(
				'default' => $imagepath.'sidebar_default.jpg',
				'right' => $imagepath.'sidebar_right.jpg',
				'full' => $imagepath.'sidebar_no.jpg',
				'left' => $imagepath.'sidebar_left.jpg',
			)
		);
		
		$options[] = array(
			'name' => "Products Page Sidebar",
			'desc' => "Products Page Sidebar.",
			'id' => "products_sidebar",
			'std' => '',
			'options' => $new_sidebars,
			'type' => 'select');
		
		$options[] = array(
			'name' => "Products page layout",
			'desc' => "Products page layout.",
			'id' => "products_layout",
			'std' => "default",
			'type' => "images",
			'options' => array(
				'default' => $imagepath.'sidebar_default.jpg',
				'full' => $imagepath.'full.jpg',
				'fixed' => $imagepath.'fixed.jpg',
				'fixed_2' => $imagepath.'fixed_2.jpg'
			)
		);
		
		$options[] = array(
			'name' => "Choose template",
			'desc' => "Choose template layout.",
			'id' => "products_template",
			'std' => "default",
			'type' => "images",
			'options' => array(
				'default' => $imagepath.'sidebar_default.jpg',
				'grid_1200' => $imagepath.'template_1200.jpg',
				'grid_970' => $imagepath.'template_970.jpg'
			)
		);
		
		$options[] = array(
			'name' => "Site skin",
			'desc' => "Choose Site skin.",
			'id' => "products_skin_l",
			'std' => "default",
			'type' => "images",
			'options' => array(
				'default' => $imagepath.'sidebar_default.jpg',
				'site_light' => $imagepath.'light.jpg',
				'site_dark' => $imagepath.'dark.jpg'
			)
		);
		
		$options[] = array(
			'name' => "Choose Your Skin",
			'desc' => "Choose Your Skin",
			'class' => "site_skin",
			'id' => "products_skin",
			'std' => "default",
			'type' => "images",
			'options' => array(
				'default'	    => $imagepath . 'default.jpg',
				'skins'		    => $imagepath . 'skin.jpg',
				'blue'			=> $imagepath . 'blue.jpg',
				'gray'			=> $imagepath . 'gray.jpg',
				'green'			=> $imagepath . 'green.jpg',
				'moderate_cyan' => $imagepath . 'moderate_cyan.jpg',
				'orange'		=> $imagepath . 'orange.jpg',
				'purple'	    => $imagepath . 'purple.jpg',
				'red'			=> $imagepath . 'red.jpg',
				'strong_cyan'	=> $imagepath . 'strong_cyan.jpg',
				'yellow'		=> $imagepath . 'yellow.jpg',
			)
		);
		
		$options[] = array(
			'name' => "Primary Color",
			'desc' => "Primary Color",
			'id' => 'products_primary_color',
			'type' => 'color' );
		
		$options[] = array(
			'name' => "Secondary Color ( it's darkness more than primary color )",
			'desc' => "Secondary Color ( it's darkness more than primary color )",
			'id' => 'products_secondary_color',
			'type' => 'color' );
		
		$options[] = array(
			'name' => "Background Type",
			'desc' => "Background Type",
			'id' => 'products_background_type',
			'std' => 'patterns',
			'type' => 'radio',
			'options' => 
				array(
					"patterns" => "Patterns",
					"custom_background" => "Custom Background"
				)
		);
	
		$options[] = array(
			'name' => "Background Color",
			'desc' => "Background Color",
			'id' => 'products_background_color',
			'std' => "#FFF",
			'type' => 'color' );
			
		$options[] = array(
			'name' => "Choose Pattern",
			'desc' => "Choose Pattern",
			'id' => "products_background_pattern",
			'std' => "bg13",
			'type' => "images",
			'options' => array(
				'bg1' => $imagepath.'bg1.jpg',
				'bg2' => $imagepath.'bg2.jpg',
				'bg3' => $imagepath.'bg3.jpg',
				'bg4' => $imagepath.'bg4.jpg',
				'bg5' => $imagepath.'bg5.jpg',
				'bg6' => $imagepath.'bg6.jpg',
				'bg7' => $imagepath.'bg7.jpg',
				'bg8' => $imagepath.'bg8.jpg',
				'bg9' => $imagepath.'../../images/patterns/bg9.png',
				'bg10' => $imagepath.'../../images/patterns/bg10.png',
				'bg11' => $imagepath.'../../images/patterns/bg11.png',
				'bg12' => $imagepath.'../../images/patterns/bg12.png',
				'bg13' => $imagepath.'bg13.jpg',
				'bg14' => $imagepath.'bg14.jpg',
				'bg15' => $imagepath.'../../images/patterns/bg15.png',
				'bg16' => $imagepath.'../../images/patterns/bg16.png',
				'bg17' => $imagepath.'bg17.jpg',
				'bg18' => $imagepath.'bg18.jpg',
				'bg19' => $imagepath.'bg19.jpg',
				'bg20' => $imagepath.'bg20.jpg',
				'bg21' => $imagepath.'../../images/patterns/bg21.png',
				'bg22' => $imagepath.'bg22.jpg',
				'bg23' => $imagepath.'../../images/patterns/bg23.png',
				'bg24' => $imagepath.'../../images/patterns/bg24.png',
		));
	
		$options[] = array(
			'name' =>  "Custom Background",
			'desc' => "Custom Background",
			'id' => 'products_custom_background',
			'std' => $background_defaults,
			'type' => 'background' );
			
		$options[] = array(
			'name' => "Full Screen Background",
			'desc' => "Click on to Full Screen Background",
			'id' => 'products_full_screen_background',
			'std' => '0',
			'type' => 'checkbox');
	}
	
	$options[] = array(
		'name' => 'Advertising',
		'type' => 'heading');
	
	$options[] = array(
		'name' => "Advertising after header",
		'class' => 'home_page_display',
		'type' => 'info');
	
	$options[] = array(
		'name' => 'Advertising type',
		'desc' => 'Advertising type.',
		'id' => 'header_adv_type',
		'std' => 'custom_image',
		'type' => 'radio',
		'options' => array("display_code" => "Display code","custom_image" => "Custom Image"));
	
	$options[] = array(
		'name' => 'Image URL',
		'desc' => 'Upload a image, or enter URL to an image if it is already uploaded. ',
		'id' => 'header_adv_img',
		'std' => '',
		'type' => 'upload');
	
	$options[] = array(
		'name' => 'Advertising url',
		'desc' => 'Advertising url. ',
		'id' => 'header_adv_href',
		'std' => '#',
		'type' => 'text');
	
	$options[] = array(
		'name' => "Advertising Code html ( Ex: Google ads)",
		'desc' => "Advertising Code html ( Ex: Google ads)",
		'id' => 'header_adv_code',
		'std' => '',
		'type' => 'textarea');
	
	$options[] = array(
		'name' => "Advertising 1 in post and question",
		'class' => 'home_page_display',
		'type' => 'info');
	
	$options[] = array(
		'name' => 'Advertising type',
		'desc' => 'Advertising type.',
		'id' => 'share_adv_type',
		'std' => 'custom_image',
		'type' => 'radio',
		'options' => array("display_code" => "Display code","custom_image" => "Custom Image"));
	
	$options[] = array(
		'name' => 'Image URL',
		'desc' => 'Upload a image, or enter URL to an image if it is already uploaded. ',
		'id' => 'share_adv_img',
		'std' => '',
		'type' => 'upload');
	
	$options[] = array(
		'name' => 'Advertising url',
		'desc' => 'Advertising url. ',
		'id' => 'share_adv_href',
		'std' => '#',
		'type' => 'text');
	
	$options[] = array(
		'name' => "Advertising Code html ( Ex: Google ads)",
		'desc' => "Advertising Code html ( Ex: Google ads)",
		'id' => 'share_adv_code',
		'std' => '',
		'type' => 'textarea');
	
	$options[] = array(
		'name' => "Advertising 2 in post and question",
		'class' => 'home_page_display',
		'type' => 'info');
	
	$options[] = array(
		'name' => 'Advertising type',
		'desc' => 'Advertising type.',
		'id' => 'related_adv_type',
		'std' => 'custom_image',
		'type' => 'radio',
		'options' => array("display_code" => "Display code","custom_image" => "Custom Image"));
	
	$options[] = array(
		'name' => 'Image URL',
		'desc' => 'Upload a image, or enter URL to an image if it is already uploaded. ',
		'id' => 'related_adv_img',
		'std' => '',
		'type' => 'upload');
	
	$options[] = array(
		'name' => 'Advertising url',
		'desc' => 'Advertising url. ',
		'id' => 'related_adv_href',
		'std' => '#',
		'type' => 'text');
	
	$options[] = array(
		'name' => "Advertising Code html ( Ex: Google ads)",
		'desc' => "Advertising Code html ( Ex: Google ads)",
		'id' => 'related_adv_code',
		'std' => '',
		'type' => 'textarea');
		
	$options[] = array(
		'name' => "Advertising after content",
		'class' => 'home_page_display',
		'type' => 'info');
	
	$options[] = array(
		'name' => 'Advertising type',
		'desc' => 'Advertising type.',
		'id' => 'content_adv_type',
		'std' => 'custom_image',
		'type' => 'radio',
		'options' => array("display_code" => "Display code","custom_image" => "Custom Image"));
	
	$options[] = array(
		'name' => 'Image URL',
		'desc' => 'Upload a image, or enter URL to an image if it is already uploaded. ',
		'id' => 'content_adv_img',
		'std' => '',
		'type' => 'upload');
	
	$options[] = array(
		'name' => 'Advertising url',
		'desc' => 'Advertising url. ',
		'id' => 'content_adv_href',
		'std' => '#',
		'type' => 'text');
	
	$options[] = array(
		'name' => "Advertising Code html ( Ex: Google ads)",
		'desc' => "Advertising Code html ( Ex: Google ads)",
		'id' => 'content_adv_code',
		'std' => '',
		'type' => 'textarea');
	
	$options[] = array(
		'name' => "Between questions and posts",
		'class' => 'home_page_display',
		'type' => 'info');
	
	$options[] = array(
		'name' => 'Between questions or posts position',
		'desc' => 'Between questions or posts position. ',
		'id' => 'between_questions_position',
		'std' => '2',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Advertising type',
		'desc' => 'Advertising type.',
		'id' => 'between_adv_type',
		'std' => 'custom_image',
		'type' => 'radio',
		'options' => array("display_code" => "Display code","custom_image" => "Custom Image"));
	
	$options[] = array(
		'name' => 'Image URL',
		'desc' => 'Upload a image, or enter URL to an image if it is already uploaded. ',
		'id' => 'between_adv_img',
		'std' => '',
		'type' => 'upload');
	
	$options[] = array(
		'name' => 'Advertising url',
		'desc' => 'Advertising url. ',
		'id' => 'between_adv_href',
		'std' => '#',
		'type' => 'text');
	
	$options[] = array(
		'name' => "Advertising Code html ( Ex: Google ads)",
		'desc' => "Advertising Code html ( Ex: Google ads)",
		'id' => 'between_adv_code',
		'std' => '',
		'type' => 'textarea');
	
	$options[] = array(
		'name' => "Between comments and answers",
		'class' => 'home_page_display',
		'type' => 'info');
	
	$options[] = array(
		'name' => 'Between comments and answers position',
		'desc' => 'Between comments and answers position. ',
		'id' => 'between_comments_position',
		'std' => '2',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Advertising type',
		'desc' => 'Advertising type.',
		'id' => 'between_comments_adv_type',
		'std' => 'custom_image',
		'type' => 'radio',
		'options' => array("display_code" => "Display code","custom_image" => "Custom Image"));
	
	$options[] = array(
		'name' => 'Image URL',
		'desc' => 'Upload a image, or enter URL to an image if it is already uploaded. ',
		'id' => 'between_comments_adv_img',
		'std' => '',
		'type' => 'upload');
	
	$options[] = array(
		'name' => 'Advertising url',
		'desc' => 'Advertising url. ',
		'id' => 'between_comments_adv_href',
		'std' => '#',
		'type' => 'text');
	
	$options[] = array(
		'name' => "Advertising Code html ( Ex: Google ads)",
		'desc' => "Advertising Code html ( Ex: Google ads)",
		'id' => 'between_comments_adv_code',
		'std' => '',
		'type' => 'textarea');
	
	$options[] = array(
		'name' => 'Social settings',
		'type' => 'heading');
	
	$options[] = array(
		'name' => 'Social header enable or disable',
		'desc' => 'Social enable or disable.',
		'id' => 'social_icon_h',
		'std' => 1,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Social footer enable or disable',
		'desc' => 'Social enable or disable.',
		'id' => 'social_icon_f',
		'std' => 1,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Twitter URL',
		'desc' => 'Type the twitter URL from here.',
		'id' => 'twitter_icon_f',
		'std' => '#',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Facebook URL',
		'desc' => 'Type the facebook URL from here.',
		'id' => 'facebook_icon_f',
		'std' => '#',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Google plus URL',
		'desc' => 'Type the google plus URL from here.',
		'id' => 'gplus_icon_f',
		'std' => '#',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Youtube URL',
		'desc' => 'Type the youtube URL from here.',
		'id' => 'youtube_icon_f',
		'std' => '#',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Skype',
		'desc' => 'Type the skype from here.',
		'id' => 'skype_icon_f',
		'std' => '#',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Linkedin URL',
		'desc' => 'Type the linkedin URL from here.',
		'id' => 'linkedin_icon_f',
		'std' => '#',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Flickr URL',
		'desc' => 'Type the flickr URL from here.',
		'id' => 'flickr_icon_f',
		'std' => '#',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'RSS enable or disable',
		'desc' => 'RSS enable or disable.',
		'id' => 'rss_icon_f',
		'std' => 1,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'RSS URL if you want change the default URL',
		'desc' => 'Type the RSS URL if you want change the default URL or leave it empty for enable the default URL.',
		'id' => 'rss_icon_f_other',
		'std' => '',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Footer settings',
		'type' => 'heading');
		
	$options[] = array(
		'name' => "Footer skin",
		'desc' => "Choose the footer skin.",
		'id' => "footer_skin",
		'std' => "footer_dark",
		'type' => "images",
		'options' => array(
			'footer_dark' => $imagepath . 'footer_dark.jpg',
			'footer_light' => $imagepath . 'footer_light.jpg'
		)
	);
	
	$options[] = array(
		'name' => "Footer Layout",
		'desc' => "Footer columns Layout.",
		'id' => "footer_layout",
		'std' => "footer_4c",
		'type' => "images",
		'options' => array(
			'footer_1c' => $imagepath . 'footer_1c.jpg',
			'footer_2c' => $imagepath . 'footer_2c.jpg',
			'footer_3c' => $imagepath . 'footer_3c.jpg',
			'footer_4c' => $imagepath . 'footer_4c.jpg',
			'footer_5c' => $imagepath . 'footer_5c.jpg',
			'footer_no' => $imagepath . 'footer_no.jpg'
		)
	);
	
	$options[] = array(
		'name' => 'Copyrights',
		'desc' => 'Put the copyrights of footer.',
		'id' => 'footer_copyrights',
		'std' => 'Copyright 2015 Ask me | <a href=#>By 2code</a>',
		'type' => 'textarea');
	
	$options[] = array(
		'name' => "Advanced",
		'id' => "advanced",
		'type' => 'heading');
	
	$options[] = array(
		'name' => 'Google API ( Get it from here : https://developers.google.com/+/api/oauth )',
		'desc' => 'Type here the Google API. ',
		'id' => 'google_api',
		'std' => '',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Facebook access token  ( Creat https://developers.facebook.com/apps & Get it from here : https://developers.facebook.com/tools/access_token )',
		'desc' => 'Facebook access token. ',
		'id' => 'facebook_access_token',
		'std' => '',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Twitter consumer key',
		'desc' => 'Twitter consumer key. ',
		'id' => 'twitter_consumer_key',
		'std' => '',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Twitter consumer secret',
		'desc' => 'Twitter consumer secret. ',
		'id' => 'twitter_consumer_secret',
		'std' => '',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Twitter access token',
		'desc' => 'Twitter access token. ',
		'id' => 'twitter_access_token',
		'std' => '',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Twitter access token secret',
		'desc' => 'Twitter access token secret. ',
		'id' => 'twitter_access_token_secret',
		'std' => '',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Click ON to create all theme pages (17 pages)',
		'desc' => 'Click ON to create all theme pages (17 pages)',
		'id' => 'theme_pages',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => "If you wont to export setting please refresh the page before that",
		'type' => 'info');

	$options[] = array(
		'name' => "Export Setting",
		'desc' => "Copy this to saved file",
		'id' => 'export_setting',
		'export' => $current_options_e,
		'type' => 'export');

	$options[] = array(
		'name' => "Import Setting",
		'desc' => "Put here the import setting",
		'id' => 'import_setting',
		'type' => 'import');
	
	return $options;
}
<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */

global $meta_boxes;
$meta_boxes = array();

$page_fields = array(
	array(
		'name' => __( 'Page subtitle', 'modelish' ),
		'desc' => __( 'This description will be used in the right side of the page title.', 'modelish' ),
		'id'   => 'subtitle',
		'type' => 'textarea',
		'rows' => '2',
	),
);

if( strstr($_SERVER['REQUEST_URI'], 'wp-admin/post-new.php') || strstr($_SERVER['REQUEST_URI'], 'wp-admin/post.php') ) {
	if ( !empty($_GET['post']) || !empty($_POST['post_ID']) ) {
		$post_id = !empty($_GET['post']) ? $_GET['post'] : $_POST['post_ID'] ;
		$template_file = get_post_meta($post_id, '_wp_page_template', TRUE);
		if ($template_file == 'template-journal.php' || $template_file == 'template-portfolio.php') {
			$categories = array(0 => __( 'All categories', 'modelish' ));
			$of_categories_obj = get_categories( 'hide_empty=0' );
			foreach ( $of_categories_obj as $of_cat ) {
				$categories[$of_cat->cat_ID] = $of_cat->cat_name;
			}

			array_push($page_fields, array(
				'name' => __( 'Base category', 'modelish' ),
				'desc' => __( 'This will select the base category for showing posts in this page (sub-category posts will be displayed as well).', 'modelish' ),
				'id'   => 'base_category',
				'type' => 'select',
				'options'  => $categories
			));
		}
	}
}

// meta box for pages
$meta_boxes[] = array(
	'id' => 'page_extra_options',
	'title' => __( 'Additional Properties', 'modelish' ),
	'pages' => array( 'page' ),
	'context' => 'normal',
	'fields' => $page_fields
);



// meta box for Blog POsts items
$meta_boxes[] = array(
	'id' => 'header_style',
	'title' => __( 'Styling Properties', 'flatbox' ),
	'pages' => array( 'page'),
	'fields' => array(
		array(
			'name' => __( 'Header Background color', 'flatbox' ),
			'id'   => 'header_bg_color',
			'type' => 'color',
		),
		array(
			'name' => __( 'Header background image', 'flatbox' ),
			'id'   => 'header_image',
			'type' => 'file',
		),
		
	)
);


// meta box for Blog POsts items
$meta_boxes[] = array(
	'id' => 'blog_extra_options',
	'title' => __( 'Additional Properties', 'flatbox' ),
	'pages' => array( 'post'),
	'fields' => array(
		array(
			'name' => __( 'Post Type', 'flatbox' ),
			'id'   => 'post_type2',
			'type' => 'radio',
			'options' => array(
				'value' =>  __( 'Blog Post &nbsp;&nbsp;&nbsp;', 'flatbox' ),
				'value2' => __( 'Video Post &nbsp;&nbsp;&nbsp;', 'flatbox' ),
				'value3' => __( 'Audio Post &nbsp;&nbsp;&nbsp;', 'flatbox' ),
				'value4' => __( 'Note Post &nbsp;&nbsp;&nbsp;', 'flatbox' ),
				'value5' => __( 'Link Post &nbsp;&nbsp;&nbsp;', 'flatbox' ),
				),
		),
		// Sound FILE UPLOAD
		array(
			'name' => __( 'Audio File ( .mp3 + .oog + .wav)', 'flatbox' ),
			'id'   => "sound_file",
			'type' => 'file',
		),
		array(
			'name' => __( 'Video', 'flatbox' ),
			'desc' => __( 'Input video embed code', 'flatbox' ),
			'id'   => 'blog_video',
			'type' => 'textarea',
			'rows' => '3',
			'clone' => true,
		),

		array(
			'name' => __( 'Note Post', 'flatbox' ),
			'desc' => __( 'Input the note here.', 'flatbox' ),
			'id'   => 'blog_note',
			'type' => 'textarea',
			'rows' => '3',
			'clone' => true,
		),
		array(
			'name' => __( 'Note author', 'flatbox' ),
			'id'   => 'blog_note_author',
			'type' => 'text',
			'size' => 40,
		),
		array(
			'name' => __( 'Link Post URL', 'flatbox' ),
			'id'   => 'blog_link_url',
			'type' => 'text',
			'size' => 40,
		),
	)
);


// meta box for portfolio items
$meta_boxes[] = array(
	'id' => 'portfolio_extra_options',
	'title' => __( 'Additional Properties', 'flatbox' ),
	'pages' => array( 'portfolio', 'portfolio-items' ),
	'fields' => array(
		array(
			'name' => __( 'Additional Images', 'flatbox' ),
			'id'   => 'portfolio_images',
			'type' => 'image',
		),
		array(
			'name' => __( 'Additional Videos', 'flatbox' ),
			'id'   => 'portfolio_videos',
			'type' => 'textarea',
			'rows' => '3',
			'clone' => true,
		),
		array(
			'name' => __( 'Hide Featured Image', 'persempre'),
			'desc' => __( 'Determine if the featured image attached to the portfolio item is displayed in the single post details.', 'persempre' ),
			'id'   => 'portfolio_hide_featured_image',
			'std'  => false,
			'type' => 'checkbox',
		),
		array(
			'name' => __( "Disable Image Crop", 'modelish'),
			'desc' => __( 'Determines if images are cropped when displayed in their details page.', 'modelish' ),
			'id'   => 'portfolio_disable_image_crop',
			'std'  => false,
			'type' => 'checkbox',
		),
		array(
			'name' => __( 'Featured on homepage', 'flatbox'),
			'desc' => __( 'Determine if the portfolio item appears in the homepage Work section.', 'flatbox' ),
			'id'   => 'portfolio_featured',
			'std'  => true,
			'type' => 'checkbox',
		),
		array(
			'name' => __( 'Portfolio Item Features', 'flatbox' ),
			'desc' => __( 'Input a feature in each textbox and it will be display in the portfolio item details.', 'flatbox' ),
			'id'   => 'portfolio_features',
			'type' => 'textarea',
			'rows' => '2',
			'clone' => true,
		),
		array(
			'name' => __( 'Portfolio Item Website URL', 'flatbox' ),
			'id'   => 'portfolio_website',
			'type' => 'text',
			'size' => 40,
		),
	)
);

// meta box for staff members
$meta_boxes[] = array(
	'id' => 'staff_extra_options',
	'title' => __( 'Additional Properties', 'flatbox' ),
	'pages' => array( 'staff-members' ),
	'fields' => array(
		array(
			'name' => __( 'Extend Image', 'flatbox' ),
			'desc' => __( 'Determine if the staff image is large (group mode) or small (single mode).', 'flatbox' ),
			'id'   => 'staff_big_image',
			'type' => 'checkbox',
		)
	)
);
$meta_boxes[] = array(
	'id' => 'social_links',
	'title' => __( 'Social Links', 'flatbox' ),
	'pages' => array( 'staff-members' ),
	'fields' => array(
		array(
			'name' => __( 'Facebook Profile', 'flatbox' ),
			'id'   => 'social_link_facebook',
			'type' => 'text',
			'size' => 40,
		),
		array(
			'name' => __( 'Twitter Profile', 'flatbox' ),
			'id'   => 'social_link_twitter',
			'type' => 'text',
			'size' => 40,
		),
		array(
			'name' => __( 'Google+ Profile', 'flatbox' ),
			'id'   => 'social_link_googleplus',
			'type' => 'text',
			'size' => 40,
		),
		array(
			'name' => __( 'Email Address', 'flatbox' ),
			'id'   => 'social_link_email',
			'type' => 'text',
			'size' => 40,
		),
	)
);

// meta box for testimonials
$meta_boxes[] = array(
	'id' => 'testimonials_extra_options',
	'title' => __( 'Additional Properties', 'flatbox' ),
	'pages' => array( 'testimonials' ),
	'fields' => array(
		array(
			'name' => __( 'Author Name', 'flatbox' ),
			'id'   => 'testimonial_author_name',
			'type' => 'text',
			'size' => 40,
		),
		array(
			'name' => __( 'Author URL', 'flatbox' ),
			'id'   => 'testimonial_author_url',
			'type' => 'text',
			'size' => 40,
		),
	)
);

/**
 * Register meta boxes
 *
 * @return void
 */
function flatbox_register_meta_boxes()
{
	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( !class_exists( 'RW_Meta_Box' ) )
		return;

	global $meta_boxes;
	foreach ( $meta_boxes as $meta_box )
	{
		new RW_Meta_Box( $meta_box );
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'flatbox_register_meta_boxes' );
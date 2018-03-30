<?php
/*
Plugin Name: Vivaco Custom Post Types
Description: vivaco-custom-post-types
Version: 2.2.0
Author: Vivaco (Alexander)
Author URI: http://vivaco.com
*/

function vivaco_custom_post_types() {
	/* Team custom post type */
	$args['post-type-team'] = array(
		'labels' => array(
			'name' => __( 'Team Members', 'vivaco' ),
			'singular_name' => __( 'Team Member', 'vivaco' ),
			'all_items' => __( 'Team Members', 'vivaco' ),
			'add_new' => __( 'Add New', 'vivaco' ),
			'add_new_item' => __( 'Add New Team Member', 'vivaco' ),
			'edit_item' => __( 'Edit Team Member', 'vivaco' ),
			'new_item' => __( 'New Team Member', 'vivaco' ),
			'view_item' => __( 'View Team Member', 'vivaco' ),
			'search_items' => __( 'Search All Team Members', 'vivaco' ),
			'not_found' => __( 'No members found', 'vivaco' ),
			'not_found_in_trash' => __( 'No members found in Trash', 'vivaco' ),
			'parent_item_colon' => __( 'Parent Team Member:', 'vivaco' ),
			'menu_name' => __( 'Team', 'vivaco' ),

		),
		'hierarchical' => false,
		'description' => __( 'Add a team member', 'vivaco' ),
		'supports' => array( 'title', 'thumbnail'),
		'menu_icon' =>  'dashicons-groups',
		'public' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'query_var' => true,
		'menu_position' => 100,
		'rewrite' => true
		);

	/* Testimonials custom post type */
	$args['post-type-testimonials'] = array(
		'labels' => array(
			'name' => __( 'Testimonials', 'vivaco' ),
			'singular_name' => __( 'Testimonial', 'vivaco' ),
			'add_new' => __( 'Add New', 'vivaco' ),
			'add_new_item' => __( 'Add New Testimonial', 'vivaco' ),
			'edit_item' => __( 'Edit Testimonial', 'vivaco' ),
			'new_item' => __( 'New Testimonial', 'vivaco' ),
			'view_item' => __( 'View Testimonial', 'vivaco' ),
			'search_items' => __( 'Search Through Testimonials', 'vivaco' ),
			'not_found' => __( 'No testimonials found', 'vivaco' ),
			'not_found_in_trash' => __( 'No testimonials found in Trash', 'vivaco' ),
			'parent_item_colon' => __( 'Parent Testimonial:', 'vivaco' ),
			'menu_name' => __( 'Testimonials', 'vivaco' ),

		),
		'hierarchical' => false,
		'description' => __( 'Add a Testimonial', 'vivaco' ),
		'supports' => array( 'title', 'thumbnail'),
		'menu_icon' =>  'dashicons-format-quote',
		'public' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'query_var' => true,
		'menu_position' => 100,
		'rewrite' => true
		);

	/* Portfolio custom post type */
	$args['post-type-portfolio'] = array(
		'labels' => array(
			'name' => __( 'Projects', 'vivaco' ),
			'singular_name' => __( 'Portfolio Item', 'vivaco' ),
			'all_items' => 'Projects',
			'add_new' => __( 'Add New', 'vivaco' ),
			'add_new_item' => __( 'Add New Portfolio Item', 'vivaco' ),
			'edit_item' => __( 'Edit Project', 'vivaco' ),
			'new_item' => __( 'New Project', 'vivaco' ),
			'view_item' => __( 'View Project', 'vivaco' ),
			'search_items' => __( 'Search Projects', 'vivaco' ),
			'not_found' => __( 'No projects found', 'vivaco' ),
			'not_found_in_trash' => __( 'No projects found in Trash', 'vivaco' ),
			'parent_item_colon' => __( 'Parent Portfolio:', 'vivaco' ),
			'menu_name' => __( 'Portfolio', 'vivaco' ),
		),
		'hierarchical' => true,
        'description' => 'Add your Projects',
        'supports' => array( 'title', 'editor', 'thumbnail' ),
		'taxonomies' => array('portfolio_cats'),
		'menu_icon' =>  'dashicons-format-gallery',
		'show_ui' => true,
        'public' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'query_var' => 'portfolio',
		'menu_position' => 100,
        'rewrite' => array('slug' => 'portfolio', 'with_front' => true)
		);

	register_post_type('team', $args['post-type-team']);
	register_post_type('portfolio', $args['post-type-portfolio']);

	register_post_type('testimonials', $args['post-type-testimonials']);

	$taxonomies = array();

	$taxonomies['taxonomy-portfolio_cats'] = array(
		'labels' => array(
			'name' => __( 'Portfolio Categories', 'vivaco' ),
			'singular_name' => __( 'Portfolio Category', 'vivaco' ),
			'search_items' =>  __( 'Search Portfolio Categories', 'vivaco' ),
			'all_items' => __( 'All Portfolio Categories', 'vivaco' ),
			'parent_item' => __( 'Parent Portfolio Category', 'vivaco' ),
			'parent_item_colon' => __( 'Parent Portfolio Category:', 'vivaco' ),
			'edit_item' => __( 'Edit Portfolio Category', 'vivaco' ),
			'update_item' => __( 'Update Portfolio Category', 'vivaco' ),
			'add_new_item' => __( 'Add New Portfolio Category', 'vivaco' ),
			'new_item_name' => __( 'New Portfolio Category Name', 'vivaco' ),
			'choose_from_most_used'	=> __( 'Choose from the most used portfolio categories', 'vivaco' )
		),
		'hierarchical' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'portfolio-category' )
	);

	/* Register taxonomy: name, cpt, arguments */
	register_taxonomy('portfolio_cats', array('portfolio'), $taxonomies['taxonomy-portfolio_cats']);

    register_taxonomy_for_object_type('portfolio_cats', 'portfolio');
}
add_action( 'init', 'vivaco_custom_post_types' );


/*	Create Custom Boxes for Custom Post Types */
function vivaco_member_meta_boxes(){
	add_meta_box('team', __('Team member shortcode', 'vivaco'), 'vivaco_member_metabox', 'team', 'side', 'core');
}

function vivaco_testimonial_meta_boxes(){
	add_meta_box('testimonials', __('Testimonial shortcode', 'vivaco'), 'vivaco_testimonial_metabox', 'testimonials', 'side', 'core');
}
add_action( 'add_meta_boxes', 'vivaco_member_meta_boxes' );
add_action( 'add_meta_boxes', 'vivaco_testimonial_meta_boxes' );


/*	Create Custom Spaces for Custom Post Types on admin pages */
function vivaco_member_metabox($post, $metabox){
	?>
		<!-- <code>[vsc-team-member id=<?php print $post->ID ?>]</code> -->
		<small class="description"><?php _e('Use this shortcode to display the team member on a page', 'vivaco') ?></small>
	<?php
}

function vivaco_testimonial_metabox($post, $metabox){
	?>
		<code>[vsc-testimonial id=<?php print $post->ID ?>]</code>
		<small class="description"><?php _e('Use this shortcode to display the testimonial on a page', 'vivaco') ?></small>
	<?php
}

/* Modify Team admin page structure */
add_filter( 'manage_edit-team_columns', 'vivaco_edit_team_columns' ) ;

function vivaco_edit_team_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Team Members', 'vivaco' ),
		'shortcode' => __( 'Embed Code', 'vivaco' ),
		'date' => __( 'Date', 'vivaco' )
	);

	return $columns;
}
add_action( 'manage_team_posts_custom_column', 'vivaco_manage_team_columns', 10, 2 );

function vivaco_manage_team_columns( $column, $post_id ) {
	global $post;

	switch( $column ) {
		case 'shortcode' :
			echo "<input type=text readonly=readonly value='' size=30 style='font-weight:bold;text-align:Center;' onclick='this.select()' />";
			break;

		default :
			break;
	}
}

/* Modify Testimonials admin page structure */
add_filter( 'manage_edit-testimonials_columns', 'vivaco_edit_testimonials_columns' ) ;

function vivaco_edit_testimonials_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'testimonials', 'vivaco' ),
		'shortcode' => __( 'Embed Code', 'vivaco' ),
		'date' => __( 'Date', 'vivaco' )
	);

	return $columns;
}


add_action( 'manage_testimonials_posts_custom_column', 'vivaco_manage_testimonials_columns', 10, 2 );

function vivaco_manage_testimonials_columns( $column, $post_id ) {
	global $post;

	switch( $column ) {
		case 'shortcode' :
			echo "<input type=text readonly=readonly value='[vsc-testimonial id={$post->ID}]' size=30 style='font-weight:bold;text-align:Center;' onclick='this.select()' />";
			break;

		default :
			break;
	}
}

function vivaco_custom_post_types_admin_init() {
	if (!is_admin()){
		return;
	}

	load_plugin_textdomain( 'vivaco', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

	/* Testimonials meta */
	require_once ( get_template_directory() . '/engine/lib/metaboxes/meta-box.php' );

	global $termeni;

	$termeni = get_terms('portfolio_cats', array('hide_empty' => false));
	global $catarray;
	$catarray = array();
	foreach ($termeni as $term) {
		$catarray[$term->term_id] = $term->name;
		if (function_exists('icl_register_string')) {
		icl_register_string('Portfolio Category', 'Term '.$term->term_id.'', $term->name);
		}
	}

	$prefix = "vsc_";

	$config = array(
		'id' => 'testimonial_box',
		'title' => 'Testimonial',
		'pages' => array('testimonials'),
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(),
		'local_images' => false,
		'use_with_theme' => true
	);

	$test_box =  new AT_Meta_Box($config);

	/*$test_box->addText($prefix.'testimonial_name',array('name'=> 'Name, Surname '));*/
	$test_box->addText($prefix.'testimonial_details',array('name'=> 'Title and company name'));
	$test_box->addTextarea($prefix.'testimonial_desc',array('name'=> 'Testimonial'));

	$test_box->Finish();


	/* Team details meta */
	$config = array(
		'id' => 'team_box',
		'title' => 'Team member',
		'pages' => array('team'),
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(),
		'local_images' => false,
		'use_with_theme' => true
	);

	$team_meta =  new AT_Meta_Box($config);
	$team_meta->addText($prefix.'member_position',array('name'=> 'Company position '));
	$team_meta->addTextarea($prefix.'member_text',array('name'=> 'Member description'));
	$team_meta->addText($prefix.'member_mail',array('name'=> 'Email address '));
	$team_meta->addText($prefix.'member_twitter',array('name'=> 'Twitter handle '));
	$team_meta->addText($prefix.'member_facebook',array('name'=> 'Facebook URL'));
	$team_meta->addText($prefix.'member_skype',array('name'=> 'Skype handle'));
	$team_meta->addText($prefix.'member_linkedin',array('name'=> 'LinkedIn URL'));
	$team_meta->addText($prefix.'member_google',array('name'=> 'Google+ URL'));
	$team_meta->Finish();


	//Portfolio Options Boxes
	/*
	$config = array(
		'id' => 'vsc_portfolio_options',
		'title' => 'Portfolio Page Options',
		'pages' => array('page'),
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(),
		'local_images' => false,
		'use_with_theme' => true
	);

	$portfolio_options =  new AT_Meta_Box($config);

	$portfolio_options->addImageRadio($prefix.'portfolio_columns',array('grid' => 'Grid'),array('name'=> 'Portfolio Layout', 'std'=> array('grid')));

	$portfolio_options->addRadio($prefix.'portfolio_navigation',array('filter'=>'With Filter','no-filter'=>'Without Filter'),array('name'=> 'Portfolio Type', 'std'=> array('filter')));

	$portfolio_options->addText($prefix.'nav_number',array('name'=> 'How many items would you like to display on this portfolio page? (working only if "Without Filter" option is selected.)', 'desc' => 'Please enter a number in the box (Default number is 8)', 'std'=> '8'));


	$portfolio_options->addCheckboxList($prefix.'cats_field', $catarray ,array('name'=> 'Portfolio Categories ', 'desc'=>'Set from which categories to display projects.'));

	$portfolio_options->Finish();
	*/
	/*
	// Portfolio Title Metabox
	$config = array(
		'id' => 'portfolio_title',
		'title' => 'Header Options',
		'pages' => array('portfolio'),
		'context' => 'normal',
		'priority' => 'low',
		'fields' => array(),
		'local_images' => false,
		'use_with_theme' => true
	);

	$port_header =  new AT_Meta_Box($config);

	$port_header->addText($prefix.'page_tagline',array('name'=> 'Title Tagline', 'desc' => 'You can set a tagline for the title.' ));
	$port_header->addSelect($prefix.'port_header',array('center-title'=>'Center Aligned Title','left-title'=>'Left Aligned Title', 'no-title'=>'No Title', 'parallax-title'=>'Center Aligned Title on Background Image'),array('name'=> 'Project Title Options', 'std'=> array('center-title')));
	$port_header->Finish();
	*/

	/*
	$config = array(
		'id' => 'vsc_parallax_bg',
		'title' => 'Background Options',
		'pages' => array('portfolio'),
		'context' => 'normal',
		'priority' => 'low',
		'fields' => array(),
		'local_images' => false,
		'use_with_theme' => true
	);

	$bg_options =  new AT_Meta_Box($config);
	$bg_options->addInfo($prefix.'info_parallax_bg',array('name'=> '', 'desc' => 'Upload an image. You mainly have 3 options: upload an image and set it as background; upload an image and make it act like a pattern by choosing options like repeat or pick a color.', 'std'=> ''));
	$bg_options->addImageSolo($prefix.'bg_img',array('name'=> 'Background Image '));

	$bg_options->addRadio($prefix.'bg_repeat',array('repeat'=>'Repeat','repeat-y'=>'Repeat-Y', 'repeat-x' => 'Repeat-X', 'no-repeat' => 'No Repeat'),array('name'=> 'Background Repeat', 'std'=> 'repeat-y'));

	$bg_options->addColor($prefix.'bg_color',array('name'=> 'Background Color', 'std' => '#111111', 'desc' => 'You can set a color over the background image. You can make it more or less opaque, by using the next setting.'));
	$bg_options->addText($prefix.'bg_color_opacity',array('name'=> 'Background Color Opacity', 'std' => '70', 'desc' => 'Set an opacity value for the color(values between 0-100). 0 means no color while 100 means solid color.'));
	$bg_options->addRadio($prefix.'bg_text',array('light-text'=>'Light Text','dark-text'=>'Dark Text'),array('name'=> 'Text Color Scheme', 'std'=> 'light-text', 'desc' => 'Pick a color scheme for the parallax text. "Light Text" looks good on dark bg images while "Dark Text" looks good on light images.'));
	$bg_options->Finish();
	*/

	/* Portfolio Featured Item Metabox */

	$config = array(
		'id' => 'portfolio_behavior',
		'title' => 'Featured image options:',
		'pages' => array('portfolio'),
		'context' => 'side',
		'priority' => 'low',
		'fields' => array(),
		'local_images' => false,
		'use_with_theme' => true
	);

	$port_box =  new AT_Meta_Box($config);
	$port_box->addSelect($prefix.'port_box',array('link_to_page'=>'Opens the project item','lightbox_to_image'=>'Opens in a lightbox', 'link_to_link'=>'Opens a custom link', 'lightbox_to_video' => 'Opens a video in a lightbox'),array('name'=> 'Configure behavior: ', 'std'=> array('link_to_page')));
	$port_box->addText($prefix.'port_link',array('name'=> 'Custom Link: ', 'desc' => 'You can set the thumbnail to open a custom link.'));
	$port_box->addText($prefix.'port_video',array('name'=> 'Video URL: ', 'desc' => 'You can set the thumbnail to open a video from third-party websites(Vimeo, YouTube) in an URL. Ex: http://www.youtube.com/watch?v=y6Sxv-sUYtM'));
	/*
	$gl_fields[] = $port_box->addImage($prefix.'gl_url',array('desc' => '', 'name'=> 'Photo URL ', 'class'=>'image-field'),true);
	$port_box->addRepeaterBlock($prefix.'port_gallery',array('desc' => 'Upload images for the gallery. They will appear in lightbox, when the thumbnail will be clicked.','inline' => true, 'name' => 'Gallery Images','fields' => $gl_fields, 'sortable' => true));
	*/
	$port_box->addImageRadio($prefix.'port_thumbnail',array('portfolio-small'=>'Small thumbnail', 'portfolio-big'=>'Big thumbnail', 'half-horizontal'=>'Half horizontal', 'half-vertical' => 'Half vertical'),array('name'=> 'Image orientation', 'std'=> array('portfolio-small'), 'desc' => 'Portfolio grid item layout style'));
	$port_box->Finish();

}
add_action('admin_init', 'vivaco_custom_post_types_admin_init', 9999);

/* Remove Tags Meta Boxes from Project Pages */
if (is_admin()) :
	function vivaco_remove_meta_boxes() {
			remove_meta_box('tagsdiv-portfolio_cats', 'portfolio', 'side');
	}

	add_action( 'admin_menu', 'vivaco_remove_meta_boxes' );
endif;

/* Get Portfolio category ID */
function get_taxonomy_cat_ID( $cat_name='General' ) {
	$cat = get_term_by( 'name', $cat_name, 'portfolio_cats' );
	if ( $cat )
		return $cat->term_id;
	return 0;
}

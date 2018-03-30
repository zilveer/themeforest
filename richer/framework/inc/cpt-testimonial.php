<?php
/* ----------------------------------------------------- */
/* Testimonial Custom Post Type */
/* ----------------------------------------------------- */
// Adds columns in the admin view for thumbnail and taxonomies
add_filter( 'manage_edit-testi_columns', 'testimonial_edit_columns' );

// Add Icons
add_action( 'admin_head', 'testimonial_icon' );
add_action('init', 'richer_post_type_testi');

function richer_post_type_testi() {
	register_post_type( 'testi',
                array( 
                'menu_icon'=>'',	
				'label' => __('Testimonials', 'richer-framework'), 
				'public' => true, 
				'show_ui' => true,
				'show_in_nav_menus' => false,
				'menu_position' => 5,
				'rewrite' => array(
					'slug' => 'testimonial-view',
					'with_front' => FALSE,
				),
				'supports' => array(
						'title',
						'custom-fields',
						'thumbnail',
						'editor')
					) 
				);
}

function testimonial_edit_columns( $testimonial_columns ) {
	$testimonial_columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => __('Title', 'richer-framework'),
		"thumbnail" => __('Thumbnail', 'richer-framework'),
		"author" => __('Author', 'richer-framework'),
		"date" => __('Date', 'richer-framework'),
	);
	return $testimonial_columns;
}
/**
 * Displays the custom post type icon in the dashboard
 */
function testimonial_icon() { ?>
    <style type="text/css" media="screen">
    	#adminmenu .menu-icon-testi div.wp-menu-image:before {
		  content: "\f338";
		}
    </style>
<?php } ?>
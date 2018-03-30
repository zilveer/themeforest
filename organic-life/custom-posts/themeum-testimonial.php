<?php
/*--------------------------------------------------------------
*			Register Testimonial Post Type
*-------------------------------------------------------------*/

function themeum_post_type_testimonials()
{
	$labels = array(
			'name'                	=> _x( 'Testimonials', 'Testimonials', 'themeum' ),
			'singular_name'       	=> _x( 'Testimonials', 'Testimonials', 'themeum' ),
			'menu_name'           	=> __( 'Testimonials', 'themeum' ),
			'parent_item_colon'   	=> __( 'Parent Testimonial:', 'themeum' ),
			'all_items'           	=> __( 'All Testimonial', 'themeum' ),
			'view_item'           	=> __( 'View Testimonial', 'themeum' ),
			'add_new_item'        	=> __( 'Add New Testimonial', 'themeum' ),
			'add_new'             	=> __( 'New Testimonial', 'themeum' ),
			'edit_item'           	=> __( 'Edit Testimonial', 'themeum' ),
			'update_item'         	=> __( 'Update Testimonial', 'themeum' ),
			'search_items'        	=> __( 'Search Testimonial', 'themeum' ),
			'not_found'           	=> __( 'No article found', 'themeum' ),
			'not_found_in_trash'  	=> __( 'No article found in Trash', 'themeum' )
		);

	$args = array(  
			'labels'             	=> $labels,
			'public'             	=> true,
			'publicly_queryable' 	=> true,
			'show_in_menu'       	=> true,
			'show_in_admin_bar'   	=> true,
			'can_export'          	=> true,
			'has_archive'        	=> true,
			'hierarchical'       	=> false,
			'menu_position'      	=> null,
			'supports'           	=> array( 'title','thumbnail','editor')
		);

	register_post_type('testimonial',$args);

}

add_action('init','themeum_post_type_testimonials');


/*--------------------------------------------------------------
*			Testimonial  Shortcode
*-------------------------------------------------------------*/

add_shortcode('themeum_testimonial','themeum_testimonial_shortcode');

function themeum_testimonial_shortcode($atts, $content)
{
	extract(shortcode_atts(array(
		'control' 			=> '',
		'auto_play'			=> '',
		'image_width'		=> '',
		'image_height'		=> '',
		'image_radius'		=> '',
	), $atts));

	global $post;
	$args = array(
			'post_type'			=> 'testimonial',
			'posts_per_page' 	=> 16,

		);

	$posts = get_posts($args);

	$output = '<div id="carousel-testimonial" class="carousel slide text-center" data-ride="carousel">';

	$output .= '<div class="carousel-inner">';

	$i = 0;

	foreach ($posts as $post)
	{
		setup_postdata( $post );

		$classes = ($i==0)?'item active':'item';

		$url_link=  get_post_meta( $post->ID,'thm_website_url',true );

		$img = get_post_meta($post->ID,'thm_image', true);

		$src_image   = wp_get_attachment_image_src($img, 'full');

		$style='';
		
		if($image_width) $style .='width:'. (int) $image_width . 'px;';
		if($image_height) $style .='height:'. (int) $image_height . 'px;';
		if($image_radius) $style .='border-radius:'. (int) $image_radius . 'px;';
		

		$output .= '<div class="themeum-testimonial ' . $classes . '">';
		$output .= '<div class="testimonial-text-inner">';
		if(isset($src_image) && !empty($src_image)){
			$output .= '<img style="'.$style.'" src="'.$src_image[0].'" alt="Testimonial">';
		}
		$output .= '<p>' . get_the_content() . '</p>';
		$output .= '<span class="testimonial-author">' . get_the_title() . ' - <span class="author-company">'. $url_link .'</span></span>';
		$output .= '</div>';
		$output .= '</div>';

		$i++;

	}

	wp_reset_postdata();

	$output .= '</div>';

	
	/*Controls */
	$output .= '<a class="left testimonial-carousel-control" href="#carousel-testimonial" role="button" data-slide="prev">';
	$output .= '<i class="fa fa-angle-left"></i>';
	$output .= '</a>';
	$output .= '<a class="right testimonial-carousel-control" href="#carousel-testimonial" role="button" data-slide="next">';
	$output .= '<i class="fa fa-angle-right"></i>';
	$output .= '</a>';
	

	$output .= '</div>';


	

	return $output;
}


//Visual Composer Addons Register
if (class_exists('WPBakeryVisualComposerAbstract')) {
	vc_map(array(
		"name" => __("Themeum Testimonials", "themeum"),
		"base" => "themeum_testimonial",
		'icon' => 'icon-thm-testimonial',
		"class" => "",
		"description" => "Themeum Testimonials Shortocde",
		"category" => __("Themeum", "themeum"),
		"params" => array(

			array(
				"type" => "textfield",
				"heading" => __("Title", "themeum"),
				"param_name" => "title",
				"value" => "",
				"admin_label"=>true,
				),			

			array(
				"type" => "textfield",
				"heading" => __("Image Width Size", "themeum"),
				"param_name" => "image_width",
				"value" => "",
				),

			array(
				"type" => "textfield",
				"heading" => __("Image height Size", "themeum"),
				"param_name" => "image_height",
				"value" => "",
				),			

			array(
				"type" => "textfield",
				"heading" => __("Image Radius", "themeum"),
				"param_name" => "image_radius",
				"value" => "",
				),
			)

		));
}
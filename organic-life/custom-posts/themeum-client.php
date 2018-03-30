<?php
/*--------------------------------------------------------------
*			Register Client Post Type
*-------------------------------------------------------------*/

function themeum_post_type_client()
{
	$labels = array(
			'name'                	=> _x( 'Clients', 'Clients', 'themeum' ),
			'singular_name'       	=> _x( 'Clients', 'Clients', 'themeum' ),
			'menu_name'           	=> __( 'Clients', 'themeum' ),
			'parent_item_colon'   	=> __( 'Parent Client:', 'themeum' ),
			'all_items'           	=> __( 'All Client', 'themeum' ),
			'view_item'           	=> __( 'View Client', 'themeum' ),
			'add_new_item'        	=> __( 'Add New Client', 'themeum' ),
			'add_new'             	=> __( 'New Client', 'themeum' ),
			'edit_item'           	=> __( 'Edit Client', 'themeum' ),
			'update_item'         	=> __( 'Update Client', 'themeum' ),
			'search_items'        	=> __( 'Search Client', 'themeum' ),
			'not_found'           	=> __( 'No Client found', 'themeum' ),
			'not_found_in_trash'  	=> __( 'No Client found in Trash', 'themeum' )
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

	register_post_type('client',$args);

}

add_action('init','themeum_post_type_client');

/*--------------------------------------------------------------
*			Clients Shortcode
*-------------------------------------------------------------*/

add_shortcode('themeum_client','themeum_client_shortcode');

function themeum_client_shortcode($atts, $content)
{

	extract(shortcode_atts(array(
	'class' => '',
	), $atts));

	$args = array(
			'post_type'			=> 'client',
			'posts_per_page' 	=> 20,
			'orderby' 			=> 'menu_order',
			'order' 			=> 'ASC',

		);

	$clients = get_posts($args);

	$output = '<div id="themeum-client" class="owl-carousel owl-theme themeum-client '.$class.'">';

	foreach ($clients as $post)
	{
		setup_postdata( $post );

		$btn_link 	= get_post_meta( $post->ID,'thm_btn_link',true );

		$output .= '<div class="item">';
		
		if (has_post_thumbnail($post->ID)){
			$output .='<a href="' . $btn_link . '">';
			$output .= get_the_post_thumbnail($post->ID,'full',array('class'=>'img-responsive'));
			$output .='</a>';
			
		}

		$output .= '</div>';

	}

	$output .= '</div>';

	wp_reset_postdata();

	return $output;
}

//Visual Composer Addons Register
if (class_exists('WPBakeryVisualComposerAbstract')) {
	vc_map(array(
		"name" => __("Themeum Client", "themeum"),
		"base" => "themeum_client",
		'icon' => 'icon-thm-title',
		"class" => "",
		"description" => "Themeum Client Shortocde",
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
				"heading" => __("Custom Class", "themeum"),
				"param_name" => "class",
				"value" => "",
				),
			)

		));
}
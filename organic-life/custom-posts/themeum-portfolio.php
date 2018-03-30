<?php
/*--------------------------------------------------------------
 *			Register Portfolio Post Type
 *-------------------------------------------------------------*/

function themeum_post_type_portfolio()
{
	$labels = array( 
			'name'                	=> _x( 'Portfolio', 'Portfolio', 'themeum' ),
			'singular_name'       	=> _x( 'Portfolio', 'Portfolio', 'themeum' ),
			'menu_name'           	=> __( 'Portfolio', 'themeum' ),
			'parent_item_colon'   	=> __( 'Parent Portfolio:', 'themeum' ),
			'all_items'           	=> __( 'All Portfolio', 'themeum' ),
			'view_item'           	=> __( 'View Portfolio', 'themeum' ),
			'add_new_item'        	=> __( 'Add New Portfolio', 'themeum' ),
			'add_new'             	=> __( 'New Portfolio', 'themeum' ),
			'edit_item'           	=> __( 'Edit Portfolio', 'themeum' ),
			'update_item'         	=> __( 'Update Portfolio', 'themeum' ),
			'search_items'        	=> __( 'Search Portfolio', 'themeum' ),
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
			'supports'           	=> array( 'title','editor','thumbnail','comments')
		);

	register_post_type('portfolio',$args);

}

add_action('init','themeum_post_type_portfolio');


/*--------------------------------------------------------------
 *			View Message When Updated Portfolio
 *-------------------------------------------------------------*/

function themeum_update_message_portfolio()
{
	global $post, $post_ID;

	$message['portfolio'] = array(
					0 	=> '',
					1 	=> sprintf( __('Portfolio updated. <a href="%s">View Portfolio</a>', 'themeum' ), esc_url( get_permalink($post_ID) ) ),
					2 	=> __('Custom field updated.', 'themeum' ),
					3 	=> __('Custom field deleted.', 'themeum' ),
					4 	=> __('Portfolio updated.', 'themeum' ),
					5 	=> isset($_GET['revision']) ? sprintf( __('Portfolio restored to revision from %s', 'themeum' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
					6 	=> sprintf( __('Portfolio published. <a href="%s">View Portfolio</a>', 'themeum' ), esc_url( get_permalink($post_ID) ) ),
					7 	=> __('Portfolio saved.', 'themeum' ),
					8 	=> sprintf( __('Portfolio submitted. <a target="_blank" href="%s">Preview portfolio</a>', 'themeum' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
					9 	=> sprintf( __('Portfolio scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Portfolio</a>', 'themeum' ), date_i18n( __( 'M j, Y @ G:i','themeum'), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
					10 	=> sprintf( __('Portfolio draft updated. <a target="_blank" href="%s">Preview Portfolio</a>', 'themeum' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		);

return $message;
}

add_filter( 'post_updated_messages', 'themeum_update_message_portfolio' );


/*--------------------------------------------------------------
 *			Register Custom Taxonomies
 *-------------------------------------------------------------*/

function themeum_create_portfolio_taxonomy()
{
	$labels = array(	'name'              => _x( 'Categories', 'taxonomy general name','themeum'),
						'singular_name'     => _x( 'Category', 'taxonomy singular name','themeum' ),
						'search_items'      => __( 'Search Category','themeum'),
						'all_items'         => __( 'All Category','themeum'),
						'parent_item'       => __( 'Parent Category','themeum'),
						'parent_item_colon' => __( 'Parent Category:','themeum'),
						'edit_item'         => __( 'Edit Category','themeum'),
						'update_item'       => __( 'Update Category','themeum'),
						'add_new_item'      => __( 'Add New Category','themeum'),
						'new_item_name'     => __( 'New Category Name','themeum'),
						'menu_name'         => __( 'Category','themeum')
		);

	$args = array(	'hierarchical'      => true,
					'labels'            => $labels,
					'show_ui'           => true,
					'show_admin_column' => true,
					'query_var'         => true,
		);

	register_taxonomy('portfolio_tag',array( 'portfolio' ),$args);

}

add_action('init','themeum_create_portfolio_taxonomy');


/*--------------------------------------------------------------
 *			Portfolio Slider Shortcode
 *-------------------------------------------------------------*/

add_shortcode('themeum_portfolio','themeum_portfolio_shortcode');

function themeum_portfolio_shortcode($atts, $content=null)
{
	extract(shortcode_atts(array(
	'name' => '',
	'column' => '',
	'class' => '',
	'number' => '6'
	), $atts));

	global $themeum_options;
	$disable_filter = 0;
	$disable_single = 0;
	$disable_popup = 0;
	$disable_loadmore = 0;

	if (isset($themeum_options)) {
		$disable_filter  	= $themeum_options['disable-filter'];
		$disable_single  	= $themeum_options['disable-single'];
		$disable_popup  	= $themeum_options['disable-poup'];
		$disable_loadmore  	= $themeum_options['disable-load-more'];
	}

	$filters = get_terms('portfolio_tag');
	$output = '';


	if (!$disable_filter)
	{
		$output .= '<ul id="portfolio-filter" class="portfolio-filter text-center">';
		$output .= '<li><a class="btn btn-default active" href="#" data-filter="*">All</a></li>';

		foreach ($filters as $filter)
		{
			$output .= '<li><a class="btn btn-default" href="#" data-filter=".'.$filter->slug.'">'.$filter->name.'</a></li>';
		}

		$output .= '</ul>';
	}

	$args = array(
			'post_type'			=> 'portfolio',
			'posts_per_page' 	=> $number,
			'orderby' 			=> 'menu_order',
			'order' 			=> 'ASC'
		);

	$myportfolios = get_posts($args);

	$output .= '<ul id="themeum-area" class="portfolio-items col-'.$column.'">';

	$total = count($myportfolios);
	$count = 0;
	$index = 0;

	foreach ($myportfolios as $post)
	{
		setup_postdata( $post );
		$folio_video  = get_post_meta($post->ID,'thm_portfolio_video',true);

		//Filter List Item
		$terms = get_the_terms( $post->ID, 'portfolio_tag' );
		$term_name = '';

		if ($terms) {
			foreach ( $terms as $term ) {
				$term_name .= ' '.$term->slug;
			}
		}

		//category list
		$terms2 = get_the_terms( $post->ID, 'portfolio_tag' );

		$term_name2 = '';

		if ($terms2)
		{
			foreach ( $terms2 as $term2 )
			{
				$term_name2 .= $term2->slug.', ';
			}
		}
		$term_name2 = substr($term_name2, 0, -2);		

		$output .= '<li class="themeum-post-item portfolio-item'.$term_name.'">';
		$output .= '<div class="portfolio-thumb-wrapper">';
		$output .= '<div class="portfolio-thumb">';

		if(has_post_thumbnail($post->ID))
		{
			if ($column == '2') {
				$thumb 	= wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'portfolio-thumb2');
			}else{
				$thumb 	= wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'portfolio-thumb');
			}
			$output .= '<img class="img-responsive" src="'.$thumb[0].'"  alt="">';
		} else {
			$output .= '<img class="img-responsive" src="'.get_template_directory_uri().'/images/recipes.jpg" alt="">';
		}

		$output .= '</div>';

		$output .= '<div class="thumb-overlay">';

		if (!$disable_single)
		{
			$output .= '<a class="folio-read-more" href="'.get_permalink( $post->ID ).'"><i class="fa fa-link"></i></a>';
		}

		if (!$disable_popup)
		{
			if ($folio_video) {
				$output .= '<a data-rel="prettyPhoto[pp_gal]" class="btn-preview" href="'.$folio_video.'"><i class="fa fa-search-plus"></i></a>';
			}else if(has_post_thumbnail($post->ID)) {
				$large_image 	= wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
				$output .= '<a data-rel="prettyPhoto[pp_gal]" class="btn-preview" href="'.$large_image[0].'"><i class="fa fa-search-plus"></i></a>';
			}else{
				$output .= '<a data-rel="prettyPhoto[pp_gal]" class="btn-preview" href="'.get_template_directory_uri().'/images/recipes.jpg"><i class="fa fa-search"></i></a>';
			}
		}
		$output .= '</div>';		

		$output .= '</div>';

		$output .= '<div class="portfolio-item-content">';
		$output .= '<h3 class="portfolio-title"><a href="'.get_permalink( $post->ID ).'">'.get_the_title($post->ID).'</a></h3>';
		if($term_name != '')
        {
	        $output .= '<span class="portfolio-category">'.$term_name2.'</span>';
	    }
		$output .= '</div>';
		$output .= '</li>';

		$count++;
		$index++;
	}

	$output .= '</ul>';

	$allposts = wp_count_posts('portfolio');
	
	if (!$disable_loadmore)
	{
		if($allposts->publish > $number){
			$output .= '<div class="clearfix load-wrap">';
			$output .= '<span class="ajax-loader">Ajax Loader</span>';
			$output .= '<div class="clearfix"></div>';
			$output .= '<a class="load-more btn btn-primary" id="post-loadmore" data-per_page="'.$number.'" data-url="'.get_template_directory_uri().'/custom-posts/themeum-loadmore.php'.'" data-total_posts="'.$allposts->publish.'" data-col_grid="'.$column.'" href="#">'.__('Load More', 'themeum').'</a>';
			$output .= '</div>';
		}
	}

	wp_reset_postdata();

	return $output;
}

//Visual Composer addons register
if (class_exists('WPBakeryVisualComposerAbstract')) {
	vc_map(array(
		"name" => __("Themeum Portfolio", "themeum"),
		"base" => "themeum_portfolio",
		'icon' => 'icon-thm-portfolio',
		"class" => "",
		"description" => __("Widget Portfolio", "themeum"),
		"category" => __('Themeum', "themeum"),
		"params" => array(				

			array(
				"type" => "textfield",
				"heading" => __("Themeum Portfolio", "themeum"),
				"param_name" => "portfolio",
				"value" => "",
				),

			array(
				"type" => "textfield",
				"heading" => __("Themeum Number Of Portfolio", "themeum"),
				"param_name" => "number",
				"value" => "",
				),

			array(
				"type" => "dropdown",
				"heading" => __("Select Column", "themeum"),
				"param_name" => "column",
				"value" => array('2'=>'2','3'=>'3','4'=>'4','5'=>'5'),
				),	

			)

		));
}
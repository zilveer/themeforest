<?php
define('WP_USE_THEMES', false);
$parse_uri = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
$wp_load = $parse_uri[0].'wp-load.php';
require_once($wp_load);

global $themeum_options;
$disable_single = 0;
$disable_popup = 0;

if (isset($themeum_options)) {
	$disable_single  	= $themeum_options['disable-single'];
	$disable_popup  	= $themeum_options['disable-poup'];
}

$output = '';

$args = array(  'post_type'			=>'portfolio',
				'posts_per_page' 	=> $_POST['perpage'],
				'paged' 			=> $_POST['paged'],
				'orderby' 			=> 'menu_order',
				'order' 			=> 'ASC'	
	);

$column = $_POST['col_grid'];

$portfolios = new WP_Query($args);

if($portfolios->have_posts()):

	while ($portfolios->have_posts()): $portfolios->the_post();
		$terms = get_the_terms( $post->ID, 'portfolio_tag' );
		$folio_video  = get_post_meta($post->ID,'thm_portfolio_video',true);

		$term_name = '';

		if ($terms)
		{
			foreach ( $terms as $term )
			{
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
				$output .= '<a data-rel="prettyPhoto[pp_gal]" href="'.$folio_video.'"><i class="fa fa-search"></i></a>';
			}else if(has_post_thumbnail($post->ID)) {
				$large_image 	= wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
				$output .= '<a data-rel="prettyPhoto[pp_gal]" href="'.$large_image[0].'"><i class="fa fa-search"></i></a>';
			}else{
				$output .= '<a data-rel="prettyPhoto[pp_gal]" href="'.get_template_directory_uri().'/images/recipes.jpg"><i class="fa fa-search"></i></a>';
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
	endwhile;
endif;

echo $output;

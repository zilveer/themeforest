<?php
/**
 * This file generates the portfolio items HTML.
 */

echo '<div class="items">';

//set the query_posts args
$args= array(
         'posts_per_page' =>-1, 
		 'post_type' => 'portfolio',
		 'orderby' => 'menu_order'
	);

	if($catId!='-1'){
		$slug=pexeto_get_taxonomy_slug($catId);
		$args['portfolio_category']=$slug;
	}
	
//set the order args	
if($order=='custom'){
	$args['orderby']='menu_order';
	$args['order']='asc';
}else{
	$args['orderby']='date';
	$args['order']='desc';
}


	
query_posts($args);
	
	if(have_posts()) {
		 while (have_posts()) {
		 	the_post(); 
		 	$html = '<div class="portfolio-showcase-item">';
		 	$html.='<div class="preview-item">';
			$html.='<h1 class="page-heading">'.get_the_title().'</h1><hr/><hr/>';
			$preview=get_post_meta($post->ID, 'preview_value', true);	
			$html.='<img class="alignleft shadow-frame portfolio-big-img" alt="" src="'.$preview.'">';
			$html.=do_shortcode(get_the_content());
			$html.='</div>';
			
			//generate the HTML for the smaller preview item
			
		 	if($auto_thumbnail=='on'){
				$thumbnail=pexeto_get_resized_image($preview, 110, 100);
			}else{
				$thumbnail=get_post_meta($post->ID, 'thumbnail_value', true);
			}
			$html.='<div class="showcase-item"><img class="alignleft shadow-frame" alt="" src="'.$thumbnail.'"></div>';
			

			
			$html.= '</div>';
			echo $html;
		}
	}
	
echo '</div>';	

<?php

function mk_portfolio_flip_loop( &$r, $atts, $current ) {
	global $post;
	extract( $atts );
	

	if ( $column > 5) {
		$column = 5;
	}


	switch ( $column ) {
			case 1 :
			if ( $layout=='full' ) {
				$width = round($grid_width - 15);
			}else {
				$width = round((($content_width / 100) * $grid_width) - 15);
			}
			$mk_column_css = 'one-column';
		break;
		
		case 2 :
			if ( $layout=='full' ) {
				$width = round($grid_width/2 - 15);
			}else {
				$width = round((($content_width / 100) * $grid_width)/2 - 15);
			}
			$mk_column_css = 'two-column';
		break;

		case 3 :
			$width = $grid_width/3 - 15;
			$mk_column_css = 'three-column';
		break;

		case 4 :
			$width = $grid_width/4 - 15;
			$mk_column_css = 'four-column';
		break;

		case 5 :
			$width = $grid_width/5 - 9;
			$mk_column_css = 'five-column';
		break;

		default :
			$width = $grid_width/3 - 15;
			$mk_column_css = 'three-column';
		break;
	}

	$output = '';



	$terms = get_the_terms( get_the_id(), 'portfolio_category' );
	$terms_slug = array();
	$terms_name = array();
	if ( is_array( $terms ) ) {
		foreach ( $terms as $term ) {
			$terms_slug[] = $term->slug;
			$terms_name[] = $term->name;

		}
	}


	$height = !empty( $height ) ? $height : 380;


	$link_to = get_post_meta( get_the_ID(), '_portfolio_permalink', true );
	$permalink  = '';
	if ( !empty( $link_to ) ) {
		$link_array = explode( '||', $link_to );
		switch ( $link_array[ 0 ] ) {
		case 'page':
			$permalink = get_page_link( $link_array[ 1 ] );
			break;
		case 'cat':
			$permalink = get_category_link( $link_array[ 1 ] );
			break;
		case 'portfolio':
			$permalink = get_permalink( $link_array[ 1 ] );
			break;
		case 'post':
			$permalink = get_permalink( $link_array[ 1 ] );
			break;
		case 'manually':
			$permalink = $link_array[ 1 ];
			break;
		}
	}

	if($ajax == 'true' || empty( $permalink )) {
		$permalink = get_permalink();
	}

	switch ($image_size) {
        case 'full':
            $image_src_array = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full', true);
            $image_src = $image_src_array[0];
            break;
        case 'crop':
            $image_src_array = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full', true);
            $image_src = bfi_thumb($image_src_array[0], array(
                'width' => $width * $image_quality,
                'height' => $height * $image_quality
            ));
            break;            
        case 'large':
            $image_src_array = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large', true);
            $image_src = $image_src_array[0];
            break;
        case 'medium':
            $image_src_array = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium', true);
            $image_src = $image_src_array[0];
            break;        
        default:
            $image_src_array = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full', true);
            $image_src = bfi_thumb($image_src_array[0], array(
                'width' => $width * $image_quality,
                'height' => $height * $image_quality
            ));
         break;
    }

	$output .='<article id="portfolio-'.get_the_ID().'" class="flip-portfolio-item flip-'.$item_id.' portfolio-ajax-item '.$mk_column_css.' mk-portfolio-item mk-isotop-item ' . implode( ' ', $terms_slug ) . '"><div class="item-holder">';
	
	$output .= '<div class="flip-wrapper">';

	$output .= '<figure class="front">';
		$output .='<img alt="'.get_the_title().'" title="'.get_the_title().'" src="'.mk_thumbnail_image_gen($image_src, $width*$image_quality, $height*$image_quality).'" itemprop="image" />';
	$output .='</figure>';

	$output .= '<figure class="back">';
		$output .='<div class="featured-image">';
		$output .='<img alt="'.get_the_title().'" title="'.get_the_title().'" src="'.mk_thumbnail_image_gen($image_src, $width, $height).'"  />';
		$output .='<div class="flip-overlay"></div>';
		$output .='<div class="portfolio-meta">';
				$output .='<div class="the-title"><a class="project-load" data-post-id="'.get_the_ID().'" href="'.$permalink.'">'.get_the_title().'</a></div><div class="clearboth"></div>';
				$output .='<span class="portfolio-cats">'. implode( ', ', $terms_name ) .'</span>';
		$output .='</div>';
		$output .='</div>';
			
	$output .='</figure>';

	$output .= '</div>';



	$output .='</div></article>';


	return $output;

}


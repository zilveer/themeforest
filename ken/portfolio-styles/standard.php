<?php

function mk_portfolio_standard_loop( &$r, $atts, $current ) {
	global $post;
	extract( $atts );


	if ( $column > 5) {
		$column = 5;
	}

	switch ( $column ) {
			case 1 :
			if ( $layout=='full' ) {
				$width = round($grid_width - 1);
			}else {
				$width = round((($content_width / 100) * $grid_width) - 1);
			}
			$mk_column_css = 'one-column';
		break;
		case 2 :
			if ( $layout=='full' ) {
				$width = round($grid_width/2 - 1);
			}else {
				$width = round((($content_width / 100) * $grid_width)/2 - 1);
			}
			$mk_column_css = 'two-column';
		break;

		case 3 :
			$width = $grid_width/3 - 15;
			$mk_column_css = 'three-column';
		break;

		case 4 :
			$width = $grid_width/4 - 1;
			$mk_column_css = 'four-column';
		break;
		case 5 :
			$width = $grid_width/5 - 1;
			$mk_column_css = 'five-column';
		break;
		default :
			$width = $grid_width/3 - 5;
			$mk_column_css = 'three-column';
		break;
	}



	$output = '';

	$post_type = get_post_format( get_the_id());

	if(empty($post_type)) {
		$post_type = 'image';
	}


	$height = !empty( $height ) ? $height : 400;


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


	$item_logo = get_post_meta( get_the_ID(), '_portfolio_item_logo', true );

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


	$output .='<article id="portfolio-'.get_the_ID().'" class="standard-portfolio-item standard-'.$item_id.' portfolio-ajax-item mk-portfolio-item '.$hover_style.'-hover mk-isotop-item '.$mk_column_css.' ' . implode( ' ', mk_get_portfolio_tax($post->ID, false, true) ) . '"><div class="item-holder">';




	$output .='<div class="featured-image">';
	$output .='<img alt="'.get_the_title().'" width="'.$width.'" class="item-featured-image" height="'.$height.'" title="'.get_the_title().'" src="'.mk_thumbnail_image_gen($image_src, $width*$image_quality, $height*$image_quality).'" itemprop="image" />';
	$output .='<div class="hover-overlay"></div>';
	if(!empty($item_logo)  && $show_logo == 'true') {
		$output .= '<img class="portfolio-entry-logo" src="'.$item_logo.'" alt="'.get_the_title().'" />';
	}
	$output .='<div class="portfolio-meta">';

	if($plus_icon == 'true') {
		$output .='<a href="'.$image_src_array[ 0 ].'" title="'.get_the_title().'"  data-fancybox-group="portfolio-loop"  class="mk-lightbox portfolio-plus-icon"><i class="mk-theme-icon-plus"></i></a>';
	}
	if($permalink_icon == 'true') {
		$output .= '<a class="project-load portfolio-permalink" data-post-id="'.get_the_ID().'" href="'.$permalink.'"><i class="mk-theme-icon-next-big"></i></a>';
	}
	$output .='</div>';

	$output .='</div>';
	
	$output .='<div class="the-title">'.get_the_title().'</div><div class="clearboth"></div>';
	$output .='<div class="portfolio-cats">'. implode( ', ', mk_get_portfolio_tax($post->ID, false) ) .'</div>';

	$output .='</div></article>';


	return $output;

}










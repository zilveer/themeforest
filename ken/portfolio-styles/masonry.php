<?php

function mk_portfolio_masonry_loop( &$r, $atts, $current ) {
	global $post;
	extract( $atts );



	$output = $parallax_class = $parallax_data = '';

	$image_size = get_post_meta( get_the_ID(), '_masonry_img_size', true );
	$column = !(empty($image_size)) ? $image_size : 'two_x_two_x';

	$item_logo = get_post_meta( get_the_ID(), '_portfolio_item_logo', true );


	/* Backward compatibility with V3.x */
	switch ( $column ) {
		case 'regular':
			$column = 'two_x_two_x';
			break;
		case 'tall':
			$column = 'four_x_two_x';
			break;
		case 'wide':
			$column = 'two_x_four_x';
			break;
		case 'wide_tall':
			$column = 'four_x_four_x';
			break;
	}


	switch ($column) {
        case 'x_x':
            $width  = 300;
            $height = 300;
            break;
        
        case 'two_x_x': // 
            $width  = 600;
            $height = 300;
            break;
        
        case 'three_x_x':
            $width  = 900;
            $height = 300;
            break;
        case 'four_x_x':
            $width  = 1200;
            $height = 300;
            break;
        
        case 'x_two_x':
            $width  = 300;
            $height = 600;
            break;

        case 'two_x_two_x':
            $width  = 600;
            $height = 600;
            break;

        case 'two_x_four_x':
            $width  = 600;
            $height = 1200;
            break;    
        case 'three_x_two_x':
            $width  = 900;
            $height = 600;
            break;
        
        case 'four_x_two_x':
            $width  = 1200;
            $height = 600;
            break;

        case 'four_x_four_x':
            $width  = 1200;
            $height = 1200;
            break;    
        
        default:
            $width  = 300;
            $height = 300;
            break;
    }



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

	if ( $ajax == 'true' || empty( $permalink ) ) {
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


	if($hover_style == 'parallax') {
		$parallax_class = 'layer';
		$parallax_data = 'data-depth="0.50"';
	}

	$output .='<article id="portfolio-'.get_the_ID().'" class="masonry-portfolio-item masonry-'.$item_id.' mk-portfolio-item '.$hover_style.'-hover portfolio-ajax-item mk-isotop-item size_'.$column.' ' . implode( ' ', mk_get_portfolio_tax($post->ID, false, true)  ) . '"><div class="item-holder">';

	$output .='<div class="featured-image '.$parallax_class.'" '.$parallax_data.'>';
	if($hover_style == 'parallax') { $output .= '<a href="'.$image_src_array[ 0 ].'" title="'.get_the_title().'" data-fancybox-group="portfolio-loop" class="mk-lightbox" style="display: block;">'; }
	$output .='<img alt="'.get_the_title().'" width="'.$width.'" class="item-featured-image" height="'.$height.'" title="'.get_the_title().'" src="'.mk_thumbnail_image_gen($image_src, $width*$image_quality, $height*$image_quality).'" itemprop="image" />';
	if($hover_style == 'parallax') { $output .= '</a>'; }

	if ($hover_style == 'classic'){
		$output .='<div class="border-tb masonry-border"></div>';
		$output .='<div class="border-tr masonry-border"></div>';
		$output .='<div class="border-bt masonry-border"></div>';
		$output .='<div class="border-bl masonry-border"></div>';
	}

	if($hover_style != 'parallax') {
		$output .='<div class="hover-overlay"></div>';

		if(!empty($item_logo)  && $show_logo == 'true') {
			$output .= '<img class="portfolio-entry-logo" src="'.$item_logo.'" alt="'.get_the_title().'" />';
		}

		$output .='<div class="portfolio-meta">';
		if($plus_icon == 'true') {
			$output .='<a href="'.$image_src_array[ 0 ].'" title="'.get_the_title().'"  data-fancybox-group="portfolio-loop"  class="mk-lightbox portfolio-plus-icon"><i class="mk-theme-icon-plus"></i></a>';
		}
		if($ajax == 'true') {
			$output .='<div class="the-title"><span>'.get_the_title().'</span></div><div class="clearboth"></div>';
		} else {
			if ($hover_style == 'stroke') {
				if($permalink_icon == 'true') {
					$output .='<a href="'.$permalink.'"><div class="the-title">'.get_the_title().'</div><div class="clearboth"></div></a>';
				} else {
					$output .='<div class="the-title">'.get_the_title().'</div><div class="clearboth"></div>';
				}
			}else{
				if($permalink_icon == 'true') {
					$output .='<div class="the-title"><a href="'.$permalink.'">'.get_the_title().'</a></div><div class="clearboth"></div>';
				} else {
					$output .='<div class="the-title">'.get_the_title().'</div><div class="clearboth"></div>';
				}
			}
		}

		$output .='<div class="portfolio-cats">'. implode( ', ', mk_get_portfolio_tax($post->ID, false) ) .'</div>';

		if($permalink_icon == 'true') {
			$output .= '<a class="project-load portfolio-permalink" data-post-id="'.get_the_ID().'" href="'.$permalink.'"><i class="mk-theme-icon-next-big"></i></a>';
		}
		$output .='</div>';
	}
	$output .='</div>';


	$output .='</div></article>';


	return $output;

}

<?php

function mk_portfolio_scroller_loop( &$r, $atts, $current, $i ) {
	global $post;
	extract( $atts );



	$output = '';


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


	$item_logo = get_post_meta( get_the_ID(), '_portfolio_item_logo', true );

	if($i%2 != 0 && $item_row == 2) {
		$output .= '<article id="portfolio-'.get_the_ID().'" class="portfolio-scroller mk-portfolio-item '.$hover_style.'-hover swiper-slide ' . implode( ' ', mk_get_portfolio_tax($post->ID, false, true)  ) . '">';
	} else if($item_row == 1) {
		$output .= '<article id="portfolio-'.get_the_ID().'" class="portfolio-scroller mk-portfolio-item '.$hover_style.'-hover swiper-slide ' . implode( ' ', mk_get_portfolio_tax($post->ID, false, true)  ) . '">';
	}
		$output .= '<div class="item-holder">';
		$output .='<div class="featured-image">';
		
		$output .='<img alt="'.get_the_title().'" width="'.$width.'" class="item-featured-image" height="'.$height.'" title="'.get_the_title().'" src="'.mk_thumbnail_image_gen($image_src, $width*$image_quality, $height*$image_quality).'" itemprop="image" />';

		if ($hover_style == 'classic'){
			$output .='<div class="border-tb masonry-border"></div>';
			$output .='<div class="border-tr masonry-border"></div>';
			$output .='<div class="border-bt masonry-border"></div>';
			$output .='<div class="border-bl masonry-border"></div>';
		}

		$output .='<div class="hover-overlay"></div>';

		if(!empty($item_logo)  && $show_logo == 'true') {
			$output .= '<img class="portfolio-entry-logo" src="'.$item_logo.'" alt="'.get_the_title().'" />';
		}

		$output .='<div class="portfolio-meta">';
		if ($hover_style == 'classic'){
			if($plus_icon == 'true') {
				$output .='<a href="'.$image_src_array[ 0 ].'" title="'.get_the_title().'"  data-fancybox-group="portfolio-loop"  class="mk-lightbox portfolio-plus-icon"><i class="mk-theme-icon-plus"></i></a>';
			}
			if($ajax == 'true') {
				$output .='<div class="the-title"><span>'.get_the_title().'</span></div><div class="clearboth"></div>';
			} else {
				if($permalink_icon == 'true') {
					$output .='<div class="the-title"><a href="'.$permalink.'">'.get_the_title().'</a></div><div class="clearboth"></div>';
				} else {
					$output .='<div class="the-title">'.get_the_title().'</div><div class="clearboth"></div>';
				}
			}
			$output .='<div class="portfolio-cats">'. implode( ', ', mk_get_portfolio_tax($post->ID, false) ) .'</div>';
			if($permalink_icon == 'true') {
				$output .='<a class="project-load portfolio-permalink" data-post-id="'.get_the_ID().'" href="'.$permalink.'"><i class="mk-theme-icon-next-big"></i></a>';
			}
		}else{
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
			$output .= '<div class="portfolio-button">';
			if($permalink_icon == 'true') {
				$output .='<a class="project-load portfolio-permalink" data-post-id="'.get_the_ID().'" href="'.$permalink.'"><i class="mk-theme-icon-next-big"></i></a>';
			}
			if($plus_icon == 'true') {
				$output .='<a href="'.$image_src_array[ 0 ].'" title="'.get_the_title().'"  data-fancybox-group="portfolio-loop"  class="mk-lightbox portfolio-plus-icon"><i class="mk-theme-icon-plus"></i></a>';
			}
			$output .= '</div>';
		}
		$output .='</div>';

		$output .= '</div>';

		$output .= '</div>';

		if($i%2 == 0 && $item_row == 2) {
			$output .='</article>';
		} else if($item_row == 1){
			$output .='</article>';
		}



	return $output;

}






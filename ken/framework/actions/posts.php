<?php
/**
 *
 * @author  Bob Ulusoy
 * @copyright Copyright (c) Bob Ulusoy
 * @link  http://artbees.net
 * @since  Version 2.0
 * @package  MK Framework
 */


add_action('blog_related_posts', 'mk_blog_related_posts');
add_action('portfolio_related_posts', 'mk_portfolio_related_posts');





if ( !function_exists( 'mk_blog_related_posts' ) ) {
	function mk_blog_related_posts( $layout ) {
		global $post, $mk_settings;

		if($mk_settings['blog-single-related-posts'] == 0 ) return;

		$output = '';
		$width = 259;
		$height = 161;

		if ( $layout == 'full' ) {
			$showposts = 4;
			$column_css = 'four-column';
		} else {
			$showposts = 3;
			$column_css = 'three-column';
		}

		$related = mk_get_related_posts( $post->ID, $showposts, true );
		if ( $related->have_posts() ) {
				$output .= '<section class="blog-similar-posts">';

				$output .=  '<div class="single-post-fancy-title"><span>'.__( 'Related Posts', 'mk_framework' ).'</span></div>';

				$output .= '<ul class="'.$column_css.'">';
				while ( $related->have_posts() ) {
					$related->the_post();
					$post_type = get_post_format( get_the_id()) ? get_post_format( get_the_id()) : 'image';
					$output .= '<li><div class="item-holder">';
					$output .= '<a class="mk-similiar-thumbnail" href="' . get_permalink() . '" title="' . get_the_title() . '">';
					if ( has_post_thumbnail() ) {
						$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
						$image_src = bfi_thumb( $image_src_array[ 0 ], array('width' => $width, 'height' => $height, 'crop'=>true));
						$output .= '<img width="'.$width.'" height="'.$height.'" src="' .mk_thumbnail_image_gen($image_src, $width, $height) . '" alt="' . get_the_title() . '" />';
					}

					$output .= '<i class="mk-icon-plus post-hover-icon"></i><div class="hover-overlay"></div></a>';
					$output .= '<a href="'.get_permalink().'" class="mk-similiar-title">'.get_the_title().'</a>';

					$output .= '</div></li>';

				}
				$output .= '</ul>';
				$output .= '<div class="clearboth"></div></section>';
			}
		wp_reset_postdata();
		echo $output;
	}
	/*-----------------*/
}








if ( !function_exists( 'mk_portfolio_related_posts' ) ) {
	function mk_portfolio_related_posts($layout) {
		global $mk_settings,
		$post;
		$output = '';
		$width = 550;
		$height = 550;

		if ( $layout == 'full' ) {
			$showposts = 4;
			$column_css = 'four-column';
		} else {
			$showposts = 3;
			$column_css = 'three-column';
		}

		 $related = mk_get_related_portfolio( $post->ID,$showposts);

		 $related_project = get_post_meta( get_the_ID(), '_portfolio_related_project', true );

		 if($related_project != 'true' && $related_project != '' ) return false;
			if ( $related->have_posts() ) {

				$output .= '<section class="portfolio-similar-posts">';
				$output .= '<ul class="'.$column_css.'">';
				while ( $related->have_posts() ) {
					global $post;
					$related->the_post();
						$output .= '<li class="mk-portfolio-item">';

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

						if ( empty( $permalink ) ) {
							$permalink = get_permalink();
						}


						$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
						$image_src = bfi_thumb( $image_src_array[ 0 ], array('width' => $width, 'height' => $height, 'crop'=>true));
						$output .= '<div class="item-holder">';

						$output .='<div class="featured-image" onClick="return true">';
						$output .='<img width="'.$width.'" height="'.$height.'" alt="'.get_the_title().'" title="'.get_the_title().'" src="'.mk_thumbnail_image_gen($image_src, $width, $height).'"  />';
						$output .='<div class="hover-overlay"></div>';
						$output .='<div class="portfolio-meta">';
						$output .='<a href="'.$image_src_array[ 0 ].'" title="'.get_the_title().'" rel="portfolio-loop" class="mk-lightbox portfolio-plus-icon"><i class="mk-theme-icon-plus"></i></a>';
						$output .='<div class="the-title">'.get_the_title().'</div><div class="clearboth"></div>';
						$output .='<div class="portfolio-cats">'. implode( ', ', mk_get_portfolio_tax($post->ID, false) ) .'</div>';
						$output .='<a class="portfolio-permalink" href="'.$permalink.'"><i class="mk-theme-icon-next-big"></i></a>';
						$output .='</div>';

						$output .= '</div></li>';
				}
				$output .= '</ul>';
				$output .= '<div class="clearboth"></div></section>';
			}


		wp_reset_postdata();
		echo $output;
	}
}
	/*-----------------*/

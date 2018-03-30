<?php
$output = $blog_html = '';
$atts 	= vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$el_class = $this->getExtraClass( $el_class );
$css_classes = array( 'latest_news', $el_class );
$css_classes[] = 'dark';
$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

if( $type == 'posts_id' && ! empty( $posts_id ) ) {
	$ids = esc_attr( $posts_id );
	$ids = explode(',', $posts_id);
	$args = array(
		'post_type' 			=> 'post',
		'ignore_sticky_posts' 	=> 1,
		'orderby'				=> 'none',
		'post__in'				=> $ids
	);
} else {
	$args = array(
		'post_type' 			=> 'post',
		'ignore_sticky_posts' 	=> 1,
		'posts_per_page'		=> absint( $num ),
		'order'					=> 'DESC',
	);
	if ( ! empty( $category ) && $category != -1 ) {
		$args['cat'] = absint( $category );
	}
}

$query = new WP_Query( $args );
if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		$query->the_post();
		$icon_post = 'fa fa-picture-o';
		$format  = get_post_format();
		if( $format == 'video' ) {
			$icon_post = 'fa fa-video-camera';
		} elseif( $format == 'audio' ) {
			$icon_post = 'fa fa-volume-up';
		} elseif( $format == 'link' ) {
			$icon_post = 'fa fa-link';
		} elseif( $format == 'link' ) {
			$icon_post = 'fa fa-link';
		} elseif( $format == 'quote' ) {
			$icon_post = 'fa fa-quote-left';
		}
		
		$blog_html .= '<article id="post-'. get_the_ID() .'" class="news-item col-md-4 col-sm-4 col-xs-12 col-st-6">
						<figure>'
							. get_the_post_thumbnail( get_the_ID() ,'majesty-thumb-450', array('class'=>'img-responsive')) .
							'<figcaption class="text-center">
								<div class="fig_container">
									<i class="'. esc_attr( $icon_post ) .'"></i>
									<h3><a href="'. esc_url( get_permalink() ) .'" title="'. the_title_attribute('echo=0') .'" rel="bookmark">'. get_the_title() .'</a></h3>'
									. get_the_term_list( get_the_ID(), 'category', '<p class="post-cats"> ', ', ', '</p>' ) .'';
									if ( $display_excerpt == 'yes' ) {
										$blog_html .= '<div class="fig_content">'. sama_get_custom_excerpt( $ex_lengs).'</div>';
									}
								$blog_html .= '</div>
								<span class="btn btn-gold primary-bg white"><time class="entry-date" datetime="'. esc_attr( get_the_date( 'c', get_the_id() ) ) .'">'. esc_attr( get_the_date( '', get_the_id() ) ) .'</time></span>
							</figcaption>
					  </figure>
					</article>';
	}
	if( $display_view_more == 'yes' ) {
		$page_for_posts = get_option( 'page_for_posts' );
		if( ! empty( $page_for_posts ) && $page_for_posts != -1 ) {
			$blog_url	= get_permalink( $page_for_posts );
			$blog_html .= '<div class="col-md-12 text-center">
							<a href="'. esc_url($blog_url) .'" class="btn btn-gold dark mt60">'.esc_html__('View More', 'theme-majesty') .'</a>
						</div>';
		}		
	}
}
wp_reset_postdata();
global $majesty_allowed_tags;
echo '<div class="' . esc_attr( trim( $css_class ) ) .'"">'. wp_kses($blog_html, $majesty_allowed_tags) .'</div>';
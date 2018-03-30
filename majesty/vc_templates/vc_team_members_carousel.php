<?php
wp_enqueue_script('owl-carousel');

$output = $display = $num = $ids = $el_class = $order = $orderby = '';
$atts 	= vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$el_class = $this->getExtraClass( $el_class );
$css_classes = array( 'our_team', $el_class );
$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

if( $display == 'id' && ! empty( $ids ) ) {
	$ids = explode(',', $ids);
	$args = array(
		'post_type' 			=> 'team-member',
		'ignore_sticky_posts' 	=> 1,
		'orderby'				=> 'none',
		'post__in'				=> esc_attr( $ids )
	);
} else {
	$args = array(
		'post_type' 			=> 'team-member',
		'ignore_sticky_posts' 	=> 1,
		'posts_per_page'		=> absint( $num ),
		'order'					=> esc_attr($order), //ASC
		'orderby'				=> esc_attr($orderby), 
	);
}
if( ! empty( $hidefields ) ) {
	$hidefields = explode(',', $hidefields);
} else {
	$hidefields = array();
}

$team_query = new WP_Query( $args );
if ( $team_query->have_posts() ) {
	$output .= '<div '. implode( ' ', $wrapper_attributes ) .'><div id="our_team_carousel" class="owl-carousel owl-theme">';
	
	while ( $team_query->have_posts() ) {
		$team_query->the_post();
		$facebook_url = esc_url ( get_post_meta( get_the_ID(), '_facebook', true) );
		$twitter_url  = '';
		if( get_post_meta( get_the_ID(), '_twitter', true) ) {
			$twitter_url  = esc_url ( 'https://twitter.com/'. get_post_meta( get_the_ID(), '_twitter', true) );
		}
		$gplus_url  = esc_url ( get_post_meta( get_the_ID(), '_googleplus', true) );
		$linkedin_url  = esc_url ( get_post_meta( get_the_ID(), '_linkedin', true) );
		$email	= esc_attr ( get_post_meta( get_the_ID(), '_contact_email', true) );
		
		$output .= '<div class="item">
						<div class="overlay_content clearfix">
							<div class="overlay_item">
								'. get_the_post_thumbnail( get_the_ID() ,'blog-majesty-thumb-450', array('class'=>'img-circle')) .'
								<div class="overlay">
									<div class="icons">';
										if ( ! empty( $facebook_url ) )  {
											$output .= '<a href="'. esc_url( $facebook_url ).'" title="Facebook"><i class="fa fa-facebook"></i></a>';
										}
										if ( ! empty ( $twitter_url ) ) {
											$output .= '<a href="'. esc_url( $twitter_url ) .'" title="Twitter"><i class="fa fa-twitter"></i></a>';
										}
										if ( ! empty ( $linkedin_url ) ) {
											$output .= '<a href="'. esc_url( $linkedin_url ).'" title="Linkedin"><i class="fa fa-linkedin"></i></a>';
										}
										if ( ! empty ( $gplus_url ) ) {
											$output .= '<a href="'. esc_url( $gplus_url ) .'" title="Google Plus"><i class="fa fa-google-plus"></i></a>';
										}
										if ( ! empty ( $email ) && ! empty( $displayemail ) && $displayemail == 'yes' ) {
											$output .= '<a href="mailto:'. esc_html( $email ) .'" title="Email"><i class="fa fa-envelope-o"></i></a>';
										}
							$output .=	'<a class="close-overlay hidden">x</a>
									</div>
								</div>
								<div class="desc">';
									if( empty( $link ) || $link != 'no' ) {
										$output .= '<h2><a href="'. esc_url( get_permalink() ) .'" title="'. the_title_attribute('echo=0') .'">'.  get_the_title() .'</a></h2>';
									} else {
										$output .= '<h2>'.  get_the_title() .'</h2>';
									}
									
									$output .= '<p>'. esc_attr( get_post_meta( get_the_ID(), '_byline', true) ) .'</p>
								</div>
							</div>
						</div>
					</div>';	
	}
	
	$output .= '</div></div>';
	global $majesty_allowed_tags;
	echo wp_kses( $output, $majesty_allowed_tags  );
}
wp_reset_postdata();
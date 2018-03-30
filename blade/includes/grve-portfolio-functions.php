<?php

/*
*	Portfolio Helper functions
*
* 	@version	1.0
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/


/**
 * Prints portfolio feature image
 */
function blade_grve_print_portfolio_feature_image() {

	$image_size = 'blade-grve-fullscreen';
	if ( !empty( $image_size ) && has_post_thumbnail() ) {
?>
		<div class="grve-media clearfix">
			<?php the_post_thumbnail( $image_size ); ?>
		</div>
<?php

	}

}

/**
 * Prints Portfolio socials if used
 */
function blade_grve_print_portfolio_media() {
	global $post;
	$post_id = $post->ID;

	$portfolio_media = get_post_meta( $post_id, 'grve_portfolio_media_selection', true );
	$portfolio_image_mode = blade_grve_post_meta( 'grve_portfolio_media_image_mode' );
	$image_size_slider = 'blade-grve-large-rect-horizontal';
	if ( 'resize' == $portfolio_image_mode ) {
		$image_size_slider = 'blade-grve-fullscreen';
	}

	switch( $portfolio_media ) {

		case 'slider':
			$slider_items = get_post_meta( $post_id, 'grve_portfolio_slider_items', true );
			blade_grve_print_gallery_slider( 'slider', $slider_items, $image_size_slider );
			break;
		case 'gallery':
			$slider_items = get_post_meta( $post_id, 'grve_portfolio_slider_items', true );
			blade_grve_print_gallery_slider( 'gallery', $slider_items, '', 'grve-classic-style' );
			break;
		case 'gallery-vertical':
			$slider_items = get_post_meta( $post_id, 'grve_portfolio_slider_items', true );
			blade_grve_print_gallery_slider( 'gallery-vertical', $slider_items, $image_size_slider, 'grve-vertical-style' );
			break;
		case 'video':
			blade_grve_print_portfolio_video();
			break;
		case 'video-html5':
			blade_grve_print_portfolio_video( 'html5' );
			break;
		case 'none':
			break;
		default:
			blade_grve_print_portfolio_feature_image();
			break;

	}
}


/**
 * Prints video of the portfolio media
 */
function blade_grve_print_portfolio_video( $video_mode = '' ) {

	$video_webm = blade_grve_post_meta( 'grve_portfolio_video_webm' );
	$video_mp4 = blade_grve_post_meta( 'grve_portfolio_video_mp4' );
	$video_ogv = blade_grve_post_meta( 'grve_portfolio_video_ogv' );
	$video_poster = blade_grve_post_meta( 'grve_portfolio_video_poster' );
	$video_embed = blade_grve_post_meta( 'grve_portfolio_video_embed' );

	blade_grve_print_media_video( $video_mode, $video_webm, $video_mp4, $video_ogv, $video_embed, $video_poster );
}

 /**
 * Prints portfolio like counter
 */
function blade_grve_print_portfolio_like_counter() {

	$post_likes = blade_grve_option( 'portfolio_social', '', 'grve-likes' );
	if ( !empty( $post_likes  ) ) {
		global $post;
		$post_id = $post->ID;
		$active = blade_grve_likes( $post_id, 'status' );
		$icon = 'fa fa-heart-o';
		if( 'active' == $active ) {
			$icon = 'fa fa-heart';
		}
?>
		<div class="grve-like-counter grve-small-text"><i class="<?php echo esc_attr( $icon ); ?>"></i><span><?php echo blade_grve_likes( $post_id ); ?></span></div>
<?php
	}

}


/**
 * Check Portfolio details if used
 */

function blade_grve_check_portfolio_details() {
	global $post;
	$post_id = $post->ID;

	$grve_portfolio_details = blade_grve_post_meta( 'grve_details', '' );
	$portfolio_fields = get_the_terms( $post_id, 'portfolio_field' );
	if ( !empty( $grve_portfolio_details ) || ! empty( $portfolio_fields ) ) {
		return true;
	}
	return false;

}

/**
 * Prints Portfolio details
 */
if ( !function_exists('blade_grve_print_portfolio_details') ) {
	function blade_grve_print_portfolio_details() {
		global $post;
		$post_id = $post->ID;

		$grve_portfolio_details_title = blade_grve_post_meta( 'grve_details_title', blade_grve_option( 'portfolio_details_text' ) );
		$grve_portfolio_details = blade_grve_post_meta( 'grve_details', '' );
		$portfolio_fields = get_the_terms( $post_id, 'portfolio_field' );

	?>

		<!-- Portfolio Info -->
		<div class="grve-portfolio-info grve-border">
			<?php
			if ( !empty( $grve_portfolio_details ) ) {
			?>
			<!-- Portfolio Description -->
			<div class="grve-portfolio-description grve-border">
				<div class="grve-widget-title"><?php echo wp_kses_post( $grve_portfolio_details_title ); ?></div>
				<p><?php echo do_shortcode( wp_kses_post( $grve_portfolio_details ) ) ?></p>
			</div>
			<!-- End Portfolio Description -->
			<?php
			}
			?>
			<?php
			if ( ! empty( $portfolio_fields ) ) {
			?>
			<!-- Fields -->
			<ul class="grve-portfolio-fields grve-border">
				<?php
					foreach( $portfolio_fields as $field ) {
						echo '<li class="grve-fields-title grve-small-text"><i class="fa fa-caret-right"></i>' . esc_html( $field->name ) . '</li>';
					}
				?>
			</ul>
			<!-- End Fields -->
			<?php
			}
			?>
		</div>
		<!-- End Portfolio Info -->
	<?php

	}
}

/**
 * Prints Portfolio Recents items. ( Used in Single Portfolio )
 */
function blade_grve_print_recent_portfolio_items() {

	$exclude_ids = array( get_the_ID() );
	$args = array(
		'post_type' => 'portfolio',
		'post_status'=>'publish',
		'post__not_in' => $exclude_ids ,
		'posts_per_page' => 3,
		'paged' => 1,
	);


	$query = new WP_Query( $args );

	if ( $query->have_posts() ) {
?>
	<!-- RELATED -->
	<div id="grve-related-post" class="grve-singular-section grve-fullwidth clearfix">
		<div class="grve-container grve-padding-top-md grve-border grve-border-top">
			<div class="grve-subtitle"><?php esc_html_e( 'YOU MIGHT ALSO LIKE', 'blade' ); ?></div>
			<h2 class="grve-related-title grve-h4"><?php esc_html_e( 'ONE OF THE FOLLOWING', 'blade' ); ?></h2>
			<div class="grve-related-post-wrapper">
<?php
				if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
					get_template_part( 'templates/portfolio', 'recent' );
				endwhile;
				else :
				endif;
?>
			</div>
		</div>
	</div>
<?php
		wp_reset_postdata();
	}
}

/**
 * Prints Portfolio Feature Image
 */
function blade_grve_print_portfolio_image( $image_size = 'blade-grve-small-square', $mode = '' ) {

	if ( has_post_thumbnail() ) {
		$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
		$attachment_src = wp_get_attachment_image_src( $post_thumbnail_id, $image_size );
		$image_src = $attachment_src[0];
		if ( 'link' == $mode ){
			echo esc_url( $image_src );
		} else {
			if ( 'color' == $mode ){
				$image_src = get_template_directory_uri() . '/images/transparent/' . $image_size . '.png';
			}
?>
		<img src="<?php echo esc_url( $image_src ); ?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" width="<?php echo esc_attr( $attachment_src[1] ); ?>" height="<?php echo esc_attr( $attachment_src[2] ); ?>"/>
<?php
		}
	} else {
		$image_src = get_template_directory_uri() . '/images/empty/' . $image_size . '.jpg';
		if ( 'link' == $mode ){
			echo esc_url( $image_src );
		} else {
			if ( 'color' == $mode ){
				$image_src = get_template_directory_uri() . '/images/transparent/' . $image_size . '.png';
			}
?>
		<img src="<?php echo esc_url( $image_src ); ?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>"/>
<?php
		}
	}

}

/**
 * Prints social icons ( Portfolio )
 */
if ( !function_exists('blade_grve_print_portfolio_social') ) {
	function blade_grve_print_portfolio_social() {

		$portfolio_socials = blade_grve_option( 'portfolio_social');
		if ( is_array( $portfolio_socials ) ) {
			$portfolio_socials = array_filter( $portfolio_socials );
		} else {
			$portfolio_socials = '';
		}

		if ( !empty( $portfolio_socials ) ) {
			global $post;
			$post_id = $post->ID;

			$grve_permalink = get_permalink( $post_id );
			$grve_title = get_the_title( $post_id );
			$portfolio_email = blade_grve_option( 'portfolio_social', '', 'email' );
			$portfolio_facebook = blade_grve_option( 'portfolio_social', '', 'facebook' );
			$portfolio_twitter = blade_grve_option( 'portfolio_social', '', 'twitter' );
			$portfolio_linkedin = blade_grve_option( 'portfolio_social', '', 'linkedin' );
			$portfolio_pinterest= blade_grve_option( 'portfolio_social', '', 'pinterest' );
			$portfolio_googleplus= blade_grve_option( 'portfolio_social', '', 'google-plus' );
			$portfolio_reddit = blade_grve_option( 'portfolio_social', '', 'reddit' );
			$portfolio_likes = blade_grve_option( 'portfolio_social', '', 'grve-likes' );

			$portfolio_email_string = 'mailto:?subject=' . $grve_title . '&body=' . $grve_title . ': ' . $grve_permalink;

?>
			<!-- SOCIALS -->
			<ul class="grve-bar-socials">
				<?php if ( !empty( $portfolio_email  ) ) { ?>
				<li><a href="<?php echo esc_url( $portfolio_email_string ); ?>" title="<?php echo esc_attr( $grve_title ); ?>" class="grve-social-share-email"><?php echo esc_html__( 'E-mail', 'blade' ); ?></a></li>
				<?php } ?>
				<?php if ( !empty( $portfolio_facebook  ) ) { ?>
				<li><a href="<?php echo esc_url( $grve_permalink ); ?>" title="<?php echo esc_attr( $grve_title ); ?>" class="grve-social-share-facebook">Facebook</a></li>
				<?php } ?>
				<?php if ( !empty( $portfolio_twitter  ) ) { ?>
				<li><a href="<?php echo esc_url( $grve_permalink ); ?>" title="<?php echo esc_attr( $grve_title ); ?>" class="grve-social-share-twitter">Twitter</a></li>
				<?php } ?>
				<?php if ( !empty( $portfolio_linkedin  ) ) { ?>
				<li><a href="<?php echo esc_url( $grve_permalink ); ?>" title="<?php echo esc_attr( $grve_title ); ?>" class="grve-social-share-linkedin">Linkedin</a></li>
				<?php } ?>
				<?php if ( !empty( $portfolio_googleplus  ) ) { ?>
				<li><a href="<?php echo esc_url( $grve_permalink ); ?>" title="<?php echo esc_attr( $grve_title ); ?>" class="grve-social-share-googleplus">Google +</a></li>
				<?php } ?>
				<?php if ( !empty( $portfolio_pinterest  ) ) { ?>
				<li><a href="<?php echo esc_url( $grve_permalink ); ?>" title="<?php echo esc_attr( $grve_title ); ?>" data-pin-img="<?php blade_grve_print_portfolio_image( 'blade-grve-small-square', 'link' ); ?>" class="grve-social-share-pinterest">Pinterest</a></li>
				<?php } ?>
				<?php if ( !empty( $portfolio_reddit ) ) { ?>
				<li><a href="<?php echo esc_url( $grve_permalink ); ?>" title="<?php echo esc_attr( $grve_title ); ?>" class="grve-social-share-reddit">reddit</a></li>
				<?php } ?>
				<?php if ( !empty( $portfolio_likes  ) ) { ?>
				<li><a href="#" class="grve-like-counter-link <?php echo blade_grve_likes( $post_id, 'status' ); ?>" data-post-id="<?php echo esc_attr( $post_id ); ?>"><i class="fa fa-heart-o"></i><span class="grve-like-counter"><?php echo blade_grve_likes( $post_id ); ?></span></a></li>
				<?php } ?>
			</ul>
			<!-- END SOCIALS -->
<?php
		}
	}
}


/**
 * Prints Navigation Bar ( Post )
 */
if ( !function_exists('blade_grve_print_portfolio_bar') ) {
	function blade_grve_print_portfolio_bar() {

		$portfolio_socials = blade_grve_option( 'portfolio_social');
		if ( is_array( $portfolio_socials ) ) {
			$portfolio_socials = array_filter( $portfolio_socials );
		} else {
			$portfolio_socials = '';
		}

		$grve_nav_term = blade_grve_option( 'portfolio_nav_term', 'none' );

		if( 'none' != $grve_nav_term ) {
			$grve_in_same_term = true;
		} else {
			$grve_in_same_term = false;
			$grve_nav_term = 'portfolio_category';
		}
		$prev_post = get_adjacent_post( $grve_in_same_term, '', true, $grve_nav_term );
		$next_post = get_adjacent_post( $grve_in_same_term, '', false, $grve_nav_term );
		$grve_backlink = blade_grve_post_meta( 'grve_backlink_id', blade_grve_option( 'portfolio_backlink_id' ) );

		if ( ( blade_grve_visibility( 'portfolio_nav_visibility', '1' )  && ( is_a( $prev_post, 'WP_Post' ) || is_a( $next_post, 'WP_Post' ) ) ) || !empty( $portfolio_socials ) ) {

?>
			<!-- POST BAR -->
			<div id="grve-portfolio-bar" class="grve-navigation-bar grve-singular-section grve-fullwidth clearfix">
				<div class="grve-container">
					<div class="grve-wrapper">

						<div class="grve-post-bar-item">
							<?php if ( blade_grve_visibility( 'portfolio_nav_visibility', '1' ) && is_a( $prev_post, 'WP_Post' ) ) { ?>

							<a class="grve-nav-item grve-prev" href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>">
								<div class="grve-arrow grve-icon-arrow-left-alt"></div>
								<div class="grve-nav-content">
									<div class="grve-nav-title grve-small-text"><?php esc_html_e( 'Read Previous', 'blade' ); ?></div>
									<h6 class="grve-title"><?php echo get_the_title( $prev_post->ID ); ?></h6>
								</div>
							</a>

							<?php } ?>
						</div>

						<div class="grve-post-bar-item grve-post-socials grve-list-divider grve-link-text grve-align-center">
							<?php
							if ( blade_grve_visibility( 'portfolio_nav_visibility', '1' ) && !empty( $grve_backlink ) ) {
								$portfolio_backlink_url = get_permalink( $grve_backlink );
							?>
								<a href="<?php echo esc_url( $portfolio_backlink_url ); ?>" class="grve-backlink"><i class="grve-icon-backlink"></i></a>
							<?php
							}
							?>
							<?php blade_grve_print_portfolio_social(); ?>
						</div>

						<div class="grve-post-bar-item">
							<?php if ( blade_grve_visibility( 'portfolio_nav_visibility', '1' ) && is_a( $next_post, 'WP_Post' ) ) { ?>

							<a class="grve-nav-item grve-next" href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>">
								<div class="grve-nav-content">
									<div class="grve-nav-title grve-small-text"><?php esc_html_e( 'Read Next', 'blade' ); ?></div>
									<h6 class="grve-title"><?php echo get_the_title( $next_post->ID ); ?></h6>
								</div>
								<div class="grve-arrow grve-icon-arrow-right-alt"></div>
							</a>

							<?php } ?>
						</div>

					</div>
				</div>
			</div>
			<!-- END POST BAR -->
<?php
		}
	}
}

//Omit closing PHP tag to avoid accidental whitespace output errors.

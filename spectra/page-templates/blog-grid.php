<?php
/**
 * Template Name: Blog Grid
 *
 * @package spectra
 * @since 1.0.0
 */

get_header(); ?>

<?php 
   	global $spectra_opts, $wp_query, $post, $spectra_layout, $more;

	// Copy query
	$temp_post = $post;
	$query_temp = $wp_query;

	$more = 0;

	$posts_limit = 6;
	$width = 400;
   	$height = 224;

   	// Date format
    $date_format = 'd/m/Y';
    if ( $spectra_opts->get_option( 'custom_date' ) ) {
        $date_format = $spectra_opts->get_option( 'custom_date' );
    }

   	// Disqus
	$disqus = $spectra_opts->get_option( 'disqus_comments' );
	$disqus_shortname = $spectra_opts->get_option( 'disqus_shortname' );

	if ( ( $disqus && $disqus == 'on' ) && ( $disqus_shortname && $disqus_shortname != '' ) ) {
		$disqus = true;

	} else {
		$disqus = false;
	}

	// Cats
	$blog_cats = get_post_meta( $wp_query->post->ID, 'blog_cats_ids', true );

?>

<?php 
	// Get Custom Intro Section
	get_template_part( 'inc/custom-intro' );

?>

<!-- ############ BLOG GRID ############ -->
<div id="page">

	<!-- ############ Container ############ -->
	<div class="container clearfix">

		<?php
			if ( get_query_var( 'paged' ) ) {
				$paged = get_query_var('paged');
			} elseif ( get_query_var( 'page' ) ) {
				$paged = get_query_var( 'page' ); 
			} else {
				$paged = 1;
			}
			$args = array(
				'showposts'=> 9,
				'paged' => $paged
            );

            if ( $blog_cats != '' ) {
            	$args['cat'] = $blog_cats;
            }

			$wp_query = new WP_Query();
			$wp_query->query($args);

			if ( have_posts() ) : ?>
				<div class="blog-grid-items masonry">
				<?php while ( have_posts() ) : the_post(); ?>
						
					<!-- Article -->
					<?php 
						// Categories
						$category = get_the_category();
						$cat_tip = array();
						if ( count( $category ) > 1 ) {
							$cat = $category[0]->cat_name . '...';
							foreach ( $category as $c ) {
								$cat_tip[] = $c->cat_name;
							}
						} else {
							$cat = $category[0]->cat_name;
							$cat_tip[] = $category[0]->cat_name;
						}
						$cat_tip = implode( ', ', $cat_tip );

						// Media
						$media = '';
						switch ( get_post_format() ) {
							case 'audio':
								$post_format = get_post_meta( $wp_query->post->ID, '_post_format', true );
								if ( $post_format == 'pf_audio_sc' ) {
									$sc_iframe = get_post_meta( $wp_query->post->ID, '_sc_iframe', true );
									if ( $sc_iframe && $sc_iframe !== '' && strpos( $sc_iframe, 'iframe' ) !== false ) {
										$iframe_player = preg_replace('/height="\d+"/i', 'height="250"', $sc_iframe);
										$iframe_player = str_replace( '&', '&amp;', $iframe_player );
										$media .= $iframe_player;
									}
								} elseif ( $post_format == 'pf_audio' ) {

									$pf_tracks_id = get_post_meta( $wp_query->post->ID, '_pf_tracks_id', true );
									if ( function_exists( 'spectra_tracklist' ) ) {
										$media .= spectra_tracklist( $atts = array( 'id' => $pf_tracks_id, 'track_action' => 'sp-play-track', 'style' => 'compact' ) );
									}

								} elseif ( $post_format == 'pf_audio_single' ) {
									$pf_tracks_id = get_post_meta( $wp_query->post->ID, '_pf_tracks_id', true );
									if ( function_exists( 'spectra_tracklist' ) ) {
										$media .= spectra_track( $atts = array( 'id' => $pf_tracks_id, 'track_action' => 'sp-play-track', 'style' => 'compact' ) );
									}

								}

								break;

							case 'video':
								$video_yt_id = get_post_meta( $wp_query->post->ID, '_video_yt_id', true );
   								$video_vimeo_id = get_post_meta( $wp_query->post->ID, '_video_vimeo_id', true );
								if ( $video_yt_id && $video_yt_id !== '' ) {
									$media .= '<div class="video"><iframe src="https://www.youtube.com/embed/' . $video_yt_id . '" width="' . $width . '" height="' . $height . '" allowfullscreen></iframe></div>';
								} else if ( $video_vimeo_id && $video_vimeo_id !== '' ) {
									$media .= '<div class="video"><iframe src="https://player.vimeo.com/video/' . $video_vimeo_id . '" width="' . $width . '" height="' . $height . '" allowfullscreen></iframe></div>';
								}

								break;

							case 'gallery':

								$gallery_slider_id = get_post_meta( $wp_query->post->ID, '_gallery_slider_id', true );

								if ( $gallery_slider_id && $gallery_slider_id !== 'none' ) {
									if ( function_exists( 'spectra_slider' ) ) {
										$media .= spectra_slider( array( 'id' => $gallery_slider_id ) );
									}
								}
								break;

							case 'image':
								if ( has_post_thumbnail() ) {
									$media .= '<img src=" '. $spectra_opts->img_resize( $width, $height, get_post_thumbnail_id(), $crop = 'c', $retina = false ) . '" alt="' . esc_attr( __( 'Post Image', SPECTRA_THEME ) ) . '">';

								}
								break;
							
							default:
							
								break;
						}


					?>
					<article <?php post_class( 'col-1-3 masonry-item' ); ?>>
						<div class="entry-grid-media">
							<?php $spectra_opts->e_esc( $media ) ?>
						</div>
						<div class="entry-grid-content">
							<?php the_title( '<h2 class="entry-grid-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
							<div class="entry-grid-meta">
								<span class="entry-grid-date"><?php the_time( $date_format )?></span><span class="entry-grid-cat"><abbr title="<em><?php echo esc_html( $cat_tip ) ?></em>" class="tooltip"><?php $spectra_opts->e_esc( $cat ) ?></abbr></span><?php if ( comments_open() || get_comments_number() ) : ?><span class="entry-grid-comments"><a href="<?php echo esc_url( get_permalink() ); ?>#comments" data-offset="-65"><?php 
								if ( $disqus ) { 
									_e( 'Comments', SPECTRA_THEME );
								} else {
									comments_number( __( 'No comment', SPECTRA_THEME ), '1 ' . __( 'Comment', SPECTRA_THEME ), '% ' . __( 'Comments', SPECTRA_THEME ) );
								}
								?></a></span>
								<?php endif; ?>
							</div>
							<?php if ( has_excerpt() ) : ?>
								<div class="entry-grid-excerpt">
									<?php the_excerpt(); ?>
								</div>
								<a href="<?php echo esc_url( get_permalink() ) ?>" class="btn small"><?php _e( 'Read more', SPECTRA_THEME ) ?></a>
							<?php else : ?>
								<?php the_content( __( 'Continue reading ', SPECTRA_THEME ) . '<span class="meta-nav">&rarr;</span>' ); ?>
							<?php endif; ?>
						</div>
					</article>
					<!-- /article -->

				<?php endwhile ?>
				</div>

			<?php else : ?>
				<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', SPECTRA_THEME ); ?></p>

			<?php endif; // have_posts() ?>
			<div class="clear"></div>
    		<?php spectra_paging_nav(); ?>
		<?php
		   // Get orginal query
		   $post = $temp_post;
		   $wp_query = $query_temp;
		?>
	</div>
    <!-- /container -->
</div>
<!-- /page -->
<?php get_footer(); ?>
<?php
/**
 * Theme Name: 		SPECTRA - Responsive Music Wordpress Theme
 * Theme Author: 	Mariusz Rek - Rascals Themes
 * Theme URI: 		http://rascals.eu/spectra
 * Author URI: 		http://rascals.eu
 * File:			content-video.php
 * =========================================================================================================================================
 *
 * @package spectra
 * @since 1.0.0
 */
?>

<?php 
   	global $spectra_opts, $wp_query, $post, $spectra_layout;
   	$video_yt_id = get_post_meta( $wp_query->post->ID, '_video_yt_id', true );
   	$video_vimeo_id = get_post_meta( $wp_query->post->ID, '_video_vimeo_id', true );

   	// Set width and height slider
   	if ( $spectra_layout == 'wide' ) {
   		$width = 990;
   		$height = 500;
   	} else {
   		$width = 680;
   		$height = 380;
   	}

   	// Disqus
	$disqus = $spectra_opts->get_option( 'disqus_comments' );
	$disqus_shortname = $spectra_opts->get_option( 'disqus_shortname' );

	if ( ( $disqus && $disqus == 'on' ) && ( $disqus_shortname && $disqus_shortname != '' ) ) {
		$disqus = true;

	} else {
		$disqus = false;
	}

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry">
		<header class="entry-header">
			<?php
				if ( is_single() ) :
					the_title( '<h1 class="entry-title anim-css" data-delay="0">', '</h1>' );
				else :
					the_title( '<h2 class="entry-title anim-css" data-delay="0"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				endif;
			?>

			<div class="entry-meta">
				<div class="meta-posted-by anim-css" data-delay="100"><?php _e( 'Posted by: ', SPECTRA_THEME ) ?> <?php the_author_posts_link(); ?></div>
				<div class="meta-categories anim-css" data-delay="200"><?php _e( 'Categories: ', SPECTRA_THEME ) ?> <?php the_category(' &bull; '); ?></div>
				<?php if ( is_single() ) : ?>
				<div class="meta-categories anim-css" data-delay="300"><?php _e( 'Tags: ', SPECTRA_THEME ) ?> <?php the_tags( '',' &bull; ','' ); ?></div>
				<?php endif; ?>
			</div><!-- .entry-meta -->
		</header><!-- .entry-header -->
		
		<div class="entry-side anim-css" data-delay="100">
			<div class="entry-date">
				<span class="day"><?php the_time( 'd' ); ?></span>
				<span class="month"><?php the_time( 'M' ); ?></span>
			</div>
			<?php if ( comments_open() || get_comments_number() ) : ?>
			<a href="<?php echo esc_url( get_permalink() ); ?>#comments" class="comments-link" data-offset="-65"><?php if ( ! $disqus ) { comments_number('0','1','%'); } ?><span class="icon icon-bubbles"></span></a>
			<?php endif; ?>
			<?php edit_post_link( __( 'Edit', SPECTRA_THEME ), '<span class="edit-link">', '</span>' ); ?>
		</div>

		<?php if ( $video_yt_id && $video_yt_id !== '' ) : ?>
		<div class="entry-media content-video anim-css" data-delay="100">
			<div class="video">
				<iframe src="https://www.youtube.com/embed/<?php echo esc_attr( $video_yt_id ) ?>" width="<?php echo esc_attr( $width ) ?>" height="<?php echo esc_attr( $height ) ?>" allowfullscreen></iframe>
			</div>
		</div>
		<?php endif; // video_yt_id ?>
		<?php if ( $video_vimeo_id && $video_vimeo_id !== '' ) : ?>
		<div class="entry-media content-video anim-css" data-delay="100">
			<div class="video">
				<iframe src="https://player.vimeo.com/video/<?php echo esc_attr( $video_vimeo_id ) ?>" width="<?php echo esc_attr( $width ) ?>" height="<?php echo esc_attr( $height ) ?>" allowfullscreen></iframe>
			</div>
		</div>
		<?php endif; // video_vimeo_id ?>

		<div class="entry-content anim-css" data-delay="0">
			<?php 
			 	if ( ! is_single() && has_excerpt() ) {
            		the_excerpt();
            		echo '<a href="' . esc_url( get_permalink() ) . '" class="more-link-excerpt">' . __( 'Continue reading ', SPECTRA_THEME ) . '<span class="meta-nav">&rarr;</span>' . '</a>';
           		} else {
              		the_content( __( 'Continue reading ', SPECTRA_THEME ) . '<span class="meta-nav">&rarr;</span>' );
           		}
           	?>
		</div><!-- .entry-content -->

	</div><!-- .entry -->
	<?php if ( is_single() ) : ?>
	<!-- ############ PAGE FOOTER ############ -->
    <footer class="page-footer anim-css" data-delay="0">
        <!-- ############ PAGE SOCIAL ############ -->
        <div class="social-wrap">
            <div class="page-social">
                <!-- Facebook -->
                <a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo esc_url( get_permalink( $post->ID ) ) ?>" class="facebook-share"><span class="icon icon-facebook"></span></a>
                <!-- Twitter -->
                <a target="_blank" href="http://twitter.com/share?url=<?php echo esc_url( get_permalink( $post->ID ) ) ?>" class="twitter-share"><span class="icon icon-twitter"></span></a>
                 <!-- G+ -->
                <a target="_blank" href="https://plus.google.com/share?url=<?php echo esc_url( get_permalink( $post->ID ) ) ?>" class="googleplus-share"><span class="icon icon-googleplus"></span></a>
            </div>
        </div>
        <!-- /page social -->
        <!-- POST NAVIGATION -->
        <?php echo spectra_post_nav(); ?>
    </footer>
    <!-- /page footer -->
	<?php endif; ?>

</article><!-- #post-## -->
<?php
/**
 * Theme Name: 		SPECTRA - Responsive Music Wordpress Theme
 * Theme Author: 	Mariusz Rek - Rascals Themes
 * Theme URI: 		http://rascals.eu/spectra
 * Author URI: 		http://rascals.eu
 * File:			single-spectra_gallery.php
 * =========================================================================================================================================
 *
 * @package spectra
 * @since 1.0.0
 */
?>
<?php get_header(); ?>


<?php 
   global $spectra_opts, $wp_query, $post;

   	// Copy query
    $temp_post = $post;
    $query_temp = $wp_query;

   	// Intro Title
   	$intro_title = get_post_meta( $wp_query->post->ID, '_intro_type', true );

	if ( $intro_title === 'intro_page_title' ) {
		$intro_title = true;
   	} else {
   		$intro_title = false;
   	}

   	 // Pagination Limit
    $limit = (int)get_post_meta( $wp_query->post->ID, '_limit', true );
    $limit = $limit && $limit == '' ? $limit = 6 : $limit = $limit;

   	/* Images per row */
   	$images_per_row = get_post_meta( $wp_query->post->ID, '_images_per_row', true );

   	/* Thumbnails sizes */
    if ( isset( $images_per_row ) && $images_per_row == '2' ) {
        $width = '545';
        $height = '545';
    } else {
        $width = '420';
        $height = '420';
    }

?>

<?php 
	// Get Custom Intro Section
	get_template_part( 'inc/custom-intro' );

?>

<!-- ############ PAGE ############ -->
<div id="page">

	<!-- ############ Container ############ -->
	<div class="container clearfix">
		
		<?php if ( ! $intro_title ) : ?>
		<!-- ############ CONTENT HEADER ############ -->
	    <header class="content-header">
	        <h1 class="content-title anim-css" data-delay="0"><?php the_title(); ?></h1>
	        <hr class="content-line anim-css" data-delay="200">
	    </header>
	    <!-- /content header -->
		<?php endif; ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php
			// Start the Loop.
			while ( have_posts() ) : the_post();

				/* Share permalink */
				$share_link = get_permalink( $post->ID );

				/* Album ID */
				$album_id = get_the_id();

				/* Images ids */
		        $images_ids = get_post_meta( $wp_query->post->ID, '_gallery_ids', true ); 

				the_content();

		        ?>

			<?php endwhile; ?>

			<?php wp_reset_query(); ?>

			<?php
			if ( $images_ids || $images_ids !== '' ) :
			$ids = explode( '|', $images_ids );
			$paged = ( get_query_var( 'paged') ) ? get_query_var( 'paged' ) : 1; 
           	$gallery_loop_args = array(
                'post_type' => 'attachment',
				'post_mime_type' => 'image',
				'post__in' => $ids,
				'orderby' => 'post__in',
				'post_status' => 'any',
                'showposts' => $limit,
                'paged' => $paged
			);
			$wp_query = new WP_Query();
			$wp_query->query( $gallery_loop_args );
			?>
	
				<?php if ( have_posts() ) : ?>

				<div id="gallery-images">

				<?php while ( have_posts() ) : the_post(); ?>
					
				<?php 
					$image_att = wp_get_attachment_image_src( get_the_id(), 'full' );
					if ( ! $image_att[0] ) { 
						continue;
					}

					$defaults = array(
						'title' => '',
						'crop'  => 'c'
			         );

					/* Get image meta */
					$image = get_post_meta( $album_id, '_gallery_ids_' . get_the_id(), true );

					/* Add default values */
					if ( isset( $image ) && is_array( $image ) ) {
						$image = array_merge( $defaults, $image );
					} else {
						$image = $defaults;
					}

					/* Add image src to array */
					$image['src'] = $image_att[0];

					?>

					<div class="flex-col-1-<?php echo esc_attr( $images_per_row ) ?>">
						<a href="<?php echo $image['src']; ?>" class="thumb" title="<?php echo $image['title']; ?>" data-group="gallery">
							<img src="<?php echo esc_url( $spectra_opts->img_resize( $width, $height, $image['src'], $image['crop'], $retina = false ) ) ?>" alt="<?php echo esc_attr( __( 'Gallery thumbnail', SPECTRA_THEME ) ); ?>" title="<?php echo $image['title']; ?>">
						</a>
					</div>

				<?php endwhile; // End Loop ?>

				</div>
			<div class="clear"></div>

			<?php spectra_paging_nav(); ?>
			<?php endif; ?>
		
			<?php else : ?>
			<?php echo '<p class="message error">' . __( 'Gallery error: Album has no pictures.', SPECTRA_THEME ) . '</p>'; ?>
	        <?php endif; // images ids ?>
			
			<?php
			   // Get orginal query
			   $post = $temp_post;
			   $wp_query = $query_temp;
			?>

			<!-- ############ PAGE FOOTER ############ -->
		    <footer class="page-footer anim-css" data-delay="0">
		        <!-- ############ PAGE SOCIAL ############ -->
		        <div class="social-wrap">
		            <div class="page-social">
		                <!-- Facebook -->
		                <a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo esc_url( $share_link ) ?>" class="facebook-share"><span class="icon icon-facebook"></span></a>
		                <!-- Twitter -->
		                <a target="_blank" href="http://twitter.com/share?url=<?php echo esc_url( $share_link ) ?>" class="twitter-share"><span class="icon icon-twitter"></span></a>
		                 <!-- G+ -->
		                <a target="_blank" href="https://plus.google.com/share?url=<?php echo esc_url( $share_link ) ?>" class="googleplus-share"><span class="icon icon-googleplus"></span></a>
		            </div>
		        </div>
		        <!-- /page social -->
		        <!-- POST NAVIGATION -->
		        <?php echo spectra_post_nav(); ?>
		    </footer>
		    <!-- /page footer -->

		</article>
		<!-- /article -->
	</div>
    <!-- /container -->
</div>
<!-- /page -->

<!-- Comments -->
<?php
// If comments are open or we have at least one comment, load up the comment template.
if ( comments_open() || get_comments_number() ) {
	$disqus = $spectra_opts->get_option( 'disqus_comments' );
	$disqus_shortname = $spectra_opts->get_option( 'disqus_shortname' );

	if ( ( $disqus && $disqus == 'on' ) && ( $disqus_shortname && $disqus_shortname != '' ) ) {
		get_template_part( 'inc/disqus' );

	} else {
		comments_template();
	}
}
?>
<!-- /comments -->

<?php get_footer(); ?>
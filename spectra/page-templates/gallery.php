<?php
/**
 * Template Name: Gallery
 *
 * @package spectra
 * @since 1.0.0
 */

get_header(); ?>

<?php 
	// Get Custom Intro Section
	get_template_part( 'inc/custom-intro' );

?>

<!-- ############ GALLERY ############ -->
<div id="page">
	
    <?php 
    global $spectra_opts, $wp_query, $post;

    // Copy query
    $temp_post = $post;
    $query_temp = $wp_query;

    // Pagination Limit
    $limit = (int)get_post_meta( $wp_query->post->ID, '_limit', true );
    $limit = $limit && $limit == '' ? $limit = 6 : $limit = $limit;

    // Gallery layout
    $gallery_layout = get_post_meta( $wp_query->post->ID, '_gallery_layout', true );

    // Date format
    $date_format = 'd/m/y';
    if ( $spectra_opts->get_option( 'custom_date' ) ) {
        $date_format = $spectra_opts->get_option( 'custom_date' );
    }

    /* Thumbnails sizes */
    if ($gallery_layout == '2') {
        $width = '545';
        $height = '545';
    } else {
        $width = '420';
        $height = '420';
    }

    ?>
    
    <!-- ############ Container ############ -->
    <div class="container clearfix">

    	<!--############ Gallery grid ############ -->
    	<div id="gallery-albums" class="items masonry clearfix">
    		
    		<?php
                $paged = ( get_query_var( 'paged') ) ? get_query_var( 'paged' ) : 1; 

    			// Begin Loop
    			$args = array(
                    'post_type' => 'spectra_gallery',
                    'showposts' => $limit,
                    'paged'     => $paged
    			);
    			$wp_query = new WP_Query();
    			$wp_query->query( $args );
            ?>
    	
    	 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
              
    		<?php if ( has_post_thumbnail() ) : ?>
    		<!-- item -->
            <article <?php post_class( "flex-col-1-$gallery_layout masonry-item" ); ?>>
    			<a href="<?php echo esc_url( get_permalink() ) ?>" class="thumb thumb-desc">
    				<div><div><?php the_title(); ?><span class="gallery-date"><?php the_time( $date_format )?></span></div></div>
    				<!-- image -->
                    <?php $album_url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ); ?>
                    <img src="<?php echo esc_url( $spectra_opts->img_resize( $width, $height, $album_url, 'c', $retina = false ) ) ?>" alt="<?php echo esc_attr( __( 'Gallery thumbnail', SPECTRA_THEME ) ); ?>">
    			</a>
    		</article>
    		<!-- /item -->
    		<?php endif; // End has thumbnail ?>
    		<?php endwhile; // End Loop ?>
    	</div>
        <div class="clear"></div>
        <?php spectra_paging_nav(); ?>
        <?php endif; ?>
    </div>
    <!-- /container -->
</div>
<!-- /page -->
<?php
   // Get orginal query
   $post = $temp_post;
   $wp_query = $query_temp;
?>
<?php get_footer(); ?>
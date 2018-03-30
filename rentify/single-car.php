<?php 
	get_header(); 
	$rentify_option_data = rentify_option_data();
?>


<div class="blog-content pt60">
    <div class="container">
      	<div class="row">
            <?php if (have_posts()) :while ( have_posts() ) : the_post(); ?>
                <article <?php post_class( 'uou-block-7f blog-post-content'); ?> id="post-<?php the_ID(); ?>" >
                    <?php 
						if ( has_post_thumbnail() ) {
						$image_id =  get_post_thumbnail_id( get_the_ID() );
						$large_image = wp_get_attachment_url( $image_id ,'full');  
						$resize = sb_aq_resize( $large_image, true );
						?>
						<img src="<?php echo esc_url($resize); ?>" alt="">
                    <?php } ?>                  

                  	<div class = "content-show"> <?php the_content(); ?> </div>
                  
				</article>
    		<?php endwhile; else : ?>
        		<?php esc_html_e('No Car have found!', 'rentify'); ?> 
    		<?php endif; ?>           	

        </div>
    </div> <!--  end blog-single -->
</div> <!-- end container -->

<?php get_footer(); ?>
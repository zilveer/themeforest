<?php
    sf_set_sidebar_global( 'no-sidebars' );
?>

<?php if ( have_posts() ) : the_post(); ?>

    <!-- OPEN article -->
    <article <?php post_class( 'container clearfix' ); ?> id="<?php the_ID(); ?>">
		
		<?php
		    /**
		     * @hooked - sf_post_detail_heading - 10
		     * @hooked - sf_post_detail_media - 20
		     **/
		    do_action( 'sf_download_article_start' );
		?>
		
        <section class="page-content download-main clearfix">
        	
        	<?php
        	    /**
        	     * @hooked - sf_download_detail_media - 10 (standard)
        	     **/
        	    do_action( 'sf_download_content_start' );
        	?>
        	
			<?php the_content(); ?>
			
			<?php
			    /**
			     * @hooked - sf_post_review - 20
			     * @hooked - sf_post_share - 30
			     * @hooked - sf_post_details - 40
			     **/
			    do_action( 'sf_download_content_end' );
			?>
			
        </section>
        
		<aside class="download-sidebar">
			<?php
			    /**
			     * @hooked - sf_download_sidebar_details - 10
			     * @hooked - sf_download_sidebar_cart - 20
			     **/
			    do_action( 'sf_download_sidebar' );
			?>
		</aside>
			
		<?php
		    /**
		     * @hooked - sf_post_detail_heading - 10
		     * @hooked - sf_post_detail_media - 20
		     **/
		    do_action( 'sf_download_article_end' );
		?>
		
    <!-- CLOSE article -->
    </article>
	
<?php endif; ?>
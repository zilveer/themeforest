<?php get_header(); ?>
	<div class="wmffcontainer">
    	<div class="post-padding"></div>
        <div class="wmffrow">
        	<div class="col-12 wmffcol-xs-12 wmffcol-sm-12 wmffcol-md-12 wmffcol-lg-12">
                <!-- section -->
                <section role="main">
                
                    <!-- article -->
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    
                        <h3><?php _e( 'Page not found', 'aurat2d' ); ?></h3>
                        <h4>
                            <a href="<?php echo home_url(); ?>"><?php _e( 'Return home?', 'aurat2d' ); ?></a>
                        </h4>
                        
                    </article>
                    <!-- /article -->
                    
                </section>
                <!-- /section -->
		</div>
	</div>
</div>

<?php get_footer(); ?>
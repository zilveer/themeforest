<?php get_header(); ?>
			
			<!-- BEGIN #primary .hfeed-->
			<div id="primary" class="hfeed clearfix isotope-container">			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
				<?php zilla_post_before(); ?>
				<!-- BEGIN .hentry -->
				<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">				
				<?php zilla_post_start(); ?>
				
				<?php
				    $format = get_post_format();
				    				    
				    get_template_part( 'content', $format);
				    
				    if( $format == '' || $format == 'gallery' || $format == 'video' || $format == 'audio' ) {
				        get_template_part( 'content', 'meta' ); 
    			    }
				?>
					                
                <?php zilla_post_end(); ?>
				<!-- END .hentry-->  
				</div>
				<?php zilla_post_after(); ?>

				<?php endwhile; ?>

                <?php 
    			$pagination = zilla_get_option('post_pagination_type');
    			// force pagination in Opera
    			global $is_opera;
    			if( $pagination == 'loadmore' && !$is_opera ) { 
    			    if( $wp_query->max_num_pages > 1 ) { ?>
    			        <a href="#" id="load-more" data-width="260"><?php _e('Load More', 'zilla'); ?></a>
    			    <?php }
    			} else { ?>
    			    <!-- BEGIN .navigation .page-navigation -->
            		<div class="navigation page-navigation">
        			    <div class="nav-next">
        				    <?php next_posts_link(__('Older Entries', 'framework')); ?>
        				</div>
        				<div class="nav-previous">
        				    <?php previous_posts_link(__('Newer Entries', 'framework')) ?>
        				</div>
    				<!-- END .navigation .page-navigation -->
            		</div>
    			<?php } ?>

			<?php else : ?>

				<!-- BEGIN #post-0-->
				<div id="post-0" <?php post_class(); ?>>
				
					<h2 class="entry-title"><?php _e('Error 404 - Not Found', 'zilla') ?></h2>
				
					<!-- BEGIN .entry-content-->
					<div class="entry-content">
						<p><?php _e("Sorry, but you are looking for something that isn't here.", "zilla") ?></p>
					<!-- END .entry-content-->
					</div>
				
				<!-- END #post-0-->
				</div>

			<?php endif; ?>
			<!-- END #primary .hfeed .isotope-container -->
			</div>
		
<?php get_footer(); ?>
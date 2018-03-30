<?php get_header(); ?>

			<!-- BEGIN #primary .hfeed-->
			<div id="primary" class="hfeed">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
				<?php zilla_post_before(); ?>
				<!-- BEGIN .hentry -->
				<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
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

				<?php 
				    zilla_comments_before();
				    comments_template('', true); 
				    zilla_comments_after();
				?>
				
				<!-- BEGIN .navigation .single-page-navigation -->
				<div class="navigation single-page-navigation">
					<div class="nav-previous"><?php previous_post_link('&larr; %link') ?></div>
					<div class="nav-next"><?php next_post_link('%link &rarr;') ?></div>
				<!-- END .navigation .single-page-navigation -->
				</div>

				<?php endwhile; else: ?>

				<!-- BEGIN #post-0-->
				<div id="post-0" <?php post_class() ?>>
				
					<h1 class="entry-title"><?php _e('Error 404 - Not Found', 'zilla') ?></h1>
				
					<!-- BEGIN .entry-content-->
					<div class="entry-content">
						<p><?php _e("Sorry, but you are looking for something that isn't here.", "zilla") ?></p>
					<!-- END .entry-content-->
					</div>
				
				<!-- END #post-0-->
				</div>

			<?php endif; ?>
			<!-- END #primary .hfeed-->
			</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
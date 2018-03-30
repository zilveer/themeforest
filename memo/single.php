<?php get_header(); ?>

			<!--BEGIN #primary .hfeed-->
			<div id="primary" class="hfeed">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
			<!--BEGIN .hentry -->
			<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">				
				
				<?php
				    // Determine post format and get appropriate file
				    $format = get_post_format();
				    if( $format == '' ) {
				        get_template_part( 'includes/standard' );
				    } else {
				        get_template_part( 'includes/' . $format );
				    }
				?>
            
			<!--END .hentry-->  
			</div>

				<?php comments_template('', true); ?>
				
				<?php endwhile; ?>
				
				<!--BEGIN .navigation .single-page-navigation -->
    			<div class="navigation single-page-navigation">
    				<div class="nav-next"><?php next_post_link(__('&larr; %link', 'framework')) ?></div>
    				<?php if( get_next_post() && get_previous_post() ) { echo "<span>|</span>"; } ?>
    				<div class="nav-previous"><?php previous_post_link(__('%link &rarr;', 'framework')) ?></div>
    			<!--END .navigation .single-page-navigation -->
    			</div>
				
				<?php else: ?>

				<!--BEGIN #post-0-->
				<div id="post-0" <?php post_class() ?>>
				
					<h1 class="entry-title"><?php _e('Error 404 - Not Found', 'framework') ?></h1>
				
					<!--BEGIN .entry-content-->
					<div class="entry-content">
						<p><?php _e("Sorry, but you are looking for something that isn't here.", "framework") ?></p>
					<!--END .entry-content-->
					</div>
				
				<!--END #post-0-->
				</div>

			<?php endif; ?>
			<!--END #primary .hfeed-->
			</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
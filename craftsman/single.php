<?php get_header(); ?>

		<div id="container" class="row-inner">
			<?php if( ot_get_option('post_layout') == 'full-width' ) : ?>
				<div id="content">
				
					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'content', get_post_format() ); ?>

						<?php if ( get_the_author_meta( 'description' ) && ot_get_option('author_description') != 'off' ) : ?>
							<div class="author-area clearfix">
								<?php echo get_avatar( get_the_author_meta( 'ID' ), 72 ); ?>
								<div class="author-name">
									<?php echo get_the_author(); ?>
								</div>	
								<div class="author-info">
									<?php the_author_meta( 'description' ); ?>
								</div>
							</div>
						<?php endif; ?>			

						<?php
						if ( comments_open() || get_comments_number() ) {
							comments_template();
						} ?>
						
					<?php endwhile; ?>
						
				</div><!-- #content -->
		
			<?php else : ?>
			
				<div id="content" class="<?php if( ot_get_option('post_layout') == 'right-sidebar' ) { echo 'float-left'; } else { echo 'float-right'; } ?>">
				
					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'content', get_post_format() ); ?>

						<?php if ( get_the_author_meta( 'description' ) && ot_get_option('author_description') != 'off' ) : ?>
							<div class="author-area clearfix">
								<?php echo get_avatar( get_the_author_meta( 'ID' ), 72 ); ?>
								<div class="author-name">
									<?php echo get_the_author(); ?>
								</div>	
								<div class="author-info">
									<?php the_author_meta( 'description' ); ?>
								</div>
							</div>
						<?php endif; ?>			

						<?php
						if ( comments_open() || get_comments_number() ) {
							comments_template();
						} ?>
						
					<?php endwhile; ?>
						
				</div><!-- #content -->
				
				<div id="sidebar" class="<?php if( ot_get_option('post_layout') == 'right-sidebar' ) { echo 'float-right'; } else { echo 'float-left'; } ?>">
					<?php get_sidebar('blog'); ?>
				</div>			
			<?php endif; ?>
		</div><!-- #container -->

<?php get_footer(); ?>
<?php
/**
 * The template for displaying a "No posts found" message
 *
 * @package Evential
 * @subpackage Evential
 * @since Evential 1.0
 */
?>
			<div class="row">
				<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
				<div class="col-lg-8 col-lg-offset-2 text-center">
					<h1 class="contant_404_header_title"><?php _e( 'Not Found', 'evential' ); ?></h1>
					<h3><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'lecorpo' ); ?></h3>
					<br/>
					<?php get_search_form(); ?>
					<h3>OR</h3>
					<p>Get bact to <a href="<?php echo get_home_url(); ?>" title="home">Home</a></p>
				</div>
				<?php elseif ( is_search() ) : ?>
				<div class="col-lg-8 col-lg-offset-2 text-center">
					<h1 class="contant_404_header_title"><?php _e( 'Not Found', 'evential' ); ?></h1>
					<h3><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'lecorpo' ); ?></h3>
					<br/>
					<?php get_search_form(); ?>
					<h3>OR</h3>
					<p>Get bact to <a href="<?php echo get_home_url(); ?>" title="home">Home</a></p>
				</div>
				<?php else : ?>
				<div class="col-lg-8 col-lg-offset-2 text-center">
					<h1 class="contant_404_header_title"><?php _e( 'Not Found', 'evential' ); ?></h1>
					<h3><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'lecorpo' ); ?></h3>
					<br/>
					<?php get_search_form(); ?>
					<h3>OR</h3>
					<p>Get bact to <a href="<?php echo get_home_url(); ?>" title="home">Home</a></p>
				</div>
				<?php endif; ?>
			</div><!-- #content -->
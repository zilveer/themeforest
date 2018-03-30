<?php
/**
 * Password required template
 *
 * @package WordPress
 * @subpackage Geode
 * @since Geode 1.0
 */

get_header(); ?>

	<?php get_template_part( 'title', '' ); ?>

	<?php $archive_list = is_home() ? 'archive-list' : ''; ?>

 	<div id="primary" class="site-content <?php echo $archive_list; ?>">
		<div id="content" role="main">

			<article <?php post_class($classes[]='password-required'); ?>>

					<div class="row">
						<div class="row-inside">

							<div class="entry-content-password">
									<div class="row">
										<div class="row-inside">
											<div class="enter-password">

												<?php echo get_the_password_form(); ?>

											</div><!-- .enter-password -->

										</div><!-- .row-inside -->
									</div><!-- .row -->

							</div><!-- .entry-content-password -->

					</div><!-- .row-inside -->
				</div><!-- .row -->

			</article><!-- #post-## -->
						
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>
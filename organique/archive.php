<?php
/**
 * Archive pages - the same as index.php, but with the excerpt instead of content
 *
 * @package Organique
 */

get_header();

$page_id = absint( get_option( 'page_for_posts' ) );

if( 0 === $page_id ) {
	$sidebar = 'right';
} else {
	$sidebar = get_post_meta( $page_id, 'sidebar_position', true );
}

?>

	<div class="container  push-down-30">
		<?php get_template_part( 'titlearea' ); ?>
		<div class="row">
			<div class="col-xs-12<?php echo 'no' !== $sidebar ? '  col-sm-8' : ''; echo 'left' === $sidebar ? '  col-sm-push-4' : ''; ?>" role="main">

				<?php get_template_part( 'loop', 'excerpt' ); ?>

				<nav class="center">
					<div class="pagination">
						<div class="row">
							<?php organique_pagination(); ?>
						</div>
					</div>
				</nav>

			</div><!-- /blog -->
			<?php if ( 'no' !== $sidebar ) : ?>
			<div class="col-xs-12  col-sm-4<?php echo 'left' === $sidebar ? '  col-sm-pull-8' : ''; ?>">
				<aside class="sidebar  sidebar--blog" role="complementary">
					<?php dynamic_sidebar( 'blog-sidebar' ); ?>
				</aside>
			</div>
			<?php endif ?>
		</div><!-- /row -->
	</div><!-- /container -->
<?php get_footer(); ?>
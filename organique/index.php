<?php
/**
 * Main blog page
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

<div class="container  push-down-60">
	<?php get_template_part( 'titlearea' ); ?>
	<div class="row">
		<div class="col-xs-12<?php echo 'no' !== $sidebar ? '  col-sm-8' : ''; echo 'left' === $sidebar ? '  col-sm-push-4' : ''; ?>" role="main">

			<?php
				if( have_posts() ) :
					while( have_posts() ) :
						the_post();
			?>

			<article <?php echo post_class( 'no' === $sidebar ? 'blog--centered' : '' ); ?>>

				<!-- Thumbnail -->
				<?php if( has_post_thumbnail() ) : ?>
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail( 'post-thumbnail', array( 'class' => 'product__image' ) ); ?>
					</a>
				<?php endif; ?>

				<?php if ( 'no' === $sidebar ) : ?>
					<div class="row">
						<div class="col-xs-12  col-sm-8  col-sm-offset-2">
				<?php endif ?>

				<?php get_template_part( 'entry', 'title' ); ?>

				<div class="blog-content__text">
					<?php the_content( sprintf( '<span class="btn  btn-primary">%s</span>', __('Read more' , 'organique_wp' ) ) ); ?>

					<?php if ( strlen( get_the_title() ) < 1 ) : ?>
						<a href="<?php the_permalink(); ?>"><?php _e( 'Link to this post', 'organique_wp' ); ?></a>
					<?php endif; ?>
				</div>
				<hr class="divider">

				<?php if ( 'no' === $sidebar ) : ?>
						</div>
					</div>
				<?php endif ?>

			</article>

			<?php
					endwhile;
				endif;
			?>

			<nav class="center">
				<div class="pagination">
					<div class="row">
						<?php organique_pagination(); ?>
					</div>
				</div>
			</nav>

		</div>

		<?php if ( 'no' !== $sidebar ) : ?>
		<div class="col-xs-12  col-sm-4<?php echo 'left' === $sidebar ? '  col-sm-pull-8' : ''; ?>">
			<aside class="sidebar  sidebar--blog" role="complementary">
				<?php dynamic_sidebar( 'blog-sidebar' ); ?>
			</aside>
		</div>
		<?php endif ?>
	</div>
</div>

<?php get_footer(); ?>
<?php
/**
 * Single blogpost or any other default single entry
 *
 * @package Organique
 */

get_header();

$sidebar = get_post_meta( get_the_ID() , 'sidebar_position', true );

if( 'as_blog' === $sidebar || empty( $sidebar ) ) {
	$sidebar = get_post_meta( absint( get_option( 'page_for_posts' ) ), 'sidebar_position', true );
}

?>

<div class="container  push-down-30">
	<?php get_template_part( 'titlearea' ); ?>
	<div class="row">
		<div class="col-xs-12<?php echo 'no' !== $sidebar ? '  col-sm-8' : ''; echo 'left' === $sidebar ? '  col-sm-push-4' : ''; ?>" role="main">
			<?php
				if( have_posts() ) :
				the_post();
			?>

			<article <?php echo post_class(); ?>>
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
				</div>

				<?php
					$args = array(
						'before'      => '<div class="bold align-center clearfix">' . __( 'Pages:' , 'organique_wp') . ' &nbsp; ',
						'after'       => '</div>',
						'link_before' => '<span class="btn btn-primary">',
						'link_after'  => '</span>',
						'echo'        => 1
					);
					wp_link_pages( $args );
				?>

				<hr class="divider">

				<?php if ( 'no' === $sidebar ) : ?>
						</div>
					</div>
				<?php endif ?>
			</article>

			<?php
				endif;
			?>

			<?php comments_template(); ?>

		</div><!-- /blog -->

		<?php if ( "no" !== $sidebar ) : ?>
		<div class="col-xs-12  col-sm-4<?php echo 'left' === $sidebar ? '  col-sm-pull-8' : ''; ?>">
			<aside class="sidebar  sidebar--blog" role="complementary">
				<?php dynamic_sidebar( 'blog-sidebar' ); ?>
			</aside>
		</div>
		<?php endif; ?>
	</div><!-- /row -->
</div><!-- /container -->

<?php

get_footer();
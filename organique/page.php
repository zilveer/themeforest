<?php
/**
 * Default page template
 *
 * @package Organique
 */

get_header();

$sidebar = get_post_meta( get_the_ID() , 'sidebar_position', true );

?>

<div class="container  push-down-60">
	<div class="row">
		<div class="col-xs-12<?php echo 'no' !== $sidebar ? '  col-sm-8' : ''; echo 'left' === $sidebar ? '  col-sm-push-4' : ''; ?>" role="main">

			<?php
				if ( have_posts() ) :
				the_post();
			?>

			<article <?php echo post_class(); ?>>

			<!-- Thumbnail -->
			<?php if( has_post_thumbnail() ) : ?>
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( 'post-thumbnail', array( 'class' => 'product__image' ) ); ?>
				</a>
			<?php endif; ?>

				<header class="post-title">
					<h3><a href="<?php the_permalink(); ?>"><?php echo lighted_title( get_the_title() ); ?></a></h3>
					<hr>
				</header>

				<div class="blog-content__text">
					<?php the_content(); ?>
				</div>

			</article>

			<?php
				endif; // have_posts
			?>

			<?php comments_template(); ?>

		</div><!-- /page -->

		<?php if ( "no" !== $sidebar ) : ?>
		<div class="col-xs-12  col-sm-4<?php echo 'left' === $sidebar ? '  col-sm-pull-8' : ''; ?>">
			<aside class="sidebar  sidebar--blog" role="complementary">
				<?php dynamic_sidebar( 'regular-page-sidebar' ); ?>
			</aside>
		</div>
		<?php endif; ?>
	</div><!-- /row -->
</div><!-- /container -->

<?php

get_footer();
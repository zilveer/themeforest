<?php
/**
 * Template Name: Default template with Google Maps on top
 *
 * @package Organique
 * @todo spaces to tabs
 */

get_header();

$sidebar = get_post_meta( get_the_ID() , 'sidebar_position', true );

?>

<div class="simple-map  js--where-we-are"></div>

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

				<header class="post-title  center">
					<h1><?php echo lighted_title( get_the_title() ); ?></h1>
					<hr class="divider">
					<?php
					$featured_text = get_post_meta( get_the_ID(), 'featured_text', true );
					if ( ! empty( $featured_text ) ) :
						?>
					<div class="text-shrink">
						<p class="text-highlight">
							<?php echo $featured_text; ?>
						</p>
					</div>
					<hr class="divider  divider-about">
					<?php
					endif;
					?>
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

		<?php if ( 'no' !== $sidebar ) : ?>
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
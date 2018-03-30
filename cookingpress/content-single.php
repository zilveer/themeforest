<?php
/**
 * @package CookingPress
 */


?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php printf('<a href="%1$s" class="published-time" title="%2$s" rel="bookmark"><span class="entry-date updated">%3$s</span></a>', get_permalink(), esc_attr(get_the_time()), get_the_date()); ?>
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'cookingpress'), the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php the_content(); ?>
		<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'cookingpress' ),
			'after'  => '</div>',
			) );
			?>

			<?php if(function_exists('the_ratings')) { the_ratings(); } ?>
		</div><!-- .entry-content -->

		<footer class="entry-meta">
			<?php cookingpress_posted_on(); ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post-## -->

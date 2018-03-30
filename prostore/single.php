<?php
/**
 * Theme Name: proStore
 * Theme URI: http://themeforest.net/user/gnrocks/portfolio
 * Theme demo : http://rchour.net/prostore
 * Description: A WordPress premium theme exclusively for sale on ThemeForest
 *
 * Author: gnrocks
 * Author URI: http://themeforest.net/user/gnrocks
 * License : http://codex.wordpress.org/GPL & http://wiki.envato.com/support/legal-terms/licensing-terms/
 *
 *
 * @package 	proStore/single.php
 * @file	 	1.0
 */
?>
<?php get_header(); ?>

	<?php do_action('before_main_content'); ?>

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<?php
				$format = get_post_format() !="" ? get_post_format() : "standart";
			?>

			<div class="single-item format-<?php echo $format; ?>">

				<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

					<?php get_template_part('library/loop/single',get_post_type()); ?>

				</article> <!-- end article -->
			</div>

		<?php endwhile; ?>

		<?php else : ?>

			<article id="post-not-found">
			    <header>
			    	<h1>Not Found</h1>
			    </header>
			    <section class="post_content">
			    	<p>Sorry, but the requested resource was not found on this site.</p>
			    </section>
			    <footer>
			    </footer>
			</article>

		<?php endif; ?>

	<?php do_action('after_main_content'); ?>

<?php get_footer(); ?>
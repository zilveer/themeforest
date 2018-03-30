<?php
/*
Template Name: Demo Widgets
*/
?>
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
 * @package 	proStore/template-portfolio.php
 * @file	 	1.0
 */
?>
<?php get_header(); ?>

	<?php do_action('before_main_content'); ?>

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?><header>

			<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

					<h1 class="page-title" itemprop="headline">
						<?php the_title(); ?>
					</h1>
					<?php if(get_post_meta($post->ID,"page_subtitle",true)!="") { ?>
						<h4 class="subheader"><?php echo get_post_meta($post->ID,"page_subtitle",true); ?></h4>
					<?php } ?>

				</header> <!-- end article header -->

				<section class="post_content clearfix" itemprop="articleBody">

					<div id="sidebar1" class="sidebar four columns" role="complementary">
						<h4>Custom proStore widgets</h4>
						<hr>
						<?php dynamic_sidebar( 'demo1' ); ?>
					</div>

					<div id="sidebar1" class="sidebar four columns" role="complementary">
						<h4>WooCommerce widgets</h4>
						<hr>
						<div class="panel">
						<?php dynamic_sidebar( 'demo2' ); ?>
						</div>
					</div>

					<div id="sidebar1" class="sidebar four columns" role="complementary">
						<h4>Plugins widgets</h4>
						<hr>
						<?php dynamic_sidebar( 'demo3' ); ?>
					</div>

				</section> <!-- end article section -->

			</article> <!-- end article -->

		<?php endwhile; endif; ?>

	<?php do_action('after_main_content'); ?>

<?php get_footer(); ?>
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
 * @package 	proStore/attachment.php
 * @file	 	1.0
 */
?>
<?php get_header(); ?>
			
	<?php do_action('before_main_content'); ?>

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
			<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
				
				<header>
					
					<h1 class="single-title" itemprop="headline"><?php the_title(); ?></h1>
					
					<p class="meta"><?php _e("Posted", "prostore-theme"); ?> <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_time('F jS, Y'); ?></time> <?php _e("by", "prostore-theme"); ?> <?php the_author_posts_link(); ?> <span class="amp">&</span> <?php _e("filed under", "prostore-theme"); ?> <?php the_category(', '); ?>.</p>
				
				</header> <!-- end article header -->
			
				<section class="post_content clearfix" itemprop="articleBody">
					<?php the_content(); ?>
					
				</section> <!-- end article section -->
				
				<footer>
	
					<?php the_tags('<p class="tags"><span class="tags-title">Tags:</span> ', ' ', '</p>'); ?>
					
				</footer> <!-- end article footer -->
			
			</article> <!-- end article -->
			
			<?php comments_template(); ?>
		
		<?php endwhile; ?>			
		
		<?php else : ?>
			
			<?php article_not_found(); ?>
		
		<?php endif; ?>
			
	<?php do_action('after_main_content'); ?>

<?php get_footer(); ?>
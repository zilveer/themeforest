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
 * @package 	proStore/taxonomy-field.php
 * @file	 	1.0
 */
?>
<?php get_header(); ?>
			
	<?php do_action('before_main_content'); ?>
		
		<h1 class="page-title"><span><?php _e("Archives", "prostore-theme"); ?></span></h1>
		<h4 class="subheader"><span class="alert-color"><?php single_cat_title(); ?></span></h4>

		<?php if (have_posts()) : ?>
		
			<?php $masonry = $data[$prefix."default_masonry"]; $columns = ($data[$prefix."default_masonry_itemrow"]["two"] >= "2") ? "two" : "one"; ?>
			
			<section class="blog-<?php echo $masonry; ?> cols-<?php echo $columns; ?>">
		
				<?php while (have_posts()) : the_post(); ?>
					
					<?php 
						get_template_part( 'library/loop/archive'); 
					?>
			
				<?php endwhile; ?>	
			
			</section>
			
			<?php get_template_part( 'library/loop/pagination'); ?>					
		
		<?php else : ?>
			
			<?php article_not_found(); ?>
		
		<?php endif; ?>
			
	<?php do_action('after_main_content'); ?>

<?php get_footer(); ?>
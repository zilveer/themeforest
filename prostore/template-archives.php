<?php
/*
Template Name: Archives
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
 * @package 	proStore/template-archives.php
 * @file	 	1.0
 */
?>
<?php get_header(); ?>
			
	<?php do_action('before_main_content'); ?>

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
			<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
				
				<header class="row container clearfix">
					<div class="twelve columns clearfix">					
						<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
						<?php if(get_post_meta($post->ID,"page_subtitle",true)!="") { ?>
							<h4 class="subheader"><?php echo get_post_meta($post->ID,"page_subtitle",true); ?></h4>
						<?php } ?>
					</div>				
				</header> <!-- end article header -->
				
				<section class="post_content">
				
					<?php the_content(); ?>
					
	 				<?php get_template_part('library/loop/archive',get_post_meta($post->ID,'archives_style',true)); ?>					
														
				</section>		
					
			</article> <!-- end article -->		
		
		<?php endwhile; ?>	
		
		<?php else : ?>
			
			<?php article_not_found(); ?>
		
		<?php endif; ?>
		
	<?php do_action('after_main_content'); ?>

<?php get_footer(); ?>
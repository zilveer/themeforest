<?php get_header();
	
	$page_type = ot_get_option('archive_page_type','full');
	switch($page_type):
			
		case 'full' :
			$sidebar_type = 'no-sidebar';
		break;
		case 'left' :
			$sidebar_type = 'right';
		break;
		case 'right' :
			$sidebar_type = 'left';
		break;
	
	endswitch; ?>

	<div class="bottom-spacer"></div>
	
	<div id="page-post" class="shell clearfix">
	
	<article <?php post_class($page_type.' page-content'); ?>>
		<div class="top-nav"><?php js_get_pagination(); ?></div>
	
		<?php js_breadcrumbs(); ?>
		<h1 class="page-title"><span>
			<?php if (is_category()) { ?>
				<?php single_cat_title(); ?>
	
			<?php } elseif( is_tag() ) { ?>
				<?php _e('Tagged','espresso'); ?>: &ldquo;<?php single_tag_title(); ?>&rdquo;
	
			<?php } elseif (is_day()) { ?>
				<?php _e('Archive for','espresso'); echo ' '; the_time(get_option('date_format')); ?>
				
			<?php } elseif (is_post_type_archive('portfolio-items')) { ?>
				<?php _e('Portfolios','espresso'); ?>
				
			<?php } elseif (is_post_type_archive('testimonial-items')) { ?>
				<?php _e('Testimonials','espresso'); ?>
	
			<?php } elseif (is_month()) { ?>
				<?php _e('Archive for','espresso'); echo ' '; the_time('F, Y'); ?>
	
			<?php } elseif (is_year()) { ?>
				<?php _e('Archive for','espresso'); echo ' '; the_time('Y'); ?>
	
			<?php } elseif (is_author()) { ?>
				<?php _e('Author Archive','espresso'); ?>
				
			<?php } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
				<?php _e('Archives','espresso'); ?>
				
			<?php } else { the_title(); } ?>
		</span></h1>
		
		<?php if ( have_posts() ) : while (have_posts()) : the_post();

			global $thumbnail_type;
			$thumbnail_type = 'recent-post-thumbnail-square';
			get_template_part('singlerow','post');
			
		endwhile; endif;
		
		js_get_pagination();
		wp_reset_query();
		
	?></article>
	
	<?php if (isset($sidebar_type) && $sidebar_type != '' && $sidebar_type != 'no-sidebar'){ ?>
		<aside class="<?php echo $sidebar_type; ?>">
			<?php dynamic_sidebar('default-sidebar'); ?>
		</aside>
	<?php } ?>
	
	</div><div class="bottom-spacer"></div><?php
	
get_footer(); ?>
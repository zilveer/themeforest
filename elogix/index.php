<?php get_header(); ?>

<div id="page" class="border-top clearfix">

	<div class="color-hr2"></div>
	
	<div id="subtitle">
		
		<?php if (is_category()) { ?>
			<h2><span><?php printf(__("All posts in '%s'", 'framework'), single_cat_title('',false)); ?>.</span></h2>
		<?php } elseif( is_tag() ) { ?>
			<h2><span><?php printf(__("All posts tagged '%s'", 'framework'), single_tag_title('',false)); ?>.</span></h2>
		<?php } elseif (is_day()) { ?>
			<h2><span><?php _e('Archive for', 'framework') ?> <?php the_time('F jS, Y'); ?>.</span></h2>
		 <?php } elseif (is_month()) { ?>
			<h2><span><?php _e('Archive for', 'framework') ?> <?php the_time('F, Y'); ?>.</span></h2>
		<?php } elseif (is_year()) { ?>
			<h2><span><?php _e('Archive for', 'framework') ?> <?php the_time('Y'); ?>.</span></h2>
		<?php } elseif (is_author()) { ?>
			<h2><span><?php _e('All posts by Author', 'framework') ?>.</span></h2>
		<?php } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
			<h2><span><?php _e('Blog Archives', 'framework') ?>.</span></h2>
		<?php } else { ?>
			<h2><span><?php _e('Blog', 'framework') ?>.</span> <?php echo get_post_meta( get_option('page_for_posts'), 'minti_subtitle', true ); ?></h2>
		<?php } ?>
	
	</div>

	<div id="content-part">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div id="post-<?php the_ID(); ?>" <?php post_class('clearfix dotted') ?>>
		
			<div class="post-thumb">
				<?php if ( has_post_thumbnail()) { ?>
					<a href="<?php the_permalink() ?>"><?php the_post_thumbnail('blog-thumb'); ?></a>
				<?php } else { ?>
					<a href="<?php the_permalink() ?>"><img src="<?php bloginfo('template_url'); ?>/framework/images/no-thumb.png" /></a>
				<?php } ?>
			</div>
			
			<div class="post-entry">
				<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
	
				<div class="meta">
					<?php _e('Posted on', 'framework'); ?> <strong><?php the_date(); ?></strong> · <?php _e('Posted in', 'framework'); ?> <?php the_category(', ') ?>
				</div>
	
				<div class="entry">
					<?php the_excerpt(); ?>
				</div>

			</div>

		</div>
		
		

	<?php endwhile; ?>

	<?php include (TEMPLATEPATH . '/framework/functions/nav.php' ); ?>

	<?php else : ?>

		<h2><?php _e('Not Found.', 'framework'); ?></h2>

	<?php endif; ?>

	</div>
	
	<div id="sidebar" class="sidebar-right">
		<?php get_sidebar(); ?>
	</div>

</div>

<?php get_footer(); ?>

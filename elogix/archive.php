<?php get_header(); ?>

		<?php if (have_posts()) : ?>
		
		<div id="page" class="border-top clearfix">

		<div class="color-hr2"></div>
	
		<div id="subtitle">
		
			<h2><span>
 			<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

			<?php /* If this is a category archive */ if (is_category()) { ?>
				
			<?php _e('Archive for the', 'framework'); ?> '<?php single_cat_title(); ?>' <?php _e('Category', 'framework'); ?>

			<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
				<?php _e('Posts Tagged', 'framework'); ?> '<?php single_tag_title(); ?>'

			<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
				<?php _e('Archive for', 'framework'); ?> <?php the_time('F jS, Y'); ?>

			<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
				<?php _e('Archive for', 'framework'); ?> <?php the_time('F, Y'); ?>

			<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
				<?php _e('Archive for', 'framework'); ?> <?php the_time('Y'); ?>

			<?php /* If this is an author archive */ } elseif (is_author()) { ?>
				<?php _e('Author Archive', 'framework'); ?>

			<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
				<?php _e('Blog Archives', 'framework'); ?>
			
			<?php } ?>
			</span></h2>
		</div>
		
		<div id="content-part">

			<?php while (have_posts()) : the_post(); ?>
			
				<div id="post-<?php the_ID(); ?>" <?php post_class('clearfix') ?>>
		
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
					<?php _e('Posted on', 'framework'); ?> <strong><?php the_time('F jS, Y') ?></strong> · <?php _e('Posted in', 'framework'); ?> <?php the_category(', ') ?>
				</div>
	
				<div class="entry">
					<?php the_excerpt(); ?>
				</div>

			</div>

		</div>

			<?php endwhile; ?>

			<?php include (TEMPLATEPATH . '/framework/functions/nav.php' ); ?>
			
		</div>		
			
	<?php else : ?>

		<h2><?php _e('Nothing found', 'framework'); ?></h2>

	<?php endif; ?>
	

	
	<div id="sidebar" class="sidebar-right">
		<?php get_sidebar(); ?>
	</div>

</div>

<?php get_footer(); ?>

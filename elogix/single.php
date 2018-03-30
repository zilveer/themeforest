<?php get_header(); ?>

<div id="page" class="border-top clearfix">

	<div class="color-hr2"></div>
	
	<div id="subtitle">
		<h2><span><?php the_title(); ?>.</span> <?php echo get_post_meta( get_the_ID(), 'minti_subtitle', true ); ?></h2>
	</div>

	<div id="content-part">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div <?php post_class('single-post') ?> id="post-<?php the_ID(); ?>">
		
			<?php if ( has_post_thumbnail()) { ?>
				<div class="big-post-thumb">
					<?php the_post_thumbnail('single-thumb'); ?>
				</div>
			<?php } ?>
		
			<h2 class="top-margin"><?php the_title(); ?></h2>
			
			<div class="meta">
					<?php _e('Posted on', 'framework'); ?> <strong><?php the_date(); ?></strong> · <?php _e('Posted in', 'framework'); ?> <?php the_category(', ') ?>
			</div>
			
			<div class="entry">
				
				<?php the_content(); ?>

				<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>

			</div>
			
			<div class="meta-tags">
				<?php the_tags( '', '', ''); ?>
			</div>
			
		</div>

	<?php comments_template(); ?>

	<?php endwhile; endif; ?>
	
	</div>
	
	<div id="sidebar" class="sidebar-right">
		<?php get_sidebar(); ?>
	</div>

</div>

<?php get_footer(); ?>
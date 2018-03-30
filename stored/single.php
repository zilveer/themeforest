<?php get_header(); ?>
<?php if (have_posts()) : ?>
<div class="posts-wrap">
	<?php while (have_posts()) : the_post(); ?>
	<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<h2 class="post_title">
			<?php the_title(); ?>
        </h2>
        <div class="post_meta">
			<div class="blocks_wrap">
				<div class="meta_block">	
					<span><?php _e('Post Date', 'designcrumbs'); ?></span>
					<?php the_time('F d, Y'); ?>
				</div>
				<div class="meta_block">	
					<span><?php _e('Comments', 'designcrumbs'); ?></span>
					<?php comments_popup_link( __( '0 Comments', 'designcrumbs' ), __( '1 Comment', 'designcrumbs' ), __( '% Comments', 'designcrumbs' ), 'comments-link', __('Comments Closed', 'designcrumbs')); ?>
				</div>
				<div class="meta_block">	
					<span><?php _e('Author', 'designcrumbs'); ?></span>
					<?php the_author_posts_link(); ?>
				</div>
				<div class="meta_block">
					<span><?php _e('Category', 'designcrumbs'); ?></span>
					<?php the_category(', ') ?>
				</div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="entry-content" id="entry-content-single">
			<?php the_content(); ?>
			<div class="clear"></div>
			<?php if (has_tag()) { ?>
				<div class="single-meta">
					<?php the_tags( __('Tagged with: ', 'designcrumbs'), ", ", " " ) ?>
				</div>
			<?php } ?>
		</div><!-- end .entry-content -->
		<?php my_author_box(); ?>
	</div><!-- end .post -->		
	<?php comments_template('', true); ?>
	<?php endwhile; else : ?>

	<h2><?php _e('Sorry, we can\'t seem to find what you\'re looking for.', 'designcrumbs'); ?></h2>
	<p><?php _e('Please try one of the links on top.', 'designcrumbs'); ?></p>
        
	<?php endif; wp_reset_query(); ?>
</div><!-- end .posts-wrap -->	
<?php get_sidebar(); ?>
<?php get_footer(); ?>
<?php get_header(); ?>
<div class="posts-wrap">
<?php if (have_posts()) : ?>
	<div class="the_blog">
	<?php while (have_posts()) : the_post(); ?>

	<?php $count++; ?>
	<?php /* BEGIN ALT FIRST POST */ if ($count <= 2) : ?>
	
	<div <?php post_class('blog-home-post'); ?> id="post-<?php the_ID(); ?>">
		<div class="post_content first_blog_post">
			<h2 class="post_title index-entry-title">
				<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
    	    </h2>
    	    <?php if (has_post_thumbnail()) { ?>
			<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
				<?php the_post_thumbnail( 'blog_image_lg', array('alt' => get_the_title()) ); ?>
			</a>
			<?php } ?>
			<?php the_excerpt(); ?>
			<div class="clear"></div>
			<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="more-link button"><?php _e('Read More', 'designcrumbs'); ?> &raquo;</a>
			<div class="clear"></div>
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
		</div>
	</div><!-- end .post -->
	
	<?php /* END ALT FIRST POST */ else : ?>
	
	<div <?php post_class('blog-home-post'); ?> id="post-<?php the_ID(); ?>">
		<div class="post_content first_blog_post">
			<h2 class="post_title index-entry-title">
				<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
    	    </h2>
    	    <?php if (has_post_thumbnail()) { ?>
			<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
				<?php the_post_thumbnail( 'blog_image_sm', array('alt' => get_the_title()) ); ?>
			</a>
			<?php } ?>
			<?php the_excerpt(); ?>
			<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="more-link button"><?php _e('Read More', 'designcrumbs'); ?> &raquo;</a>
			<div class="clear"></div>
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
		</div>
	</div><!-- end .post -->
	
	<?php /* END REST OF POSTS */ endif; ?>
        
	<?php endwhile; ?>
	</div><!-- end .the_blog -->
	<div class="navigation navigation-index">
		<div class="nav-prev"><?php next_posts_link( __('&laquo; Older Entries', 'designcrumbs')) ?></div>
		<div class="nav-next"><?php previous_posts_link( __('Newer Entries &raquo;', 'designcrumbs')) ?></div>
		<div class="clear"></div>
	</div>

	<?php else : ?>

	<h2><?php _e('Sorry, we can\'t seem to find what you\'re looking for.', 'designcrumbs'); ?></h2>
	<p><?php _e('Please try one of the links on top.', 'designcrumbs'); ?></p>
        
	<?php endif; ?>
	
</div><!-- end .posts-wrap -->
<?php get_sidebar(); ?>

<?php get_footer(); ?>

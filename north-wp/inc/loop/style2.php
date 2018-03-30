<?php $blog_header = ot_get_option('blog_header'); ?>
<div class="page-padding">
<div class="row max_width">
	<div class="small-12 columns">
		<section class="blog-section row posts masonry<?php if ($blog_header) { ?> low-top-padding<?php } ?>" id="infinitescroll" data-count="<?php echo get_option('posts_per_page'); ?>" data-total="<?php echo $wp_query->max_num_pages; ?>" data-type="style2">
		  	<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
			<article itemscope itemtype="http://schema.org/BlogPosting" <?php post_class('small-12 medium-6 large-4 item post columns'); ?> id="post-<?php the_ID(); ?>" role="article">
				<?php 
					set_query_var( 'masonry', true );
					set_query_var( 'grid', false );
					get_template_part( 'inc/postformats/standard' );
				?>
				<header class="post-title">
					<h2 itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
				</header>
				<?php get_template_part( 'inc/postformats/post-meta' ); ?>
				
				<div class="post-content bold-text">
					<?php the_excerpt(); ?>
					<a href="<?php the_permalink(); ?>" class="more-link"><?php _e( 'Read More', 'north' ); ?></a>
				</div>
			</article>
		  <?php endwhile; else : ?>
		    <p><?php _e( 'Please add posts from your WordPress admin page.', 'north' ); ?></p>
		  <?php endif; ?>
		</section>
	</div>
</div>
</div>
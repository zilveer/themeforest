<?php get_header(); ?>
<div class="row">
<section class="small-12 columns cf blog-section">
  <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
	  <article itemscope itemtype="http://schema.org/BlogPosting" <?php post_class('post style1'); ?> id="post-<?php the_ID(); ?>" role="article">
	  	<header class="post-title">
	  		<h2 itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
	  	</header>
	  	<?php get_template_part( 'inc/postformats/post-meta' ); ?>
	  	<div class="row align-center">
	  		<div class="small-12 medium-10 large-9 columns">
	  			<?php
	  				set_query_var( 'masonry', false );
	  				set_query_var( 'grid', false );
	  				get_template_part( 'inc/postformats/standard' );
	  			?>
	  		</div>
	  		<div class="small-12 medium-8 large-6 columns post-content text-center">
	  			<?php the_excerpt(); ?>
	  			<a href="<?php the_permalink(); ?>" class="more-link"><?php _e( 'Read More', 'north' ); ?></a>
	  		</div>
	  	</div>
	  </article>
  <?php endwhile; ?>
      <?php the_posts_pagination(array(
      	'prev_text' 	=> '<span>'.__( "<i class='fa fa-caret-left'></i> Previous", 'north' ).'</span>',
      	'next_text' 	=> '<span>'.__( "Next <i class='fa fa-caret-right'></i>", 'north' ).'</span>'
      )); ?>
  <?php else : ?>
    <p><?php _e( 'Please add posts from your WordPress admin page.', 'north' ); ?></p>
  <?php endif; ?>
</section>
</div>
<?php get_footer(); ?>
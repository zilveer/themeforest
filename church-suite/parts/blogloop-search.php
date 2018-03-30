<article id="post-<?php the_ID(); ?>" class="blog-post"> 
	
		<?php $webnus_options = webnus_options(); ?>

	<div class="col-md-11 alpha omega">
	  <h3><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h3>
	  <div class="postmetadata">
		<h6 class="blog-date"> <?php the_time('F d, Y') ?> | </h6>
		<?php
		$webnus_options['webnus_blog_meta_author_enable'] = isset( $webnus_options['webnus_blog_meta_author_enable'] ) ? $webnus_options['webnus_blog_meta_author_enable'] : '';
		if($webnus_options['webnus_blog_meta_author_enable']) { ?>	
		<h6 class="blog-author"><strong><?php esc_html_e('by','webnus_framework'); ?></strong> <?php the_author_posts_link(); ?> </h6>
		<?php }
		$webnus_options['webnus_blog_meta_category_enable'] = isset( $webnus_options['webnus_blog_meta_category_enable'] ) ? $webnus_options['webnus_blog_meta_category_enable'] : '';
		if($webnus_options['webnus_blog_meta_category_enable']) { ?>
		<h6 class="blog-cat"><strong><?php esc_html_e('in','webnus_framework'); ?></strong> <?php the_category(', ') ?> </h6>
		<?php }
		$webnus_options['webnus_blog_meta_comments_enable'] = isset( $webnus_options['webnus_blog_meta_comments_enable'] ) ? $webnus_options['webnus_blog_meta_comments_enable'] : '';
		if($webnus_options['webnus_blog_meta_comments_enable']) { ?>
		<h6 class="blog-comments"><strong> - </strong> <?php comments_number(  ); ?> </h6>
		<?php } ?>
	  </div>
	 <p>
	  <?php 
	  $webnus_options['webnus_blog_excerpt_list'] = isset( $webnus_options['webnus_blog_excerpt_list'] ) ? $webnus_options['webnus_blog_excerpt_list'] : '';
		echo webnus_excerpt(($webnus_options['webnus_blog_excerpt_list'])?$webnus_options['webnus_blog_excerpt_list']:35);
	  ?>
	  </p>
	  </div>
	<hr class="vertical-space1">
</article>
<article <?php post_class(); if( ! is_single() ) echo ' itemprop="blogPost"'; ?> itemscope itemtype="https://schema.org/BlogPosting">

	<meta itemprop="datePublished" content="<?php echo esc_attr( get_the_date( 'c' ) ) ?>">
	<meta itemprop="url" content="<?php the_permalink() ?>">
	<meta itemprop="discussionUrl" content="<?php comments_link() ?>">
	<meta itemprop="author" content="<?php the_author() ?>">

	<?php Youxi()->templates->get( 'media/media', get_post_format(), 'post' ); ?>
	<?php Youxi()->templates->get( 'parts/header', get_post_format(), 'post' ); ?>

	<section class="entry-content" itemprop="articleBody">

		<?php do_action( 'shiroi_before_post_body_content' );

		if( is_single() ) : 

			the_content();

			if( get_the_tags() && Youxi()->option->get( 'blog_show_tags' ) ) : ?>
				<p class="post-tags">
					<?php the_tags( '<i class="fa fa-tags"></i>', ', ' ); ?>
				</p>
			<?php endif;
		
			wp_link_pages(array(
				'before' => '<nav class="entries-page-nav"><ul class="plain-list">', 
				'after' => '</ul></nav>', 
				'separator' => '', 
				'pagelink' => '<span class="entries-page-nav-item">%</span>'
			));
		endif;

		do_action( 'shiroi_after_post_body_content' ); ?>

	</section>

	<?php if( is_single() ):
		Youxi()->templates->get( 'parts/footer', get_post_format(), 'post' );
	endif; ?>

</article>

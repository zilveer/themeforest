<article <?php post_class(); ?> itemprop="blogPost" itemscope itemtype="https://schema.org/BlogPosting">

	<meta itemprop="datePublished" content="<?php echo esc_attr( get_the_date( 'c' ) ) ?>">
	<meta itemprop="url" content="<?php the_permalink() ?>">
	<meta itemprop="discussionUrl" content="<?php comments_link() ?>">
	<meta itemprop="author" content="<?php the_author() ?>">

	<?php if( 'below_header' == Youxi()->option->get( 'blog_grid_media_position' ) ):
		Youxi()->templates->get( 'parts/header', get_post_format(), 'post', 'grid' );
		Youxi()->templates->get( 'media/media', get_post_format(), 'post', 'grid' );
	else:
		Youxi()->templates->get( 'media/media', get_post_format(), 'post', 'grid' );
		Youxi()->templates->get( 'parts/header', get_post_format(), 'post', 'grid' );
	endif; ?>

	<section class="entry-content" itemprop="articleBody">
		<?php echo apply_filters( 'the_excerpt', Youxi()->entries->get_excerpt( apply_filters( 'shiroi_grid_post_excerpt_length', 35 ) ) ); ?>
	</section>

</article>
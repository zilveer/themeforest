<article <?php post_class(); ?> itemprop="blogPost" itemscope itemtype="https://schema.org/BlogPosting">

	<meta itemprop="datePublished" content="<?php echo esc_attr( get_the_date( 'c' ) ) ?>">
	<meta itemprop="url" content="<?php the_permalink() ?>">
	<meta itemprop="discussionUrl" content="<?php comments_link() ?>">
	<meta itemprop="author" content="<?php the_author() ?>">

	<?php Youxi()->templates->get( 'media/media', get_post_format(), 'post', 'grid' ); ?>
	<?php Youxi()->templates->get( 'parts/header', get_post_format(), 'post', 'grid' ); ?>

</article>
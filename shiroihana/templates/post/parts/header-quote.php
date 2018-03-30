<header class="entry-header text-<?php echo Youxi()->option->get( 'blog_header_alignment' ) ?>">

	<?php do_action( 'shiroi_before_post_header_content' );

	$blog_below_title_meta = Youxi()->option->get( 'blog_below_title_meta' );

	$blog_above_title_meta = Youxi()->option->get( 'blog_above_title_meta' );
	if( ! in_array( $blog_above_title_meta, array( 'date', 'category' ) ) ): 
		$blog_above_title_meta = 'date';
	endif;

	if( is_single() ):
		the_title( '<h1 class="entry-title" itemprop="headline name">', '</h1>' );
	else:
		the_title( '<h2 class="entry-title" itemprop="headline name">', '</h2>' );
	endif;

	$blog_below_title_meta[] = $blog_above_title_meta;
	$blog_below_title_meta = array_unique( $blog_below_title_meta );

	if( $blog_below_title_meta ) : ?>
	
	<div class="entry-meta">

		<ul class="entry-meta-list plain-list"><?php

			if( in_array( 'author', $blog_below_title_meta ) ):

			?><li><span class="author vcard"><span class="fn"><?php the_author_posts_link(); ?></span></span></li><?php 

			endif;

			if( in_array( 'date', $blog_below_title_meta ) ):

			?><li><time datetime="<?php echo esc_attr( get_the_time( 'c' ) ); ?>"><?php echo get_the_time( get_option( 'date_format' ) ); ?></time></li><?php 

			endif;

			if( in_array( 'category', $blog_below_title_meta ) && get_the_category() ):

			?><li><?php the_category( ', ' ); ?></li><?php 

			endif;

			if( in_array( 'comments', $blog_below_title_meta ) ):

			?><li><a href="<?php comments_link() ?>"><?php comments_number( __( 'No Comments', 'shiroi' ), __( 'One Comment', 'shiroi' ), __( '% Comments', 'shiroi' ) ); ?></a></li><?php 

			endif;

		?></ul>

	</div>

	<?php endif; ?>

	<?php do_action( 'shiroi_after_post_header_content' ); ?>

</header>

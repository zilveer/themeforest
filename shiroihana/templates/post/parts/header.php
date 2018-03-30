<header class="entry-header text-<?php echo Youxi()->option->get( 'blog_header_alignment' ) ?>">

	<?php do_action( 'shiroi_before_post_header_content' );

	$blog_above_title_meta = Youxi()->option->get( 'blog_above_title_meta' );
	if( ! in_array( $blog_above_title_meta, array( 'none', 'date', 'category' ) ) ): 
		$blog_above_title_meta = 'date';
	endif;

	if( 'none' != $blog_above_title_meta ) : ?>

		<div class="entry-meta">
			<?php if( 'date' === $blog_above_title_meta ) : ?>
				<time class="updated" datetime="<?php echo esc_attr( get_the_time( 'c' ) ); ?>">
					<?php echo get_the_time( get_option( 'date_format' ) ); ?>
				</time>
			<?php else:
				the_category( ', ' );			
			endif; ?>
		</div>

	<?php endif; ?>

	<?php if( is_single() ):
		the_title( '<h1 class="entry-title" itemprop="headline name">', '</h1>' );
	else:
		the_title( '<h2 class="entry-title" itemprop="headline name"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' );
	endif;

	if( $blog_below_title_meta = Youxi()->option->get( 'blog_below_title_meta' ) ): ?>

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

	<?php endif;

	do_action( 'shiroi_after_post_header_content' ); ?>

</header>

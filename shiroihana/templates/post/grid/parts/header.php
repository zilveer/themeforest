<header class="entry-header">

	<?php

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

	<?php the_title( '<h2 class="entry-title" itemprop="headline name"><a href="' . esc_url( get_permalink() ) . '" itemprop="url">', '</a></h2>' ); ?>

</header>

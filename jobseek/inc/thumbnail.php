<div class="post-image"><?php

if( has_post_thumbnail() ) {

	if( !is_single() ) {
		?><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_post_thumbnail( 'blog' ); ?></a><?php
	} else {
		?><?php the_post_thumbnail( 'blog' ); ?><?php
	}

} ?>
</div>
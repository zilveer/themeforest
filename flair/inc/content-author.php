<div class="author-block">

	<div class="author-thumb">
		<?php echo get_avatar( get_the_author_meta('email'), 80 ); ?>
	</div>
	
	<h6 class="pad5"><?php the_author_posts_link(); ?></h6>
	<?php echo wpautop( do_shortcode( htmlspecialchars_decode( get_the_author_meta('description') ) ) ); ?>
		
</div>
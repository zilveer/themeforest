<div class="post-quote">
	<blockquote>
		<div class="quote-text"><?php the_content(); ?>
		<span class="quote-source"><a href="<?php echo get_post_meta($post->ID, 'richer_quote_url', true); ?>" target="_blank">- <?php echo get_post_meta($post->ID, 'richer_quote_name', true); ?></a></span>
		</div>
	</blockquote>
</div>


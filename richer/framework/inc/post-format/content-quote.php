<div class="post-quote">
	<blockquote>
		<div class="quote-text">
		<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'richer'), the_title_attribute('echo=0') ); ?>" rel="bookmark">
			<?php the_content(); ?>
		</a>
		<span class="quote-source"><a href="<?php echo get_post_meta($post->ID, 'richer_quote_url', true); ?>" target="_blank">- <?php echo get_post_meta($post->ID, 'richer_quote_name', true); ?></a></span>
		</div>
	</blockquote>
</div>

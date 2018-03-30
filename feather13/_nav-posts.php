<?php if ( wpb_show_post_nav() ): ?>
	<?php if ( function_exists('wp_pagenavi') ): ?>
		<nav class="entry-nav fix">
			<?php wp_pagenavi(); ?>
		</nav>
	<?php else: ?>
		<nav class="entry-nav">
			<ul class="fix">
				<li class="prev left"><?php previous_posts_link(); ?></li>
				<li class="next right"><?php next_posts_link(); ?></li>
			</ul>
		</nav>
	<?php endif; ?>
<?php endif; ?>

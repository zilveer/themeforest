<header class="item-header">
	<h1>
		<a href="<?php the_permalink(); ?>" rel="permalink"><?php the_title(); ?></a>
	</h1>
</header>

<footer class="item-footer">
	<time pubdate class="pubdate">
		<?php echo get_the_date(); ?>
	</time>
</footer>

<?php if( get_the_excerpt() != '' ) : ?>
	<div class="thb-text">
		<?php the_excerpt(); ?>
	</div>
<?php endif; ?>

<a class="thb-btn readmore" href="<?php the_permalink(); ?>"><?php _e('Read', 'thb_text_domain'); ?></a>
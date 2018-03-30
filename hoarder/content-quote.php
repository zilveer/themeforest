<?php if( !is_single() ) { ?>
	<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'zilla'), get_the_title()); ?>">
<?php } ?>

	<!-- BEGIN .entry-quote -->
	<div class="entry-quote">
	    <?php $quote = get_post_meta($post->ID, '_zilla_quote_quote', true); ?>
	    <h2><?php echo $quote; ?></h2>
	    <p class="quote-source"><?php the_title(); ?></p>
	<!-- END .entry-quote -->
	</div>

<?php if( !is_single() ) { ?>
	</a>
<?php } ?>
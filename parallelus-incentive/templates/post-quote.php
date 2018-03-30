<?php
/**
 * The template for displaying posts in the Quote post format
 */
?>

<header class="post-header">
	<h3 class="entry-title"><?php echo get_post_meta($post->ID, 'postformat_quote_text', true) ?></h3>
	<span class="sub-title">&mdash; <?php echo get_post_meta($post->ID, 'postformat_quote_source', true) ?></span>
</header>

<?php 

	// Post Content
	theme_post_content();
	
?>
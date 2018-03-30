<?php
/**
 * The template for displaying posts in the Link post format
 */
?>

<header class="post-header">
	<h1 class="entry-title">
		<a href="<?php echo esc_url(get_post_meta($post->ID, 'postformat_link_url', true)); ?>" title="<?php echo esc_attr(get_the_title()); ?>"><?php echo get_the_title(); ?></a>
	</h1>
	<span class="sub-title">&mdash; <?php echo get_post_meta($post->ID, 'postformat_link_url', true) ?></span>
</header>

<?php 

	// Post Content
	theme_post_content();

?>
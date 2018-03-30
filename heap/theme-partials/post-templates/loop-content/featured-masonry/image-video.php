<?php
$video_embed = get_post_meta($post->ID, '_heap_'.'video_embed', true);
?>

<?php if ( ! empty($video_embed)): ?>
	<div class="article__featured-image">
		<?php echo stripslashes(htmlspecialchars_decode(do_shortcode($video_embed))) ?>
	</div>
<?php endif; ?>
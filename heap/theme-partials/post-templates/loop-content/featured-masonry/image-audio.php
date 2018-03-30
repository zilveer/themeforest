<?php
$audio_embed = get_post_meta($post->ID, '_heap_'.'audio_embed', true)
?>

<?php if( ! empty($audio_embed)): ?>
	<div class="article__featured-image">
		<?php echo stripslashes(htmlspecialchars_decode(do_shortcode($audio_embed))) ?>
	</div>
<?php endif; ?>
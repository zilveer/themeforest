<?php
if (!defined('ABSPATH')) exit();

$post_type_values = get_post_meta($post->ID, 'post_type_values', true);
?>
<div class="entry-media">
	<?php
	if (class_exists('TMM_Content_Composer')) {
		echo do_shortcode('[tmm_audio]' . $post_type_values['audio'] . '[/tmm_audio]');
	} else {
		?>
		<audio controls="control" type="audio/mp3" preload="none" src="<?php echo esc_url($post_type_values['audio']) ?>"></audio>
	<?php
	}
	?>
</div>






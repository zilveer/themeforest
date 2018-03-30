<?php
    global $post, $mango_settigs;
	$app_audio_id = get_post_meta($post->ID, 'mango_file_audio', true);

	
		$app_audio = get_post_meta( $app_audio_id, '_wp_attached_file', true );
		$image_path = wp_upload_dir();
    ?>
    <div class="entry-media">
        <audio controls="" loop=""><source src="<?php echo esc_url($image_path['baseurl'].'/'.$app_audio); ?>"></audio>
    </div>
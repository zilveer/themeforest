<?php
global $unik_data;

	$post_aidio_upload = wp_get_attachment_url(get_post_meta($post->ID,THEMENAME.'_featured_audio',true));
	$post_audio_url = get_post_meta($post->ID,THEMENAME.'_featured_audio_url',true);
	$audio_upload = !empty($post_aidio_upload)	? $post_aidio_upload : $post_audio_url;
	$poster_id = get_post_meta($post->ID,THEMENAME.'_featured_audio_poster',true);
	$title = get_post_meta($post->ID,THEMENAME.'_featured_audio_url_title',true);
	$artist = get_post_meta($post->ID,THEMENAME.'_featured_audio_artist',true);
	$thumbnail_id = get_post_thumbnail_id($post->ID);
	$poster = !empty($poster_id) ? wp_get_attachment_image_src($poster_id,'thumbnail') : wp_get_attachment_image_src($thumbnail_id,'thumb') ;
	$blog_image = wp_get_attachment_image_src(get_post_thumbnail_id(), $unik_data['blog_image_size'] ); // selected image size from 

?>	

<?php if($audio_upload): ?>
<div class="audio-part audio-wrap entry-thumbnail sm-border" style="background-image:url('<?php echo $blog_image[0] ?>')">
	<div class="audio-player">
		<div id="cp_container_<?php echo $post->ID; ?>" class="cp-container">
			<div class="cp-controls cc" data-source="<?php echo unik_encryptIt($audio_upload); ?> " data-title="<?php echo $title; ?>" data-artist="<?php echo $artist; ?>" data-poster="<?php echo $poster[0]; ?>" >
				<a class="cp-play" tabindex="1"><i class="icon-play"></i></a>
				<a class="cp-pause" tabindex="1"><i class="icon-pause"></i></a>
			</div>
		</div>
		<div class="autio-title">
			<span><?php _e('Title ',THEMENAME); ?> : <?php echo $title; ?></span><br>
		</div>
	</div>
</div>
<?php endif; ?>	
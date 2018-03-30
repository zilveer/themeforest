<?php if(get_post_meta(get_the_ID(), "eltd_post_audio_link_meta", true) !== ""){ ?>
	<div class="eltd-blog-audio-holder">
		<audio class="eltd-blog-audio" src="<?php echo esc_url(get_post_meta(get_the_ID(), "eltd_post_audio_link_meta", true)) ?>" controls="controls">
			<?php esc_html_e("Your browser don't support audio player","flow"); ?>
		</audio>
	</div>
<?php } ?>
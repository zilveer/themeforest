<?php if(get_post_meta(get_the_ID(), "mkd_post_audio_link_meta", true) !== ""){ ?>
	<div class="mkd-blog-audio-holder">
		<audio class="mkd-blog-audio" src="<?php echo esc_url(get_post_meta(get_the_ID(), "mkd_post_audio_link_meta", true)) ?>" controls="controls">
			<?php esc_html_e("Your browser don't support audio player","libero"); ?>
		</audio>
	</div>
<?php } ?>
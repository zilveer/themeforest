<?php if(get_post_meta(get_the_ID(), "qodef_post_audio_link_meta", true) !== ""){ ?>
	<div class="qodef-blog-audio-holder">
		<audio class="qodef-blog-audio" src="<?php echo esc_url(get_post_meta(get_the_ID(), "qodef_post_audio_link_meta", true)) ?>" controls="controls">
			<?php esc_html_e("Your browser don't support audio player","suprema"); ?>
		</audio>
	</div>
<?php } ?>
<?php $_video_type = get_post_meta(get_the_ID(), "eltd_video_type_meta", true);?>
<?php if($_video_type == 'social') {
	$videolink = get_post_meta(get_the_ID(), "eltd_post_video_link_meta", true);
	$embed = wp_oembed_get( $videolink );
	print $embed;
} elseif ($_video_type == "self"){ ?>
	<div class="eltd-self-hosted-video-holder">
		<div class="eltd-mobile-video-image" style="background-image: url(<?php echo esc_url($meta_temp_image = get_post_meta(get_the_ID(), "eltd_post_video_image_meta", true));  ?>);"></div>
		<div class="eltd-video-wrap">
			<video class="eltd-self-hosted-video" poster="<?php echo esc_url(get_post_meta(get_the_ID(), "video_format_image", true));  ?>" preload="auto">
				<?php if(($meta_temp = get_post_meta(get_the_ID(), "eltd_post_video_webm_link_meta", true)) != "") { ?> <source type="video/webm" src="<?php echo esc_url($meta_temp);  ?>"> <?php } ?>
				<?php if(($meta_temp_mp4 = get_post_meta(get_the_ID(), "eltd_post_video_mp4_link_meta", true)) != "") { ?> <source type="video/mp4" src="<?php echo esc_url($meta_temp_mp4);  ?>"> <?php } ?>
				<?php if(($meta_temp = get_post_meta(get_the_ID(), "eltd_post_video_ogv_link_meta", true)) != "") { ?> <source type="video/ogg" src="<?php echo esc_url($meta_temp);  ?>"> <?php } ?>
				<object width="320" height="240" type="application/x-shockwave-flash" data="<?php echo esc_url(get_template_directory_uri().'/js/flashmediaelement.swf'); ?>">
					<param name="movie" value="<?php echo esc_url(get_template_directory_uri().'/js/flashmediaelement.swf'); ?>" />
					<param name="flashvars" value="controls=true&file=<?php echo esc_url($meta_temp_mp4);  ?>" />
					<img src="<?php echo esc_url($meta_temp_image);  ?>" width="1920" height="800" title="No video playback capabilities" alt="<?php esc_html_e('Video thumb','flow'); ?>" />
				</object>
			</video>
		</div>
	</div>
<?php } ?>